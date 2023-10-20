<?php

namespace PrimeSlider\Modules\Multiscroll\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use PrimeSlider\Utils;

use PrimeSlider\Prime_Slider_Loader;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Multiscroll extends Widget_Base {

	public function get_name() {
		return 'prime-slider-multiscroll';
	}

	public function get_title() {
		return BDTPS . esc_html__('Multiscroll', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-multiscroll';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return ['multiscroll', 'slider', 'fancy', 'slideshow', 'advanced'];
	}

	public function get_style_depends() {
		return ['ps-multiscroll'];
	}

	public function get_script_depends() {
		return ['jquery-multiscroll', 'easings', 'ps-multiscroll'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/uzBHDw_mdRE';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Multiscroll Layout', 'bdthemes-prime-slider'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'sub_title',
			[
				'label'       => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Subtitle Goes Here', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Slide Title Here', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
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
			'description',
			[
				'label'       => esc_html__('Description', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('Lorem ipsum dolor sit amet.', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'slide_button',
			[
				'label'       => esc_html__('Button Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('View Details', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'         => esc_html__('Button Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => '#'],
				'show_external' => false,
				'dynamic'       => ['active' => true],
				'condition'     => [
					'slide_button!' => ''
				]
			]
		);

		$repeater->add_control(
			'slide_image',
			[
				'label'   => esc_html__('Image', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => ['active' => true],
				'default' => [
					'url' => BDTPS_ASSETS_URL . 'images/gems-' . rand(1, 3) . '.png',
				],
			]
		);

		$repeater->add_control(
			'left_background',
			[
				'label'   => esc_html__('Left Background', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'color',
				'options' => [
					'color' => [
						'title' => esc_html__('Color', 'bdthemes-element-pack'),
						'icon'  => 'eicon-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'bdthemes-element-pack'),
						'icon'  => 'eicon-image',
					],
				],
			]
		);

		$repeater->add_control(
			'left_background_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'left_background' => 'color'
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider {{CURRENT_ITEM}}.bdt-ms-section-left' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'left_background_image',
			[
				'label'   => esc_html__('Image', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => ['active' => true],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'left_background' => 'image'
				],
			]
		);

		$repeater->add_control(
			'right_background',
			[
				'label'   => esc_html__('Right Background', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'color',
				'options' => [
					'color' => [
						'title' => esc_html__('Color', 'bdthemes-element-pack'),
						'icon'  => 'eicon-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'bdthemes-element-pack'),
						'icon'  => 'eicon-image',
					],
				],
			]
		);

		$repeater->add_control(
			'right_background_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'right_background' => 'color'
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider {{CURRENT_ITEM}}.bdt-ms-section-right' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'right_background_image',
			[
				'label'   => esc_html__('Image', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => ['active' => true],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'right_background' => 'image'
				],
			]
		);

		$repeater->add_control(
			'custom_style_popover',
			[
				'label'        => esc_html__('Custom Style', 'bdthemes-element-pack') . BDTPS_NC,
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'render_type'  => 'ui',
				'return_value' => 'yes',
			]
		);

		$repeater->start_popover();

		$repeater->add_control(
			'repeater_title_color',
			[
				'label'     => __('Title Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider {{CURRENT_ITEM}}.ms-section .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-title' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'repeater_sub_title_color',
			[
				'label'     => __('Sub Title Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider {{CURRENT_ITEM}}.ms-section .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'repeater_description_color',
			[
				'label'     => __('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider {{CURRENT_ITEM}}.ms-section .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-description' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->end_popover();

		$this->add_control(
			'slides',
			[
				'label'   => esc_html__('Item', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title'                  => esc_html__('MultiScroll', 'bdthemes-prime-slider'),
						'slide_image'            => ['url' => BDTPS_ASSETS_URL . 'images/gems-1.png'],
						'left_background_color'  => '#ad218d',
						'right_background_color' => '#bb1f98',
					],
					[
						'title'                  => esc_html__('MultiScroll', 'bdthemes-prime-slider'),
						'slide_image'            => ['url' => BDTPS_ASSETS_URL . 'images/gems-2.png'],
						'left_background_color'  => '#4287ec',
						'right_background_color' => '#498cef',
					],
					[
						'title'                  => esc_html__('MultiScroll', 'bdthemes-prime-slider'),
						'slide_image'            => ['url' => BDTPS_ASSETS_URL . 'images/gems-3.png'],
						'left_background_color'  => '#82007d',
						'right_background_color' => '#8a0c85',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'         => 'thumbnail_size',
				'label'        => esc_html__('Image Size', 'bdthemes-prime-slider'),
				'exclude'      => ['custom'],
				'default'      => 'full',
				'prefix_class' => 'bdt-mltiscroll-slider--thumbnail-size-',
			]
		);

		$this->add_control(
			'content_position',
			[
				'label'   => __('Content Position', 'bdthemes-prime-slider') . BDTPS_PC,
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options'   => [
					'text-left'   => [
						'title' => esc_html__('Text Left and Image Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('All Content Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-center',
					],
					'text-right'  => [
						'title' => esc_html__('Image Left and Text Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle' => false
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __('Content Max Width', 'bdthemes-prime-slider') . BDTPS_PC,
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 1200,
						'min' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content' => 'max-width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'slide_text_align',
			[
				'label'   => __('Alignment', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_image',
			[
				'label'   => esc_html__('Show Image', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_subtitle',
			[
				'label'   => esc_html__('Show Sub Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
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
			'show_description',
			[
				'label'   => esc_html__('Show Test', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_button',
			[
				'label'   => esc_html__('Show Button', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'   => __('Button Position', 'bdthemes-prime-slider') . BDTPS_PC,
				'type' 	  => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right'      => __('Right', 'bdthemes-prime-slider'),
					'left'       => __('Left', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'show_button' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_shadow_title',
			[
				'label'   => esc_html__('Show Shadow Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Title HTML Tag', 'bdthemes-prime-slider') . BDTPS_PC,
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => prime_slider_title_tags(),
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_settings',
			[
				'label' => esc_html__('Additional Settings', 'bdthemes-prime-slider'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'scrollingSpeed',
			[
				'label'   => esc_html__('Scrolling Speed', 'bdthemes-prime-slider'),
				'type' => Controls_Manager::SLIDER,
				'default' 		 => [
					'size' 			=> 700,
				],
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => 100,
					]
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => esc_html__('Navigation', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'navigationPosition',
			[
				'label'   => __('Navigation Position', 'bdthemes-prime-slider') . BDTPS_PC,
				'type' 	  => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right'      => __('Right', 'bdthemes-prime-slider'),
					'left'       => __('Left', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'navigation' => 'yes'
				]
			]
		);

		$this->add_control(
			'loopBottom',
			[
				'label'   => esc_html__('Loop Bottom', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loopTop',
			[
				'label'   => esc_html__('Loop Top', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'css3',
			[
				'label'   => esc_html__('Easing Effect', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__('Autoplay', 'bdthemes-prime-slider') . BDTPS_NC,
				'description'   => esc_html__('Make sure you enabled Loop Bottom.', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__('Autoplay Speed', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoplay_notes',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __('Note: Right now the Autoplay only works on Preview Mode/FrontEnd. So don\'t feel confusion about Editor mode.', 'bdthemes-prime-slider'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

			]
		);

		$this->end_controls_section();


		//Style
		$this->start_controls_section(
			'section_style_slider',
			[
				'label' => esc_html__('Multiscroll Content', 'bdthemes-prime-slider'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_background',
			[
				'label'     => esc_html__('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'item_shadow_title',
			[
				'label'     => esc_html__('Shadow Title Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .ms-section.shadow-title.bdt-ms-section-right:before, {{WRAPPER}} .bdt-mltiscroll-slider .ms-section.shadow-title.bdt-ms-section-left:before' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'selector'    => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_content_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'show_text_stroke',
			[
				'label'   => esc_html__('Text Stroke', 'bdthemes-prime-slider') . BDTPS_NC,
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-text-stroke--',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-title' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-title' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __('Text Shadow', 'plugin-domain') . BDTPS_NC,
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label'     => esc_html__('Subtitle', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_subtitle' => ['yes'],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-subtitle',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label'     => esc_html__('Text', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_description' => ['yes'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-description' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-content .bdt-mltiscroll-slider-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__('Button', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'selector'    => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'border_radius_advanced_show!' => 'yes',
				],
			]
		);

		$this->add_control(
			'border_radius_advanced_show',
			[
				'label' => __('Advanced Radius', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'border_radius_advanced',
			[
				'label'       => esc_html__('Radius', 'bdthemes-prime-slider'),
				'description' => sprintf(__('For example: %1s or Go %2s this link %3s and copy and paste the radius value.', 'bdthemes-prime-slider'), '<b>30% 70% 82% 18% / 46% 62% 38% 54%</b>', '<a href="https://9elements.github.io/fancy-border-radius/" target="_blank">', '</a>'),
				'type'        => Controls_Manager::TEXT,
				'size_units'  => ['px', '%'],
				'default'     => '30% 70% 82% 18% / 46% 62% 38% 54%',
				'selectors'   => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a'     => 'border-radius: {{VALUE}}; overflow: hidden;',
				],
				'condition' => [
					'border_radius_advanced_show' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector'  => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a:hover'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'    => ['gradient'],
				'selector'  => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a:hover',
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_line_color',
			[
				'label'     => esc_html__('Line Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-mltiscroll-slider .bdt-mltiscroll-slider-button a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_Navigation',
			[
				'label' => esc_html__('Navigation', 'bdthemes-prime-slider'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => 'yes'
				]
			]
		);

		$this->start_controls_tabs('tabs_navigation_style');

		$this->start_controls_tab(
			'tab_navigation_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'navigation_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav li span' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'navigation_border',
				'label'       => esc_html__('Border', 'bdthemes-prime-slider'),
				'selector'    => '{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav span',
			]
		);

		$this->add_control(
			'navi_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav span' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_width',
			[
				'label' => __('Width (px)', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav span, {{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_height',
			[
				'label' => __('Height (px)', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav span, {{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_horizontal_offset_right',
			[
				'label'   => __('Horizontal Offset', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigationPosition' => 'right'
				]
			]
		);

		$this->add_responsive_control(
			'navigation_horizontal_offset_left',
			[
				'label'   => __('Horizontal Offset', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigationPosition' => 'left'
				]
			]
		);

		$this->add_responsive_control(
			'navigation_spacing',
			[
				'label' => __('Spacing', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_navigation_active',
			[
				'label' => esc_html__('Active', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'navigation_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav li a.active span' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'navigation_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'navigation_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-mltiscroll-slider #multiscroll-nav ul li a.active span' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function rendar_item_image($content) {
		$settings = $this->get_settings_for_display();

		if ('' == $settings['show_image']) {
			return;
		}

		$slide_image = Group_Control_Image_Size::get_attachment_image_src($content['slide_image']['id'], 'thumbnail_size', $settings);
		if (!$slide_image) {
			$slide_image = $content['slide_image']['url'];
		}

?>

		<div class="bdt-multiscroll-image bdt-position-center">
			<img src="<?php echo esc_url($slide_image); ?>" alt="<?php echo get_the_title(); ?>">
		</div>

	<?php
	}

	public function rendar_background_image($position_bg) {

		$settings = $this->get_settings_for_display();

		$slide_image = Group_Control_Image_Size::get_attachment_image_src($position_bg, 'thumbnail_size', $settings);

		// if ( ! $slide_image ) {
		// 	$slide_image = $content['left_background_image']['url'];
		// }

		return 'background-image: url(' . esc_url($slide_image) . ')';
	}

	public function rendar_item_content($content) {
		$settings = $this->get_settings_for_display();

	?>
		<div class="bdt-mltiscroll-slider-content bdt-position-center">
			<div class="bdt-position-relative">
				<?php if ($content['sub_title'] && ('yes' == $settings['show_subtitle'])) : ?>
					<div class="bdt-mltiscroll-slider-subtitle">
						<?php echo wp_kses_post($content['sub_title']); ?>
					</div>
				<?php endif; ?>

				<?php if ($content['title'] && ('yes' == $settings['show_title'])) : ?>
					<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-mltiscroll-slider-title">
						<?php if ('' !== $content['title_link']['url']) : ?>
							<a href="<?php echo esc_url($content['title_link']['url']); ?>">
							<?php endif; ?>
							<?php echo wp_kses_post($content['title']); ?>
							<?php if ('' !== $content['title_link']['url']) : ?>
							</a>
						<?php endif; ?>
					</<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
				<?php endif; ?>

				<?php if ($content['description'] && ('yes' == $settings['show_description'])) : ?>
					<div class="bdt-mltiscroll-slider-description">
						<?php echo wp_kses_post($content['description']); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>

	<?php
	}

	public function render_content_center() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('button-position', 'class', 'bdt-mltiscroll-slider-button bdt-btn-position-' . $settings['button_position']);

	?>
		<div class="bdt-content-center">
			<div id="left-side" class="ms-left">
				<?php
				foreach ($settings['slides'] as $slide) : ?>
					<?php
					$left_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					} else {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					}

					if (isset($slide['left_background_image']['id'])) {
						$left_bg = $this->rendar_background_image($slide['left_background_image']['id']);
					}

					?>

					<div <?php $this->print_render_attribute_string('ms_section_left'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($left_bg); ?>">
						<div class="intro">
							<?php $this->rendar_item_content($slide); ?>
							<?php if ($slide['slide_image']['url']) : ?>
								<?php $this->rendar_item_image($slide); ?>
							<?php endif; ?>
						</div>
						<?php if ($settings['button_position'] == 'left') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach;
				?>
			</div>

			<div id="right-side" class="ms-right">
				<?php
				foreach ($settings['slides'] as $slide) : ?>

					<?php
					$right_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					} else {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					}

					if (isset($slide['right_background_image']['id'])) {
						$right_bg = $this->rendar_background_image($slide['right_background_image']['id']);
					}

					?>

					<div <?php $this->print_render_attribute_string('ms_section_right'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($right_bg); ?>">
						<div class="intro">
							<?php $this->rendar_item_content($slide); ?>
							<?php if ($slide['slide_image']['url']) : ?>
								<?php $this->rendar_item_image($slide); ?>
							<?php endif; ?>
						</div>

						<?php if ($settings['button_position'] == 'right') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>

					</div>

				<?php endforeach;
				?>
			</div>


		</div>

	<?php
	}

	public function render_content_text_left() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('button-position', 'class', 'bdt-mltiscroll-slider-button bdt-btn-position-' . $settings['button_position']);

	?>
		<div class="bdt-content-text-left">
			<div id="left-side" class="ms-left">
				<?php
				foreach ($settings['slides'] as $slide) : ?>

					<?php
					$left_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					} else {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					}

					if (isset($slide['left_background_image']['id'])) {
						$left_bg = $this->rendar_background_image($slide['left_background_image']['id']);
					}
					?>

					<div <?php $this->print_render_attribute_string('ms_section_left'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($left_bg); ?>">
						<div class="intro">
							<?php $this->rendar_item_content($slide); ?>
						</div>
						<?php if ($settings['button_position'] == 'left') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach;
				?>
			</div>

			<div id="right-side" class="ms-right">

				<?php
				foreach ($settings['slides'] as $slide) : ?>
					<?php
					$right_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					} else {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					}

					if (isset($slide['right_background_image']['id'])) {
						$right_bg = $this->rendar_background_image($slide['right_background_image']['id']);
					}
					?>

					<div <?php $this->print_render_attribute_string('ms_section_right'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($right_bg); ?>">

						<?php if ($slide['slide_image']['url']) : ?>
							<?php $this->rendar_item_image($slide); ?>
						<?php endif; ?>
						<?php if ($settings['button_position'] == 'right') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach;
				?>
			</div>
		</div>
	<?php
	}

	public function render_content_text_right() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('button-position', 'class', 'bdt-mltiscroll-slider-button bdt-btn-position-' . $settings['button_position']);

	?>
		<div class="bdt-content-text-right">
			<div id="left-side" class="ms-left">
				<?php
				foreach ($settings['slides'] as $slide) : ?>

					<?php
					$left_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					} else {
						$this->add_render_attribute('ms_section_left', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-left', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_left', 'id', 'bdt-ms-section-left', true);
					}
					if (isset($slide['left_background_image']['id'])) {
						$left_bg = $this->rendar_background_image($slide['left_background_image']['id']);
					}
					?>

					<div <?php $this->print_render_attribute_string('ms_section_left'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($left_bg); ?>">
						<?php if ($slide['slide_image']['url']) : ?>
							<?php $this->rendar_item_image($slide); ?>
						<?php endif; ?>
						<?php if ($settings['button_position'] == 'left') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach;
				?>
			</div>

			<div id="right-side" class="ms-right">

				<?php
				foreach ($settings['slides'] as $slide) : ?>

					<?php
					$right_bg = '';
					if ('yes' == $settings['show_shadow_title']) {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'shadow-title', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					} else {
						$this->add_render_attribute('ms_section_right', 'class', ['ms-section', 'bdt-ms-section', 'bdt-ms-section-right', 'elementor-repeater-item-' . esc_attr($slide['_id'])], true);
						$this->add_render_attribute('ms_section_right', 'id', 'bdt-ms-section-right', true);
					}
					if (isset($slide['right_background_image']['id'])) {
						$right_bg = $this->rendar_background_image($slide['right_background_image']['id']);
					}
					?>

					<div <?php $this->print_render_attribute_string('ms_section_right'); ?> data-label="<?php echo $slide['title']; ?>" style="<?php echo esc_attr($right_bg); ?>">
						<div class="intro">
							<?php $this->rendar_item_content($slide); ?>
						</div>
						<?php if ($settings['button_position'] == 'right') : ?>
							<?php if ($slide['slide_button'] && ('yes' == $settings['show_button'])) : ?>
								<div <?php $this->print_render_attribute_string('button-position'); ?>>
									<?php if ('' !== $slide['button_link']['url']) : ?>
										<a href="<?php echo esc_url($slide['button_link']['url']); ?>">
										<?php endif; ?>
										<?php echo wp_kses_post($slide['slide_button']); ?>
										<?php if ('' !== $slide['button_link']['url']) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

				<?php endforeach;
				?>
			</div>
		</div>
	<?php
	}

	public function render() {
		$settings         = $this->get_settings_for_display();
		$id = 'bdt-' . $this->get_id();

		$this->add_render_attribute('multiscroll_slider', 'class', 'bdt-mltiscroll-slider', true);
		$this->add_render_attribute(
			[
				'multiscroll_slider' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"scrollingSpeed"     => $settings["scrollingSpeed"]["size"],
							"navigation"         => ("yes" == $settings["navigation"]) ? true : false,
							"navigationPosition" => $settings["navigationPosition"],
							"loopBottom"         => ("yes" == $settings["loopBottom"]) ? true : false,
							"loopTop"            => ("yes" == $settings["loopTop"]) ? true : false,
							"autoplay"           => ("yes" == $settings["autoplay"]) ? true : false,
							"autoplay_speed"     => $settings["autoplay_speed"],
							"css3"               => ("yes" == $settings["css3"]) ? false : true,
						]))
					]
				]
			]
		);

	?>
		<div <?php $this->print_render_attribute_string('multiscroll_slider'); ?> id="<?php echo esc_attr($id); ?>">

			<?php
			if ('text-right' == $settings['content_position']) {
				$this->render_content_text_right();
			} elseif ('text-left' == $settings['content_position']) {
				$this->render_content_text_left();
			} else {
				$this->render_content_center();
			}
			?>

		</div>
<?php
	}
}
