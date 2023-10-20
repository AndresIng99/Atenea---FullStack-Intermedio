<?php
namespace PrimeSlider\Modules\Pacific;

use PrimeSlider\Base\Prime_Slider_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Prime_Slider_Module_Base {

	public function get_name() {
		return 'pacific';
	}

	public function get_widgets() {
		$widgets = [
			'Pacific',
		];

		return $widgets;
	}
}
