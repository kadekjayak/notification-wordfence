<?php
    $tab_name = 'locked-out';
    $values = $this->get_tab_values( $tab_name );
?>

<form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
    <table class="form-table">
        <tbody>
            <tr>
                <th><?php echo __('Enable?', 'wordfence-notification'); ?></th>
                <td>
                    <label for="wf-notification-input-enabled">
                        <input id="wf-notification-input-enabled" type="checkbox" <?php echo ( $values['enabled'] == 1 ? 'checked' : '' ); ?> name="data[enabled]" value="1" class="regular-text" />
                        <?php echo __('Catch Locked Out Alert', 'wordfence-notification'); ?>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>

    <?php include 'transport-form.php'; ?>

    <input type="hidden" name="action" value="wf_notification_update_option">
    <input type="hidden" name="tab_name" value="<?php echo $tab_name; ?>">

    <?php
        submit_button( null, 'primary', 'submit', false );
        submit_button( __('Save & Test'), 'secondary', 'submit_test', false );
    ?>

</form>