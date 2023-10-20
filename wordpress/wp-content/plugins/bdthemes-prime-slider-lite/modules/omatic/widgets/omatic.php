<?php
namespace PrimeSlider\Modules\Omatic\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Plugin;
use PrimeSlider\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Omatic extends Widget_Base {

	public function get_name() {
		return 'prime-slider-omatic';
	}

	public function get_title() {
		return BDTPS . esc_html__('Omatic', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-omatic bdt-new';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return [ 'prime slider', 'slider', 'omatic', 'prime' ];
	}

	public function get_style_depends() {
		return ['prime-slider-font', 'ps-omatic'];
	}
	public function get_script_depends() {
		return ['ps-omatic'];
	}

	// public function get_custom_help_url() {
	// 	return 'https://youtu.be/pk5kCstNHBY';
	// }

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_sliders',
			[
				'label' => esc_html__('Slider Items', 'bdthemes-prime-slider'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'tabs_items_style' );
		$repeater->start_controls_tab(
			'tab_item_content',
			[
				'label' => esc_html__( 'Content', 'bdthemes-prime-slider' ),
			]
		);

		$repeater->add_control(
			'sub_title',
			[
				'label'       => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'     => esc_html__('Image', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_item_content_optional',
			[
				'label' => esc_html__( 'Optional', 'bdthemes-prime-slider' ),
			]
		);

		$repeater->add_control(
			'title_link',
			[
				'label'         => esc_html__('Title Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => ''],
				'show_external' => false,
				'dynamic'       => ['active' => true],
				'condition'     => [
					'title!' => ''
				]
			]
		);

		$repeater->add_control(
			'text',
			[
				'label'       => esc_html__('Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__('Prime Slider Addons for Elementor is a page builder extension that allows you to build sliders with drag and drop.', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
        );

		$repeater->end_controls_tab();
		
		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label'   => esc_html__('Items', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
						'title'     => esc_html__('Ps Item One', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-1.svg']
					],
					[
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
						'title'     => esc_html__('Ps Item Two', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-4.svg']
					],
					[
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
						'title'     => esc_html__('Ps Item Three', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-5.svg']
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Additional Settings', 'bdthemes-prime-slider'),
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[
				'label' => esc_html__('Slider Height', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1080,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// content vertical spacing
		$this->add_responsive_control(
			'content_vertical_spacing',
			[
				'label' => esc_html__('Content Vertical Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-slide-content' => 'top: {{SIZE}}%;',
				],
			]
		);

		$this->add_control(
			'show_sub_title',
			[
				'label'   => esc_html__('Show Sub Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__('Show Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => prime_slider_title_tags(),
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_text',
			[
				'label'   => esc_html__('Show Text', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'text_hide_on',
			[
				'label'       => __('Text Hide On', 'bdthemes-prime-slider') . BDTPS_NC,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'desktop' => __('Desktop', 'bdthemes-prime-slider'),
					'tablet'  => __('Tablet', 'bdthemes-prime-slider'),
					'mobile'  => __('Mobile', 'bdthemes-prime-slider'),
				],
				'frontend_available' => true,
				'condition' => [
					'show_text' => 'yes'
				]
			]
		);


		$this->add_control(
			'show_navigation_arrows',
			[
				'label'   => esc_html__('Show Arrows', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail_size',
				'label'   => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
				'exclude' => [ 'custom' ],
				'default' => 'full',
				'separator' => 'before',
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_settings',
			[
				'label' => __('Slider Settings', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label'   => __( 'Grab Cursor', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __( 'Loop', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'speed',
			[
				'label'   => __( 'Animation Speed (ms)', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 900,
				],
				'range' => [
					'min'  => 100,
					'max'  => 5000,
					'step' => 50,
				],
			]
		);

		$this->add_control(
			'observer',
			[
				'label'       => __( 'Observer', 'bdthemes-prime-slider' ),
				'description' => __( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'bdthemes-prime-slider' ),
				'type'        => Controls_Manager::SWITCHER,				
			]
		);

		$this->end_controls_section();
	
		// style

		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__('Image', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_type',
			[
				'label'   => esc_html__( 'Overlay', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => esc_html__( 'None', 'bdthemes-prime-slider' ),
					'background' => esc_html__( 'Background', 'bdthemes-prime-slider' ),
					'blend'      => esc_html__( 'Blend', 'bdthemes-prime-slider' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_color',
				'label' => esc_html__( 'Background', 'bdthemes-prime-slider' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap::before',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
				'condition' => [
					'overlay_type' => ['background', 'blend'],
				],
			]
		);

		$this->add_control(
			'blend_type',
			[
				'label'     => esc_html__( 'Blend Type', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => prime_slider_blend_options(),
				'condition' => [
					'overlay_type' => 'blend',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap::before' => 'mix-blend-mode: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'glassmorphism_effect',
			[
				'label' => esc_html__('Glassmorphism', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SWITCHER,
				'description' => sprintf(esc_html__('This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'bdthemes-prime-slider'), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>'),

			]
		);

		$this->add_control(
			'glassmorphism_blur_level',
			[
				'label'       => esc_html__('Blur Level', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					]
				],
				'default'     => [
					'size' => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap::before' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);'
				],
				'condition' => [
					'glassmorphism_effect' => 'yes',
				]
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'slider_image_border',
				'selector'  => '{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'slider_image_border_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-img-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_image_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-slide-img-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


	$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__('Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-title, {{WRAPPER}} .bdt-omatic-slider .bdt-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-title:hover, {{WRAPPER}} .bdt-omatic-slider .bdt-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'first_word_title_color',
            [
                'label'     => esc_html__('First Word Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-omatic-slider .bdt-title .frist-word' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background_color',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'title_border',
				'selector'  => '{{WRAPPER}} .bdt-omatic-slider .bdt-title',
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-title',
				'fields_options' => [
                    'text_stroke_type' => [
                        'label' => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ),
                    ],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __('Text Shadow', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label'     => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_sub_title' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'sub_title_style_tabs'
		);
		
		$this->start_controls_tab(
			'sub_title_style_tab',
			[
				'label' => esc_html__( 'Sub Title', 'bdthemes-prime-slider' ),
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sub_title_background_color',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'sub_title_border',
				'selector'  => '{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title',
			]
		);

		$this->add_responsive_control(
			'sub_title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'sub_title_text_stroke',
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title',
				'fields_options' => [
                    'text_stroke_type' => [
                        'label' => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ),
                    ],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sub_title_text_shadow',
				'label' => __('Text Shadow', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title',
			]
		);

		$this->add_responsive_control(
			'sub_title_space_between',
			[
				'label' => esc_html__('Space Between', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-title-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sub_title_style_line_tab',
			[
				'label' => esc_html__( 'Line', 'bdthemes-prime-slider' ),
			]
		);

		$this->add_control(
			'sub_title_line_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-line' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_line_width',
			[
				'label' => esc_html__('Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-line' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_line_height',
			[
				'label' => esc_html__('Height', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-line' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_line_radius',
			[
				'label' => esc_html__('Border Radius', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-sub-line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label'     => esc_html__('Text', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_text' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'text_style_tabs'
		);
		
		$this->start_controls_tab(
			'style_text_tab',
			[
				'label' => esc_html__( 'Text', 'bdthemes-prime-slider' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'text_background_color',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-desc, {{WRAPPER}} .bdt-omatic-slider .bdt-desc > *',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-inner-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-desc',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_text_line_tab',
			[
				'label' => esc_html__( 'Line', 'bdthemes-prime-slider' ),
			]
		);

		$this->add_control(
			'text_line_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-line' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_line_width',
			[
				'label' => esc_html__('Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-line' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_line_height',
			[
				'label' => esc_html__('Height', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-line' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

				
		$this->add_responsive_control(
			'text_line_spacing',
			[
				'label' => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-line' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_line_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'   => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __('Navigation', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __('ARROWS', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'0' => esc_html__('Default', 'bdthemes-prime-slider'),
					'1' => esc_html__('Style 1', 'bdthemes-prime-slider'),
					'2' => esc_html__('Style 2', 'bdthemes-prime-slider'),
					'3' => esc_html__('Style 3', 'bdthemes-prime-slider'),
					'4' => esc_html__('Style 4', 'bdthemes-prime-slider'),
					'5' => esc_html__('Style 5', 'bdthemes-prime-slider'),
					'6' => esc_html__('Style 6', 'bdthemes-prime-slider'),
					'7' => esc_html__('Style 7', 'bdthemes-prime-slider'),
					'8' => esc_html__('Style 8', 'bdthemes-prime-slider'),
					'9' => esc_html__('Style 9', 'bdthemes-prime-slider'),
					'10' => esc_html__('Style 10', 'bdthemes-prime-slider'),
					'11' => esc_html__('Style 11', 'bdthemes-prime-slider'),
					'12' => esc_html__('Style 12', 'bdthemes-prime-slider'),
					'13' => esc_html__('Style 13', 'bdthemes-prime-slider'),
					'14' => esc_html__('Style 14', 'bdthemes-prime-slider'),
					'15' => esc_html__('Style 15', 'bdthemes-prime-slider'),
					'16' => esc_html__('Style 16', 'bdthemes-prime-slider'),
					'17' => esc_html__('Style 17', 'bdthemes-prime-slider'),
					'18' => esc_html__('Style 18', 'bdthemes-prime-slider'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-prime-slider'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-prime-slider'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-prime-slider'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-prime-slider'),
					'square-1' => esc_html__('Style 23', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->start_controls_tabs('tabs_navigation_arrows_style');

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label'     => __('Normal', 'bdthemes-prime-slider'),
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrows_background',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'nav_arrows_border',
				'selector'  => '{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __('Icon Size', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_spacing',
			[
				'label'     => __('Space Between', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrows_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label'     => __('Hover', 'bdthemes-prime-slider'),
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrows_hover_background',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button:hover',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrows_hover_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-omatic-slider .bdt-navigation-wrap .bdt-nav-button:hover',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render_header() {
		$settings   = $this->get_settings_for_display();
		$id         = 'bdt-prime-slider-' . $this->get_id();

		$this->add_render_attribute( 'prime-slider-omatic', 'id', $id );
		$this->add_render_attribute( 'prime-slider-omatic', 'class', [ 'bdt-omatic-slider', 'elementor-swiper' ] );

		$this->add_render_attribute(
			[
				'prime-slider-omatic' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'cube',
							"fadeEffect"     => ['crossFade' => true],
							"lazy"           => true,
							"parallax"       => true,
							"mousewheel"     => true,
							"grabCursor"     => ($settings["grab_cursor"] === "yes") ? true : false,
							"pauseOnHover"   => ("yes" == $settings["pauseonhover"]) ? true : false,
							"slidesPerView"  => 1,
							"loopedSlides"   => 4,
							"observer"       => ($settings["observer"]) ? true : false,					
							"observeParents" => ($settings["observer"]) ? true : false,

						
							"cubeEffect" => [
								"shadow"        => false,
							    "slideShadows"  => false,
							],
							  
							"scrollbar"      => [
								"el" => "#" . $id . " .swiper-scrollbar",
							],
							"lazy" => [
								"loadPrevNext" => "true",
							],
				
							"navigation" => [
								"nextEl" => "#" . $id . " .bdt-button-next ",
								"prevEl" => "#" . $id . " .bdt-button-prev",
							] 

						]))
					]
				]
			]
		);

		$swiper_class = Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
		$this->add_render_attribute('swiper', 'class', 'bdt-omatic-slider ' . $swiper_class);

		?>
		<div <?php $this->print_render_attribute_string( 'prime-slider-omatic' ); ?>>
			<div <?php $this->print_render_attribute_string( 'swiper' ); ?>>
				<div class="swiper-wrapper">

		<?php
	}

          public function render_footer() {
		$settings = $this->get_settings_for_display();
		?> 
				</div>

			</div>

			<?php if ($settings['show_navigation_arrows']) : ?>
				<div class="bdt-navigation-wrap">
					<div class="bdt-nav-button bdt-button-next">
						<i class="ps-wi-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</div>
					<div class="bdt-nav-button bdt-button-prev">
						<i class="ps-wi-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</div>
				</div>
			<?php endif; ?>

			<div thumbsSlider="" class="bdt-omatic-thumbs-slide">
                <div class="swiper-wrapper">

				<?php foreach ($settings['slides'] as $slide) : ?>
					<div class="swiper-slide bdt-omatic-item">
					<div class="bdt-slide-content">
					<?php $this->render_sub_title($slide); ?>
					<?php if ($slide['title'] && ('yes' == $settings['show_title'])) : ?>
						<div class="bdt-title-wrap">
							<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-title">
								<?php if ('' !== $slide['title_link']['url']) : ?>
									<a href="<?php echo esc_url($slide['title_link']['url']); ?>">
									<?php endif; ?>
									<?php echo prime_slider_first_word($slide['title']); ?>
									<?php if ('' !== $slide['title_link']['url']) : ?>
									</a>
								<?php endif; ?>
							</<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
						</div>
					<?php endif; ?>
				</div>

				
				<?php $this->render_text($slide); ?>
				
						
					</div>
					<?php endforeach; ?>
               </div>
		   </div>

		<?php
	}

	public function render_text($slide) {
		$settings = $this->get_settings_for_display();

		if ('' == $settings['show_text']) {
			return;
		}

		$text_hide_on_setup = '';

		if (!empty($settings['text_hide_on'])) {
			foreach ($settings['text_hide_on'] as $element) {

				if ($element == 'desktop') {
					$text_hide_on_setup .= ' bdt-desktop';
				}
				if ($element == 'tablet') {
					$text_hide_on_setup .= ' bdt-tablet';
				}
				if ($element == 'mobile') {
					$text_hide_on_setup .= ' bdt-mobile';
				}
			}
		}

		?>
		<?php if ($slide['text'] && ('yes' == $settings['show_text'])) : ?>
		<div class="bdt-inner-content <?php echo $text_hide_on_setup; ?>">
			<span class="bdt-line"></span>
			<div class="bdt-desc-wrap">
				<div class="bdt-desc" >
					<?php echo wp_kses_post($slide['text']); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php
	}


	public function render_sub_title($slide) {
		$settings = $this->get_settings_for_display();

		if ('' == $settings['show_sub_title']) {
			return;
		}

		?>
		<div class="bdt-sub-title-wrap">
			<h4 class="bdt-sub-title">
				<?php echo wp_kses($slide['sub_title'], prime_slider_allow_tags('title')); ?>
			</h4>
			<span class="bdt-sub-line"></span>
		</div>

		<?php
	}

	public function rendar_item_image($item, $alt = '') {
		$settings = $this->get_settings_for_display();

		$image_src = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumbnail_size', $settings);

		if ( $image_src ) {
			$image_src = $image_src;
		} elseif ( $item['image']['url'] ) {
			$image_src = $item['image']['url'];
		} else {
			return;
		}
		?>

		<div class="bdt-slide-img-wrap">
			<div class="bdt-img-wrap">
				<img class="bdt-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html($alt); ?>">
			</div>
		</div>

		<?php
	}


    public function render_slides_loop() {
        $settings = $this->get_settings_for_display();

		foreach ($settings['slides'] as $slide) : 
		
			?>
			<div class="bdt-slide-item swiper-slide">
				<?php $this->rendar_item_image($slide); ?>
			</div>

        <?php endforeach;
    }

    public function render() {
		
        $this->render_header();

        $this->render_slides_loop();

        $this->render_footer();
    }
}