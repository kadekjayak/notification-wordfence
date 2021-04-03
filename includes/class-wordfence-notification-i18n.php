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
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
class Wordfence_Notification_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wordfence-notification',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
