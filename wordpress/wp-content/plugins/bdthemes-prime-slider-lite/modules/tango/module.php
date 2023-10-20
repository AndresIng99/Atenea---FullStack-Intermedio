<?php
namespace PrimeSlider\Modules\Tango;

use PrimeSlider\Base\Prime_Slider_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Prime_Slider_Module_Base {

	public function get_name() {
		return 'tango';
	}

	public function get_widgets() {
		$widgets = [
			'Tango',
		];

		return $widgets;
	}
}
