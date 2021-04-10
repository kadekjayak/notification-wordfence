<p>This plugin will catch Wordfence alert email (locked out and login) and send it to your notification channel (Slack or Telegram).</p>

<p>This plugin will hook in wp_mail <code>pre_wp_mail</code> filter, and find the mail subject that contain <code>[Wordfence Alert]</code> words. Currently it&#39;s <strong>Only Support English language</strong>, so this plugin won&#39;t work if you use different language on the email subject.</p>

<a href="?page=WordfenceNotification&tab=locked-out-alert" class="button button-primary">
    <?php echo __('Configure Locked Out Alert', 'notification-wordfence'); ?>
</a>

<br>
<br>
<hr>

<h4>Any Question?</h4>
<a href="mailto:kadekjayak@yahoo.co.id?subject=Question-notification-wordfence">Mail Me</a>