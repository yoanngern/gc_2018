<?php

/**
 * Create Event
 */
function create_events() {
	register_post_type( 'gc_event',
		array(
			'labels'              => array(
				'name'          => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'add_new'       => 'Add an event',
				'all_items'     => 'All events',
				'add_new_item'  => 'Add New Event',
				'edit_item'     => 'Edit Event',
			),
			'public'              => true,
			'can_export'          => true,
			'show_ui'             => true,
			'_builtin'            => false,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'rewrite'             => array(
				"slug"       => "events",
				'with_front' => false
			),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_position'       => null,
			'supports'            => false,
			'menu_icon'           => 'dashicons-calendar-alt',
			'taxonomies'          => array( 'gc_eventcategory' ),
			'exclude_from_search' => false,
		)
	);
}

add_action( 'init', 'create_events' );


/**
 * Event taxonomy
 */
function create_eventcategory_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Event categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Event category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Categories' ),
		'popular_items'              => __( 'Popular Categories' ),
		'all_items'                  => __( 'All event categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category' ),
		'update_item'                => __( 'Update Category' ),
		'add_new_item'               => __( 'Add New Category' ),
		'new_item_name'              => __( 'New Category Name' ),
		'separate_items_with_commas' => __( 'Separate categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories' ),
	);

	register_taxonomy( 'gc_eventcategory', 'gc_event', array(
		'label'        => __( 'Event Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'description' => null,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'event-category' ),
	) );
}

add_action( 'init', 'create_eventcategory_taxonomy', 0 );


/**
 *
 */
function gc_event_remove_custom_taxonomy() {
	remove_meta_box( 'gc_eventcategorydiv', 'gc_event', 'side' );

	// $custom_taxonomy_slug is the slug of your taxonomy, e.g. 'genre' )
	// $custom_post_type is the "slug" of your post type, e.g. 'movies' )
}

add_action( 'admin_menu', 'gc_event_remove_custom_taxonomy' );





/**
 * Update Event
 *
 * @param $post_id
 */
function update_event( $post_id ) {


	$post_type = get_post_type( $post_id );


	if ( ( $post_type != "gc_event" ) || ( empty( $_POST ) ) ) {
		return $post_id;
	}

	$cat = get_the_terms( $post_id, array( 'taxonomy' => 'gc_eventcategory' ) )[0];

	$event_title = get_field( 'event_title', $post_id );

	if ( $event_title == null ) {
		$title = $cat->name;
	} else {
		$title = $event_title;
	}


	$my_post = array(
		'ID'         => $post_id,
		'post_title' => $title,
	);


	// unhook this function so it doesn't loop infinitely
	remove_action( 'save_post', 'update_event' );

	update_dates( $post_id );

	// update the post, which calls save_post again
	wp_update_post( $my_post );

	// re-hook this function
	add_action( 'save_post', 'update_event' );


}

add_action( 'save_post', 'update_event' );


/**
 * Event column
 *
 * @param $columns
 *
 * @return array
 */
function gc_event_column( $columns ) {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		//'title'      => 'Title',
		'event_title' => 'Title',
		'event_date'  => 'Date',
		'event_time'  => 'Time',
		'category'    => 'Category',


	);

	return $columns;
}

add_filter( 'manage_edit-gc_event_columns', 'gc_event_column' );


/**
 * Event column content
 *
 * @param $column
 */
function gc_event_custom_column( $column ) {
	global $post;

	$curr_cat = get_query_var( "gc_eventcategory" );

	$start = get_field( 'start', $post );
	$end   = get_field( 'end', $post );

	$start_o = new DateTime( $start );
	$end_o   = new DateTime( $end );

	$start_t = $start_o->getTimestamp();
	$end_t   = $end_o->getTimestamp();

	if ( $column == "event_title" ) {

		$id = $post->ID;

		$txt = get_the_title();

		echo "<a class='row-title' href='/wp-admin/post.php?post=$id&action=edit'>$txt</a>";

	} elseif ( $column == 'event_date' ) {

		echo complex_date( $start, $end );

		//echo date_i18n( get_option( 'date_format' ), strtotime( get_field( 'start_date', $post ) ) );

	} elseif ( $column == 'event_time' ) {

		if ( date( 'H:i', $start_t ) != '00:00' ) {

			if ( date( 'H:i', $start_t ) != date( 'H:i', $end_t ) ) {
				echo time_trans( $start_o ) . " - " . time_trans( $end_o );
			} else {
				echo time_trans( $start_o );
			}
		}

	} elseif ( $column == 'category' ) {

		foreach ( get_the_terms( $post, array( 'taxonomy' => 'gc_eventcategory' ) ) as $cat ) {

			$name  = $cat->name;
			$slug  = $cat->slug;
			$class = "";

			if ( $curr_cat == $slug ) {
				$class = 'current';
			}

			echo "<a class='$class' href='edit.php?post_type=gc_event&gc_eventcategory=$slug'>$name</a>";


		}

	}
}

add_action( "manage_posts_custom_column", "gc_event_custom_column" );


/**
 * @param $columns
 *
 * @return mixed
 */
function gc_event_sort_column( $columns ) {
	$columns['event_date'] = 'event_date';

	return $columns;
}

add_filter( 'manage_edit-gc_event_sortable_columns', 'gc_event_sort_column' );


/**
 * Order Event
 *
 * @param $query
 *
 * @return mixed
 */
function gc_order_events( $query ) {

	$post_status = $_GET['post_status'];

	if ( $post_status == '' ) {
		$post_status = 'all';
	}

	$query = order_dates( $query, 'gc_event', 'gc_eventcategory', $post_status );

	return $query;


}

add_action( 'pre_get_posts', 'gc_order_events' );


