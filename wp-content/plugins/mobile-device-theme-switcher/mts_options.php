<?php
// create custom plugin settings menu
add_action('admin_menu', 'mts_create_menu');

function mts_create_menu() {
	add_options_page('Mobile Theme Switcher Settings', 'Mobile Theme Switcher', 'administrator', __FILE__, 'mts_settings_page');
	add_action('admin_init', 'register_mysettings');
}


function register_mysettings() {
	register_setting('mts-settings-group', 'iphone_theme');
	register_setting('mts-settings-group', 'ipad_theme');
	register_setting('mts-settings-group', 'android_theme');
}

function mts_settings_page() {
	
	$iphoneTheme 	= get_option('iphone_theme');
	$ipadTheme		= get_option('ipad_theme');
	$androidTheme	= get_option('android_theme');
	
	$themeList 		= get_themes();
	$themeNames 	= array_keys($themeList); 
	$defaultTheme 	= get_current_theme();
	natcasesort($themeNames);
?>
<div class="wrap">
<h2>Mobile Theme Switcher Plugin</h2>
<p><em>Like this plugin? Help support it <a href="http://www.jeremyarntz.com/plugins/donate/" target="_new">by donating to the developer</a>. 
Donations help cover the cost of maintaining and developing new plugin features. Every donation is appreciated!</em></p>

<form method="post" action="options.php">
    <?php settings_fields( 'mts-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">iPhone/iPod Touch Theme:</th>
        <td>
        	<select name="iphone_theme"  />
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($iphoneTheme == $themeName) || (($iphoneTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo '<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">iPad Theme</th>
        <td>
        	<select name="ipad_theme"  />
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($ipadTheme == $themeName) || (($ipadTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Android Theme</th>
        <td>
        	<select name="android_theme"  />
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($androidTheme == $themeName) || (($androidTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
