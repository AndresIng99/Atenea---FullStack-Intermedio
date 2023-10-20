<?php

namespace PrimeSlider\Admin;



if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

class ModuleService {



    public static function get_widget_settings($callable) {

        $settings_fields = [
            'prime_slider_active_modules' => [
                [
                    'name'         => 'astoria',
                    'label'        => esc_html__('Astoria', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/astoria/',
                    'video_url'    => 'https://youtu.be/Vpa_WPQ0mWw',
                ],

                [
                    'name'         => 'avatar',
                    'label'        => esc_html__('Avatar', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/avatar/',
                    'video_url'    => 'https://youtu.be/qmNOWgzTt_Q',
                ],

                [
                    'name'         => 'blog',
                    'label'        => esc_html__('Blog', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/blog/',
                    'video_url'    => 'https://youtu.be/G32YlydUcHg',
                ],

                [
                    'name'         => 'coddle',
                    'label'        => esc_html__('Coddle', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static new',
                    'demo_url'     => 'https://primeslider.pro/demo/coddle/',
                    'video_url'    => 'https://youtu.be/mgT1NMMBEFA',
                ],

                [
                    'name'         => 'crossroad',
                    'label'        => esc_html__('Crossroad', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/crossroad/',
                    'video_url'    => 'https://youtu.be/zXYPK3yER1I',
                ],

                [
                    'name'         => 'custom',
                    'label'        => esc_html__('Custom Slider', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'custom static',
                    'demo_url'     => 'https://primeslider.pro/demo/custom/',
                    'video_url'    => 'https://youtu.be/Ayo1oEALF_8',
                ],

                //     [
                //         'name'         => 'diagonal',
                //         'label'        => esc_html__( 'Diagonal', 'bdthemes-prime-slider' ),
                //         'type'         => 'checkbox',
                //         'default'      => "off",
                //         'widget_type'  => 'pro',
                //         'content_type' => 'Custom carousel new',
                //         'demo_url'     => 'https://primeslider.pro/demo/diagonal/',
                //         'video_url'    => '',
                //     ];
                // }

                [
                    'name'         => 'dragon',
                    'label'        => esc_html__('Dragon', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/dragon/',
                    'video_url'    => 'https://youtu.be/eL0a9f7VEtc',
                ],

                [
                    'name'         => 'elysium',
                    'label'        => esc_html__('Elysium', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/elysium/',
                    'video_url'    => 'https://youtu.be/S3c1G6AFGi0',
                ],

                [
                    'name'         => 'escape',
                    'label'        => esc_html__('Escape', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/escape/',
                    'video_url'    => 'https://youtu.be/WTqtALRdhDc',
                ],

                [
                    'name'         => 'fiestar',
                    'label'        => esc_html__('Fiestar', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post carousel',
                    'demo_url'     => 'https://primeslider.pro/demo/fiestar/',
                    'video_url'    => 'https://youtu.be/8neRnv80lMU',
                ],

                [
                    'name'         => 'flexure',
                    'label'        => esc_html__('Flexure', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/flexure/',
                    'video_url'    => 'https://youtu.be/swPVYPWIZXI',
                ],

                [
                    'name'         => 'flogia',
                    'label'        => esc_html__('Flogia', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/flogia/',
                    'video_url'    => 'https://youtu.be/4YaNEk5FbUc',
                ],

                [
                    'name'         => 'fluent',
                    'label'        => esc_html__('Fluent', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/fluent/',
                    'video_url'    => 'https://youtu.be/HxwdDoOsdMA',
                ],

                [
                    'name'         => 'fortune',
                    'label'        => esc_html__('Fortune', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/fortune/',
                    'video_url'    => 'https://youtu.be/9MgVFXb3vD8',
                ],

                [
                    'name'         => 'general',
                    'label'        => esc_html__('General', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/general/',
                    'video_url'    => 'https://youtu.be/VMBuGusjvtM',
                ],

                [
                    'name'         => 'isolate',
                    'label'        => esc_html__('Isolate', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/isolate/',
                    'video_url'    => 'https://youtu.be/8wlCWhSMQno',
                ],

                [
                    'name'         => 'knily',
                    'label'        => esc_html__('Knily', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/knily/',
                    'video_url'    => 'https://youtu.be/VYjEPeDZv5k',
                ],

                [
                    'name'         => 'marble',
                    'label'        => esc_html__('Marble', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'post carousel',
                    'demo_url'     => 'https://primeslider.pro/demo/marble/',
                    'video_url'    => 'https://youtu.be/gdBqzj1jUzs',
                ],

                [
                    'name'         => 'mercury',
                    'label'        => esc_html__('Mercury', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/mercury/',
                    'video_url'    => 'https://youtu.be/4Dk1ysRtGWk',
                ],

                [
                    'name'         => 'monster',
                    'label'        => esc_html__('Monster', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static carousel',
                    'demo_url'     => 'https://primeslider.pro/demo/monster/',
                    'video_url'    => 'https://youtu.be/BH-0sfptHeQ',
                ],

                [
                    'name'         => 'mount',
                    'label'        => esc_html__('Mount', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/mount/',
                    'video_url'    => 'https://youtu.be/DGIlfM61T0E',
                ],

                [
                    'name'         => 'multiscroll',
                    'label'        => esc_html__('Multiscroll', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "on",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/multiscroll/',
                    'video_url'    => 'https://youtu.be/uzBHDw_mdRE',
                ],

                [
                    'name'         => 'omatic',
                    'label'        => esc_html__('Omatic', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static new',
                    'demo_url'     => 'https://primeslider.pro/demo/omatic/',
                    'video_url'    => '',
                ],

                [
                    'name'         => 'pacific',
                    'label'        => esc_html__('Pacific', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/pacific/',
                    'video_url'    => 'https://youtu.be/H0X7qTvts9E',
                ],

                [
                    'name'         => 'pagepiling',
                    'label'        => esc_html__('Pagepiling', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/pagepiling/',
                    'video_url'    => 'https://youtu.be/L7eWKJaZj5I',
                ],

                [
                    'name'         => 'paranoia',
                    'label'        => esc_html__('Paranoia', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/paranoia/',
                    'video_url'    => 'https://youtu.be/n_OEl4wkuJE',
                ],

                [
                    'name'         => 'pieces',
                    'label'        => esc_html__('Pieces', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/pieces/',
                    'video_url'    => 'https://youtu.be/031PlTfbYJs',
                ],

                [
                    'name'         => 'prism',
                    'label'        => esc_html__('Prism', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/prism/',
                    'video_url'    => '',
                ],

                // [
                //     'name'         => 'paramount',
                //     'label'        => esc_html__( 'Paramount', 'bdthemes-prime-slider' ),
                //     'type'         => 'checkbox',
                //     'default'      => "off",
                //     'widget_type'  => 'pro',
                //     'content_type' => 'static',
                //     'demo_url'     => 'https://primeslider.pro/demo/paramount/',
                //     'video_url'    => '',
                // ],

                [
                    'name'         => 'remote-arrows',
                    'label'        => esc_html__('Remote Arrows', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://primeslider.pro/demo/remote-arrows/',
                    'video_url'    => 'https://youtu.be/Lm_B9VaWDXA',
                ],

                [
                    'name'         => 'remote-fraction',
                    'label'        => esc_html__('Remote Fraction', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://primeslider.pro/demo/remote-fraction/',
                    'video_url'    => 'https://youtu.be/c5mgJB2jTGw',
                ],

                [
                    'name'         => 'remote-pagination',
                    'label'        => esc_html__('Remote Pagination', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://primeslider.pro/demo/remote-pagination/',
                    'video_url'    => 'https://youtu.be/Bp-6mMJIE74',
                ],

                [
                    'name'         => 'remote-thumbs',
                    'label'        => esc_html__('Remote Thumbs', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'others',
                    'demo_url'     => 'https://primeslider.pro/demo/remote-thumbs/',
                    'video_url'    => 'https://youtu.be/QW1EX2h6Fhw',
                ],

                //     [
                //         'name'         => 'landscape',
                //         'label'        => esc_html__( 'Landscape', 'bdthemes-prime-slider' ),
                //         'type'         => 'checkbox',
                //         'default'      => "off",
                //         'widget_type'  => 'pro',
                //         'content_type' => 'static new',
                //         'demo_url'     => 'https://primeslider.pro/demo/landscape/',
                //         'video_url'    => '',
                //     ];
                // }

                [
                    'name'         => 'reveal',
                    'label'        => esc_html__('Reveal', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/reveal/',
                    'video_url'    => 'https://youtu.be/pmBWj3tkuO8',
                ],

                [
                    'name'         => 'rubix',
                    'label'        => esc_html__('Rubix', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post carousel',
                    'demo_url'     => 'https://primeslider.pro/demo/rubix/',
                    'video_url'    => 'https://youtu.be/mEPQjmjhCkY',
                ],

                // [
                //     'name'         => 'radar',
                //     'label'        => esc_html__( 'Radar', 'bdthemes-prime-slider' ),
                //     'type'         => 'checkbox',
                //     'default'      => "off",
                //     'widget_type'  => 'pro',
                //     'content_type' => 'post carousel',
                //     'demo_url'     => 'https://primeslider.pro/demo/radar/',
                //     'video_url'    => 'https://youtu.be/mEPQjmjhCkY',
                // ],

                [
                    'name'         => 'sequester',
                    'label'        => esc_html__('Sequester', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/sequester/',
                    'video_url'    => 'https://youtu.be/pk5kCstNHBY',
                ],

                [
                    'name'         => 'sniper',
                    'label'        => esc_html__('Sniper', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/sniper/',
                    'video_url'    => 'https://youtu.be/KZstgwk-pog',
                ],

                [
                    'name'         => 'storker',
                    'label'        => esc_html__('Storker', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post',
                    'demo_url'     => 'https://primeslider.pro/demo/storker/',
                    'video_url'    => 'https://youtu.be/Lsg15pGppb0',
                ],

                [
                    'name'         => 'tango',
                    'label'        => esc_html__('Tango', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'static',
                    'demo_url'     => 'https://primeslider.pro/demo/tango/',
                    'video_url'    => 'https://youtu.be/OdXH9cSgdz4',
                ],

                [
                    'name'         => 'titanic',
                    'label'        => esc_html__('Titanic', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'static new',
                    'demo_url'     => 'https://primeslider.pro/demo/titanic/',
                    'video_url'    => '',
                ],

                // [
                //     'name'         => 'twinkle',
                //     'label'        => esc_html__( 'Twinkle', 'bdthemes-prime-slider' ),
                //     'type'         => 'checkbox',
                //     'default'      => "off",
                //     'widget_type'  => 'free',
                //     'content_type' => 'static new',
                //     'demo_url'     => 'https://primeslider.pro/demo/tango/',
                //     'video_url'    => '',
                // ],

                [
                    'name'         => 'vertex',
                    'label'        => esc_html__('Vertex', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'free',
                    'content_type' => 'post carousel',
                    'demo_url'     => 'https://primeslider.pro/demo/vertex/',
                    'video_url'    => 'https://youtu.be/ktEB9YdU8A8',
                ],
                [
                    'name'         => 'woohotspot',
                    'label'        => esc_html__('Woo HotSpot', 'bdthemes-prime-slider'),
                    'type'         => 'checkbox',
                    'default'      => "off",
                    'widget_type'  => 'pro',
                    'content_type' => 'ecommerce new',
                    'demo_url'     => 'https://primeslider.pro/demo/woohotspot/',
                    'video_url'    => 'https://youtu.be/vuYYnjSogqU',
                ],
            ]
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'event-calendar',
            'label'        => esc_html__('Event Calendar', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "off",
            'plugin_name'  => 'the-events-calendar',
            'plugin_path'  => 'the-events-calendar/the-events-calendar.php',
            'widget_type'  => 'pro',
            'content_type' => 'others',
            'demo_url'     => 'https://primeslider.pro/demo/event-calendar/',
            'video_url'    => 'https://youtu.be/M5GpxSdlt_8',
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'woocommerce',
            'label'        => esc_html__('WooCommerce', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "on",
            'widget_type'  => 'free',
            'content_type' => 'ecommerce',
            'plugin_name'  => 'woocommerce',
            'plugin_path'  => 'woocommerce/woocommerce.php',
            'demo_url'     => 'https://primeslider.pro/demo/woocommerce/',
            'video_url'    => 'https://youtu.be/6Wkk2EMN2ps',
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'woocircle',
            'label'        => esc_html__('WooCircle', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "off",
            'widget_type'  => 'free',
            'content_type' => 'ecommerce',
            'plugin_name'  => 'woocommerce',
            'plugin_path'  => 'woocommerce/woocommerce.php',
            'demo_url'     => 'https://primeslider.pro/demo/woocircle/',
            'video_url'    => 'https://youtu.be/nJUtQ28kb4A',
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'wooexpand',
            'label'        => esc_html__('WooExpand', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "on",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce',
            'plugin_name'  => 'woocommerce',
            'plugin_path'  => 'woocommerce/woocommerce.php',
            'demo_url'     => 'https://primeslider.pro/demo/wooexpand/',
            'video_url'    => 'https://youtu.be/t5_ogz1XhJo',
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'woolamp',
            'label'        => esc_html__('WooLamp', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "on",
            'widget_type'  => 'free',
            'content_type' => 'ecommerce',
            'plugin_name'  => 'woocommerce',
            'plugin_path'  => 'woocommerce/woocommerce.php',
            'demo_url'     => 'https://primeslider.pro/demo/woolamp/',
            'video_url'    => 'https://youtu.be/cBhYGPhiye4',
        ];

        $settings_fields['prime_slider_third_party_widget'][]  = [
            'name'         => 'woostand',
            'label'        => esc_html__('WooStand', 'bdthemes-prime-slider'),
            'type'         => 'checkbox',
            'default'      => "on",
            'widget_type'  => 'pro',
            'content_type' => 'ecommerce',
            'plugin_name'  => 'woocommerce',
            'plugin_path'  => 'woocommerce/woocommerce.php',
            'demo_url'     => 'https://primeslider.pro/demo/woostand/',
            'video_url'    => 'https://youtu.be/_1ijLrNFwEo',
        ];

        $settings_fields['prime_slider_other_settings']   = [

            [
                'name'  => 'live_copy_group_start',
                'label' => esc_html__('Live Copy or Paste', 'bdthemes-prime-slider'),
                'desc'  => __('Live copy is a copy feature that allow you to copy and paste content from one domain to another. For example you can copy demo content directly from our demo website.', 'bdthemes-prime-slider'),
                'type'  => 'start_group',
                'content_type' => 'new',
            ],

            [
                'name'      => 'live-copy',
                'label'     => esc_html__('Live Copy/Paste', 'bdthemes-prime-slider'),
                'type'      => 'checkbox',
                'default'   => 'off',
                'widget_type' => 'free',
                'demo_url'  => 'https://www.elementpack.pro/knowledge-base/how-to-use-live-copy-option/',
                'video_url' => 'https://youtu.be/jOdWVw2TCmo',

            ],

            [
                'name' => 'live_copy_group_end',
                'type' => 'end_group',
            ],

            [
                'name'         => 'duplicator_group_start',
                'label'        => esc_html__('Duplicator', 'bdthemes-prime-slider'),
                'desc'         => __('Just hit the button below to enable the duplicator. It can duplicate anything like posts,pages and elementor templates. A masterclass duplication with just one click.', 'bdthemes-prime-slider'),
                'type'         => 'start_group',
                'content_type' => 'new',
            ],

            [
                'name'        => 'duplicator',
                'label'       => esc_html__('Duplicator', 'bdthemes-prime-slider'),
                'type'        => 'checkbox',
                'default'     => 'off',
                'widget_type' => 'free',
                'demo_url'    => 'https://www.elementpack.pro/knowledge-base/how-to-use-element-pack-duplicator/',
                'video_url'   => '',
            ],

            [
                'name' => 'duplicator_group_end',
                'type' => 'end_group',
            ],

            [
                'name'         => 'reveal_effects_group_start',
                'label'        => esc_html__('Reveal Effects', 'bdthemes-prime-slider'),
                'desc'         => __('Just hit the button below to enable the Reveal Effects on any slider inside Prime Slider', 'bdthemes-prime-slider'),
                'type'         => 'start_group',
                'content_type' => 'new',
            ],

            [
                'name'        => 'reveal-effects',
                'label'       => esc_html__('Reveal Effects', 'bdthemes-prime-slider'),
                'type'        => 'checkbox',
                'default'     => 'off',
                'widget_type' => 'pro',
                'demo_url'    => 'https://www.elementpack.pro/knowledge-base/how-to-use-reveal-effects/',
                'video_url'   => '',
            ],

            [
                'name' => 'reveal_effects_group_end',
                'type' => 'end_group',
            ]
        ];

        $settings                    = [];
        $settings['settings_fields'] = $settings_fields;
        //$settings['settings_fields'] = $third_party_widget;

        return $callable($settings);
    }

    private static function _is_plugin_installed($plugin, $plugin_path) {
        $installed_plugins = get_plugins();
        return isset($installed_plugins[$plugin_path]);
    }

    public static function is_module_active($module_id, $options) {
        if (!isset($options[$module_id])) {
            if (file_exists(BDTPS_MODULES_PATH . $module_id . '/module.info.php')) {
                $module_data = require BDTPS_MODULES_PATH . $module_id . '/module.info.php';
                return $module_data['default_activation'];
            }
        } else {
            return $options[$module_id] == 'on';
        }
    }

    public static function is_plugin_active($plugin_path) {
        if ($plugin_path) {
            return is_plugin_active($plugin_path);
        }
    }

    public static function has_module_style($module_id) {
        if (file_exists(BDTPS_MODULES_PATH . $module_id . '/module.info.php')) {
            $module_data = require BDTPS_MODULES_PATH . $module_id . '/module.info.php';

            if (isset($module_data['has_style'])) {
                return $module_data['has_style'];
            }
        }
    }

    public static function has_module_script($module_id) {
        if (file_exists(BDTPS_MODULES_PATH . $module_id . '/module.info.php')) {
            $module_data = require BDTPS_MODULES_PATH . $module_id . '/module.info.php';

            if (isset($module_data['has_script'])) {
                return $module_data['has_script'];
            }
        }
    }
}
