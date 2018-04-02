<?php


/**
 * Go_Live_Update_URLS_Pro_Styles
 *
 * @author Mat Lipe
 * @since  11/1/2017
 *
 */
class Go_Live_Update_URLS_Pro_Styles {

	protected function hook() {
		add_action( 'gluu_before_checkboxes', array( $this, 'admin_js' ) );
	}


	public function admin_js() {
		$js_dir = apply_filters( 'go-live-update-urls-pro/js-dir', Go_Live_Update_URLS_Pro_Factory::plugin_url( 'js/dist' ) );

		wp_enqueue_style( 'go-live-update-urls-pro/master-css', $js_dir . 'master.min.css', array(), GO_LIVE_UPDATE_URLS_PRO_VERSION );

		wp_enqueue_script( 'go-live-update-urls-pro/master-js', $js_dir . 'master.min.js', array( 'jquery' ), GO_LIVE_UPDATE_URLS_PRO_VERSION, true );

		wp_localize_script( 'go-live-update-urls-pro/master-js', 'GO_LIVE_UPDATE_URLS_PRO', $this->js_config() );

	}


	protected function js_config() {
		return array(
			'old_url' => '', //@todo hook into current url class with filter
			'new_url' => '', //@todo hook into current url class with filter
			'i18n'    => array(
				'could_not_run'            => esc_html__( 'Could not update test results at this time.', 'go-live-update-urls' ),
				'click_to_fix'             => esc_html__( 'Click to automatically fix New URL', 'go-live-update-urls' ),
				'close'                    => esc_html__( 'Close Results', 'go-live-update-urls' ),
				'fail'                     => esc_html__( 'Fail', 'go-live-update-urls' ),
				'fix'                      => esc_html__( 'Fix Issue', 'go-live-update-urls' ),
				'new_url'                  => esc_html__( 'New URL', 'go-live-update-urls' ),
				'old_url'                  => esc_html__( 'Old URL', 'go-live-update-urls' ),
				'pass'                     => esc_html__( 'Pass', 'go-live-update-urls' ),
				'something_wrong'          => esc_html__( 'Something went wrong.', 'go-live-update-urls' ),
				'test_button_instructions' => esc_html__( 'Clicking this button will run some tests against the entered Old URL and New URL.', 'go-live-update-urls' ) . "\n" . esc_html__( 'It will not make any changes to your site.', 'go-live-update-urls' ),
				'test_new_url'             => esc_html__( 'Test Change', 'go-live-update-urls' ),
				'test_results'             => esc_html__( 'Test Results', 'go-live-update-urls' ),
				'unknown'                  => esc_html__( 'Unable to test.', 'go-live-update-urls' ),
			),
			'actions' => array(
				'get_results' => Go_Live_Update_URLS_Pro_Tests_Ajax::ALL_RESULTS,
				'get_fixed'   => Go_Live_Update_URLS_Pro_Tests_Ajax::GET_FIXED,
			),
			'fields'  => array(
				'old_url' => Go_Live_Update_Urls_Admin_Page::OLD_URL,
				'new_url' => Go_Live_Update_Urls_Admin_Page::NEW_URL,
			),
		);
	}

	//********** SINGLETON **********/


	/**
	 * Instance of this class for use as singleton
	 */
	private static $instance;


	public static function init() {
		self::instance()->hook();
	}


	/**
	 * Get (and instantiate, if necessary) the instance of the
	 * class
	 *
	 * @static
	 * @return self
	 */
	public static function instance() {
		if ( ! is_a( self::$instance, __CLASS__ ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
