<?php
/**
 * Plugin Name: WPB WooCommerce Product slider
 * Plugin URI: https://wpbean.com/wpb-woocommarce-product-slider/
 * Description: WPB WooCommerce product slider comes with two different themes for different style product slider for your WooCommerce shop. It can show latest, featured, category, tags and selected products slider.
 * Author: wpbean
 * Version: 2.0.7.6
 * Author URI: https://wpbean.com
 * Text Domain: wpb-wps
 * Domain Path: /languages
 *
 * WC requires at least: 3.0
 * WC tested up to: 3.6.4
*/


/**
 * Checking If PRO version active
 */

if ( defined( 'WPB_WOOCOMMERCE_PRODUCTS_SLIDER_PRO' ) ) {
	return false;
}

/**
 * Define Path 
 */

define( 'WPB_WPS_URI', WP_CONTENT_URL. '/plugins/wpb-woocommerce-product-slider' );
define( 'WPB_WPS_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define( 'WPB_WPS_PLUGIN_DIR_FILE', __FILE__ );
define( 'WPB_WPS_TEXTDOMAIN', 'wpb-wps' );

/**
 * Localization
 */

if( !function_exists( 'wpb_wps_localization' ) ){
	function wpb_wps_localization() {
		load_plugin_textdomain( 'wpb-wps', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'wpb_wps_localization' );


/**
 * Plugin Activation redirect 
 */

if( !function_exists( 'wpb_wps_activation_redirect' ) ){
	function wpb_wps_activation_redirect( $plugin ) {
	    if( $plugin == plugin_basename( __FILE__ ) ) {
	        exit( wp_redirect( admin_url( 'admin.php?page=wpb-wps-about' ) ) );
	    }
	}
}
add_action( 'activated_plugin', 'wpb_wps_activation_redirect' );



/**
 * Plugin Action Links
 */

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpb_wps_add_action_links' );

if( !function_exists( 'wpb_wps_add_action_links' ) ){
	function wpb_wps_add_action_links ( $links ) {

		$links[] = '<a href="'. esc_url( get_admin_url( null, 'admin.php?page=wpb-wps-settings') ) .'">'. esc_html__( 'Settings', 'wpb-wps' ) .'</a>';
		$links[] = '<a style="color: red; font-weight: bold" href="'. esc_url( 'https://wpbean.com/downloads/wpb-woocommerce-product-slider-pro/' ) .'">'. esc_html__( 'Go PRO!', 'wpb-wps' ) .'</a>';

		return $links;
	}
}


/**
 * Require Files
 */

require_once dirname( __FILE__ ) . '/inc/wpb-scripts.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wps-widgets.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wps-shortcodes.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wps-functions.php';
require_once dirname( __FILE__ ) . '/admin/settings/class.settings-api.php';
require_once dirname( __FILE__ ) . '/admin/settings/wpb-wps-settings.php';

