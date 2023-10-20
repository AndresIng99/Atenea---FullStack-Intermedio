<?php
/**
 * Quick view template.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>

<div id="owp-qv-wrap">
	<div class="owp-qv-container">
		<div class="owp-qv-content-wrap">
			<div class="owp-qv-content-inner">
				<a href="#" class="owp-qv-close" aria-label="<?php echo esc_attr( oceanwp_theme_strings( 'owp-string-woo-quick-view-close', false ) ); ?>">×</a>
				<div id="owp-qv-content" class="woocommerce single-product"></div>
			</div>
		</div>
	</div>
	<div class="owp-qv-overlay"></div>
</div>
