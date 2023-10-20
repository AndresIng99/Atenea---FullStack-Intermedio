<?php

namespace PrimeSlider\Modules\Sequester\Widgets;

use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Text_Stroke ;
use  PrimeSlider\Utils ;
use  Elementor\Repeater ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Sequester extends Widget_Base
{
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-sequester';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Sequester', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-sequester';
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
            'sequester',
            'prime'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-sequester' ];
    }
    
    public function get_script_depends()
    {
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        
        if ( 'on' === $reveal_effects ) {
            return [];
        } else {
            return [];
        }
    
    }
    
    public function get_custom_help_url()
    {
        return 'https://youtu.be/pk5kCstNHBY';
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
        $this->add_control( 'show_title', [
            'label'   => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_sub_title', [
            'label'   => esc_html__( 'Show Sub Title', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_button_text', [
            'label'   => esc_html__( 'Show Button', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_excerpt', [
            'label'   => esc_html__( 'Show Excerpt', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_social_icon', [
            'label'   => esc_html__( 'Show Social Share', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_navigation_arrows', [
            'label'   => esc_html__( 'Show Arrows', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_navigation_dots', [
            'label'   => esc_html__( 'Show Dots', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'title_html_tag', [
            'label'     => __( 'Title HTML Tag', 'bdthemes-element-pack' ) . BDTPS_PC,
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content' => 'text-align: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'         => 'thumbnail_size',
            'label'        => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
            'exclude'      => [ 'custom' ],
            'default'      => 'full',
            'prefix_class' => 'bdt-custom-gallery--thumbnail-size-',
        ] );
        $this->add_control( 'show_image_match_height', [
            'label'        => esc_html__( 'Image Match Height', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'         => Controls_Manager::SWITCHER,
            'default'      => 'yes',
            'prefix_class' => 'bdt-ps-image-match-height--',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_sliders', [
            'label' => esc_html__( 'Sliders', 'bdthemes-prime-slider' ),
        ] );
        $repeater = new Repeater();
        $repeater->add_control( 'sub_title', [
            'label'       => esc_html__( 'Sub Title', 'bdthemes-prime-slider' ),
            'default'     => esc_html__( 'This is a Label', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'title', [
            'label'       => esc_html__( 'Title', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__( 'Slide Title', 'bdthemes-prime-slider' ),
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'title_link', [
            'label'         => esc_html__( 'Title Link', 'bdthemes-prime-slider' ) . BDTPS_PC,
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
        $repeater->add_control( 'slide_button_text', [
            'label'       => esc_html__( 'Button Text', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__( 'See Details', 'bdthemes-prime-slider' ),
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'button_link', [
            'label'     => esc_html__( 'Button Link', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::URL,
            'default'   => [
            'url' => '',
        ],
            'dynamic'   => [
            'active' => true,
        ],
            'condition' => [
            'title!' => '',
        ],
        ] );
        $repeater->add_control( 'excerpt', [
            'label'       => esc_html__( 'Excerpt', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::WYSIWYG,
            'default'     => esc_html__( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore et quasi architecto beatae vitae dicta sunt explicabo.', 'bdthemes-prime-slider' ),
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
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
            'default'     => [ [
            'title' => esc_html__( 'Sequester Slide One', 'bdthemes-prime-slider' ),
            'image' => [
            'url' => BDTPS_ASSETS_URL . 'images/svg-img/item-01.svg',
        ],
        ], [
            'title' => esc_html__( 'Sequester Slide Two', 'bdthemes-prime-slider' ),
            'image' => [
            'url' => BDTPS_ASSETS_URL . 'images/svg-img/item-02.svg',
        ],
        ], [
            'title' => esc_html__( 'Sequester Slide Three', 'bdthemes-prime-slider' ),
            'image' => [
            'url' => BDTPS_ASSETS_URL . 'images/svg-img/item-03.svg',
        ],
        ] ],
            'title_field' => '{{{ title }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_social_link', [
            'label'     => __( 'Social Share', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_social_icon' => 'yes',
        ],
        ] );
        $repeater = new Repeater();
        $repeater->add_control( 'social_link_title', [
            'label'   => __( 'Title', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'Facebook',
        ] );
        $repeater->add_control( 'social_link', [
            'label'   => __( 'Link', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'social_link_list', [
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [ [
            'social_link'       => __( 'http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_link_title' => 'Facebook',
        ], [
            'social_link'       => __( 'http://www.twitter.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_link_title' => 'Twitter',
        ], [
            'social_link'       => __( 'http://www.instagram.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_link_title' => 'Instagram',
        ] ],
            'title_field' => '{{{ social_link_title }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_animation', [
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
            'label'     => esc_html__( 'Autoplay Interval', 'bdthemes-prime-slider' ),
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
            'label' => __( 'Animation Speed', 'bdthemes-element-pack' ),
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
            '.bdt-sub-title-inner' => __( 'Sub Title', 'bdthemes-element-pack' ),
            '.bdt-title-tag'       => __( 'Title', 'bdthemes-element-pack' ),
            '.bdt-slider-excerpt'  => __( 'Excerpt', 'bdthemes-element-pack' ),
        ],
            'default'   => [ '.bdt-title-tag' ],
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
        $this->add_control( 'custom_overlay_color', [
            'label' => esc_html__( 'Custom Overlay', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_control( 'overlay_color', [
            'label'     => esc_html__( 'Overlay Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-slideshow-item .bdt-slide-image:before' => 'background: {{VALUE}};',
        ],
            'condition' => [
            'custom_overlay_color' => 'yes',
        ],
        ] );
        $this->add_control( 'overlay_opacity', [
            'label'     => esc_html__( 'Opacity', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min'  => 0,
            'step' => 0.1,
            'max'  => 1,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-slideshow-item .bdt-slide-image:before' => 'opacity: {{SIZE}};',
        ],
            'condition' => [
            'custom_overlay_color' => 'yes',
        ],
        ] );
        $this->start_controls_tabs( 'slider_item_style' );
        $this->start_controls_tab( 'slider_title_style', [
            'label'     => __( 'Title', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'title_width', [
            'label'     => esc_html__( 'Title Width', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 220,
            'max' => 1200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        // $this->add_control(
        // 	'show_text_stroke',
        // 	[
        // 		'label'   => esc_html__('Text Stroke', 'bdthemes-prime-slider') . BDTPS_NC,
        // 		'type'    => Controls_Manager::SWITCHER,
        // 		'prefix_class' => 'bdt-text-stroke--',
        // 		'condition' => [
        // 			'show_title' => ['yes'],
        // 		],
        // 	]
        // );
        $this->add_control( 'title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag a' => 'color: {{VALUE}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'first_word_title_color', [
            'label'     => esc_html__( 'First Word Color', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag .frist-word' => 'color: {{VALUE}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'title_typography',
            'label'     => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Text_Stroke::get_type(), [
            'name'           => 'title_text_stroke',
            'selector'       => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'fields_options' => [
            'text_stroke_type' => [
            'label' => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
        ],
        ],
            'condition'      => [
            'show_title' => [ 'yes' ],
        ],
            'classes'        => BDTPS_IS_PC,
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_sub_title_style', [
            'label'     => __( 'Sub Title', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_sub_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'sub_title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc h4' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'sub_title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc h4',
        ] );
        $this->add_responsive_control( 'prime_slider_sub_title_spacing', [
            'label'     => esc_html__( 'Sub Title Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-sub-title h4' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_sub_title' => [ 'yes' ],
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'excerpt_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt',
        ] );
        $this->add_responsive_control( 'excerpt_width', [
            'label'          => __( 'Width (px)', 'bdthemes-prime-slider' ),
            'type'           => Controls_Manager::SLIDER,
            'default'        => [
            'unit' => 'px',
        ],
            'tablet_default' => [
            'unit' => 'px',
        ],
            'mobile_default' => [
            'unit' => 'px',
        ],
            'size_units'     => [ 'px' ],
            'range'          => [
            'px' => [
            'min' => 100,
            'max' => 800,
        ],
        ],
            'selectors'      => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_excerpt' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_button_style', [
            'label'     => __( 'Button', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_button_text' => 'yes',
        ],
        ] );
        $this->add_control( 'slider_button_style_normal', [
            'label'     => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'slide_button_text_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn svg *' => 'stroke: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'slide_button_background_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'slide_button_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_control( 'slide_button_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'slide_button_box_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_responsive_control( 'slide_button_text_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'slide_button_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_control( 'slider_button_icon_heading', [
            'label' => esc_html__( 'Icon', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'slide_button_icon_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content .bdt-slide-btn svg *' => 'stroke: {{VALUE}} !important;',
        ],
        ] );
        $this->add_control( 'slide_button_icon_background_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-slide-btn .bdt-slide-btn-icon' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'slider_button_style_hover', [
            'label'     => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'slide_button_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover svg *' => 'stroke: {{VALUE}};',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'slide_button_background_hover_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'slide_button_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'slide_button_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'slider_button_icon_hover_heading', [
            'label' => esc_html__( 'Icon', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'slide_button_icon_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content .bdt-slide-btn:hover svg *' => 'stroke: {{VALUE}} !important;',
        ],
        ] );
        $this->add_control( 'slide_button_icon_hover_bg_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-slide-btn .bdt-slide-btn-icon::after' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_social_icon', [
            'label'     => esc_html__( 'Social Share', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_social_icon' => 'yes',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'social_icon_style_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-social-icon a .bdt-social-share-title:before' => 'background: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'social_icon_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'        => 'social_icon_border',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->add_control( 'social_icon_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'social_icon_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'social_icon_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->add_control( 'social_icon_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'social_text_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_social_icon_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'social_icon_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'social_icon_hover_background',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover',
        ] );
        $this->add_control( 'icon_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'social_icon_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_navigation', [
            'label' => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->start_controls_tabs( 'tabs_navigation_style' );
        $this->start_controls_tab( 'tab_navigation_arrows_style', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'arrows_color', [
            'label'     => __( 'Arrows Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-next svg, {{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-previous svg' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'arrows_background',
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'arrows_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-next::before, {{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-previous::before' => 'border-color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'navi_dot_heading', [
            'label'     => __( 'D O T S', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'navi_dot_color', [
            'label'     => __( 'Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li a' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'active_dot_color', [
            'label'     => __( 'Active Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-slideshow-nav li a:before'                                                    => 'border-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-dotnav li a'                                     => 'background: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li:hover a, {{WRAPPER}} .bdt-dotnav li.bdt-active a' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'dots_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-dotnav li::before'           => 'border: 1px solid {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-dotnav li.bdt-active::after' => 'border-top-color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'active_dots_border_color', [
            'label'     => __( 'Active Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-dotnav li.bdt-active::before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-dotnav li.bdt-active::after'  => 'border-top-color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_navigation_arrows_hover_style', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'arrows_hover_color', [
            'label'     => __( 'Arrows Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-next:hover svg, {{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-previous:hover svg' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'arrows_hover_background',
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'arrows_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-next:hover:before, {{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-previous:hover:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-next:hover::after, {{WRAPPER}} .bdt-prime-slider-sequester .bdt-prime-slider-previous:hover::after' => 'border-top-color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    
    public function render_header()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider-sequester' );
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
        $ratio = ( !empty($settings['slider_size_ratio']['width']) && !empty($settings['slider_size_ratio']['height']) ? $settings['slider_size_ratio']['width'] . ":" . $settings['slider_size_ratio']['height'] : '16:8' );
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
            'min-height'        => ( !empty($settings['slider_min_height']['size']) && $ratio !== false ? $settings['slider_min_height']['size'] : (( $ratio !== false ? 540 : false )) ),
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
        ?> >
					<div class="bdt-position-relative bdt-visible-toggle" <?php 
        $this->print_render_attribute_string( 'slideshow' );
        ?>>
						<ul <?php 
        $this->print_render_attribute_string( 'slideshow-items' );
        ?>>
		<?php 
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->get_settings_for_display();
        ?>

		<?php 
        if ( $settings['show_navigation_arrows'] ) {
            ?>
		<div class="bdt-navigation-arrows reveal-muted">
			<a class="bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
			<a class="bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
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

			<ul class="bdt-slideshow-nav bdt-dotnav reveal-muted"></ul>

        <?php 
        }
        ?>

        <?php 
    }
    
    public function render_social_link()
    {
        $settings = $this->get_active_settings();
        if ( '' == $settings['show_social_icon'] ) {
            return;
        }
        $this->add_render_attribute( 'social-icon', 'class', 'bdt-prime-slider-social-icon' );
        $this->add_render_attribute( 'social-icon', 'data-reveal', 'reveal-active' );
        ?>

			<div <?php 
        $this->print_render_attribute_string( 'social-icon' );
        ?>>

				<?php 
        foreach ( $settings['social_link_list'] as $link ) {
            ?>

					<a href="<?php 
            echo  esc_url( $link['social_link'] ) ;
            ?>" target="_blank">
						<span class="bdt-social-share-title">
							<?php 
            echo  esc_html( $link['social_link_title'] ) ;
            ?>
						</span>
					</a>
					
				<?php 
        }
        ?>

			</div>

		<?php 
    }
    
    public function render_footer()
    {
        ?>

                </ul>

                <?php 
        $this->render_navigation_arrows();
        ?>
                <?php 
        $this->render_navigation_dots();
        ?>
				
			</div>
			<?php 
        $this->render_social_link();
        ?>
		</div>
		</div>
        <?php 
    }
    
    public function rendar_item_image( $item, $alt = '' )
    {
        $settings = $this->get_settings_for_display();
        $image_src = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail_size', $settings );
        
        if ( $image_src ) {
            $image_src = $image_src;
        } elseif ( $item['image']['url'] ) {
            $image_src = $item['image']['url'];
        } else {
            return;
        }
        
        ?>

		<img src="<?php 
        echo  esc_url( $image_src ) ;
        ?>" alt="<?php 
        echo  esc_html( $alt ) ;
        ?>">

		<?php 
    }
    
    public function render_button( $content )
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'slider-button',
            'class',
            'bdt-slide-btn',
            true
        );
        $this->add_render_attribute(
            'slider-button',
            'data-reveal',
            'reveal-active',
            true
        );
        
        if ( $content['button_link']['url'] ) {
            $this->add_render_attribute(
                'slider-button',
                'href',
                $content['button_link']['url'],
                true
            );
            if ( $content['button_link']['is_external'] ) {
                $this->add_render_attribute(
                    'slider-button',
                    'target',
                    '_blank',
                    true
                );
            }
            if ( $content['button_link']['nofollow'] ) {
                $this->add_render_attribute(
                    'slider-button',
                    'rel',
                    'nofollow',
                    true
                );
            }
        } else {
            $this->add_render_attribute(
                'slider-button',
                'href',
                '#',
                true
            );
        }
        
        ?>

		<?php 
        
        if ( $content['slide_button_text'] && 'yes' == $settings['show_button_text'] ) {
            ?>

			<a <?php 
            $this->print_render_attribute_string( 'slider-button' );
            ?>>

				<?php 
            $this->add_render_attribute(
                [
                'content-wrapper' => [
                'class' => 'bdt-prime-slider-button-wrapper',
            ],
                'text'            => [
                'class' => 'bdt-prime-slider-button-text bdt-flex bdt-flex-middle bdt-flex-inline',
            ],
            ],
                '',
                '',
                true
            );
            ?>
				<span <?php 
            $this->print_render_attribute_string( 'content-wrapper' );
            ?>>

					<span <?php 
            $this->print_render_attribute_string( 'text' );
            ?>><?php 
            echo  wp_kses( $content['slide_button_text'], prime_slider_allow_tags( 'title' ) ) ;
            ?><span class="bdt-slide-btn-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-right"><polyline fill="none" stroke="#000" points="10 5 15 9.5 10 14"></polyline><line fill="none" stroke="#000" x1="4" y1="9.5" x2="15" y2="9.5"></line></svg></span></span>

				</span>


			</a>
		<?php 
        }
    
    }
    
    public function render_item_content( $slide_content )
    {
        $settings = $this->get_settings_for_display();
        $parallax_sub_title = 'data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0"';
        $parallax_title = 'data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0"';
        $parallax_text = 'data-bdt-slideshow-parallax="y: 100,0,-80; opacity: 1,1,0"';
        ?>

		<div class="bdt-prime-slider-content">
			<div class="bdt-prime-slider-desc">

				<?php 
        
        if ( $slide_content['sub_title'] && 'yes' == $settings['show_sub_title'] ) {
            ?>
					<div class="bdt-sub-title">
						<h4 class="bdt-sub-title-inner" <?php 
            echo  $parallax_sub_title ;
            ?> data-reveal="reveal-active">
							<?php 
            echo  wp_kses_post( $slide_content['sub_title'] ) ;
            ?>
						</h4>
					</div>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $slide_content['title'] && 'yes' == $settings['show_title'] ) {
            ?>
					<div class="bdt-main-title">
						<<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-title-tag" <?php 
            echo  $parallax_title ;
            ?> data-reveal="reveal-active">
							<?php 
            
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
								<a href="<?php 
                echo  esc_url( $slide_content['title_link']['url'] ) ;
                ?>">
								<?php 
            }
            
            ?>
								<?php 
            echo  prime_slider_first_word( $slide_content['title'] ) ;
            ?>
								<?php 
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
								</a>
							<?php 
            }
            ?>
						</<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?>>
					</div>
				<?php 
        }
        
        ?>

				<?php 
        
        if ( $slide_content['excerpt'] && 'yes' == $settings['show_excerpt'] ) {
            ?>
					<div class="bdt-slider-excerpt" <?php 
            echo  $parallax_title ;
            ?> data-reveal="reveal-active">
						<?php 
            echo  wp_kses_post( $slide_content['excerpt'] ) ;
            ?>
					</div>
				<?php 
        }
        
        ?>

				<div class="bdt-button-wrapper" data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0">
					<?php 
        $this->render_button( $slide_content );
        ?>
				</div>
				
			</div>
		</div>

        <?php 
    }
    
    public function render_slides_loop()
    {
        $settings = $this->get_settings_for_display();
        foreach ( $settings['slides'] as $slide ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $slide['image']['id'], 'thumbnail_size', $settings );
            if ( !$image_src ) {
                $image_src = $slide['image']['url'];
            }
            ?>

            <li class="bdt-slideshow-item bdt-flex bdt-flex-row bdt-flex-middle elementor-repeater-item-<?php 
            echo  esc_attr( $slide['_id'] ) ;
            ?> ">

                    <?php 
            $this->render_item_content( $slide );
            ?>

                    <div class="bdt-slide-image" style="background-image: url('<?php 
            echo  esc_url( $image_src ) ;
            ?>');">
                        
                    </div>
            </li>

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