<?php

namespace PrimeSlider;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

/**
 * Admin_Feeds class
 */

class Prime_Slider_Admin_Feeds {

	public function __construct() {
		add_action('admin_enqueue_scripts', [$this, 'enqueue_product_feeds_styles']);
		add_action('wp_dashboard_setup', [$this, 'bdthemes_prime_slider_register_rss_feeds']);
	}

	/**
	 * Enqueue Admin Style Files
	 */
	function enqueue_product_feeds_styles($hook) {
		if ('index.php' != $hook) {
			return;
		}
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style('ps-product-feed', BDTPS_ADMIN_URL . 'assets/css/ps-product-feed' . $direction_suffix . '.css', [], BDTPS_VER);
	}


	/**
	 * Prime Slider Feeds Register
	 */

	public function bdthemes_prime_slider_register_rss_feeds() {
		wp_add_dashboard_widget('bdt-ps-dashboard-overview', esc_html__('Prime Slider News &amp; Updates', 'bdthemes-prime-slider'), [
			$this,
			'bdthemes_prime_slider_rss_feeds_content_data'
		], null, null, 'column4', 'core');
	}

	/**
	 * Prime Slider dashboard overview fetch content data
	 */
	public function bdthemes_prime_slider_rss_feeds_content_data() {
		echo '<div class="bdt-ps-dashboard-widget">';
		$feeds = array();
		$feeds = $this->bdthemes_prime_slider_get_feeds_remote_data();
		if (is_array($feeds)) :
			foreach ($feeds as $key => $feed) {
				printf('<div class="bdt-product-feeds-content activity-block"><a href="%s" target="_blank"><img class="bdt-ps-promo-image" src="%s"></a> <p>%s</p></div>', $feed->demo_link, $feed->image, $feed->content);
			}
		endif;
		echo $this->bdthemes_prime_slider_get_feeds_posts_data();
	}

	/**
	 * Prime Slider dashboard overview fetch remote data
	 */
	public function bdthemes_prime_slider_get_feeds_remote_data() {
		$source      = wp_remote_get('https://dashboard.bdthemes.io/wp-json/bdthemes/v1/product-feed/?product_category=prime-slider');
		$reponse_raw = wp_remote_retrieve_body($source);
		$reponse     = json_decode($reponse_raw);

		return $reponse;
	}

	/**
	 * Prime Slider dashboard overview fetch posts data
	 */
	public function bdthemes_prime_slider_get_feeds_posts_data() {
		// Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		$rss = fetch_feed('https://bdthemes.com/feed');
		if (!is_wp_error($rss)) {
			$maxitems  = $rss->get_item_quantity(5);
			$rss_items = $rss->get_items(0, $maxitems);
		} else {
			$maxitems = 0;
		}
?>
		<!-- // Display the container -->
		<div class="bdt-ps-overview__feed">
			<ul class="bdt-ps-overview__posts">
				<?php
				// Check items
				if ($maxitems == 0) {
					echo '<li class="bdt-ps-overview__post">' . __('No item', 'bdthemes-prime-slider-lite') . '.</li>';
				} else {
					foreach ($rss_items as $item) :
						$feed_url = $item->get_permalink();
						$feed_title = $item->get_title();
						$feed_date = human_time_diff($item->get_date('U'), current_time('timestamp')) . ' ' . __('ago', 'bdthemes-prime-slider-lite');
						$content = $item->get_content();
						$feed_content = wp_html_excerpt($content, 120) . ' [...]';
				?>
						<li class="bdt-ps-overview__post">
							<?php printf('<a class="bdt-ps-overview__post-link" href="%1$s" title="%2$s">%3$s</a>', $feed_url, $feed_date, $feed_title);
							printf('<span class="bdt-ps-overview__post-date">%1$s</span>', $feed_date);
							printf('<p class="bdt-ps-overview__post-description">%1$s</p>', $feed_content); ?>

						</li>
				<?php
					endforeach;
				}
				?>
			</ul>
			<div class="bdt-ps-overview__footer bdt-ps-divider_top">
				<ul>
					<?php
					$footer_link = [
						[
							'url'   => 'https://bdthemes.com/blog/',
							'title' => esc_html__('Blog', 'bdthemes-prime-slider-lite'),
						],
						[
							'url'   => 'https://bdthemes.com/knowledge-base/',
							'title' => esc_html__('Docs', 'bdthemes-prime-slider-lite'),
						],
						[
							'url'   => 'https://www.primeslider.pro/pricing/',
							'title' => esc_html__('Get Pro', 'bdthemes-prime-slider-lite'),
						],
						[
							'url'   => 'https://bdthemes.frill.co/announcements/',
							'title' => esc_html__('Changelog', 'bdthemes-prime-slider-lite'),
						],
					];
					foreach ($footer_link as $key => $link) {
						printf('<li><a href="%1$s" target="_blank">%2$s<span aria-hidden="true" class="dashicons dashicons-external"></span></a></li>', $link['url'], $link['title']);
					}
					?>
				</ul>
			</div>
		</div>
		</div>
<?php
	}
}

new Prime_Slider_Admin_Feeds();
