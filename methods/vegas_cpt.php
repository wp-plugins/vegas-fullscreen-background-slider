<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	register_post_type( 'vegas',
	array(
	'menu_icon' => 'dashicons-format-gallery',
	'labels' => array(
	'name' => __( 'Vegas Slideshows' ),
	'singular_name' => __( 'Slideshow' ),
	'menu_name' => __( 'WP Vegas' ),
	'all_items' => __( 'View Slideshows' ),
	'add_new' => _x('Add Slideshow', 'Slideshow'),
	'add_new_item' => __('New Slideshow'),
	'edit_item' => __('Edit Slideshow'),
	'new_item' => __('New Slideshow'),
	'view_item' => __('View Slideshow'),
	'search_items' => __('Search Your Slideshows'),
	'not_found' =>  __('Nothing found'),
	'not_found_in_trash' => __('Nothing found in Trash'),
	),
	'public' => false,
	'has_archive' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'vegas_slideshows'),
	'capability_type' => 'post',
	'supports' => array('title'),
	'taxonomies' => array( 'slideshow')));