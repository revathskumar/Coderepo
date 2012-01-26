<?php
// Site Table of Contents
//
// Copyright (c) 2008-2009 Creative Real Estate Investing Guide
// http://creativerealestateinvestingguide.com/site-table-of-contents-plugin/
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// *****************************************************************

/*
Plugin Name: Site Table of Contents
Plugin URI: http://creativerealestateinvestingguide.com/site-table-of-contents-plugin/
Description: Site Table of Contents plugin allows a users to easily create a page that lists all posts and their respective categories in an easy to use and dynamic way.  Place <code>&lt;!--site_toc--&gt;</code> where you would like the table of contents to appear.  Use the HTML editor window when editing the form.
Version: 0.3
Author: Mike Ginese
Author URI: http://CreativeRealEstateInvestingGuide.com
*/

load_plugin_textdomain('site_table_of_contents');

// Add some options if they don't exist along with the defaults
add_option("stoc_title", "Site Table of Contents");
add_option("stoc_exclude", array('stoc_dummy_value'));

// Hook wp_head to add css
add_action('wp_head', 'stoc_wp_head');

function stoc_wp_head() {

	$css_file = "stoc.css";

	echo "\n" . '<link rel="stylesheet" type="text/css" media="screen" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/site-table-of-contents/' . $css_file . '" />' . "\n";

}


// Hook the content to add the widget
add_filter('the_content', 'site_table_of_contents_display_hook');
add_filter('the_excerpt', 'site_table_of_contents_display_hook');

function site_table_of_contents_display_hook($content='') {

//        $opt_where_to_show = get_option("stoc_where_to_show");

    $toc_call = '<!--site_toc-->';

  	if(strpos($content, $toc_call) === false) return $content;

	$build_toc = '';

  	$categories = get_categories(); 
  	foreach ($categories as $cat) {

		// Skip the categories we want to exclude
		if (in_array($cat->cat_name,get_option("stoc_exclude"))) {
			
			$build_toc = $build_toc;
		
		} else {
		
			$build_toc .= "<h3>" . $cat->cat_name . " (" . $cat->category_count . ")</h3>\n";
			$build_toc .=  "<ul class='lcp_catlist'>\n";
			global $post;
	 		$catposts = get_posts('numberposts=-1&category_name='.$cat->cat_name);

     		foreach($catposts as $post) {

				$build_toc .=  "<li><a href=" . get_permalink($post->ID) . ">" . get_the_title($post->ID) . "</a></li>\n";

     		}
     		$build_toc .=  "</ul>\n";
		}
	}


	$site_table_of_contents = '<div class="stoc_box" id="stoc_box">' . "\n";
	$site_table_of_contents .= '<div class="stoc_header" id="stoc_header">' . "\n";
	$site_table_of_contents .= '<center><em><strong>' . get_option("stoc_title") . '</strong></em></center>' . "\n";
	$site_table_of_contents .= '</div>' . "\n";
	$site_table_of_contents .= '<div class="stoc_middle" id="stoc_middle">' . "\n";
	$site_table_of_contents .= $build_toc;
	$site_table_of_contents .= '</div>' . "\n";
	$site_table_of_contents .= '<div class="stoc_footer" id="stoc_footer">' . "\n";
	$site_table_of_contents .= 'Get <a href="http://creativerealestateinvestingguide.com/site-table-of-contents-plugin/" title="Site Table of Contents">Site Table of Contents</a> from the <a href="http://creativerealestateinvestingguide.com" title="Real Estate Investing">Real Estate Investing</a> Guide.' . "\n";
	$site_table_of_contents .= '</div>' . "\n";
	$site_table_of_contents .= '</div>' . "\n"; 
	


        $content = str_replace($toc_call,$site_table_of_contents,$content);

		return $content;

}


// Admin menu
add_action('admin_menu', 'stoc_plugin_menu');

function stoc_plugin_menu() {
  add_options_page('Site Table of Contents Plugin Options', 'Site Table of Contents', 8, __FILE__, 'stoc_plugin_options');
}

function stoc_plugin_options() {
if (isset($_POST['stoc_form_update'])) {
        update_option(stoc_title, $_POST['form_title']);
        update_option(stoc_exclude, $_POST['form_exclude']);
        echo "<div class=\"updated\"><p><strong>Options saved.</strong></p></div>\n";
}
?>
<div class=wrap>
  <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <h2>Site Table of Contents</h2>
      <h3>General Settings</h3>
      <table width="100%" cellspacing="2" cellpadding="5" class="editform">
        <tr>
          <th nowrap valign="top" width="33%">Table of Contents Title</th>
          <td>Please choose the title you would like displayed above your table of contents.  Leave blank for no title.<br /><br />
			<input type="text" name="form_title" value="<?php echo get_option("stoc_title"); ?>"><br /><br /><br />
          </td>
        </tr>
        <tr>
          <th nowrap valign="top" width="33%">Categories to Exclude</th>
          <td>All categories will be included in the site table of contents by default.  Place a checkbox next to each category that you would like to exclude from the site table of contents.<br /><br />
<?php
$categories = get_categories();
	foreach ($categories as $cat) {
?>
<input type="checkbox" name="form_exclude[]" value="<?php echo $cat->cat_name; ?>" 
<?php
if (in_array($cat->cat_name,get_option("stoc_exclude"))) { 
	echo "checked"; 
}
?>
>
<?php echo $cat->cat_name; ?><br>
<?php
}
?>
      
          </td>
        </tr>
      </table>
    
    <div class="submit">
	<input type="hidden" name="form_exclude[]" value="">
      <input type="submit" name="stoc_form_update" value="Update Options" />
	  </div>
  </form>
</div>
<?php
}

?>
