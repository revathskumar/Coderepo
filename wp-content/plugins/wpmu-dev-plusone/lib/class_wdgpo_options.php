<?php
/**
 * Handles options access.
 */
class Wdgpo_Options {
	/**
	 * Gets a single option from options storage.
	 */
	function get_option ($key) {
		$opts = get_option('wdgpo');
		return @$opts[$key];
	}

	/**
	 * Sets all stored options.
	 */
	function set_options ($opts) {
		return WP_NETWORK_ADMIN ? update_site_option('wdgpo', $opts) : update_option('wdgpo', $opts);
	}

	/**
	 * Populates options key for storage.
	 *
	 * @static
	 */
	function populate () {
		$site_opts = get_site_option('wdgpo');
		$site_opts = is_array($site_opts) ? $site_opts : array();

		$opts = get_option('wdgpo');
		$opts = is_array($opts) ? $opts : array();

		$res = array_merge($site_opts, $opts);
		update_option('wdgpo', $res);
	}

}