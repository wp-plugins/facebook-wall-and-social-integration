=== Facebook wall and social integration ===
Contributors: mitsol
Tags: facebook, feed, events, shortcode, social, status, posts, facebook wall, plugin
Requires at least: 3.1
Tested up to: 3.9
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Facebook wall and social integration allows you to display customized Facebook feed of any public Facebook page or group or profile.

== Description ==

Facebook wall and social integration shows **facebook feed/wall posts of page/profile/group** in your website.You will only have to put facebook id of page or profile or group and access token in the plugin settings.There are a lot of settings to customize display including color settings.Graph API is used to show page/group/profile feed efficiently.

= Features =

* Graph API usage for profile/page/group feeds
* Manage height and width of wall posts
* You can show number of posts to display from settings
* Have the ability to show guest entries too
* Color settings for all posts
* Cool editable css and loads fast
* Use the shortcode options to set page/group id and number of posts
* Select from date formats to display date your own way
* multiple feed display per page
* It's responsive and adjusts within the width of container
* others

To display photo post, video post, link post, event post, choose type of posts, different picture sizes, the number of likes, all comments by paging for each Facebook post, header bar and like button at top, language settings, scrolling plugin,responsiveness and more then [upgrade to the Pro version](http://extensions.techhelpsource.com/wordpress/facebook-wall-pro "facebook wall pro"). Try out the [Pro demo](http://wordpress.techhelpsource.com/facebook-wall-pro/ "facebook wall Demo").

== Installation ==

1. Install the facebook wall and social integration either via the WordPress plugin directory, or by uploading the files to your web server (in the `/wp-content/plugins/` directory).
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to the 'Facebook wall & social integration' settings page to configure your feed.
4. Use the shortcode `[mitsol_fbwall_feed_short_code]` in your page, post or widget to display your feed.
5. You can display feeds of different Facebook groups/pages by specifying a Page/group ID directly in the shortcode: `[mitsol_fbwall_feed_short_code id=wordpress num=20]`.
6. if there is any confusion in running/installing the plugin, contact immediately and view doc, problems will be solved

== Frequently Asked Questions ==

For a full documentation with FAQs and help with troubleshooting please visit the **[Documentation and FAQs](http://extensions.techhelpsource.com/facebook_wall_documentation_wordpress.htm)** section of the mitsol extensions website 

Furhermore, if there is any confusion in running the plugin, contact immediately and view doc, problems will be solved

= How do I find the ID of my Facebook page or group or profile? =

If you have a Facebook **page** with a URL like this: `https://www.facebook.com/misol12` then the Page ID is just `misol12`. If your page URL is look like this: `https://www.facebook.com/pages/pagename/123654123654123` then the Page ID is the numbers - `123654123654123`.

If you have a Facebook **group/profile** then use [this tool](http://lookup-id.com/ "Look Up my ID") to find your Group ID or view our documentaion link above.

= What is Access Token and how to get it? =

Access Token is required by Facebook in order to access their feeds. It's easy to get one.  Just follow the step-by-step instructions [here in the doc](http://extensions.techhelpsource.com/facebook_wall_documentation_wordpress.htm "Getting an Access Token"). 

= Why isn't the feed from my group/page displaying? =

At first, check that your group/page is public and not a private group/page.
Also, make sure to check the 'Show guest entries' option in the settings page.Furthermore, increase the  **Show number of posts** value from settings becuase 
non-pro version only shows status/textual posts of page/group/profile so there may not be status posts in the number of posts value specified.

= Can I show photos and videos in my Facebook feed? =

This free plugin only allows you to display textual updates from your Facebook feed. To display photos,videos,formatted links in your feed you need to upgrade to the Pro version of the plugin. View demo of the Pro version on the [mitsol wp demo website](http://wordpress.techhelpsource.com/facebook-wall-pro/ "facebook wall feed Demo"), and find out more about Pro version [here](http://extensions.techhelpsource.com/wordpress/facebook-wall-pro "Facebook Wall Feed Pro").

= Can I choose to show certain types of posts? =

Yes you can choose type of posts to display.For this feature please upgrade to the [Pro version of the plugin](http://extensions.techhelpsource.com/wordpress/facebook-wall-pro "Facebook Wall Feed Pro").

= Can I show the comments associated with each Facebook post? =

For this feature please upgrade to the [Pro version of the plugin](http://extensions.techhelpsource.com/wordpress/facebook-wall-pro "Facebook Wall Feed Pro").

= How do I embed the Custom Facebook Feed directly into a WordPress page template? =

You can embed your Facebook feed directly into a template file by using the WordPress do_shortcode function: `do_shortcode('[mitsol_fbwall_feed_short_code]');`.

== Screenshots ==

1. This pic shows how feed look like by default settings and colors
2. Configuring the facebook wall and social integration plugin
3. Colors - Facebook wall color settings

== Changelog ==

= 1.0 =
* Launch!
= 1.1 =
* Plugin now uses server side call to show feed to have non-expired access token requested by many users. Some new features added like choosing post types, defining different picture sizes...