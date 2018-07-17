<?php
function gc_tv_theme_enqueue_styles() {

	$parent_style = 'gc_2018-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style_v2.css', false, wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'gc_2018-tv-style',
		get_stylesheet_directory_uri() . '/style_v2.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'gc_tv_theme_enqueue_styles' );




require_once( __DIR__ . '/includes/gc_talk.php' );

require_once( __DIR__ . '/includes/gc_people.php' );

require_once( __DIR__ . '/includes/gc_city.php' );

require_once( __DIR__ . '/includes/acf_fields.php' );


function get_iframe_video( $iframe ) {

	if ( $iframe == null ) {
		return false;
	}

	// use preg_match to find iframe src
	preg_match( '/src="(.+?)"/', $iframe, $matches );
	$src = $matches[1];

	$params = array(
		'controls'       => 1,
		'hd'             => 1,
		'autohide'       => 1,
		'rel'            => 0,
		'showinfo'       => 0,
		'color'          => 'e52639',
		'title'          => 0,
		'byline'         => 0,
		'portrait'       => 0,
		'data-show-text' => 0
	);


	$new_src = add_query_arg( $params, $src );

	$video = str_replace( $src, $new_src, $iframe );

	$attributes = 'frameborder="0"';

	$iframe = str_replace( '></iframe>', ' ' . $attributes . 'class="video"></iframe>', $video );

	return $iframe;


}

function get_iframe_audio( $iframe ) {

	if ( $iframe == null ) {
		return false;
	}

	// use preg_match to find iframe src
	preg_match( '/src="(.+?)"/', $iframe, $matches );
	$src = $matches[1];

	$params = array(
		'color'         => 'e52639',
		'auto_play'     => false,
		'hide_related'  => true,
		'show_comments' => false,
		'show_user'     => false,
		'show_reposts'  => false,
		'show_teaser'   => false,
		'visual'        => true,
	);

	$height = '360px';
	$width  = '640px';


	$new_src = add_query_arg( $params, $src );

	$audio = str_replace( $src, $new_src, $iframe );

	$attributes = 'frameborder="no" scrolling="no"';

	$iframe = str_replace( '></iframe>', ' ' . $attributes . 'class="audio" width="640px" height="360px"></iframe>', $audio );

	$iframe = preg_replace( '/height="(.*?)"/i', 'height="' . $height . '"', $iframe );
	$iframe = preg_replace( '/width="(.*?)"/i', 'width="' . $width . '"', $iframe );

	return $iframe;


}