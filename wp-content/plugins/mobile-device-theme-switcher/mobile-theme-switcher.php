<?php
/* 
Plugin Name: Mobile Theme Switcher
Plugin URI: http://www.jeremyarntz.com
Description: Plugin that allows you to set separate themes for the iPad, iPhone/iPod Touch, and Android Browsers
Author: Jeremy Arntz 
Version: 0.6
Author URI: http://www.jeremyarntz.com
*/

/*  Copyright 2010  Jeremy Arntz  (email : jeremy@jeremyarntz.com)

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

if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== FALSE){ 
	add_filter('stylesheet', 'getIpadTemplate');
	add_filter('template', 'getIpadTemplate');
}


if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE){ 
	add_filter('stylesheet', 'getIphoneTemplate');
	add_filter('template', 'getIphoneTemplate');
}

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE){ 
	add_filter('stylesheet', 'getAndroidTemplate');
	add_filter('template', 'getAndroidTemplate');
}

function getIpadTemplate(){
	$iPadTheme =  get_option('ipad_theme');
    $themeList = get_themes();
	foreach ($themeList as $theme) {
	  if ($theme['Name'] == $iPadTheme) {
	      return $theme['Stylesheet'];
	  }
	}	
}

function getIphoneTemplate(){
	$iPhoneTheme =  get_option('iphone_theme');
    $themeList = get_themes();
	foreach ($themeList as $theme) {
	  if ($theme['Name'] == $iPhoneTheme) {
	      return $theme['Stylesheet'];
	  }
	}	
}

function getAndroidTemplate(){
	$androidTheme =  get_option('android_theme');
    $themeList = get_themes();
	foreach ($themeList as $theme) {
	  if ($theme['Name'] == $androidTheme) {
	      return $theme['Stylesheet'];
	  }
	}	
}

include('mts_options.php');
?>