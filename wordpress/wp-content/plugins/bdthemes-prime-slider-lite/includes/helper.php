<?php

use  PrimeSlider\Notices ;
use  PrimeSlider\Prime_Slider_Loader ;
use  Elementor\Plugin ;
/**
 * You can easily add white label branding for for extended license or multi site license.
 * Don't try for regular license otherwise your license will be invalid.
 * return white label
 */
define( 'BDTPS_PNAME', basename( dirname( BDTPS__FILE__ ) ) );
define( 'BDTPS_PBNAME', plugin_basename( BDTPS__FILE__ ) );
define( 'BDTPS_PATH', plugin_dir_path( BDTPS__FILE__ ) );
define( 'BDTPS_URL', plugins_url( '/', BDTPS__FILE__ ) );
define( 'BDTPS_ADMIN_PATH', BDTPS_PATH . 'admin/' );
define( 'BDTPS_ADMIN_URL', BDTPS_URL . 'admin/' );
define( 'BDTPS_MODULES_PATH', BDTPS_PATH . 'modules/' );
define( 'BDTPS_INC_PATH', BDTPS_PATH . 'includes/' );
define( 'BDTPS_ASSETS_URL', BDTPS_URL . 'assets/' );
define( 'BDTPS_ASSETS_PATH', BDTPS_PATH . 'assets/' );
define( 'BDTPS_MODULES_URL', BDTPS_URL . 'modules/' );
if ( !defined( 'BDTPS' ) ) {
    define( 'BDTPS', '' );
}
//Add prefix for all widgets <span class="bdt-widget-badge"></span>
if ( !defined( 'BDTPS_CP' ) ) {
    define( 'BDTPS_CP', '<span class="bdt-ps-widget-badge"></span>' );
}
//Add prefix for all widgets <span class="bdt-widget-badge"></span>
if ( !defined( 'BDTPS_NC' ) ) {
    define( 'BDTPS_NC', '<span class="bdt-ps-new-control"></span>' );
}
// if you have any custom style
if ( !defined( 'BDTPS_SLUG' ) ) {
    define( 'BDTPS_SLUG', 'prime-slider' );
}
// set your own alias
if ( !defined( 'BDTPS_TITLE' ) ) {
    define( 'BDTPS_TITLE', 'Prime Slider' );
}
if ( !defined( 'BDTPS_PC' ) ) {
    define( 'BDTPS_PC', '<span class="bdt-ps-pro-control"></span>' );
}
define( 'BDTPS_IS_PC', 'bdt-ps-disabled-control' );
function prime_slider_is_edit()
{
    return Plugin::$instance->editor->is_edit_mode();
}

function prime_slider_is_preview()
{
    return Plugin::$instance->preview->is_preview_mode();
}

/**
 * Show any alert by this function
 * @param  mixed  $message [description]
 * @param  class prefix  $type    [description]
 * @param  boolean $close   [description]
 * @return helper           [description]
 */
function prime_slider_alert( $message, $type = 'warning', $close = true )
{
    ?>
    <div class="bdt-alert-<?php 
    echo  esc_attr( $type ) ;
    ?>" bdt-alert>
        <?php 
    if ( $close ) {
        ?>
            <a class="bdt-alert-close" bdt-close></a>
        <?php 
    }
    ?>
        <?php 
    echo  wp_kses_post( $message ) ;
    ?>
    </div>
<?php 
}

/**
 * all array css classes will output as proper space
 * @param array $classes shortcode css class as array
 * @return proper string
 */
function prime_slider_get_post_types()
{
    $cpts = get_post_types( array(
        'public'            => true,
        'show_in_nav_menus' => true,
    ) );
    $exclude_cpts = array( 'elementor_library', 'attachment', 'product' );
    foreach ( $exclude_cpts as $exclude_cpt ) {
        unset( $cpts[$exclude_cpt] );
    }
    $post_types = array_merge( $cpts );
    return $post_types;
}

function prime_slider_allow_tags( $tag = null )
{
    $tag_allowed = wp_kses_allowed_html( 'post' );
    $tag_allowed['input'] = [
        'class'   => [],
        'id'      => [],
        'name'    => [],
        'value'   => [],
        'checked' => [],
        'type'    => [],
    ];
    $tag_allowed['select'] = [
        'class'    => [],
        'id'       => [],
        'name'     => [],
        'value'    => [],
        'multiple' => [],
        'type'     => [],
    ];
    $tag_allowed['option'] = [
        'value'    => [],
        'selected' => [],
    ];
    $tag_allowed['title'] = [
        'a'      => [
        'href'  => [],
        'title' => [],
        'class' => [],
    ],
        'br'     => [],
        'em'     => [],
        'strong' => [],
        'hr'     => [],
    ];
    $tag_allowed['logo'] = [
        'br'     => [],
        'em'     => [],
        'strong' => [],
        'span'   => [],
    ];
    $tag_allowed['text'] = [
        'a'      => [
        'href'  => [],
        'title' => [],
        'class' => [],
    ],
        'br'     => [],
        'em'     => [],
        'strong' => [],
        'hr'     => [],
        'i'      => [
        'class' => [],
    ],
        'span'   => [
        'class' => [],
    ],
    ];
    
    if ( $tag == null ) {
        return $tag_allowed;
    } elseif ( is_array( $tag ) ) {
        $new_tag_allow = [];
        foreach ( $tag as $_tag ) {
            $new_tag_allow[$_tag] = $tag_allowed[$_tag];
        }
        return $new_tag_allow;
    } else {
        return ( isset( $tag_allowed[$tag] ) ? $tag_allowed[$tag] : [] );
    }

}

function prime_slider_dashboard_link( $suffix = '#welcome' )
{
    return add_query_arg( [
        'page' => 'prime_slider_options' . $suffix,
    ], admin_url( 'admin.php' ) );
}

function prime_slider_get_category( $taxonomy = 'category' )
{
    $post_options = [];
    $post_categories = get_terms( [
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ] );
    if ( is_wp_error( $post_categories ) ) {
        return $post_options;
    }
    if ( false !== $post_categories and is_array( $post_categories ) ) {
        foreach ( $post_categories as $category ) {
            $post_options[$category->slug] = $category->name;
        }
    }
    return $post_options;
}

function prime_slider_first_word( $string )
{
    $words = explode( ' ', $string );
    $html = '<span class="frist-word">' . $words[0] . '</span> ' . implode( " ", array_slice( $words, 1 ) );
    return $html;
}

/**
 * default get_option() default value check
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function prime_slider_option( $option, $section, $default = '' )
{
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

// Elementor Saved Template
function prime_slider_et_options()
{
    $templates = Prime_Slider_Loader::elementor()->templates_manager->get_source( 'local' )->get_items();
    $types = [];
    
    if ( empty($templates) ) {
        $template_options = [
            '0' => __( 'Template Not Found!', 'bdthemes-prime-slider' ),
        ];
    } else {
        $template_options = [
            '0' => __( 'Select Template', 'bdthemes-prime-slider' ),
        ];
        foreach ( $templates as $template ) {
            $template_options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
            $types[$template['template_id']] = $template['type'];
        }
    }
    
    return $template_options;
}

function prime_slider_template_edit_link( $template_id )
{
    
    if ( Prime_Slider_Loader::elementor()->editor->is_edit_mode() ) {
        $final_url = add_query_arg( [
            'elementor' => '',
        ], get_permalink( $template_id ) );
        $output = sprintf( '<a class="bdt-elementor-template-edit-link" href="%s" title="%s" target="_blank"><i class="eicon-edit"></i></a>', esc_url( $final_url ), esc_html__( 'Edit Template', 'bdthemes-prime-slider' ) );
        return $output;
    }

}

// Sidebar Widgets
function prime_slider_sidebar_options()
{
    $data = get_transient( 'ps_sidebar_options' );
    
    if ( false === $data ) {
        global  $wp_registered_sidebars ;
        $sidebar_options = [];
        
        if ( !$wp_registered_sidebars ) {
            $sidebar_options['0'] = esc_html__( 'No sidebars were found', 'bdthemes-prime-slider' );
        } else {
            $sidebar_options['0'] = esc_html__( 'Select Sidebar', 'bdthemes-prime-slider' );
            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $sidebar_options[$sidebar_id] = $sidebar['name'];
            }
        }
        
        set_transient( 'ps_sidebar_options', $sidebar_options, DAY_IN_SECONDS );
        return get_transient( 'ps_sidebar_options' );
    }
    
    return $data;
}

// BDT Transition
function prime_slider_transition_options()
{
    $transition_options = [
        ''                    => esc_html__( 'None', 'bdthemes-prime-slider' ),
        'fade'                => esc_html__( 'Fade', 'bdthemes-prime-slider' ),
        'scale-up'            => esc_html__( 'Scale Up', 'bdthemes-prime-slider' ),
        'scale-down'          => esc_html__( 'Scale Down', 'bdthemes-prime-slider' ),
        'slide-top'           => esc_html__( 'Slide Top', 'bdthemes-prime-slider' ),
        'slide-bottom'        => esc_html__( 'Slide Bottom', 'bdthemes-prime-slider' ),
        'slide-left'          => esc_html__( 'Slide Left', 'bdthemes-prime-slider' ),
        'slide-right'         => esc_html__( 'Slide Right', 'bdthemes-prime-slider' ),
        'slide-top-small'     => esc_html__( 'Slide Top Small', 'bdthemes-prime-slider' ),
        'slide-bottom-small'  => esc_html__( 'Slide Bottom Small', 'bdthemes-prime-slider' ),
        'slide-left-small'    => esc_html__( 'Slide Left Small', 'bdthemes-prime-slider' ),
        'slide-right-small'   => esc_html__( 'Slide Right Small', 'bdthemes-prime-slider' ),
        'slide-top-medium'    => esc_html__( 'Slide Top Medium', 'bdthemes-prime-slider' ),
        'slide-bottom-medium' => esc_html__( 'Slide Bottom Medium', 'bdthemes-prime-slider' ),
        'slide-left-medium'   => esc_html__( 'Slide Left Medium', 'bdthemes-prime-slider' ),
        'slide-right-medium'  => esc_html__( 'Slide Right Medium', 'bdthemes-prime-slider' ),
    ];
    return $transition_options;
}

// BDT Blend Type
function prime_slider_blend_options()
{
    $blend_options = [
        'multiply'    => esc_html__( 'Multiply', 'bdthemes-prime-slider' ),
        'screen'      => esc_html__( 'Screen', 'bdthemes-prime-slider' ),
        'overlay'     => esc_html__( 'Overlay', 'bdthemes-prime-slider' ),
        'darken'      => esc_html__( 'Darken', 'bdthemes-prime-slider' ),
        'lighten'     => esc_html__( 'Lighten', 'bdthemes-prime-slider' ),
        'color-dodge' => esc_html__( 'Color-Dodge', 'bdthemes-prime-slider' ),
        'color-burn'  => esc_html__( 'Color-Burn', 'bdthemes-prime-slider' ),
        'hard-light'  => esc_html__( 'Hard-Light', 'bdthemes-prime-slider' ),
        'soft-light'  => esc_html__( 'Soft-Light', 'bdthemes-prime-slider' ),
        'difference'  => esc_html__( 'Difference', 'bdthemes-prime-slider' ),
        'exclusion'   => esc_html__( 'Exclusion', 'bdthemes-prime-slider' ),
        'hue'         => esc_html__( 'Hue', 'bdthemes-prime-slider' ),
        'saturation'  => esc_html__( 'Saturation', 'bdthemes-prime-slider' ),
        'color'       => esc_html__( 'Color', 'bdthemes-prime-slider' ),
        'luminosity'  => esc_html__( 'Luminosity', 'bdthemes-prime-slider' ),
    ];
    return $blend_options;
}

// BDT Position
function prime_slider_position()
{
    $position_options = [
        ''              => esc_html__( 'Default', 'bdthemes-prime-slider' ),
        'top-left'      => esc_html__( 'Top Left', 'bdthemes-prime-slider' ),
        'top-center'    => esc_html__( 'Top Center', 'bdthemes-prime-slider' ),
        'top-right'     => esc_html__( 'Top Right', 'bdthemes-prime-slider' ),
        'center'        => esc_html__( 'Center', 'bdthemes-prime-slider' ),
        'center-left'   => esc_html__( 'Center Left', 'bdthemes-prime-slider' ),
        'center-right'  => esc_html__( 'Center Right', 'bdthemes-prime-slider' ),
        'bottom-left'   => esc_html__( 'Bottom Left', 'bdthemes-prime-slider' ),
        'bottom-center' => esc_html__( 'Bottom Center', 'bdthemes-prime-slider' ),
        'bottom-right'  => esc_html__( 'Bottom Right', 'bdthemes-prime-slider' ),
    ];
    return $position_options;
}

// BDT Thumbnavs Position
function prime_slider_thumbnavs_position()
{
    $position_options = [
        'top-left'      => esc_html__( 'Top Left', 'bdthemes-prime-slider' ),
        'top-center'    => esc_html__( 'Top Center', 'bdthemes-prime-slider' ),
        'top-right'     => esc_html__( 'Top Right', 'bdthemes-prime-slider' ),
        'center-left'   => esc_html__( 'Center Left', 'bdthemes-prime-slider' ),
        'center-right'  => esc_html__( 'Center Right', 'bdthemes-prime-slider' ),
        'bottom-left'   => esc_html__( 'Bottom Left', 'bdthemes-prime-slider' ),
        'bottom-center' => esc_html__( 'Bottom Center', 'bdthemes-prime-slider' ),
        'bottom-right'  => esc_html__( 'Bottom Right', 'bdthemes-prime-slider' ),
    ];
    return $position_options;
}

function prime_slider_navigation_position()
{
    $position_options = [
        'top-left'      => esc_html__( 'Top Left', 'bdthemes-prime-slider' ),
        'top-center'    => esc_html__( 'Top Center', 'bdthemes-prime-slider' ),
        'top-right'     => esc_html__( 'Top Right', 'bdthemes-prime-slider' ),
        'center'        => esc_html__( 'Center', 'bdthemes-prime-slider' ),
        'bottom-left'   => esc_html__( 'Bottom Left', 'bdthemes-prime-slider' ),
        'bottom-center' => esc_html__( 'Bottom Center', 'bdthemes-prime-slider' ),
        'bottom-right'  => esc_html__( 'Bottom Right', 'bdthemes-prime-slider' ),
    ];
    return $position_options;
}

function prime_slider_pagination_position()
{
    $position_options = [
        'top-left'      => esc_html__( 'Top Left', 'bdthemes-prime-slider' ),
        'top-center'    => esc_html__( 'Top Center', 'bdthemes-prime-slider' ),
        'top-right'     => esc_html__( 'Top Right', 'bdthemes-prime-slider' ),
        'bottom-left'   => esc_html__( 'Bottom Left', 'bdthemes-prime-slider' ),
        'bottom-center' => esc_html__( 'Bottom Center', 'bdthemes-prime-slider' ),
        'bottom-right'  => esc_html__( 'Bottom Right', 'bdthemes-prime-slider' ),
    ];
    return $position_options;
}

// BDT Drop Position
function prime_slider_drop_position()
{
    $drop_position_options = [
        'bottom-left'    => esc_html__( 'Bottom Left', 'bdthemes-prime-slider' ),
        'bottom-center'  => esc_html__( 'Bottom Center', 'bdthemes-prime-slider' ),
        'bottom-right'   => esc_html__( 'Bottom Right', 'bdthemes-prime-slider' ),
        'bottom-justify' => esc_html__( 'Bottom Justify', 'bdthemes-prime-slider' ),
        'top-left'       => esc_html__( 'Top Left', 'bdthemes-prime-slider' ),
        'top-center'     => esc_html__( 'Top Center', 'bdthemes-prime-slider' ),
        'top-right'      => esc_html__( 'Top Right', 'bdthemes-prime-slider' ),
        'top-justify'    => esc_html__( 'Top Justify', 'bdthemes-prime-slider' ),
        'left-top'       => esc_html__( 'Left Top', 'bdthemes-prime-slider' ),
        'left-center'    => esc_html__( 'Left Center', 'bdthemes-prime-slider' ),
        'left-bottom'    => esc_html__( 'Left Bottom', 'bdthemes-prime-slider' ),
        'right-top'      => esc_html__( 'Right Top', 'bdthemes-prime-slider' ),
        'right-center'   => esc_html__( 'Right Center', 'bdthemes-prime-slider' ),
        'right-bottom'   => esc_html__( 'Right Bottom', 'bdthemes-prime-slider' ),
    ];
    return $drop_position_options;
}

// Button Size
function prime_slider_button_sizes()
{
    $button_sizes = [
        'xs' => esc_html__( 'Extra Small', 'bdthemes-prime-slider' ),
        'sm' => esc_html__( 'Small', 'bdthemes-prime-slider' ),
        'md' => esc_html__( 'Medium', 'bdthemes-prime-slider' ),
        'lg' => esc_html__( 'Large', 'bdthemes-prime-slider' ),
        'xl' => esc_html__( 'Extra Large', 'bdthemes-prime-slider' ),
    ];
    return $button_sizes;
}

// Button Size
function prime_slider_heading_size()
{
    $heading_sizes = [
        'h1' => esc_html__( 'H1', 'bdthemes-prime-slider' ),
        'h2' => esc_html__( 'H2', 'bdthemes-prime-slider' ),
        'h3' => esc_html__( 'H3', 'bdthemes-prime-slider' ),
        'h4' => esc_html__( 'H4', 'bdthemes-prime-slider' ),
        'h5' => esc_html__( 'H5', 'bdthemes-prime-slider' ),
        'h6' => esc_html__( 'H6', 'bdthemes-prime-slider' ),
    ];
    return $heading_sizes;
}

// Title Tags
function prime_slider_title_tags()
{
    $title_tags = [
        'h1'   => esc_html__( 'H1', 'bdthemes-prime-slider' ),
        'h2'   => esc_html__( 'H2', 'bdthemes-prime-slider' ),
        'h3'   => esc_html__( 'H3', 'bdthemes-prime-slider' ),
        'h4'   => esc_html__( 'H4', 'bdthemes-prime-slider' ),
        'h5'   => esc_html__( 'H5', 'bdthemes-prime-slider' ),
        'h6'   => esc_html__( 'H6', 'bdthemes-prime-slider' ),
        'div'  => esc_html__( 'div', 'bdthemes-prime-slider' ),
        'span' => esc_html__( 'span', 'bdthemes-prime-slider' ),
        'p'    => esc_html__( 'p', 'bdthemes-prime-slider' ),
    ];
    return $title_tags;
}

function prime_slider_time_diff( $from, $to = '' )
{
    $diff = human_time_diff( $from, $to );
    $replace = array(
        ' hour'    => 'h',
        ' hours'   => 'h',
        ' day'     => 'd',
        ' days'    => 'd',
        ' minute'  => 'm',
        ' minutes' => 'm',
        ' second'  => 's',
        ' seconds' => 's',
    );
    return strtr( $diff, $replace );
}

function prime_slider_post_time_diff( $format = '' )
{
    $displayAgo = esc_html__( 'ago', 'bdthemes-element-pack' );
    
    if ( $format == 'short' ) {
        $output = prime_slider_time_diff( strtotime( get_the_date() ), current_time( 'timestamp' ) );
    } else {
        $output = human_time_diff( strtotime( get_the_date() ), current_time( 'timestamp' ) );
    }
    
    $output = $output . ' ' . $displayAgo;
    return $output;
}

/**
 * String to ID maker for any title to relavent id
 * @param  [type] $string any title or string
 * @return [type]         [description]
 */
function prime_slider_string_id( $string )
{
    //Lower case everything
    $string = strtolower( $string );
    //Make alphanumeric (removes all other characters)
    $string = preg_replace( "/[^a-z0-9_\\s-]/", "", $string );
    //Clean up multiple dashes or whitespaces
    $string = preg_replace( "/[\\s-]+/", " ", $string );
    //Convert whitespaces and underscore to dash
    $string = preg_replace( "/[\\s_]/", "-", $string );
    //finally return here
    return $string;
}

function prime_slider_custom_excerpt( $limit = 25, $strip_shortcode = false, $trail = '' )
{
    $output = get_the_content();
    if ( $limit ) {
        $output = wp_trim_words( $output, $limit, $trail );
    }
    if ( $strip_shortcode ) {
        $output = strip_shortcodes( $output );
    }
    return wpautop( $output );
}

class ps_menu_walker extends Walker_Nav_Menu
{
    var  $has_child = false ;
    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '<div class="bdt-navbar-dropdown"><ul class="bdt-nav bdt-navbar-dropdown-nav">';
    }
    
    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '</ul></div>';
    }
    
    public function start_el(
        &$output,
        $item,
        $depth = 0,
        $args = array(),
        $id = 0
    )
    {
        $data = array();
        $class = '';
        $classes = ( empty($item->classes) ? array() : (array) $item->classes );
        if ( $classes ) {
            $class = trim( preg_replace( '/menu-item(.+)/', '', implode( ' ', $classes ) ) );
        }
        //new class
        $classes = array();
        $data['style'] = '';
        if ( $args->walker->has_children ) {
            $classes[] = ' bdt-parent';
        }
        if ( $item->current || $item->current_item_parent || $item->current_item_ancestor ) {
            $classes[] = ' bdt-active';
        }
        if ( $item->dropdown_child && $depth > 0 ) {
            $classes[] = ' sub-dropdown';
        }
        // set id
        $data['data-id'] = $item->ID;
        // is current item ?
        
        if ( in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes ) ) {
            $data['data-menu-active'] = 2;
            // home/frontpage item
        } elseif ( preg_replace( '/#(.+)$/', '', $item->url ) == 'index.php' && (is_home() || is_front_page()) ) {
            $data['data-menu-active'] = 2;
        }
        
        
        if ( $item->full_width ) {
            $data['full_width'] = $item->full_width;
        } elseif ( $item->style_position ) {
            
            if ( $item->style_position == 'bottom-left' ) {
                $data_uk_dropdown = ( is_rtl() ? 'bottom-right' : 'bottom-left' );
            } elseif ( $item->style_position == 'bottom-right' ) {
                $data_uk_dropdown = ( is_rtl() ? 'bottom-left' : 'bottom-right' );
            } else {
                $data_uk_dropdown = $item->style_position;
            }
            
            $data['dropdown_style'] = $data_uk_dropdown;
        }
        
        $attributes = '';
        foreach ( $data as $name => $value ) {
            $attributes .= sprintf( ' %s="%s"', $name, $value );
        }
        // create item output
        $id = apply_filters(
            'nav_menu_item_id',
            '',
            $item,
            $args
        );
        if ( $classes ) {
            $class .= implode( ' ', $classes );
        }
        
        if ( $class ) {
            $class = ' class="' . $class . '"';
        } else {
            $class = '';
        }
        
        $output .= '<li' . (( strlen( $id ) ? sprintf( ' id="%s"', esc_attr( $id ) ) : '' )) . $attributes . $class . '>';
        // set link attributes
        $attributes = '';
        foreach ( array(
            'attr_title' => 'title',
            'target'     => 'target',
            'xfn'        => 'rel',
            'url'        => 'href',
        ) as $var => $attr ) {
            if ( !empty($item->{$var}) ) {
                $attributes .= sprintf( ' %s="%s"', $attr, $item->{$var} );
            }
        }
        // escape link title
        $item->title = $item->title;
        //htmlspecialchars($item->title, ENT_COMPAT, "UTF-8");
        $classes = trim( preg_replace( '/menu-item(.+)/', '', implode( ' ', $classes ) ) );
        // is separator ?
        
        if ( $item->url == '#' ) {
            $isline = preg_match( "/^\\s*\\-+\\s*\$/", $item->title );
            $type = "header";
            
            if ( $isline ) {
                $type = 'separator-line';
            } elseif ( $item->hasChildren ) {
                $type = 'separator-text';
            }
            
            $format = '%s<a href="#" %s>%s</a>%s';
            $classes = ' seperator';
            $attributes = ' class="' . $classes . '" data-type="' . $type . '"';
        } else {
            $format = '%s<a%s>%s</a>%s';
        }
        
        // create link output
        $item_output = sprintf(
            $format,
            $args->before,
            $attributes,
            $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after,
            $args->after
        );
        $output .= apply_filters(
            'walker_nav_menu_start_el',
            $item_output,
            $item,
            $depth,
            $args
        );
    }
    
    public function end_el(
        &$output,
        $item,
        $depth = 0,
        $args = array(),
        $id = 0
    )
    {
        $output .= '</li>';
    }
    
    function display_element(
        $element,
        &$children_elements,
        $max_depth,
        $depth = 0,
        $args = array(),
        &$output = null
    )
    {
        // attach to element so that it's available in start_el()
        $element->hasChildren = isset( $children_elements[$element->ID] ) && !empty($children_elements[$element->ID]);
        return parent::display_element(
            $element,
            $children_elements,
            $max_depth,
            $depth,
            $args,
            $output
        );
    }

}
function prime_slider_get_menu()
{
    $menus = wp_get_nav_menus();
    $items = [
        '0' => esc_html__( 'Select Menu', 'bdthemes-prime-slider' ),
    ];
    foreach ( $menus as $menu ) {
        $items[$menu->slug] = $menu->name;
    }
    return $items;
}

function prime_slider_dynamic_menu( $config, $menu_align = 'bdt-navbar-right' )
{
    $settings = $config->get_settings_for_display();
    $nav_menu = ( !empty($settings['navbar']) ? wp_get_nav_menu_object( $settings['navbar'] ) : false );
    if ( !$nav_menu ) {
        return;
    }
    $nav_menu_args = array(
        'fallback_cb'    => false,
        'container'      => false,
        'menu_id'        => 'bdt-navmenu',
        'menu_class'     => 'bdt-navbar-nav bdt-prime-slider-menu-style-' . $settings['menu_style_type'],
        'theme_location' => 'default_navmenu',
        'menu'           => $nav_menu,
        'echo'           => true,
        'depth'          => 0,
        'walker'         => new ps_menu_walker(),
    );
    $config->add_render_attribute( [
        'navbar-attr' => [
        'class'      => [ 'bdt-navbar', 'bdt-prime-slider-navbar', 'bdt-grid-small' ],
        'bdt-navbar' => [ wp_json_encode( array_filter( [
        "align"      => ( $settings["dropdown_align"] ? $settings["dropdown_align"] : "left" ),
        "delay-show" => ( $settings["dropdown_delay_show"]["size"] ? $settings["dropdown_delay_show"]["size"] : false ),
        "delay-hide" => ( $settings["dropdown_delay_hide"]["size"] ? $settings["dropdown_delay_hide"]["size"] : false ),
        "offset"     => ( $settings["dropdown_offset"]["size"] ? $settings["dropdown_offset"]["size"] : false ),
        "duration"   => ( $settings["dropdown_duration"]["size"] ? $settings["dropdown_duration"]["size"] : false ),
    ] ) ) ],
    ],
    ] );
    
    if ( 'yes' == $settings['show_menu_animation'] ) {
        $config->add_render_attribute( 'navbar-attr', 'bdt-scrollspy', 'cls: bdt-animation-slide-top;' );
        $config->add_render_attribute( 'navbar-attr', 'bdt-scrollspy', 'delay: 350;' );
        $config->add_render_attribute( 'navbar-attr', 'bdt-scrollspy', 'target: > div > ul > li;' );
    }
    
    ?>

    <nav <?php 
    echo  $config->get_render_attribute_string( 'navbar-attr' ) ;
    ?>>
        <div class="<?php 
    echo  esc_attr( $menu_align ) ;
    ?>">
            <?php 
    wp_nav_menu( apply_filters(
        'widget_nav_menu_args',
        $nav_menu_args,
        $nav_menu,
        $settings
    ) );
    ?>
        </div>
    </nav>

    <?php 
}

function prime_slider_static_menu( $config, $menu_align = 'bdt-navbar-right' )
{
    $settings = $config->get_settings_for_display();
    $config->add_render_attribute( 'nav_menu', 'class', 'bdt-navbar-nav bdt-prime-slider-menu-style-' . $settings['menu_style_type'] );
    
    if ( 'yes' == $settings['show_menu_animation'] ) {
        $config->add_render_attribute( 'nav_menu', 'bdt-scrollspy', 'cls: bdt-animation-slide-top;' );
        $config->add_render_attribute( 'nav_menu', 'bdt-scrollspy', 'delay: 350;' );
        $config->add_render_attribute( 'nav_menu', 'bdt-scrollspy', 'target: .bdt-menu-item;' );
    }
    
    
    if ( $settings['show_menu'] ) {
        ?>

        <nav class="bdt-navbar">
            <div class="<?php 
        echo  esc_attr( $menu_align ) ;
        ?>">

                <ul <?php 
        echo  $config->get_render_attribute_string( 'nav_menu' ) ;
        ?>>

                    <?php 
        foreach ( $settings['menus'] as $index => $item ) {
            ?>

                        <?php 
            $target = ( $item['menu_link']['is_external'] ? 'target="_blank"' : '' );
            $nofollow = ( $item['menu_link']['nofollow'] ? ' rel="nofollow"' : '' );
            ?>

                        <li class="bdt-menu-item">
                            <a href="<?php 
            echo  esc_url( $item['menu_link']['url'] ) ;
            ?>" <?php 
            echo  wp_kses_post( $target ) ;
            echo  wp_kses_post( $nofollow ) ;
            ?>><?php 
            echo  wp_kses( $item['menu_title'], prime_slider_allow_tags( 'title' ) ) ;
            ?>
                            </a>
                        </li>

                    <?php 
        }
        ?>

                </ul>
            </div>
        </nav>

<?php 
    }

}
