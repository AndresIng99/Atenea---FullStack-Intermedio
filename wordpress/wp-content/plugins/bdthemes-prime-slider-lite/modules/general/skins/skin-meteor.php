<?php

namespace PrimeSlider\Modules\General\Skins;

use  Elementor\Skin_Base as Elementor_Skin_Base ;
use  Elementor\Group_Control_Image_Size ;
use  PrimeSlider\Utils ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Skin_Meteor extends Elementor_Skin_Base
{
    private  $total_slides = 1 ;
    public function get_id()
    {
        return 'meteor';
    }
    
    public function get_title()
    {
        return esc_html__( 'Meteor', 'bdthemes-prime-slider' );
    }
    
    public function render_navigation_dots()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        <?php 
        if ( $settings['show_navigation_dots'] ) {
            ?>

            <ul class="bdt-slideshow-nav bdt-dotnav bdt-dotnav-vertical bdt-margin-large-right bdt-position-center-right reveal-muted"></ul>

        <?php 
        }
        ?>

        <?php 
    }
    
    public function rendar_item_image( $image, $alt = '' )
    {
        $image_src = wp_get_attachment_image_src( $image['image']['id'], 'thumbnail' );
        
        if ( $image_src ) {
            ?>
        <img src="<?php 
            echo  esc_url( $image_src[0] ) ;
            ?>" alt="<?php 
            echo  esc_html( $image['title'] ) ;
            ?>" bdt-cover>
        <?php 
        }
        
        return 0;
    }
    
    public function render_footer()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        </ul>

                <?php 
        $this->render_navigation_dots();
        ?>

                    <div class="bdt-prime-slider-footer-content bdt-height-small bdt-flex-middle bdt-position-bottom-right" bdt-grid>
                        <div class="bdt-width-1-6">
                            <?php 
        $this->parent->render_scroll_button();
        ?>
                        </div>
                        <div class="bdt-width-1-6">
                            <div class="bdt-slide-thumbnav-img bdt-height-small">
                                <?php 
        $slide_index = 1;
        foreach ( $settings['slides'] as $slide ) {
            ?>
                                    <li bdt-slideshow-item="<?php 
            echo  ( $slide_index - 2 == -1 ? $this->total_slides - 2 : $slide_index - 2 ) ;
            ?>" data-label="<?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?>">

                                        <?php 
            
            if ( $slide['background'] == 'image' && $slide['image'] ) {
                ?>
                                            <?php 
                $this->rendar_item_image( $slide, $slide['title'] );
                ?>
                                        <?php 
            } elseif ( $slide['background'] == 'video' && $slide['video_link'] ) {
                ?>
                                            <?php 
                $this->parent->rendar_item_video( $slide );
                ?>
                                        <?php 
            } elseif ( $slide['background'] == 'youtube' && $slide['youtube_link'] ) {
                ?>
                                            <?php 
                $this->parent->rendar_item_youtube( $slide );
                ?>
                                        <?php 
            }
            
            ?>

                                    </li>
                                <?php 
            $slide_index++;
        }
        ?>
                            </div>
                        </div>
                        <div class="bdt-width-expand bdt-social-background bdt-height-small">
                            <ul class="bdt-ps-meta">
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
            ?>">

                                        <?php 
            
            if ( $slide['excerpt'] && 'yes' == $settings['show_excerpt'] ) {
                ?>
                                            <div class="bdt-slider-excerpt bdt-column-1-2" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 300,0,-100; opacity: 1,1,0">
                                                <?php 
                echo  wp_kses_post( $slide['excerpt'] ) ;
                ?>
                                            </div>
                                        <?php 
            }
            
            ?>

                                    </li>
                                <?php 
            $slide_index++;
        }
        ?>

                            </ul>
                        </div>
                        <div class="bdt-width-1-6 bdt-flex bdt-flex-middle bdt-flex-center bdt-height-small  bdt-social-bg-color bdt-padding-remove">
                            <?php 
        $this->parent->render_social_link( 'top' );
        ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php 
    }
    
    public function render_item_content( $slide_content )
    {
        $settings = $this->parent->get_settings_for_display();
        $this->parent->add_render_attribute(
            [
            'title-link' => [
            'class'  => [ 'bdt-slider-title-link' ],
            'href'   => ( $slide_content['title_link']['url'] ? esc_url( $slide_content['title_link']['url'] ) : 'javascript:void(0);' ),
            'target' => ( $slide_content['title_link']['is_external'] ? '_blank' : '_self' ),
        ],
        ],
            '',
            '',
            true
        );
        $parallax_sub_title = 'data-bdt-slideshow-parallax="x: 300,0,-100; opacity: 1,1,0"';
        $parallax_title = 'data-bdt-slideshow-parallax="x: 500,0,-100; opacity: 1,1,0"';
        $parallax_excerpt = 'data-bdt-slideshow-parallax="y: 200,0,-100; opacity: 1,1,0"';
        ?>
        <div class="bdt-prime-slider-container">
            <div class="bdt-slideshow-content-wrapper bdt-position-z-index">
                <div class="bdt-prime-slider-wrapper">
                    <div class="bdt-prime-slider-content">
                        <div class="bdt-prime-slider-desc">

                            <?php 
        
        if ( $slide_content['sub_title'] && 'yes' == $settings['show_sub_title'] ) {
            ?>
                                <div class="bdt-sub-title bdt-ps-sub-title">
                                    <h4 <?php 
            echo  $parallax_sub_title ;
            ?> data-reveal="reveal-active">
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
                                <div class="bdt-main-title"  <?php 
            echo  $parallax_title ;
            ?> data-reveal="reveal-active">
                                    <<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-title-tag">
                                        <?php 
            
            if ( '' !== $slide_content['title_link']['url'] ) {
                ?>
                                            <a <?php 
                $this->parent->print_render_attribute_string( 'title-link' );
                ?>>
                                        <?php 
            }
            
            ?>
                                            <?php 
            echo  wp_kses_post( $slide_content['title'] ) ;
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

                            <div data-bdt-slideshow-parallax="x: 700,0,-100; opacity: 1,1,0">

                                <?php 
        $this->parent->render_button( $slide_content );
        ?>

                            </div>
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

            <li class="bdt-slideshow-item bdt-flex bdt-flex-middle elementor-repeater-item-<?php 
            echo  esc_attr( $slide['_id'] ) ;
            ?>">
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
            
            if ( $slide['background'] == 'image' && $slide['image'] ) {
                ?>
                        <?php 
                $this->parent->rendar_item_image( $slide, $slide['title'] );
                ?>
                    <?php 
            } elseif ( $slide['background'] == 'video' && $slide['video_link'] ) {
                ?>
                        <?php 
                $this->parent->rendar_item_video( $slide );
                ?>
                    <?php 
            } elseif ( $slide['background'] == 'youtube' && $slide['youtube_link'] ) {
                ?>
                        <?php 
                $this->parent->rendar_item_youtube( $slide );
                ?>
                    <?php 
            }
            
            ?>

                    <?php 
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
                    </div>
                <?php 
            }
            ?>

                <?php 
            
            if ( 'none' !== $settings['overlay'] ) {
                $blend_type = ( 'blend' == $settings['overlay'] ? ' bdt-blend-' . $settings['blend_type'] : '' );
                ?>
                    <div class="bdt-overlay-default bdt-position-cover<?php 
                echo  esc_attr( $blend_type ) ;
                ?>"></div>
                <?php 
            }
            
            ?>

                <?php 
            $this->render_item_content( $slide );
            ?>
            </li>

        <?php 
            $this->total_slides++;
        }
    }
    
    public function render()
    {
        $skin_name = 'meteor';
        $this->parent->render_header( $skin_name );
        $this->render_slides_loop();
        $this->render_footer();
    }

}