<?php

/**
 * Create Doc
 */
function create_docs() {
	register_post_type( 'gc_doc',
		array(
			'labels'              => array(
				'name'          => __( 'Docs' ),
				'singular_name' => __( 'Doc' ),
				'add_new'       => 'Add a doc',
				'all_items'     => 'All docs',
				'add_new_item'  => 'Add New Doc',
				'edit_item'     => 'Edit Doc',
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
		'name'                       => _x( 'Doc categories', 'taxonomy general name' ),
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

	register_taxonomy( 'gc_doccategory', 'gc_doc', array(
		'label'        => __( 'Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'categories' ),
	) );
}

add_action( 'init', 'create_doccategory_taxonomy', 0 );

