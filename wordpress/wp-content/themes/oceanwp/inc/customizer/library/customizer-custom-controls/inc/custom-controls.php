<?php

if ( ! function_exists( 'ow_esc_attr' ) ) {
	function ow_esc_attr( $text ) {
		if ( is_array( $text ) || is_object( $text ) ) {
			$text = is_string( current( $text ) ) ? current( $text ) : '';
		} elseif ( ! is_string( $text ) ) {
			$text = (string) $text;
		}

		return esc_attr( $text );
	}
}

/**
 * Skyrocket Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) && class_exists( 'WP_Customize_Section' ) ) {
	/**
	 * Custom Control Base Class
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Custom_Control extends WP_Customize_Control {
		protected function get_skyrocket_resource_url() {
			if ( strpos( wp_normalize_path( __DIR__ ), wp_normalize_path( WP_PLUGIN_DIR ) ) === 0 ) {
				// We're in a plugin directory and need to determine the url accordingly.
				return plugin_dir_url( __DIR__ );
			}

			return trailingslashit( get_template_directory_uri() );
		}
	}

	/**
	 * Custom Section Base Class
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Custom_Section extends WP_Customize_Section {
		protected function get_skyrocket_resource_url() {
			if ( strpos( wp_normalize_path( __DIR__ ), wp_normalize_path( WP_PLUGIN_DIR ) ) === 0 ) {
				// We're in a plugin directory and need to determine the url accordingly.
				return plugin_dir_url( __DIR__ );
			}

			return trailingslashit( get_template_directory_uri() );
		}
	}

	/**
	 * Image Checkbox Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Image_Checkbox_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'image_checkbox';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			ob_clean();
			?>
			<div class="image_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<?php	$chkboxValues = explode( ',', ow_esc_attr( $this->value() ) ); ?>
				<input type="hidden" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="checkbox-label">
						<input type="checkbox" name="<?php echo ow_esc_attr( $key ); ?>" value="<?php echo ow_esc_attr( $key ); ?>" <?php checked( in_array( ow_esc_attr( $key ), $chkboxValues ), 1 ); ?> class="multi-image-checkbox"/>
						<img src="<?php echo ow_esc_attr( $value['image'] ); ?>" alt="<?php echo ow_esc_attr( $value['name'] ); ?>" title="<?php echo ow_esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
			<?php
		}
	}

	/**
	 * Text Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Customizer_Buttonset_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'text_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="text_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>

				<div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( ow_esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_html( $value ); ?></span>
						</label>
					<?php	} ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Image Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Customizer_Radio_Image_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'image_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="image_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<?php
					if ( ! is_array( $value ) ) {
						$value = array(
							'image' => $value,
							'name'  => '',
						);
					} else {
						$value = array(
							'image' => isset( $value['image'] ) ? $value['image'] : '',
							'name'  => isset( $value['name'] ) ? $value['name'] : '',
						);
					}

					?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( ow_esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_url( $value['image'] ); ?>" alt="<?php echo ow_esc_attr( $value['name'] ); ?>" title="<?php echo ow_esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
			<?php
		}
	}

	/**
	 * Single Accordion Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Single_Accordion_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'single_accordion';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'class'  => array(),
					'target' => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'i'      => array(
					'class' => array(),
				),
			);
			?>
			<div class="single-accordion-custom-control">
				<div class="single-accordion-toggle"><?php echo esc_html( $this->label ); ?><span class="accordion-icon-toggle dashicons dashicons-plus"></span></div>
				<div class="single-accordion customize-control-description">
					<?php
					if ( is_array( $this->description ) ) {
						echo '<ul class="single-accordion-description">';
						foreach ( $this->description as $key => $value ) {
							echo '<li>' . $key . wp_kses( $value, $allowed_html ) . '</li>';
						}
						echo '</ul>';
					} else {
						echo wp_kses( $this->description, $allowed_html );
					}
					?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Simple Notice Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Simple_Notice_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'simple_notice';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'class'  => array(),
					'target' => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'i'      => array(
					'class' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
				'code'   => array(),
			);
			?>
			<div class="simple-notice-custom-control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Slider Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Customizer_Range_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="slider-custom-control control-wrap customize-control-oceanwp-slider">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider oceanwp-slider" slider-min-value="<?php echo ow_esc_attr( @$this->input_attrs['min'] ); ?>" slider-max-value="<?php echo ow_esc_attr( @$this->input_attrs['max'] ); ?>" slider-step-value="<?php echo ow_esc_attr( @$this->input_attrs['step'] ); ?>"></div>
			</div>
			<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Toggle_Switch_Custom_control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toggle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo ow_esc_attr( $this->value() ); ?>"
														  <?php
															$this->link();
															checked( $this->value() );
															?>
					>
					<label class="toggle-switch-label" for="<?php echo ow_esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Sortable Repeater Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Sortable_Repeater_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'sortable_repeater';
		/**
		 * Button labels
		 */
		public $button_labels = array();
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args(
				$this->button_labels,
				array(
					'add' => __( 'Add', 'oceanwp' ),
				)
			);
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
		  <div class="sortable_repeater_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable_repeater sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo $this->button_labels['add']; ?></button>
			</div>
			<?php
		}
	}

	/**
	 * Dropdown Select2 Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Dropdown_Select2_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'dropdown_select2';
		/**
		 * The type of Select2 Dropwdown to display. Can be either a single select dropdown or a multi-select dropdown. Either false for true. Default = false
		 */
		private $multiselect = false;
		/**
		 * The Placeholder value to display. Select2 requires a Placeholder value to be set when using the clearall option. Default = 'Please select...'
		 */
		private $placeholder = 'Please select...';
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Check if this is a multi-select field
			if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
				$this->multiselect = true;
			}
			// Check if a placeholder string has been specified
			if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
				$this->placeholder = $this->input_attrs['placeholder'];
			}
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-select2-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'skyrocket-select2-js' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'skyrocket-select2-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/select2.min.css', array(), '4.0.13', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$defaultValue = $this->value();
			if ( $this->multiselect ) {
				$defaultValue = explode( ',', $this->value() );
			}
			?>
			<div class="dropdown_select2_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<label for="<?php echo ow_esc_attr( $this->id ); ?>" class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</label>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo ow_esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo ow_esc_attr( $this->value() ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" <?php $this->link(); ?> />
				<select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="customize-control-select2" data-placeholder="<?php echo $this->placeholder; ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
					<?php
					if ( ! $this->multiselect ) {
						// When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work (multi-selects dont need this)
						echo '<option></option>';
					}
					foreach ( $this->choices as $key => $value ) {
						if ( is_array( $value ) ) {
							echo '<optgroup label="' . ow_esc_attr( $key ) . '">';
							foreach ( $value as $optgroupkey => $optgroupvalue ) {
								if ( $this->multiselect ) {
									echo '<option value="' . ow_esc_attr( $optgroupkey ) . '" ' . ( in_array( ow_esc_attr( $optgroupkey ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . ow_esc_attr( $optgroupvalue ) . '</option>';
								} else {
									echo '<option value="' . ow_esc_attr( $optgroupkey ) . '" ' . selected( ow_esc_attr( $optgroupkey ), $defaultValue, false ) . '>' . ow_esc_attr( $optgroupvalue ) . '</option>';
								}
							}
							echo '</optgroup>';
						} else {
							if ( $this->multiselect ) {
								echo '<option value="' . ow_esc_attr( $key ) . '" ' . ( in_array( ow_esc_attr( $key ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . ow_esc_attr( $value ) . '</option>';
							} else {
								echo '<option value="' . ow_esc_attr( $key ) . '" ' . selected( ow_esc_attr( $key ), $defaultValue, false ) . '>' . ow_esc_attr( $value ) . '</option>';
							}
						}
					}
					?>
				</select>
			</div>
			<?php
		}
	}

	/**
	 * Dropdown Posts Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Dropdown_Posts_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'dropdown_posts';
		/**
		 * Posts
		 */
		private $posts = array();
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get our Posts
			$this->posts = get_posts( $this->input_attrs );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="dropdown_posts_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<label for="<?php echo ow_esc_attr( $this->id ); ?>" class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</label>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" <?php $this->link(); ?>>
					<?php
					if ( ! empty( $this->posts ) ) {
						foreach ( $this->posts as $post ) {
							printf(
								'<option value="%s" %s>%s</option>',
								$post->ID,
								selected( $this->value(), $post->ID, false ),
								$post->post_title
							);
						}
					}
					?>
				</select>
			</div>
			<?php
		}
	}

	/**
	 * TinyMCE Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_TinyMCE_Custom_control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'tinymce_editor';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
			wp_enqueue_editor();
		}
		/**
		 * Pass our TinyMCE toolbar string to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrockettinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? ow_esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
			$this->json['skyrockettinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? ow_esc_attr( $this->input_attrs['toolbar2'] ) : '';
			$this->json['skyrocketmediabuttons']    = isset( $this->input_attrs['mediaButtons'] ) && ( $this->input_attrs['mediaButtons'] === true ) ? true : false;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<textarea id="<?php echo ow_esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
			</div>
			<?php
		}
	}

	/**
	 * Google Font Select Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Google_Font_Select_Custom_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'google_fonts';
		/**
		 * The list of Google Fonts
		 */
		private $fontList = false;
		/**
		 * The saved font values decoded from json
		 */
		private $fontValues = array();
		/**
		 * The index of the saved font within the list of Google fonts
		 */
		private $fontListIndex = 0;
		/**
		 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
		 */
		private $fontCount = 'all';
		/**
		 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
		 */
		private $fontOrderBy = 'alpha';
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get the font sort order
			if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
				$this->fontOrderBy = 'popular';
			}
			// Get the list of Google fonts
			if ( isset( $this->input_attrs['font_count'] ) ) {
				if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
					$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
				}
			}
			$this->fontList = $this->skyrocket_getGoogleFonts( 'all' );
			// Decode the default json font value
			$this->fontValues = json_decode( $this->value() );
			// Find the index of our default font within our list of Google fonts
			$this->fontListIndex = $this->skyrocket_getFontIndex( $this->fontList, $this->fontValues->font );
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-select2-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'skyrocket-select2-js' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'skyrocket-select2-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/select2.min.css', array(), '4.0.13', 'all' );
		}
		/**
		 * Export our List of Google Fonts to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrocketfontslist'] = $this->fontList;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$fontCounter  = 0;
			$isFontInList = false;
			$fontListStr  = '';

			if ( ! empty( $this->fontList ) ) {
				?>
				<div class="google_fonts_select_control">
					<?php if ( ! empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<?php if ( ! empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
					<?php } ?>
					<input type="hidden" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
					<div class="google-fonts">
						<select class="google-fonts-list" control-name="<?php echo ow_esc_attr( $this->id ); ?>">
							<?php
							foreach ( $this->fontList as $key => $value ) {
								$fontCounter++;
								$fontListStr .= '<option value="' . $value->family . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . $value->family . '</option>';
								if ( $this->fontValues->font === $value->family ) {
									$isFontInList = true;
								}
								if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
									break;
								}
							}
							if ( ! $isFontInList && $this->fontListIndex ) {
								// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
								$fontListStr = '<option value="' . $this->fontList[ $this->fontListIndex ]->family . '" ' . selected( $this->fontValues->font, $this->fontList[ $this->fontListIndex ]->family, false ) . '>' . $this->fontList[ $this->fontListIndex ]->family . ' (default)</option>' . $fontListStr;
							}
								// Display our list of font options
								echo $fontListStr;
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight & style for regular text', 'oceanwp' ); ?></div>
					<div class="weight-style">
						<select class="google-fonts-regularweight-style">
							<?php
							foreach ( $this->fontList[ $this->fontListIndex ]->variants as $key => $value ) {
								echo '<option value="' . $value . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . $value . '</option>';
							}
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight for', 'oceanwp' ); ?> <italic><?php esc_html_e( 'italic text', 'oceanwp' ); ?></italic></div>
					<div class="weight-style">
						<select class="google-fonts-italicweight-style" <?php disabled( in_array( 'italic', $this->fontList[ $this->fontListIndex ]->variants ), false ); ?>>
							<?php
								$optionCount = 0;
							foreach ( $this->fontList[ $this->fontListIndex ]->variants as $key => $value ) {
								// Only add options that are italic
								if ( strpos( $value, 'italic' ) !== false ) {
									echo '<option value="' . $value . '" ' . selected( $this->fontValues->italicweight, $value, false ) . '>' . $value . '</option>';
									$optionCount++;
								}
							}
							if ( $optionCount == 0 ) {
								echo '<option value="">Not Available for this font</option>';
							}
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight for', 'oceanwp' ); ?> <strong><?php esc_html_e( 'bold text', 'oceanwp' ); ?></strong></div>
					<div class="weight-style">
						<select class="google-fonts-boldweight-style">
							<?php
								$optionCount = 0;
							foreach ( $this->fontList[ $this->fontListIndex ]->variants as $key => $value ) {
								// Only add options that aren't italic
								if ( strpos( $value, 'italic' ) === false ) {
									echo '<option value="' . $value . '" ' . selected( $this->fontValues->boldweight, $value, false ) . '>' . $value . '</option>';
									$optionCount++;
								}
							}
								// This should never evaluate as there'll always be at least a 'regular' weight
							if ( $optionCount == 0 ) {
								echo '<option value="">Not Available for this font</option>';
							}
							?>
						</select>
					</div>
					<input type="hidden" class="google-fonts-category" value="<?php echo $this->fontValues->category; ?>">
				</div>
				<?php
			}
		}

		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function skyrocket_getFontIndex( $haystack, $needle ) {
			foreach ( $haystack as $key => $value ) {
				if ( $value->family == $needle ) {
					return $key;
				}
			}
			return false;
		}

		/**
		 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
		 */
		public function skyrocket_getGoogleFonts( $count = 30 ) {
			// Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY
			$fontFile = OCEANWP_INC_DIR_URI . 'customizer/assets/inc/google-fonts-alphabetical.json';
			if ( $this->fontOrderBy === 'popular' ) {
				$fontFile = OCEANWP_INC_DIR_URI . 'customizer/assets/inc/google-fonts-popularity.json';
			}

			$request = wp_remote_get( $fontFile );
			if ( is_wp_error( $request ) ) {
				return '';
			}

			$body    = wp_remote_retrieve_body( $request );
			$content = json_decode( $body );

			if ( $count == 'all' ) {
				return $content->items;
			} else {
				return array_slice( $content->items, 0, $count );
			}
		}
	}

	/**
	 * Alpha Color Picker Custom Control
	 *
	 * @author Braad Martin <http://braadmartin.com>
	 * @license http://www.gnu.org/licenses/gpl-3.0.html
	 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
	 */
	class OceanWP_Customizer_Color_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'alpha-color';
		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 */
		public $palette = array();
		/**
		 * Add support for showing the opacity value on the slider handle.
		 */
		public $show_opacity = true;
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array( 'wp-color-picker' ), '1.0', 'all' );
			wp_localize_script( 'skyrocket-custom-controls-js', 'oceanwpLocalize', array( 'colorPalettes' => oceanwp_default_color_palettes() ) );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			// Process the palette
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean. Default to true.
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			?>
				<label>
					<?php
					// Output the label and description if they were passed in.
					if ( isset( $this->label ) && '' !== $this->label ) {
						echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
					}
					if ( isset( $this->description ) && '' !== $this->description ) {
						echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
					}
					?>
				</label>
				<input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo ow_esc_attr( $palette ); ?>" data-default-color="<?php echo ow_esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
			<?php
		}
	}

	/**
	 * WPColorPicker Alpha Color Picker Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 *
	 * Props @kallookoo for WPColorPicker script with Alpha Channel support
	 *
	 * @author Sergio <https://github.com/kallookoo>
	 * @license http://www.gnu.org/licenses/gpl-3.0.html
	 * @link https://github.com/kallookoo/wp-color-picker-alpha
	 */
	class OceanWP_Alpha_Color_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'wpcolorpicker-alpha-color';
		/**
		 * ColorPicker Attributes
		 */
		public $attributes = '';
		/**
		 * Color palette defaults
		 */
		public $defaultPalette = array(
			'#000000',
			'#ffffff',
			'#dd3333',
			'#dd9933',
			'#eeee22',
			'#81d742',
			'#1e73be',
			'#8224e3',
		);
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->attributes .= 'data-default-color="' . ow_esc_attr( $this->value() ) . '"';
			$this->attributes .= 'data-alpha="true"';
			$this->attributes .= 'data-reset-alpha="' . ( isset( $this->input_attrs['resetalpha'] ) ? $this->input_attrs['resetalpha'] : 'true' ) . '"';
			$this->attributes .= 'data-custom-width="0"';
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
			wp_enqueue_script( 'wp-color-picker-alpha', OCEANWP_INC_DIR_URI . 'customizer/assets/js/wp-color-picker-alpha-min.js', array( 'wp-color-picker' ), '1.0', true );
			wp_enqueue_style( 'wp-color-picker' );
		}
		/**
		 * Pass our Palette colours to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['colorpickerpalette'] = isset( $this->input_attrs['palette'] ) ? $this->input_attrs['palette'] : $this->defaultPalette;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
		  <div class="wpcolorpicker_alpha_color_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<input type="text" class="wpcolorpicker-alpha-color-picker" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-colorpicker-alpha-color" <?php echo $this->attributes; ?> <?php $this->link(); ?> />
			</div>
			<?php
		}
	}

	/**
	 * Sortable Pill Checkbox Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Customize_Multicheck_Control extends OceanWP_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'pill_checkbox';
		/**
		 * Define whether the pills can be sorted using drag 'n drop. Either false or true. Default = false
		 */
		private $sortable = false;
		/**
		 * The width of the pills. Each pill can be auto width or full width. Default = false
		 */
		private $fullwidth = false;
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Check if these pills are sortable
			if ( isset( $this->input_attrs['sortable'] ) && $this->input_attrs['sortable'] ) {
				$this->sortable = true;
			}
			// Check if the pills should be full width
			if ( isset( $this->input_attrs['fullwidth'] ) && $this->input_attrs['fullwidth'] ) {
				$this->fullwidth = true;
			}
		}       /**
				 * Enqueue our scripts and styles
				 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.1', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$reordered_choices = array();

			$value = is_array( $this->value() ) ? array_map( 'ow_esc_attr', $this->value() ) : ow_esc_attr( $this->value() );
			$saved_choices = ! is_array( $value ) ? explode( ',', $value ) : $value;

			// Order the checkbox choices based on the saved order
			if ( $this->sortable ) {
				foreach ( $saved_choices as $key => $value ) {
					if ( isset( $this->choices[ $value ] ) ) {
						$reordered_choices[ $value ] = $this->choices[ $value ];
					}
				}
				$reordered_choices = array_merge( $reordered_choices, array_diff_assoc( $this->choices, $reordered_choices ) );
			} else {
				$reordered_choices = $this->choices;
			}
			?>
			<div class="pill_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo ow_esc_attr( $this->id ); ?>" name="<?php echo ow_esc_attr( $this->id ); ?>" value="<?php echo ow_esc_attr( $this->value() ); ?>" class="customize-control-sortable-pill-checkbox" <?php $this->link(); ?> />
				<div class="sortable_pills<?php echo ( $this->sortable ? ' sortable' : '' ) . ( $this->fullwidth ? ' fullwidth_pills' : '' ); ?>">
				<?php foreach ( $reordered_choices as $key => $value ) { ?>
					<label class="checkbox-label">
						<input type="checkbox" name="<?php echo ow_esc_attr( $key ); ?>" value="<?php echo ow_esc_attr( $key ); ?>" <?php checked( in_array( ow_esc_attr( $key ), $saved_choices, true ), true ); ?> class="sortable-pill-checkbox"/>
						<span class="sortable-pill-title"><?php echo ow_esc_attr( $value ); ?></span>
						<?php if ( $this->sortable && $this->fullwidth ) { ?>
							<span class="dashicons dashicons-sort"></span>
						<?php } ?>
					</label>
				<?php	} ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Upsell section
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class OceanWP_Upsell_Section extends OceanWP_Custom_Section {
		/**
		 * The type of control being rendered
		 */
		public $type = 'skyrocket-upsell';
		/**
		 * The Upsell URL
		 */
		public $url = '';
		/**
		 * The background color for the control
		 */
		public $backgroundcolor = '';
		/**
		 * The text color for the control
		 */
		public $textcolor = '';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', OCEANWP_INC_DIR_URI . 'customizer/assets/js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', OCEANWP_INC_DIR_URI . 'customizer/assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the section, and the controls that have been added to it.
		 */
		protected function render() {
			$bkgrndcolor = ! empty( $this->backgroundcolor ) ? ow_esc_attr( $this->backgroundcolor ) : '#fff';
			$color       = ! empty( $this->textcolor ) ? ow_esc_attr( $this->textcolor ) : '#555d66';
			?>
			<li id="accordion-section-<?php echo ow_esc_attr( $this->id ); ?>" class="skyrocket_upsell_section accordion-section control-section control-section-<?php echo ow_esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="upsell-section-title" <?php echo ' style="color:' . $color . ';border-left-color:' . $bkgrndcolor . ';border-right-color:' . $bkgrndcolor . ';"'; ?>>
					<a href="<?php echo esc_url( $this->url ); ?>" target="_blank"<?php echo ' style="background-color:' . $bkgrndcolor . ';color:' . $color . ';"'; ?>><?php echo esc_html( $this->title ); ?></a>
				</h3>
			</li>
			<?php
		}
	}

	/**
	 * URL sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single url or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_url_sanitization' ) ) {
		function skyrocket_url_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = esc_url_raw( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = esc_url_raw( $input );
			}
			return $input;
		}
	}

	/**
	 * Switch sanitization
	 *
	 * @param  string       Switch value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'skyrocket_switch_sanitization' ) ) {
		function skyrocket_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Radio Button and Select sanitization
	 *
	 * @param  string       Radio Button value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'skyrocket_radio_sanitization' ) ) {
		function skyrocket_radio_sanitization( $input, $setting ) {
			// get the list of possible radio box or select options
			$choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}

	/**
	 * Integer sanitization
	 *
	 * @param  string       Input value to check
	 * @return integer  Returned integer value
	 */
	if ( ! function_exists( 'skyrocket_sanitize_integer' ) ) {
		function skyrocket_sanitize_integer( $input ) {
			return (int) $input;
		}
	}

	/**
	 * Text sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_text_sanitization' ) ) {
		function skyrocket_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Array sanitization
	 *
	 * @param  array    Input to be sanitized
	 * @return array    Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_array_sanitization' ) ) {
		function skyrocket_array_sanitization( $input ) {
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
			} else {
				$input = '';
			}
			return $input;
		}
	}

	/**
	 * Alpha Color (Hex, RGB & RGBa) sanitization
	 *
	 * @param  string   Input to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_hex_rgba_sanitization' ) ) {
		function skyrocket_hex_rgba_sanitization( $input, $setting ) {
			if ( empty( $input ) || is_array( $input ) ) {
				return $setting->default;
			}

			if ( false === strpos( $input, 'rgb' ) ) {
				// If string doesn't start with 'rgb' then santize as hex color
				$input = sanitize_hex_color( $input );
			} else {
				if ( false === strpos( $input, 'rgba' ) ) {
					// Sanitize as RGB color
					$input = str_replace( ' ', '', $input );
					sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
					$input = 'rgb(' . skyrocket_in_range( $red, 0, 255 ) . ',' . skyrocket_in_range( $green, 0, 255 ) . ',' . skyrocket_in_range( $blue, 0, 255 ) . ')';
				} else {
					// Sanitize as RGBa color
					$input = str_replace( ' ', '', $input );
					sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
					$input = 'rgba(' . skyrocket_in_range( $red, 0, 255 ) . ',' . skyrocket_in_range( $green, 0, 255 ) . ',' . skyrocket_in_range( $blue, 0, 255 ) . ',' . skyrocket_in_range( $alpha, 0, 1 ) . ')';
				}
			}
			return $input;
		}
	}

	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number   Input to be sanitized
	 * @return number   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_in_range' ) ) {
		function skyrocket_in_range( $input, $min, $max ) {
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
			return $input;
		}
	}

	/**
	 * Google Font sanitization
	 *
	 * @param  string   JSON string to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_google_font_sanitization' ) ) {
		function skyrocket_google_font_sanitization( $input ) {
			$val = json_decode( $input, true );
			if ( is_array( $val ) ) {
				foreach ( $val as $key => $value ) {
					$val[ $key ] = sanitize_text_field( $value );
				}
				$input = json_encode( $val );
			} else {
				$input = json_encode( sanitize_text_field( $val ) );
			}
			return $input;
		}
	}

	/**
	 * Date Time sanitization
	 *
	 * @param  string   Date/Time string to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_date_time_sanitization' ) ) {
		function skyrocket_date_time_sanitization( $input, $setting ) {
			$datetimeformat = 'Y-m-d';
			if ( $setting->manager->get_control( $setting->id )->include_time ) {
				$datetimeformat = 'Y-m-d H:i:s';
			}
			$date = DateTime::createFromFormat( $datetimeformat, $input );
			if ( $date === false ) {
				$date = DateTime::createFromFormat( $datetimeformat, $setting->default );
			}
			return $date->format( $datetimeformat );
		}
	}

	/**
	 * Slider sanitization
	 *
	 * @param  string   Slider value to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_range_sanitization' ) ) {
		function skyrocket_range_sanitization( $input, $setting ) {
			$attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			$min  = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
			$max  = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
			$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );

			$number = floor( $input / $attrs['step'] ) * $attrs['step'];

			return skyrocket_in_range( $number, $min, $max );
		}
	}
}
