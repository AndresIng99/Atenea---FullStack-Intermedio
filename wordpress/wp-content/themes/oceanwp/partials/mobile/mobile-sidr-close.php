<?php
/**
 * Mobile Menu sidr close
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get icon.
$icon_html  = '';
$icon_type  = oceanwp_theme_icon_class();
$theme_icon = oceanwp_theme_icons();
$icon       = $theme_icon['close_x'][ $icon_type ];
$icon_class = get_theme_mod( 'ocean_mobile_menu_close_btn_icon', $icon );

if ( 'svg' === $icon_type ) {
	$icon_html = oceanwp_icon( 'close_x', false );
} else {
	$icon_html = '<i class="icon ' . esc_attr( $icon_class ) . '" aria-hidden="true"></i>';
}

$icon = apply_filters( 'ocean_mobile_menu_close_btn_icon', $icon );

// Text.
$text = get_theme_mod( 'ocean_mobile_menu_close_btn_text' );
$text = oceanwp_tm_translation( 'ocean_mobile_menu_close_btn_text', $text );
$text = $text ? $text : esc_html__( 'Close Menu', 'oceanwp' );

// SEO link txt.
$anchorlink_text = esc_html( oceanwp_theme_strings( 'owp-string-sidr-close-anchor', false ) );

?>

<div id="sidr-close">
	<a href="<?php echo esc_url( ocean_get_site_name_anchors( $anchorlink_text ) ); ?>" class="toggle-sidr-close" aria-label="<?php echo esc_attr( oceanwp_theme_strings( 'owp-string-close-mobile-menu', false ) ); ?>">
		<?php echo wp_kses_post( $icon_html ); ?><span class="close-text"><?php echo do_shortcode( $text ); ?></span>
	</a>
</div>
