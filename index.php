<?php
/*
Plugin Name: Vegas Slider
Plugin URI: http://jamesdbruner.com
Description: Fullscreen Vegas Slider based the Vegas Fullscreen jQuery Plugin 
Author: James Bruner
Version: 1.0
Author URI: http://jamesdbruner.com
*/

/*  Copyright 2012  James Bruner  (email : jamesdbruner@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

wp_enqueue_script('vegas', plugins_url('/js/jquery.vegas.js',__FILE__), array('jquery'), '1.0', 1 );

/* Vegas Slider Custom Post Type */
add_action( 'init', 'create_vegasslider_post_type' );
function create_vegasslider_post_type() {
	register_post_type( 'vegasslider',
	array(
	'labels' => array(
	'name' => __( 'Vegas Slides' ),
	'singular_name' => __( 'Slide' ),
	'add_new' => _x('Add Slide', 'Slide'),
	'add_new_item' => __('New Slide'),
	'edit_item' => __('Edit Slide'),
	'new_item' => __('New Slide'),
	'view_item' => __('View Slide'),
	'search_items' => __('Search Your Slides'),
	'not_found' =>  __('Nothing found'),
	'not_found_in_trash' => __('Nothing found in Trash'),
	),
	'public' => true,
	'has_archive' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'slides'),
	'capability_type' => 'post',
	'supports' => array('title', 'editor'),
	'taxonomies' => array( 'slide')));
}

//meta box
add_action('admin_init', 'vegasslider_add_meta_boxes', 1);
function vegasslider_add_meta_boxes() {
	add_meta_box( 'vegasslider_images', 'Image Slides', 'vegasslider_meta_box_display', 'vegasslider', 'normal', 'default');
}

//display metabox
function vegasslider_meta_box_display() {
global $post;
  // adjust values here
$id = "img1"; // this will be the name of form field. Image url(s) will be submitted in $_POST using this key. So if $id == ?img1? then $_POST[?img1?] will have all the image urls
 
$svalue = get_post_meta( $post->ID, 'img1', true );

$multiple = true; // allow multiple files upload
 
$width = null; // If you want to automatically resize all uploaded images then provide width here (in pixels)
 
$height = null; // If you want to automatically resize all uploaded images then provide height here (in pixels)
?>

<p>Shortcode: <input type="text" spellcheck="false" onclick="this.focus();this.select()" readonly="readonly" value='<?php $shortcodeid = get_the_ID(); echo '[vegasslider id="' . $shortcodeid . '"]';?>'></p>

<label>Upload Images</label>
<input type="hidden" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $svalue; ?>" />
<div class="plupload-upload-uic hide-if-no-js <?php if ($multiple): ?>plupload-upload-uic-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-upload-ui">
    <input id="<?php echo $id; ?>plupload-browse-button" type="button" value="<?php esc_attr_e('Add Images'); ?>" class="button" />  
    <span class="ajaxnonceplu" id="ajaxnonceplu<?php echo wp_create_nonce($id . 'pluploadan'); ?>"></span>
    <?php if ($width && $height): ?>
            <span class="plupload-resize"></span><span class="plupload-width" id="plupload-width<?php echo $width; ?>"></span>
            <span class="plupload-height" id="plupload-height<?php echo $height; ?>"></span>
    <?php endif; ?>
    <div class="filelist"></div>
</div>
<div class="plupload-thumbs <?php if ($multiple): ?>plupload-thumbs-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-thumbs">
</div>
<div class="clear"></div>
<?php
  
}

function plu_admin_enqueue() {
    wp_enqueue_script('plupload-all');
 
  wp_register_script('vegasplupload', plugins_url('js/vegasplupload.js', __FILE__), array('jquery'));
    wp_enqueue_script('vegasplupload');
 
  wp_register_style('vegasplupload', plugins_url('css/vegasplupload.css', __FILE__));
    wp_enqueue_style('vegasplupload');
}
add_action( 'admin_enqueue_scripts', 'plu_admin_enqueue' );


function v_plupload_action() {
 
    // check ajax noonce
    $imgid = $_POST["imgid"];
    check_ajax_referer($imgid . 'pluploadan');
 
    // handle file upload
    $status = wp_handle_upload($_FILES[$imgid . 'async-upload'], array('test_form' => true, 'action' => 'plupload_action'));
 
    // send the uploaded file url in response
    echo $status['url'];
    exit;
}
add_action('wp_ajax_plupload_action', "v_plupload_action");


function vplupload_admin_head() {
// place js config array for plupload
    $plupload_init = array(
        'runtimes' => 'html5,silverlight,flash,html4',
        'browse_button' => 'plupload-browse-button', // will be adjusted per uploader
        'container' => 'plupload-upload-ui', // will be adjusted per uploader
        'drop_element' => 'drag-drop-area', // will be adjusted per uploader
        'file_data_name' => 'async-upload', // will be adjusted per uploader
        'multiple_queues' => true,
        'max_file_size' => wp_max_upload_size() . 'b',
        'url' => admin_url('admin-ajax.php'),
        'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
        'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
        'filters' => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
        'multipart' => true,
        'urlstream_upload' => true,
        'multi_selection' => false, // will be added per uploader
         // additional post data to send to our ajax hook
        'multipart_params' => array(
            '_ajax_nonce' => "", // will be added per uploader
            'action' => 'plupload_action', // the ajax action name
            'imgid' => 0 // will be added per uploader
        )
    );
?>
<script type="text/javascript">
    var base_plupload_config=<?php echo json_encode($plupload_init); ?>;
</script>    
<?php
}
add_action("admin_head", "vplupload_admin_head");





// Save Metabox
function vegasslider_meta_box_save($post_id) {
	global $post; 
  //    if ( ! isset( $_POST['pluploadan'] ) ||
  //! wp_verify_nonce( $_POST['pluploadan'], 'pluploadan' ) )
  //	return;

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  	return;

  if (!current_user_can('edit_post', $post_id))
  	return;
  
  $svalue = $_POST['img1'];
    
  if( isset( $_POST['img1'] ) )
     add_post_meta($post_id, "img1", $_POST['img1'], true) or update_post_meta( $post_id, "img1", $_POST['img1'] );

  
}
add_action("save_post", "vegasslider_meta_box_save");




/* Vegas slider Shortcode */
function vegasslider($atts){
extract(shortcode_atts(array('id','fade','overlay','title'), $atts));
$images = get_post_meta( $atts['id'], 'img1', true );
  
$args = array( 'post_type' => 'vegasslider', 'posts_per_page' => 1 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
  
$image = explode(",", $images);

$imagenum = count($image) - 1;
wp_enqueue_style( 'vegas', plugins_url('/css/jquery.vegas.css', __FILE__));
?>


<script>
jQuery( function() {
  jQuery.vegas('slideshow', {
  backgrounds:[
<?php
  for($i = 0;$i < $imagenum;$i++){
    echo "{ src:'" . $image[$i] . "', fade:" . $atts['fade'] . " },"; //get image	 
  }
  	if($i = $imagenum){
    echo "{ src:'" . $image[$i] . "', fade:" . $atts['fade'] . " }";
  }
endwhile; ?>
  ]
})('overlay', {
   src:'<?php echo $atts['overlay'] ?>' 
})
});
</script>
<?php 
if($atts['title'] == "yes"){
echo '<div id="VegasContentOverlay">';
the_title('<h1>','</h1>'); 
the_content(); 
echo '</div>';
	}
}  
add_shortcode('vegasslider', 'vegasslider');  
?>