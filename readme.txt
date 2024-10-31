=== Search Exclude HTML Tags ===
Contributors: superann
Donate link: http://superann.com/donate/?id=WP+Search+Exclude+HTML+Tags+plugin
Tags: search
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

Makes the built-in search ignore HTML tags in post content.

== Description ==

This plugin makes the WordPress built-in search ignore HTML tags in post content.

By default, the WordPress built-in search considers HTML tags in post content to be searchable content. This behaviour often yields unexpected results. For example, a search for the keyword "strong" returns posts with any &lt;strong&gt; tags in them, "title" returns posts with any HTML tags that have a title attribute (such as all the &lt;img&gt; tags that you insert via the post editor media buttons)... and so on.

== Installation ==

1. Upload `search-exclude-html-tags.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

None.

== Screenshots ==

None.

== Changelog ==

= 1.0 =
* Initial version.