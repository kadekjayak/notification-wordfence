=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: https://www.kadekjayak.web.id
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Catch Wordfence email alert and send it to your notification channel (Slack or Telegram)

== Description ==

WordFence is a pretty good WordPress security plugin, they have brute-force protection that can block spam or login attempts;

They send alert to your email, but sometimes it's become annoying when you start receive bunch email alert everyday.

This plugin will catch Wordfence alert email (locked out and login) and send it to your notification channel (Slack or Telegram).

How it's Works?:
*   This plugin will hook in wp_mail `pre_wp_mail` filter, and find the mail subject that contain `[Wordfence Alert]` words. Currently it's only support English language, so this plugin won't work if you use different language on the email subject.
*   If the mail found it will redirected to your notification channel

== Installation ==

1. Upload plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enable notification transport through the menu `Wordfence` -> `Notification`

you need to configure your own notification credentials

== Frequently Asked Questions ==

= Does this plugin catch all Wordfence Alert email =

No, this plugin only catch locked out and Login alert email. 
Other than that you may still receive email from Wordfence plugin (scan, problems, etc)

== Screenshots ==

1. Plugin configurations page
2. Slack message

== Changelog ==

= 1.0 =
* First public release :)