<?php
/**
 * Handles all Admin access functionality.
 */
class Wdgpo_AdminPages {

	var $data;

	function Wdgpo_AdminPages () { $this->__construct(); }

	function __construct () {
		$this->data = new Wdgpo_Options;
	}

	/**
	 * Main entry point.
	 *
	 * @static
	 */
	function serve () {
		$me = new Wdgpo_AdminPages;
		$me->add_hooks();
	}

	function create_site_admin_menu_entry () {
		if (@$_POST && isset($_POST['option_page']) && 'wdgpo' == @$_POST['option_page']) {
			if (isset($_POST['wdgpo'])) {
				$this->data->set_options($_POST['wdgpo']);
			}
			$goback = add_query_arg('settings-updated', 'true',  wp_get_referer());
			wp_redirect($goback);
		}
		add_submenu_page('settings.php', 'Google +1', 'Google +1', 'manage_network_options', 'wdgpo', array($this, 'create_admin_page'));
	}

	function register_settings () {
		$form = new Wdgpo_AdminFormRenderer;

		register_setting('wdgpo', 'wdgpo');
		add_settings_section('wdgpo_settings', __('Google +1 settings', 'wdgpo'), create_function('', ''), 'wdgpo_options_page');
		add_settings_field('wdgpo_appearance', __('Appearance', 'wdgpo'), array($form, 'create_appearance_box'), 'wdgpo_options_page', 'wdgpo_settings');
		add_settings_field('wdgpo_show_cout', __('Show +1s count', 'wdgpo'), array($form, 'create_show_count_box'), 'wdgpo_options_page', 'wdgpo_settings');
		add_settings_field('wdgpo_position', __('Google +1 box position', 'wdgpo'), array($form, 'create_position_box'), 'wdgpo_options_page', 'wdgpo_settings');
		add_settings_field('wdgpo_skip_post_types', __('Do <strong>NOT</strong> Google +1 box for these post types', 'wdgpo'), array($form, 'create_skip_post_types_box'), 'wdgpo_options_page', 'wdgpo_settings');
		add_settings_field('wdgpo_language', __('Language', 'wdgpo'), array($form, 'create_language_box'), 'wdgpo_options_page', 'wdgpo_settings');
		add_settings_field('wdgpo_front_page', __('Show +1 on Front Page', 'wdgpo'), array($form, 'create_front_page_box'), 'wdgpo_options_page', 'wdgpo_settings');
	}

	function create_blog_admin_menu_entry () {
		add_options_page('Google +1', 'Google +1', 'manage_options', 'wdgpo', array($this, 'create_admin_page'));
	}

	function create_admin_page () {
		include(WDGPO_PLUGIN_BASE_DIR . '/lib/forms/plugin_settings.php');
	}

	function add_hooks () {
		// Step0: Register options and menu
		add_action('admin_init', array($this, 'register_settings'));
		if (WP_NETWORK_ADMIN) {
			add_action('network_admin_menu', array($this, 'create_site_admin_menu_entry'));
		} else {
			add_action('admin_menu', array($this, 'create_blog_admin_menu_entry'));
		}


	}
}