<?php

/**
 * Telegram Notification Transport
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes/transports
 */

/**
 * Telegram Notification Transport
 *
 * @package    Wordfence_Notification
 * @subpackage Wordfence_Notification/includes/transports
 * @author     Kadek Jayak <kadekjayak@yahoo.co.id>
 */

require_once 'class-wordfence-notification-transport-base.php';

class Wordfence_Notification_Transport_Telegram extends Wordfence_Notification_Transport_Base {

    /**
     * Send Message
     * 
     * @return WP_Error|Array
     */
    public function send()
    {
        $hook_url = 'https://api.telegram.org/bot' . $this->options['token'] . '/sendMessage';
        $data = [
            'chat_id' => $this->options['chat_id'],
            'parse_mode' => 'html',
            'text' => ''
        ];
        
        $subject = str_replace( '[Wordfence Alert]', '',  $this->atts['subject'] );
        $data['text'] = "
<b>{$subject}</b>

<b>IP Addres</b>
{$mail_data['ip']}

<b>Hostname</b>
{$mail_data['hostname']}

<b>Location</b>
{$mail_data['location']}
        ";

        if ( $this->is_locked_out_alert() ) {
            $data['text'] .= "
<b>Reason</b>
{$mail_data['Lockout Duration']}

<b>Username</b>
{$mail_data['username']}

<b>Lockout Duration</b>
{$mail_data['duration']}
            ";
        }

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