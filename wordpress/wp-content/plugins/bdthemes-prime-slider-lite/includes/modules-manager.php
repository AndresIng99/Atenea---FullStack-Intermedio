<?php

namespace PrimeSlider;

use PrimeSlider\Admin\ModuleService;

if ( !defined('ABSPATH') ) {
    exit;
} // Exit if accessed directly

final class Manager {


    public function register_module_and_assets() {

        ModuleService::get_widget_settings(function ($settings) {
            $core_widgets        = $settings['settings_fields']['prime_slider_active_modules'];
            //$extensions          = $settings['settings_fields']['prime_slider_elementor_extend'];
            $third_party_widgets = $settings['settings_fields']['prime_slider_third_party_widget'];

            /**
             * Our Widget
             */
            foreach ( $core_widgets as $widget ) {
                if ( prime_slider_is_widget_enabled($widget['name']) ) {
                    $this->load_module_instance($widget);
                }
            }

            // /**
            //  * Extension
            //  */
            // foreach ( $extensions as $extension ) {
            //     if ( prime_slider_is_extend_enabled($extension['name']) ) {
            //         $this->load_module_instance($extension);
            //     }
            // }

            /**
             * Third Party Widget
             */
            foreach ( $third_party_widgets as $widget ) {
                if ( prime_slider_is_third_party_enabled($widget['name']) ) {
                    if ( isset($widget['plugin_path']) && ModuleService::is_plugin_active($widget['plugin_path']) ) {
                        $this->load_module_instance($widget);
                    }
                }
            }
            // Static module if need
            $this->load_module_instance(['name' => 'elementor']);

        });
    }

    public function load_module_instance($module) {


        $direction = is_rtl() ? '.rtl' : '';
        $suffix    = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        $module_id  = $module['name'];
        $class_name = str_replace('-', ' ', $module_id);
        $class_name = str_replace(' ', '', ucwords($class_name));
        $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\\Module';

        
        if ( !prime_slider_is_preview() ) {
            // register widgets css
            if ( ModuleService::has_module_style($module_id) ) {
                wp_register_style('ps-' . $module_id, BDTPS_URL . 'assets/css/ps-' . $module_id . $direction . '.css', [], BDTPS_VER);
            }
            // register widget JS
            if ( ModuleService::has_module_script($module_id) ) {
                wp_register_script('ps-' . $module_id, BDTPS_URL . 'assets/js/modules/ps-' . $module_id . $suffix . '.js', ['jquery', 'bdt-uikit', 'elementor-frontend'], BDTPS_VER, true);
            }
        }
        

         if(class_exists($class_name)){
            $class_name::instance();
        }
    }

    public function __construct() {

        $this->register_module_and_assets();
    }
}
