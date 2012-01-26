<?php
/*
Plugin Name: Gravatar Hovercards
Plugin URI: http://www.w7b.org/wp-plugins/gravatar-hovercards-plugin.html
Description: Enables Gravatar Hovercards in any Wordpress Blogs. Code by Ottopress, Pluginized By <a href="http://www.w7b.org">Abhik</a>.
Version: 1.1
Author: Abhik
Author URI: http://www.w7b.org
License: GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/
?>
<?php
function gravatar_hovercards() {
	wp_enqueue_script( 'gprofiles', 'http://s.gravatar.com/js/gprofiles.js', array( 'jquery' ), 'e', true );
}
add_action('wp_enqueue_scripts','gravatar_hovercards');
?>