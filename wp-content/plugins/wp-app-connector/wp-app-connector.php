<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           WP_App_Connector
 *
 * @wordpress-plugin
 * Plugin Name:       WP App connector
 * Description:       This connector is a bridge between Apps
 * Version:           1.0.0
 * Author:            Yoann Gern
 * Author URI:        http://gerny-media.ch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_app_connector
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(session_id() == '')
	session_start();

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_APP_CONNECTOR_VERSION', '1.0.0' );
define( 'WP_APP_CONNECTOR_PATH', plugin_dir_path( __FILE__ ) );

include( WP_APP_CONNECTOR_PATH . '/includes/lib/httpclient/http.php' );
include( WP_APP_CONNECTOR_PATH . '/includes/lib/oauth-api/oauth_client.php' );

/**
 * Register class name of modules
 */
$wp_app_connector_modules = array( 'WPPlanningCenterOnline', );


/**
 * Include all of the modules files
 */
foreach ( glob( dirname( __FILE__ ) . "/includes/modules/*.*" ) as $filename ) {
	require_once $filename;
}

/**
 * Include all of the API files
 */
foreach ( glob( dirname( __FILE__ ) . "/includes/api/*.*" ) as $filename ) {
	require_once $filename;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-app-connector-activator.php
 */
function activate_wp_app_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-app-connector-activator.php';
	WP_App_Connector_Activator::activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-app-connector-deactivator.php
 */
function deactivate_wp_app_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-app-connector-deactivator.php';
	WP_App_Connector_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'activate_wp_app_connector' );
register_deactivation_hook( __FILE__, 'deactivate_wp_app_connector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-app-connector.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_app_connector() {

	$plugin = new WP_App_Connector();
	$plugin->run();

}

run_wp_app_connector();