<?php

/**
 *
 * @link              http://example.com/
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Check if your are in local or production environment
 */
$is_local = isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1');

/**
 * If you are in local environment, you can use the version number as a timestamp for better cache management in your browser
 */
$version  = $is_local ? time() : '1.0.0';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', $version );

/**
 * You can use this const for check if you are in local environment
 */
define( 'PLUGIN_NAME_DEV_MOD', $is_local );

/**
 * Plugin Name text domain for internationalization.
 */
define( 'PLUGIN_NAME_TEXT_DOMAIN', 'plugin-name' );

/**
 * Plugin Name Path for plugin includes.
 */
define( 'PLUGIN_NAME_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin Name URL for plugin sources (css, js, images etc...).
 */
define( 'PLUGIN_NAME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
register_activation_hook( __FILE__, function(){
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clean-my-wordpress-activator.php';
	Plugin_Name_Activator::activate();
} );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
register_deactivation_hook( __FILE__, function(){
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clean-my-wordpress-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
} );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name_to_replace() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_plugin_name_to_replace();
