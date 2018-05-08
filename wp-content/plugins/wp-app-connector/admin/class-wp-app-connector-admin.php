<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_App_Connector
 * @subpackage WP_App_Connector/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_App_Connector
 * @subpackage WP_App_Connector/admin
 * @author     Yoann Gern
 */
class WP_App_Connector_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_App_Connector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_App_Connector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-app-connector-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_App_Connector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_App_Connector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-app-connector-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Creates the menu item and calls on the menu Page object to render
	 * the actual contents of the page.
	 */
	public function add_plugin_admin_menu() {

		add_menu_page(
			__( 'WP App connector', 'wp_app_connector' ),
			__( 'App connector', 'wp_app_connector' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_plugin_settings_page' ), 'dashicons-controls-repeat'
		);


	}

	/**
	 * This function renders the contents of the page associated with the Submenu
	 * that invokes the render method. In the context of this plugin, this is the
	 * Submenu class.
	 */
	public function display_plugin_settings_page() {

		$console = "";

		if ( isset( $_POST['wp_app_connector_save'] ) ) {
			update_option( 'wp_app_connector_city', $_POST['wp_app_connector_city'] );
			update_option( 'wp_app_connector_state', $_POST['wp_app_connector_state'] );
			update_option( 'wp_app_connector_zip', $_POST['wp_app_connector_zip'] );
			update_option( 'wp_app_connector_street', $_POST['wp_app_connector_street'] );
			update_option( 'wp_app_connector_location', $_POST['wp_app_connector_location'] );
			//update_option( 'wp_app_connector_primary', $_POST['wp_app_connector_primary'] );


			$pco = new PlanningCenterOnlineAPI();


			$console = $pco->createAddress( '3902394', array(
				'city'     => $_POST['wp_app_connector_city'],
				'state'    => $_POST['wp_app_connector_state'],
				'zip'      => $_POST['wp_app_connector_zip'],
				'street'   => $_POST['wp_app_connector_street'],
				'location' => $_POST['wp_app_connector_location'],
				'primary'  => false,
			) );


			//$console = $pco->getAddress( '16461991');

		}


		if ( isset( $_POST['wp_app_connector_connect'] ) ) {


		}

		set_query_var( 'console', $console );
		include_once( 'partials/wp-app-connector-display-settings.php' );
	}

}
