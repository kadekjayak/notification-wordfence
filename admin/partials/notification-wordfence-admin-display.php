<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.kadekjayak.web.id
 * @since      1.0.0
 *
 * @package    Notification_Wordfence
 * @subpackage Notification_Wordfence/admin/partials
 */
?>

<div class="wrap">
    
    <h1>
        <?php echo esc_html( get_admin_page_title() ); ?>
    </h1>
    
    <nav class="nav-tab-wrapper">
        <a href="?page=WordfenceNotification" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">
            <?php echo __('About', 'notification-wordfence'); ?>
        </a>
        <a href="?page=WordfenceNotification&tab=locked-out-alert" class="nav-tab <?php if($tab==='locked-out-alert'):?>nav-tab-active<?php endif; ?>">
            <?php echo __('Locked Out Alert', 'notification-wordfence'); ?>
        </a>
        <a href="?page=WordfenceNotification&tab=login-alert" class="nav-tab <?php if($tab==='login-alert'):?>nav-tab-active<?php endif; ?>">
            <?php echo __('Login Alert', 'notification-wordfence'); ?>
        </a>
    </nav>

    <!-- Notice -->
    <?php if( $_GET['is_test'] == 1 ) : ?>
        <?php if( @$_GET['error_message'] ) : ?>
            <div class="notice notice-error">
                <p><strong>Error while sending the message</strong></p>
                <p><?php echo @$_GET['error_message']; ?></p>
            </div>
        <?php else : ?>
            <div class="notice notice-success">
                <p><strong>Sending Message success</strong></p>
                <p>Please check your notification channel to make sure the message is delivered</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="tab-content">
        <?php 
            switch($tab) :
                case 'login-alert':
                    include_once 'tab-login-alert.php';
                    break;
                case 'locked-out-alert':
                    include_once 'tab-locked-out.php';
                    break;
                default:
                    include_once 'tab-about.php';
                    break;
            endswitch; 
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(function( $ ){
        $('#wf-notification-transport-options').on('change', function( e ){
            var value = $(this).val();

            $('.wf-notification-transport').removeClass('show');
            if ( value ) {
                $('.wf-notification-transport.' + value.toLowerCase() ).addClass('show');
            }
        });
    });
</script>

<style type="text/css">
    .wf-notification-transport {
        display: none;
    }
    
    .wf-notification-transport.show {
        display: table;
    }
</style>