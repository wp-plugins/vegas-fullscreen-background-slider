=== Vegas Slider ===
Contributors: jamesdbruner, max_Q
Donate link: http://www.jamesdbruner.com
Tags: fullscreen slider, background slider, vegas
Requires at least: 3.1
Tested up to: 3.6
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A fullscreen background slideshow plugin

== Description ==

A fullscreen background slideshow plugin based on Jay Salvat's <a href="http://vegas.jaysalvat.com/">Vegas Background jQuery Plugin</a>

You can see a working demo at <a href="http://demo.jamesdbruner.com/">http://demo.jamesdbruner.com/</a>


Now there are a couple different parameters you can use.  Here's a list of ALL of them:

id  --  the id of the specific vegas slider you want to pull from

fade  --  the amount of fade you want between two images in milliseconds

delay  --  the amount of delay you want between two images in milliseconds

overlay  --  ...an overlay over your images

title  --  uses the title you designated in the admin area when you're creating the vegas slide

arrows  --  adds supersized arrows on the left and right sides of your images to designated next/previous


Keep in mind that you MUST have an id and that the shortcode is generated for you when you create a new vegas slide with the id you'll need.

Here's an example of a shortcode that you would put into the specific page you want the slider to show up on:

 [vegasslider id="565" fade="1500" delay ="4500" overlay="http://mydomain.com/urloftheimage/" title="yes" arrows="yes"]


If you want just one slider to appear on all pages you just need to follow these steps:


First go to Appearance -> Editor and from there navigate to the header.php template on the right hand side.

You'll see some code that looks similar to this:

`
<?php
/**
 * The template for displaying front page pages.
 *
 */
?>
<?php get_header(); ?>
`
NOTE: It must be added after wp_head() call. Otherwise, it will not work.


Immediately after that put this code (you'll have to edit to be your shortcode within the quotation marks):

`
<?php echo do_shortcode( '[vegasslider id="5" delay="4500" fade="1500" overlay="http://demo.jamesdbruner.com/wp-content/uploads/2012/12/az_subtle.png"]' ) ?>
`

Save the file and you should be done.




Still need help figuring this part out? We've solved this before, so just check here: http://wordpress.org/support/topic/vegas-slider-doesnt-work  

== Installation ==

1. Upload `vegas-slider.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode [vegasslider id="This id is generated when you create a new slide" fade="however much you want in miliseconds" overlay="url of a pattern"]



== Frequently asked questions ==



== Screenshots ==

1. Frontend
2.

== Changelog ==



== Upgrade notice ==

