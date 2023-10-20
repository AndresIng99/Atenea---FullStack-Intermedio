<?php

namespace PrimeSlider\Modules\Rubix\Widgets;

use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Text_Shadow ;
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
class Rubix extends Widget_Base
{
    use  Group_Control_Query ;
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-rubix';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Rubix', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-rubix';
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
            'rubix',
            'prime',
            'blog',
            'post',
            'news'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-rubix', 'prime-slider-font' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [ 'ps-rubix' ];
        } else {
            return [ 'ps-rubix' ];
        }
    
    }
    
    public function get_custom_help_url()
    {
        return 'https://youtu.be/mEPQjmjhCkY';
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
            'default'        => 2,
            'tablet_default' => 1,
            'mobile_default' => 1,
            'options'        => [
            1 => '1',
            2 => '2',
            3 => '3',
        ],
        ] );
        $this->add_responsive_control( 'item_height', [
            'label'      => esc_html__( 'Item Height', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range'      => [
            'px' => [
            'min' => 200,
            'max' => 1080,
        ],
            '%'  => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider' => 'height: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'thumbs_max_width', [
            'label'       => esc_html__( 'Thumbs Max Width', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px', '%' ],
            'default'     => [
            'unit' => '%',
        ],
            'range'       => [
            'px' => [
            'min' => 200,
            'max' => 1200,
        ],
            '%'  => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors'   => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
            'render_type' => 'template',
        ] );
        $this->add_control( 'thumbs_position', [
            'label'   => esc_html__( 'Thumbs Position', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::CHOOSE,
            'default' => 'bdt-slide-style-1',
            'toggle'  => false,
            'options' => [
            'bdt-slide-style-1' => [
            'title' => esc_html__( 'Top', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-v-align-top',
        ],
            'bdt-slide-style-2' => [
            'title' => esc_html__( 'Bottom', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-v-align-bottom',
        ],
        ],
        ] );
        $this->add_control( 'content_reverse', [
            'label'        => esc_html__( 'Content Reverse', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'bdt-ps-reverese--',
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
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-content' => 'text-align: {{VALUE}};',
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
        $this->add_control( 'show_excerpt', [
            'label'     => __( 'Show Text', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
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
        $this->add_control( 'strip_shortcode', [
            'label'     => esc_html__( 'Strip Shortcode', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
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
            'label'   => esc_html__( 'Show Author', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_date', [
            'label'     => esc_html__( 'Date', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
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
        $this->end_controls_section();
        $this->start_controls_section( 'section_slider_settings', [
            'label' => __( 'Slider Settings', 'bdthemes-prime-slider' ),
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
        $this->add_control( 'pauseonhover', [
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
        $this->add_control( 'free_mode', [
            'label' => __( 'Drag free Mode', 'bdthemes-prime-slider' ),
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
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'Background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-item',
        ] );
        $this->add_responsive_control( 'content_padding', [
            'label'      => __( 'Content Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'active_border_heading', [
            'label'     => esc_html__( 'Active Line', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'border_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-item.swiper-slide-active .bdt-slider-progress' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'line_height', [
            'label'     => esc_html__( 'Height', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 20,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-item .bdt-slider-progress' => 'height: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'title_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-title a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'title_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-title',
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'     => 'title_text_shadow',
            'label'    => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-title a',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_text', [
            'label'     => esc_html__( 'Text', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_excerpt' => 'yes',
        ],
        ] );
        $this->add_control( 'text_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-text' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'text_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'text_width', [
            'label'     => esc_html__( 'Max Width', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 100,
            'max' => 800,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-text' => 'max-width: {{SIZE}}px;',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'text_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-text',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_date', [
            'label'     => esc_html__( 'Date', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_date' => 'yes',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_date_style' );
        $this->start_controls_tab( 'tab_date_Text', [
            'label' => esc_html__( 'Text', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'date_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'date_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_date_icon', [
            'label' => esc_html__( 'Icon', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'date_icon_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'date_icon_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'date_icon_border',
            'label'    => __( 'Border', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar',
        ] );
        $this->add_responsive_control( 'date_icon_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'date_icon_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'date_icon_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'date_icon_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar',
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'date_icon_shadow',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-meta .bdt-date-time i.ps-wi-calendar',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_category', [
            'label'     => esc_html__( 'Category', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_category' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'category_bottom_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'category_border',
            'label'    => __( 'Border', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a',
        ] );
        $this->add_responsive_control( 'category_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'category_shadow',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_category_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_hover_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a:hover',
        ] );
        $this->add_control( 'category_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'category_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-category a:hover' => 'border-color: {{VALUE}};',
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
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'icon_color', [
            'label'     => __( 'Icon Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'icon_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'icon_border',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i',
        ] );
        $this->add_responsive_control( 'icon_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'read_more_icon_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'icon_font_size', [
            'label'     => esc_html__( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'read_more_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'icon_shadow',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'Read_more_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tabs_read_more_hover', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'read_more_hover_color', [
            'label'     => __( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a:hover' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'read_more_icon_hover_color', [
            'label'     => __( 'Icon Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a:hover i' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'read_more_icon_hover_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a i:after',
        ] );
        $this->add_control( 'read_icon_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'arrows_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a:hover i' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'read_more_icon_hover_shadow',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-main-slider .bdt-read-more a:hover i',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Thumbs
        $this->start_controls_section( 'section_style_thumbs', [
            'label' => esc_html__( 'Thumbs Slider', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->start_controls_tabs( 'tabs_thumbs_style' );
        $this->start_controls_tab( 'tab_thumbs_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'thumbs_border',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item',
        ] );
        $this->add_responsive_control( 'thumbs_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'thumbs_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'thumb_line_heading', [
            'label'     => esc_html__( 'LINE', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_line_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-content:after' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'line_border_width', [
            'label'     => esc_html__( 'Height', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 10,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-content:before, {{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-content:after' => 'height: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'thumb_title_heading', [
            'label'     => esc_html__( 'TITLE', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'thumbs_title_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-title' => 'padding-top: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'thumb_title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-title',
        ] );
        $this->add_control( 'thumb_meta_heading', [
            'label'     => esc_html__( 'META', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'meta_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-meta, {{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-meta .bdt-author a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'meta_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-meta',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_thumbs_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_hover_background',
            'selector' => '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item:hover',
        ] );
        $this->add_control( 'thumbs_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumbs_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'thumb_line_hover_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item:hover .bdt-content:before' => 'background: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_title_hover_color', [
            'label'     => esc_html__( 'Title Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-title a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'meta_hover_color', [
            'label'     => esc_html__( 'Meta Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-meta .bdt-author a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_thumbs_active', [
            'label' => esc_html__( 'Active', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_active_background',
            'selector' => '{{WRAPPER}}  .bdt-rubix-slider .bdt-thumb-slider .bdt-item.swiper-slide-active',
        ] );
        $this->add_control( 'thumbs_active_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumbs_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}}  .bdt-rubix-slider .bdt-thumb-slider .bdt-item.swiper-slide-active' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'thumb_line_active_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-rubix-slider .bdt-thumb-slider .bdt-item.swiper-slide-active .bdt-content:before' => 'background: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // thumbs end
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
        $titleClass = $this->get_render_attribute_string( 'slider-title' );
        echo  '<' . esc_html( $settings['title_tags'] ) . ' ' . $titleClass . ' >
                    <a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">
                        ' . esc_html( get_the_title() ) . '
                    </a>
                </' . esc_html( $settings['title_tags'] ) . '>' ;
    }
    
    public function render_thumbs_title()
    {
        $settings = $this->get_settings_for_display();
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
        $titleClass = $this->get_render_attribute_string( 'slider-title' );
        echo  '<' . esc_html( $settings['title_tags'] ) . ' ' . $titleClass . ' >
                    <a href="' . 'javascript:void(0);' . '" title="' . esc_attr( get_the_title() ) . '">
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
        <div class="bdt-category" data-reveal="reveal-active">
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
        <div class="bdt-date-time">
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
        </div>

    <?php 
    }
    
    public function render_author()
    {
        if ( !$this->get_settings( 'show_author' ) ) {
            return;
        }
        ?>
        <div class="bdt-author bdt-flex">
            <i class="ps-wi-user-circle-o" aria-hidden="true"></i>
            <a href="javascript:void(0);">
                <?php 
        echo  get_the_author() ;
        ?>
            </a>
        </div>
    <?php 
    }
    
    public function render_button()
    {
        $settings = $this->get_settings_for_display();
        if ( !$this->get_settings( 'show_button' ) ) {
            return;
        }
        ?>
        <div class="bdt-rubix-play-and-button-wrap">
            <div class="bdt-rubix-button-wrap" data-swiper-parallax-y="-50" data-swiper-parallax-duration="700">
                <a href="<?php 
        echo  esc_url( get_permalink() ) ;
        ?>">
                    <span><?php 
        echo  esc_html( $settings['button_text'] ) ;
        ?></span>
                    <i class="ps-wi-arrow-right"></i>
                </a>
            </div>
        </div>
    <?php 
    }
    
    protected function render_header()
    {
        $settings = $this->get_settings_for_display();
        $id = 'bdt-prime-slider-' . $this->get_id();
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider-rubix' );
        //Reveal Effect
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects && 'yes' === $settings['reveal_effects_enable'] ) {
            $this->add_render_attribute( 'slider', 'class', 'reveal-active-' . $this->get_id() );
            $this->add_render_attribute( 'prime-slider-rubix', 'data-reveal-enable', $settings['reveal_effects_enable'] );
            $this->add_render_attribute( [
                'prime-slider-rubix' => [
                'data-reveal-settings' => [ wp_json_encode( [
                "bgColors"  => ( $settings["reveal_effects_color"] ? $settings["reveal_effects_color"] : "#333" ),
                "direction" => ( $settings['reveal_effects_direction'] ? $settings['reveal_effects_direction'] : 'lr' ),
                "duration"  => ( $settings['reveal_effects_speed']['size'] ? $settings['reveal_effects_speed']['size'] : 1000 ),
                "easing"    => $settings['reveal_effects_easing'],
            ] ) ],
            ],
            ] );
        }
        
        $this->add_render_attribute( 'prime-slider-rubix', 'id', $id );
        $this->add_render_attribute( 'prime-slider-rubix', 'class', [ 'bdt-rubix-slider', 'elementor-swiper', $settings['thumbs_position'] ] );
        $elementor_vp_lg = get_option( 'elementor_viewport_lg' );
        $elementor_vp_md = get_option( 'elementor_viewport_md' );
        $viewport_lg = ( !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1024 );
        $viewport_md = ( !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 768 );
        $this->add_render_attribute( [
            'prime-slider-rubix' => [
            'data-settings' => [ wp_json_encode( array_filter( [
            "autoplay"       => ( "yes" == $settings["autoplay"] ? [
            "delay" => $settings["autoplay_speed"],
        ] : false ),
            "loop"           => ( $settings["loop"] == "yes" ? true : false ),
            "speed"          => $settings["speed"]["size"],
            "pauseOnHover"   => ( "yes" == $settings["pauseonhover"] ? true : false ),
            "slidesPerView"  => ( isset( $settings["columns_mobile"] ) ? (int) $settings["columns_mobile"] : 1 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll_mobile"] ) ? (int) $settings["slides_to_scroll_mobile"] : 1 ),
            "spaceBetween"   => 0,
            "loopedSlides"   => 4,
            "centeredSlides" => ( $settings["centered_slides"] === "yes" ? true : false ),
            "grabCursor"     => ( $settings["grab_cursor"] === "yes" ? true : false ),
            "freeMode"       => ( $settings["free_mode"] === "yes" ? true : false ),
            "effect"         => 'slide',
            "parallax"       => true,
            "observer"       => ( $settings["observer"] ? true : false ),
            "observeParents" => ( $settings["observer"] ? true : false ),
            "breakpoints"    => [
            (int) $viewport_md => [
            "slidesPerView"  => ( isset( $settings["columns_tablet"] ) ? (int) $settings["columns_tablet"] : 1 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll_tablet"] ) ? (int) $settings["slides_to_scroll_tablet"] : 1 ),
        ],
            (int) $viewport_lg => [
            "slidesPerView"  => ( isset( $settings["columns"] ) ? (int) $settings["columns"] : 2 ),
            "slidesPerGroup" => ( isset( $settings["slides_to_scroll"] ) ? (int) $settings["slides_to_scroll"] : 1 ),
        ],
        ],
            "navigation"     => [
            "nextEl" => "#" . $id . " .bdt-navigation-next",
            "prevEl" => "#" . $id . " .bdt-navigation-prev",
        ],
            "lazy"           => [
            "loadPrevNext" => "true",
        ],
        ] ) ) ],
        ],
        ] );
        $swiper_class = ( Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container' );
        $this->add_render_attribute( 'swiper', 'class', 'bdt-main-slider ' . $swiper_class );
        ?>
        <div <?php 
        $this->print_render_attribute_string( 'slider' );
        ?>>
        <div <?php 
        $this->print_render_attribute_string( 'prime-slider-rubix' );
        ?>>
            <div <?php 
        $this->print_render_attribute_string( 'swiper' );
        ?>>
                <div class="swiper-wrapper">
                <?php 
    }
    
    public function render_footer()
    {
        $settings = $this->get_settings_for_display();
        ?>
                </div>
            </div>
        <?php 
    }
    
    public function render_thumbnav()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'thumb-item',
            'class',
            'bdt-item swiper-slide',
            true
        );
        ?>

            <div <?php 
        echo  $this->get_render_attribute_string( 'thumb-item' ) ;
        ?>>
                <div class="bdt-content">
                    <?php 
        $this->render_thumbs_title();
        ?>
                    <?php 
        
        if ( $settings['show_author'] ) {
            ?>
                        <div class="bdt-meta" data-reveal="reveal-active">
                            <?php 
            $this->render_author();
            ?>
                        </div>
                    <?php 
        }
        
        ?>

                </div>
            </div>
        <?php 
    }
    
    public function render_slider_item( $post_id, $image_size, $excerpt_length )
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'slider-item',
            'class',
            'bdt-item  swiper-slide',
            true
        );
        ?>

            <div <?php 
        echo  $this->get_render_attribute_string( 'slider-item' ) ;
        ?>>
                <div class="bdt-slider-progress"></div>
                <div class="bdt-img-wrap">
                    <?php 
        $this->render_image( $post_id, $image_size );
        ?>
                    <?php 
        
        if ( $settings['show_read_more'] ) {
            ?>
                        <div class="bdt-read-more">
                            <a data-reveal="reveal-active" href="<?php 
            echo  esc_url( get_permalink() ) ;
            ?>">
                                <i class="ps-wi-link"></i>
                                <span><?php 
            echo  esc_html__( $settings['read_more_text'] ) ;
            ?></span>
                            </a>
                        </div>
                    <?php 
        }
        
        ?>
                </div>
                <div class="bdt-content">
                    <?php 
        $this->render_category();
        ?>
                    <?php 
        $this->render_title();
        ?>
                    <?php 
        $this->render_excerpt( $excerpt_length );
        ?>

                    <?php 
        
        if ( $settings['show_date'] ) {
            ?>
                        <div class="bdt-meta bdt-flex-inline" data-reveal="reveal-active">
                            <?php 
            $this->render_date();
            ?>
                        </div>
                    <?php 
        }
        
        ?>
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
        $swiper_class = ( Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container' );
        $this->add_render_attribute( 'swiper-thumbs', 'class', 'bdt-thumb-slider ' . $swiper_class );
        ?>

            <?php 
        $this->render_header();
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $thumbnail_size = $settings['primary_thumbnail_size'];
            $this->render_slider_item( get_the_ID(), $thumbnail_size, $settings['excerpt_length'] );
        }
        $this->render_footer();
        ?>
            <div thumbsSlider="" <?php 
        $this->print_render_attribute_string( 'swiper-thumbs' );
        ?>>
                <div class="swiper-wrapper">
                    <?php 
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $this->render_thumbnav();
        }
        ?>
                </div>
            </div>

        </div>
        </div>
<?php 
        wp_reset_postdata();
    }

}