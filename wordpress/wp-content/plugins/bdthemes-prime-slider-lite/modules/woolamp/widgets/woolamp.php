<?php

namespace PrimeSlider\Modules\Woolamp\Widgets;

use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Repeater ;
use  PrimeSlider\Utils ;
use  PrimeSlider\Modules\Woolamp\Module ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
use  PrimeSlider\Traits\QueryControls\GroupQuery\Group_Control_Query ;
use  WP_Query ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Woolamp extends Widget_Base
{
    use  Group_Control_Query ;
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-woolamp';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'WooLamp', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-woolamp';
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
            'woolamp',
            'prime',
            'wc slider'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-woolamp' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [ 'goodshare' ];
        } else {
            return [ 'goodshare' ];
        }
    
    }
    
    public function get_custom_help_url()
    {
        return 'https://youtu.be/cBhYGPhiye4';
    }
    
    protected function register_controls()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        $this->start_controls_section( 'section_content_layout', [
            'label' => esc_html__( 'Layout', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'slider_size_ratio', [
            'label'       => esc_html__( 'Size Ratio', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::IMAGE_DIMENSIONS,
            'description' => 'Slider ratio to width and height, such as 16:9',
            'separator'   => 'before',
            'condition'   => [
            'enable_height!' => 'yes',
        ],
        ] );
        $this->add_control( 'slider_min_height', [
            'label'     => esc_html__( 'Minimum Height', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 50,
            'max' => 1024,
        ],
        ],
            'condition' => [
            'enable_height!' => 'yes',
        ],
        ] );
        $this->add_control( 'enable_height', [
            'label'   => esc_html__( 'Enable Viewport Height', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'    => Controls_Manager::SWITCHER,
            'classes' => BDTPS_IS_PC,
        ] );
        $this->add_control( 'viewport_height', [
            'label'      => esc_html__( 'Height', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'vh' ],
            'range'      => [
            'vh' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'default'    => [
            'unit' => 'vh',
            'size' => 70,
        ],
            'condition'  => [
            'enable_height' => 'yes',
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
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-content-inner' => 'text-align: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'         => 'thumbnail_size',
            'label'        => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
            'exclude'      => [ 'custom' ],
            'default'      => 'full',
            'prefix_class' => 'bdt-prime-slider-thumbnail-size-',
        ] );
        $this->add_control( 'show_title', [
            'label'     => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
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
        $this->add_control( 'show_category', [
            'label'   => esc_html__( 'Show Category', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_excerpt', [
            'label'   => esc_html__( 'Show Excerpt', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_price', [
            'label'   => __( 'Price', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_cart', [
            'label'   => __( 'Add to Cart', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_navigation_dots', [
            'label'   => esc_html__( 'Show Dots', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_social_share', [
            'label'   => esc_html__( 'Show Social Share', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'social_share_hide_on_mobile', [
            'label'        => esc_html__( 'Social Share Hide on Mobile', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'bdt-social-share-hide--',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_social_link', [
            'label'     => __( 'Social Share', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_social_share' => 'yes',
        ],
        ] );
        $repeater = new Repeater();
        $medias = Module::get_social_media();
        $medias_names = array_keys( $medias );
        $repeater->add_control( 'button', [
            'label'   => esc_html__( 'Social Media', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SELECT,
            'options' => array_reduce( $medias_names, function ( $options, $media_name ) use( $medias ) {
            $options[$media_name] = $medias[$media_name]['title'];
            return $options;
        }, [] ),
            'default' => 'facebook',
        ] );
        $repeater->add_control( 'text', [
            'label' => esc_html__( 'Custom Label', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::TEXT,
        ] );
        $this->add_control( 'share_buttons', [
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [ [
            'button' => 'facebook',
        ], [
            'button' => 'linkedin',
        ], [
            'button' => 'twitter',
        ] ],
            'title_field' => '{{{ button }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_post_query_builder', [
            'label' => esc_html__( 'Query', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->register_query_builder_controls();
        $this->update_control( 'posts_source', [
            'type'    => Controls_Manager::SELECT,
            'default' => 'product',
            'options' => [
            'product'            => esc_html__( 'Product', 'bdthemes-prime-slider' ),
            'manual_selection'   => esc_html__( 'Manual Selection', 'bdthemes-prime-slider' ),
            'current_query'      => esc_html__( 'Current Query', 'bdthemes-prime-slider' ),
            '_related_post_type' => esc_html__( 'Related', 'bdthemes-prime-slider' ),
        ],
        ] );
        $this->update_control( 'posts_limit', [
            'label'   => esc_html__( 'Limit', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 3,
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_animation', [
            'label' => esc_html__( 'Slider Settings', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'finite', [
            'label'   => esc_html__( 'Loop', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'autoplay', [
            'label'   => esc_html__( 'Autoplay', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'autoplay_interval', [
            'label'     => esc_html__( 'Autoplay Interval (ms)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::NUMBER,
            'default'   => 7000,
            'condition' => [
            'autoplay' => 'yes',
        ],
        ] );
        $this->add_control( 'pause_on_hover', [
            'label' => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_control( 'velocity', [
            'label' => __( 'Animation Speed', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::SLIDER,
            'range' => [
            'px' => [
            'min'  => 0.1,
            'max'  => 1,
            'step' => 0.1,
        ],
        ],
        ] );
        $this->end_controls_section();
        /**
         * Advanced Animation
         */
        $this->start_controls_section( 'section_advanced_animation', [
            'label' => esc_html__( 'Advanced Animation', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->add_control( 'animation_status', [
            'label'   => esc_html__( 'Advanced Animation', 'bdthemes-element-pack' ),
            'type'    => Controls_Manager::SWITCHER,
            'classes' => BDTPS_IS_PC,
        ] );
        $this->add_control( 'animation_of', [
            'label'     => __( 'Animation Of', 'bdthemes-element-pack' ),
            'type'      => Controls_Manager::SELECT2,
            'multiple'  => true,
            'options'   => [
            '.bdt-ps-title' => __( 'Title', 'bdthemes-element-pack' ),
            '.bdt-ps-text'  => __( 'Excerpt', 'bdthemes-element-pack' ),
        ],
            'default'   => [ '.bdt-ps-title' ],
            'condition' => [
            'animation_status' => 'yes',
        ],
        ] );
        $this->add_control( 'animation_on', [
            'label'     => __( 'Animation On', 'bdthemes-element-pack' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'words',
            'options'   => [
            'chars' => 'Chars',
            'words' => 'Words',
            'lines' => 'Lines',
        ],
            'condition' => [
            'animation_status' => 'yes',
        ],
        ] );
        $this->add_control( 'animation_options', [
            'label'        => __( 'Animation Options', 'bdthemes-element-pack' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => __( 'Default', 'bdthemes-element-pack' ),
            'label_on'     => __( 'Custom', 'bdthemes-element-pack' ),
            'return_value' => 'yes',
            'default'      => 'yes',
            'condition'    => [
            'animation_status' => 'yes',
        ],
        ] );
        $this->start_popover();
        $this->add_control( 'anim_perspective', [
            'label'       => esc_html__( 'Perspective', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'placeholder' => '400',
            'range'       => [
            'px' => [
            'min' => 50,
            'max' => 400,
        ],
        ],
            'condition'   => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->add_control( 'anim_duration', [
            'label'     => esc_html__( 'Transition Duration', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min'  => 0.1,
            'step' => 0.1,
            'max'  => 1,
        ],
        ],
            'condition' => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->add_control( 'anim_scale', [
            'label'     => esc_html__( 'Scale', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 1,
            'max' => 10,
        ],
        ],
            'condition' => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->add_control( 'anim_rotationY', [
            'label'     => esc_html__( 'rotationY', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => -360,
            'max' => 360,
        ],
        ],
            'condition' => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->add_control( 'anim_rotationX', [
            'label'     => esc_html__( 'rotationX', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => -360,
            'max' => 360,
        ],
        ],
            'condition' => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->add_control( 'anim_transform_origin', [
            'label'     => esc_html__( 'Transform Origin', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => '0% 50% -50',
            'condition' => [
            'animation_status'  => 'yes',
            'animation_options' => 'yes',
        ],
        ] );
        $this->end_popover();
        $this->end_controls_section();
        /**
         * Reveal Effects
         */
        if ( 'on' === $reveal_effects ) {
            $this->register_reveal_effects();
        }
        //Style Start
        $this->start_controls_section( 'section_style_sliders', [
            'label' => esc_html__( 'Sliders', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'image_overlay_color', [
            'label'       => esc_html__( 'Image Overlay Color', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::COLOR,
            'description' => esc_html__( 'NOTE: It just works on Mobile Device.', 'bdthemes-prime-slider' ),
            'selectors'   => [
            '(mobile){{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-wc-product-img:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'content_padding', [
            'label'      => esc_html__( 'Content Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'separator'  => 'before',
        ] );
        $this->start_controls_tabs( 'slider_item_style' );
        $this->start_controls_tab( 'slider_title_style', [
            'label'     => __( 'Title', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'show_text_stroke', [
            'label'        => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'bdt-text-stroke--',
            'condition'    => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-title a' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'title_typography',
            'label'     => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-title',
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'prime_slider_title_spacing', [
            'label'     => esc_html__( 'Title Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_category_style', [
            'label'     => __( 'Category', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_category' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'category_heading_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'category_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'category_background_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'category_border_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a',
        ] );
        $this->add_responsive_control( 'prime_slider_category_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_category' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'category_heading_hover', [
            'label'     => __( 'Hover', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'category_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'category_hover_background_color', [
            'label'     => esc_html__( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-category a:hover:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_style_excerpt', [
            'label'     => esc_html__( 'Excerpt', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_excerpt' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'excerpt_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-text' => 'color: {{VALUE}};',
        ],
            'condition' => [
            'show_excerpt' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'excerpt_typography',
            'label'     => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-text',
            'condition' => [
            'show_excerpt' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'prime_slider_excerpt_spacing', [
            'label'     => esc_html__( 'Excerpt Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-text' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_excerpt' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_style_price', [
            'label'     => __( 'Price', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_price' => 'yes',
        ],
        ] );
        $this->add_control( 'old_price_heading', [
            'label' => __( 'Old Price', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'old_price_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price del span' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'old_price_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price del > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'old_price_typography',
            'label'    => __( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price del span',
        ] );
        $this->add_control( 'sale_price_heading', [
            'label'     => __( 'Sale Price', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'sale_price_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price ins, {{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price > span' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_responsive_control( 'sale_price_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price ins, {{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'sale_price_typography',
            'label'    => __( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price ins, {{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price .price > span',
        ] );
        $this->add_responsive_control( 'sale_price_spacing', [
            'label'      => __( 'Spacing', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-price' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_button', [
            'label'     => __( 'Add to Cart Button', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_cart' => 'yes',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_button_style' );
        $this->start_controls_tab( 'tab_button_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'button_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'button_background', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'        => 'button_border',
            'label'       => __( 'Border', 'bdthemes-prime-slider' ),
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button',
        ] );
        $this->add_responsive_control( 'button_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'button_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'button_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'button_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_button_hover', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'button_hover_background', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button:before' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'button_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'button_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'button_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .button:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_button_quantity', [
            'label' => __( 'Quantity', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'quantity_button_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'quantity_button_background', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'        => 'quantity_button_border',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text',
        ] );
        $this->add_responsive_control( 'quantity_button_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'quantity_button_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'quantity_button_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'quantity_button_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-content-wrapper .bdt-ps-add-to-cart .input-text',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_social_icon', [
            'label'     => esc_html__( 'Social Share', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_social_share' => 'yes',
        ],
        ] );
        $this->start_controls_tabs( 'tabs_social_icon_style' );
        $this->start_controls_tab( 'tab_social_icon_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'social_icon_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'social_icon_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'        => 'social_icon_border',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn',
        ] );
        $this->add_responsive_control( 'social_icon_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'social_icon_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'social_icon_spacing', [
            'label'     => esc_html__( 'Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item' => 'margin-left: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'social_offset_spacing', [
            'label'     => esc_html__( 'Horizontal Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share' => 'left: -{{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'social_icon_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'social_text_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_social_icon_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'social_icon_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'social_icon_hover_background',
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn:hover',
            'separator' => 'after',
        ] );
        $this->add_control( 'icon_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'social_icon_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-social-share .bdt-social-share-item .bdt-ps-btn:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_navigation', [
            'label'     => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_navigation_dots' => 'yes',
        ],
        ] );
        $this->add_control( 'dot_number_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav li a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'dot_hover_color', [
            'label'     => __( 'Hover Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav li a:hover' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'active_dot_number_color', [
            'label'     => __( 'Active Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav li.bdt-active a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'dots_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav li a',
        ] );
        $this->add_responsive_control( 'dots_spacing', [
            'label'     => esc_html__( 'Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav li' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'dots_offset_spacing', [
            'label'     => esc_html__( 'Horizontal Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-woolamp .bdt-ps-dotnav' => 'right: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_section();
    }
    
    public function render_query()
    {
        $default = $this->getGroupControlQueryArgs();
        $wp_query = new WP_Query( $default );
        return $wp_query;
    }
    
    public function render_header()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider-woolamp' );
        /**
         * Advanced Animation
         */
        $this->adv_anim();
        $this->add_render_attribute( 'slideshow', 'id', 'bdt-' . $this->get_id() );
        /**
         * Reveal Effects
         */
        $this->reveal_effects_attr();
        //Viewport Height
        $ratio = ( !empty($settings['slider_size_ratio']['width']) && !empty($settings['slider_size_ratio']['height']) ? $settings['slider_size_ratio']['width'] . ":" . $settings['slider_size_ratio']['height'] : '16:9' );
        if ( isset( $settings["viewport_height"]["size"] ) && 'vh' == $settings['viewport_height']['unit'] ) {
            $ratio = false;
        }
        $this->add_render_attribute( 'slideshow-items', 'class', 'bdt-slideshow-items' );
        if ( isset( $settings["viewport_height"]["size"] ) && $ratio == false ) {
            $this->add_render_attribute( [
                'slideshow-items' => [
                'style' => 'min-height:' . $settings["viewport_height"]["size"] . 'vh',
            ],
            ] );
        }
        $this->add_render_attribute( [
            'slideshow' => [
            'bdt-slideshow' => [ wp_json_encode( [
            "animation"         => 'fade',
            "ratio"             => $ratio,
            'min-height'        => ( !empty($settings['slider_min_height']['size']) && $ratio !== false ? $settings['slider_min_height']['size'] : (( $ratio !== false ? 460 : false )) ),
            "autoplay"          => ( $settings["autoplay"] ? true : false ),
            "autoplay-interval" => $settings["autoplay_interval"],
            "pause-on-hover"    => ( "yes" === $settings["pause_on_hover"] ? true : false ),
            "velocity"          => ( $settings["velocity"]["size"] ? $settings["velocity"]["size"] : 1 ),
            "finite"            => ( $settings["finite"] ? false : true ),
        ] ) ],
        ],
        ] );
        ?>
		<div class="bdt-prime-slider">

			<div <?php 
        $this->print_render_attribute_string( 'slider' );
        ?>>

				<div class="bdt-position-relative bdt-visible-toggle" <?php 
        $this->print_render_attribute_string( 'slideshow' );
        ?>>

					<ul <?php 
        $this->print_render_attribute_string( 'slideshow-items' );
        ?>>
					<?php 
    }
    
    public function render_navigation_dots()
    {
        $settings = $this->get_active_settings();
        if ( '' == $settings['show_navigation_dots'] ) {
            return;
        }
        ?>
						<ul class="bdt-ps-dotnav bdt-position-center-right reveal-muted">
							<?php 
        $slide_index = 1;
        $wp_query = $this->render_query();
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            ?>

								<li bdt-slideshow-item="<?php 
            echo  $slide_index - 1 ;
            ?>" data-label="<?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?>"><a href="#"><?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?></a>
									<?php 
            $slide_index++;
            ?>
								</li>

							<?php 
        }
        wp_reset_postdata();
        ?>
						</ul>
					<?php 
    }
    
    public function render_footer()
    {
        ?>

					</ul>
					<?php 
        $this->render_navigation_dots();
        ?>
				</div>
				<?php 
        $this->render_social_share();
        ?>
			</div>
			</div>
		<?php 
    }
    
    public function render_social_share()
    {
        $settings = $this->get_active_settings();
        if ( empty($settings['share_buttons']) ) {
            return;
        }
        ?>
			<div class="bdt-ps-social-share reveal-muted">
				<?php 
        foreach ( $settings['share_buttons'] as $button ) {
            $social_name = $button['button'];
            $this->add_render_attribute(
                [
                'social-attrs' => [
                'class'       => [ 'bdt-ps-btn', 'bdt-ps-' . $social_name ],
                'data-social' => $social_name,
            ],
            ],
                '',
                '',
                true
            );
            ?>
					<div class="bdt-social-share-item">
						<div <?php 
            echo  $this->get_render_attribute_string( 'social-attrs' ) ;
            ?>>
							<?php 
            echo  ( $button['text'] ? esc_html( $button['text'] ) : Module::get_social_media( $social_name )['title'] ) ;
            ?>
						</div>
					</div>
				<?php 
        }
        ?>
			</div>


		<?php 
    }
    
    public function render_item_content()
    {
        $settings = $this->get_settings_for_display();
        $parallax_title = 'data-bdt-slideshow-parallax="y: 70,0,-100; opacity: 1,1,0"';
        $parallax_text = 'data-bdt-slideshow-parallax="y: 90,0,-90; opacity: 1,1,0"';
        ?>
			<div class="bdt-ps-content-inner">

				<?php 
        
        if ( $settings['show_category'] ) {
            ?>
					<div class="bdt-ps-category" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 50,0,-110; opacity: 1,1,0">
						<?php 
            echo  wc_get_product_category_list( get_the_ID(), ' ' ) ;
            ?>
					</div>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $settings['show_title'] ) {
            ?>
					<<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-ps-title" data-reveal="reveal-active" <?php 
            echo  $parallax_title ;
            ?>>
						<a href="<?php 
            the_permalink();
            ?>">
							<?php 
            the_title();
            ?>
						</a>
					</<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?>>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $settings['show_excerpt'] ) {
            ?>
					<div class="bdt-ps-text" data-reveal="reveal-active" <?php 
            echo  $parallax_text ;
            ?>><?php 
            the_excerpt();
            ?></div>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $settings['show_price'] ) {
            ?>
					<div class="bdt-ps-price" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 100,0,-70; opacity: 1,1,0">
						<span class="wae-product-price"><?php 
            woocommerce_template_single_price();
            ?></span>
					</div>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $settings['show_cart'] ) {
            ?>
					<div class="bdt-ps-add-to-cart-btn" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 110,0,-50; opacity: 1,1,0">
						<?php 
            
            if ( $settings['show_cart'] ) {
                ?>
							<div class="bdt-ps-add-to-cart">
								<?php 
                woocommerce_template_single_add_to_cart();
                ?>
							</div>
						<?php 
            }
            
            ?>

					</div>
				<?php 
        }
        
        ?>

			</div>
			<?php 
    }
    
    public function render_slides_loop()
    {
        $settings = $this->get_settings_for_display();
        $wp_query = $this->render_query();
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $placeholder_image_src = Utils::get_placeholder_image_src();
            $image_src = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_size', $settings );
            
            if ( $image_src ) {
                $image_final_src = $image_src;
            } elseif ( $placeholder_image_src ) {
                $image_final_src = $placeholder_image_src;
            } else {
                return;
            }
            
            ?>

				<li class="bdt-slideshow-item bdt-flex elementor-repeater-item-<?php 
            echo  get_the_ID() ;
            ?>">

					<div class="bdt-ps-item-inner bdt-flex bdt-flex-middle">

						<div class="bdt-ps-wc-product-img" data-reveal="reveal-active">
							<img src="<?php 
            echo  esc_url( $image_final_src ) ;
            ?>" alt="<?php 
            echo  get_the_title() ;
            ?>">
						</div>

						<div class="bdt-ps-content-wrapper">
							<?php 
            $this->render_item_content();
            ?>
						</div>

					</div>

				</li>

	<?php 
        }
        wp_reset_postdata();
    }
    
    public function render()
    {
        $this->render_header();
        $this->render_slides_loop();
        $this->render_footer();
    }

}