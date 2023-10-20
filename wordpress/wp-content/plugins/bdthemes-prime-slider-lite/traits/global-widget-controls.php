<?php

namespace PrimeSlider\Traits;

use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Background ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Typography ;
use  PrimeSlider\Modules\QueryControl\Controls\Group_Control_Posts ;
defined( 'ABSPATH' ) || die;
trait Global_Widget_Controls
{
    protected function register_pagination_controls()
    {
        $this->start_controls_tabs( 'tabs_pagination_style' );
        $this->start_controls_tab( 'tab_pagination_normal', [
            'label' => esc_html__( 'Normal', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'pagination_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'pagination_background',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} ul.bdt-pagination li a',
        ] );
        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'pagination_border',
            'label'    => esc_html__( 'Border', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} ul.bdt-pagination li a',
        ] );
        $this->add_responsive_control( 'pagination_offset', [
            'label'     => esc_html__( 'Offset', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-pagination' => 'margin-top: {{SIZE}}px;',
        ],
        ] );
        $this->add_responsive_control( 'pagination_space', [
            'label'     => esc_html__( 'Spacing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} .bdt-pagination'     => 'margin-left: {{SIZE}}px;',
            '{{WRAPPER}} .bdt-pagination > *' => 'padding-left: {{SIZE}}px;',
        ],
        ] );
        $this->add_responsive_control( 'pagination_padding', [
            'label'     => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::DIMENSIONS,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
        ],
        ] );
        $this->add_responsive_control( 'pagination_radius', [
            'label'     => esc_html__( 'Radius', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::DIMENSIONS,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
        ],
        ] );
        $this->add_responsive_control( 'pagination_arrow_size', [
            'label'     => esc_html__( 'Arrow Size', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SLIDER,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a svg' => 'height: {{SIZE}}px; width: auto;',
        ],
        ] );
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'pagination_typography',
            'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
            'selector' => '{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_pagination_hover', [
            'label' => esc_html__( 'Hover', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'pagination_hover_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a:hover, {{WRAPPER}} ul.bdt-pagination li a:hover span' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'pagination_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li a:hover' => 'border-color: {{VALUE}};',
        ],
            'condition' => [
            'pagination_border_border!' => '',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'pagination_hover_background',
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} ul.bdt-pagination li a:hover',
        ] );
        $this->end_controls_tab();
        $this->start_controls_tab( 'tab_pagination_active', [
            'label' => esc_html__( 'Active', 'bdthemes-prime-slider' ),
        ] );
        $this->add_control( 'pagination_active_color', [
            'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li.bdt-active a, {{WRAPPER}} ul.bdt-pagination li.bdt-active span' => 'color: {{VALUE}};',
        ],
        ] );
        $this->add_control( 'pagination_active_border_color', [
            'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
            '{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'border-color: {{VALUE}};',
        ],
        ] );
        $this->add_group_control( Group_Control_Background::get_type(), [
            'name'     => 'pagination_active_background',
            'selector' => '{{WRAPPER}} ul.bdt-pagination li.bdt-active a',
        ] );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    }
    
    protected function register_query_controls()
    {
        $this->add_control( 'post_source', [
            'label'       => _x( 'Source', 'Posts Query Control', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SELECT,
            'options'     => [
            ''        => esc_html__( 'Show All', 'bdthemes-prime-slider' ),
            'by_name' => esc_html__( 'Manual Selection', 'bdthemes-prime-slider' ),
        ],
            'label_block' => true,
        ] );
        $this->add_control( 'post_categories', [
            'label'       => esc_html__( 'Categories', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SELECT2,
            'options'     => prime_slider_get_category( 'category' ),
            'default'     => [],
            'label_block' => true,
            'multiple'    => true,
            'condition'   => [
            'post_source' => 'by_name',
        ],
        ] );
        $this->add_control( 'limit', [
            'label'   => esc_html__( 'Limit', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::NUMBER,
            'default' => 3,
        ] );
        $this->add_control( 'orderby', [
            'label'   => esc_html__( 'Order by', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
            'date'     => esc_html__( 'Date', 'bdthemes-prime-slider' ),
            'title'    => esc_html__( 'Title', 'bdthemes-prime-slider' ),
            'category' => esc_html__( 'Category', 'bdthemes-prime-slider' ),
            'rand'     => esc_html__( 'Random', 'bdthemes-prime-slider' ),
        ],
        ] );
        $this->add_control( 'order', [
            'label'   => esc_html__( 'Order', 'bdthemes-prime-slider' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
            'DESC' => esc_html__( 'Descending', 'bdthemes-prime-slider' ),
            'ASC'  => esc_html__( 'Ascending', 'bdthemes-prime-slider' ),
        ],
        ] );
    }
    
    protected function register_reveal_effects()
    {
        $this->start_controls_section( 'section_reveal_effects', [
            'label' => esc_html__( 'Reveal Effects', 'bdthemes-prime-slider' ) . BDTPS_NC . BDTPS_PC,
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );
        $this->add_control( 'reveal_effects_enable', [
            'label'        => esc_html__( 'Reveal Effects', 'bdthemes-prime-slider' ),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'reveal-effects-active-',
            'classes'      => BDTPS_IS_PC,
            'render_type'  => 'template',
        ] );
        $this->add_control( 'reveal_effects_color', [
            'label'     => __( 'Background', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
            'reveal_effects_enable' => 'yes',
        ],
        ] );
        $this->add_control( 'reveal_effects_direction', [
            'label'     => __( 'Direction', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'lr',
            'options'   => [
            'lr' => __( 'Left to Right', 'bdthemes-prime-slider' ),
            'rl' => __( 'Right to Left', 'bdthemes-prime-slider' ),
            'c'  => __( 'Center', 'bdthemes-prime-slider' ),
            'tb' => __( 'Top to Bottom', 'bdthemes-prime-slider' ),
            'bt' => __( 'Bottom to top', 'bdthemes-prime-slider' ),
        ],
            'condition' => [
            'reveal_effects_enable' => 'yes',
        ],
        ] );
        $this->add_control( 'reveal_effects_easing', [
            'label'     => __( 'Easing', 'bdthemes-prime-slider' ),
            'type'      => Controls_Manager::SELECT,
            'default'   => 'easeOutQuint',
            'options'   => [
            'easeOutQuad'     => esc_html__( 'Ease Out Quad', 'bdthemes-prime-slider' ),
            'easeOutCubic'    => esc_html__( 'Ease Out Cubic', 'bdthemes-prime-slider' ),
            'easeOutQuart'    => esc_html__( 'Ease Out Quart', 'bdthemes-prime-slider' ),
            'easeOutQuint'    => esc_html__( 'Ease Out Quint', 'bdthemes-prime-slider' ),
            'easeOutSine'     => esc_html__( 'Ease Out Sine', 'bdthemes-prime-slider' ),
            'easeOutExpo'     => esc_html__( 'Ease Out Expo', 'bdthemes-prime-slider' ),
            'easeOutCirc'     => esc_html__( 'Ease Out Circ', 'bdthemes-prime-slider' ),
            'easeOutBack'     => esc_html__( 'Ease Out Back', 'bdthemes-prime-slider' ),
            'easeOutBounce'   => esc_html__( 'Ease Out Bounce', 'bdthemes-prime-slider' ),
            'easeOutInQuad'   => esc_html__( 'Ease Out In Quad', 'bdthemes-prime-slider' ),
            'easeOutInCubic'  => esc_html__( 'Ease Out In Cubic', 'bdthemes-prime-slider' ),
            'easeOutInQuart'  => esc_html__( 'Ease Out In Quart', 'bdthemes-prime-slider' ),
            'easeOutInQuint'  => esc_html__( 'Ease Out In Quint', 'bdthemes-prime-slider' ),
            'easeOutInSine'   => esc_html__( 'Ease Out In Sine', 'bdthemes-prime-slider' ),
            'easeOutInExpo'   => esc_html__( 'Ease Out In Expo', 'bdthemes-prime-slider' ),
            'easeOutInCirc'   => esc_html__( 'Ease Out In Circ', 'bdthemes-prime-slider' ),
            'easeOutInBack'   => esc_html__( 'Ease Out In Back', 'bdthemes-prime-slider' ),
            'easeOutInBounce' => esc_html__( 'Ease Out In Bounce', 'bdthemes-prime-slider' ),
        ],
            'condition' => [
            'reveal_effects_enable' => 'yes',
        ],
        ] );
        $this->add_control( 'reveal_effects_speed', [
            'label'      => __( 'Speed', 'bdthemes-prime-slider' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [
            'px' => [
            'min'  => 0,
            'max'  => 5000,
            'step' => 1,
        ],
        ],
            'default'    => [
            'unit' => 'px',
            'size' => 1000,
        ],
            'condition'  => [
            'reveal_effects_enable' => 'yes',
        ],
        ] );
        $this->end_controls_section();
    }
    
    protected function register_background_settings( $class_name )
    {
        $this->add_control( 'background_image_toggle', [
            'label'        => __( 'Background Image Settings', 'bdthemes-element-pack' ) . BDTPS_PC,
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => __( 'None', 'bdthemes-element-pack' ),
            'label_on'     => __( 'Custom', 'bdthemes-element-pack' ),
            'return_value' => 'yes',
        ] );
        $this->start_popover();
        $this->add_responsive_control( 'background_image_position', [
            'label'       => _x( 'Position', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SELECT,
            'default'     => '',
            'options'     => [
            ''              => _x( 'Default', 'bdthemes-prime-slider' ),
            'center center' => _x( 'Center Center', 'bdthemes-prime-slider' ),
            'center left'   => _x( 'Center Left', 'bdthemes-prime-slider' ),
            'center right'  => _x( 'Center Right', 'bdthemes-prime-slider' ),
            'top center'    => _x( 'Top Center', 'bdthemes-prime-slider' ),
            'top left'      => _x( 'Top Left', 'bdthemes-prime-slider' ),
            'top right'     => _x( 'Top Right', 'bdthemes-prime-slider' ),
            'bottom center' => _x( 'Bottom Center', 'bdthemes-prime-slider' ),
            'bottom left'   => _x( 'Bottom Left', 'bdthemes-prime-slider' ),
            'bottom right'  => _x( 'Bottom Right', 'bdthemes-prime-slider' ),
        ],
            'selectors'   => [
            '{{WRAPPER}} ' . $class_name . '' => 'background-position: {{VALUE}};',
        ],
            'condition'   => [
            'background_image_toggle' => 'yes',
        ],
            'render_type' => 'ui',
        ] );
        // $this->add_responsive_control(
        // 	'background_image_attachment',
        // 	[
        // 		'label'   => _x('Attachment', 'bdthemes-prime-slider'),
        // 		'type'    => Controls_Manager::SELECT,
        // 		'default' => '',
        // 		'options' => [
        // 			''       => _x('Default', 'bdthemes-prime-slider'),
        // 			'scroll' => _x('Scroll', 'bdthemes-prime-slider'),
        // 			'fixed'  => _x('Fixed', 'bdthemes-prime-slider'),
        // 		],
        // 		'selectors' => [
        // 			'{{WRAPPER}} ' . $class_name . '' => 'background-attachment: {{VALUE}};',
        // 		],
        // 		'condition' => [
        // 			'background_image_toggle' => 'yes'
        // 		],
        // 		'render_type' => 'ui',
        // 	]
        // );
        $this->add_responsive_control( 'background_image_repeat', [
            'label'       => _x( 'Repeat', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SELECT,
            'default'     => '',
            'options'     => [
            ''          => _x( 'Default', 'bdthemes-prime-slider' ),
            'no-repeat' => _x( 'No-repeat', 'bdthemes-prime-slider' ),
            'repeat'    => _x( 'Repeat', 'bdthemes-prime-slider' ),
            'repeat-x'  => _x( 'Repeat-x', 'bdthemes-prime-slider' ),
            'repeat-y'  => _x( 'Repeat-y', 'bdthemes-prime-slider' ),
        ],
            'selectors'   => [
            '{{WRAPPER}} ' . $class_name . '' => 'background-repeat: {{VALUE}};',
        ],
            'condition'   => [
            'background_image_toggle' => 'yes',
        ],
            'render_type' => 'ui',
        ] );
        $this->add_responsive_control( 'background_image_size', [
            'label'       => _x( 'Size', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SELECT,
            'default'     => '',
            'options'     => [
            ''        => _x( 'Default', 'bdthemes-prime-slider' ),
            'auto'    => _x( 'Auto', 'bdthemes-prime-slider' ),
            'cover'   => _x( 'Cover', 'bdthemes-prime-slider' ),
            'contain' => _x( 'Contain', 'bdthemes-prime-slider' ),
            'initial' => _x( 'Custom', 'bdthemes-prime-slider' ),
        ],
            'selectors'   => [
            '{{WRAPPER}} ' . $class_name . '' => 'background-size: {{VALUE}};',
        ],
            'condition'   => [
            'background_image_toggle' => 'yes',
        ],
            'render_type' => 'ui',
        ] );
        $this->add_responsive_control( 'background_image_width', [
            'label'       => _x( 'Width', 'bdthemes-prime-slider' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [
            'px',
            'em',
            '%',
            'vw'
        ],
            'range'       => [
            'px' => [
            'min' => 0,
            'max' => 1000,
        ],
            '%'  => [
            'min' => 0,
            'max' => 100,
        ],
            'vw' => [
            'min' => 0,
            'max' => 100,
        ],
        ],
            'default'     => [
            'size' => 100,
            'unit' => '%',
        ],
            'required'    => true,
            'selectors'   => [
            '{{WRAPPER}} ' . $class_name . '' => 'background-size: {{SIZE}}{{UNIT}} auto',
        ],
            'condition'   => [
            'background_image_size' => [ 'initial' ],
        ],
            'render_type' => 'ui',
        ] );
        $this->end_popover();
    }
    
    /**
     * Reveal Effect
     */
    public function reveal_effects_attr()
    {
        $settings = $this->get_settings_for_display();
        $reveal_effects = prime_slider_option( 'reveal-effects', 'prime_slider_other_settings', 'off' );
        //Reveal Effect
        
        if ( 'on' === $reveal_effects && 'yes' === $settings['reveal_effects_enable'] ) {
            $this->add_render_attribute( 'slider', 'class', 'reveal-active-' . $this->get_id() );
            $this->add_render_attribute( 'slideshow', 'data-reveal-enable', $settings['reveal_effects_enable'] );
            $this->add_render_attribute( [
                'slideshow' => [
                'data-reveal-settings' => [ wp_json_encode( [
                "bgColors"  => ( $settings["reveal_effects_color"] ? $settings["reveal_effects_color"] : "#333" ),
                "direction" => ( $settings['reveal_effects_direction'] ? $settings['reveal_effects_direction'] : 'lr' ),
                "duration"  => ( $settings['reveal_effects_speed']['size'] ? $settings['reveal_effects_speed']['size'] : 1000 ),
                "easing"    => $settings['reveal_effects_easing'],
            ] ) ],
            ],
            ] );
        }
    
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

}