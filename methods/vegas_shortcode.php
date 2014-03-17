<?php
if ( ! defined( 'ABSPATH' ) ) exit;

    /* Enqueue Scripts.  This way we can conditionally load these scripts/css
    //Previously enqueued the scripts with if has_shortcode and it wasnt loading the scripts/styles if you used do_shortcode
    wp_register_script('vegas', plugins_url('../js/jquery.vegas.js',__FILE__), array('jquery'), '1.0', 1 );
    wp_register_style('vegas', plugins_url('../css/jquery.vegas.css', __FILE__));

    wp_enqueue_script('vegas');
    wp_enqueue_style('vegas'); */

    $atts = shortcode_atts(array('id' => '','fade' => '2000','overlay' => '','arrows' => 'yes','poster' => 'yes','delay' => '4000','autoplay' => 'yes'), $atts);
    $images = get_post_meta( $atts['id'], 'imgIDs', true );
    //Variables
    $fade = $atts['fade']; $delay = $atts['delay']; $overlay = $atts['overlay']; $autoplay = $atts['autoplay']; $poster = $atts['poster']; $arrows = $atts['arrows']; 

    $image = explode(",", $images);
    $imagenum = count($image);
    $replacement = '';

    if($imagenum > 1 && $arrows == "yes"){
    $replacement .= <<<HEREDOC
<nav id="nav-arrows" class="nav-arrows">
		<span id="nav-arrow-prev">Previous</span>
		<span id="nav-arrow-next">Next</span>
	</nav>

HEREDOC;

    $replacement .= <<<HEREDOC
	<script> 
		jQuery( '#nav-arrow-prev' ).click( function() { jQuery.vegas('previous'); }); 
		jQuery( '#nav-arrow-next' ).click( function() { jQuery.vegas('next'); });
	</script>
HEREDOC;
    }

    $replacement .= <<<HEREDOC

<script>
    jQuery( function() {
    jQuery.vegas('slideshow', {
    delay:$delay,
    backgrounds:[
HEREDOC;

    for($i = 0;$i < $imagenum;$i++){ $image_attributes = wp_get_attachment_image_src( $image[$i], "full" ); $replacement .= "{ src:'" . $image_attributes[0] . "', fade:" . $fade . "},"; }

    $replacement .= <<<HEREDOC
] 
}) 
HEREDOC;
//NOTE If there is no overlay, don't print the 'overlay' option with an empty source into the javascript. It gives you a 404 for the overlay image.
    if( $overlay ){ $replacement .= <<<HEREDOC
    ('overlay', {src:'$overlay'}) 
HEREDOC;
    }
    $replacement .= <<<HEREDOC
}); 
</script>

HEREDOC;
  
    if($autoplay == "no"){
          $replacement .= "<script>jQuery( function() {jQuery.vegas('pause'); });</script>";
      }

    if($poster == "yes" && $autoplay == "yes"){
	  $vegastimeout = $delay * $imagenum;
	  $replacement .= "<script>jQuery(document).ready(function(){ setTimeout(function(){ jQuery( function(){ jQuery.vegas('pause'); } )},  $vegastimeout ); });</script>";
    }  