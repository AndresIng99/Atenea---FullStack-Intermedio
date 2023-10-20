<?php

/**
 * Prime Slider widget filters
 * @since 3.0.0
 */

use PrimeSlider\Admin\ModuleService;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Settings Filters
if (!function_exists('ps_is_dashboard_enabled')) {
    function ps_is_dashboard_enabled() {
        return apply_filters('primeslider/settings/dashboard', true);
    }
}

if (!function_exists('prime_slider_is_widget_enabled')) {
    function prime_slider_is_widget_enabled($widget_id, $options = []) {

        if(!$options){
            $options = get_option('prime_slider_active_modules', []);
        }

        if( ModuleService::is_module_active($widget_id, $options)){
            $widget_id = str_replace('-','_', $widget_id);
            return apply_filters("primeslider/widget/{$widget_id}", true);
        }
    }
}

// if (!function_exists('prime_slider_is_extend_enabled')) {
//     function prime_slider_is_extend_enabled($widget_id, $options = []) {

//         if(!$options){
//             $options = get_option('prime_slider_elementor_extend', []);
//         }

//         if( ModuleService::is_module_active($widget_id, $options)){
//             $widget_id = str_replace('-','_', $widget_id);
//             return apply_filters("primeslider/extend/{$widget_id}", true);
//         }
//     }
// }

if (!function_exists('prime_slider_is_third_party_enabled')) {
    function prime_slider_is_third_party_enabled($widget_id, $options = []) {

        if(!$options){
            $options = get_option('prime_slider_third_party_widget', []);
        }

        if( ModuleService::is_module_active($widget_id, $options)){
            $widget_id = str_replace('-','_', $widget_id);
            return apply_filters("primeslider/widget/{$widget_id}", true);
        }
    }
}

// if (!function_exists('prime_slider_is_asset_optimization_enabled')) {
//     function prime_slider_is_asset_optimization_enabled() {
//         $asset_manager = prime_slider_option('asset-manager', 'prime_slider_other_settings', 'off');
//         if( $asset_manager == 'on'){
//             return apply_filters("primeslider/optimization/asset_manager", true);
//         }
//     }
// }


