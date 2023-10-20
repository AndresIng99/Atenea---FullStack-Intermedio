<?php

namespace PrimeSlider\Modules\Blog\Skins;

use  Elementor\Group_Control_Image_Size ;
use  Elementor\Skin_Base as Elementor_Skin_Base ;
use  PrimeSlider\Utils ;
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
class Skin_Zinest extends Elementor_Skin_Base
{
    public function get_id()
    {
        return 'zinest';
    }
    
    public function get_title()
    {
        return esc_html__( 'Zinest', 'bdthemes-prime-slider' );
    }
    
    public function render_category()
    {
        ?>
        <div class="bdt-ps-category" data-reveal="reveal-active">
            <?php 
        echo  get_the_category_list( ', ' ) ;
        ?>
        </div>
    <?php 
    }
    
    public function render_navigation_arrows()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        <?php 
        if ( $settings['show_navigation_arrows'] ) {
            ?>
            <div class="bdt-navigation-arrows bdt-position-bottom-right reveal-muted">
                <a class="bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
                <a class="bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
            </div>
        <?php 
        }
        ?>

    <?php 
    }
    
    public function render_footer()
    {
        $settings = $this->parent->get_settings_for_display();
        ?>

        </ul>

        <?php 
        $this->render_navigation_arrows();
        ?>

        </div>

        <?php 
        
        if ( 'yes' == $settings['show_featured_post'] ) {
            ?>
            <div class="bdt-ps-blog-container bdt-ps-blog-featured bdt-position-bottom bdt-flex bdt-flex-middle reveal-muted">
                <div class="bdt-child-width-1-3 bdt-grid bdt-grid-medium bdt-flex bdt-flex-middle" bdt-grid>
                    <?php 
            $selected_ids = $this->parent->get_settings_for_display( 'featured_item_posts_selected_ids' );
            $selected_ids = wp_parse_id_list( $selected_ids );
            $args['post_type'] = 'any';
            if ( !empty($selected_ids) ) {
                $args['post__in'] = $selected_ids;
            }
            $defaults = [
                'numberposts'      => 3,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'suppress_filters' => true,
            ];
            $wp_query = new \WP_Query( $args, $defaults );
            if ( !$wp_query->found_posts ) {
                return;
            }
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                ?>
                        <div>
                            <div class="bdt-ps-featured bdt-position-relative bdt-grid-small bdt-flex bdt-flex-middle">
                                <div class="bdt-width-1-1 bdt-width-1-2@m">
                                    <div class="bdt-ps-featured-thumbnav">
                                        <a href="<?php 
                echo  esc_url( get_permalink( get_the_ID() ) ) ;
                ?>">
                                            <?php 
                $this->rendar_item_image();
                ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="bdt-width-1-1 bdt-width-1-2@m bdt-visible@m">
                                    <div class="bdt-ps-content">
                                        <div class="bdt-ps-title">
                                            <a href="<?php 
                echo  esc_url( get_permalink( get_the_ID() ) ) ;
                ?>">
                                                <?php 
                echo  prime_slider_first_word( get_the_title() ) ;
                ?>
                                            </a>
                                        </div>
                                        <div class="bdt-ps-desc">
                                            <?php 
                $this->parent->render_excerpt();
                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
            }
            wp_reset_postdata();
            ?>
                </div>
            </div>
        <?php 
        }
        
        ?>

        </div>
    <?php 
    }
    
    public function rendar_item_image()
    {
        $placeholder_image_src = Utils::get_placeholder_image_src();
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
        
        if ( isset( $image_src[0] ) ) {
            $image_src = $image_src[0];
        } else {
            $image_src = $placeholder_image_src;
        }
        
        ?>

        <img src="<?php 
        echo  esc_url( $image_src ) ;
        ?>" alt="<?php 
        echo  get_the_title() ;
        ?>">

    <?php 
    }
    
    public function render_item_content( $post )
    {
        $settings = $this->parent->get_settings_for_display();
        $parallax_title = 'data-bdt-slideshow-parallax="y: 80,0,-80; opacity: 1,1,0"';
        $parallax_text = 'data-bdt-slideshow-parallax="y: 110,0,-90; opacity: 1,1,0"';
        ?>

        <div class="bdt-container">
            <div class="bdt-prime-slider-wrapper">
                <div class="bdt-prime-slider-content">
                    <div class="bdt-prime-slider-desc">

                        <?php 
        
        if ( 'yes' == $settings['show_category'] ) {
            ?>
                            <div class="bdt-ps-category-wrapper" data-bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0">
                                <?php 
            $this->render_category();
            ?>
                            </div>
                        <?php 
        }
        
        ?>

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

                        <?php 
        
        if ( 'yes' == $settings['show_meta'] ) {
            ?>
                            <?php 
            $this->parent->render_meta();
            ?>
                        <?php 
        }
        
        ?>

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

            <li class="bdt-slideshow-item bdt-flex bdt-flex-middle elementor-repeater-item-<?php 
            echo  get_the_ID() ;
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

                    <div class="bdt-ps-slide-img" style="background-image: url('<?php 
            echo  esc_url( $image_final_src ) ;
            ?>')"></div>

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
        $skin_name = 'zinest';
        $this->parent->render_header( $skin_name );
        $this->render_slides_loop();
        $this->render_footer();
    }

}