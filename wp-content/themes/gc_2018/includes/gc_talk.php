<?php

/**
 * Create Talk
 */
function create_talks() {
	register_post_type( 'gc_talk',
		array(
			'labels'              => array(
				'name'          => __( 'Talks' ),
				'singular_name' => __( 'Talk' ),
				'add_new'       => 'Add a talk',
				'all_items'     => 'All talks',
				'add_new_item'  => 'Add New Talk',
				'edit_item'     => 'Edit Talk',
			),
			'public'              => true,
			'can_export'          => true,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'_builtin'            => false,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'rewrite'             => array(
				"slug"       => "talks",
				'with_front' => false
			),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_position'       => null,
			'supports'            => false,
			'menu_icon'           => 'dashicons-microphone',
			'taxonomies'          => array( 'gc_talkcategory', 'tag' ),
			'exclude_from_search' => false,
		)
	);
}

add_action( 'init', 'create_talks' );


/**
 * Talk taxonomy
 */
function create_talkcategory_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Category' ),
		'popular_items'              => __( 'Popular Categories' ),
		'all_items'                  => __( 'All Categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category' ),
		'update_item'                => __( 'Update Category' ),
		'add_new_item'               => __( 'Add New Category' ),
		'new_item_name'              => __( 'New Category' ),
		'separate_items_with_commas' => __( 'Separate categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories' ),
	);

	register_taxonomy( 'gc_talkcategory', 'gc_talk', array(
		'label'        => __( 'Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'categories' ),
	) );
}

add_action( 'init', 'create_talkcategory_taxonomy', 0 );


/**
 * Update Service
 *
 * @param $post_id
 */
function update_talk( $post_id ) {

	$post_type = get_post_type( $post_id );


	if ( $post_type != "gc_talk" ) {
		return;
	}


	$my_post = array(
		'ID'         => $post_id,
		'post_title' => date_i18n( get_option( 'date_format' ), strtotime( get_field( 'date', $post_id ) ) ),
	);


	// unhook this function so it doesn't loop infinitely
	remove_action( 'save_post', 'update_talk' );

	update_dates( $post_id );

	// update the post, which calls save_post again
	wp_update_post( $my_post );

	// re-hook this function
	add_action( 'save_post', 'update_talk' );


}

add_action( 'save_post', 'update_talk' );


/**
 * @param null $city
 * @param null $speaker
 * @param null $category
 *
 * @return array
 */
function get_talks( $nb = 12, $city = null, $speaker = null, $category = null ) {

	$meta_query = array(
		'relation' => 'AND',
	);

	$tax_query = array();


	if ( $city !== null ) {

		$meta_query[] = array(
			'key'     => 'city',
			'compare' => '=',
			'value'   => $city->ID,
		);

	}

	if ( $speaker !== null ) {

		$meta_query[] = array(
			'key'     => 'speaker',
			'compare' => 'LIKE',
			'value'   => $speaker->ID,
		);


	}


	if ( $category !== null ) {

		$tax_query[] = array(
			'taxonomy' => 'gc_talkcategory',
			'field'    => 'slug',
			'terms'    => $category->slug,
		);
	}


	$args = array(
		'posts_per_page' => $nb,
		'orderby'        => 'meta_value',
		'meta_key'       => 'date',
		'order'          => 'desc',
		'post_type'      => 'gc_talk',
		'tax_query'      => $tax_query,
		'meta_query'     => $meta_query

	);


	// The Query
	$query = new WP_Query( $args );

	$talks_return = $query->get_posts();

	/* Restore original Post Data */
	wp_reset_postdata();


	return $talks_return;

}