<?php


/**
 * Create People
 */
function create_people() {
	register_post_type( 'gc_people',
		array(
			'labels'                => array(
				'name'          => __( 'People' ),
				'singular_name' => __( 'Person' ),
				'add_new'       => 'Add a person',
				'all_items'     => 'All people',
				'add_new_item'  => 'Add New Person',
				'edit_item'     => 'Edit Person',
			),
			'public'                => true,
			'can_export'            => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => 'people',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'_builtin'              => false,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array( "slug" => "people" ),
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'supports'              => false,
			'menu_icon'             => 'dashicons-businessman',
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_people' );

/**
 * Update People
 *
 * @param $post_id
 */
function update_people( $post_id ) {

	$post_type = get_post_type( $post_id );


	if ( $post_type != "gc_people" ) {
		return;
	}

	$my_post = array(
		'ID'         => $post_id,
		'post_title' => get_field( 'firstname', $post_id ) . " " . get_field( 'lastname', $post_id ),
	);


	// unhook this function so it doesn't loop infinitely
	remove_action( 'save_post', 'update_people' );

	// update the post, which calls save_post again
	wp_update_post( $my_post );

	// re-hook this function
	add_action( 'save_post', 'update_people' );


}

add_action( 'save_post', 'update_people' );


