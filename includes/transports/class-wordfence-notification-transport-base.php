<?php

/**
 * Base class for Wordfence Notification Transport
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes/transports
 */

/**
 * Handle Notification Transports
 * 
 * All notification transport should extend this base class
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes/transports
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */
abstract class Wordfence_Notification_Transport_Base {
    
    /**
     * @var Array
     */
    public $atts = null;

    /**
     * @var Array
     */
    public $options = null;

    /**
     * Construct
     * 
     * @param null|Array $atts
     */
    public function __construct( $atts = null, $transport_options = null ) {
        $this->atts = $atts;
        $this->options = $transport_options;
    }

    /**
     * Extract Data from WordFence Email Body
     * 
     * @param String $body
     * @return Array
     */
    public function get_locked_out_message_data() {

        $body = $this->atts['message'];

        $data_pattern_map = [
            'ip' => '/User IP: (.*)/',
            'hostname' => '/User hostname: (.*)/',
            'location' => '/User location: (.*)/',

            'username' => '/The last username they tried to sign in with was: \'(.*)\'/',
            'reason' => '/the following reason: ([a-zA-Z0-9 \:]+)\./',
            'duration' => '/The duration of the lockout is (.*)\./'
        ];

        $result = [];

        foreach( $data_pattern_map as $key => $pattern ) {
            $result[ $key ] = null;
            if ( preg_match( $pattern, $body, $output_array ) ) {
                if ( count( $output_array ) == 2 ) {
                    $result[ $key ] = $output_array['1'];
                }
            }
        }

        return $result;

    }
    
    /**
     * Is Locked Out Alert
     * 
     * @return Boolean
     */
    public function is_locked_out_alert() {
        return strpos( $this->atts['subject'], 'locked out' ) !== false;
    }

    /**
     * Is Login Alert
     * 
     * @return Boolean
     */
    public function is_login_alert() {
        return strpos( $this->atts['subject'], 'Login' ) !== false;
    }


    /**
     * Send Alert
     * 
     * @return Mixed | WP_Error
     */
    public function send() {

    }
}

