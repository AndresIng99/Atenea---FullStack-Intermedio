<?php
namespace PrimeSlider\Modules\Sequester;

use PrimeSlider\Base\Prime_Slider_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Prime_Slider_Module_Base {

	public function get_name() {
		return 'sequester';
	}

	public function get_widgets() {
		$widgets = [
			'Sequester',
		];

		return $widgets;
	}
}
