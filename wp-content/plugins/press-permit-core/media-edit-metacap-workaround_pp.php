<?php
function _ppff_flt_map_media_edit_meta_cap( $caps, $cap, $user_id, $args ) {
	$extra_args = array_intersect_key( $args, array_fill_keys( array( 'post', 'post_status', 'post_type', 'post_author_id' ), true ) );
	extract( $extra_args, EXTR_SKIP );
	
	switch ( $cap ) {
		case 'delete_post':
		case 'delete_page':
			// If no author set yet, default to current user for cap checks.
			if ( ! $post_author_id )
				$post_author_id = $user_id;

			// If the user is the author...
			if ( $user_id == $post_author_id ) {
				// If the post is published...
				if ( 'publish' == $post_status ) {
					$caps[] = $post_type->cap->delete_published_posts;
				} elseif ( 'trash' == $post_status ) {
					if ('publish' == get_post_meta($post->ID, '_wp_trash_meta_status', true) )
						$caps[] = $post_type->cap->delete_published_posts;
				} else {
					// If the post is draft...
					$caps[] = $post_type->cap->delete_posts;
				}
			} else {
				// The user is trying to edit someone else's post.
				$caps[] = $post_type->cap->delete_others_posts;
				// The post is published, extra cap required.
				if ( 'publish' == $post_status )
					$caps[] = $post_type->cap->delete_published_posts;
				elseif ( 'private' == $post_status )
					$caps[] = $post_type->cap->delete_private_posts;
			}
			break;
			// edit_post breaks down to edit_posts, edit_published_posts, or
			// edit_others_posts
		case 'edit_post':
		case 'edit_page':
			// If no author set yet, default to current user for cap checks.
			if ( ! $post_author_id )
				$post_author_id = $user_id;

			// If the user is the author...
			if ( $user_id == $post_author_id ) {
				// If the post is published...
				if ( 'publish' == $post_status ) {
					$caps[] = $post_type->cap->edit_published_posts;
				} elseif ( 'trash' == $post_status ) {
					if ('publish' == get_post_meta($post->ID, '_wp_trash_meta_status', true) )
						$caps[] = $post_type->cap->edit_published_posts;
				} else {
					// If the post is draft...
					$caps[] = $post_type->cap->edit_posts;
				}
			} else {
				// The user is trying to edit someone else's post.
				$caps[] = $post_type->cap->edit_others_posts;
				// The post is published, extra cap required.
				if ( 'publish' == $post_status )
					$caps[] = $post_type->cap->edit_published_posts;
				elseif ( 'private' == $post_status )
					$caps[] = $post_type->cap->edit_private_posts;
			}
			break;

		case 'publish_post':
			$caps[] = $post_type->cap->publish_posts;
			break;
		case 'edit_post_meta':
		case 'delete_post_meta':
		case 'add_post_meta':
			$caps = map_meta_cap( 'edit_post', $user_id, $post->ID );

			$meta_key = isset( $args[ 1 ] ) ? $args[ 1 ] : false;

			if ( $meta_key && has_filter( "auth_post_meta_{$meta_key}" ) ) {
				/**
				 * Filter whether the user is allowed to add post meta to a post.
				 *
				 * The dynamic portion of the hook name, $meta_key, refers to the
				 * meta key passed to map_meta_cap().
				 *
				 * @since 3.3.0
				 *
				 * @param bool   $allowed  Whether the user can add the post meta. Default false.
				 * @param string $meta_key The meta key.
				 * @param int    $post_id  Post ID.
				 * @param int    $user_id  User ID.
				 * @param string $cap      Capability name.
				 * @param array  $caps     User capabilities.
				 */
				$allowed = apply_filters( "auth_post_meta_{$meta_key}", false, $meta_key, $post->ID, $user_id, $cap, $caps );
				if ( ! $allowed )
					$caps[] = $cap;
			} elseif ( $meta_key && is_protected_meta( $meta_key, 'post' ) ) {
				$caps[] = $cap;
			}
			break;
		default:
			/*
			// Handle meta capabilities for custom post types.
			$post_type_meta_caps = _post_type_meta_capabilities();
			if ( isset( $post_type_meta_caps[ $cap ] ) ) {
				$args = array_merge( array( $post_type_meta_caps[ $cap ], $user_id ), $args );
				return call_user_func_array( 'map_meta_cap', $args );
			}
			*/

			// If no meta caps match, return the original cap.
			$caps[] = $cap;
	}

	return $caps;
}