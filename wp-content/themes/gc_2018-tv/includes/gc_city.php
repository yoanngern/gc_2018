<?php


/**
 * Create City
 */
function create_city() {
	register_post_type( 'gc_city',
		array(
			'labels'                => array(
				'name'          => __( 'Cities', 'gc_2018' ),
				'singular_name' => __( 'City', 'gc_2018' ),
				'add_new'       => __( 'Add a city', 'gc_2018' ),
				'all_items'     => __( 'All cities', 'gc_2018' ),
				'add_new_item'  => __( 'Add New City', 'gc_2018' ),
				'edit_item'     => __( 'Edit City', 'gc_2018' ),
			),
			'public'                => true,
			'can_export'            => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => 'city',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'_builtin'              => false,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array( "slug" => "city" ),
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'supports'              => array(
				'title',
			),
			'menu_icon'             => 'dashicons-location-alt',
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_city' );

/**
 * Update People
 *
 * @param $post_id
 *
 * function update_city( $post_id ) {
 *
 * $post_type = get_post_type( $post_id );
 *
 *
 * if ( $post_type != "gc_people" ) {
 * return;
 * }
 *
 * $my_post = array(
 * 'ID'         => $post_id,
 * 'post_title' => get_field( 'firstname', $post_id ) . " " . get_field( 'lastname', $post_id ),
 * );
 *
 *
 * // unhook this function so it doesn't loop infinitely
 * remove_action( 'save_post', 'update_people' );
 *
 * // update the post, which calls save_post again
 * wp_update_post( $my_post );
 *
 * // re-hook this function
 * add_action( 'save_post', 'update_people' );
 *
 *
 * }
 *
 * add_action( 'save_post', 'update_people' );
 */


