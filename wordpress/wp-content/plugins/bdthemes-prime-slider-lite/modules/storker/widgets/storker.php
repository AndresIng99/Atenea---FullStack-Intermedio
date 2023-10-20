<?php

namespace PrimeSlider\Modules\Storker\Widgets;

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
class Storker extends Widget_Base
{
    use  Group_Control_Query ;
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-storker';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Storker', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-storker';
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
            'storker',
            'prime',
            'blog',
            'post',
            'news'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-storker', 'prime-slider-font' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [ 'ps-storker' ];
        } else {
            return [ 'ps-storker' ];
        }
    
    }
    
    public function get_custom_help_url()
    {
        return 'https://youtu.be/Lsg15pGppb0';
    }
    
    protected function register_controls()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        $this->start_controls_section( 'section_content_layout', [
            'label' => esc_html__( 'Layout', 'bdthemes-prime-slider' ),
        ] );
        $this->add_responsive_control( 'item_height', [
            'label'      => esc_html__( 'Height', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh' ],
            'range'      => [
            'px' => [
            'min' => 200,
            'max' => 1080,
        ],
            'vh' => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-item' => 'height: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'content_max_width', [
            'label'     => esc_html__( 'Content Max Width', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 200,
            'max' => 1200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-content' => 'max-width: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-content' => 'text-align: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'      => 'primary_thumbnail',
            'label'     => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
            'exclude'   => [ 'custom' ],
            'default'   => 'full',
            'separator' => 'before',
        ] );
        //Global background settings Controls
        $this->register_background_settings( '.bdt-prime-slider-storker .bdt-image-wrap .bdt-storker-img' );
        $this->end_controls_section();
        //New Query Builder Settings
        $this->start_controls_section( 'section_post_query_builder', [
            'label' => __( 'Query', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->register_query_builder_controls();
        $this->update_control( 'posts_limit', [
            'type'    => Controls_Manager::NUMBER,
            'default' => 3,
        ] );
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
        $this->add_control( 'show_button', [
            'label'     => esc_html__( 'Show Button', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'button_text', [
            'label'       => esc_html__( 'Button Text', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'More Details', 'bdthemes-prime-slider' ),
            'default'     => esc_html__( 'More Details', 'bdthemes-prime-slider' ),
            'label_block' => false,
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
            'label' => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SWITCHER,
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
        $this->add_control( 'show_navigation_dots', [
            'label'     => __( 'Show Navigation Dots', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
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
            'label' => __( 'Sliders', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        // $this->add_control(
        //     'item_overlay_color',
        //     [
        //         'label'     => esc_html__('Overlay Color', 'bdthemes-prime-slider'),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .bdt-image-wrap::before' => 'background: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_control(
        //     'item_overlay_color_deprecated_notice',
        //     [
        //         'type'        => Controls_Manager::DEPRECATED_NOTICE,
        //         'widget'      => ' control Overlay of this',
        //         'since'       => '3.0.0',
        //         'last'        => '3.1.0',
        //         'replacement' => 'below new Overlay Color',
        //     ]
        // );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'           => 'item_adv_overlay_color',
            'label'          => esc_html__( 'Overlay Color', 'bdthemes-prime-slider' ),
            'types'          => [ 'classic', 'gradient' ],
            'fields_options' => [
            'background' => [
            'label' => esc_html__( 'Overlay', 'bdthemes-prime-slider' ) . BDTPS_NC,
        ],
        ],
            'selector'       => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-image-wrap::before',
        ] );
        $this->add_responsive_control( 'content_padding', [
            'label'      => __( 'Content Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'content_margin', [
            'label'      => __( 'Content Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'title_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-title a:hover' => 'color: {{VALUE}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-title',
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'     => 'title_text_shadow',
            'label'    => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-title a',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-text' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'text_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-text' => 'max-width: {{SIZE}}px;',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'text_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-text',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta, {{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta .bdt-author-name-wrap .bdt-author-name' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'meta_hover_color', [
            'label'     => esc_html__( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta .bdt-author-name-wrap .bdt-author-name:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'meta_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta .bdt-ps-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'meta_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-meta',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_button', [
            'label'     => esc_html__( 'Button', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_button' => 'yes',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_button_style' );
        $this->start_controls_tab( 'tab_button_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'button_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'button_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'button_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a',
        ] );
        $this->add_responsive_control( 'button_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'button_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'button_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'button_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_button_hover', [
            'label'     => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_button' => 'yes',
        ],
        ] );
        $this->add_control( 'button_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'button_hover_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a::before',
        ] );
        $this->add_control( 'button_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'button_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-btn a:hover' => 'border-color: {{VALUE}};',
        ],
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'category_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a',
        ] );
        $this->add_responsive_control( 'category_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'category_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_category_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'category_hover_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a:hover',
        ] );
        $this->add_control( 'category_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'category_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-storker .bdt-storker-category a:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Thumbs
        $this->start_controls_section( 'section_style_thumbs', [
            'label' => esc_html__( 'Thumbs Slider', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_responsive_control( 'thumbs_height', [
            'label'       => esc_html__( 'Height(%)', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::SLIDER,
            'selectors'   => [
            '{{WRAPPER}} .bdt-storker-thumbs' => 'height: {{SIZE}}%;',
        ],
            'render_type' => 'template',
        ] );
        $this->add_responsive_control( 'thumbs_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'thumb_line_color', [
            'label'     => esc_html__( 'Animated Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active::after' => 'background: {{VALUE}};',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_thumbs_style' );
        $this->start_controls_tab( 'tab_thumbs_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'thumbs_border',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item',
        ] );
        $this->add_responsive_control( 'thumbs_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'thumbs_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'thumb_title_heading', [
            'label'     => esc_html__( 'T I T L E', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-title a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'thumb_title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-title',
        ] );
        $this->add_control( 'thumb_arrow_heading', [
            'label'     => esc_html__( 'A R R O W S', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_arrows_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumb_arrows_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'thumb_arrows_border',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a',
        ] );
        $this->add_responsive_control( 'thumb_arrows_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'thumb_arrows_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'thumb_arrows_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-storker-arrow a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_thumbs_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_hover_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item::before',
        ] );
        $this->add_control( 'thumbs_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumbs_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'thumb_title_hover_color', [
            'label'     => esc_html__( 'Title Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover .bdt-storker-title a' => 'color: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_arrows_hover_heading', [
            'label'     => esc_html__( 'A R R O W S', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_arrows_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover .bdt-storker-arrow a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumb_arrows_hover_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover .bdt-storker-arrow a',
        ] );
        $this->add_control( 'thumb_arrows_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumb_arrows_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover .bdt-storker-arrow a' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'thumb_arrows_hover_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item:hover .bdt-storker-arrow a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_thumbs_active', [
            'label' => esc_html__( 'Active', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumbs_active_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active::before',
        ] );
        $this->add_control( 'thumbs_active_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumbs_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'thumb_title_active_color', [
            'label'     => esc_html__( 'Title Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active .bdt-storker-title a' => 'color: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_arrows_active_heading', [
            'label'     => esc_html__( 'A R R O W S', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'separator' => 'before',
        ] );
        $this->add_control( 'thumb_arrows_active_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active .bdt-storker-arrow a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'thumb_arrows_active_background',
            'selector' => '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active .bdt-storker-arrow a',
        ] );
        $this->add_control( 'thumb_arrows_active_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'thumb_arrows_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active .bdt-storker-arrow a' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'thumb_arrows_active_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-thumbs .bdt-item.swiper-slide-active .bdt-storker-arrow a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Navigation Css
        $this->start_controls_section( 'section_style_navigation', [
            'label'     => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_navigation_dots' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'dots_nnx_position', [
            'label'          => __( 'Dots Horizontal Offset', 'bdthemes-prime-slider' ),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
            'size' => 100,
        ],
            'tablet_default' => [
            'size' => 50,
        ],
            'mobile_default' => [
            'size' => 30,
        ],
            'range'          => [
            'px' => [
            'min' => -200,
            'max' => 200,
        ],
        ],
            'selectors'      => [
            '{{WRAPPER}} .bdt-storker-pagination' => 'left: {{SIZE}}px;',
        ],
        ] );
        $this->add_responsive_control( 'dots_nny_position', [
            'label'          => __( 'Dots Vertical Offset', 'bdthemes-prime-slider' ),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
            'size' => 100,
        ],
            'tablet_default' => [
            'size' => 50,
        ],
            'mobile_default' => [
            'size' => 30,
        ],
            'range'          => [
            'px' => [
            'min' => -200,
            'max' => 200,
        ],
        ],
            'selectors'      => [
            '{{WRAPPER}} .bdt-storker-pagination' => 'bottom: {{SIZE}}px;',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_navigation_dots_style' );
        $this->start_controls_tab( 'tabs_nav_dots_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'dots_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
        ],
        ] );
        $this->add_responsive_control( 'dots_space_between', [
            'label'     => __( 'Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'dots_size', [
            'label'     => __( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 5,
            'max' => 20,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => '',
        ],
        ] );
        $this->add_control( 'advanced_dots_size', [
            'label' => __( 'Advanced Size', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_responsive_control( 'advanced_dots_width', [
            'label'     => __( 'Width(px)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 1,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'advanced_dots_height', [
            'label'     => __( 'Height(px)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 1,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'advanced_dots_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'dots_box_shadow',
            'selector' => '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tabs_nav_dots_active', [
            'label' => __( 'Active', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'active_dot_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
        ],
        ] );
        $this->add_responsive_control( 'active_dots_size', [
            'label'     => __( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 5,
            'max' => 20,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}}'                                                          => '--ps-swiper-dots-active-height: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => '',
        ],
        ] );
        $this->add_responsive_control( 'active_advanced_dots_width', [
            'label'     => __( 'Width(px)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 1,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'active_advanced_dots_height', [
            'label'     => __( 'Height(px)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 1,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}}'                                                          => '--ps-swiper-dots-active-height: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'active_advanced_dots_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'active_advanced_dots_align', [
            'label'     => __( 'Alignment', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
            'flex-start' => [
            'title' => __( 'Top', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-v-align-top',
        ],
            'center'     => [
            'title' => __( 'Center', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-v-align-middle',
        ],
            'flex-end'   => [
            'title' => __( 'Bottom', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-v-align-bottom',
        ],
        ],
            'selectors' => [
            '{{WRAPPER}}' => '--ps-swiper-dots-align: {{VALUE}};',
        ],
            'condition' => [
            'advanced_dots_size' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'dots_active_box_shadow',
            'selector' => '{{WRAPPER}} .bdt-storker-pagination .swiper-pagination-bullet-active',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
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
    
    public function render_image()
    {
        $settings = $this->get_settings_for_display();
        $placeholder_image_src = Utils::get_placeholder_image_src();
        $image_src = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'primary_thumbnail', $settings );
        
        if ( $image_src ) {
            $image_final_src = $image_src;
        } elseif ( $placeholder_image_src ) {
            $image_final_src = $placeholder_image_src;
        } else {
            return;
        }
        
        ?>
        <div class="bdt-storker-img" style="background-image: url('<?php 
        echo  esc_url( $image_final_src ) ;
        ?>')"></div>
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
            'bdt-storker-title',
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
    
    public function render_excerpt( $excerpt_length )
    {
        if ( !$this->get_settings( 'show_excerpt' ) ) {
            return;
        }
        $strip_shortcode = $this->get_settings_for_display( 'strip_shortcode' );
        ?>
        <div class="bdt-storker-text" data-reveal="reveal-active" data-swiper-parallax-y="-80" data-swiper-parallax-duration="600">
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
        <div class="bdt-storker-category" data-reveal="reveal-active" data-swiper-parallax-y="-120" data-swiper-parallax-duration="400">
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
        <div class="bdt-flex bdt-flex-middle">
            <div class="bdt-storker-date">
                <?php 
        
        if ( $settings['human_diff_time'] == 'yes' ) {
            echo  prime_slider_post_time_diff( ( $settings['human_diff_time_short'] == 'yes' ? 'short' : '' ) ) ;
        } else {
            echo  get_the_date() ;
        }
        
        ?>
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
        <div class="bdt-author-name-wrap">
            <span class="bdt-by"><?php 
        echo  esc_html__( 'by', 'bdthemes-prime-slider' ) ;
        ?></span>
            <a class="bdt-author-name" href="<?php 
        echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ;
        ?>">
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
        <div class="bdt-storker-btn" data-swiper-parallax-y="-50" data-swiper-parallax-duration="700">
            <a href="<?php 
        echo  esc_url( get_permalink() ) ;
        ?>" data-reveal="reveal-active">
                <span><?php 
        echo  esc_html( $settings['button_text'] ) ;
        ?></span>
                <!-- <i class="ps-wi-arrow-right"></i> -->
                <i class="ps-wi-arrow-right-8" aria-hidden="true"></i>
            </a>
        </div>
    <?php 
    }
    
    protected function render_header()
    {
        $settings = $this->get_settings_for_display();
        $id = 'bdt-prime-slider-' . $this->get_id();
        $this->add_render_attribute( 'prime-slider-storker', 'id', $id );
        $this->add_render_attribute( 'prime-slider-storker', 'class', [ 'bdt-prime-slider-storker', 'elementor-swiper' ] );
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider' );
        //Reveal Effect
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects && 'yes' === $settings['reveal_effects_enable'] ) {
            $this->add_render_attribute( 'slider', 'class', 'reveal-active-' . $this->get_id() );
            $this->add_render_attribute( 'prime-slider-storker', 'data-reveal-enable', $settings['reveal_effects_enable'] );
            $this->add_render_attribute( [
                'prime-slider-storker' => [
                'data-reveal-settings' => [ wp_json_encode( [
                "bgColors"  => ( $settings["reveal_effects_color"] ? $settings["reveal_effects_color"] : "#333" ),
                "direction" => ( $settings['reveal_effects_direction'] ? $settings['reveal_effects_direction'] : 'lr' ),
                "duration"  => ( $settings['reveal_effects_speed']['size'] ? $settings['reveal_effects_speed']['size'] : 1000 ),
                "easing"    => $settings['reveal_effects_easing'],
            ] ) ],
            ],
            ] );
        }
        
        $this->add_render_attribute( [
            'prime-slider-storker' => [
            'data-settings' => [ wp_json_encode( array_filter( [
            "autoplay"       => ( "yes" == $settings["autoplay"] ? [
            "delay" => $settings["autoplay_speed"],
        ] : false ),
            "loop"           => ( $settings["loop"] == "yes" ? true : false ),
            "speed"          => $settings["speed"]["size"],
            "effect"         => 'fade',
            "fadeEffect"     => [
            'crossFade' => true,
        ],
            "lazy"           => true,
            "parallax"       => true,
            "grabCursor"     => ( $settings["grab_cursor"] === "yes" ? true : false ),
            "pauseOnHover"   => ( "yes" == $settings["pauseonhover"] ? true : false ),
            "slidesPerView"  => 1,
            "loopedSlides"   => 4,
            "observer"       => ( $settings["observer"] ? true : false ),
            "observeParents" => ( $settings["observer"] ? true : false ),
            "pagination"     => [
            "el"        => "#" . $id . " .swiper-pagination",
            "clickable" => "true",
        ],
            "lazy"           => [
            "loadPrevNext" => "true",
        ],
        ] ) ) ],
        ],
        ] );
        $swiper_class = ( Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container' );
        $this->add_render_attribute( 'swiper', 'class', 'swiper-storker ' . $swiper_class );
        ?>
        <div <?php 
        $this->print_render_attribute_string( 'slider' );
        ?>>
        <div <?php 
        $this->print_render_attribute_string( 'prime-slider-storker' );
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
                <?php 
        if ( $settings['show_navigation_dots'] ) {
            ?>
                    <div class="bdt-storker-pagination reveal-muted">
                        <div class="swiper-pagination"></div>
                    </div>
                <?php 
        }
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
            <div class="bdt-storker-content">
                <h3 class="bdt-storker-title">
                    <a href="javascript:void(0);"><?php 
        echo  esc_html( get_the_title() ) ;
        ?></a>
                </h3>
            </div>
            <div class="bdt-storker-arrow">
                <a href="<?php 
        echo  esc_url( get_permalink() ) ;
        ?>">
                    <!-- <i class="ps-wi-arrow-right"></i> -->
                    <i class="ps-wi-arrow-right-8" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    <?php 
    }
    
    public function render_slider_item( $excerpt_length )
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'slider-item',
            'class',
            'bdt-item swiper-slide',
            true
        );
        ?>
        <div <?php 
        echo  $this->get_render_attribute_string( 'slider-item' ) ;
        ?>>
            <div class="bdt-image-wrap">
                <?php 
        $this->render_image();
        ?>
            </div>
            <div class="bdt-storker-content">
                <?php 
        $this->render_category();
        ?>

                <?php 
        
        if ( $settings['show_title'] ) {
            ?>
                    <div data-swiper-parallax-y="-100" data-swiper-parallax-duration="500">
                        <?php 
            $this->render_title();
            ?>
                    </div>
                <?php 
        }
        
        ?>

                <?php 
        $this->render_excerpt( $excerpt_length );
        ?>

                <?php 
        
        if ( $settings['show_author'] or $settings['show_date'] ) {
            ?>
                    <div data-swiper-parallax-y="-65" data-swiper-parallax-duration="650">
                        <div class="bdt-storker-meta" data-reveal="reveal-active">
                            <?php 
            $this->render_author();
            ?>
                            <span class="bdt-ps-separator"><?php 
            echo  $settings['meta_separator'] ;
            ?></span>
                            <?php 
            $this->render_date();
            ?>
                        </div>
                    </div>
                <?php 
        }
        
        ?>

                <?php 
        $this->render_button();
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
        $this->add_render_attribute( 'swiper-thumbs', 'class', 'bdt-storker-thumbs reveal-muted ' . $swiper_class );
        ?>
        
            <?php 
        $this->render_header();
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $this->render_slider_item( $settings['excerpt_length'] );
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
<?php 
        wp_reset_postdata();
    }

}