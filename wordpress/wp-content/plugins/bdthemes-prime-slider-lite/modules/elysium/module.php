<?php
namespace PrimeSlider\Modules\Elysium;

use PrimeSlider\Base\Prime_Slider_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Prime_Slider_Module_Base {

	public function get_name() {
		return 'elysium';
	}

	public function get_widgets() {
		$widgets = [
			'Elysium',
		];

		return $widgets;
	}
}
