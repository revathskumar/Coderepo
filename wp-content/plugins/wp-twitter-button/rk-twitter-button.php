<?php
/*
Plugin Name: WP Twitter Button
Plugin URI: http://www.ruudkok.nl/wordpress/twitter-button/
Description: This plugin adds the new Twitter button to each post and page.
Author: Ruud Kok
Author URI: http://www.ruudkok.nl/
Version: 1.4

Copyright 2011  Ruud Kok (email : info@ruudkok.nl)

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

$plugin = plugin_basename(__FILE__); 

function rk_add_twitter_button($content)
	{
	$rk_twitter_button_display = get_option("rk_twitter_button_display");
	$rk_twitter_button_layout = get_option("rk_twitter_button_layout");
	$rk_twittername = get_option("rk_twitter_button_account");
	if(!empty($rk_twittername))
		{
		$rk_twittername = ' data-via="'.$rk_twittername.'"';
		}
	$contentcode = '<a href="http://twitter.com/share" class="twitter-share-button" data-url="'.get_permalink().'" data-count="'.$rk_twitter_button_layout.'"'.$rk_twittername.'>Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	$rk_twitter_button_align = get_option("rk_twitter_button_align");
	$rk_twitter_button_margin = get_option("rk_twitter_button_margin");
	$rk_tw_margin_top = $rk_twitter_button_margin['top'];
	$rk_tw_margin_bottom = $rk_twitter_button_margin['bottom'];
	$rk_tw_margin_left = $rk_twitter_button_margin['left'];
	$rk_tw_margin_right = $rk_twitter_button_margin['right'];
	$margin = $rk_tw_margin_top.'px '.$rk_tw_margin_right.'px '.$rk_tw_margin_bottom.'px '.$rk_tw_margin_left.'px';
	if ($rk_twitter_button_display == 'both')
		{
		if ((is_single()) OR (is_page()))
			{
			//set the twittername which will be referenced in each tweet
			if ( strpos( $rk_twitter_button_align,"topleft" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"topright" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"bottomright" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			if ( strpos( $rk_twitter_button_align,"bottomleft" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			return $content;
			}
		else
			{
			return $content;
			}	
		}
	elseif ($rk_twitter_button_display == 'posts')
		{
		if (is_single())
			{
			//set the twittername which will be referenced in each tweet
			if ( strpos( $rk_twitter_button_align,"topleft" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"topright" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"bottomright" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			if ( strpos( $rk_twitter_button_align,"bottomleft" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			return $content;
			}
		else
			{
			return $content;
			}	
		}
	elseif ($rk_twitter_button_display == 'pages')
		{
		if (is_page())
			{
			//set the twittername which will be referenced in each tweet
			if ( strpos( $rk_twitter_button_align,"topleft" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"topright" ) !== FALSE)
				{
				$buttoncode .= "\n";
				$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$buttoncode .= $contentcode;
				$buttoncode .= '</div>'."\n";
				$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				$content = $buttoncode.$content;
				}
			if ( strpos( $rk_twitter_button_align,"bottomright" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			if ( strpos( $rk_twitter_button_align,"bottomleft" ) !== FALSE)
				{
				$content .= "\n";
				$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
				$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
				$content .= $contentcode;
				$content .= '</div>'."\n";
				$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
				}
			return $content;
			}
		else
			{
			return $content;
			}	
		}
	else
		{
		if ( strpos( $rk_twitter_button_align,"topleft" ) !== FALSE)
			{
			$buttoncode .= "\n";
			$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
			$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
			$buttoncode .= $contentcode;
			$buttoncode .= '</div>'."\n";
			$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
			$content = $buttoncode.$content;
			}
		if ( strpos( $rk_twitter_button_align,"topright" ) !== FALSE)
			{
			$buttoncode .= "\n";
			$buttoncode .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
			$buttoncode .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
			$buttoncode .= $contentcode;
			$buttoncode .= '</div>'."\n";
			$buttoncode .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
			$content = $buttoncode.$content;
			}
		if ( strpos( $rk_twitter_button_align,"bottomright" ) !== FALSE)
			{
			$content .= "\n";
			$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
			$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: right">';
			$content .= $contentcode;
			$content .= '</div>'."\n";
			$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
			}
		if ( strpos( $rk_twitter_button_align,"bottomleft" ) !== FALSE)
			{
			$content .= "\n";
			$content .= '<!-- This is the start of the WP Twitter Button code -->'."\n";
			$content .= '<div id="rk_wp_twitter_button" style="margin: '.$margin.'; float: left">';
			$content .= $contentcode;
			$content .= '</div>'."\n";
			$content .= '<!-- This is the end of the WP Twitter Button code -->'."\n\n";
			}
		return $content;
		}
	}

function rk_print_tb_adminpage()
	{
	if (!current_user_can('manage_options'))
		{
    	wp_die( __('You do not have sufficient permissions to access this page.') );
		}
	
	$rk_twitter_button_align = get_option("rk_twitter_button_align");
    if($rk_twitter_button_align == '') { $rk_twitter_button_align = 'bottomleft'; }
	$rk_twitter_button_layout = get_option("rk_twitter_button_layout");
    if($rk_twitter_button_layout == '') { $rk_twitter_button_layout = 'horizontal'; }
	$rk_twitter_button_account = get_option("rk_twitter_button_account");
	$rk_twitter_button_margin = get_option("rk_twitter_button_margin");
	$rk_twitter_button_display = get_option("rk_twitter_button_display");
	$rk_tw_margin_top = $rk_twitter_button_margin['top'];
	$rk_tw_margin_bottom = $rk_twitter_button_margin['bottom'];
	$rk_tw_margin_left = $rk_twitter_button_margin['left'];
	$rk_tw_margin_right = $rk_twitter_button_margin['right'];
	print '<div class="wrap">';
	print '<h2>WP Twitter Button settings</h2>';
	print '<form name="twitter_button_option_form" method="post">';
	print '<p>When to show yout Twitter Button?<br />';
	print '<select name="rk_twitter_button_display" id="rk_twitter_button_display">';
	print '<option value="posts"'; if ($rk_twitter_button_display == "posts") { print ' selected'; } print '>Posts only</option>';
	print '<option value="pages"'; if ($rk_twitter_button_display == "pages") { print ' selected'; } print '>Pages only</option>';
	print '<option value="both"'; if ($rk_twitter_button_display == "both") { print ' selected'; } print '>Both posts & pages</option>';	
	print '<option value="everywhere"'; if ($rk_twitter_button_display == "everywhere") { print ' selected'; } print '>Everywhere</option>';	
	print '</select>';	    
	print '</p>';
	print '<p>Button layout:<br />';
	print '<select name="rk_twitter_button_layout" id="rk_twitter_button_layout">';
	print '<option value="vertical"'; if ($rk_twitter_button_layout == "vertical") { print ' selected'; } print '>Vertical count</option>';
	print '<option value="horizontal"'; if ($rk_twitter_button_layout == "horizontal") { print ' selected'; } print '>Horizontal count</option>';
	print '<option value="none"'; if ($rk_twitter_button_layout == "none") { print ' selected'; } print '>No count</option>';	
	print '</select>';	    
	print '</p>';
	print '<p>Button placement:<br />';
	print '<select name="rk_twitter_button_align" id="rk_twitter_button_align">';
	print '<option value="topleft"'; if ($rk_twitter_button_align == "topleft") { print ' selected'; } print '>Top left</option>';
	print '<option value="topright"'; if ($rk_twitter_button_align == "topright") { print ' selected'; } print '>Top right</option>';
	print '<option value="bottomleft"'; if ($rk_twitter_button_align == "bottomleft") { print ' selected'; } print '>Bottom left</option>';				
	print '<option value="bottomright"'; if ($rk_twitter_button_align == "bottomright") { print ' selected'; } print '>Bottom right</option>';
	print '<option value="topleft-bottomleft"'; if ($rk_twitter_button_align == "topleft-bottomleft") { print ' selected'; } print '>Twice: Top left & bottom left</option>';
	print '<option value="topleft-bottomright"'; if ($rk_twitter_button_align == "topleft-bottomright") { print ' selected'; } print '>Twice: Top left & bottom right</option>';
	print '<option value="topright-bottomleft"'; if ($rk_twitter_button_align == "topright-bottomleft") { print ' selected'; } print '>Twice: Top right & bottom left</option>';
	print '<option value="topright-bottomright"'; if ($rk_twitter_button_align == "topright-bottomright") { print ' selected'; } print '>Twice: Top right & bottom right</option>';
	print '</select>';	    
	print '</p>';
	print '<p>Margins:<br/>';
	print '<table>';
	print '<tr><td>Top:</td><td><input type="text" size="4" name="rk_tw_margin_top" id="rk_tw_margin_top" value="'.$rk_tw_margin_top.'"></td><td>px</td></tr>';
	print '<tr><td>Bottom:</td><td><input type="text" size="4" name="rk_tw_margin_bottom" id="rk_tw_margin_bottom" value="'.$rk_tw_margin_bottom.'"></td><td>px</td></tr>';
	print '<tr><td>Left:</td><td><input type="text" size="4" name="rk_tw_margin_left" id="rk_tw_margin_left" value="'.$rk_tw_margin_left.'"></td><td>px</td></tr>';
	print '<tr><td>Right:</td><td><input type="text" size="4" name="rk_tw_margin_right" id="rk_tw_margin_right" value="'.$rk_tw_margin_right.'"></td><td>px</td></tr>';
	print '</table>';
	print '</p>';
	print '<p>Your twitter account:<br/>';
    print '<input type="text" name="rk_twitter_button_account" id="rk_twitter_button_account" value="'.$rk_twitter_button_account.'"></p>';
	print '<p><input type="submit" value="Save"></p>';
    print '<input type="hidden" name="rk_twitter_button_submit" value="true" />';
	print '</form>';
	if (!empty($_POST['rk_twitter_button_align']))
		{
		print '<p><em>Settings updated!</em></p>';
		}
	print '</div>';
	}

function rk_twitter_button_handler()
	{
   	if(isset($_POST['rk_twitter_button_submit'])) 
		{
		$new_margins = array('top' => $_POST['rk_tw_margin_top'], 'right' => $_POST['rk_tw_margin_right'], 'bottom' => $_POST['rk_tw_margin_bottom'], 'left' => $_POST['rk_tw_margin_left']);
		update_option("rk_twitter_button_margin", $new_margins);
		update_option("rk_twitter_button_display", $_POST['rk_twitter_button_display']);
    		update_option("rk_twitter_button_align", $_POST['rk_twitter_button_align']);
		update_option("rk_twitter_button_layout", $_POST['rk_twitter_button_layout']);
		$twitteraccount = ltrim($_POST['rk_twitter_button_account'],'@');
		update_option("rk_twitter_button_account", $twitteraccount);
		}
	$rk_twitter_button_version = get_option("rk_twitter_button_version");
	if (empty($rk_twitter_button_version))
		{
		add_option('rk_twitter_button_version', '1.4', '', 'yes'); // 'no' = not autoload
		}
	else
		{
		update_option('rk_twitter_button_version', '1.4');
		}
	$rk_twitter_button_margin = get_option("rk_twitter_button_margin");
	if (empty($rk_twitter_button_margin))
		{
		$default_margins = array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0');
		add_option('rk_twitter_button_margin', $default_margins, '', 'yes');
		add_option('rk_twitter_button_display', 'both', '', 'yes');
		}
	}

function rk_enable_tb_adminpage() 
	{
	add_options_page('WP Twitter Button settings', 'WP Twitter Button', 'manage_options', basename(__FILE__), 'rk_print_tb_adminpage');
	}

// Add settings link on plugin page
function rk_twitter_button_settings_link($links) 
	{ 
	$settings_link = '<a href="options-general.php?page=rk-twitter-button.php.php">'.__('Settings').'</a>';
	array_unshift($links, $settings_link); 
	return $links; 
	}
	
function rk_set_twitter_button_options() 
	{
	$default_margins = array('top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0');
	add_option('rk_twitter_button_align', 'bottomleft', '', 'yes'); // 'no' = not autoload
	add_option('rk_twitter_button_layout', 'horizontal', '', 'yes'); // 'no' = not autoload
	add_option('rk_twitter_button_account', '', '', 'yes'); // 'no' = not autoload
	add_option('rk_twitter_button_version', '1.4', '', 'yes'); // 'no' = not autoload
	add_option('rk_twitter_button_margin', $default_margins, '', 'yes');
	add_option('rk_twitter_button_display', 'both', '', 'yes');
	}
		
function rk_remove_twitter_button_options() 
	{
	delete_option('rk_twitter_button_align');
	delete_option('rk_twitter_button_layout');
	delete_option('rk_twitter_button_account');
	delete_option('rk_twitter_button_version');
	delete_option('rk_twitter_button_margin');
	delete_option('rk_twitter_button_display');
	}

register_activation_hook(__FILE__,'rk_set_twitter_button_options');
register_deactivation_hook(__FILE__,'rk_remove_twitter_button_options');
add_action('init', 'rk_twitter_button_handler');
add_action('admin_menu', 'rk_enable_tb_adminpage');
add_filter('the_content','rk_add_twitter_button');
add_filter("plugin_action_links_$plugin", 'rk_twitter_button_settings_link' );
?>