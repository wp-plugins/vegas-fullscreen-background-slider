<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
        global $post;
        $imgIDs = get_post_meta( get_the_ID(), 'imgIDs', true ); 

    wp_register_script('vegas-reorder-remove-img', plugins_url('../../js/img_reorder_remove.js',__FILE__), array('jquery'), null, 1 );
    wp_enqueue_script('vegas-reorder-remove-img'); ?>
    <form name="post" method="post">
        <input type="hidden" name="imgIDs" id="imgIDs" value="<?php echo $imgIDs; ?>" />
        <input type= "button" class="button" name="vegas_image_button" id="vegas_image_button" value="Add Slides" />
        <div id="thumbnails">
<?php 
        $image = explode(",", $imgIDs);
        $imagenum = count($image);

	if( $imagenum > 0 && !empty($imgIDs) ){
    		for($i = 0;$i < $imagenum;$i++){
			$image_attributes = wp_get_attachment_image_src( $image[$i], "thumbnail" );
	        	echo "<div id='" . $image[$i] . "' class='thumbnail'><img id='" . $image[$i] . "' src='" . $image_attributes[0] . "'><span id='" . $image[$i] . "' class='vegas_remove'>X</span></div>"; //get image
    		}
	} 
?> </ul></div>