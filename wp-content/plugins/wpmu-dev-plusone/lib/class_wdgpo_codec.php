<?php
/**
 * Handles shortcode creation and replacement.
 */
class Wdgpo_Codec {

	var $shortcodes = array(
		'plusone' => 'wdgpo_plusone',
	);

	var $data;
	function Wdgpo_Codec () { $this->__construct(); }

	function __construct () {
		$this->data = new Wdgpo_Options;
	}

	function _check_display_restrictions ($post_id) {
		if (!$post_id) return false;

		$type = get_post_type($post_id);
		if (!$type) return false;

		$skip_types = $this->data->get_option('skip_post_types');
		if (!is_array($skip_types)) return true; // No restrictions, we're good

		return (!in_array($type, $skip_types));
	}

	function process_plusone_code ($args) {
		$post_id = get_the_ID();
		if (!$this->_check_display_restrictions($post_id)) return '';

		$args = shortcode_atts(array(
			'appearance' => false,
			'show_count' => false,
		), $args);

		$size = $args['appearance'] ? $args['appearance'] : $this->data->get_option('appearance');
		$url = get_permalink();
		$show_count = $args['show_count'] ? ('yes' == $args['show_count']) : $this->data->get_option('show_count');
		$count = $show_count ? 'true' : 'false';
		$count_class = ('true' == $count) ? 'count' : 'nocount';

		$ret = "<div class='wdgpo wdgpo_{$size}_{$count_class}'><g:plusone annotation='inline' size='{$size}' count='{$count}' href='{$url}'></g:plusone></div>";
		return $ret;
	}

	function get_code ($key) {
		return '[' . $this->shortcodes[$key] . ']';
	}

	/**
	 * Registers shortcode handlers.
	 */
	function register () {
		foreach ($this->shortcodes as $key=>$shortcode) {
			add_shortcode($shortcode, array($this, "process_{$key}_code"));
		}
	}
}