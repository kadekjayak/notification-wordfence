<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/admin
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
class Notification_Wordfence_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Plugin Settings Link
	 */
	public function plugin_action_links($actions, $plugin_file) { 
		
		$plugin = 'notification-wordfence/notification-wordfence.php';
		if  ($plugin == $plugin_file ) {

			$url = menu_page_url('WordfenceNotification', false);
		
			$settings = array('settings' => '<a href="' . $url . '">' . __('Settings', 'General') . '</a>');
			$actions = array_merge( $settings, $actions );

			return $actions;
		}
		
		return $actions; 

	}
	
	/**
	 * Admin Page Action
	 */
	public function admin_page(){

		$default_tab = null;
		$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
		include 'partials/notification-wordfence-admin-display.php';

	}

	/**
	 * Register Submenu
	 */
	public function register_submenu() {

		// Add Submenut to WordFence Menu
		add_submenu_page(
			"Wordfence", 
			'Notification', 
			'Notification', 
			"activate_plugins", 
			"WordfenceNotification", 
			[$this, 'admin_page']
		);

	}

	/**
	 * Update Plugin Configuration
	 */
	public function wf_notification_update_option() {

		$options = $this->get_default_setings();
		$tab_name = $_POST['tab_name'];
		$options = array_merge( $options, $_POST['data'] );

		if( $_POST['submit_test'] ) {
			$error_message = '';
			$transport_options = $options['transport'][ strtolower( $options['selected_transport'] ) ];
			$result = $this->test_transport( $options['selected_transport'], $transport_options );

			if( is_wp_error ( $result ) ) {
				$error_message = $result->get_error_message();
			} else {
				update_option('wf-notification-' . $tab_name, $options, false );
			}
			$redirect_url = add_query_arg( 'is_test', 1, wp_get_referer() );
			$redirect_url = add_query_arg( 'error_message', $error_message, $redirect_url );
			return wp_redirect( $redirect_url );
		}

		update_option('wf-notification-' . $tab_name, $options, false );

		return wp_redirect( wp_get_referer() );
		exit;

	}

	/**
	 * Test Selected Transport
	 * 
	 * @param String $transport
	 */
	private function test_transport( $transport, $options ) {

		$test_atts = [
			'subject' => 'Wordfence Notification Test',
			'message' => 'Test',
		];

		$transport = new Notification_Wordfence_Transport( $transport, $test_atts, $options );
		return $transport->send();

	}

	/**
	 * Get Default Settings
	 * 
	 * @return Array
	 */
	private function get_default_setings() {

		return [
			'enabled' => false,
			'selected_transport' => null,
		];

	}

	/**
	 * Get Tab Values
	 * 
	 * @return Array
	 */
	private function get_tab_values( $tab_name ) {

		return get_option('wf-notification-' . $tab_name);

	}

	/**
	 * Get Available Transports
	 * 
	 * @return Array
	 */
	private function get_available_transports() {

		return [
			'Slack', 
			'Telegram'
		];
		
	}

}
