<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
class Wordfence_Notification_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( ! is_plugin_active('wordfence/wordfence.php') ) {
			echo 'Please activate Wordfence plugin first!';
    		die;
		}
		
	}

}
