<?php

/**
 * Plugin Name:       WPB WooCommerce Category Slider
 * Plugin URI:        https://wpbean.com/product/wpb-woocommerce-category-slider/
 * Description:       WPB WooCommerce Category Slider is highly customizable Category slider plugin for WooCommerce.
 * Version:           1.1.4
 * Author:            wpbean
 * Author URI:        http://wpbean.com/
 * Text Domain:       wpb-woocommerce-category-slider
 * Domain Path:       /languages
 *
 * WC requires at least: 3.0
 * WC tested up to: 3.6.4
 */


/**
 * Checking If PRO version active
 */

if ( defined( 'WPB_WOOCOMMERCE_CATEGORY_SLIDER_PRO' ) ) {
	return false;
}

/**
 * Define constant
 */

define( 'WPB_WCS_TEXTDOMAIN', 'wpb-woocommerce-category-slider' );
define( 'WPB_WCS_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define( 'WPB_WCS_PLUGIN_DIR_FILE', __FILE__ );


/**
 * Localization
 */

if( !function_exists('wpb_wcs_textdomain') ){
	function wpb_wcs_textdomain() {
		load_plugin_textdomain( WPB_WCS_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'wpb_wcs_textdomain' );


/**
 * Add plugin action links
 */

if( !function_exists('wpb_wcs_plugin_actions_links') ){
	function wpb_wcs_plugin_actions_links( $links ) {
		if( is_admin() ){
			$links[] = '<a href="http://wpbean.com/support/" target="_blank">'. __( 'Support', WPB_WCS_TEXTDOMAIN ) .'</a>';
			$links[] = '<a href="admin.php?page=wpb-woocommerce-category-slider-about">'. __( 'Settings', WPB_WCS_TEXTDOMAIN ) .'</a>';
			$links[] = '<a style="color: #27ae60; font-weight: bold" href="'. esc_url( 'https://wpbean.com/product/wpb-woocommerce-category-slider-pro/' ) .'" target="_blank">'. __( 'Upgrade to PRO!', WPB_WCS_TEXTDOMAIN ) .'</a>';
		}
		return $links;
	}
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpb_wcs_plugin_actions_links' );


/**
 * Require Files
 */

require_once dirname( __FILE__ ) . '/inc/wpb-wcs-functions.php';
require_once dirname( __FILE__ ) . '/inc/wpb-wcs-shortcode.php';
require_once dirname( __FILE__ ) . '/admin/settings/class.settings-api.php';
require_once dirname( __FILE__ ) . '/admin/settings/wpb-wcs-settings-config.php';
require_once dirname( __FILE__ ) . '/admin/taxonomie-meta.php';