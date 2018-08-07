<?php

/**
 * Create Talk
 */
function create_talks() {
	register_post_type( 'gc_talk',
		array(
			'labels'              => array(
				'name'          => __( 'Talks', 'gc_2018' ),
				'singular_name' => __( 'Talk', 'gc_2018' ),
				'add_new'       => __( 'Add a talk', 'gc_2018' ),
				'all_items'     => __( 'All talks', 'gc_2018' ),
				'add_new_item'  => __( 'Add New Talk', 'gc_2018' ),
				'edit_item'     => __( 'Edit Talk', 'gc_2018' ),
			),
			'public'              => true,
			'can_export'          => true,
			'show_ui'             => true,
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
		'name'                       => _x( 'Categories', 'taxonomy general name', 'gc_2018' ),
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
 * Service column
 *
 * @param $columns
 *
 * @return array
 */
function gc_talk_column( $columns ) {

	$columns = array(
		'cb'            => '<input type="checkbox" />',
		//'title'           => 'Date',
		'talk_date_col' => __( 'Date', 'gc_2018' ),
		'talk_city_col' => __( 'City', 'gc_2018' ),
		'talk_speaker'  => __( 'Speaker', 'gc_2018' ),

	);

	return $columns;
}

add_filter( 'manage_edit-gc_talk_columns', 'gc_talk_column' );


/**
 * Service column content
 *
 * @param $column
 */
function gc_talk_custom_column( $column ) {
	global $post;

	$date = get_field( 'date', $post );

	if ( $column == 'talk_city_col' ) {

		$city_id = get_field( 'city', $post );

		$city = get_post( $city_id );

		if ( $city ) {
			echo $city->post_title;
		} else {
			echo "-";
		}

	} elseif ( $column == 'talk_date_col' ) {

		$id = $post->ID;

		$txt = date_i18n( get_option( 'date_format' ), strtotime( $date ) );

		echo "<a class='row-title' href='/wp-admin/post.php?post=$id&action=edit'>$txt</a>";


	} elseif ( $column == 'talk_speaker' ) {

		$speaker = get_field( 'speaker', $post );


		if ( $speaker ) {

			echo $speaker->post_title . "<br/>";
		} else {
			echo "-";
		}


	}
}

add_action( "manage_posts_custom_column", "gc_talk_custom_column" );

/**
 * @param $columns
 *
 * @return mixed
 */
function gc_talk_sort_column( $columns ) {
	$columns['talk_date_col'] = 'date';

	//To make a column 'un-sortable' remove it from the array
	//unset($columns['date']);

	return $columns;
}

add_filter( 'manage_edit-gc_talk_sortable_columns', 'gc_talk_sort_column' );


/**
 * Order Talk
 *
 * @param $query
 *
 * @return mixed
 */
function gc_order_talk( $query ) {


	if ( ! is_single() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == 'gc_talk' ) {


		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'date' );
		$query->set( 'order', 'desc' );


		if ( $query->is_main_query() ) {
			$query->set( 'posts_per_page', 24 );
		}


		if ( is_archive() ) {

			$meta_query = array(
				'relation' => 'AND',
			);

			$tax_query = array();

			if ( isset( $_GET['speaker'] ) ) {

				$meta_query[] = array(
					'key'     => 'speaker',
					'compare' => '=',
					'value'   => $_GET['speaker'],
				);

			}


			if ( isset( $_GET['city'] ) ) {

				$meta_query[] = array(
					'key'     => 'city',
					'compare' => '=',
					'value'   => $_GET['city'],
				);

			}


			if ( isset( $_GET['category'] ) ) {

				$tax_query[] = array(
					'taxonomy' => 'gc_talkcategory',
					'field'    => 'slug',
					'terms'    => $_GET['category'],
				);
			}

			$query->set( 'meta_query', $meta_query );

			$query->set( 'tax_query', $tax_query );


		}


		return $query;


	}

	return $query;


}

add_action( 'pre_get_posts', 'gc_order_talk' );


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
		'post_name'  => $post_id
	);


	// unhook this function so it doesn't loop infinitely
	remove_action( 'save_post', 'update_talk' );


	if ( get_field( 'video', $post_id ) ) {

		update_service_picture( $post_id );

	}


	// update the post, which calls save_post again
	wp_update_post( $my_post );

	// re-hook this function
	add_action( 'save_post', 'update_talk' );


}

add_action( 'save_post', 'update_talk' );


function update_service_picture( $post_id ) {

	$talk_picture = get_field( 'talk_picture', $post_id );

	if ( $talk_picture == null ) {

		$video = get_field( 'video', false, false );

		$image_url = "";

		if ( videoType( $video ) == 'vimeo' ) {

			if ( preg_match( '%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video, $regs ) ) {
				$id = $regs[3];
			}

			$image_url = getVimeoThumb( $id );
		}


		if ( videoType( $video ) == 'youtube' ) {


			if ( preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video, $regs ) ) {
				$id = $regs[0];
			}

			$image_url = getYoutubeThumb( $id );
		}

		if ( $image_url != "" ) {
			$upload_file = crb_insert_attachment_from_url( $image_url, $post_id );

			update_field( 'talk_picture', $upload_file, $post_id );
		}


	}

}


function getYoutubeThumb( $id ) {

	$image_url = "https://img.youtube.com/vi/$id/maxresdefault.jpg";

	return $image_url;

}


function getVimeoThumb( $id ) {

	$url = "http://vimeo.com/api/v2/video/$id.php";

	$vimeo = wp_remote_get( $url );

	$image = unserialize( $vimeo['body'] )[0]['thumbnail_large'];

	$image_url = str_replace( "640.jpg", "1080.jpg", $image );

	return $image_url;
}


/**
 * Insert an attachment from an URL address.
 *
 * @param  String $url
 * @param  Int $post_id
 * @param  Array $meta_data
 *
 * @return Int    Attachment ID
 */
function crb_insert_attachment_from_url( $url, $post_id = null ) {

	if ( ! class_exists( 'WP_Http' ) ) {
		include_once( ABSPATH . WPINC . '/class-http.php' );
	}

	$http     = new WP_Http();
	$response = $http->request( $url );
	if ( $response['response']['code'] != 200 ) {
		return false;
	}

	$upload = wp_upload_bits( basename( $url ), null, $response['body'] );
	if ( ! empty( $upload['error'] ) ) {
		return false;
	}

	$file_path        = $upload['file'];
	$file_name        = basename( $file_path );
	$file_type        = wp_check_filetype( $file_name, null );
	$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
	$wp_upload_dir    = wp_upload_dir();

	$post_info = array(
		'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
		'post_mime_type' => $file_type['type'],
		'post_title'     => $attachment_title,
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $post_info, $file_path, $post_id );

	// Include image.php
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $attach_id;

}


function videoType( $url ) {
	if ( strpos( $url, 'youtube' ) > 0 ) {
		return 'youtube';
	} elseif ( strpos( $url, 'vimeo' ) > 0 ) {
		return 'vimeo';
	} else {
		return 'unknown';
	}
}


/**
 * @param int $nb
 * @param null $city
 * @param null $speaker
 * @param null $category
 *
 * @param null $exclude
 *
 * @return array
 */
function get_talks( $nb = 12, $city = null, $speaker = null, $category = null, $exclude = null ) {

	$meta_query = array(
		'relation' => 'AND',
	);

	$tax_query = array();


	if ( $speaker !== null ) {

		$meta_query[] = array(
			'key'     => 'speaker',
			'compare' => '=',
			'value'   => $speaker->ID,
		);

	}


	if ( $city !== null ) {

		$meta_query[] = array(
			'key'     => 'city',
			'compare' => '=',
			'value'   => $city->ID,
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
		'post__not_in'   => $exclude,
		'meta_key'       => 'date',
		'order'          => 'desc',
		'post_type'      => 'gc_talk',
		'tax_query'      => $tax_query,
		'meta_query'     => $meta_query,

	);


	// The Query
	$query = new WP_Query( $args );

	$talks_return = $query->get_posts();

	/* Restore original Post Data */
	wp_reset_postdata();


	return $talks_return;

}