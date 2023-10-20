<?php

namespace PrimeSlider\Modules\Blog\Skins;

use  PrimeSlider\Utils ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Skin_Base as Elementor_Skin_Base ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Skin_Coral extends Elementor_Skin_Base
{
    public function get_id()
    {
        return 'coral';
    }
    
    public function get_title()
    {
        return esc_html__( 'Coral', 'bdthemes-prime-slider' );
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        <?php 
        if ( $settings['show_navigation_arrows'] ) {
            ?>
        <div class="bdt-navigation-arrows bdt-position-center-right reveal-muted">
          <a class="bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
          <a class="bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
        </div>
        <?php 
        }
        ?>

      <div class="bdt-ps-thumbnav reveal-muted">

          <?php 
        $total_slide = 1;
        $wp_query = $this->parent->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            $total_slide++;
        }
        wp_reset_postdata();
        $slide_index = 1;
        $wp_query = $this->parent->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            ?>

            <li class="bdt-slide-counter" bdt-slideshow-item="<?php 
            echo  ( $slide_index - 2 == -1 ? $total_slide - 2 : $slide_index - 2 ) ;
            ?>"
                data-label="<?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?>">
                <?php 
            $this->rendar_item_image();
            ?>
                <?php 
            $slide_index++;
            ?>
            </li>

              <?php 
        }
        wp_reset_postdata();
        ?>

      </div>
        <?php 
    }
    
    public function render_navigation_dots()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        <?php 
        if ( $settings['show_navigation_dots'] ) {
            ?>

        <ul class="bdt-slideshow-nav bdt-dotnav bdt-dotnav-vertical bdt-position-center-left reveal-muted"></ul>

        <?php 
        }
        ?>

      <ul class="bdt-ps-dotnav bdt-position-center-right reveal-muted">
          <?php 
        $slide_index = 1;
        $wp_query = $this->parent->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            ?>

            <li bdt-slideshow-item="<?php 
            echo  $slide_index - 1 ;
            ?>"
                data-label="<?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?>"><a
                  href="#"><?php 
            echo  str_pad(
                $slide_index,
                2,
                '0',
                STR_PAD_LEFT
            ) ;
            ?></a>

                <?php 
            $slide_index++;
            ?>

            </li>

              <?php 
        }
        wp_reset_postdata();
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
    
    public function render_scroll_button_text()
    {
        $settings = $this->parent->get_settings_for_display();
        $this->parent->add_render_attribute( 'content-wrapper', 'class', 'bdt-scroll-down-content-wrapper' );
        $this->parent->add_render_attribute( 'text', 'class', 'bdt-scroll-down-text' );
        ?>
      <span
          bdt-scrollspy="cls: bdt-animation-slide-right; repeat: true" <?php 
        $this->parent->print_render_attribute_string( 'content-wrapper' );
        ?>>
            <span class="bdt-scroll-icon">
              <span bdt-icon="icon: chevron-down" class="bdt-icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="chevron-down"><polyline fill="none" stroke="#000" stroke-width="1.03" points="16 7 10 13 4 7"></polyline></svg></span>
                <!-- <span class="bdt-icon" bdt-icon="icon:arrow-down"></span> -->
            </span>
            <span <?php 
        $this->parent->print_render_attribute_string( 'text' );
        ?>><?php 
        echo  esc_html( $settings['scroll_button_text'] ) ;
        ?></span>
        </span>
        <?php 
    }
    
    public function render_scroll_button()
    {
        $settings = $this->parent->get_settings_for_display();
        $this->parent->add_render_attribute( 'bdt-scroll-down', 'class', [ 'bdt-scroll-down reveal-muted' ] );
        if ( '' == $settings['show_scroll_button'] ) {
            return;
        }
        $this->parent->add_render_attribute( [
            'bdt-scroll-down' => [
            'data-settings' => [ wp_json_encode( array_filter( [
            'duration' => ( '' != $settings['duration']['size'] ? $settings['duration']['size'] : '' ),
            'offset'   => ( '' != $settings['offset']['size'] ? $settings['offset']['size'] : '' ),
        ] ) ) ],
        ],
        ] );
        $this->parent->add_render_attribute( 'bdt-scroll-down', 'data-selector', '#' . esc_attr( $settings['section_id'] ) );
        $this->parent->add_render_attribute( 'bdt-scroll-wrapper', 'class', 'bdt-scroll-down-wrapper' );
        ?>
      <div <?php 
        $this->parent->print_render_attribute_string( 'bdt-scroll-wrapper' );
        ?>>
        <button <?php 
        $this->parent->print_render_attribute_string( 'bdt-scroll-down' );
        ?>>
            <?php 
        $this->render_scroll_button_text();
        ?>
        </button>
      </div>

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
        $this->parent->render_social_link( $position = 'top', $class = [] );
        ?>
        <?php 
        $this->render_scroll_button();
        ?>
      </div>
        <?php 
    }
    
    public function rendar_item_image()
    {
        $settings = $this->parent->get_settings_for_display();
        $placeholder_image_src = Utils::get_placeholder_image_src();
        $image_src = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_size', $settings );
        
        if ( $image_src ) {
            $image_final_src = $image_src;
        } elseif ( $placeholder_image_src ) {
            $image_final_src = $placeholder_image_src;
        } else {
            return;
        }
        
        ?>

        <div class="bdt-ps-slide-img" style="background-image: url('<?php 
        echo  esc_url( $image_final_src ) ;
        ?>')"></div>

        <?php 
    }
    
    public function render_item_content( $post )
    {
        $settings = $this->parent->get_settings_for_display();
        $parallax_title = 'data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0"';
        $parallax_text = 'data-bdt-slideshow-parallax="y: 60,0,-50; opacity: 1,1,0"';
        ?>

      <div class="bdt-slideshow-content-wrapper">
        <div class="bdt-prime-slider-wrapper">
          <div class="bdt-prime-slider-content">
            <div class="bdt-prime-slider-desc" bdt-grid>
              <div class="bdt-width-1-1 bdt-width-2-3@s">

                <div data-bdt-slideshow-parallax="y: 20,0,-20; opacity: 1,1,0">
                  <?php 
        $this->parent->render_category();
        ?>
                </div>

                <?php 
        
        if ( 'yes' == $settings['show_title'] ) {
            ?>
                <div class="bdt-main-title" data-reveal="reveal-active">
                  <<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?> class="bdt-title-tag" <?php 
            echo  $parallax_title ;
            ?>>

                  <a href="<?php 
            echo  esc_url( get_permalink( $post->ID ) ) ;
            ?>">
                      <?php 
            echo  prime_slider_first_word( get_the_title() ) ;
            ?>
                  </a>

                </<?php 
            echo  Utils::get_valid_html_tag( $settings['title_html_tag'] ) ;
            ?>>
              </div>
                <?php 
        }
        
        ?>

              <div <?php 
        echo  $parallax_text ;
        ?>>
              <?php 
        $this->parent->render_excerpt();
        ?>
              </div>

              <!-- <div data-bdt-slideshow-parallax="y: 80,0,-60; opacity: 1,1,0"> -->
                <?php 
        $this->parent->render_meta();
        ?>
              <!-- </div> -->

              <div class="bdt-coral-btn" data-reveal="reveal-active" data-bdt-slideshow-parallax="y: 150,0,-100; opacity: 1,1,0">
                  <?php 
        $this->parent->render_button( $post );
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
        $slide_index = 1;
        global  $post ;
        $wp_query = $this->parent->query_posts();
        if ( !$wp_query->found_posts ) {
            return;
        }
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            ?>

          <li class="bdt-slideshow-item bdt-flex bdt-flex-middle elementor-repeater-item-<?php 
            echo  get_the_ID() ;
            ?>">

              <?php 
            
            if ( 'yes' == $settings['kenburns_animation'] ) {
                ?>
            <div
                class="bdt-position-cover bdt-animation-kenburns<?php 
                echo  esc_attr( $kenburns_reverse ) ;
                ?> bdt-transform-origin-center-left">
                <?php 
            }
            
            ?>

                <?php 
            $this->rendar_item_image();
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
            $this->render_item_content( $post );
            ?>

              <?php 
            $slide_index++;
            ?>

          </li>


            <?php 
        }
        wp_reset_postdata();
    }
    
    public function render()
    {
        $skin_name = 'coral';
        $this->parent->render_header( $skin_name );
        $this->render_slides_loop();
        $this->render_footer();
    }

}