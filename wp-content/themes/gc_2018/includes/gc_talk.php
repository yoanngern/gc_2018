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
