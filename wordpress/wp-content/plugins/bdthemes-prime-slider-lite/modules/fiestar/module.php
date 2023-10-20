<?php
namespace PrimeSlider\Modules\Fiestar;

use PrimeSlider\Base\Prime_Slider_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Prime_Slider_Module_Base {

	public function get_name() {
		return 'fiestar';
	}

	public function get_widgets() {
		$widgets = [
			'Fiestar',
		];

		return $widgets;
	}
}
