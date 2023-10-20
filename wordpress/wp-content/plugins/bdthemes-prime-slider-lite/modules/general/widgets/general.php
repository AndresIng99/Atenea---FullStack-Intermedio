<?php

namespace PrimeSlider\Modules\General\Widgets;

use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Typography ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Box_Shadow ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Text_Shadow ;
use  Elementor\Group_Control_Text_Stroke ;
use  PrimeSlider\Utils ;
use  Elementor\Repeater ;
use  Elementor\Icons_Manager ;
use  PrimeSlider\Prime_Slider_Loader ;
use  PrimeSlider\Traits\Global_Widget_Controls ;
use  PrimeSlider\Modules\General\Skins ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class General extends Widget_Base
{
    use  Global_Widget_Controls ;
    public function get_name()
    {
        return 'prime-slider-general';
    }
    
    public function get_title()
    {
        return BDTPS . esc_html__( 'General', 'bdthemes-prime-slider' );
    }
    
    public function get_icon()
    {
        return 'bdt-widget-icon ps-wi-general';
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
            'general',
            'prime'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'ps-general' ];
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
        return 'https://youtu.be/VMBuGusjvtM';
    }
    
    public function register_skins()
    {
        $this->add_skin( new Skins\Skin_Slide( $this ) );
        $this->add_skin( new Skins\Skin_Crelly( $this ) );
        $this->add_skin( new Skins\Skin_Meteor( $this ) );
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
        $this->add_responsive_control( 'content_max_width', [
            'label'      => esc_html__( 'Content Max Width', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', '%' ],
            'range'      => [
            'px' => [
            'min' => 100,
            'max' => 1600,
        ],
            '%'  => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'classes'    => BDTPS_IS_PC,
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-content *' => 'text-align: {{VALUE}} !important;',
        ],
        ] );
        $this->add_control( 'hr', [
            'type' => Controls_Manager::DIVIDER,
        ] );
        $this->add_control( 'show_sub_title', [
            'label'   => esc_html__( 'Show Sub Title', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_title', [
            'label'   => esc_html__( 'Show Title', 'bdthemes-prime-slider' ),
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
        $this->add_control( 'show_button_text', [
            'label'   => esc_html__( 'Show Button', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        // show button icon control
        $this->add_control( 'show_button_icon', [
            'label'     => esc_html__( 'Show Button Icon', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            'show_button_text' => 'yes',
        ],
        ] );
        $this->add_control( 'show_excerpt', [
            'label'   => esc_html__( 'Show Excerpt', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ] );
        $this->add_control( 'show_otherview', [
            'label'     => esc_html__( 'Show Otherview Text', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin' => [ 'crelly' ],
        ],
        ] );
        $this->add_control( 'alter_btn_excerpt', [
            'label'     => esc_html__( 'Alter Button and Excerpt', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            '_skin' => '',
        ],
        ] );
        $this->add_control( 'show_share_us', [
            'label'     => esc_html__( 'Show Share Us', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin' => [ 'crelly' ],
        ],
        ] );
        $this->add_control( 'show_social_icon', [
            'label'     => esc_html__( 'Show Social Icon', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'condition' => [
            '_skin!' => [ 'slide' ],
        ],
        ] );
        $this->add_control( 'show_scroll_button', [
            'label'   => esc_html__( 'Show Scroll Button', 'bdthemes-prime-slider' ),
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
        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name'         => 'thumbnail_size',
            'label'        => esc_html__( 'Image Size', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'exclude'      => [ 'custom' ],
            'default'      => 'full',
            'prefix_class' => 'bdt-prime-slider-thumbnail-size-',
            'separator'    => 'before',
        ] );
        //Global background settings Controls
        $this->register_background_settings( '.bdt-prime-slider .bdt-slideshow-item .bdt-ps-slide-img' );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_sliders', [
            'label' => esc_html__( 'Sliders', 'bdthemes-prime-slider' ),
        ] );
        $repeater = new Repeater();
        $repeater->start_controls_tabs( 'tabs_slider_items' );
        $repeater->start_controls_tab( 'tab_slider_content', [
            'label' => esc_html__( 'Content', 'bdthemes-prime-slider' ),
        ] );
        $repeater->add_control( 'sub_title', [
            'label'       => esc_html__( 'Sub Title', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__( 'Explore', 'bdthemes-prime-slider' ),
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
        $repeater->add_control( 'slide_button_text', [
            'label'       => esc_html__( 'Button Text', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__( 'Details', 'bdthemes-prime-slider' ),
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'button_link', [
            'label'     => esc_html__( 'Button Link', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::URL,
            'dynamic'   => [
            'active' => true,
        ],
            'condition' => [
            'slide_button_text!' => '',
        ],
        ] );
        $repeater->add_control( 'background', [
            'label'   => esc_html__( 'Background', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::CHOOSE,
            'default' => 'color',
            'toggle'  => false,
            'options' => [
            'color'   => [
            'title' => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-paint-brush',
        ],
            'image'   => [
            'title' => esc_html__( 'Image', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-image',
        ],
            'video'   => [
            'title' => esc_html__( 'Video', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-play',
        ],
            'youtube' => [
            'title' => esc_html__( 'Youtube', 'bdthemes-prime-slider' ),
            'icon'  => 'eicon-youtube',
        ],
        ],
        ] );
        $repeater->add_control( 'color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#193d4c',
            'condition' => [
            'background' => 'color',
        ],
            'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
        ],
        ] );
        $repeater->add_control( 'image', [
            'label'     => esc_html__( 'Image', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::MEDIA,
            'default'   => [
            'url' => Utils::get_placeholder_image_src(),
        ],
            'condition' => [
            'background' => 'image',
        ],
            'dynamic'   => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'video_link', [
            'label'     => esc_html__( 'Video Link', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::TEXT,
            'condition' => [
            'background' => 'video',
        ],
            'default'   => '//clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',
            'dynamic'   => [
            'active' => true,
        ],
        ] );
        $repeater->add_control( 'youtube_link', [
            'label'     => esc_html__( 'Youtube Link', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::TEXT,
            'condition' => [
            'background' => 'youtube',
        ],
            'default'   => 'https://youtu.be/YE7VzlLtp-4',
            'dynamic'   => [
            'active' => true,
        ],
        ] );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab( 'tab_slider_Optional', [
            'label' => esc_html__( 'Optional', 'bdthemes-prime-slider' ),
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
        $repeater->add_control( 'excerpt', [
            'label'       => esc_html__( 'Excerpt', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::WYSIWYG,
            'default'     => esc_html__( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore et quasi architecto beatae vitae dicta sunt explicabo.', 'bdthemes-prime-slider' ),
            'label_block' => true,
            'dynamic'     => [
            'active' => true,
        ],
        ] );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();
        $this->add_control( 'slides', [
            'label'       => esc_html__( 'Slider Items', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [ [
            'title' => esc_html__( 'Massive', 'bdthemes-prime-slider' ),
        ], [
            'title' => esc_html__( 'Vibrant', 'bdthemes-prime-slider' ),
        ], [
            'title' => esc_html__( 'Wallow', 'bdthemes-prime-slider' ),
        ] ],
            'title_field' => '{{{ title }}}',
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'section_content_social_link', [
            'label'     => __( 'Social Icon', 'bdthemes-prime-slider' ),
            'condition' => [
            'show_social_icon' => 'yes',
            '_skin!'           => [ 'slide' ],
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
        $repeater->add_control( 'social_icon', [
            'label'   => __( 'Choose Icon', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::ICONS,
            'default' => [
            'value'   => 'fab fa-facebook-f',
            'library' => 'fa-brands',
        ],
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
            '_skin!'             => [ 'slide', 'crelly' ],
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
        $this->add_control( 'slider_animations', [
            'label'     => esc_html__( 'Slider Animations', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SELECT,
            'separator' => 'before',
            'default'   => 'fade',
            'options'   => [
            'slide' => esc_html__( 'Slide', 'bdthemes-prime-slider' ),
            'fade'  => esc_html__( 'Fade', 'bdthemes-prime-slider' ),
            'scale' => esc_html__( 'Scale', 'bdthemes-prime-slider' ),
            'push'  => esc_html__( 'Push', 'bdthemes-prime-slider' ),
            'pull'  => esc_html__( 'Pull', 'bdthemes-prime-slider' ),
        ],
            'condition' => [
            '_skin!' => 'slide',
        ],
        ] );
        $this->add_control( 'animation_parallax', [
            'label'     => esc_html__( 'Parallax Animation', 'bdthemes-element-pack' ) . BDTPS_NC,
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'yes',
            'separator' => 'before',
            'condition' => [
            'animation_status' => '',
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
         * Reveal Effects
         */
        if ( 'on' === $reveal_effects ) {
            $this->register_reveal_effects();
        }
        /**
         * Advanced Animation
         */
        $this->start_controls_section( 'section_advanced_animation', [
            'label' => esc_html__( 'Advanced Animation', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->add_control( 'animation_status', [
            'label'   => esc_html__( 'Advanced Animation', 'bdthemes-element-pack' ),
            'type'    => Controls_Manager::SWITCHER,
            'classes' => BDTPS_IS_PC,
        ] );
        $this->end_controls_section();
        //Style
        $this->start_controls_section( 'section_style_sliders', [
            'label' => esc_html__( 'Sliders', 'bdthemes-prime-slider' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'overlay', [
            'label'   => esc_html__( 'Overlay', 'bdthemes-prime-slider' ) . BDTPS_PC,
            'type'    => Controls_Manager::SELECT,
            'default' => 'none',
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
        $this->add_control( 'overlay_divider', [
            'type' => Controls_Manager::DIVIDER,
        ] );
        $this->add_control( 'shape_background_color', [
            'label'     => __( 'Shape Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-shape' => 'background: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => 'slide',
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
            'label'      => esc_html__( 'Title Width', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range'      => [
            'px' => [
            'min' => 220,
            'max' => 1200,
        ],
            '%'  => [
            'min' => 10,
            'max' => 100,
        ],
        ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'condition'  => [
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'color: {{VALUE}};',
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
            'label' => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ) . BDTPS_NC,
        ],
        ],
            'condition'      => [
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'show_title' => [ 'yes' ],
        ],
        ] );
        $this->add_control( 'title_advanced_style', [
            'label'     => esc_html__( 'Advanced Style', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SWITCHER,
            'condition' => [
            'animation_status' => '',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'title_background',
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'condition' => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
        ],
        ] );
        $this->add_group_control( Group_Control_Text_Shadow::get_type(), [
            'name'      => 'title_text_shadow',
            'label'     => __( 'Text Shadow', 'bdthemes-prime-slider' ),
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'condition' => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'title_border',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'condition' => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
        ],
        ] );
        $this->add_responsive_control( 'title_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'      => 'title_box_shadow',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag',
            'condition' => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
        ],
        ] );
        $this->add_responsive_control( 'title_text_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-desc .bdt-main-title .bdt-title-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'title_advanced_style' => 'yes',
            'animation_status'     => '',
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
        $this->add_control( 'excerpt_title_color', [
            'label'     => esc_html__( 'Title Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt-content h3' => 'color: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => [ 'crelly' ],
        ],
        ] );
        $this->add_responsive_control( 'excerpt_title_spacing', [
            'label'     => esc_html__( 'Top Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 200,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-slider-excerpt-content' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin' => [ 'crelly' ],
        ],
        ] );
        $this->add_control( 'excerpt_background_color', [
            'label'     => esc_html__( 'Primary Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-prime-slider-footer-content .bdt-social-background, {{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-featured' => 'background-color: {{VALUE}}',
        ],
            'condition' => [
            '_skin' => [ 'meteor', 'slide' ],
        ],
        ] );
        $this->add_control( 'excerpt_style_color', [
            'label'     => esc_html__( 'Style Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-slider-excerpt:before' => 'background: {{VALUE}}',
        ],
            'condition' => [
            '_skin' => 'crelly',
        ],
        ] );
        $this->add_control( 'excerpt_style_border_color', [
            'label'     => esc_html__( 'Line Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-slide-featured .bdt-slider-excerpt' => 'border-color: {{VALUE}}',
        ],
            'condition' => [
            '_skin' => 'slide',
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
            'max' => 1200,
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-slider-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            'label'     => esc_html__( 'NORMAL', 'bdthemes-prime-slider' ),
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
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'slide_button_background_color',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-slide-btn:before',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'slide_button_border',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_responsive_control( 'slide_button_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_text_padding', [
            'label'      => __( 'Padding', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_margin', [
            'label'      => __( 'Margin', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'slide_button_box_shadow',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'slide_button_typography',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn',
        ] );
        $this->add_control( 'icon_custom_style', [
            'label' => esc_html__( 'Icon Custom Style', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'  => Controls_Manager::SWITCHER,
        ] );
        $this->add_control( 'hr1', [
            'type'      => Controls_Manager::DIVIDER,
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_control( 'icon_custom_heading', [
            'label'     => esc_html__( 'Icon Style', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_control( 'slide_button_icon_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn svg *' => 'stroke: {{VALUE}} !important;',
        ],
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'slide_button_icon_background_color',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon',
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'slide_icon_button_border',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon',
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_icon_border_radius', [
            'label'      => __( 'Border Radius', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
            'condition'  => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'slide_button_icon_size', [
            'label'     => esc_html__( 'Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 10,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'slide_btn_icon_vertical_spacing', [
            'label'     => esc_html__( 'Vertical Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon' => 'bottom: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_responsive_control( 'slide_btn_icon_horizontal_spacing', [
            'label'     => esc_html__( 'Horizontal Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon' => 'right: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'      => 'slide_button_icon_box_shadow',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn .bdt-slide-btn-icon',
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_control( 'slider_button_style_hover', [
            'label'     => esc_html__( 'HOVER', 'bdthemes-prime-slider' ),
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
        $this->add_control( 'slide_button_custom_bg_color', [
            'label'     => __( 'Custom Background', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-slide-btn:before' => 'background: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => 'crelly',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'slide_button_background_hover_color',
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover',
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
        $this->add_control( 'hr2', [
            'type' => Controls_Manager::DIVIDER,
        ] );
        $this->add_control( 'slider_button_icon_heading_hover', [
            'label'     => esc_html__( 'Icon Style', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_control( 'slide_button_icon_hover_color', [
            'label'     => __( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover svg *' => 'stroke: {{VALUE}} !important;',
        ],
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'slide_button_icon_background_hover_color',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover .bdt-slide-btn-icon',
            'condition' => [
            'icon_custom_style' => 'yes',
        ],
        ] );
        $this->add_control( 'slide_button_icon_hover_border_color', [
            'label'     => __( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'slide_icon_button_border_border!' => '',
            'icon_custom_style'                => 'yes',
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slide-btn:hover .bdt-slide-btn-icon' => 'border-color: {{VALUE}};',
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
            '_skin!'           => [ 'slide' ],
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
        $this->add_control( 'social_icon_text_color', [
            'label'     => esc_html__( 'Text Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon h3' => 'color: {{VALUE}};',
        ],
            'condition' => [
            '_skin' => 'crelly',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'social_icon_background',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a',
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
            'label'     => esc_html__( 'Icon Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin!' => [ 'crelly', 'meteor' ],
        ],
        ] );
        $this->add_responsive_control( 'skin_social_icon_spacing', [
            'label'     => esc_html__( 'Icon Space Between', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'max' => 100,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a' => 'margin-left: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin' => [ 'crelly', 'meteor' ],
        ],
        ] );
        $this->add_responsive_control( 'social_icon_left_spacing', [
            'label'     => esc_html__( 'Horizontal Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 300,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon' => 'left: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin' => '',
        ],
        ] );
        $this->add_control( 'social_background_color', [
            'label'     => esc_html__( 'Primary Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-prime-slider-footer-content .bdt-social-bg-color' => 'background-color: {{VALUE}}',
        ],
            'condition' => [
            '_skin' => 'meteor',
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
            'name'      => 'social_icon_hover_background',
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-social-icon a:hover',
            'separator' => 'after',
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
            '_skin!'             => [ 'slide', 'crelly' ],
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
        $this->add_responsive_control( 'scroll_down_spacing', [
            'label'     => esc_html__( 'Horizontal Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 300,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-scroll-down' => 'right: {{SIZE}}{{UNIT}};',
        ],
            'condition' => [
            '_skin' => '',
        ],
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
        //Navigation
        $this->start_controls_section( 'section_style_navigation', [
            'label'      => __( 'Navigation', 'bdthemes-prime-slider' ),
            'tab'        => Controls_Manager::TAB_STYLE,
            'conditions' => [
            'relation' => 'or',
            'terms'    => [ [
            'name'     => 'show_navigation_arrows',
            'operator' => '==',
            'value'    => 'yes',
        ], [
            'name'     => 'show_navigation_dots',
            'operator' => '==',
            'value'    => 'yes',
        ] ],
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
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next svg'       => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:before, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:before' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
            '_skin!'                 => [ 'meteor' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'      => 'arrows_background',
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'types'     => [ 'classic', 'gradient' ],
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
            '_skin!'                 => [ 'meteor' ],
        ],
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'      => 'arrows_border',
            'selector'  => '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous',
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
            '_skin!'                 => [ 'meteor' ],
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
            '_skin!'                 => [ 'meteor' ],
        ],
        ] );
        $this->add_control( 'dot_heading', [
            'label'     => __( 'D O T S', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'dot_color', [
            'label'     => __( 'Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-general .bdt-slideshow-nav li a, {{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-dotnav li a' => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin!'               => [ 'meteor', 'crelly' ],
        ],
        ] );
        $this->add_control( 'active_dot_color', [
            'label'     => __( 'Active Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-slideshow-nav li a:before' => 'border-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-dotnav li.bdt-active a'    => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin!'               => [ 'meteor', 'crelly' ],
        ],
        ] );
        $this->add_control( 'meteor_active_dot_color', [
            'label'     => __( 'Active Dot Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-meteor .bdt-dotnav li.bdt-active a, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-dotnav li.bdt-active a:after' => 'border-color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-dotnav li.bdt-active a:before, {{WRAPPER}} .bdt-prime-slider .bdt-dotnav li a:before'                            => 'background: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin'                => [ 'meteor', 'crelly' ],
        ],
            'separator' => 'before',
        ] );
        $this->add_control( 'active_dot_number_color', [
            'label'     => __( 'Number Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-slide .bdt-dotnav li:after, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-ps-counternav span, {{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-ps-counternav li a' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
            '_skin'                  => [ 'slide', 'crelly' ],
        ],
        ] );
        $this->add_control( 'active_dot_number_color_skin', [
            'label'     => __( 'Active Number Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-crelly .bdt-ps-counternav li.bdt-active a' => 'color: {{VALUE}}',
        ],
            'condition' => [
            'show_navigation_arrows' => [ 'yes' ],
            '_skin'                  => [ 'crelly' ],
        ],
        ] );
        $this->add_responsive_control( 'navigation_dots_spacing', [
            'label'     => __( 'Dots Space Between', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 50,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider-skin-general .bdt-slideshow-nav li' => 'margin-right: {{SIZE}}px;',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin'                => '',
        ],
        ] );
        $this->add_responsive_control( 'navigation_dots_h_spacing', [
            'label'     => __( 'Dots Horizontal Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 300,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slideshow-nav' => 'left: {{SIZE}}px;',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin'                => '',
        ],
        ] );
        $this->add_responsive_control( 'navigation_dots_v_spacing', [
            'label'     => __( 'Dots Vertical Spacing', 'bdthemes-prime-slider' ) . BDTPS_NC,
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
            'px' => [
            'min' => 0,
            'max' => 300,
        ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-slideshow-nav' => 'margin-bottom: {{SIZE}}px;',
        ],
            'condition' => [
            'show_navigation_dots' => [ 'yes' ],
            '_skin'                => '',
        ],
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_navigation_arrows_hover_style', [
            'label'     => __( 'Hover', 'bdthemes-prime-slider' ),
            'condition' => [
            '_skin!' => [ 'meteor' ],
        ],
        ] );
        $this->add_control( 'arrows_hover_color', [
            'label'     => __( 'Arrows Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover svg, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover svg' => 'color: {{VALUE}}',
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:before, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:before'       => 'background: {{VALUE}}',
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
            'condition' => [
            'arrows_border_border!'  => 'none',
            'show_navigation_arrows' => [ 'yes' ],
        ],
            'selectors' => [
            '{{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-next:hover, {{WRAPPER}} .bdt-prime-slider .bdt-prime-slider-previous:hover' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
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
                'id'                    => '#bdt-' . $this->get_id(),
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
                'id'               => '#bdt-' . $this->get_id(),
                'animation_status' => $animation_status,
            ] ) ],
            ],
            ] );
        }
    
    }
    
    public function render_header( $skin_name = 'general' )
    {
        $settings = $this->get_settings_for_display();
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
            "animation"         => $settings["slider_animations"],
            "ratio"             => $ratio,
            'min-height'        => ( !empty($settings['slider_min_height']['size']) && $ratio !== false ? $settings['slider_min_height']['size'] : (( $ratio !== false ? 480 : false )) ),
            "autoplay"          => ( $settings["autoplay"] ? true : false ),
            "autoplay-interval" => $settings["autoplay_interval"],
            "pause-on-hover"    => ( "yes" === $settings["pause_on_hover"] ? true : false ),
            "velocity"          => ( $settings["velocity"]["size"] ? $settings["velocity"]["size"] : 1 ),
            "finite"            => ( $settings["finite"] ? false : true ),
        ] ) ],
        ],
        ] );
        //function call
        $this->adv_anim();
        $this->add_render_attribute( 'slideshow', 'id', 'bdt-' . $this->get_id() );
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
    
    public function render_social_link( $position = 'right', $label = false, $class = array() )
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
				<?php 
            
            if ( '' !== $settings['show_share_us'] ) {
                ?>
					<h3><?php 
                esc_html_e( 'Share Us', 'bdthemes-prime-slider' );
                ?></h3>
				<?php 
            }
            
            ?>
			<?php 
        }
        
        ?>

			<?php 
        foreach ( $settings['social_link_list'] as $link ) {
            $tooltip = ( 'yes' == $settings['social_icon_tooltip'] ? ' title="' . esc_attr( $link['social_link_title'] ) . '" bdt-tooltip="pos: ' . $position . '"' : '' );
            ?>

				<a class="bdt-social-animate" href="<?php 
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
    
    public function render_scroll_button_text( $settings )
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
        echo  wp_kses( $settings['scroll_button_text'], prime_slider_allow_tags( 'title' ) ) ;
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
        $this->render_scroll_button_text( $settings );
        ?>
			</button>
		</div>

	<?php 
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->get_settings_for_display();
        ?>

		<?php 
        
        if ( $settings['show_navigation_arrows'] ) {
            ?>
			<?php 
            $this->add_render_attribute( 'navi_arrow_animate', 'class', 'reveal-muted' );
            ?>
			<div <?php 
            $this->print_render_attribute_string( 'navi_arrow_animate' );
            ?>>
				<a class="bdt-position-bottom-right bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
				<a class="bdt-position-bottom-right bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
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
			<div <?php 
            $this->print_render_attribute_string( 'navi_dots_animate' );
            ?>>
				<ul class="bdt-slideshow-nav bdt-dotnav bdt-margin-large bdt-position-bottom-left bdt-text-center reveal-muted"></ul>
			</div>
		<?php 
        }
        
        ?>

	<?php 
    }
    
    public function rendar_item_image( $item, $alt = '' )
    {
        $settings = $this->get_settings_for_display();
        $image_src = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail_size', $settings );
        
        if ( $image_src ) {
            $image_final_src = $image_src;
        } elseif ( $item['image']['url'] ) {
            $image_final_src = $item['image']['url'];
        } else {
            return;
        }
        
        ?>

		<div class="bdt-ps-slide-img" style="background-image: url('<?php 
        echo  esc_url( $image_final_src ) ;
        ?>')"></div>

	<?php 
    }
    
    public function rendar_item_video( $link )
    {
        $video_src = $link['video_link'];
        ?>
		<video autoplay loop muted playsinline bdt-cover>
			<source src="<?php 
        echo  $video_src ;
        ?>" type="video/mp4">
		</video>
	<?php 
    }
    
    public function rendar_item_youtube( $link )
    {
        $match = [];
        $id = ( preg_match( '%(?:youtube(?:-nocookie)?\\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\\.be/)([^"&?/ ]{11})%i', $link['youtube_link'], $match ) ? $match[1] : false );
        $url = '//www.youtube.com/embed/' . $id . '?autoplay=1&amp;mute=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;playsinline=1&playlist=' . $id;
        ?>
		<iframe src="<?php 
        echo  esc_url( $url ) ;
        ?>" allowfullscreen bdt-cover></iframe>
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
        
        if ( isset( $content['button_link']['url'] ) && !empty($content['button_link']['url']) ) {
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
            } else {
                $this->add_render_attribute(
                    'slider-button',
                    'target',
                    '_self',
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
                'javascript:void(0);',
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
            ?>
						<?php 
            if ( $settings['show_button_icon'] ) {
                ?>
						<span class="bdt-slide-btn-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-right">
								<polyline fill="none" stroke="#000" points="10 5 15 9.5 10 14"></polyline>
								<line fill="none" stroke="#000" x1="4" y1="9.5" x2="15" y2="9.5"></line>
						</svg></span>
						<?php 
            }
            ?>
					</span>

				</span>

			</a>
		<?php 
        }
    
    }
    
    public function render_item_content( $slide_content )
    {
        $settings = $this->get_settings_for_display();
        $parallax_button = $parallax_sub_title = $parallax_title = $parallax_inner_excerpt = $parallax_excerpt = '';
        
        if ( $settings['animation_parallax'] == 'yes' ) {
            $parallax_sub_title = 'data-bdt-slideshow-parallax="x: 50,0,-10; opacity: 1,1,0"';
            $parallax_title = 'data-bdt-slideshow-parallax="x: 100,0,-20; opacity: 1,1,0"';
            $parallax_inner_excerpt = 'data-bdt-slideshow-parallax="x: 120,0,-30; opacity: 1,1,0"';
            $parallax_excerpt = 'data-bdt-slideshow-parallax="y: 50,0,-10; opacity: 1,1,0"';
            $parallax_button = 'data-bdt-slideshow-parallax="x: 150,0,-30; opacity: 1,1,0"';
        }
        
        $this->add_render_attribute( 'slide_content_animate', 'class', 'bdt-prime-slider-content' );
        
        if ( $slide_content['title'] ) {
            $title_link_href = ( isset( $slide_content['title_link']['url'] ) ? esc_url( $slide_content['title_link']['url'] ) : 'javascript:void(0);' );
            $title_link_target = ( $slide_content['title_link']['is_external'] ? '_blank' : '_self' );
            $this->add_render_attribute(
                [
                'title-link' => [
                'class'  => [ 'bdt-slider-title-link' ],
                'href'   => $title_link_href,
                'target' => $title_link_target,
            ],
            ],
                '',
                '',
                true
            );
        }
        
        ?>
		<div class="bdt-position-z-index bdt-position-large">
			<div class="bdt-prime-slider-wrapper">
				<div <?php 
        $this->print_render_attribute_string( 'slide_content_animate' );
        ?>>
					<div class="bdt-prime-slider-desc">

						<?php 
        
        if ( $slide_content['sub_title'] && 'yes' == $settings['show_sub_title'] ) {
            ?>
							<div class="bdt-sub-title">
								<h4 data-reveal="reveal-active" class="bdt-ps-sub-title" <?php 
            echo  $parallax_sub_title ;
            ?>>
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
							<div data-reveal="reveal-active" class="bdt-main-title" <?php 
            echo  $parallax_title ;
            ?>>
								<<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-title-tag">
									<?php 
            
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
										<a <?php 
                $this->print_render_attribute_string( 'title-link' );
                ?>>
										<?php 
            }
            
            ?>
										<?php 
            echo  wp_kses_post( $slide_content['title'] ) ;
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
        
        if ( $slide_content['excerpt'] && 'yes' == $settings['show_excerpt'] && 'yes' == $settings['alter_btn_excerpt'] ) {
            ?>
							<div data-reveal="reveal-active" class="bdt-slider-excerpt" <?php 
            echo  $parallax_inner_excerpt ;
            ?>>
								<?php 
            echo  wp_kses_post( $slide_content['excerpt'] ) ;
            ?>
							</div>
						<?php 
        }
        
        ?>

						<div <?php 
        echo  $parallax_button ;
        ?>>
							<div class="bdt-btn-wrapper">
								<?php 
        $this->render_button( $slide_content );
        ?>
							</div>
						</div>
					</div>

					<?php 
        
        if ( $slide_content['excerpt'] && 'yes' == $settings['show_excerpt'] && '' == $settings['alter_btn_excerpt'] ) {
            ?>
						<div data-reveal="reveal-active" class="bdt-slider-excerpt" <?php 
            echo  $parallax_excerpt ;
            ?>>
							<?php 
            echo  wp_kses_post( $slide_content['excerpt'] ) ;
            ?>
						</div>
					<?php 
        }
        
        ?>

				</div>
			</div>
		</div>
		<?php 
    }
    
    public function render_slides_loop()
    {
        $settings = $this->get_settings_for_display();
        $kenburns_reverse = ( $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '' );
        foreach ( $settings['slides'] as $slide ) {
            ?>

			<li class="bdt-slideshow-item bdt-flex bdt-flex-middle bdt-flex-center elementor-repeater-item-<?php 
            echo  esc_attr( $slide['_id'] ) ;
            ?>">
				<?php 
            
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
					<div class="bdt-position-cover bdt-animation-kenburns<?php 
                echo  esc_attr( $kenburns_reverse ) ;
                ?> bdt-transform-origin-center-left">
					<?php 
            }
            
            ?>

					<?php 
            
            if ( $slide['background'] == 'image' && $slide['image'] ) {
                ?>
						<?php 
                $this->rendar_item_image( $slide, $slide['title'] );
                ?>
					<?php 
            } elseif ( $slide['background'] == 'video' && $slide['video_link'] ) {
                ?>
						<?php 
                $this->rendar_item_video( $slide );
                ?>
					<?php 
            } elseif ( $slide['background'] == 'youtube' && $slide['youtube_link'] ) {
                ?>
						<?php 
                $this->rendar_item_youtube( $slide );
                ?>
					<?php 
            }
            
            ?>

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
            $this->render_item_content( $slide );
            ?>
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