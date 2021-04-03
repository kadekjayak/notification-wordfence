<?php

/**
 * Handle Notification Transports
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 */

/**
 * Handle Notification Transports
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */

require_once 'transports/class-wordfence-notification-transport-slack.php';
require_once 'transports/class-wordfence-notification-transport-telegram.php';

class Wordfence_Notification_Transport {

	/**
	 * @var Transport
	 */
	public $transport;

	/**
	 * Construct
	 * 
	 * @var String $transport_name
	 * @var null|Array $atts
	 */
	public function __construct( $transport_name, $atts = null, $transport_options = null )  {
		$this->transport = $this->resolve_transport( $transport_name, $atts, $transport_options );
		$this->transport->atts = $atts;
	}

	/**
	 * Resolve Transport Class
	 * 
	 * @param String $transport_name
	 * @return Transport
	 */
	private function resolve_transport( $transport_name, $atts, $transport_options ) {
		$class_name = 'Wordfence_Notification_Transport_' . ucfirst( $transport_name );
		return new $class_name( $atts, $transport_options );
	}

	/**
	 * Call Function on Transport Object
	 * 
	 * @return Mixed
	 */
	public function __call( $method, $args ) {
        return call_user_func_array( [ $this->transport, $method ], $args );
    }

}
