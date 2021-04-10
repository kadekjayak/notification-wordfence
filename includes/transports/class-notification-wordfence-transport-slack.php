<?php

/**
 * Slack Notification Transport
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/includes/transports
 */

/**
 * Slack Notification Transport
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/includes/transports
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */

require_once 'class-notification-wordfence-transport-base.php';

class Notification_Wordfence_Transport_Slack extends Notification_Wordfence_Transport_Base {

    /**
     * Send Message
     * 
     * @return WP_Error|Mixed
     */
    public function send() {

        $hook_url = $this->options['url'];
        $data = [
            "username" => $this->options['username'], 
            "channel" => $this->options['channel']
        ];
    
        $mail_data = $this->get_message_data();
    
        $data['text'] = str_replace( '[Wordfence Alert]', '',  $this->atts['subject'] );
    
        $fields = [
            [
                'title' => 'IP Address', 
                'value' => $mail_data['ip'], 
                'short' => TRUE
            ],
            [
                'title' => 'Hostname', 
                'value' => $mail_data['hostname'], 
                'short' => TRUE
            ],
            [
                'title' => 'Location',  
                'value' => $mail_data['location'], 
                'short' => TRUE
            ],
        ];

        if ( $this->is_locked_out_alert() ) {
            $fields = array_merge( $fields, [
                [
                    'title' => 'Username', 
                    'value' => $mail_data['username'], 
                    'short' => TRUE
                ],
                [
                    'title' => 'Lockout Duration', 
                    'value' => $mail_data['duration'], 
                    'short' => TRUE
                ],
            ]);
        }
    
        $data['attachments'][] = [
            'fallback' => $mail_data['reason'],
            'title' => $mail_data['reason'],
            'color' => 'danger',
            'fields' => $fields,
        ];

        $params = [
            'method'      => 'POST',
            'timeout'     => 15,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => [
                'Content-Type' => 'application/json'
            ],
            'body'        => json_encode( $data )
        ];

        $result = wp_remote_post( $hook_url, $params );

        if( is_wp_error( $result ) ) {
            return $result;
        }

        if( $result['response']['code'] != 200 ) {
            return new WP_Error( $result['response']['code'], $result['response']['message'], $result['response']['body'] );
        }

        return $result;

    }    

}