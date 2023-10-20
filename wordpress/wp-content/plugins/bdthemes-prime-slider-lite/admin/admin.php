<?php

namespace PrimeSlider;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly


require_once BDTPS_ADMIN_PATH . 'class-settings-api.php';
if (current_user_can('manage_options')) {
	require_once BDTPS_ADMIN_PATH . 'admin-feeds.php';
}
// element pack admin settings here
require_once BDTPS_ADMIN_PATH . 'admin-settings.php';

/**
 * Admin class
 */

class Admin {

	public function __construct() {

		// Embed the Script on our Plugin's Option Page Only
		if (isset($_GET['page']) && ($_GET['page'] == 'prime_slider_options')) {
			add_action('admin_init', [$this, 'admin_script']);
			add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
		}

		add_action('after_setup_theme', [$this, 'whitelabel']);

		// register_activation_hook(BDTPS__FILE__, 'install_and_activate');

	}

	function install_and_activate() {

		// I don't know of any other redirect function, so this'll have to do.
		wp_redirect(admin_url('admin.php?page=prime_slider_options'));
		// You could use a header(sprintf('Location: %s', admin_url(...)); here instead too.
	}

	/**
	 * You can easily add white label branding for extended license or multi site license. Don't try for regular license otherwise your license will be invalid.
	 * @return [type] [description]
	 * Define BDTPS_WL for execute white label branding
	 */
	public function whitelabel() {
		if (defined('BDTPS_WL')) {

			add_filter('gettext', [$this, 'prime_slider_name_change'], 20, 3);

			if (defined('BDTPS_HIDE')) {
				add_action('pre_current_active_plugins', [$this, 'hide_prime_slider']);
			}
		} else {
			add_filter('plugin_row_meta', [$this, 'plugin_row_meta'], 10, 2);
			add_filter('plugin_action_links_' . BDTPS_PBNAME, [$this, 'plugin_action_meta']);
		}
	}

	/**
	 * Enqueue styles
	 * @access public
	 */

	public function enqueue_styles() {

		$direction_suffix = is_rtl() ? '.rtl' : '';
		$suffix           = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style('bdt-uikit', BDTPS_ASSETS_URL . 'css/bdt-uikit' . $direction_suffix . '.css', [], '3.15.3');
		wp_enqueue_style('prime-slider-font', BDTPS_ASSETS_URL . 'css/prime-slider-font' . $direction_suffix . '.css', [], BDTPS_VER);
		wp_enqueue_style('ps-admin', BDTPS_ADMIN_URL . 'assets/css/ps-admin' . $direction_suffix . '.css', [], BDTPS_VER);

		wp_enqueue_script('bdt-uikit', BDTPS_ASSETS_URL . 'js/bdt-uikit.min.js', ['jquery'], '3.15.3');
	}

	/**
	 * Row meta
	 * @access public
	 * @return array
	 */

	public function plugin_row_meta($plugin_meta, $plugin_file) {
		if (BDTPS_PBNAME === $plugin_file) {
			$row_meta = [
				'docs'  => '<a href="https://bdthemes.com/support/" aria-label="' . esc_attr(__('Go for Get Support', 'bdthemes-prime-slider')) . '" target="_blank">' . __('Get Support', 'bdthemes-prime-slider') . '</a>',
				'video' => '<a href="https://www.youtube.com/playlist?list=PLP0S85GEw7DOJf_cbgUIL20qqwqb5x8KA" aria-label="' . esc_attr(__('View Prime Slider Video Tutorials', 'bdthemes-prime-slider')) . '" target="_blank">' . __('Video Tutorials', 'bdthemes-prime-slider') . '</a>',
			];

			$plugin_meta = array_merge($plugin_meta, $row_meta);
		}

		return $plugin_meta;
	}

	/**
	 * Action meta
	 * @access public
	 * @return array
	 */


	public function plugin_action_meta($links) {

		$links = array_merge([sprintf('<a href="%s">%s</a>', prime_slider_dashboard_link('#prime_slider_welcome'), esc_html__('Settings', 'bdthemes-prime-slider'))], $links);

		$links = array_merge($links, [
			sprintf(
				'<a href="%s">%s</a>',
				prime_slider_dashboard_link('#license'),
				esc_html__('License', 'bdthemes-prime-slider')
			)
		]);

		return $links;
	}

	/**
	 * Change Prime Slider Name
	 * @access public
	 * @return string
	 */

	public function prime_slider_name_change($translated_text, $text, $domain) {
		switch ($translated_text) {
			case 'Prime Slider':
				$translated_text = BDTPS_TITLE;
				break;
		}

		return $translated_text;
	}

	/**
	 * Hiding plugins //still in testing purpose
	 * @access public
	 */

	public function hide_prime_slider() {
		global $wp_list_table;
		$hide_plg_array = array('bdthemes-prime-slider/bdthemes-prime-slider.php');
		$all_plugins    = $wp_list_table->items;

		foreach ($all_plugins as $key => $val) {
			if (in_array($key, $hide_plg_array)) {
				unset($wp_list_table->items[$key]);
			}
		}
	}

	/**
	 * Register admin script
	 * @access public
	 */

	public function admin_script() {
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		if (is_admin()) { // for Admin Dashboard Only
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-form');
			
			wp_enqueue_script('chart', BDTPS_ADMIN_URL . 'assets/js/chart.min.js', ['jquery'], '3.9.3', true);
			wp_enqueue_script('ps-admin', BDTPS_ADMIN_URL  . 'assets/js/ps-admin'. $suffix .'.js', ['jquery', 'chart'], BDTPS_VER, true);
		}
	}
}
