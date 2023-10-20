<?php

namespace PrimeSlider\Modules\Isolate\Skins;

use  Elementor\Icons_Manager ;
use  Elementor\Skin_Base as Elementor_Skin_Base ;
use  PrimeSlider\Utils ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Skin_Locate extends Elementor_Skin_Base
{
    public function get_id()
    {
        return 'locate';
    }
    
    public function get_title()
    {
        return esc_html__( 'Locate', 'bdthemes-prime-slider' );
    }
    
    public function render_social_link( $position = 'right', $label = false, $class = array() )
    {
        $settings = $this->parent->get_active_settings();
        if ( '' == $settings['show_social_icon'] ) {
            return;
        }
        $this->parent->add_render_attribute( 'social-icon', 'class', 'bdt-prime-slider-social-icon reveal-muted' );
        $this->parent->add_render_attribute( 'social-icon', 'class', $class );
        ?>

			<div <?php 
        $this->parent->print_render_attribute_string( 'social-icon' );
        ?>>

				<?php 
        
        if ( $label ) {
            ?>
					<h3><?php 
            esc_html_e( 'Share Us', 'bdthemes-prime-slider' );
            ?></h3>
				<?php 
        }
        
        ?>

				<?php 
        foreach ( $settings['social_link_list'] as $link ) {
            $tooltip = ( 'yes' == $settings['social_icon_tooltip'] ? ' title="' . esc_attr( $link['social_link_title'] ) . '" bdt-tooltip="pos: ' . $position . '"' : '' );
            ?>

					<a href="<?php 
            echo  esc_url( $link['social_link'] ) ;
            ?>" target="_blank" <?php 
            echo  wp_kses_post( $tooltip ) ;
            ?>>
						<?php 
            Icons_Manager::render_icon( $link['social_icon'], [
                'aria-hidden' => 'true',
                'class'       => 'fa-fw',
            ] );
            ?>
					</a>
				<?php 
        }
        ?>
			</div>

		<?php 
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->parent->get_settings_for_display();
        $id = $this->parent->get_id();
        $is_rtl = ( is_rtl() ? 'dir="ltr"' : '' );
        ?>
            <?php 
        
        if ( $settings['show_navigation_arrows'] ) {
            ?>

                <div class="bdt-navigation-arrows reveal-muted">
                    <div id="<?php 
            echo  esc_attr( $id ) ;
            ?>_nav">
                        <div class="bdt-flex" <?php 
            echo  esc_attr( $is_rtl ) ;
            ?>>
                            <a class="bdt-prime-slider-previous" href="#" bdt-slideshow-item="previous">
                                <i class="ps-wi-arrow-left-5"></i>
                                <span class="bdt-slider-nav-text"><?php 
            esc_html_e( 'Prev', 'bdthemes-prime-slider' );
            ?></span>
                            </a>
                            <a class="bdt-prime-slider-next" href="#" bdt-slideshow-item="next">
                                <span class="bdt-slider-nav-text"><?php 
            esc_html_e( 'Next', 'bdthemes-prime-slider' );
            ?></span>
                                <i class="ps-wi-arrow-right-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

			<?php 
        }
        
        ?>
		<?php 
    }
    
    public function render_navigation_dots()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        <?php 
        
        if ( $settings['show_navigation_dots'] ) {
            ?>

            <ul class="bdt-ps-dotnav bdt-position-bottom-right reveal-muted">
                <?php 
            $slide_index = 1;
            foreach ( $settings['slides'] as $slide ) {
                ?>
                    <li bdt-slideshow-item="<?php 
                echo  $slide_index - 1 ;
                ?>" data-label="<?php 
                echo  str_pad(
                    $slide_index,
                    2,
                    '0',
                    STR_PAD_LEFT
                ) ;
                ?>" ><a href="#"><?php 
                echo  str_pad(
                    $slide_index,
                    2,
                    '0',
                    STR_PAD_LEFT
                ) ;
                ?></a></li>
                <?php 
                $slide_index++;
            }
            ?>

                <span><?php 
            echo  str_pad(
                $slide_index - 1,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?></span>
            </ul>

        <?php 
        }
        
        ?>

        <?php 
    }
    
    public function render_footer()
    {
        ?>

                </ul>

                <?php 
        $this->render_navigation_arrows();
        ?>
                <?php 
        $this->render_navigation_dots();
        ?>
                
            </div>
            <?php 
        $this->render_social_link();
        ?>
            <?php 
        $this->parent->render_scroll_button();
        ?>
        </div>
        <?php 
    }
    
    public function render_item_content( $slide_content )
    {
        $settings = $this->parent->get_settings_for_display();
        $parallax_button = $parallax_sub_title = $parallax_title = $parallax_inner_excerpt = $parallax_excerpt = '';
        
        if ( $settings['animation_parallax'] == 'yes' ) {
            $parallax_sub_title = 'data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0"';
            $parallax_title = ' data-bdt-slideshow-parallax="y: 75,0,-75; opacity: 1,1,0"';
            $parallax_excerpt = 'data-bdt-slideshow-parallax="y: 100,0,-80; opacity: 1,1,0"';
            $parallax_button = 'data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0"';
        }
        
        ?>
            <div class="bdt-slideshow-content-wrapper">
                <div class="bdt-prime-slider-wrapper">
                    <div class="bdt-prime-slider-content">
                        <div class="bdt-prime-slider-desc">

                            <?php 
        
        if ( $slide_content['sub_title'] && 'yes' == $settings['show_sub_title'] ) {
            ?>
                                <div class="bdt-sub-title bdt-ps-sub-title">
                                    <h4 data-reveal="reveal-active" <?php 
            echo  $parallax_sub_title ;
            ?>>
                                        <?php 
            echo  wp_kses_post( $slide_content['sub_title'] ) ;
            ?>
                                    </h4>
                                </div>
                            <?php 
        }
        
        ?>

                           <?php 
        
        if ( $slide_content['title'] && 'yes' == $settings['show_title'] ) {
            ?>
                                <div class="bdt-main-title">
                                    <<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> 
                                    class="bdt-title-tag" data-reveal="reveal-active" <?php 
            echo  $parallax_title ;
            ?>>
                                        <?php 
            
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
                                            <a href="<?php 
                echo  esc_url( $slide_content['title_link']['url'] ) ;
                ?>">
                                            <?php 
            }
            
            ?>
                                            <?php 
            echo  prime_slider_first_word( $slide_content['title'] ) ;
            ?>
                                            <?php 
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
                                            </a>
                                        <?php 
            }
            ?>
                                    </<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?>>
                                </div>
                            <?php 
        }
        
        ?>

                            <?php 
        
        if ( $slide_content['excerpt'] && 'yes' == $settings['show_excerpt'] ) {
            ?>
                                <div class="bdt-slider-excerpt" data-reveal="reveal-active" <?php 
            echo  $parallax_excerpt ;
            ?>>
                                    <?php 
            echo  wp_kses_post( $slide_content['excerpt'] ) ;
            ?>
                                </div>
                            <?php 
        }
        
        ?>

                            <div class="bdt-isolate-btn" data-reveal="reveal-active" <?php 
        echo  $parallax_button ;
        ?>>
                                <?php 
        $this->parent->render_button( $slide_content );
        ?>
							</div>
							
                        </div>

                    </div>
                </div>
            </div>

        <?php 
    }
    
    public function render_slides_loop()
    {
        $settings = $this->parent->get_settings_for_display();
        $kenburns_reverse = ( $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '' );
        foreach ( $settings['slides'] as $slide ) {
            ?>

            <li class="bdt-slideshow-item bdt-flex bdt-flex-column bdt-flex-middle elementor-repeater-item-<?php 
            echo  esc_attr( $slide['_id'] ) ;
            ?>">
                <div class="bdt-width-1-1 bdt-width-1-2@s">

                    <div class="bdt-position-relative bdt-slide-overlay" data-reveal="reveal-active">
                        <?php 
            
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
                            <div class="bdt-position-cover bdt-animation-kenburns<?php 
                echo  esc_attr( $kenburns_reverse ) ;
                ?> bdt-transform-origin-center-left">
                            <?php 
            }
            
            ?>
        
                                <?php 
            $this->parent->rendar_item_image( $slide );
            ?>
        
                            <?php 
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
                            </div>
                        <?php 
            }
            ?>
                    </div>

                </div>
                <div class="bdt-width-1-1 bdt-width-1-2@s">
                    <?php 
            $this->render_item_content( $slide );
            ?>
                </div>
            </li>

        <?php 
        }
    }
    
    public function render()
    {
        $skin_name = 'locate';
        $this->parent->render_header( $skin_name );
        $this->render_slides_loop();
        $this->render_footer();
    }

}