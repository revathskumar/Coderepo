<?php
/*
Plugin Name: GitHub Gist Wordpress Plugin 
Plugin URI: http://wordpress.org/extend/plugins/github-gist
Description: GitHub Gist Wordpress Plugin allows you to embed GitHub Gists from http://gist.github.com/ in a post or page.
Usage: fill in the id and file attributes in the [gist] tag:

[gist id=447298 file=github_gist_wordpress_plugin_test.txt]

or

copy the embedding JavaScript code from GitHub and directly paste it in the body of the [gist] tag:

[gist]<script src="http://gist.github.com/447298.js?file=github_gist_wordpress_plugin_test.txt"></script>[/gist].
Version: 1.1 
Author: Jingwen Owen Ou 
Author URI: http://owenou.com

Copyright 2010 Jingwen Owen Ou

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define("REGEXP_GIST_URL","\"http:\/\/gist.github.com\/(.+)\.js\?file=(.+)\"");
define("GITHUB_LINK","<a href=\\\"http://github.com\\\">GitHub<\/a>");
define("GITHUB_GIST_WORDPRESS_PLUGIN_LINK","<a href=\\\"http://wordpress.org/extend/plugins/github-gist/\\\">GitHub Gist WordPress Plugin<\/a>");

function gist_script($id, $file) {
	$script_url = "http://gist.github.com/".trim($id).".js";
	$script_url = $script_url."?file=".trim($file);
	$script = get_content_from_url($script_url);
	$script = add_branding($script);
	return "<script>".$script."</script>";
}

function get_content_from_url($url) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

function gist_raw($id, $file) {
	$request = "http://gist.github.com/raw/".$id."/".$file;
	return get_content_from_url($request);
}

function add_branding($gist) {
	return str_replace(GITHUB_LINK, GITHUB_GIST_WORDPRESS_PLUGIN_LINK, $gist);
}

function gist_raw_html($gist_raw) {
	return "<div style='margin-bottom:1em;padding:0;'><noscript><code><pre style='overflow:auto;margin:0;padding:0;border:1px solid #DDD;'>".htmlentities($gist_raw)."</pre></code></noscript></div>";
}

function gist($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => null,
		'file' => null,
		), $atts));	

	if ($content != null && preg_match("/".REGEXP_GIST_URL."/", $content, $matches)) {
		$id = $matches[1];
		$file = $matches[2];
	}

	if ($id == null || $file == null) {
		return "Error when loading gists from http://gist.github.com/.".$content;
	}

	$html = gist_script($id, $file);
	$gist_raw = gist_raw($id, $file);

	if ($gist_raw != null) {
		$html = $html.gist_raw_html($gist_raw);
	}

	return $html;
}

add_shortcode('gist', 'gist');

?>