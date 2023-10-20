<?php

namespace PrimeSlider\Modules\Blog\Widgets;

use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Text_Stroke ;
use  Elementor\Icons_Manager ;
use  Elementor\Repeater ;
use  Elementor\Widget_Base ;
use  PrimeSlider\Modules\Blog\Skins ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
use  PrimeSlider\Traits\QueryControls\GroupQuery\Group_Control_Query ;
use  PrimeSlider\Traits\QueryControls\SelectInput\Dynamic_Select ;
use  PrimeSlider\Utils ;
use  WP_Query ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Blog extends Widget_Base
{
    use  Group_Control_Query ;
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-blog';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'Blog', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-blog';
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
            'blog',
            'prime'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-blog' ];
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
        return 'https://youtu.be/G32YlydUcHg';
    }
    
    public function register_skins()
    {
        $this->add_skin( new Skins\Skin_Coral( $this ) );
        $this->add_skin( new Skins\Skin_Zinest( $this ) );
        $this->add_skin( new Skins\Skin_Folio( $this ) );
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
            'min' => 0,
            'max' => 1024,
        ],
        ],
            'condition' => [
            'enable_height!' => 'yes',
        ],
        ] );
        $this->add_control( 'enable_height', [
            'label' => esc_html__( 'Enable Viewport Height', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'  => Controls_Manager::SWITCHER,
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
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'      => 'thumbnail_size',
            'label'     => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
            'exclude'   => [ 'custom' ],
            'default'   => 'full',
            'separator' => 'before',
        ] );
        //Global background settings Controls
        $this->register_background_settings( '.bdt-prime-slider .bdt-slideshow-item>.bdt-ps-slide-img' );
        $this->add_control( 'show_title', [
            'label'     => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
        ] );
        $this->add_control( 'title_html_tag', [
            'label'     => __( 'Title HTML Tag', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SELECT,
            'options'   => prime_slider_title_tags(),
            'default'   => 'h1',
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
        $this->add_control( 'show_button_text', [
            'label'     => esc_html__( 'Show Button', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => [ 'zinest' ],
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'button_text', [
            'label'       => esc_html__( 'Button Text', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Read More', 'bdthemes-prime-slider' ),
            'default'     => esc_html__( 'Read More', 'bdthemes-prime-slider' ),
            'label_block' => false,
            'condition'   => [
            '_skin!' => [ 'zinest' ],
        ],
        ] );
        $this->add_control( 'show_social_icon', [
            'label'     => esc_html__( 'Show Social Icon', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => 'zinest',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'show_scroll_button', [
            'label'     => esc_html__( 'Show Scroll Button', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => [ 'zinest', 'folio' ],
        ],
        ] );
        $this->add_control( 'show_category', [
            'label'   => esc_html__( 'Show Category', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'hr_1', [
            'type' => Controls_Manager::DIVIDER,
        ] );
        $this->add_control( 'show_meta', [
            'label'   => esc_html__( 'Show Meta', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_author', [
            'label'     => esc_html__( 'Show Author', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!'    => 'folio',
            'show_meta' => 'yes',
        ],
        ] );
        $this->add_control( 'show_admin_info', [
            'label'     => esc_html__( 'Show Author', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin'     => 'folio',
            'show_meta' => 'yes',
        ],
        ] );
        $this->add_control( 'show_date', [
            'label'     => esc_html__( 'Show Date', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            'show_meta' => 'yes',
        ],
        ] );
        $this->add_control( 'show_comments', [
            'label'     => esc_html__( 'Show Comments', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            'show_meta' => 'yes',
        ],
        ] );
        $this->add_control( 'hr', [
            'type' => Controls_Manager::DIVIDER,
        ] );
        $this->add_control( 'show_featured_post', [
            'label'     => esc_html__( 'Show Featured Post', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin' => 'zinest',
        ],
        ] );
        $this->add_control( 'show_navigation_arrows', [
            'label'     => esc_html__( 'Show Arrows', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => [ 'folio' ],
        ],
        ] );
        $this->add_control( 'show_navigation_dots', [
            'label'     => esc_html__( 'Show Dots', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => [ 'zinest', 'folio' ],
        ],
        ] );
        $this->add_responsive_control( 'content_alignment', [
            'label'     => esc_html__( 'Alignment', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
            'left'   => [
            'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-left',
        ],
            'center' => [
            'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-center',
        ],
            'right'  => [
            'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-right',
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content *' => 'text-align: {{VALUE}} !important;',
        ],
            'condition' => [
            '_skin' => [ 'zinest', 'coral', 'folio' ],
        ],
        ] );
        $this->add_responsive_control( 'ps_meta_alignment', [
            'label'     => esc_html__( 'Meta Alignment', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
            'left'     => [
            'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-left',
        ],
            'center'   => [
            'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-center',
        ],
            'flex-end' => [
            'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-h-align-right',
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-meta .bdt-ps-meta-item' => 'justify-content: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => 'zinest',
        ],
        ] );
        $this->end_controls_section();
        //New Query Builder Settings
        $this->start_controls_section( 'section_post_query_builder', [
            'label' => __( 'Query', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->register_query_builder_controls();
        $this->add_control( 'featured_query_heading', [
            'label'     => __( 'Featured Item', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
            '_skin' => 'zinest',
        ],
        ] );
        $this->add_control( 'featured_item_posts_selected_ids', [
            'label'       => __( 'Select Posts', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'        => Dynamic_Select::TYPE,
            'multiple'    => true,
            'label_block' => true,
            'condition'   => [
            '_skin' => 'zinest',
        ],
        ] );
        $this->update_control( 'posts_limit', [
            'type'    => Controls_Manager::NUMBER,
            'default' => 3,
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_social_link', [
            'label'     => __( 'Social Icon', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_social_icon' => 'yes',
            '_skin!'           => 'zinest',
        ],
        ] );
        $repeater = new Repeater();
        $repeater->add_control( 'social_link_title', [
            'label' => __( 'Title', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::TEXT,
        ] );
        $repeater->add_control( 'social_link', [
            'label' => __( 'Link', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::TEXT,
        ] );
        $repeater->add_control( 'social_icon', [
            'label'       => __( 'Choose Icon', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::ICONS,
            'skin'        => 'inline',
            'label_block' => false,
        ] );
        $this->add_control( 'social_link_list', [
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [ [
            'social_link'       => __( 'http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_icon'       => [
            'value'   => 'fab fa-facebook-f',
            'library' => 'fa-brands',
        ],
            'social_link_title' => 'Facebook',
        ], [
            'social_link'       => __( 'http://www.twitter.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_icon'       => [
            'value'   => 'fab fa-twitter',
            'library' => 'fa-brands',
        ],
            'social_link_title' => 'Twitter',
        ], [
            'social_link'       => __( 'http://www.instagram.com/bdthemes/', 'bdthemes-prime-slider' ),
            'social_icon'       => [
            'value'   => 'fab fa-instagram',
            'library' => 'fa-brands',
        ],
            'social_link_title' => 'Instagram',
        ] ],
            'title_field' => '{{{ social_link_title }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_scroll_button', [
            'label'     => esc_html__( 'Scroll Down', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_scroll_button' => [ 'yes' ],
            '_skin!'             => [ 'zinest', 'folio' ],
        ],
        ] );
        $this->add_control( 'duration', [
            'label'      => esc_html__( 'Duration', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [
            'px' => [
            'min'  => 100,
            'max'  => 5000,
            'step' => 50,
        ],
        ],
        ] );
        $this->add_control( 'offset', [
            'label' => esc_html__( 'Offset', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'  => Controls_Manager::SLIDER,
            'range' => [
            'px' => [
            'min'  => -200,
            'max'  => 200,
            'step' => 10,
        ],
        ],
        ] );
        $this->add_control( 'scroll_button_text', [
            'label'       => esc_html__( 'Button Text', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'        => Controls_Manager::TEXT,
            'dynamic'     => [
            'active' => true,
        ],
            'default'     => esc_html__( 'Scroll Down', 'bdthemes-prime-slider' ),
            'placeholder' => esc_html__( 'Scroll Down', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'section_id', [
            'label'       => esc_html__( 'Section ID', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => 'my-header',
            'description' => esc_html__( "By clicking this scroll button, to which section in your page you want to go? Just write that's section ID here such 'my-header'. N.B: No need to add '#'.", 'bdthemes-prime-slider' ),
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
        $this->add_control( 'kenburns_animation', [
            'label'     => esc_html__( 'Kenburns Animation', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ] );
        $this->add_control( 'kenburns_reverse', [
            'label'     => esc_html__( 'Kenburn Reverse', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            'kenburns_animation' => 'yes',
        ],
        ] );
        $this->end_controls_section();
        /**
         * Advanced Animation
         */
        $this->start_controls_section( 'section_advanced_animation', [
            'label' => esc_html__( 'Advanced Animation', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->add_control( 'animation_status', [
            'label'   => esc_html__( 'Advanced Animation', 'bdthemes-element-pack' ) . BDTPS_PC,
            'type'    => Controls_Manager::SWITCHER,
            'classes' => BDTPS_IS_PC,
        ] );
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
        $this->add_control( 'overlay', [
            'label'   => esc_html__( 'Overlay', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SELECT,
            'default' => 'background',
            'options' => [
            'none'       => esc_html__( 'None', 'bdthemes-prime-slider' ),
            'background' => esc_html__( 'Background', 'bdthemes-prime-slider' ),
            'blend'      => esc_html__( 'Blend', 'bdthemes-prime-slider' ),
        ],
        ] );
        $this->add_control( 'overlay_color', [
            'label'     => esc_html__( 'Overlay Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'overlay' => [ 'background', 'blend' ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-slideshow .bdt-overlay-default' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'blend_type', [
            'label'     => esc_html__( 'Blend Type', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'multiply',
            'options'   => prime_slider_blend_options(),
            'condition' => [
            'overlay' => 'blend',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
            '_skin!'     => '',
        ],
        ] );
        $this->add_control( 'title_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag a' => 'color: {{VALUE}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'first_word_title_color', [
            'label'     => esc_html__( 'First Word Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag a span' => 'color: {{VALUE}};',
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
            'name'      => 'title_text_stroke',
            'label'     => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag a',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'title_style_color', [
            'label'     => esc_html__( 'Separetor Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-blog .bdt-prime-slider-desc .bdt-main-title:before, {{WRAPPER}} .bdt-prime-slider-skin-blog .bdt-prime-slider-desc .bdt-main-title:after' => 'background: {{VALUE}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
            '_skin'      => '',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_style_excerpt', [
            'label'     => esc_html__( 'Excerpt', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_excerpt' => [ 'yes' ],
            '_skin!'       => 'zinest',
        ],
        ] );
        $this->add_control( 'excerpt_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-blog-text' => 'color: {{VALUE}};',
        ],
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'excerpt_typography',
            'label'     => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-blog-text',
            'condition' => [
            '_skin!' => 'zinest',
        ],
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-blog-text' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
            'condition'      => [
            'show_excerpt' => 'yes',
            '_skin!'       => 'zinest',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-blog-text' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_excerpt' => 'yes',
            '_skin!'       => 'zinest',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_button_style', [
            'label'     => __( 'Button', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_button_text' => 'yes',
            '_skin!'           => 'zinest',
        ],
        ] );
        $this->add_control( 'slider_button_style_normal', [
            'label'     => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slide_button_text_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn svg *' => 'stroke: {{VALUE}};',
        ],
            'separator' => 'before',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slide_button_background_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'background-color: {{VALUE}};',
        ],
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'slide_button_border',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_text_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_text_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'      => 'slide_button_box_shadow',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'slide_button_typography',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slider_button_style_hover', [
            'label'     => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slide_button_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover svg *' => 'stroke: {{VALUE}};',
        ],
            'separator' => 'before',
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slide_button_background_hover_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:before' => 'background-color: {{VALUE}};',
        ],
            'condition' => [
            '_skin!' => 'zinest',
        ],
        ] );
        $this->add_control( 'slide_button_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'slide_button_border_border!' => '',
            '_skin!'                      => 'zinest',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_social_icon', [
            'label'     => esc_html__( 'Social Icon', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_social_icon' => 'yes',
            '_skin!'           => 'zinest',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon i'   => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon svg' => 'fill: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'           => 'social_icon_background',
            'types'          => [ 'classic', 'gradient' ],
            'selector'       => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
            'fields_options' => [
            'background' => [
            'label' => esc_html__( 'Background Type', 'bdthemes-prime-slider' ) . BDTPS_PC,
        ],
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'        => 'social_icon_border',
            'placeholder' => '1px',
            'default'     => '1px',
            'selector'    => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->add_responsive_control( 'social_icon_radius', [
            'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'social_icon_padding', [
            'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'social_icon_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
        ] );
        $this->add_responsive_control( 'social_icon_size', [
            'label'     => __( 'Icon Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'social_icon_spacing', [
            'label'     => esc_html__( 'Icon Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'folio_social_icon_text_color', [
            'label'     => esc_html__( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon h3' => 'color: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => 'folio',
        ],
            'separator' => 'before',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'social_text_typography',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider-skin-folio .bdt-prime-slider-social-icon h3',
            'condition' => [
            '_skin' => 'folio',
        ],
        ] );
        $this->add_control( 'social_icon_tooltip', [
            'label'   => esc_html__( 'Show Tooltip', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_social_icon_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'social_icon_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover i'   => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover svg' => 'fill: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'social_icon_hover_background',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover, {{WRAPPER}} .bdt-prime-slider-skin-folio .bdt-prime-slider-social-icon a::before',
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
        $this->start_controls_section( 'section_style_scroll_button', [
            'label'     => esc_html__( 'Scroll Down', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_scroll_button' => [ 'yes' ],
            '_skin!'             => [ 'zinest', 'folio' ],
        ],
        ] );
        $this->start_controls_tabs( 'tabs_scroll_button_style' );
        $this->start_controls_tab( 'tab_scroll_button_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'scroll_button_text_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span svg *' => 'fill: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'scroll_button_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down span',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_scroll_button_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'scroll_button_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down:hover span'       => 'color: {{VALUE}};',
            '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down:hover span svg *' => 'fill: {{VALUE}};',
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
        $this->start_controls_tabs( 'category_style_tabs' );
        $this->start_controls_tab( 'category_style_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_icon_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'category_icon_background_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a' => 'background: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'category_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a',
        ] );
        $this->add_responsive_control( 'category_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'category_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'category_box_shadow',
            'label'    => esc_html__( 'Box Shadow', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'category_style_hover', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'category_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a:hover' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'category_background_hover_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a:hover' => 'background-color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'category_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'category_border_border!' => '',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-category a:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_meta', [
            'label'     => esc_html__( 'Meta', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_meta' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'meta_width', [
            'label'     => esc_html__( 'Width(px)', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 220,
            'max' => 1200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin!' => 'folio',
        ],
        ] );
        $this->start_controls_tabs( 'meta_style_tabs' );
        $this->start_controls_tab( 'meta_style_icon', [
            'label' => __( 'Icon', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'meta_icon_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon svg' => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon'     => 'border-color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'meta_icon_background',
            'label'    => __( 'Background', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'meta_icon_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon',
        ] );
        $this->add_responsive_control( 'meta_icon_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'meta_icon_box_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon',
        ] );
        $this->add_responsive_control( 'meta_icon_size', [
            'label'     => esc_html__( 'Size', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'meta_icon_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'meta_style_text', [
            'label' => __( 'Text', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'meta_text_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-text *' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'meta_text_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-ps-meta .bdt-meta-text *',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_featured_post', [
            'label'     => esc_html__( 'Featured Post (Thumbs)', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_featured_post' => 'yes',
            '_skin'              => 'zinest',
        ],
        ] );
        $this->start_controls_tabs( 'featured_post_tabs' );
        $this->start_controls_tab( 'featured_post_normal', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'glassmorphism_effect', [
            'label'       => esc_html__( 'Glassmorphism', 'bdthemes-element-pack' ) . BDTPS_NC . BDTPS_PC,
            'type'        => Controls_Manager::SWITCHER,
            'description' => sprintf( __( 'This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'bdthemes-element-pack' ), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>' ),
        ] );
        $this->add_control( 'glassmorphism_blur_level', [
            'label'     => __( 'Blur Level', 'bdthemes-element-pack' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min'  => 0,
            'step' => 1,
            'max'  => 50,
        ],
        ],
            'default'   => [
            'size' => 5,
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-blog-featured' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
        ],
            'condition' => [
            'glassmorphism_effect' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'featured_post_background_color',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-blog-featured',
        ] );
        $this->add_control( 'featured_post_title_heading', [
            'label'     => __( 'Title', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'featured_post_title_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured .bdt-ps-content .bdt-ps-title a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'featured_post_title_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured .bdt-ps-content .bdt-ps-title a',
        ] );
        $this->add_responsive_control( 'featured_post_title_spacing', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured .bdt-ps-content .bdt-ps-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
        ],
        ] );
        $this->add_control( 'featured_post_text_heading', [
            'label'     => __( 'Text', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );
        $this->add_control( 'featured_post_text_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured .bdt-ps-content .bdt-ps-desc *' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'featured_post_text_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'selector' => '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured .bdt-ps-content .bdt-ps-desc *',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'featured_post_hover', [
            'label' => __( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'featured_post_background_hover_color',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-blog-featured:hover',
        ] );
        $this->add_control( 'featured_post_title__hover_color', [
            'label'     => __( 'Title Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured:hover .bdt-ps-content .bdt-ps-title a' => 'color: {{VALUE}}',
        ],
        ] );
        $this->add_control( 'featured_post_text_hover_color', [
            'label'     => __( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-ps-featured:hover .bdt-ps-content .bdt-ps-desc *' => 'color: {{VALUE}}',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_admin_meta', [
            'label'     => esc_html__( 'Admin Meta', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            'show_admin_info' => 'yes',
            '_skin'           => 'folio',
        ],
        ] );
        $this->add_control( 'admin_meta_title_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-folio .bdt-prime-slider-meta *' => 'color: {{VALUE}}',
        ],
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_navigation', [
            'label'     => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            '_skin!' => [ 'folio' ],
        ],
        ] );
        $this->start_controls_tabs( 'tabs_navigation_style' );
        $this->start_controls_tab( 'tab_navigation_arrows_style', [
            'label' => __( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'arrows_color', [
            'label'     => __( 'Arrows Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next svg' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'           => 'arrows_background',
            'label'          => __( 'Background', 'bdthemes-prime-slider' ),
            'types'          => [ 'classic', 'gradient' ],
            'selector'       => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
            'condition'      => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
            'fields_options' => [
            'background' => [
            'label' => esc_html__( 'Background Type', 'bdthemes-prime-slider' ) . BDTPS_PC,
        ],
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'arrows_border',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_responsive_control( 'arrows_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'active_dot_color', [
            'label'     => __( 'Active Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li.bdt-active a'        => 'border-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li.bdt-active a:after'  => 'border-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li.bdt-active a:before' => 'background-color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin!'               => 'zinest',
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'dot_number_color', [
            'label'     => __( 'Dot Number Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-coral .bdt-ps-dotnav span, {{WRAPPER}} .bdt-prime-slider-skin-coral .bdt-ps-dotnav li a' => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider-skin-coral .bdt-ps-dotnav span:before'                                                        => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin'                => 'coral',
        ],
        ] );
        $this->add_control( 'active_dot_number_color', [
            'label'     => __( 'Active Number Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-counter:after' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin!'               => 'zinest',
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover svg' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'arrows_hover_background',
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '
                    {{WRAPPER}} .bdt-prime-slider-skin-blog .bdt-slidenav::before,
                    {{WRAPPER}} .bdt-prime-slider-skin-zinest .bdt-slidenav::before,
                    {{WRAPPER}} .bdt-prime-slider-skin-coral .bdt-slidenav::before',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'arrows_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'arrows_border_border!'  => '',
            'show_navigation_arrows' => [ 'yes' ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section( 'section_style_addition', [
            'label'     => __( 'Additional', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
            '_skin' => 'folio',
        ],
        ] );
        $this->add_control( 'meta_content_heading', [
            'label' => __( 'Meta Content', 'bdthemes-prime-slider' ),
            'type'  => Controls_Manager::HEADING,
        ] );
        $this->add_control( 'folio_glassmorphism_effect', [
            'label'       => esc_html__( 'Glassmorphism', 'bdthemes-element-pack' ) . BDTPS_NC . BDTPS_PC,
            'type'        => Controls_Manager::SWITCHER,
            'description' => sprintf( __( 'This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'bdthemes-element-pack' ), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>' ),
        ] );
        $this->add_control( 'folio_glassmorphism_blur_level', [
            'label'     => __( 'Blur Level', 'bdthemes-element-pack' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min'  => 0,
            'step' => 1,
            'max'  => 50,
        ],
        ],
            'default'   => [
            'size' => 5,
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-folio .bdt-ps-meta-content' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
        ],
            'condition' => [
            'folio_glassmorphism_effect' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'meta_content_background',
            'selector' => '{{WRAPPER}} .bdt-prime-slider-skin-folio .bdt-ps-meta-content',
        ] );
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
    
    public function adv_anim()
    {
        $settings = $this->get_settings_for_display();
        $animation_of = ( isset( $settings['animation_of'] ) ? implode( ", ", $settings['animation_of'] ) : '.bdt-image-expand-sub-title' );
        $animation_of = ( strlen( $animation_of ) > 0 ? $animation_of : '.bdt-image-expand-sub-title' );
        $animation_status = 'no';
        
        if ( $animation_status == 'yes' ) {
            $this->add_render_attribute( [
                'slideshow' => [
                'data-settings' => [ wp_json_encode( [
                "id"                    => "#bdt-" . $this->get_id(),
                'animation_status'      => $animation_status,
                'animation_of'          => $animation_of,
                'animation_on'          => $settings['animation_on'],
                'anim_perspective'      => ( $settings['anim_perspective']['size'] ? $settings['anim_perspective']['size'] : 400 ),
                'anim_duration'         => ( $settings['anim_duration']['size'] ? $settings['anim_duration']['size'] : 0.1 ),
                'anim_scale'            => ( $settings['anim_scale']['size'] ? $settings['anim_scale']['size'] : 0 ),
                'anim_rotation_y'       => ( $settings['anim_rotationY']['size'] ? $settings['anim_rotationY']['size'] : 80 ),
                'anim_rotation_x'       => ( $settings['anim_rotationX']['size'] ? $settings['anim_rotationX']['size'] : 180 ),
                'anim_transform_origin' => ( $settings['anim_transform_origin'] ? $settings['anim_transform_origin'] : '0% 50% -50' ),
            ] ) ],
            ],
            ] );
        } else {
            $this->add_render_attribute( [
                'slideshow' => [
                'data-settings' => [ wp_json_encode( [
                "id"               => "#bdt-" . $this->get_id(),
                'animation_status' => $animation_status,
            ] ) ],
            ],
            ] );
        }
    
    }
    
    public function render_header( $skin_name = 'blog' )
    {
        $settings = $this->get_settings_for_display();
        //function call
        $this->adv_anim();
        $this->add_render_attribute( 'slideshow', 'id', 'bdt-' . $this->get_id() );
        $this->add_render_attribute( 'slider', 'class', 'bdt-prime-slider-skin-' . $skin_name );
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
            'animation'         => 'fade',
            'ratio'             => $ratio,
            'min-height'        => ( !empty($settings['slider_min_height']['size']) && $ratio !== false ? $settings['slider_min_height']['size'] : (( $ratio !== false ? 440 : false )) ),
            'autoplay'          => ( $settings['autoplay'] ? true : false ),
            'autoplay-interval' => $settings['autoplay_interval'],
            'pause-on-hover'    => ( 'yes' === $settings['pause_on_hover'] ? true : false ),
            'velocity'          => ( $settings['velocity']['size'] ? $settings['velocity']['size'] : 1 ),
            'finite'            => ( $settings['finite'] ? false : true ),
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
    
    public function render_navigation_arrows()
    {
        $settings = $this->get_settings_for_display();
        ?>

                        <?php 
        if ( $settings['show_navigation_arrows'] ) {
            ?>
                            <div class="bdt-navigation-arrows bdt-position-bottom-left reveal-muted">
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

                            <ul class="bdt-slideshow-nav bdt-dotnav bdt-position-top-right reveal-muted"></ul>

                        <?php 
        }
        ?>

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
                <?php 
        $this->render_scroll_button();
        ?>
            </div>
        </div>
    <?php 
    }
    
    public function render_social_link( $position = 'left', $label = false, $class = array() )
    {
        $settings = $this->get_active_settings();
        if ( '' == $settings['show_social_icon'] ) {
            return;
        }
        $this->add_render_attribute( 'social-icon', 'class', 'bdt-prime-slider-social-icon reveal-muted' );
        $this->add_render_attribute( 'social-icon', 'class', $class );
        ?>

        <div <?php 
        $this->print_render_attribute_string( 'social-icon' );
        ?>>

            <?php 
        
        if ( $label ) {
            ?>
                <h3><?php 
            esc_html_e( 'Follow Us', 'bdthemes-prime-slider' );
            ?></h3>
            <?php 
        }
        
        ?>

            <?php 
        foreach ( $settings['social_link_list'] as $link ) {
            $tooltip = ( 'yes' == $settings['social_icon_tooltip'] ? ' title="' . esc_attr( $link['social_link_title'] ) . '" bdt-tooltip="pos: ' . $position . '"' : '' );
            ?>

                <a href="<?php 
            echo  esc_url( $link['social_link'] ) ;
            ?>" target="_blank" <?php 
            echo  wp_kses_post( $tooltip ) ;
            ?>>
                    <?php 
            Icons_Manager::render_icon( $link['social_icon'], [
                'aria-hidden' => 'true',
                'class'       => 'fa-fw',
            ] );
            ?>
                </a>
            <?php 
        }
        ?>
        </div>

    <?php 
    }
    
    public function render_scroll_button_text()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'content-wrapper', 'class', 'bdt-scroll-down-content-wrapper' );
        $this->add_render_attribute( 'text', 'class', 'bdt-scroll-down-text' );
        ?>
        <span bdt-scrollspy="cls: bdt-animation-slide-right; repeat: true" <?php 
        $this->print_render_attribute_string( 'content-wrapper' );
        ?>>
            <span class="bdt-scroll-icon">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                    <g>
                        <g>
                            <polygon points="31,0 31,60.586 23.707,53.293 22.293,54.854 31.293,64 32.707,64 41.707,54.854 40.293,53.366 33,60.586 33,0 " />
                        </g>
                    </g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                </svg>

            </span>
            <span <?php 
        $this->print_render_attribute_string( 'text' );
        ?>><?php 
        echo  esc_html( $settings['scroll_button_text'] ) ;
        ?></span>
        </span>
    <?php 
    }
    
    public function render_scroll_button()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'bdt-scroll-down', 'class', [ 'bdt-scroll-down reveal-muted' ] );
        if ( '' == $settings['show_scroll_button'] ) {
            return;
        }
        $this->add_render_attribute( [
            'bdt-scroll-down' => [
            'data-settings' => [ wp_json_encode( array_filter( [
            'duration' => ( '' != $settings['duration']['size'] ? $settings['duration']['size'] : '' ),
            'offset'   => ( '' != $settings['offset']['size'] ? $settings['offset']['size'] : '' ),
        ] ) ) ],
        ],
        ] );
        $this->add_render_attribute( 'bdt-scroll-down', 'data-selector', '#' . esc_attr( $settings['section_id'] ) );
        $this->add_render_attribute( 'bdt-scroll-wrapper', 'class', 'bdt-scroll-down-wrapper' );
        ?>
        <div <?php 
        $this->print_render_attribute_string( 'bdt-scroll-wrapper' );
        ?>>
            <button <?php 
        $this->print_render_attribute_string( 'bdt-scroll-down' );
        ?>>
                <?php 
        $this->render_scroll_button_text();
        ?>
            </button>
        </div>

    <?php 
    }
    
    public function render_button( $post )
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
            'href',
            esc_url( get_permalink( $post->ID ) ),
            true
        );
        ?>

        <?php 
        
        if ( 'yes' == $settings['show_button_text'] ) {
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
            echo  esc_html( $settings['button_text'] ) ;
            ?><span class="bdt-slide-btn-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-right">
                                <polyline fill="none" stroke="#000" points="10 5 15 9.5 10 14"></polyline>
                                <line fill="none" stroke="#000" x1="4" y1="9.5" x2="15" y2="9.5"></line>
                            </svg></span></span>

                </span>


            </a>
        <?php 
        }
    
    }
    
    public function render_excerpt()
    {
        if ( !$this->get_settings( 'show_excerpt' ) ) {
            return;
        }
        $strip_shortcode = $this->get_settings_for_display( 'strip_shortcode' );
        ?>
        <div class="bdt-blog-text" data-reveal="reveal-active">
            <?php 
        
        if ( has_excerpt() ) {
            the_excerpt();
        } else {
            echo  prime_slider_custom_excerpt( $this->get_settings_for_display( 'excerpt_length' ), $strip_shortcode ) ;
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
        <div class="bdt-ps-category" data-reveal="reveal-active">
            <?php 
        echo  get_the_category_list( ', ' ) ;
        ?>
        </div>
    <?php 
    }
    
    public function render_meta()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <?php 
        
        if ( 'yes' == $settings['show_meta'] ) {
            ?>
            <div class="bdt-ps-meta" data-reveal="reveal-active">
                <div class="bdt-child-width-1-1 bdt-child-width-1-3@s bdt-grid-collapse" bdt-grid>
                    <?php 
            
            if ( 'yes' == $settings['show_author'] ) {
                ?>
                        <div class="bdt-ps-meta-item bdt-flex bdt-flex-middle" data-bdt-slideshow-parallax="y: 110,0,-110; opacity: 1,1,0">
                            <div class="bdt-meta-icon">
                                <?php 
                echo  get_avatar( get_the_author_meta( 'ID' ), 48 ) ;
                ?>
                            </div>
                            <div class="bdt-meta-text">
                                <span class="bdt-author bdt-text-capitalize">
                                    <strong><?php 
                esc_html_e( 'Written by', 'bdthemes-prime-slider' );
                ?></strong>
                                    <a href="<?php 
                echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ;
                ?>"><?php 
                echo  esc_attr( get_the_author() ) ;
                ?></a>
                                </span>
                            </div>
                        </div>
                    <?php 
            }
            
            ?>

                    <?php 
            
            if ( 'yes' == $settings['show_date'] ) {
                ?>
                        <div class="bdt-ps-meta-item bdt-flex bdt-flex-middle bdt-visible@s" data-bdt-slideshow-parallax="y: 140,0,-140; opacity: 1,1,0">
                            <div class="bdt-meta-icon">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-day" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-calendar-day fa-w-14 fa-2x">
                                    <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-96zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z" class=""></path>
                                </svg>
                            </div>
                            <div class="bdt-meta-text">
                                <span>
                                    <strong><?php 
                esc_html_e( 'Published on', 'bdthemes-prime-slider' );
                ?></strong>
                                    <?php 
                echo  get_the_date() ;
                ?>
                                </span>
                            </div>
                        </div>
                    <?php 
            }
            
            ?>

                    <?php 
            
            if ( 'yes' == $settings['show_comments'] ) {
                ?>
                        <div class="bdt-ps-meta-item bdt-flex bdt-flex-middle bdt-visible@s" data-bdt-slideshow-parallax="y: 170,0,-170; opacity: 1,1,0">
                            <div class="bdt-meta-icon">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-comment fa-w-16 fa-2x">
                                    <path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z" class=""></path>
                                </svg>
                            </div>
                            <div class="bdt-meta-text">
                                <span>
                                    <strong><?php 
                esc_html_e( 'Comments By', 'bdthemes-prime-slider' );
                ?></strong>
                                    <?php 
                echo  get_comments_number() ;
                ?>
                                </span>
                            </div>
                        </div>
                    <?php 
            }
            
            ?>

                </div>
            </div>
        <?php 
        }
        
        ?>
    <?php 
    }
    
    public function render_item_content( $post, $slide_index )
    {
        $settings = $this->get_settings_for_display();
        $parallax_title = 'data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0"';
        $parallax_text = 'data-bdt-slideshow-parallax="y: 50,0,-10; opacity: 1,1,0"';
        ?>
        <div class="bdt-ps-blog-container">
            <div class="bdt-slideshow-content-wrapper">
                <div class="bdt-prime-slider-wrapper">
                    <div class="bdt-prime-slider-content">
                        <div class="bdt-prime-slider-desc bdt-grid bdt-grid-collapse">

                            <div class="bdt-width-1-1 bdt-width-3-5@m">

                                <?php 
        
        if ( 'yes' == $settings['show_category'] ) {
            ?>
                                    <div data-bdt-slideshow-parallax="y: 80,0,-80; opacity: 1,1,0">
                                        <?php 
            $this->render_category();
            ?>
                                    </div>
                                <?php 
        }
        
        ?>

                                <?php 
        
        if ( 'yes' == $settings['show_title'] ) {
            ?>
                                    <div class="bdt-main-title" data-reveal="reveal-active">
                                        <<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-title-tag" <?php 
            echo  $parallax_title ;
            ?>>

                                            <a href="<?php 
            echo  esc_url( get_permalink( $post->ID ) ) ;
            ?>">
                                                <?php 
            echo  prime_slider_first_word( get_the_title() ) ;
            ?>
                                            </a>

                                        </<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?>>
                                    </div>
                                <?php 
        }
        
        ?>

                                <?php 
        $this->render_meta();
        ?>

                                <div class="bdt-ps-blog-btn" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0">
                                    <?php 
        $this->render_button( $post );
        ?>
                                </div>
                            </div>

                            <div class="bdt-width-1-1 bdt-width-2-5@m bdt-visible@m">
                                <?php 
        
        if ( 'yes' == $settings['show_excerpt'] ) {
            ?>
                                    <div class="bdt-slider-excerpt" <?php 
            echo  $parallax_text ;
            ?>>

                                        <div class="bdt-slide-counter" data-label="<?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?>">
                                            <?php 
            $this->render_excerpt();
            ?>
                                        </div>

                                    </div>
                                <?php 
        }
        
        ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
    }
    
    public function render_slides_loop()
    {
        $settings = $this->get_settings_for_display();
        $kenburns_reverse = ( $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '' );
        $slide_index = 1;
        global  $post ;
        $wp_query = $this->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
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

            <li class="bdt-slideshow-item bdt-flex bdt-flex-middle bdt-flex-center elementor-repeater-item-<?php 
            echo  get_the_ID() ;
            ?>">

                <div class="bdt-ps-blog-bg" style="background-image: url('<?php 
            echo  esc_url( $image_final_src ) ;
            ?>')">

                </div>

                <?php 
            
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
                    <div class="bdt-position-cover bdt-animation-kenburns<?php 
                echo  esc_attr( $kenburns_reverse ) ;
                ?> bdt-transform-origin-center-left">
                    <?php 
            }
            
            ?>

                    <div class="bdt-ps-blog-main-img bdt-ps-slide-img" style="background-image: url('<?php 
            echo  esc_url( $image_src ) ;
            ?>')">

                    </div>

                    <?php 
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
                    </div>
                <?php 
            }
            ?>

                <?php 
            
            if ( 'none' !== $settings['overlay'] ) {
                $blend_type = ( 'blend' == $settings['overlay'] ? ' bdt-blend-' . $settings['blend_type'] : '' );
                ?>
                    <div class="bdt-overlay-default bdt-position-cover<?php 
                echo  esc_attr( $blend_type ) ;
                ?>"></div>
                <?php 
            }
            
            ?>

                <?php 
            $this->render_item_content( $post, $slide_index );
            ?>

                <?php 
            $slide_index++;
            ?>

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