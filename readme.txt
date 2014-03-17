=== WP Vegas ===
Contributors: jamesdbruner, max_Q
Donate link: http://www.jamesdbruner.com
Tags: fullscreen slideshow, background slideshow, vegas, vegas slideshow, jquery fullscreen slideshow, jquery slideshow
Requires at least: 3.5
Tested up to: 3.8.1
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A fullscreen background slideshow plugin

== Description ==

A fullscreen background slideshow plugin based on Jay Salvat's <a href="http://vegas.jaysalvat.com/">Vegas Background jQuery Plugin</a>.  You can see a working demo at <a href="http://vegas.jamesdbruner.com/">http://vegas.jamesdbruner.com/</a>

<h4>What Can This Plugin Do?</h4>
You can use it to

*   Create a fullscreen slideshow
*   Create a fullscreen background (single slide)
*   That's about it...  It does use the new media uploader and you can drag and drop your images to rearrange them which is kind of cool.

This plugin does one thing and one thing only, to keep it small yet fully functional.

For a list of cool new features in **version 2.0** check out the <a href="http://wordpress.org/plugins/vegas-fullscreen-background-slider/changelog/">Changelog</a>


<h4>About the Shortcode:</h4>

There are 7 parameters total that you can use with this shortcode.  The **ID** being the only one that's absolutely **required**.  

List of parameters:


*   id
*   fade
*   delay
*   overlay
*   arrows
*   autoplay
*   poster


`
[vegas id="565" fade="2500" delay ="4500" overlay="http://mydomain.com/urloftheimage/" arrows="yes" autoplay="yes" poster="yes"]
`

**NOTE FOR THEME DEVELOPERS:** This plugin makes use of both *wp_head()* and *wp_footer()* so if your theme is missing either you may experience issues using this plugin.

== Installation ==

<h4>Installation</h4>


1.   Upload `wp-vegas.zip` to the `/wp-content/plugins/` directory
2.   Activate the plugin through the 'Plugins' menu in WordPress
3.   Use the shortcode [vegas id="xxx"]
4.   Customize the slideshow using the parameters explained in <a href="https://wordpress.org/plugins/full-screen-page-background-image-slideshow/screenshots/">screenshot #5</a>


<h4>Using the Shortcode</h4>
After you've added images to your slideshow and generated a shortcode you just need to copy the shortcode and paste it into the content of any page or post you want the slideshow to show up on.  If you want it to show up on every page you'll have to add some code to the header.php file in your theme.  See the codex's <a href="http://codex.wordpress.org/Function_Reference/do_shortcode">do_shortcode article</a> for more information on the matter.

<a href="https://wordpress.org/plugins/full-screen-page-background-image-slideshow/screenshots/">See screenshot #5</a> for a description of the shortcode parameters.

== Screenshots ==

1. Demonstration
2. Backend Example
3. Usage Example
4. Shortcode Generator
5. Shortcode Parameter Explanation

== Changelog ==

<h4>Version 2.0</h4>


*   Added a custom shortcode column to the custom post type for ease of use
*   Added a Help link on the plugins page to direct those who need help to some documentation
*   Added a shortcode generator on the Add New/Edit Slideshow pages to help simplify that process
*   Added support for adding images from the media library
*   Added an ABSPATH check as an added security measure
*   Completely redid how images are uploaded and saved
*   Fixed default values not working for the shortcode
*   Minified css and js
*   Rebranded the plugin to WP Vegas because it's simpler and I like it better
*   Refactored how the plugin outputs code which is now much cleaner
*   Refacted the readme.txt so it might actually be useful to someone
*   Refactored the whole plugin into a class with methods
*   Removed global option to add the slideshow to all pages because it seemed superfluous (can be done with do_shortcode)
*   Removed unnecessary options and functions
*   Removed title attribute
*   Sanatize image IDs before they're saved
*   Updated vegas.js to the latest version (version 1.3.4)


<h4>Versions 1.0 - 1.5</h4>


*   I was a slacker and didn't keep track.


== Upgrade notice ==

If you're looking to upgrade be warned that this WILL RUIN WHAT YOU ALREADY HAVE.  So if you like how the plugin is working and you don't want to rebuild your slideshows and re-add shortcodes then DO NOT upgrade.  If you do upgrade you will have to rebuild your slideshows and you will have to re add shortcodes to the pages you had them on because I've redone how images are uploaded and saved and also changed the shortcode from [vegasslider] to [vegas].