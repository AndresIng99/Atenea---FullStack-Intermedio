<?php

namespace PrimeSlider\Base;

use PrimeSlider\Prime_Slider_Loader;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

abstract class Prime_Slider_Module_Base {

	/**
	 * @var \ReflectionClass
	 */
	private $reflection;

	private $components = [];

	/**
	 * @var Prime_Slider_Module_Base
	 */
	protected static $_instances = [];

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'bdthemes-prime-slider'), '1.0.0');
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'bdthemes-prime-slider'), '1.0.0');
	}

	public static function is_active() {
		return true;
	}

	public static function class_name() {
		return get_called_class();
	}

	/**
	 * @return static
	 */
	public static function instance() {
		if (empty(static::$_instances[static::class_name()])) {
			static::$_instances[static::class_name()] = new static();
		}

		return static::$_instances[static::class_name()];
	}

	abstract public function get_name();

	public function get_assets_url() {
		return BDTPS_MODULES_URL . $this->get_name() . '/assets/';
	}

	public function get_widgets() {
		return [];
	}

	public function __construct() {
		$this->reflection = new \ReflectionClass($this);

		add_action('elementor/widgets/register', [$this, 'init_widgets']);
	}

	public function init_widgets() {
		$widget_manager = Prime_Slider_Loader::elementor()->widgets_manager;

		foreach ($this->get_widgets() as $widget) {
			$class_name = $this->reflection->getNamespaceName() . '\Widgets\\' . $widget;
			$widget_manager->register(new $class_name());
		}
	}

	public function add_component($id, $instance) {
		$this->components[$id] = $instance;
	}

	public function get_component($id) {
		if (isset($this->components[$id])) {
			return $this->components[$id];
		}

		return false;
	}
}
