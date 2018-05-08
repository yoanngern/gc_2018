<?php

/**
 * Class WPDribbble
 */
class WPDribbble {


	/**
	 * WPDribbble constructor.
	 */
	public function __construct() {
		add_shortcode( 'Dribbble', array( $this, 'shortcode' ) );
	}


	/**
	 *
	 */
	public function shortcode() {

	}
}

$wpDribbble = new WPDribbble();