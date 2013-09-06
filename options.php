<?php 

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'vegas_add_defaults');
register_uninstall_hook(__FILE__, 'vegas_delete_plugin_options');
add_action('admin_init', 'vegas_init' );
add_action('admin_menu', 'vegas_add_options_page');
// add_filter( 'plugin_action_links', 'vegas_plugin_action_links', 10, 2 );

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'vegas_delete_plugin_options')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------

// Delete options table entries ONLY when plugin deactivated AND deleted
function vegas_delete_plugin_options() {
	delete_option('vegas_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_activation_hook(__FILE__, 'vegas_add_defaults')
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE PLUGIN IS ACTIVATED. IF THERE ARE NO THEME OPTIONS
// CURRENTLY SET, OR THE USER HAS SELECTED THE CHECKBOX TO RESET OPTIONS TO THEIR
// DEFAULTS THEN THE OPTIONS ARE SET/RESET.
//
// OTHERWISE, THE PLUGIN OPTIONS REMAIN UNCHANGED.
// ------------------------------------------------------------------------------

// Define default option settings
function vegas_add_defaults() {
	$tmp = get_option('vegas_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('vegas_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		$arr = array(	"vegas_autoplay" => "1",
				"vegas_fade" => "5000",
				"vegas_delay" => "4000",

		);
		update_option('vegas_options', $arr);
	}
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'vegas_init' )
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_init' HOOK FIRES, AND REGISTERS YOUR PLUGIN
// SETTING WITH THE WORDPRESS SETTINGS API. YOU WON'T BE ABLE TO USE THE SETTINGS
// API UNTIL YOU DO.
// ------------------------------------------------------------------------------

// Init plugin options to white list our options
function vegas_init(){
	register_setting( 'vegas_plugin_options', 'vegas_options', 'vegas_validate_options' );
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'vegas_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------

// Add menu page
function vegas_add_options_page() {

        add_submenu_page('edit.php?post_type=vegasslider', 'Custom Vegas Settings', 'Settings', 'manage_options', __FILE__, 'vegas_render_form');
	//add_submenu_page('edit.php?post_type=vegasslider', 'Custom Vegas Settings', 'Settings', 'edit_posts', basename(__FILE__), array($this, 'create_vegas_admin_page'));	
	//add_options_page('Vegas Settings Page', 'Vegas Settings', 'manage_options', __FILE__, 'vegas_render_form');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------



// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------

// Render the Plugin options form
function vegas_render_form() {
	?>
	<div class="wrap">
		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Vegas Options</h2>
		<p>These settings help define the shortcodes that are generated for you when you create a slide and are used exclusively if you use the global option. Enter your settings below:</p>

		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('vegas_plugin_options'); ?>
			<?php $options = get_option('vegas_options'); ?>

			<!-- Table Structure Containing Form Controls -->
			<!-- Each Plugin Option Defined on a New Table Row -->
			<table class="form-table">

				<!-- Text Area Control -->
				<tr>
					<th scope="row">Fade</th>
					<td>
						<input type="text" size="57" name="vegas_options[vegas_fade]" value="<?php echo $options['vegas_fade']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Delay</th>
					<td>
						<input type="text" size="57" name="vegas_options[vegas_delay]" value="<?php echo $options['vegas_delay']; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row">Overlay</th>
					<td>
						<input type="text" size="57" name="vegas_options[vegas_overlay]" value="<?php echo $options['vegas_overlay']; ?>" />
					</td>
				</tr>


				<!-- Checkbox Buttons -->
				<tr valign="top">
					<th scope="row">Preferences</th>
					<td>
						<!-- Display Arrows Checkbox -->
						<label><input name="vegas_options[vegas_arrows]" type="checkbox" value="1" <?php if (isset($options['vegas_arrows'])) { checked('1', $options['vegas_arrows']); } ?> /> Display Arrows</label><br />

						<!-- Autoplay Checkbox -->
						<label><input name="vegas_options[vegas_autoplay]" type="checkbox" value="1" <?php if (isset($options['vegas_autoplay'])) { checked('1', $options['vegas_autoplay']); } ?> /> Autoplay <em>(Automatically start sliding through the slideshow?)</em></label><br />

						<!-- Private Checkbox -->
						<label><input name="vegas_options[vegas_private]" type="checkbox" value="1" <?php if (isset($options['vegas_private'])) { checked('1', $options['vegas_autoplay']); } ?> /> Automatically set the visibility for each slideshow to private</label><br />

						<!-- Global Option -->
						<label><input name="vegas_options[vegas_isglobal]" type="checkbox" value="1" <?php if (isset($options['vegas_isglobal'])) { checked('1', $options['vegas_isglobal']); } ?> /> Global <em>(Display on every page?)</em></label><br />

					</td>
				</tr>
				<tr>
				<th>Global ID</th>
					<td>
						<input type="text" size="57" name="vegas_options[vegas_globalid]" value="<?php echo $options['vegas_globalid']; ?>" />
						<br><em>Grab the ID from the slideshow you created. For example [vegasslider id="77" fade="5000" delay="4000" overlay="" title="" arrows="no" autoplay="no"] The id is 77.  Obviously 77 is an example, don't use it unless YOUR id actually is 77. </em>
					</td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>


	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function vegas_validate_options($input) {
	 // strip html from textboxes
	$input['vegas_fade'] =  wp_filter_nohtml_kses($input['vegas_fade']); // Sanitize textbox input (strip html tags, and escape characters)
	$input['vegas_delay'] =  wp_filter_nohtml_kses($input['vegas_delay']); // Sanitize textbox input (strip html tags, and escape characters)
	$input['vegas_overlay'] =  wp_filter_nohtml_kses($input['vegas_overlay']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}