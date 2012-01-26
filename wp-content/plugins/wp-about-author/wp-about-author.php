<?php
/*
Plugin Name: WP About Author
Plugin URI: http://www.jonbishop.com/downloads/wordpress-plugins/wp-about-author/
Description: Easily display customizable author bios below your posts
Version: 1.2
Author: Jon Bishop
Author URI: http://www.jonbishop.com
License: GPL2
*/

define('WPAUTHORURL_URL', plugin_dir_url(__FILE__));
define('WPAUTHORURL_PATH', plugin_dir_path(__FILE__));

require_once(WPAUTHORURL_PATH."/wp-about-author-admin.php");
//require_once(WPAUTHORURL_PATH."/wp-about-author-services.php");

// Add box below post with share buttons and subscribe/comment text
function wp_about_author_display($for_feed = false){
	global $post;
  	$wp_about_author_settings=array();
	$wp_about_author_settings=get_option('wp_about_author_settings');
	
	$wp_about_author_content = "";
	$wp_about_author_author_pic =  "";
	$wp_about_author_author = array();
	$wp_about_author_author['name'] = get_the_author();
	$wp_about_author_author['description'] = get_the_author_meta('description');
	$wp_about_author_author['twitter'] = get_the_author_meta('twitter');
	$wp_about_author_author['facebook'] = get_the_author_meta('facebook');
	$wp_about_author_author['website'] = get_the_author_meta('url');
	$wp_about_author_author['posts'] = (int)get_the_author_posts();
  	$wp_about_author_author['posts_url'] = get_author_posts_url(get_the_author_meta('ID'));
  	
	$wp_about_author_author_pic = get_avatar(get_the_author_email(), '100');
	
	$wp_about_author_content .= "<h3><a href='" . $wp_about_author_author['posts_url']. "' title='". $wp_about_author_author['name'] ."'>". $wp_about_author_author['name'] ."</a></h3>";
	
	$wp_about_author_content .= "<p>"  .$wp_about_author_author['description'] . "</p>";
	$wp_about_author_link = '';
	if(!empty($wp_about_author_author['website'])||!empty($wp_about_author_author['twitter'])||!empty($wp_about_author_author['facebook'])){
		$wp_about_author_content .= "<p>";
		if(!empty($wp_about_author_author['website'])){
			$wp_about_author_link .= "<a href='" . $wp_about_author_author['website']. "' title='". $wp_about_author_author['name'] ."'>Website</a> ";
		}
		if(!empty($wp_about_author_author['twitter'])){
			if($wp_about_author_link!=""){ $wp_about_author_link .= "- "; }
			$wp_about_author_link .= "<a href='" . $wp_about_author_author['twitter']. "' title='". $wp_about_author_author['name'] ."on Twitter'>Twitter</a> ";
		}
		if(!empty($wp_about_author_author['facebook'])){
			if($wp_about_author_link!=""){ $wp_about_author_link .= "- "; }
			$wp_about_author_link .= "<a href='" . $wp_about_author_author['facebook']. "' title='". $wp_about_author_author['name'] ." on Facebook'>Facebook</a> ";
		}
		if(!empty($wp_about_author_author['posts_url'])){
			if($wp_about_author_link!=""){ $wp_about_author_link .= "- "; }
			$wp_about_author_link .= "<a href='" . $wp_about_author_author['posts_url']. "' title='More posts by ". $wp_about_author_author['name'] ."'>More Posts</a> ";
		}
		$wp_about_author_content .= $wp_about_author_link;
		$wp_about_author_content .= "</p>";
	}
        if (!$for_feed){
            return '<div class="wp-about-author-containter-'.$wp_about_author_settings['wp_author_alert_border'].'" style="background-color:'.$wp_about_author_settings['wp_author_alert_bg'].';"><div class="wp-about-author-pic">'.$wp_about_author_author_pic.'</div><div class="wp-about-author-text">'.$wp_about_author_content.'</div></div>';
        } else {
            return '<p><div style="float:left; text-align:left;>'.$wp_about_author_author_pic.'</div>'.$wp_about_author_content.'</p>';
        }
}


// Add buttons to page
function insert_wp_about_author($content) {
	$wp_about_author_settings=array();
	$wp_about_author_settings=get_option('wp_about_author_settings');

	if(is_front_page() && isset($wp_about_author_settings['wp_author_display_front']) && $wp_about_author_settings['wp_author_display_front']){
		$content=$content.wp_about_author_display();
	} else if(is_archive() && isset($wp_about_author_settings['wp_author_display_archives']) && $wp_about_author_settings['wp_author_display_archives']){
		$content=$content.wp_about_author_display();
	} else if(is_search() && isset($wp_about_author_settings['wp_author_display_search']) && $wp_about_author_settings['wp_author_display_search']){
		$content=$content.wp_about_author_display();
	} else if(is_page() && isset($wp_about_author_settings['wp_author_display_pages']) && $wp_about_author_settings['wp_author_display_pages']){
		$content=$content.wp_about_author_display();
	} else if(is_single() && isset($wp_about_author_settings['wp_author_display_posts']) && $wp_about_author_settings['wp_author_display_posts']){
		$content=$content.wp_about_author_display();
        } else if(is_feed() && isset($wp_about_author_settings['wp_author_display_feed']) && $wp_about_author_settings['wp_author_display_feed']){
		$content=$content.wp_about_author_display(true);
	} else {
		$content=$content;	
	}
	return $content;
}

// Add css to header
function wp_about_author_style() {
	wp_enqueue_style('wp-sauthor-bio', WPAUTHORURL_URL . 'wp-about-author.css');	
}

function wp_about_author_filter_contact($contactmethods) {

	unset($contactmethods['yim']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['yim'] = 'Yahoo IM';
	$contactmethods['aim'] = 'AIM';
	$contactmethods['jabber'] = 'Jabber / Google Talk';

	return $contactmethods;

}

register_activation_hook(__FILE__, 'add_defaults_wp_about_author');
// Define default option settings
function add_defaults_wp_about_author() {
	$tmp = get_option('wp_about_author_settings');
    if(!is_array($tmp)) {
		$tmp = array(
					"wp_author_installed"=>"on",
					"wp_author_version"=>"13",
					"wp_author_alert_bg"=>"#FFEAA8",
					"wp_author_display_front"=>"on",
					"wp_author_display_archives"=>"on",
					"wp_author_display_search"=>"",
					"wp_author_display_posts"=>"on",
					"wp_author_display_pages"=>"on",
                                        "wp_author_display_feed"=>"",
					"wp_author_alert_border"=>"top"
					);
		update_option('wp_about_author_settings', $tmp);
	}
        if (!$tmp['wp_author_display_feed']){
                $tmp['wp_author_display_feed'] = "";
                update_option('wp_about_author_settings', $tmp);
        }
}


add_action('admin_menu','add_wp_about_author_options_subpanel');
add_action('admin_print_scripts', 'add_wp_about_author_admin_scripts');
add_action('admin_print_styles', 'add_wp_about_author_admin_styles');

add_action('wp_print_styles', 'wp_about_author_style' );

add_filter('user_contactmethods', 'wp_about_author_filter_contact');
add_filter('the_content', 'insert_wp_about_author');

?>