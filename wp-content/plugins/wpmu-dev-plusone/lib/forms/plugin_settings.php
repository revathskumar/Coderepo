<div class="wrap">
	<h2><?php _e('Google +1 settings', 'wdgpo');?></h2>

<?php if (WP_NETWORK_ADMIN) { ?>
	<form action="settings.php" method="post">
<?php } else { ?>
	<form action="options.php" method="post">
<?php } ?>

	<?php settings_fields('wdgpo'); ?>
	<?php do_settings_sections('wdgpo_options_page'); ?>
	<p class="submit">
		<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	</p>
	</form>

<?php _e('<h2>Shortcode</h2>  <p>In addition to (or instead of) the auto-inserted Google +1 buttons, you may want to use the shortcode to embed the button in your posts.</p>  <dl>  <dt>Tag: <code>wdgpo_plusone</code></dt>  <dd>Embeds Google +1 button in your post</dd>  <dd>  Arguments:  <ul>  <li>  <code>appearance</code> (<em>optional</em>) - Accepts one of these values: <code>small</code>, <code>medium</code>, <code>standard</code>, <code>tall</code>. Default values are set on plugin settings page.  </li>  <li>  <code>show_count</code> (<em>optional</em>) - Accepts <code>yes</code> or <code>no</code> as values. Default values are set on plugin settings page.  </li>  </ul>  </dd>  <dd>  Examples:  <ul>  <li>  <code>[wdgpo_plusone]</code> - Embeds Google +1 button in your post, with defaults set on plugin settings page.  </li>  <li>  <code>[wdgpo_plusone appearance="tall"]</code> - Embeds Google +1 <em>tall</em> button in your post, with other options taken from plugin settings.  </li>  <li>  <code>[wdgpo_plusone show_count="no"]</code> - Embeds Google +1 button without count in your post, with other options taken from plugin settings.  </li>  </ul>  </dd> </dl>    <h2>Styling</h2>  <p>If you need some extra styling done (e.g. floating the button), the button is wrapped in a <code>DIV</code> with class <code>wdgpo</code>.</p>  <p>Based on the rendered button appearance and count, additional classes will be set:</p>  <ul>  <li><code>wdgpo_small_count</code></li>  <li><code>wdgpo_small_nocount</code></li>  <li><code>wdgpo_medium_count</code></li>  <li><code>wdgpo_medium_nocount</code></li>  <li><code>wdgpo_standard_count</code></li>  <li><code>wdgpo_standard_nocount</code></li>  <li><code>wdgpo_tall_count</code></li>  <li><code>wdgpo_tall_nocount</code></li> </ul>', 'wdgpo'); ?>

</div>