<?php
/*
Plugin Name: Seo Meta Tags
Plugin URI: http://www.wordpressapi.com/wordpress-plugins/
Description: This plugin will add post excerpt as a meta tags of each individual post. 
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
Version: 1.0
Author: Wordpressapi.com
Author URI: http://www.wordpressapi.com
*/

add_action('admin_menu', 'seometa_add_pages');
add_action('update_seo_meta_tags', 'seometa_site_admin_options_process');
add_action('wp_head', 'seometa_add_meta',99);


function seometa_add_pages() {
    add_management_page('Seo Meta Tags', 'Seo Meta Tags', 'manage_options', 'seo-meta-tags', 'seometa_site_admin_options');
}

function seometa_site_admin_options_process() {
	update_option( 'seo_meta_tags[description]' , $_POST['seo_meta_tags']['description'] );
	update_option( 'seo_meta_tags[keywords]' , $_POST['seo_meta_tags']['keywords'] );
}


function seometa_site_admin_options() {
	
	if ($_POST['action'] == 'update') { do_action( 'update_seo_meta_tags' ); }
	
	?>
	<div class="tool-box">
	<h3 class="title"><?php _e('Seo Meta Tags') ?></h3> 
	<p>You can enter your meta keywords and description for your homepage.<br>
	This plugin will add Meta description for each individual post as your excerpt of your post.
	This will help your blog to rank better in google. You can easily inrease your blog traffic using this plugin.
	<a href="http://www.wordpressapi.com/wordpress-plugins">Wordpressapi.com</a>
	
	<form method="post">
	<input type="hidden" name="action" value="update" />
	 <?php wp_nonce_field('seo_meta_tags'); ?>
							
		
		<table class="form-table">
			<tr valign='top'>
			<th scope='row'>Seo Meta Tags Keywords</th>
				<td>
				<input size='50' name='seo_meta_tags[keywords]' type='text' value="<?php echo get_option('seo_meta_tags[keywords]'); ?>" />
				</td>
			</tr><tr>
				<td colspan='2'>
				<label for='seo_meta_tags[keywords]'>Example: <code>&lt;meta name='keywords' content='<strong><font color="blue">Wordpress,Social Networking, Social Media, News, Web, Technology, Web 2.0, Tech, Information, Blog, Facebook, YouTube, Google, Top,Main Page,About WordPress,Advanced Topics,Backing Up Your Database,Backing Up Your WordPress Files,Blog Design and Layout,CSS,Contributing to WordPress,Core Update Host Compatibility,Database Description,Developer Documentation</font></strong>'&gt;</code></label>
				</td>
			</tr>


			<tr valign='top'>
			<th scope='row'>Seo Meta Tags Description</th>
				<td>
				<input size='50' name='seo_meta_tags[description]' type='text' value="<?php echo get_option('seo_meta_tags[description]'); ?>" />
				</td>
			</tr><tr>
				<td colspan='2'>
				<label for='seo_meta_tags[description]'>Example: <code>&lt;meta name='description' content='<strong><font color="blue">Wordpressapi.com is focused on design and web-development. We deliver useful information, latest trends and techniques, useful ideas, innovative approaches and tools. Social Media news blog covering cool new websites and social networks: Facebook, Google, Twitter, MySpace and YouTube.  The latest web technology news, via RSS daily.</font></strong>'&gt;</code></label>
				</td>
			</tr>



		</table>
	<p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>
	</form>
	</div>
	<?php
}



function seometa_add_meta() {
if (get_option('seo_meta_tags[description]') != '') { 

if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php echo get_option('seo_meta_tags[description]'); ?>" />
<?php 
	endif; 
 } 

if (get_option('seo_meta_tags[keywords]') != '') { ?>
<meta name="keywords" content="<?php echo get_option('seo_meta_tags[keywords]'); ?>" />
<?php } 

}

