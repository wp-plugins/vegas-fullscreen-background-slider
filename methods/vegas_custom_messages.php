<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	global $post, $post_ID;
	$messages['vegas'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( __('Slideshow updated.') ),
	2 => __('Custom Field updated.'),
	3 => __('Custom Field deleted.'),
	4 => __('Slideshow updated.'),
	/* translators: %s: date and time of the revision */
	5 => isset($_GET['revision']) ? sprintf( __('Slideshow restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( __('Slideshow published.') ),
	7 => __('Slideshow saved.'),
	8 => sprintf( __('Slideshow submitted.') ),
	9 => sprintf( __('Slideshow scheduled for: <strong>%1$s</strong>.'),
 	 // translators: Publish box date format, see http://php.net/date
  	date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('Slideshow draft updated.') )
	);