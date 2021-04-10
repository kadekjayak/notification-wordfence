<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/public
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
class Notification_Wordfence_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Catch Wordfence Alert
	 * 
	 * @return Mixed
	 */
	public function catch_wordfence_alert( $return, $atts ) {

		$subject = $atts['subject'];

		// Skip if not a WordFence
		if ( strpos( $subject, '[Wordfence Alert]' ) === false ) {
			return $return;    
		}

		$transport = null;
		$option = [
			'enabled' => 0
		];

		if ( strpos( $subject, 'locked out' ) !== false ) {
			$option = get_option('wf-notification-locked-out');
		}

		if ( strpos( $subject, 'Login' ) !== false ) {
			$option = get_option('wf-notification-login-alert');
		}

		if ( @$option['enabled'] == 1 ) {
			$selected_transport = strtolower( $option['selected_transport'] );
			$transport_options = $option['transport'][ $selected_transport ];
			$transport = new Notification_Wordfence_Transport( $selected_transport, $atts, $transport_options );
			return $transport->send();
		}

		return $return;

	}

}