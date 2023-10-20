<?php

namespace PrimeSlider\Modules\Tango\Widgets;

use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Text_Shadow ;
use  Elementor\Repeater ;
use  Elementor\Plugin ;
use  PrimeSlider\Utils ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Tango extends Widget_Base
{
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-tango';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Tango', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-tango';
    }
    
    public function get_categories()
    {
        return [ 'prime-slider' ];
    }
    
    public function get_keywords()
    {
        return [
            'prime slider',
            'slider',
            'tango',
            'prime'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'prime-slider-font', 'ps-tango' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [ 'ps-tango' ];
        } else {
            return [ 'ps-tango' ];
        }
    
    }
    
    public function get_custom_help_url()
    {
        return 'https://youtu.be/OdXH9cSgdz4';
    }
    
    protected function register_controls()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        $this->start_controls_section( 'section_content_layout', [
            'label' => esc_html__( 'Layout', 'bdthemes-prime-slider' ),
        ] );
        $this->add_responsive_control( 'columns', [
            'label'          => __( 'Columns', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'           => Controls_Manager::SELECT,
            'default'        => 3,
            'tablet_default' => 3,
            'mobile_default' => 1,
            'options'        => [
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
        ],
        ] );
        $this->add_responsive_control( 'item_gap', [
            'label'          => __( 'Item Gap', 'ultimate-post-kit' ),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
            'size' => 0,
        ],
            'tablet_default' => [
            'size' => 0,
        ],
            'mobile_default' => [
            'size' => 0,
        ],
            'range'          => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
        ] );
        $this->add_responsive_control( 'slider_min_height', [
            'label'     => esc_html__( 'Height', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 50,
            'max' => 1024,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango' => 'height: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'show_title', [
            'label'   => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_sub_title', [
            'label'   => esc_html__( 'Show Label', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_navigation_arrows', [
            'label'   => esc_html__( 'Show Arrows', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'navigation_center_arrows', [
            'label'     => esc_html__( 'Center Arrows', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            'show_navigation_arrows' => 'yes',
        ],
        ] );
        $this->add_control( 'show_navigation_dots', [
            'label'   => esc_html__( 'Show Pagination', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'hide_on_mobile', [
            'label'        => esc_html__( 'Pagination Hide on Mobile', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes',
            'condition'    => [
            'show_navigation_dots' => 'yes',
        ],
            'prefix_class' => 'bdt-pagination-hide-',
        ] );
        $this->add_control( 'title_html_tag', [
            'label'     => __( 'Title HTML Tag', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SELECT,
            'default'   => 'h1',
            'options'   => prime_slider_title_tags(),
            'condition' => [
            'show_title' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'content_alignment', [
            'label'     => esc_html__( 'Alignment', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
            'left'   => [
            'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-text-align-left',
        ],
            'center' => [
            'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-text-align-center',
        ],
            'right'  => [
            'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-text-align-right',
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-content-wrap' => 'text-align: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'         => 'thumbnail_size',
            'label'        => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
            'exclude'      => [ 'custom' ],
            'default'      => 'full',
            'prefix_class' => 'bdt-prime-slider-thumbnail-size-',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_sliders', [
            'label' => esc_html__( 'Sliders', 'bdthemes-prime-slider' ),
        ] );
        $repeater = new Repeater();
        $repeater->add_control( 'sub_title', [
            'label'       => esc_html__( 'Label', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'title', [
            'label'       => esc_html__( 'Title', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'title_link', [
            'label'         => esc_html__( 'Title Link', 'bdthemes-prime-slider' ),
            'type'          => Controls_Manager::URL,
            'default'       => [
            'url' => '',
        ],
            'show_external' => false,
            'dynamic'       => [
            'active' => true,
        ],
            'condition'     => [
            'title!' => '',
        ],
        ] );
        $repeater->add_control( 'image', [
            'label'   => esc_html__( 'Image', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
            'url' => Utils::get_placeholder_image_src(),
        ],
            'dynamic' => [
            'active' => true,
        ],
        ] );
        $this->add_control( 'slides', [
            'label'       => esc_html__( 'Slider Items', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
            [
            'sub_title' => esc_html__( 'Label', 'bdthemes-prime-slider' ),
            'title'     => esc_html__( 'Item One', 'bdthemes-prime-slider' ),
            'image'     => [
            'url' => BDTPS_ASSETS_URL . 'images/gallery/item-1.svg',
        ],
        ],
            [
            'sub_title' => esc_html__( 'Label', 'bdthemes-prime-slider' ),
            'title'     => esc_html__( 'Item Two', 'bdthemes-prime-slider' ),
            'image'     => [
            'url' => BDTPS_ASSETS_URL . 'images/gallery/item-4.svg',
        ],
        ],
            [
            'sub_title' => esc_html__( 'Label', 'bdthemes-prime-slider' ),
            'title'     => esc_html__( 'Item Three', 'bdthemes-prime-slider' ),
            'image'     => [
            'url' => BDTPS_ASSETS_URL . 'images/gallery/item-5.svg',
        ],
        ],
            [
            'sub_title' => esc_html__( 'Label', 'bdthemes-prime-slider' ),
            'title'     => esc_html__( 'Item Four', 'bdthemes-prime-slider' ),
            'image'     => [
            'url' => BDTPS_ASSETS_URL . 'images/gallery/item-6.svg',
        ],
        ]
        ],
            'title_field' => '{{{ title }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_carousel_settings', [
            'label' => __( 'Slider Settings', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'skin', [
            'label'        => esc_html__( 'Layout', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'         => Controls_Manager::SELECT,
            'default'      => 'carousel',
            'options'      => [
            'carousel'  => esc_html__( 'Carousel', 'bdthemes-prime-slider' ),
            'coverflow' => esc_html__( 'Coverflow', 'bdthemes-prime-slider' ),
        ],
            'prefix_class' => 'bdt-carousel-style-',
            'render_type'  => 'template',
        ] );
        $this->add_control( 'coverflow_toggle', [
            'label'        => __( 'Coverflow Effect', 'bdthemes-prime-slider' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'return_value' => 'yes',
            'condition'    => [
            'skin' => 'coverflow',
        ],
        ] );
        $this->start_popover();
        $this->add_control( 'coverflow_rotate', [
            'label'       => esc_html__( 'Rotate', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'default'     => [
            'size' => 0,
        ],
            'range'       => [
            'px' => [
            'min'  => -360,
            'max'  => 360,
            'step' => 5,
        ],
        ],
            'condition'   => [
            'coverflow_toggle' => 'yes',
        ],
            'render_type' => 'template',
        ] );
        $this->add_control( 'coverflow_stretch', [
            'label'       => __( 'Stretch', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'default'     => [
            'size' => 180,
        ],
            'range'       => [
            'px' => [
            'min'  => 0,
            'step' => 10,
            'max'  => 200,
        ],
        ],
            'condition'   => [
            'coverflow_toggle' => 'yes',
        ],
            'render_type' => 'template',
        ] );
        $this->add_control( 'coverflow_modifier', [
            'label'       => __( 'Modifier', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'default'     => [
            'size' => 1,
        ],
            'range'       => [
            'px' => [
            'min'  => 1,
            'step' => 1,
            'max'  => 10,
        ],
        ],
            'condition'   => [
            'coverflow_toggle' => 'yes',
        ],
            'render_type' => 'template',
        ] );
        $this->add_control( 'coverflow_depth', [
            'label'       => __( 'Depth', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'default'     => [
            'size' => 100,
        ],
            'range'       => [
            'px' => [
            'min'  => 0,
            'step' => 10,
            'max'  => 1000,
        ],
        ],
            'condition'   => [
            'coverflow_toggle' => 'yes',
        ],
            'render_type' => 'template',
        ] );
        $this->add_control( 'slide_shadows', [
            'label'       => __( 'Slide Shadows', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SWITCHER,
            'default'     => 'yes',
            'render_type' => 'template',
        ] );
        $this->end_popover();
        $this->add_control( 'match_height', [
            'label' => __( 'Item Match Height', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_control( 'autoplay', [
            'label'   => __( 'Autoplay', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'no',
        ] );
        $this->add_control( 'autoplay_speed', [
            'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::NUMBER,
            'default'   => 8000,
            'condition' => [
            'autoplay' => 'yes',
        ],
        ] );
        $this->add_control( 'pauseonhover', [
            'label' => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_responsive_control( 'slides_to_scroll', [
            'type'           => Controls_Manager::SELECT,
            'label'          => esc_html__( 'Slides to Scroll', 'bdthemes-prime-slider' ),
            'default'        => 1,
            'tablet_default' => 1,
            'mobile_default' => 1,
            'options'        => [
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
        ],
        ] );
        $this->add_control( 'grab_cursor', [
            'label' => __( 'Grab Cursor', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_control( 'loop', [
            'label'   => __( 'Loop', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'speed', [
            'label'   => __( 'Animation Speed (ms)', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SLIDER,
            'default' => [
            'size' => 1200,
        ],
            'range'   => [
            'min'  => 100,
            'max'  => 5000,
            'step' => 50,
        ],
        ] );
        $this->add_control( 'observer', [
            'label'       => __( 'Observer', 'bdthemes-prime-slider' ),
            'description' => __( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SWITCHER,
        ] );
        $this->end_controls_section();
        /**
         * Reveal Effects
         */
        if ( 'on' === $reveal_effects ) {
            $this->register_reveal_effects();
        }
        //style
        $this->start_controls_section( 'section_style_layout', [
            'label' => __( 'Content', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_responsive_control( 'item_padding', [
            'label'      => __( 'Content Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        ],
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_image', [
            'label' => __( 'Image', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'           => 'image_overlay',
            'selector'       => '{{WRAPPER}} .bdt-prime-slider-tango .bdt-image-wrap::before',
            'fields_options' => [
            'background' => [
            'label' => esc_html__( 'Overlay Color', 'pixel-gallery' ),
        ],
        ],
        ] );
        $this->add_responsive_control( 'image_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; clip-path: inset(10% 10% 10% 10% round {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}});',
        ],
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_title', [
            'label'     => __( 'Title', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_title' => 'yes',
        ],
        ] );
        $this->add_control( 'title_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-title, {{WRAPPER}} .bdt-prime-slider-tango .bdt-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'title_hover_color', [
            'label'     => __( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-title:hover, {{WRAPPER}} .bdt-prime-slider-tango .bdt-title a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-tango .bdt-title',
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'     => 'title_text_shadow',
            'label'    => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-tango .bdt-title, {{WRAPPER}} .bdt-prime-slider-tango .bdt-title a',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_sub_title', [
            'label'     => __( 'Label', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_sub_title' => 'yes',
        ],
        ] );
        $this->add_control( 'sub_title_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-subtitle' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'sub_title_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-tango .bdt-subtitle',
        ] );
        $this->add_responsive_control( 'sub_title_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'sub_title_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-tango .bdt-subtitle',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_navigation', [
            'label' => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'arrows_heading', [
            'label'     => __( 'Arrows', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'arrows_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-next, {{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-prev' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'arrows_hover_color', [
            'label'     => __( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-next:hover, {{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-prev:hover' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'arrows_size', [
            'label'     => esc_html__( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 10,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-next, {{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-prev' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'arrows_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 10,
            'max' => 500,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-prev' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_navigation_arrows'   => [ 'yes' ],
            'navigation_center_arrows' => '',
        ],
        ] );
        $this->add_responsive_control( 'arrows_acx_position', [
            'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => -200,
            'max' => 200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-prev' => 'left: {{SIZE}}px;',
            '{{WRAPPER}} .bdt-prime-slider-tango .bdt-navigation-arrows .bdt-navigation-next' => 'right: {{SIZE}}px;',
        ],
            'condition' => [
            'show_navigation_arrows'   => 'yes',
            'navigation_center_arrows' => 'yes',
        ],
        ] );
        $this->add_control( 'pagination_heading', [
            'label'     => __( 'Pagination', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'pagination_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'pagination_active_color', [
            'label'     => __( 'Active Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'pagination_size', [
            'label'     => esc_html__( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-tango .swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_section();
    }
    
    protected function render_header()
    {
        $settings = $this->get_settings_for_display();
        $id = 'bdt-prime-slider-' . $this->get_id();
        $this->add_render_attribute( 'prime-slider-tango', 'id', $id );
        $this->add_render_attribute( 'prime-slider-tango', 'class', [ 'bdt-prime-slider-tango', 'elementor-swiper' ] );
        //Reveal Effect
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects && 'yes' === $settings['reveal_effects_enable'] ) {
            $this->add_render_attribute( 'prime-slider', 'class', 'reveal-active-' . $this->get_id() );
            $this->add_render_attribute( 'prime-slider-tango', 'data-reveal-enable', $settings['reveal_effects_enable'] );
            $this->add_render_attribute( [
                'prime-slider-tango' => [
                'data-reveal-settings' => [ wp_json_encode( [
                "bgColors"  => ( $settings["reveal_effects_color"] ? $settings["reveal_effects_color"] : "#333" ),
                "direction" => ( $settings['reveal_effects_direction'] ? $settings['reveal_effects_direction'] : 'lr' ),
                "duration"  => ( $settings['reveal_effects_speed']['size'] ? $settings['reveal_effects_speed']['size'] : 1000 ),
                "easing"    => $settings['reveal_effects_easing'],
            ] ) ],
            ],
            ] );
        }
        
        $elementor_vp_lg = get_option( 'elementor_viewport_lg' );
        $elementor_vp_md = get_option( 'elementor_viewport_md' );
        $viewport_lg = ( !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1024 );
        $viewport_md = ( !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 768 );
        if ( 'yes' == $settings['match_height'] ) {
            $this->add_render_attribute( 'prime-slider-tango', 'bdt-height-match', 'target: > div > div > div > .bdt-slider-item' );
        }
        $this->add_render_attribute( [
            'prime-slider-tango' => [
            'data-settings' => [ wp_json_encode( array_filter( [
            "autoplay"        => ( "yes" == $settings["autoplay"] ? [
            "delay" => $settings["autoplay_speed"],
        ] : false ),
            "loop"            => ( $settings["loop"] == "yes" ? true : false ),
            "speed"           => $settings["speed"]["size"],
            "pauseOnHover"    => ( "yes" == $settings["pauseonhover"] ? true : false ),
            "slidesPerView"   => ( isset( $settings["columns_mobile"] ) ? (int) $settings["columns_mobile"] : 1 ),
            "slidesPerGroup"  => ( isset( $settings["slides_to_scroll_mobile"] ) ? (int) $settings["slides_to_scroll_mobile"] : 1 ),
            "spaceBetween"    => ( !empty($settings["item_gap_mobile"]["size"]) ? (int) $settings["item_gap_mobile"]["size"] : 0 ),
            "centeredSlides"  => true,
            "grabCursor"      => ( $settings["grab_cursor"] === "yes" ? true : false ),
            "effect"          => $settings["skin"],
            "observer"        => ( $settings["observer"] ? true : false ),
            "observeParents"  => ( $settings["observer"] ? true : false ),
            "breakpoints"     => [
            (int) $viewport_md => [
            "slidesPerView"  => ( isset( $settings["columns_tablet"] ) ? (int) $settings["columns_tablet"] : 2 ),
            "spaceBetween"   => ( !empty($settings["item_gap_tablet"]["size"]) ? (int) $settings["item_gap_tablet"]["size"] : 0 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll_tablet"] ) ? (int) $settings["slides_to_scroll_tablet"] : 1 ),
        ],
            (int) $viewport_lg => [
            "slidesPerView"  => ( isset( $settings["columns"] ) ? (int) $settings["columns"] : 3 ),
            "spaceBetween"   => ( !empty($settings["item_gap"]["size"]) ? (int) $settings["item_gap"]["size"] : 0 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll"] ) ? (int) $settings["slides_to_scroll"] : 1 ),
        ],
        ],
            "navigation"      => [
            "nextEl" => "#" . $id . " .bdt-navigation-next",
            "prevEl" => "#" . $id . " .bdt-navigation-prev",
        ],
            "pagination"      => [
            "el"        => "#" . $id . " .swiper-pagination",
            "clickable" => "true",
        ],
            'coverflowEffect' => [
            'rotate'       => ( "yes" == $settings["coverflow_toggle"] ? $settings["coverflow_rotate"]["size"] : 0 ),
            'stretch'      => ( "yes" == $settings["coverflow_toggle"] ? $settings["coverflow_stretch"]["size"] : 180 ),
            'depth'        => ( "yes" == $settings["coverflow_toggle"] ? $settings["coverflow_depth"]["size"] : 100 ),
            'modifier'     => ( "yes" == $settings["coverflow_toggle"] ? $settings["coverflow_modifier"]["size"] : 1 ),
            'slideShadows' => ( $settings["slide_shadows"] === "yes" ? true : false ),
        ],
        ] ) ) ],
        ],
        ] );
        $this->add_render_attribute( 'prime-slider', 'class', 'bdt-prime-slider' );
        $swiper_class = ( Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container' );
        $this->add_render_attribute( 'swiper', 'class', 'swiper-tango ' . $swiper_class );
        ?>
		<div <?php 
        $this->print_render_attribute_string( 'prime-slider' );
        ?>>
		<div <?php 
        $this->print_render_attribute_string( 'prime-slider-tango' );
        ?>>
			<div <?php 
        $this->print_render_attribute_string( 'swiper' );
        ?>>
				<div class="swiper-wrapper">
		<?php 
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->get_settings_for_display();
        
        if ( 'yes' == $settings['navigation_center_arrows'] ) {
            $this->add_render_attribute( 'prime-slider-arrows', 'class', 'bdt-arrows-center' );
        } else {
            $this->add_render_attribute( 'prime-slider-arrows', 'class', 'bdt-arrows-bottom' );
        }
        
        $this->add_render_attribute( 'prime-slider-arrows', 'class', 'bdt-navigation-arrows bdt-position-z-index reveal-muted' );
        ?>

			<?php 
        
        if ( $settings['show_navigation_arrows'] ) {
            ?>
			<div <?php 
            $this->print_render_attribute_string( 'prime-slider-arrows' );
            ?>>
				<a href="" class="bdt-navigation-prev bdt-slidenav"><i class="ps-wi-arrow-left-5"></i></a>
				<a href="" class="bdt-navigation-next bdt-slidenav"><i class="ps-wi-arrow-right-5"></i></a>
			</div>
			<?php 
        }
        
        ?>

		<?php 
    }
    
    public function render_navigation_dots()
    {
        $settings = $this->get_settings_for_display();
        ?>
			<?php 
        if ( $settings['show_navigation_dots'] ) {
            ?>
			
			<div class="swiper-pagination reveal-muted"></div>
			<!-- <div class="swiper-scrollbar"></div> -->
			
			<?php 
        }
        ?>
		<?php 
    }
    
    public function render_footer()
    {
        $settings = $this->get_settings_for_display();
        ?>
				</div>
			</div>
			
			<?php 
        $this->render_navigation_dots();
        ?>
			<?php 
        $this->render_navigation_arrows();
        ?>
		</div>
		</div>

		<?php 
    }
    
    public function rendar_item_image( $slide )
    {
        $settings = $this->get_settings_for_display();
        $thumb_url = Group_Control_Image_Size::get_attachment_image_src( $slide['image']['id'], 'thumbnail_size', $settings );
        
        if ( !$thumb_url ) {
            printf( '<img src="%1$s" alt="%2$s" class="bdt-img">', $slide['image']['url'], esc_html( $slide['title'] ) );
        } else {
            print wp_get_attachment_image(
                $slide['image']['id'],
                $settings['thumbnail_size_size'],
                false,
                [
                'class' => 'bdt-img',
                'alt'   => esc_html( $slide['title'] ),
            ]
            );
        }
    
    }
    
    public function render_slides_loop()
    {
        $settings = $this->get_settings_for_display();
        foreach ( $settings['slides'] as $slide ) {
            ?>

            <div class="swiper-slide bdt-item">
					<div class="bdt-image-wrap">
						<?php 
            $this->rendar_item_image( $slide );
            ?>

					</div>
					<div class="bdt-content-wrap">

					<?php 
            
            if ( $slide['sub_title'] && 'yes' == $settings['show_sub_title'] ) {
                ?>
							<div class="bdt-subtitle" data-reveal="reveal-active">
								<?php 
                echo  wp_kses_post( $slide['sub_title'] ) ;
                ?>
							</div>
						<?php 
            }
            
            ?>

						<?php 
            
            if ( $slide['title'] && 'yes' == $settings['show_title'] ) {
                ?>
								<<?php 
                echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
                ?> class="bdt-title" data-reveal="reveal-active">
									<?php 
                
                if ( '' !== $slide['title_link']['url'] ) {
                    ?>

										<?php 
                    
                    if ( !empty($slide['title_link']['is_external']) ) {
                        $target = 'target="_blank"';
                    } else {
                        $target = '';
                    }
                    
                    ?>

										<a href="<?php 
                    echo  esc_url( $slide['title_link']['url'] ) ;
                    ?>" <?php 
                    echo  wp_kses_post( $target ) ;
                    ?>>
										<?php 
                }
                
                ?>
										<?php 
                echo  prime_slider_first_word( $slide['title'] ) ;
                ?>
										<?php 
                if ( '' !== $slide['title_link']['url'] ) {
                    ?>
										</a>
									<?php 
                }
                ?>
								</<?php 
                echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
                ?>>
						<?php 
            }
            
            ?>
					</div>

			</div>

        <?php 
        }
    }
    
    public function render()
    {
        $this->render_header();
        $this->render_slides_loop();
        $this->render_footer();
    }

}