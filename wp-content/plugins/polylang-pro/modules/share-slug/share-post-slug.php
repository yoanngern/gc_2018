<?php

/**
 * Base class to manage shared slugs for posts
 *
 * @since 1.9
 */
class PLL_Share_Post_Slug {

	/**
	 * Constructor
	 *
	 * @since 1.9
	 *
	 * @param object $polylang
	 */
	public function __construct( &$polylang ) {
		$this->options = &$polylang->options;
		$this->model = &$polylang->model;
		$this->links_model = &$polylang->links_model;

		add_filter( 'wp_unique_post_slug', array( $this, 'wp_unique_post_slug' ), 10, 6 );
		add_action( 'pll_translate_media', array( $this, 'pll_translate_media' ), 20, 3 ); // After PLL_Admin_Sync to avoid reverse sync
	}

	/**
	 * Checks if the slug is unique within language.
	 * Thanks to @AndyDeGroo for https://wordpress.org/support/topic/plugin-polylang-identical-page-names-in-different-languages?replies=8#post-2669927
	 * Thanks to Ulrich Pogson for https://github.com/grappler/polylang-slug/blob/master/polylang-slug.php
	 *
	 * @since 1.9
	 *
	 * @param string $slug          The slug defined by wp_unique_post_slug in WP
	 * @param int    $post_ID
	 * @param string $post_status   Not used
	 * @param string $post_type     Post type
	 * @param int    $post_parent   Parent ID
	 * @param string $original_slug The original slug before it is modified by wp_unique_post_slug in WP
	 * @return string Original slug if it is unique in the language or the modified slug otherwise
	 */
	public function wp_unique_post_slug( $slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug ) {
		global $wpdb;

		// Return slug if it was not changed
		if ( $original_slug === $slug || 0 === $this->options['force_lang'] || ! $this->model->is_translated_post_type( $post_type ) ) {
			return $slug;
		}

		$lang = $this->model->post->get_language( $post_ID );

		if ( empty( $lang ) ) {
			return $slug;
		}

		if ( 'attachment' == $post_type ) {
			// Attachment slugs must be unique across all types.
			$sql = "SELECT post_name FROM {$wpdb->posts}";
			$sql .= $this->model->post->join_clause();
			$sql .= $wpdb->prepare( ' WHERE post_name = %s AND ID != %d', $original_slug, $post_ID );
			$sql .= $this->model->post->where_clause( $lang ) . ' LIMIT 1';
			$post_name_check = $wpdb->get_var( $sql );
		}

		elseif ( is_post_type_hierarchical( $post_type ) ) {
			// Page slugs must be unique within their own trees. Pages are in a separate namespace than posts so page slugs are allowed to overlap post slugs.
			$sql = "SELECT ID FROM {$wpdb->posts}";
			$sql .= $this->model->post->join_clause();
			$sql .= $wpdb->prepare( " WHERE post_name = %s AND post_type IN ( %s, 'attachment' ) AND ID != %d AND post_parent = %d", $original_slug, $post_type, $post_ID, $post_parent );
			$sql .= $this->model->post->where_clause( $lang ) . ' LIMIT 1';
			$post_name_check = $wpdb->get_var( $sql );
		}

		else {
			// Post slugs must be unique across all posts.
			$sql = "SELECT post_name FROM {$wpdb->posts}";
			$sql .= $this->model->post->join_clause();
			$sql .= $wpdb->prepare( ' WHERE post_name = %s AND post_type = %s AND ID != %d', $original_slug, $post_type, $post_ID );
			$sql .= $this->model->post->where_clause( $lang ) . ' LIMIT 1';
			$post_name_check = $wpdb->get_var( $sql );
		}

		return $post_name_check ? $slug : $original_slug;
	}

	/**
	 * Updates the attachment slug when creating a translation to allow to share slugs
	 * This second step is needed because wp_unique_post_slug is called before the language is set
	 *
	 * @since 1.9
	 *
	 * @param int $post_id original attachment id
	 * @param int $tr_id   translated attachment id
	 */
	public function pll_translate_media( $post_id, $tr_id ) {
		$post = get_post( $post_id );
		wp_update_post( array( 'ID' => $tr_id, 'post_name' => $post->post_name ) );
	}
}
