<?php 
    $slack = @$values['transport']['slack'];
    $telegram = @$values['transport']['telegram'];
?>

<table class="form-table">
    <tbody>
        <tr>
            <th><?php echo __('Transport', 'wordfence-notification'); ?></th>
            <td>
                <select id="wf-notification-transport-options" name="data[selected_transport]">
                    <option value=""><?php echo __('Choose Transport', 'wordfence-notification'); ?></option>
                    <?php foreach( $this->get_available_transports() as $transport ) : ?>
                        <option <?php echo ($transport == $values['selected_transport'] ? 'selected' : ''); ?> value="<?php echo $transport; ?>">
                            <?php echo $transport; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </tbody>
</table>

<table class="form-table wf-notification-transport slack <?php echo ( @strtolower( $values['selected_transport'] ) == 'slack') ? 'show' : ''; ?> ">
    <tbody>
        
        <tr>
            <th><?php echo __('Hook URL', 'wordfence-notification'); ?></th>
            <td>
                <input value="<?php echo @$slack['url']; ?>" type="text" name="data[transport][slack][url]" value="" class="regular-text" />
                <p class="description">
                    <?php echo __('Create your Incoming Webhook:', 'wordfence-notification'); ?> <a href="https://api.slack.com/messaging/webhooks" target="_blank">https://api.slack.com/messaging/webhooks</a>
                </p>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Username', 'wordfence-notification'); ?></th>
            <td>
                <input value="<?php echo @$slack['username']; ?>" type="text" name="data[transport][slack][username]" value="" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><?php echo __('Channel', 'wordfence-notification'); ?></th>
            <td>
                <input value="<?php echo @$slack['channel']; ?>" type="text" name="data[transport][slack][channel]" value="" class="regular-text" />
            </td>
        </tr>
    </tbody>
</table>

<table class="form-table wf-notification-transport telegram <?php echo ( @strtolower( $values['selected_transport'] ) == 'telegram') ? 'show' : ''; ?>">
    <tbody>
        <tr>
            <th><?php echo __('Bot Token', 'wordfence-notification'); ?></th>
            <td>
                <input placeholder="123456:xxxxxxxxx" value="<?php echo @$telegram['token']; ?>" type="text" name="data[transport][telegram][token]" value="" class="regular-text" />
                <p class="description">
                    <?php echo __('Create your Bot:', 'wordfence-notification'); ?> <a href="https://core.telegram.org/bots#6-botfather" target="_blank">https://core.telegram.org/bots#6-botfather</a>
                </p>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Chat ID / User ID', 'wordfence-notification'); ?></th>
            <td>
                <input placeholder="123456" value="<?php echo @$telegram['chat_id']; ?>" type="text" name="data[transport][telegram][chat_id]" value="" class="regular-text" placeholder="" />
            </td>
        </tr>
    </tbody>
</table>