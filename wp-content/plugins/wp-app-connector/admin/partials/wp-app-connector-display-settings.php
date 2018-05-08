<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_App_Connector
 * @subpackage WP_App_Connector/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">
    <h1 class="wp-heading-inline">WP App connector</h1>
    <a class="page-title-action"
       href="<?php echo admin_url( '/admin-post.php?action=api_connect&api=planningcenteronline' ); ?>">Connect to
        PCO</a>
    <a class="page-title-action" href="<?php echo admin_url( '/admin-post.php?action=api_connect&api=facebook' ); ?>">Connect
        to Facebook</a>

    <hr class="wp-header-end">

    <form method="post" action="<?php echo admin_url( 'admin.php?page=wp-app-connector' ); ?>">
		<?php settings_fields( 'wp_app_connector_settings' ); ?>
        <h2>Create a new address</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">City</th>
                <td><input type="text" name="wp_app_connector_city"
                           value="<?php echo get_option( 'wp_app_connector_city' ); ?>"/>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">State</th>
                <td><input type="text" name="wp_app_connector_state"
                           value="<?php echo get_option( 'wp_app_connector_state' ); ?>"/></td>
            </tr>

            <tr valign="top">
                <th scope="row">Zip</th>
                <td><input type="text" name="wp_app_connector_zip"
                           value="<?php echo get_option( 'wp_app_connector_zip' ); ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row">Street</th>
                <td><input type="text" name="wp_app_connector_street"
                           value="<?php echo get_option( 'wp_app_connector_street' ); ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row">Location</th>
                <td><input type="text" name="wp_app_connector_location"
                           value="<?php echo get_option( 'wp_app_connector_location' ); ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row">Primary</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span>Primary</span>
                        </legend>
                        <label for="wp_app_connector_primary">
                            <input type="checkbox" name="wp_app_connector_primary"
                                   value="<?php echo get_option( 'wp_app_connector_primary' ); ?>">Primary
                        </label>
                    </fieldset>
                </td>
            </tr>
        </table>

        <p class="submit">

            <input name="wp_app_connector_save" type="submit" class="button-primary"
                   value="<?php _e( 'Save Changes' ) ?>"/>
        </p>

    </form>

	<?php if ( $console != null ): ?>
        <h3>Console</h3>

        <pre><?php var_dump($console) ?></pre>
	<?php endif; ?>

</div>
