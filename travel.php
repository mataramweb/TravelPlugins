<?php
/**
* Plugin Name: Fiture Travel
* Plugin URI: https://www.mataramweb.com/
* Description: Pelengkap website travel
* Version: 1.03
* Author: Ropiudin Yahya
* Author URI: http://mataramweb.com/
**/
?>
<?php
include_once('main.php');
include_once('banner.php');
include_once('load-template-paket.php');
include_once('load-template-transport.php');
include_once('load-template-hotel.php');
/* Memanggil semua fungsi php yang ada di folder inc */
foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/*.php" )  as $function) {
    $function= basename($function);
    require plugin_dir_path( __FILE__ ) . '/inc/' . $function;
}
/* Memanggil semua fungsi php yang ada di folder inc / core */
function call_inc_core() {
foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/core/*.php" )  as $function) {
    $function= basename($function);
    require plugin_dir_path( __FILE__ ) . '/inc/core/' . $function;
}		
}
add_action( 'init', 'call_inc_core');

/* Memanggil semua fungsi php yang ada di folder vc element */
function vc_before_init_actions() {
    foreach ( glob( plugin_dir_path( __FILE__ ) . "vc-elements/*.php" )  as $function) {
    $function= basename($function);
    require plugin_dir_path( __FILE__ ) . '/vc-elements/' . $function;
}
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
/* Mendaftar widget recent post paket */
if( ! function_exists( 'travel_register_widget' ) ):
function travel_register_widget() {
    if(class_exists('Package_Widget'))
	    register_widget( 'Package_Widget' );
    }
endif;
add_action( 'widgets_init', 'travel_register_widget' );

function register_vc_shortcodes(){
        add_shortcode( 'custom_portfolio', 'agr_portfolio_func' );
        add_shortcode( 'other_element', 'other_element_func' );
        add_shortcode( 'other_element2', 'other_element_func2' );
    }
add_action( 'init', 'register_vc_shortcodes');

/* Mendaftar ukuran thumbnail  */
add_image_size( 'feature-image', 960, 500, true ); 
add_image_size( 'medium-thumb', 360, 250, true );
add_image_size( 'small-thumb', 75, 75, true );
add_theme_support( 'post-thumbnails' );	
add_filter( 'page_template', 'wpa3396_page_template' );

function wpa3396_page_template( $page_template )
{
    if ( is_page( 'booking-transport' ) ) {
        $page_template = dirname( __FILE__ ) . '/booking-transport.php';
    }
    return $page_template;
}

add_filter( 'page_template', 'page_booking_package' );
function page_booking_package( $page_template )
{
    if ( is_page( 'booking-package' ) ) {
        $page_template = dirname( __FILE__ ) . '/booking-package.php';
    }
    return $page_template;
}
function myplugin_style() {
    wp_register_style( 'model', plugin_dir_url( __FILE__ ) . 'css/model.css' );
	wp_enqueue_style( 'model' );
}
add_action( 'wp_enqueue_scripts', 'myplugin_style');


function enqueue_load_fa() {
wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function single_package_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Single Package Sidebar', 'your-theme-domain' ),
            'id' => 'single-package',
            'description' => __( 'Sidebar akan tampil di detail paket', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-sigle-package">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'single_package_sidebar' );
