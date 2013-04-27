<?php 
class vegas{
    public function __construct(){
        if(is_admin()){
	    add_action('admin_menu', array($this, 'vegas_add_settings_page'));
	    add_action('admin_init', array($this, 'page_init'));
	}
    }

  public function vegas_add_settings_page(){
      add_submenu_page('edit.php?post_type=vegasslider', 'Custom Vegas Settings', 'Settings', 'edit_posts', basename(__FILE__), array($this, 'create_vegas_admin_page'));	
    	add_action('admin_menu', 'vegas_add_settings_page'); // add the admin options page

   }
 public function create_vegas_admin_page(){
        ?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Vegas Settings</h2>			
	    <form method="post" action="options.php">
	        <?php
                    // This prints out all hidden setting fields
		    settings_fields('vegas_option_group');	
		    do_settings_sections('vegas-setting-admin');
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
	
    public function page_init(){		
	register_setting('vegas_option_group', 'fade_key', array($this, 'check_fade'));
  register_setting('vegas_option_group', 'delay_key', array($this, 'check_delay'));
  register_setting('vegas_option_group', 'overlay_key', array($this, 'check_overlay'));
  register_setting('vegas_option_group', 'title_key', array($this, 'check_title'));
  register_setting('vegas_option_group', 'arrows_key', array($this, 'check_arrows'));
  register_setting('vegas_option_group', 'autoplay_key', array($this, 'check_autoplay'));
  register_setting('vegas_option_group', 'global_key', array($this, 'check_global'));
  register_setting('vegas_option_group', 'id_key', array($this, 'check_id'));
		
  add_settings_section(
	    'setting_section_id',
	    'Setting',
	    array($this, 'print_section_info'),
	    'vegas-setting-admin'
	);	
		
	add_settings_field(
	    'Fade', 
      'Fade (milliseconds):', 
	    array($this, 'fade_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Delay', 
      'Delay (milliseconds):', 
	    array($this, 'delay_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Overlay', 
      'Overlay (Full Image URL):', 
	    array($this, 'overlay_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Title', 
      'Title:', 
	    array($this, 'title_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Arrows', 
      'Display Arrows:', 
	    array($this, 'arrows_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Autoplay', 
      'Autoplay:', 
	    array($this, 'autoplay_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Global', 
      'Global (Adds the slider to every page/post):', 
	    array($this, 'global_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
  add_settings_field(
	    'Id', 
      'Slider ID (specific to the slider you want to use):', 
	    array($this, 'id_field'), 
	    'vegas-setting-admin',
	    'setting_section_id'			
	);
    }
	
    public function check_fade($input){
      
        if( isset($input['Fade'])){$Fade = $input['Fade'];}
           
        if( !isset($Fade['Fade']) && isset($input['Fade']) && is_numeric($input['Fade'])){		
	    if(get_option('fade') === FALSE){
		add_option('fade', $Fade);
	    }else{
		update_option('fade', $Fade);
	    }
	}else{
	    $Fade = '';
	}
	return $Fade;
    }
  
  public function check_delay($input){
    
    if( isset($input['Delay'])){$Delay = $input['Delay'];}
    
		    if( !isset($Delay['Delay']) && isset($input['Delay']) && is_numeric($input['Delay'])){
	    		if(get_option('delay') === FALSE){
		add_option('delay', $Delay);
	    }else{
		update_option('delay', $Delay);
	    }
	}else{
	    $Delay = '';
	}
	return $Delay;
    }
  
public function check_overlay($input){ 
  
  if( isset($input['Overlay'])){$Overlay = $input['Overlay'];	}
  
          if(!isset($Overlay['Overlay']) && isset($input['Overlay']) &&!is_numeric ($input['Overlay'])){        		
	    if(get_option('overlay') === FALSE){
		add_option('overlay', $Overlay);
	    }else{
		update_option('overlay', $Overlay);
	    }
	}else{
	    $Overlay = '';
	}
	return $Overlay;	      
	  }
  
  public function check_title($input){ 
    
    if( isset($input['Title'])){$Title = $input['Title'];	}
    
          if(!isset($Title['Title']) && isset($input['Title']) && !is_numeric ($input['Title'])){        		
	    if(get_option('title') === FALSE){
		add_option('title', $Title);
	    }else{
		update_option('title', $Title);
	    }
	}else{
	    $Title = '';
	}
	return $Title;	      
	  }
    
   public function check_arrows($input){
     
   if( isset($input['Arrows'])){$Arrows = $input['Arrows']; 	}
     
   
   if ( !isset( $Arrows['arrows'] ) ) {
     $Arrows = 0;
     add_option('arrows', $Arrows);
   } 
         
    if ( $input['Arrows'] == 1 ) {
        $Arrows = 1;
      update_option('arrows', $Arrows);
    } else {
        $Arrows = 0;
      update_option('arrows', $Arrows);
    }
   return $Arrows;
}

   public function check_autoplay($input){
     
    if( isset($input['Autoplay'])){$Autoplay = $input['Autoplay']; 	}
     
    if ( $input['Autoplay'] == 1 ) {
        $Autoplay = 1;
      update_option('autoplay', $Autoplay);
    } else {
        $Autoplay = 0;
      update_option('autoplay', $Autoplay);
    }
   return $Autoplay;
}
       
   public function check_global($input){
     
    if( isset($input['Global'])){$Global = $input['Global']; 	}
     
    if ( $input['Global'] == 1 ) {
        $Global = 1;
      update_option('global', $Global);
    } else {
        $Global = 0;
      update_option('global', $Global);
    }
   return $Global;
}

    public function check_id($input){
      
      if( isset($input['Id'])){$ID = $input['Id']; 	}
   
        if(!isset($ID['Id']) && isset($input['Id']) && is_numeric($input['Id'])){	    			
	    if(get_option('id') === FALSE){
		add_option('id', $ID);
	    }else{
		update_option('id', $ID);
	    }
	}else{
	    $ID = '';
	}
	return $ID;
    }
  
    public function print_section_info(){
	print 'These settings help define the shortcodes that are generated for you when you create a slide and are used exclusively if you use the global option. Enter your settings below:';
    }
	
    public function fade_field(){
        ?><input type="text" id="fade" name="fade_key[Fade]" value="<?php echo get_option('fade'); ?>" /><?php
    }
    public function delay_field(){
        ?><input type="text" id="delay" name="delay_key[Delay]" value="<?php echo get_option('delay'); ?>" /><?php
    }
    public function overlay_field(){
        ?><input type="text" id="overlay" name="overlay_key[Overlay]" value="<?php echo get_option('overlay'); ?>" /><?php
    }
    public function title_field(){
        ?><input type="text" id="title" name="title_key[Title]" value="<?php echo get_option('title'); ?>" /><?php
    }
    public function arrows_field(){
      $Arrows = get_option('arrows');
      if($Arrows == 1) { $checked = ' checked="checked" '; }
      else{ $checked = '';}
                       echo '<input type="checkbox" id="arrows" name="arrows_key[Arrows]" value="1" '.$checked.' />'; //<333333
    }
    public function autoplay_field(){
      $Autoplay = get_option('autoplay');
      if($Autoplay == 1) { $checked = ' checked="checked" '; }
      else{ $checked = '';}    
      	               echo '<input type="checkbox" id="autoplay" name="autoplay_key[Autoplay]" value="1" '.$checked.' />';
    }
    public function global_field(){
      $Global = get_option('global');
      if($Global == 1) { $checked = ' checked="checked" '; }
      else{ $checked = '';}    
      	               echo '<input type="checkbox" id="global" name="global_key[Global]" value="1" '.$checked.' />';
    }
    public function id_field(){
      $Global = get_option('global');
        ?><input type="text" id="id" name="id_key[Id]" value="<?php echo get_option('id');?>" <?php if($Global != 1){echo 'disabled="disabled"';} ?> /><br/>
<p>Note: You have to set the global option and save before you can add the id.  Also the id is neccessary if you're going to use the global option.<br/>  You can find the id on the slide page (where you added the photos)</p>
<?php
    }
}

$vs_enet = new vegas(); ?>