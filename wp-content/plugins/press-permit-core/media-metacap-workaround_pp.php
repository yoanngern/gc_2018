<?php
global $wp_post_types;
$wp_post_types['attachment']->map_meta_cap = false;

add_filter( 'map_meta_cap', '_pp_flt_map_media_meta_cap', 2, 4 );

// Work around inappropriate edit cap requirement mapped by WP core map_meta_cap().  Problem with WP core is that it uses get_post_status() in WP_Query but not in map_meta_cap().
function _pp_flt_map_media_meta_cap( $caps, $cap, $user_id, $args ) {
	if ( ! empty($args[0]) ) {
		$post = ( is_object($args[0]) ) ? $args[0] : get_post( $args[0] );

		if ( $post && ( 'attachment' == $post->post_type ) ) {
			if ( ! empty($post->post_parent) )
				$post_status = get_post_status( $post->ID );
			elseif ( 'inherit' == $post->post_status )
				$post_status = ( pp_get_option( 'unattached_files_private' ) ) ? 'private' : 'publish';
			else
				$post_status = $post->post_status;
			
			$post_type = get_post_type_object( $post->post_type );
			$post_author_id = $post->post_author;
			
			$caps = array_diff( $caps, (array) $cap );
			
			switch ( $cap ) {
				case 'read_post':
				case 'read_page':
					$status_obj = get_post_status_object( $post_status );
					if ( $status_obj->public || ( $status_obj->private && ( $user_id == $post_author_id ) ) ) {
						$caps[] = $post_type->cap->read;
						break;
					}

					// If no author set yet, default to current user for cap checks.
					if ( ! $post_author_id )
						$post_author_id = $user_id;

					if ( $status_obj->private )
						$caps[] = $post_type->cap->read_private_posts;
					else
						$caps = map_meta_cap( 'edit_post', $user_id, $post->ID );
					
					$caps = apply_filters( 'pp_map_attachment_read_caps', $caps, $post, $user_id );
					
					break;
				default:
					require_once( dirname(__FILE__).'/media-edit-metacap-workaround_pp.php' );
				
					$args = array_merge( $args, compact( 'post', 'post_status', 'post_type', 'post_author_id' ) );
					$caps = _ppff_flt_map_media_edit_meta_cap( $caps, $cap, $user_id, $args );
			}
		}
	}
	
	return $caps;
}