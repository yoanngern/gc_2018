<?php

/**
 * Create Doc
 */
function create_docs() {
	register_post_type( 'gc_doc',
		array(
			'labels'              => array(
				'name'          => __( 'Docs', 'gc_2018' ),
				'singular_name' => __( 'Doc', 'gc_2018' ),
				'add_new'       => __( 'Add a doc', 'gc_2018' ),
				'all_items'     => __( 'All docs', 'gc_2018' ),
				'add_new_item'  => __( 'Add New Doc', 'gc_2018' ),
				'edit_item'     => __( 'Edit Doc', 'gc_2018' ),
			),
			'public'              => true,
			'can_export'          => true,
			'show_ui'             => true,
			'_builtin'            => false,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'rewrite'             => array(
				"slug"       => "docs",
				'with_front' => false
			),
			'capability_type'     => 'post',
			'hierarchical'        => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-portfolio',
			'taxonomies'          => array( 'gc_doccategory', 'tag' ),
			'exclude_from_search' => false,
		)
	);
}

add_action( 'init', 'create_docs' );


/**
 * Talk taxonomy
 */
function create_doccategory_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Doc categories', 'taxonomy general name', 'gc_2018' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name', 'gc_2018' ),
		'search_items'               => __( 'Search Category', 'gc_2018' ),
		'popular_items'              => __( 'Popular Categories', 'gc_2018' ),
		'all_items'                  => __( 'All Categories', 'gc_2018' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category', 'gc_2018' ),
		'update_item'                => __( 'Update Category', 'gc_2018' ),
		'add_new_item'               => __( 'Add New Category', 'gc_2018' ),
		'new_item_name'              => __( 'New Category', 'gc_2018' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'gc_2018' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'gc_2018' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'gc_2018' ),
	);

	register_taxonomy( 'gc_doccategory', 'gc_doc', array(
		'label'        => __( 'Category', 'gc_2018' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'categories' ),
	) );
}

add_action( 'init', 'create_doccategory_taxonomy', 0 );

