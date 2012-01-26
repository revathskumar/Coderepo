<?php
/**
 * Handles public functionality.
 */
class Wdgpo_PublicPages {
	var $data;
	var $codec;

	function Wdgpo_PublicPages () { $this->__construct(); }

	function __construct () {
		$this->data = new Wdgpo_Options;
		$this->codec = new Wdgpo_Codec;
	}

	/**
	 * Main entry point.
	 *
	 * @static
	 */
	function serve () {
		$me = new Wdgpo_PublicPages;
		$me->add_hooks();
	}

	function js_load_scripts () {
		$lang = $this->data->get_option('language');
		echo '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">';
		if ($lang) {
			echo '{lang: "' . $lang . '"}';
		}
		echo '</script>';
	}
/*
	function css_load_styles () {
		wp_enqueue_style('wdgpo_voting_style', WDGPO_PLUGIN_URL . '/css/plusone.css');
	}
*/

	function inject_plusone_buttons ($body) {
		if (
			(is_home() && !$this->data->get_option('front_page'))
			||
			(!is_home() && !is_singular())
		) return $body;
		$position = $this->data->get_option('position');
		if ('top' == $position || 'both' == $position) {
			$body = $this->codec->get_code('plusone') . ' ' . $body;
		}
		if ('bottom' == $position || 'both' == $position) {
			$body .= " " . $this->codec->get_code('plusone');
		}
		return $body;
	}

	function add_hooks () {
		add_action('wp_print_scripts', array($this, 'js_load_scripts'));
		//add_action('wp_print_styles', array($this, 'css_load_styles'));

		// Automatic +1 buttons
		if ('manual' != $this->data->get_option('position')) {
			//add_filter('the_content', array($this, 'inject_plusone_buttons'), 1); // Do this VERY early in content processing
			add_filter('the_content', array($this, 'inject_plusone_buttons'), 10);
		}

		$this->codec->register();
	}
}