<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	global $post;
	$id = get_the_ID();
    wp_register_script('vegas-shortcode-generator', plugins_url('../../js/shortcodegenerator.js',__FILE__), array('jquery'), null, 1 );
    wp_enqueue_script('vegas-shortcode-generator');
        $genShortcode = get_post_meta( $id, 'genShortcode', true );

	if ( !isset( $genShortcode ) || empty( $genShortcode ) ){
		echo '<form><input type="button" class="button" name="vegas_shortcodeg_button" id="vegas_shortcodeg_button" value="Generate Your Own Shortcode" /><br><br>';
		echo '<div id="example_shortcode">Example Shortcode: <input type="text" spellcheck="false" onclick="this.focus();this.select()" readonly="readonly" style="width:650px;max-width:100%" value="[vegas id='. $id .' fade=3000 delay=4000 overlay= arrows=yes autoplay=yes poster=yes]"</input></div>'; 
	} 
	else{ 
		echo '<form><input type="button" class="button" name="vegas_shortcodeg_button" id="vegas_shortcodeg_button" value="Generate a New Shortcode" /><br><br>';
		echo "<div id='example_shortcode'>Your Custom Shortcode: <input type='text' spellcheck='false' onclick='this.focus();this.select()' readonly='readonly' style='width:650px;max-width:100%' value='" . $genShortcode ."'</input></div>";}
?>

<div id="vegas-shortcode-generator">
<h3>Shortcode Generator</h3><br>
Shortcode ID: <input type="text" id="id" spellcheck="false" readonly="readonly" value="<?php echo $id ?>">
Fade: <input type="text" id="fade" spellcheck="false" value="">
Delay: <input type="text" id="delay" spellcheck="false" value="">
Overlay: <input type="text" id="overlay" spellcheck="false" value="">
Arrows: <select id="arrows" name="arrows"><option value="no">No</option><option value="yes">Yes</option></select>
Autoplay: <select id="autoplay" name="autoplay"><option value="no">No</option><option value="yes">Yes</option></select>
Poster: <select id="poster" name="poster"><option value="no">No</option><option value="yes">Yes</option></select><br>
<input type="button" class="button" name="vegas_generate_button" id="vegas_generate_button" value="Generate Shortcode!" />
<input type="button" class="button" name="vegas_help_button" id="vegas_help_button" value="Explain What All of This Means..." />
<br><br>
<div id="generated-shortcode-container">Generated Shortcode: <input id="generated-shortcode" type="text" spellcheck="false" onclick="this.focus();this.select()" readonly="readonly" name="genShortcode" value="<?php echo $genShortcode; ?>"></div>
</div>
<div id="vegas-parameter-explaination">
<h3>Fade</h3>
<p>The amount of time it takes to fade from one images to the next (in miliseconds)</p>
<h3>Delay</h3>
<p>The amount of time the slideshow will wait before fading to the next image (also in miliseconds)</p>
<h3>Overlay</h3>
<p>You can place an image like a pattern over top of the slideshow using the URL of the pattern.  Take the <a href="http://vegas.jamesdbruner.com" target="_BLANK">demo site</a> for example.  It has a subtle overlay over all of the images.  To use an overlay image first upload your image/pattern to your media library and then use the URL for the overlay parameter.  E.g. [vegas id=10 fade=5000 delay = 4000 <strong>overlay=yourdomain.com/yourpattern.png</strong> arrows=no autoplay=no poster=no]</p>
<h3>Arrows</h3>
<p>Weather or not to display next/previous arrows so users can navigate through the slideshow</p>
<h3>Autoplay</h3>
<p>Weather or not to automatically start playing through the slideshow when the user first loads the page.</p>
<h3>Poster</h3>
<p>The slideshow will stop on the last image in the slideshow but autoplay must be enabled for this to work.</p>
<hr>
<p>After you've generated your shortcode remember to hit Publish or Update so you can come back and copy/paste the shortcode later if you need to!</p>
<input type="button" class="button" name="vegas_help-back_button" id="vegas_help-back_button" value="Thanks! Now take me back to the shortcode generator!" />
</div>
</form>