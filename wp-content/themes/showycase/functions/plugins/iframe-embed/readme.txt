=== Better YouTube Embeds ===
Contributors: pathawks, dirtysuds, hotforwords, Uzicoppa
Donate link: http://www.pathawks.com/p/wordpress-plugins.html
Tags: plugins, wordpress, embed, oembed, media, youtube, iframe, mobile, iphone, video, webm, h264
Requires at least: 2.9
Tested up to: 3.1.3
Stable tag: 1.06

Embeds YouTube videos in a way compatible with Desktop, iPhone, iPad, Android and other mobile browsers.

== Description ==

Embeds YouTube videos without using Flash embed code.


Embeded videos are compatible with **iPhone** and **Android** devices, as well as browsers that support **WebM**


Because it uses [WordPress's built in media support](http://codex.wordpress.org/Embeds "Embeds - Wordpress Codex"), you don't need to use any special shortcodes or change any of your posts. Just include the YouTube URL on it's own line in a post, like you always would, and WordPress will replace it with the iframe embed code.


This is the best way to embed the YouTube iframe code in WordPress.


Works very well with mobile themes like **WPtouch**, **Onswipe**

== Installation ==

1. Upload `dirtysuds-embed-youtube-iframe` to the `/wp-content/plugins/` directory
2. Activate **DirtySuds - Embed YouTube** through the 'Plugins' menu in WordPress
3. In the page editor, add the URL of a YouTube video on it's own line, and WordPress will replace it with the iframe embed code.


== Frequently Asked Questions ==

= How can I change the size of the video =
All of the default WordPress media settings still apply.
If you'd like to specify a specific size for one video, you can use the `width` and `height` attributes.
`[embed width='400' height='300']http://www.youtube.com/watch?v=y-LsEajbD4I[/embed]`

If you'd like to specify a new default size for all embeds, you can do so through the WordPress Media Settings.
**Settings⇒Media⇒Embeds⇒Maximum embed size**


= I've installed the plugin, but am still getting the old Flash embed code =

This probably means there is another plugin conflicting with this one. Disable **all** installed plugins, then activate *just this plugin* and see if the problem is still occurring. If not, reactivate other plugins one by one until you find the one that is conflicting.

Please email me a full report, so that I may better help other users with the same problem.
plugins@dirtysuds.com


= I've installed the plugin, but a video is not being embeded at all =
Videos that are unlisted are not supported this way at this time.


= I have an idea for a great way to improve this plugin =

Great! I'd love to hear from you.
plugins@dirtysuds.com


== Changelog ==

= 1.06 20110321 =
* Fixed problem with Youtu.be URLs (Thanks [Uzicoppa](http://theglobalstream.ibitlive.eu/blog/blog/2011/05/28/wordpress-dirtysuds-embed-youtube-breaking-other-services-fix/328/ "Uzicoppa"))

= 1.05 20110321 =
* Automatically enable auto-embeds on plugin activation as, without this enabled, the plugin does nothing

= 1.04 20110317 =
* Added wmode=transparent to iframe embed code, so Flash won't get in the way

= 1.03 20110315 =
* Now clears oembed cache automatically upon activation
* Removed options page, as it is no longer necessary

= 1.02 20110302 =
* Added a test to see if iFrame embeds are working properly

= 1.01 20110302 =
* Fixed bug affecting small number of users (thanks to [HotForWords.com](http://hotforwords.com/ "Hot For Words"))
* Started using Wordpress filter `oembed_providers`
* Added option to *Clear oEmbed Cache*

= 1.00 20110224 =
* First version
* Works

== Upgrade Notice ==

= 1.06 =
Fixed problem with YouTube URLs and overlapping Flash

= 1.03 =
Removed options page, as it is no longer necessary

= 1.02 =
Added a test to see if iFrame embeds are working properly

= 1.01 =
Faster. Fixed an issue affecting a small number of users