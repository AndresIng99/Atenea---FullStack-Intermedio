<?php

namespace PrimeSlider\Modules\Woocircle\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use PrimeSlider\Utils;

use PrimeSlider\Traits\Global_Widget_Controls;
use PrimeSlider\Traits\QueryControls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Woocircle extends Widget_Base {
	use Group_Control_Query;
	use Global_Widget_Controls;

	public function get_name() {
		return 'prime-slider-woocircle';
	}

	public function get_title() {
		return BDTPS . esc_html__('WooCircle', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-woocircle';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return ['prime slider', 'slider', 'woocircle', 'prime', 'wc slider', 'woocommerce'];
	}

	public function get_style_depends() {
		return ['ps-woocircle', 'prime-slider-font'];
	}

	public function get_script_depends() {
		return ['classie', 'dynamics', 'ps-woocircle'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/nJUtQ28kb4A';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', 'bdthemes-prime-slider'),
			]
		);

		$this->add_responsive_control(
			'slider_item_height',
			[
				'label' => esc_html__('Height(vh)', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider' => 'height: {{SIZE}}vh;',
				],
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[
				'label'   => esc_html__('Alignment', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'         => 'thumbnail_size',
				'label'        => esc_html__('Image Size', 'bdthemes-prime-slider'),
				'exclude'      => ['custom'],
				'default'      => 'medium',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__('Show Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator'	=> 'before',
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

		$this->add_control(
			'show_excerpt',
			[
				'label'     => esc_html__('Show Excerpt', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_price',
			[
				'label'   => __('Price', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_cart',
			[
				'label'   => __('Add to Cart', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_post_query_builder',
			[
				'label' => esc_html__('Query', 'bdthemes-prime-slider'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_query_builder_controls();

		$this->update_control(
			'posts_source',
			[
				'type'      => Controls_Manager::SELECT,
				'default'   => 'product',
				'options' => [
					'product' 			 => esc_html__('Product', 'bdthemes-prime-slider'),
					'manual_selection'   => esc_html__('Manual Selection', 'bdthemes-prime-slider'),
					'current_query'      => esc_html__('Current Query', 'bdthemes-prime-slider'),
					'_related_post_type' => esc_html__('Related', 'bdthemes-prime-slider'),
				]
			]
		);
		$this->update_control(
			'posts_limit',
			[
				'label'     => esc_html__('Limit', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
			]
		);
		$this->end_controls_section();

		//Style Start
		$this->start_controls_section(
			'section_style_slider_items',
			[
				'label'     => esc_html__('Slider', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'slider_style_tabs'
		);

		// slider item
		$this->start_controls_tab(
			'style_slider_item_tab',
			[
				'label' => esc_html__('Item', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'active_circle_color',
			[
				'label'     => esc_html__('Circle Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .deco--circle' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		// slider priview title
		$this->start_controls_tab(
			'style_slider_title_tab',
			[
				'label' => esc_html__('Title', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title-preview' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title-preview',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title-preview',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title-preview',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title-preview' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// slider price priview

		$this->start_controls_tab(
			'style_slider_price_tab',
			[
				'label' => esc_html__('Price', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'old_price_heading',
			[
				'label' => __('Old Price', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'old_price_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price del span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'old_price_margin',
			[
				'label'      => __('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price del > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'old_price_typography',
				'label'    => __('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price del span',
			]
		);

		$this->add_control(
			'sale_price_heading',
			[
				'label'     => __('Sale Price', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sale_price_background',
			[
				'label'     => __('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price ins' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sale_price_margin',
			[
				'label'      => __('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sale_price_typography',
				'label'    => __('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price > span',
			]
		);

		$this->add_responsive_control(
			'sale_price_spacing',
			[
				'label'      => __('Spacing', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-slide-content .bdt-elastic-price .price' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// open/close button

		$this->start_controls_tab(
			'style_slider_modal_open_button_tab',
			[
				'label' => esc_html__('Open', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'open_button_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--open' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'open_button_background',
				'selector'  => '{{WRAPPER}} .bdt-elastic-action--open',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'open_button_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-elastic-action--open',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'open_button_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'open_button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--open' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'open_button_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--open' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'open_button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-action--open',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'open_button_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-action--open',
			]
		);

		// hover

		$this->add_control(
			'slider_modal_open_button_heading',
			[
				'label' => __('Hover', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'open_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--open:focus,
						 {{WRAPPER}} .bdt-elastic-action--open:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'open_button_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-elastic-action--open:focus, {{WRAPPER}} .bdt-elastic-action--open:hover',
			]
		);

		$this->add_control(
			'open_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'close_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--open:focus, {{WRAPPER}} .bdt-elastic-action--open:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// slider modal start
		$this->start_controls_section(
			'section_style_slider_modal',
			[
				'label'     => esc_html__('Modal', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'modal_contnet_max_width',
			[
				'label' => __('Content Max Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'modal_text__max_width',
			[
				'label' => esc_html__('Max Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-modal-details' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

		$this->start_controls_tabs(
			'slider_modal_style_tabs'
		);

		// slider Modal title
		$this->start_controls_tab(
			'style_slider_modal_title_tab',
			[
				'label' => esc_html__('Title', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'modal_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title--main' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'modal_title_stroke',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title--main',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'modal_title_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title--main',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'modal_title_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title--main',
			]
		);

		$this->add_responsive_control(
			'modal_title_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-title--main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// slider price modal

		$this->start_controls_tab(
			'style_slider_modal_price_tab',
			[
				'label' => esc_html__('Price', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'modal_old_price_heading',
			[
				'label' => __('Old Price', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'modal_old_price_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price del span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'modal_old_price_margin',
			[
				'label'      => __('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price del > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'modal_old_price_typography',
				'label'    => __('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price del span',
			]
		);

		$this->add_control(
			'modal_sale_price_heading',
			[
				'label'     => __('Sale Price', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'modal_sale_price_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'modal_sale_price_background',
			[
				'label'     => __('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price ins' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'modal_sale_price_margin',
			[
				'label'      => __('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'modal_sale_price_typography',
				'label'    => __('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price ins, {{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price > span',
			]
		);

		$this->add_responsive_control(
			'modal_sale_price_spacing',
			[
				'label'      => __('Spacing', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-price.bdt-elastic-price--large .price' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// modal text

		$this->start_controls_tab(
			'style_slider_modal_text_tab',
			[
				'label' => esc_html__('Text', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-description',
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// close button

		$this->start_controls_tab(
			'style_slider_modal_close/open_button_tab',
			[
				'label' => esc_html__('Close', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'close_button_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--close' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'close_button_background',
				'selector'  => '{{WRAPPER}} .bdt-elastic-action--close',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'close_button_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-elastic-action--close',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'close_button_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-action--close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'close_button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-action--close',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'close_button_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-action--close',
			]
		);

		// hover

		$this->add_control(
			'slider_modal_close/open_button_heading',
			[
				'label' => __('Hover', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'close_button_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--close:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'close_button_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-elastic-action--close:hover',
			]
		);

		$this->add_control(
			'close_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				// 'condition' => [
				// 	'close_button_border_border!' => '',
				// ],
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-action--close:hover' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'slider_modal_add_to_cart_button_heading',
			[
				'label' => __('Add to Cart Button', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background',
			[
				'label'     => __('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => __('Border', 'bdthemes-prime-slider'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button',
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __('margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label' => __('Background', 'bdthemes-prime-slider'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_quantity',
			[
				'label' => __('Quantity', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'quantity_button_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quantity_button_background',
			[
				'label'     => __('Background', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'quantity_button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text',
			]
		);

		$this->add_responsive_control(
			'quantity_button_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quantity_button_padding',
			[
				'label'      => __('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'quantity_button_shadow',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quantity_button_typography',
				'selector' => '{{WRAPPER}} .bdt-elastic-slider .bdt-elastic-button--buy .input-text',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// slider modal end

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __('Navigation', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_number_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .navbutton .navbutton__line' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .navbutton:hover .navbutton__line' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label' => esc_html__('Size', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-elastic-slider .navbutton' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function render_query() {
		$default = $this->getGroupControlQueryArgs();
		$wp_query = new WP_Query($default);
		return $wp_query;
	}

	public function render_header() {
		$id         = 'bdt-elastic-slider-' . $this->get_id();

		$this->add_render_attribute('slider', 'class', 'bdt-elastic-slider');

		$this->add_render_attribute(
			[
				'elastic-slider' => [
					'id' => $id,
					'class' => ['bdt-elastic-slideshow'],
					'data-settings' => [
						wp_json_encode(
							array_filter([
								"id"               => '#' . $id,
							])
						),
					],
				],
			]
		);

?>
		<div class="bdt-prime-slider">
			<div <?php $this->print_render_attribute_string('slider'); ?>>
				<div <?php $this->print_render_attribute_string('elastic-slider'); ?>>
				<?php
			}

			public function render_footer() {
				?>
					<button class="bdt-elastic-action bdt-elastic-action--close" aria-label="Close">
						<i class="ps-wi-close"></i>
					</button>
				</div>
			</div>
		</div>
	<?php
			}

			public function render_item_content() {
				$settings = $this->get_settings_for_display();

				$placeholder_image_src = Utils::get_placeholder_image_src();
				$image_src = Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_size', $settings);

				if ($image_src) {
					$image_final_src = $image_src;
				} elseif ($placeholder_image_src) {
					$image_final_src = $placeholder_image_src;
				} else {
					return;
				}

	?>
		<div class="bdt-elastic-slide-item">
			<div class="bdt-elastic-slide-content">

				<?php if ($settings['show_title']) : ?>
					<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-elastic-title-preview">
						<?php the_title(); ?>
					</<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
				<?php endif; ?>

				<?php if ($settings['show_price']) : ?>
					<span class="bdt-elastic-price"><?php woocommerce_template_single_price(); ?></span>
				<?php endif; ?>

			</div>
			<div class="bdt-elastic-image-action-btn">
				<div class="bdt-elastic-image-action__inner">

					<img class="bdt-elastic-img bdt-elastic-img-small" src="<?php echo esc_url($image_final_src); ?>" alt="<?php echo get_the_title(); ?>">

					<button class="bdt-elastic-action bdt-elastic-action--open" aria-label="View details"><i class="ps-wi-plus"></i></button>
				</div>
			</div>
			<div class="bdt-elastic-modal-wrap">
				<div class="bdt-elastic-content-scroller">
					<img class="bdt-elastic-img bdt-elastic-img-large" src="<?php echo esc_url($image_final_src); ?>" alt="<?php echo get_the_title(); ?>">

					<div class="bdt-elastic-modal-details">

						<?php if ($settings['show_title']) : ?>
							<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-elastic-title--main">
								<?php the_title(); ?>
							</<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
						<?php endif; ?>

						<?php if ($settings['show_excerpt']) : ?>
							<div class="bdt-elastic-description"><?php the_excerpt(); ?></div>
						<?php endif; ?>

						<div class="bdt-elastic-price-buy-btn">
							<?php if ($settings['show_price']) : ?>
								<div class="bdt-elastic-price bdt-elastic-price--large"><?php woocommerce_template_single_price(); ?></div>
							<?php endif; ?>

							<?php if ($settings['show_cart']) : ?>
								<div class="bdt-elastic-button--buy">
									<?php woocommerce_template_single_add_to_cart(); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
<?php
			}

			public function render_slides_loop() {

				$wp_query = $this->render_query();
				while ($wp_query->have_posts()) : $wp_query->the_post();

					$this->render_item_content();

				endwhile;
				wp_reset_postdata();
			}

			public function render() {
				$this->render_header();
				$this->render_slides_loop();
				$this->render_footer();
			}
		}
