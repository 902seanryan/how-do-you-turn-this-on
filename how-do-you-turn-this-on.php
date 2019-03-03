<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              902seanryan.com
 * @since             1.0.0
 * @package           How_Do_You_Turn_This_On
 *
 * @wordpress-plugin
 * Plugin Name:       How Do You Turn This On
 * Plugin URI:        https://wordpress.org
 * Description:       Displays information (units, structures, etc) from the classic PC game Age of Empires II.
 * Version:           1.0.0
 * Author:            Sean Ryan
 * Author URI:        902seanryan.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       how-do-you-turn-this-on
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HOW_DO_YOU_TURN_THIS_ON_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-how-do-you-turn-this-on-activator.php
 */
function activate_how_do_you_turn_this_on() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-how-do-you-turn-this-on-activator.php';
	How_Do_You_Turn_This_On_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-how-do-you-turn-this-on-deactivator.php
 */
function deactivate_how_do_you_turn_this_on() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-how-do-you-turn-this-on-deactivator.php';
	How_Do_You_Turn_This_On_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_how_do_you_turn_this_on' );
register_deactivation_hook( __FILE__, 'deactivate_how_do_you_turn_this_on' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-how-do-you-turn-this-on.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_how_do_you_turn_this_on() {

	$plugin = new How_Do_You_Turn_This_On();
	$plugin->run();

}
run_how_do_you_turn_this_on();
