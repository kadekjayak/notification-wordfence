<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.kadekjayak.web.id
 * @since             1.0.0
 * @package           Notification_Wordfence
 *
 * @wordpress-plugin
 * Plugin Name:       Notification for WordFence
 * Plugin URI:        https://github.com/kadekjayak/notification-wordfence
 * Description:       Catch Wordfence email alert and send it to your notification channel (Slack or Telegram)
 * Version:           1.0.0
 * Author:            Kadek Jayak
 * Author URI:        https://www.kadekjayak.web.id
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       notification-wordfence
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
define( 'NOTIFICATION_WORDFENCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-notification-wordfence-activator.php
 */
function activate_notification_wordfence() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-notification-wordfence-activator.php';
	Notification_Wordfence_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-notification-wordfence-deactivator.php
 */
function deactivate_notification_wordfence() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-notification-wordfence-deactivator.php';
	Notification_Wordfence_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_notification_wordfence' );
register_deactivation_hook( __FILE__, 'deactivate_notification_wordfence' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-notification-wordfence.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_notification_wordfence() {

	$plugin = new Notification_Wordfence();
	$plugin->run();

}
run_notification_wordfence();
