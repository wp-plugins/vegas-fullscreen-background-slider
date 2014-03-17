<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    global $post_type;
    if( $post_type == 'vegas' ){
	wp_enqueue_media();
        wp_register_script( 'vegasupload', plugins_url( '../js/media.js', __FILE__ ), array( 'jquery' ), null, true );
        wp_localize_script( 'vegasupload', 'vegasupload',
            array(
                'title'     => __( 'Upload or Choose Your Custom Image File', 'vegas' ), // This will be used as the default title
                'button'    => __( 'Insert Image into Input Field', 'vegas' )            // This will be used as the default button text
            )
        );
        wp_enqueue_script( 'vegasupload' );
	wp_register_style('vegas-admin', plugins_url('../css/vegas.admin.css', __FILE__), '', null, 'all');
	wp_enqueue_style('vegas-admin'); } ?>