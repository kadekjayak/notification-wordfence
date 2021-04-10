<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/includes
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
class Notification_Wordfence_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'notification-wordfence',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
