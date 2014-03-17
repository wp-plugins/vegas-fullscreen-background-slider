<?php
	global $post;
    wp_register_script('vegas', plugins_url('../js/jquery.vegas.js',__FILE__), array('jquery'), null, 1 );
    wp_register_style('vegas', plugins_url('../css/jquery.vegas.css', __FILE__), '', null, 'all');

    wp_enqueue_script('vegas');
    wp_enqueue_style('vegas');