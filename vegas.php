<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: WP Vegas
Plugin URI: http://jamesdbruner.com
Description: Fullscreen Vegas Slider based on the <a target="_blank" href="http://vegas.jaysalvat.com/">Vegas Background jQuery Plugin</a> by <a href="http://jaysalvat.com/">Jay Salvat</a>
Author: James Bruner
Version: 2.1
Author URI: http://jamesdbruner.com

  Copyright 2014  James Bruner  (email : jamesdbruner@gmail.com)

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

class vegas{

	// Constructor for the class.
	public function __construct() {

    //Require version 3.5, Enqueue Scripts, Add Vegas Post Type, Add Custom Columns, Add Metaboxs, Add Media JS, Add Metabox Save, Add Shortcode, Add Help Submenu, Add Help Link, Custom messages, Flush rewrite rules, tinymce button
    add_action( 'admin_init', array( $this, 'require_3_5' ) );
    add_action( 'init', array( $this, 'create_vegas_post_type' ) ); 
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); 
    add_filter( 'manage_edit-vegas_columns', array( $this, 'vegas_cpt_columns' ) );
    add_action( 'manage_vegas_posts_custom_column', array( $this, 'manage_vegas_columns'), 10, 1 );
    add_action( 'add_meta_boxes', array( $this, 'vegas_metaboxes_add' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'media_uploader' ) );
    add_action( 'save_post', array( $this, 'vegas_meta_box_save' ));
    add_shortcode( 'vegas', array( $this, 'vegas' ) );
    add_filter( 'plugin_action_links_'. plugin_basename( __FILE__ ), array( $this, 'add_help_link' ) );
    add_filter( 'post_updated_messages', array( $this, 'vegas_custom_messages' ) );
    register_activation_hook( __FILE__, array( __CLASS__, 'flush' ) );
    register_deactivation_hook( __FILE__, array( __CLASS__, 'flush' ) );
    register_uninstall_hook( __FILE__, array( __CLASS__, 'flush' ) );
       
    }

    //Require version 3.5+
    public function require_3_5() {
	include_once('methods/vegas_version.php');
    }

    //Register Script
    public function enqueue_scripts() {
	include_once('methods/vegas_enqueue.php');
    }

    //Register, localize and enqueue the media uploader js
    public function media_uploader() {
	include_once('methods/vegas_media.php');
    }

    //Vegas Custom Post Type    
    public function create_vegas_post_type() { 
	include_once('methods/vegas_cpt.php');
    }

    //Add Shortcode Column
    public function vegas_cpt_columns($columns) {
	include_once('methods/vegas_cpt_columns.php');
   	 return $columns;
    }

    //Displays the shortcodes within the shortcode column
    public function manage_vegas_columns($column) {
	global $post;
        $genShortcode = get_post_meta( get_the_ID(), 'genShortcode', true );

        if( isset( $genShortcode ) || !empty( $genShortcode ) && $column = 'shortcode') {
	$shortcode = "<input type='text' spellcheck='false' onclick='this.focus();this.select()' readonly='readonly' style='width:650px;max-width:100%' value='". $genShortcode ."'</input>";
	}
	if( !isset( $genShortcode ) || empty( $genShortcode ) && $column = 'shortcode'){
	$shortcode = '<input type="text" spellcheck="false" onclick="this.focus();this.select()" readonly="readonly" style="width:650px;max-width:100%" value="[vegas id='. $post->ID .']"</input>'; }
	echo $shortcode;
    }

    //Add Help Link
    public function add_help_link($links){
	$settings_link = '<a href="http://wordpress.org/plugins/vegas-fullscreen-background-slider/installation/">Help</a>';
  	array_push( $links, $settings_link );
  	return $links;
    } 

    //Add Vegas Metaboxes
    public function vegas_metaboxes_add() {
	add_meta_box( 'vegas_images', __( 'Vegas Slides', 'vegas_images' ), array( $this, 'vegas_meta_box_display' ), 'vegas', 'normal', 'default' );
	add_meta_box( 'vegas_shortcode', __( 'Vegas Shortcode', 'vegas_shortcode' ), array( $this, 'vegas_meta_box_shortcode' ), 'vegas', 'normal', 'default' );  //shortcode generator
    }

    //Display images metabox
    public function vegas_meta_box_display() {
       	include_once('methods/metaboxes/vegas_image_metabox.php'); 
    }

    //Display Shortcode Metabox
    public function vegas_meta_box_shortcode() {
	include_once('methods/metaboxes/vegas_shortcode_metabox.php'); 
    }

    //Save Metabox
    public function vegas_meta_box_save($post_id) {
	include_once('methods/metaboxes/vegas_save_metabox.php'); 
    }

    //Vegas Shortcode  NOTE: enqueuing scripts/styles in this function so as to only load them when the shortcode is present (has_shortcode doesnt play well with do_shortcode)
    public function vegas($atts){
	include_once('methods/vegas_shortcode.php');
	return $replacement;
    }

    //Custom Update Messages
    public function vegas_custom_messages($messages){
	include_once('methods/vegas_custom_messages.php');
	return $messages;
    }

    //Flush rewrite rules
    public function flush() {
	flush_rewrite_rules();
    }

}
// Instantiate the class.
$vegas = new vegas();