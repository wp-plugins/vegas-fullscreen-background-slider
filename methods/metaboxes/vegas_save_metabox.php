<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    global $post; 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  	return;

    if (!current_user_can('edit_post', $post_id))
  	return;
     
    if( !isset( $_POST['imgIDs'] ) )
	$imgIDs = '';

    if( !isset( $_POST['genShortcode'] ) )
	$genShortcode = '';

    if( isset( $_POST['imgIDs'] ) )
	$imgIDs = sanitize_text_field( $_POST['imgIDs'] );
	add_post_meta($post_id, "imgIDs", $imgIDs, true) or update_post_meta( $post_id, "imgIDs", $imgIDs );

    if( isset( $_POST['genShortcode'] ) )
	$genShortcode = sanitize_text_field( $_POST['genShortcode'] );
	add_post_meta($post_id, "genShortcode", $genShortcode, true) or update_post_meta( $post_id, "genShortcode", $genShortcode );
