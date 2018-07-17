<?php
function gc_city_theme_enqueue_styles() {

	$parent_style = 'gc_2018-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style_v2.css', false, wp_get_theme()->get('Version') );
	wp_enqueue_style( 'gc_2018-city-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'gc_city_theme_enqueue_styles' );


require_once( __DIR__ . '/options.php' );

require_once( __DIR__ . '/includes/gc_service.php' );

require_once( __DIR__ . '/includes/gc_event.php' );

require_once( __DIR__ . '/includes/gc_location.php' );

require_once( __DIR__ . '/includes/acf_fields.php' );