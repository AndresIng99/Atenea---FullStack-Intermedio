<?php

namespace PrimeSlider\Modules\Pacific\Widgets;

use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Text_Shadow ;
use  Elementor\Group_Control_Css_Filter ;
use  Elementor\Widget_Base ;
use  Elementor\Plugin ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
use  PrimeSlider\Traits\QueryControls\GroupQuery\Group_Control_Query ;
use  PrimeSlider\Utils ;
use  WP_Query ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Pacific extends Widget_Base
{
    use  Group_Control_Query ;
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-pacific';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Pacific', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-pacific';
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
            'pacific',
            'prime',
            'blog',
            'post',
            'news'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'prime-slider-font', 'ps-pacific' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [ 'ps-pacific' ];
        } else {
            return [ 'ps-pacific' ];
        }
    
    }
    
    // public function get_custom_help_url() {
    //     return 'https://youtu.be/G32YlydUcHg';
    // }
    protected function register_controls()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        $this->start_controls_section( 'section_content_layout', [
            'label' => esc_html__( 'Layout', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'layout_style', [
            'label'   => __( 'Style', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SELECT,
            'default' => 1,
            'options' => [
            1 => 'Style 1',
            2 => 'Style 2',
        ],
        ] );
        $this->add_responsive_control( 'columns', [
            'label'          => __( 'Columns', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'           => Controls_Manager::SELECT,
            'default'        => 3,
            'tablet_default' => 2,
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
            'label'          => __( 'Item Gap', 'bdthemes-prime-slider' ),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
            'size' => 5,
        ],
            'tablet_default' => [
            'size' => 5,
        ],
            'mobile_default' => [
            'size' => 0,
        ],
            'range'          => [
            'px' => [
            'min' => 1,
            'max' => 100,
        ],
        ],
        ] );
        $this->add_responsive_control( 'item_height', [
            'label'     => esc_html__( 'Item Height', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 200,
            'max' => 1080,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider' => 'height: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-pacific-slider .bdt-item' => 'text-align: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'    => 'primary_thumbnail',
            'exclude' => [ 'custom' ],
            'default' => 'full',
        ] );
        $this->end_controls_section();
        //New Query Builder Settings
        $this->start_controls_section( 'section_post_query_builder', [
            'label' => __( 'Query', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->register_query_builder_controls();
        $this->end_controls_section();
        $this->start_controls_section( 'section_additional_settings', [
            'label' => esc_html__( 'Additional Settings', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'show_title', [
            'label'     => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'title_tags', [
            'label'     => __( 'Title HTML Tag', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SELECT,
            'options'   => prime_slider_title_tags(),
            'default'   => 'h3',
            'condition' => [
            'show_title' => 'yes',
        ],
        ] );
        $this->add_control( 'modal_show_title', [
            'label'     => __( 'Modal Show Title', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'show_excerpt', [
            'label'     => __( 'Modal Show Text', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'after',
        ] );
        $this->add_control( 'excerpt_length', [
            'label'       => __( 'Text Limit', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'description' => esc_html__( 'It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::NUMBER,
            'default'     => 30,
            'condition'   => [
            'show_excerpt' => 'yes',
        ],
        ] );
        $this->add_control( 'show_category', [
            'label'     => esc_html__( 'Show Category', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'show_author', [
            'label'     => esc_html__( 'Show Author', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'meta_separator', [
            'label'       => __( 'Separator', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::TEXT,
            'default'     => '//',
            'label_block' => false,
        ] );
        $this->add_control( 'show_date', [
            'label'   => esc_html__( 'Date', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'human_diff_time', [
            'label'     => esc_html__( 'Human Different Time', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            'show_date' => 'yes',
        ],
        ] );
        $this->add_control( 'human_diff_time_short', [
            'label'       => esc_html__( 'Time Short Format', 'bdthemes-prime-slider' ),
            'description' => esc_html__( 'This will work for Hours, Minute and Seconds', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SWITCHER,
            'condition'   => [
            'human_diff_time' => 'yes',
            'show_date'       => 'yes',
        ],
        ] );
        $this->add_control( 'show_time', [
            'label'     => esc_html__( 'Show Time', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            'human_diff_time' => '',
            'show_date'       => 'yes',
        ],
        ] );
        $this->add_control( 'show_read_more', [
            'label'     => __( 'Show Read More', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'read_more_text', [
            'label'       => esc_html__( 'Readmore Text', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__( 'Read More', 'bdthemes-prime-slider' ),
            'label_block' => false,
            'dynamic'     => [
            'active' => true,
        ],
            'condition'   => [
            'show_read_more' => 'yes',
        ],
        ] );
        $this->add_control( 'show_pagination', [
            'label'   => __( 'Show Pagination', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_carousel_settings', [
            'label' => __( 'Carousel Settings', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'autoplay', [
            'label'   => __( 'Autoplay', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'autoplay_speed', [
            'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::NUMBER,
            'default'   => 5000,
            'condition' => [
            'autoplay' => 'yes',
        ],
        ] );
        $this->add_control( 'pause_on_hover', [
            'label'     => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            'autoplay' => 'yes',
        ],
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
        $this->add_control( 'centered_slides', [
            'label'       => __( 'Center Slide', 'bdthemes-prime-slider' ),
            'description' => __( 'Use even items from Layout > Columns settings for better preview.', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SWITCHER,
            'default'     => 'yes',
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
            'size' => 500,
        ],
            'range'   => [
            'px' => [
            'min'  => 100,
            'max'  => 5000,
            'step' => 50,
        ],
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
            'label' => __( 'Items', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'item_overlay', [
            'label'     => esc_html__( 'Overlay', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-item .bdt-image-wrap:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'item_overlay_active', [
            'label'     => esc_html__( 'Overlay Active', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-item.swiper-slide-active .bdt-image-wrap:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'item_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'content_padding', [
            'label'      => __( 'Content Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_title', [
            'label'     => esc_html__( 'Title', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_title' => 'yes',
        ],
        ] );
        $this->add_control( 'title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'title_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-title a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-title',
        ] );
        $this->add_responsive_control( 'title_bottom_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'     => 'title_text_shadow',
            'label'    => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-title a',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_meta', [
            'label'      => esc_html__( 'Meta', 'bdthemes-prime-slider' ),
            'tab'        => Controls_Manager::TAB_STYLE,
            'conditions' => [
            'relation' => 'or',
            'terms'    => [ [
            'name'  => 'show_author',
            'value' => 'yes',
        ], [
            'name'  => 'show_date',
            'value' => 'yes',
        ] ],
        ],
        ] );
        $this->add_control( 'meta_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-meta-box, {{WRAPPER}} .bdt-pacific-slider .bdt-meta-box .bdt-author-wrap a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'meta_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-meta-box .bdt-author-wrap  a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'meta_space_between', [
            'label'     => esc_html__( 'Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-meta-box .bdt-meta-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'meta_bottom_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-meta-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'meta_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-meta-box',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_category', [
            'label'     => esc_html__( 'Category', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_category' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'category_spacing', [
            'label'     => esc_html__( 'spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_category_style' );
        $this->start_controls_tab( 'tab_category_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_background',
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-category a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'category_border',
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-category a',
        ] );
        $this->add_responsive_control( 'category_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_space_between', [
            'label'     => esc_html__( 'Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'category_shadow',
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-category a',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-category a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_category_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_hover_background',
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-category a:hover',
        ] );
        $this->add_control( 'category_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'category_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-category a:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Read More Css
        $this->start_controls_section( 'section_style_read_more', [
            'label' => __( 'Read More', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->start_controls_tabs( 'tabs_read_more_style' );
        $this->start_controls_tab( 'tabs_nav_read_more_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'read_more_color', [
            'label'     => __( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-item .bdt-button' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'read_more_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-item .bdt-button',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tabs_read_more_hover', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'read_more_hover_color', [
            'label'     => __( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-item .bdt-button:hover'     => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-pacific-slider .bdt-item .bdt-btn-text::before' => 'border-bottom-color: {{VALUE}}',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Navigation More Css
        $this->start_controls_section( 'section_style_navigation', [
            'label' => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'navigation_color', [
            'label'     => __( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-navigation-wrap' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'navigation_hover_color', [
            'label'     => __( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-navigation-wrap:hover' => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-pacific-slider .bdt-n-p-text::before'      => 'border-bottom-color: {{VALUE}}',
        ],
        ] );
        $this->add_responsive_control( 'navigation_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-navigation-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'navigation_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .bdt-navigation-wrap',
        ] );
        $this->end_controls_section();
        //Pagination Css
        $this->start_controls_section( 'section_style_pagination', [
            'label' => __( 'Pagination', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'pagination_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet'        => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet:before' => 'border-top-color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'pagination_hover_color', [
            'label'     => __( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet:hover'        => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet:hover:before' => 'border-top-color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'pagination_active_color', [
            'label'     => __( 'Active Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet-active'                                 => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet-active.swiper-pagination-bullet:before' => 'border-top-color: {{VALUE}}',
        ],
        ] );
        $this->add_responsive_control( 'pagination_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-pacific-slider .bdt-pagi-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'pafination_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-pacific-slider .swiper-pagination-bullet',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_modal', [
            'label' => esc_html__( 'Modal', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'modal_heading', [
            'label' => __( 'M O D A L', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'modal_cross_color', [
            'label'     => esc_html__( 'Cross Icon Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-modal-close-full' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'modal_cross_color_hover', [
            'label'     => esc_html__( 'Cross Icon Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-modal-close-full:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'item_background',
            'label'    => esc_html__( 'Modal Background', 'bdthemes-prime-slider' ),
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog',
        ] );
        $this->add_control( 'modal_title_heading', [
            'label' => __( 'T I T L E', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'modal_title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'modal_title_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-title a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'modal_title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-title',
        ] );
        $this->add_responsive_control( 'modal_title_bottom_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'     => 'modal_title_text_shadow',
            'label'    => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-title a',
        ] );
        $this->add_control( 'text_heading', [
            'label'     => __( 'T E X T', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'text_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-text' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'text_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-text',
        ] );
        $this->add_control( 'modal_image_heading', [
            'label'     => __( 'I M A G E', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'modal_image_border',
            'label'    => __( 'Border', 'bdthemes-prime-slider' ),
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-background-cover',
        ] );
        $this->add_control( 'modal_image_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
            '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-background-cover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Css_Filter::get_type(), [
            'name'     => 'modal_image_filters',
            'selector' => '.bdt-pacific-{{ID}}.bdt-modal-dialog .bdt-background-cover',
        ] );
        $this->end_controls_section();
        //Navigation Css
    }
    
    public function query_posts()
    {
        $settings = $this->get_settings();
        $args = [];
        
        if ( $settings['posts_limit'] ) {
            $args['posts_per_page'] = $settings['posts_limit'];
            $args['paged'] = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
        }
        
        $default = $this->getGroupControlQueryArgs();
        $args = array_merge( $default, $args );
        $query = new WP_Query( $args );
        return $query;
    }
    
    public function render_image( $post_id, $size )
    {
        $placeholder_image_src = Utils::get_placeholder_image_src();
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
        
        if ( !$image_src ) {
            printf( '<img src="%1$s" alt="%2$s" class="bdt-img swiper-lazy">', $placeholder_image_src, esc_html( get_the_title() ) );
        } else {
            print wp_get_attachment_image(
                get_post_thumbnail_id(),
                $size,
                false,
                [
                'class' => 'bdt-img swiper-lazy',
                'alt'   => esc_html( get_the_title() ),
            ]
            );
        }
    
    }
    
    public function render_image_thumb( $image_id, $size )
    {
        $placeholder_image_src = Utils::get_placeholder_image_src();
        $image_src = wp_get_attachment_image_src( $image_id, $size );
        
        if ( !$image_src ) {
            $image_src = $placeholder_image_src;
        } else {
            $image_src = $image_src[0];
        }
        
        ?>
		<div class="bdt-background-cover" style="background-image: url('<?php 
        echo  esc_url( $image_src ) ;
        ?>');" bdt-height-viewport>
		</div>
	<?php 
    }
    
    public function render_title()
    {
        $settings = $this->get_settings_for_display();
        if ( !$this->get_settings( 'show_title' ) ) {
            return;
        }
        $this->add_render_attribute(
            'slider-title',
            'class',
            'bdt-title',
            true
        );
        $this->add_render_attribute(
            'slider-title',
            'data-reveal',
            'reveal-active',
            true
        );
        $this->add_render_attribute(
            'slider-title',
            'data-swiper-parallax',
            '-300',
            true
        );
        $this->add_render_attribute(
            'slider-title',
            'data-swiper-parallax-duration',
            '700',
            true
        );
        $titleClass = $this->get_render_attribute_string( 'slider-title' );
        echo  '<' . esc_html( $settings['title_tags'] ) . ' ' . $titleClass . ' >
                    <a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">
                        ' . esc_html( get_the_title() ) . '
                    </a>
                </' . esc_html( $settings['title_tags'] ) . '>' ;
    }
    
    public function render_title_modal()
    {
        $settings = $this->get_settings_for_display();
        if ( !$this->get_settings( 'modal_show_title' ) ) {
            return;
        }
        $this->add_render_attribute(
            'slider-title-modal',
            'class',
            'bdt-title',
            true
        );
        $titleClass = $this->get_render_attribute_string( 'slider-title-modal' );
        echo  '<' . esc_html( $settings['title_tags'] ) . ' ' . $titleClass . ' >
                    <a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">
                        ' . esc_html( get_the_title() ) . '
                    </a>
                </' . esc_html( $settings['title_tags'] ) . '>' ;
    }
    
    public function render_excerpt( $excerpt_length )
    {
        if ( !$this->get_settings( 'show_excerpt' ) ) {
            return;
        }
        $strip_shortcode = $this->get_settings_for_display( 'strip_shortcode' );
        ?>
		<div class="bdt-text" data-reveal="reveal-active">
			<?php 
        
        if ( has_excerpt() ) {
            the_excerpt();
        } else {
            echo  prime_slider_custom_excerpt( $excerpt_length, $strip_shortcode ) ;
        }
        
        ?>
		</div>
	<?php 
    }
    
    public function render_category()
    {
        if ( !$this->get_settings( 'show_category' ) ) {
            return;
        }
        ?>
		<div class="bdt-category" data-reveal="reveal-active" data-swiper-parallax="-300" data-swiper-parallax-duration="600">
			<?php 
        echo  get_the_category_list( ' ' ) ;
        ?>
		</div>
	<?php 
    }
    
    public function render_date()
    {
        $settings = $this->get_settings_for_display();
        if ( !$this->get_settings( 'show_date' ) ) {
            return;
        }
        ?>
		<div class="bdt-date">
			<i class="ps-wi-calendar" aria-hidden="true"></i>
			<span>
				<?php 
        
        if ( $settings['human_diff_time'] == 'yes' ) {
            echo  prime_slider_post_time_diff( ( $settings['human_diff_time_short'] == 'yes' ? 'short' : '' ) ) ;
        } else {
            echo  get_the_date() ;
        }
        
        ?>
			</span>
		</div>
		<?php 
        
        if ( $settings['show_time'] ) {
            ?>
			<div class="bdt-post-time">
				<i class="ps-wi-clock-o" aria-hidden="true"></i>
				<?php 
            echo  get_the_time() ;
            ?>
			</div>
		<?php 
        }
        
        ?>

	<?php 
    }
    
    public function render_author()
    {
        if ( !$this->get_settings( 'show_author' ) ) {
            return;
        }
        ?>
		<div class="bdt-author-wrap">
			<i class="ps-wi-user-circle-o" aria-hidden="true"></i>
			<a href="<?php 
        echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ;
        ?>">
				<?php 
        echo  get_the_author() ;
        ?>
			</a>
		</div>
	<?php 
    }
    
    protected function render_header()
    {
        $settings = $this->get_settings_for_display();
        $id = 'bdt-pacific-slider-' . $this->get_id();
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider-pacific' );
        //Reveal Effect
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects && 'yes' === $settings['reveal_effects_enable'] ) {
            $this->add_render_attribute( 'slider', 'class', 'reveal-active-' . $this->get_id() );
            $this->add_render_attribute( 'carousel', 'data-reveal-enable', $settings['reveal_effects_enable'] );
            $this->add_render_attribute( [
                'carousel' => [
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
        $viewport_lg = ( !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023 );
        $viewport_md = ( !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767 );
        $this->add_render_attribute( 'carousel', 'id', $id );
        $this->add_render_attribute( 'carousel', 'class', [ 'bdt-pacific-slider' ] );
        $this->add_render_attribute( [
            'carousel' => [
            'data-slider-settings' => [ wp_json_encode( array_filter( [
            "id"             => '#' . $id,
            "showPagination" => ( $settings['show_pagination'] == 'yes' ? true : false ),
        ] ) ) ],
            'data-settings'        => [ wp_json_encode( array_filter( [
            "autoplay"              => ( "yes" == $settings["autoplay"] ? [
            "delay" => $settings["autoplay_speed"],
        ] : false ),
            "loop"                  => ( $settings["loop"] == "yes" ? true : false ),
            "speed"                 => $settings["speed"]["size"],
            "pauseOnHover"          => ( "yes" == $settings["pause_on_hover"] ? true : false ),
            "slidesPerView"         => ( isset( $settings["columns_mobile"] ) ? (int) $settings["columns_mobile"] : 1 ),
            "slidesPerGroup"        => ( isset( $settings["slides_to_scroll_mobile"] ) ? (int) $settings["slides_to_scroll_mobile"] : 1 ),
            "spaceBetween"          => ( !empty($settings["item_gap_mobile"]["size"]) ? $settings["item_gap_mobile"]["size"] : 5 ),
            "centeredSlides"        => ( $settings["layout_style"] == 2 ? true : false ),
            "grabCursor"            => ( $settings["grab_cursor"] === "yes" ? true : false ),
            "observer"              => ( $settings["observer"] ? true : false ),
            "observeParents"        => ( $settings["observer"] ? true : false ),
            "watchSlidesVisibility" => true,
            "watchSlidesProgress"   => true,
            "parallax"              => ( $settings["layout_style"] == 2 ? true : false ),
            "breakpoints"           => [
            (int) $viewport_md => [
            "slidesPerView"  => ( isset( $settings["columns_tablet"] ) ? (int) $settings["columns_tablet"] : 2 ),
            "spaceBetween"   => ( !empty($settings["item_gap_tablet"]["size"]) ? $settings["item_gap_tablet"]["size"] : 5 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll_tablet"] ) ? (int) $settings["slides_to_scroll_tablet"] : 1 ),
        ],
            (int) $viewport_lg => [
            "slidesPerView"  => ( isset( $settings["columns"] ) ? (int) $settings["columns"] : 3 ),
            "spaceBetween"   => ( !empty($settings["item_gap"]["size"]) ? $settings["item_gap"]["size"] : 5 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll"] ) ? (int) $settings["slides_to_scroll"] : 1 ),
        ],
        ],
            "navigation"            => [
            "nextEl" => "#" . $id . " .bdt-navigation-next",
            "prevEl" => "#" . $id . " .bdt-navigation-prev",
        ],
            "pagination"            => [
            "el"        => "#" . $id . " .swiper-pagination",
            "clickable" => "true",
        ],
        ] ) ) ],
        ],
        ] );
        $layout_style = 'bdt-slider-style-' . $settings['layout_style'];
        $swiper_class = ( Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container' );
        $this->add_render_attribute( 'swiper', 'class', 'swiper-pacific ' . $swiper_class . ' ' . $layout_style );
        ?>
		<div <?php 
        $this->print_render_attribute_string( 'slider' );
        ?>>
		<div <?php 
        $this->print_render_attribute_string( 'carousel' );
        ?>>
			<div <?php 
        $this->print_render_attribute_string( 'swiper' );
        ?>>
				<div class="swiper-wrapper">
				<?php 
    }
    
    function render_navigation()
    {
        $settings = $this->get_settings_for_display();
        ?>
					<div class="bdt-navigation-wrap bdt-position-bottom-left reveal-muted">
						<div class="bdt-navigation-prev">
							<span class="bdt-n-p-icon  bdt-prev-icon eicon-arrow-left"></span>
							<span class="bdt-n-p-text bdt-prev"><?php 
        esc_html_e( 'prev', 'bdthemes-prime-slider' );
        ?></span>
						</div>
						<div class="bdt-navigation-next">
							<span class="bdt-n-p-text bdt-next"><?php 
        esc_html_e( 'next', 'bdthemes-prime-slider' );
        ?></span>
							<span class="bdt-n-p-icon bdt-next-icon eicon-arrow-right"></span>
						</div>
					</div>
				<?php 
    }
    
    function render_pagination()
    {
        $settings = $this->get_settings_for_display();
        if ( $settings['show_pagination'] != 'yes' ) {
            return;
        }
        ?>
					<div class="bdt-pagi-wrap bdt-position-bottom-right reveal-muted">
						<div class="swiper-pagination"></div>
					</div>
				<?php 
    }
    
    function render_arrows_fraction()
    {
        $settings = $this->get_settings_for_display();
        $hide_arrow_on_mobile = ( $settings['hide_arrow_on_mobile'] ? 'bdt-visible@m' : '' );
        ?>
					<div class="reveal-muted bdt-position-z-index bdt-position-<?php 
        echo  esc_html( $settings['arrows_fraction_position'] ) ;
        ?>">
						<div class="bdt-arrows-fraction-container bdt-slidenav-container ">

							<div class="bdt-flex bdt-flex-middle">
								<div class="<?php 
        echo  esc_html( $hide_arrow_on_mobile ) ;
        ?>">
									<a href="" class="bdt-navigation-prev">
										<i class="ps-wi-arrow-left-<?php 
        echo  esc_html( $settings['nav_arrows_icon'] ) ;
        ?>" aria-hidden="true"></i>
									</a>
								</div>

								<?php 
        if ( 'center' !== $settings['arrows_fraction_position'] ) {
            ?>
									<div class="swiper-pagination"></div>
								<?php 
        }
        ?>

								<div class="<?php 
        echo  esc_html( $hide_arrow_on_mobile ) ;
        ?>">
									<a href="" class="bdt-navigation-next">
										<i class="ps-wi-arrow-right-<?php 
        echo  esc_html( $settings['nav_arrows_icon'] ) ;
        ?>" aria-hidden="true"></i>
									</a>
								</div>

							</div>
						</div>
					</div>
				<?php 
    }
    
    function render_footer()
    {
        $settings = $this->get_settings_for_display();
        ?>
				</div>
				<?php 
        $this->render_pagination();
        $this->render_navigation();
        ?>
			</div>

		</div>
		</div>
	<?php 
    }
    
    public function render_slider_item( $post_id, $image_size, $excerpt_length )
    {
        $settings = $this->get_settings_for_display();
        // if ('yes' == $settings['global_link']) {
        // 	$this->add_render_attribute('slider-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
        // }
        $this->add_render_attribute(
            'slider-item',
            'class',
            'bdt-item swiper-slide',
            true
        );
        $modal_id = 'bdt-pacific-slider-' . $post_id;
        ?>
		<div <?php 
        echo  $this->get_render_attribute_string( 'slider-item' ) ;
        ?>>
			<div class="bdt-image-wrap">
				<?php 
        $this->render_image( $post_id, $image_size );
        ?>
			</div>
			<div class="bdt-content-wrap bdt-position-center-left ">
				<?php 
        $this->render_category();
        ?>
				<?php 
        $this->render_title();
        ?>

				<?php 
        
        if ( $settings['show_author'] or $settings['show_date'] ) {
            ?>
					<div class="bdt-meta-box" data-reveal="reveal-active" data-swiper-parallax="-300" data-swiper-parallax-duration="800">
						<?php 
            $this->render_author();
            ?>
						<div class="bdt-meta-separator">
							<span><?php 
            echo  $settings['meta_separator'] ;
            ?></span>
						</div>
						<?php 
            $this->render_date();
            ?>
					</div>
				<?php 
        }
        
        ?>

				<div class="bdt-button-wrap"  data-swiper-parallax="-300" data-swiper-parallax-duration="900">
					<?php 
        
        if ( $settings['show_read_more'] ) {
            ?>
						<a class="bdt-button bdt-padding-remove" href="#<?php 
            echo  $modal_id ;
            ?>" data-reveal="reveal-active" bdt-toggle>
							<span class="bdt-btn-text"><?php 
            echo  esc_html__( $settings['read_more_text'] ) ;
            ?></span>
							<span class="bdt-readmore-icon eicon-plus"></span>
						</a>
					<?php 
        }
        
        ?>
					<div id="<?php 
        echo  $modal_id ;
        ?>" class="bdt-modal-full" bdt-modal>
						<div class="bdt-modal-dialog bdt-pacific-slider-modal <?php 
        echo  'bdt-pacific-' . $this->get_id() ;
        ?>">
							<a class="bdt-modal-close-full bdt-close-large" bdt-close></a>
							<div class="bdt-grid-collapse bdt-child-width-1-2@s bdt-flex-middle" bdt-grid>
								<?php 
        $this->render_image_thumb( get_post_thumbnail_id( $post_id ), $image_size );
        ?>
								<div class="bdt-padding-large">
									<?php 
        $this->render_title_modal();
        ?>
									<?php 
        $this->render_excerpt( $excerpt_length );
        ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php 
    }
    
    public function render()
    {
        $settings = $this->get_settings_for_display();
        $wp_query = $this->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
        ?>
				<div class="bdt-prime-slider">
				<?php 
        $this->render_header();
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $thumbnail_size = $settings['primary_thumbnail_size'];
            $this->render_slider_item( get_the_ID(), $thumbnail_size, $settings['excerpt_length'] );
        }
        $this->render_footer();
        ?>
				</div>
				<?php 
        wp_reset_postdata();
    }

}