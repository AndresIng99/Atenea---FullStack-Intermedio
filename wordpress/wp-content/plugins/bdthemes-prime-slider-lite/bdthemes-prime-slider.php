<?php

/**
 * Plugin Name: Prime Slider
 * Plugin URI: https://primeslider.pro/
 * Description: Prime Slider is a packed of elementor widget that gives you some awesome header and slider combination for your website.
 * Version: 3.8.2
 * Author: BdThemes
 * Author URI: https://bdthemes.com/
 * Text Domain: bdthemes-prime-slider
 * Domain Path: /languages
 * License: GPL3
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.14.1
 *
 */

if ( function_exists( 'bdt_ps' ) ) {
    bdt_ps()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'bdt_ps' ) ) {
        // Create a helper function for easy SDK access.
        function bdt_ps()
        {
            global  $bdt_ps ;
            
            if ( !isset( $bdt_ps ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $bdt_ps = fs_dynamic_init( array(
                    'id'              => '4929',
                    'slug'            => 'bdthemes-prime-slider',
                    'premium_slug'    => 'bdthemes-prime-slider',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_63d316bc5d81a4c5a175ea7650d2b',
                    'is_premium'      => false,
                    'premium_suffix'  => 'Pro',
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'has_affiliation' => 'selected',
                    'menu'            => array(
                    'slug'    => 'prime_slider_options',
                    'support' => false,
                ),
                    'is_live'         => true,
                ) );
            }
            
            return $bdt_ps;
        }
        
        // Init Freemius.
        bdt_ps();
        // Signal that SDK was initiated.
        do_action( 'bdt_ps_loaded' );
    }
    
    // Some pre define value for easy use
    define( 'BDTPS_VER', '3.8.2' );
    define( 'BDTPS__FILE__', __FILE__ );
    // Helper function here
    include dirname( __FILE__ ) . '/includes/helper.php';
    include dirname( __FILE__ ) . '/includes/utils.php';
    /**
     * Plugin load here correctly
     * Also loaded the language file from here
     */
    function prime_slider_load_plugin()
    {
        load_plugin_textdomain( 'bdthemes-prime-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );
        
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', 'prime_slider_fail_load' );
            return;
        }
        
        // Filters for developer
        require BDTPS_PATH . 'includes/prime-slider-filters.php';
        // Prime Slider widget and assets loader
        require BDTPS_PATH . 'loader.php';
        // Notice class
        require BDTPS_ADMIN_PATH . 'admin-notice.php';
    }
    
    add_action( 'plugins_loaded', 'prime_slider_load_plugin' );
    /**
     * Check Elementor installed and activated correctly
     */
    function prime_slider_fail_load()
    {
        $screen = get_current_screen();
        if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
            return;
        }
        $plugin = 'elementor/elementor.php';
        
        if ( _is_elementor_installed() ) {
            if ( !current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
            $admin_message = '<p>' . esc_html__( 'Ops! Prime Slider not working because you need to activate the Elementor plugin first.', 'bdthemes-prime-slider' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'bdthemes-prime-slider' ) ) . '</p>';
        } else {
            if ( !current_user_can( 'install_plugins' ) ) {
                return;
            }
            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $admin_message = '<p>' . esc_html__( 'Ops! Prime Slider not working because you need to install the Elementor plugin', 'bdthemes-prime-slider' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'bdthemes-prime-slider' ) ) . '</p>';
        }
        
        echo  '<div class="error">' . $admin_message . '</div>' ;
    }
    
    /**
     * Check the elementor installed or not
     */
    if ( !function_exists( '_is_elementor_installed' ) ) {
        function _is_elementor_installed()
        {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();
            return isset( $installed_plugins[$file_path] );
        }
    
    }
}
