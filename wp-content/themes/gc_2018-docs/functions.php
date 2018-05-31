<?php
function my_theme_enqueue_styles() {

	$parent_style = 'gc_2018-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'gc_2018-docs-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if (isset($user->roles) && is_array($user->roles)) {
		//check for subscribers
		if (in_array('pasteur', $user->roles)) {
			// redirect them to another URL, in this case, the homepage
			$redirect_to =  home_url();
		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

require_once( __DIR__ . '/includes/gc_doc.php' );

require_once( __DIR__ . '/includes/acf_fields.php' );