<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . '/wp-admin/includes/user.php' );
require_once( dirname(__FILE__).'/admin-api_pp.php' );

if ( ! isset($_GET['pp_agent_search']) )
	return;

$orig_search_str = $_GET['pp_agent_search'];
$search_str = sanitize_text_field($_GET['pp_agent_search']);
$agent_type = pp_sanitize_key($_GET['pp_agent_type']);
$agent_id = (int) $_GET['pp_agent_id'];
$topic = sanitize_text_field( str_replace( '\\\\:', ',', $_GET['pp_topic'] ) );
$omit_admins = (bool) $_GET['pp_omit_admins'];
$context = ( isset($_GET['pp_context']) ) ? pp_sanitize_key($_GET['pp_context']) : '';

if ( strpos( $topic, ',' ) ) {
	$arr_topic = explode( ',', $topic );
	if ( isset( $arr_topic[1] ) ) {
		if( taxonomy_exists( $context ) ) {
			$verified = true;
			$ops = _pp_can_set_exceptions( $arr_topic[0], $arr_topic[1], array( 'via_item_source' => 'term', 'via_item_type' => $context, 'for_item_source' => 'post' ) ) ? array( 'read' => true ) : array();
			$operations = apply_filters( 'pp_item_edit_exception_ops', $ops, 'post', $context, $arr_topic[1] );
			
			if ( ! in_array( $arr_topic[0], $operations ) )
				die( -1 );
			
		} elseif ( post_type_exists( $arr_topic[1] ) ) {
			$verified = true;
			$ops = _pp_can_set_exceptions( $arr_topic[0], $arr_topic[1], array( 'via_item_source' => 'post', 'for_item_source' => 'post' ) ) ? array( 'read' => true ) : array();
			$operations = apply_filters( 'pp_item_edit_exception_ops', $ops, 'post', $arr_topic[1] );
			
			if ( ! in_array( $arr_topic[0], $operations ) )
				die( -1 );
		}
	}

} elseif ( 'member' == $topic ) {
	$verified = true;
	$group_type = pp_group_type_exists( $context ) ? $context : 'pp_group';
	if ( ! pp_has_group_cap( 'pp_manage_members', $agent_id, $group_type ) ) {
		die( -1 );
	}
	
} elseif ( 'select-author' == $topic ) {
	$verified = true;
	
	$post_type = ( post_type_exists($context) ) ? $context : 'page';
	
	$type_obj = get_post_type_object( $post_type );
	if ( ! current_user_can( $type_obj->cap->edit_others_posts ) ) {
		die( -1 );
	}
}

if ( empty($verified) ) {
	if ( ! current_user_can( 'pp_manage_members' ) )
		die( -1 );
}

if ( ! function_exists('ppc_administrator_roles') ) {
function ppc_administrator_roles() {			
	// WP roles containing the 'pp_administer_content' cap are always honored regardless of object or term restritions
	global $wp_roles;
	$admin_roles = array();
	
	if ( isset($wp_roles->role_objects) ) {
		foreach ( array_keys($wp_roles->role_objects) as $wp_role_name ) {
			if ( ! empty($wp_roles->role_objects[$wp_role_name]->capabilities['pp_administer_content']) ) {
				$admin_roles[$wp_role_name] = true;
			}
		}
	}
	
	return $admin_roles;
}
}

if ( 'user' == $agent_type ) {
	global $wpdb;

	global $current_blog;
	if ( isset( $current_blog ) && is_object( $current_blog ) && isset( $current_blog->blog_id ) )
		$blog_prefix = $wpdb->get_blog_prefix( $current_blog->blog_id );
	else
		$blog_prefix = $wpdb->get_blog_prefix();
	
	if ( PP_MULTISITE && apply_filters( 'pp_user_search_site_only', true, compact( 'agent_type', 'agent_id', 'topic', 'context', 'omit_admins' ) ) ) {
		$join = "INNER JOIN $wpdb->usermeta AS um ON um.user_id = $wpdb->users.ID AND um.meta_key = '{$blog_prefix}capabilities'";
	} else {
		$join = '';
	}
	
	$orderby = ( 0 === strpos( $orig_search_str, ' ' ) ) ? 'user_login' : 'user_registered DESC';
	
	$um_keys = ( ! empty($_GET['pp_usermeta_key'] ) ) ? $_GET['pp_usermeta_key'] : array();
	$um_vals = ( ! empty($_GET['pp_usermeta_val'] ) ) ? $_GET['pp_usermeta_val'] : array();
	
	if ( defined( 'PP_USER_LASTNAME_SEARCH' ) && ! defined( 'PP_USER_SEARCH_FIELD' ) ) {
		$default_search_field = 'last_name';
	} elseif( defined( 'PP_USER_SEARCH_FIELD' ) ) {
		$default_search_field = PP_USER_SEARCH_FIELD;
	} else {
		$default_search_field = '';
	}
	
	if ( $search_str && $default_search_field ) {
		$um_keys[]= $default_search_field;
		$um_vals[]= $search_str;
		$search_str = '';
	}
	
	// discard duplicate selections
	$used_keys = array();
	foreach( $um_keys as $i => $keyname ) {
		if ( ! $keyname || in_array( $keyname, $used_keys ) ) {
			unset( $um_keys[$i] );
			unset( $um_vals[$i] );
		} else {
			$used_keys []= $keyname;
		}
	}
	
	$um_keys = array_values( $um_keys );
	$um_vals = array_values( $um_vals );
	
	if ( $search_str ) {
		$where = "WHERE (user_login LIKE '%{$search_str}%' OR user_nicename LIKE '%{$search_str}%')";
	} else {
		$where = "WHERE 1=1";
	}
	
	if ( $role_filter = sanitize_text_field($_GET['pp_role_search']) ) {
		global $current_blog;
		$blog_prefix = $wpdb->get_blog_prefix($current_blog->blog_id);
		
		$um_keys[]= "{$blog_prefix}capabilities";
		$um_vals[]= $role_filter;
	}
	
	// append where clause for meta value criteria	
	if ( ! empty( $um_keys ) ) {
		// force search values to be cast as numeric or boolean
		$force_numeric_keys = ( defined( 'PP_USER_SEARCH_NUMERIC_FIELDS' ) ) ? explode( ',', PP_USER_SEARCH_NUMERIC_FIELDS ) : array();
		$force_boolean_keys = ( defined( 'PP_USER_SEARCH_BOOLEAN_FIELDS' ) ) ? explode( ',', PP_USER_SEARCH_BOOLEAN_FIELDS ) : array();
		
		for( $i = 0; $i < count($um_keys); $i++ ) {			
			$join .= " INNER JOIN $wpdb->usermeta AS um_{$um_keys[$i]} ON um_{$um_keys[$i]}.user_id = $wpdb->users.ID AND um_{$um_keys[$i]}.meta_key = '{$um_keys[$i]}'";
			
			$val = trim( $um_vals[$i] );
			
			if ( in_array( $um_keys[$i], $force_numeric_keys ) ) {
				if ( in_array( $val, array( 'true', 'false', 'yes', 'no' ) ) )
					$val = (bool) $val;
				
				$val = (int) $val;
			} elseif ( in_array( $val, $force_boolean_keys ) )
				$val = strval( (bool) $val );
			
			if ( $val )
				$where .= " AND um_{$um_keys[$i]}.meta_value LIKE '%{$val}%'";
			else
				$where .= " AND um_{$um_keys[$i]}.meta_value = '{$val}'";
		}
	}
	
	$results = $wpdb->get_results( "SELECT ID, user_login, display_name FROM $wpdb->users $join $where ORDER BY $orderby LIMIT 1000" );
	
	if ( $results ) {	
		$omit_users = array();
		
		// determine all current users for group in question
		if ( ! empty( $agent_id ) ) {
			$topic = isset( $topic ) ? $topic : '';
			$group_type = ( $context && pp_group_type_exists( $context ) ) ? $context : 'pp_group';
			$omit_users = pp_get_group_members( $agent_id, $group_type, 'id', array( 'member_type' => $topic, 'status' => 'any' ) );
		} elseif ( $omit_admins ) {
			if ( $admin_roles = ppc_administrator_roles() ) {	// Administrators can't be excluded; no need to include or enable them
				global $wpdb;
				$role_csv = implode( "','", array_keys($admin_roles) );
				$omit_users = $wpdb->get_col( "SELECT u.ID FROM $wpdb->users AS u INNER JOIN $wpdb->pp_group_members AS gm ON u.ID = gm.user_id INNER JOIN $wpdb->pp_groups AS g ON gm.group_id = g.ID WHERE g.metagroup_type = 'wp_role' AND g.metagroup_id IN ('$role_csv')" );
			}
		}

		foreach( $results as $row ) {
			if ( ! in_array( $row->ID, $omit_users ) ) {
				if ( defined( 'PP_USER_RESULTS_DISPLAY_NAME' ) ) {
					$title = ( $row->user_login != $row->display_name ) ? " title='" . esc_attr($row->user_login) . "'" : '';
					echo "<option value='$row->ID' class='pp-new-selection'{$title}>$row->display_name</option>";
				} else {
					$title = ( $row->user_login != $row->display_name ) ? " title='" . esc_attr($row->display_name) . "'" : '';
					echo "<option value='$row->ID' class='pp-new-selection'{$title}>$row->user_login</option>";
				}
			}
		}
	}
} else {
	$reqd_caps = apply_filters( 'pp_edit_groups_reqd_caps', array('pp_edit_groups') );

	// determine all currently stored groups (of any status) for user in question (not necessarily logged user)
	if ( ! empty( $agent_id ) )
		$omit_groups = pp_get_groups_for_user( $agent_id, $agent_type, array( 'status' => 'any' ) );
	else
		$omit_groups = array();

	if ( $groups = pp_get_groups( $agent_type, array( 'filtering' => true, 'include_norole_groups' => false, 'reqd_caps' => $reqd_caps, 'search' => $search_str ) ) ) {
		foreach( $groups as $row )
			if ( ( empty($row->metagroup_id) || is_null($row->metagroup_id) ) && ! isset( $omit_groups[$row->ID] ) )
				echo "<option value='$row->ID'>$row->name</option>";
	}
}

