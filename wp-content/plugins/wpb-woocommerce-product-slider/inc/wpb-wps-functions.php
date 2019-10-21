<?php

/**
 * WPB WooCommerce Product slider
 * By WpBean
 */



/**
 * Getting settings
 */

if( !function_exists('wpb_wps_get_option') ){
	function wpb_wps_get_option( $option, $section, $default = '' ) {
	 
	    $options = get_option( $section );

	    if ( isset( $options[$option] ) ) {
	        return $options[$option];
	    }
	 
	    return $default;
	}
}


/**
 * Text Widget Shortcode Support
 */

add_filter('widget_text', 'do_shortcode'); 


/**
 * Cart Button
 */


if( !function_exists('wpb_wps_cart_button') ){
	function wpb_wps_cart_button(){
		echo '<div class="wpb_cart_button">';
			woocommerce_template_loop_add_to_cart();
		echo '</div>';
	}
}

/**
 * Settings Dynamic Style
 */

if( !function_exists('wpb_wps_adding_dynamic_styles') ):
	function wpb_wps_adding_dynamic_styles() {

		$wpb_wps_primary_color 			= wpb_wps_get_option( 'wpb_wps_primary_color', 'wpb_wps_style', '#1abc9c' );
		$wpb_wps_primary_color_dark 	= wpb_wps_get_option( 'wpb_wps_primary_color_dark', 'wpb_wps_style', '#16a085' );
		$wpb_wps_secondary_color 		= wpb_wps_get_option( 'wpb_wps_secondary_color', 'wpb_wps_style', '#999999' );
		$wpb_wps_secondary_color_light 	= wpb_wps_get_option( 'wpb_wps_secondary_color_light', 'wpb_wps_style', '#cccccc' );

		$custom_css = 	".wpb-woo-products-slider figcaption a.button,
		.wpb-woo-products-slider.owl-theme .owl-dots .owl-dot.active span,
		.wpb-woo-products-slider.owl-theme .owl-dots .owl-dot:hover span {
			background:  $wpb_wps_primary_color
		}";

		$custom_css .= 	".grid_no_animation .pro_price_area {
			color:  $wpb_wps_primary_color
		}";

		$custom_css .= 	".wpb-woo-products-slider figcaption a.button:hover {
			background:  $wpb_wps_primary_color_dark
		}";

		$custom_css .= 	".wpb-woo-products-slider.owl-theme .owl-dots .owl-dot span,
		.wpb-woo-products-slider.owl-theme .owl-nav [class*=owl-] {
			background:  $wpb_wps_secondary_color_light
		}";

		$custom_css .= 	".wpb-woo-products-slider.owl-theme .owl-nav [class*=owl-]:hover {
			background:  $wpb_wps_secondary_color
		}";



		wp_add_inline_style( 'wpb_wps_main_style', $custom_css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'wpb_wps_adding_dynamic_styles' );


/**
 * Data attribute Array to data types
 */

if( !function_exists('wpb_wps_data_attributes') ){
	function wpb_wps_data_attributes($array){
		if( !empty($array) ){
			foreach ($array as $key => $value) {
				echo 'data-'.$key.'="'.$value.'" ';
			}
		}
	}
}

/**
 * Show review
 */

if( !function_exists('wpb_wps_show_product_review') ){
	function wpb_wps_show_product_review(){
		global $woocommerce, $product;

		if ( $woocommerce->version >= '3.0' ){
			if ( wc_get_rating_html( $product->get_average_rating() ) && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ){
				echo wc_get_rating_html( $product->get_average_rating() );
			}
		}else{
			if ( $product->get_rating_html() && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ){
				echo $product->get_rating_html();
			}
		}
	}
}



/**
 * PRO version Info
 */

if( !function_exists( 'wpb_wps_pro_version_info' ) ){
	function wpb_wps_pro_version_info(){
		?>
			<div class="wpb_wps_pro_version_features">
			<h3><?php esc_html_e( 'PRO Version Features:', WPB_WPS_TEXTDOMAIN ); ?></h3>
			<ul>
				<li><?php esc_html_e( 'Six different newly designed themes for slider.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Include or exclude product category / tag.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Product slider form selected product SKU.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Product slider form on sell products.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Product slider form selected products attribute.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Product slider form best selling products.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Remove out of stock products form slider.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Advance shortcode generator. No more writing shortcodes.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'YITH WooCommerce quick view, compare and wish list plugins support.', WPB_WPS_TEXTDOMAIN ); ?></li>
				<li><?php esc_html_e( 'Visual Composer Custom Element.', WPB_WPS_TEXTDOMAIN ); ?></li>
			</ul>

			<div class="wpb_plugin_btns">
				<a class="wpb_button wpb_button_lg wpb_button_success" href="https://wpbean.com/downloads/wpb-woocommerce-product-slider-pro/" target="_blank"><?php esc_html_e( 'Get The Pro Version', WPB_WPS_TEXTDOMAIN ); ?></a>
				<a class="wpb_button wpb_button_lg wpb_button_warning" href="http://demo1.wpbean.com/wpb-woocommerce-product-slider-pro/" target="_blank"><?php esc_html_e( 'Pro Version Demo', WPB_WPS_TEXTDOMAIN ); ?></a>
			</div>
		</div>
		<?php
	}
}


/**
 * Adding the menu page
 */

if( !function_exists('wpb_wps_register_menu_page') ){
	function wpb_wps_register_menu_page() {
	    add_menu_page(
	        esc_html__( 'WPB WooCommerce Products Slider', WPB_WPS_TEXTDOMAIN ),
	        esc_html__( 'Woo Slider', WPB_WPS_TEXTDOMAIN ),
	        apply_filters( 'wpb_wps_settings_user_capability', 'manage_options' ),
	        WPB_WPS_TEXTDOMAIN.'-about',
	        'wpb_wps_get_menu_page',
	        'dashicons-images-alt'
	    );
	}
}
add_action( 'admin_menu', 'wpb_wps_register_menu_page' );


/**
 * Getting the menu page
 */

if( !function_exists('wpb_wps_get_menu_page') ){
	function wpb_wps_get_menu_page(){
		require ( WPB_WPS_PLUGIN_DIR . '/admin/admin-page.php' );
	}
}


/**
 * bottom left admin text
 */

if( !function_exists('wpb_wps_wp_admin_bottom_left_text') ){
	function wpb_wps_wp_admin_bottom_left_text( $text ) {
		$screen = get_current_screen();

		if( $screen->base == 'toplevel_page_wpb-wps-about' || $screen->base == 'woo-slider_page_wpb-wps-settings' ){
			$text = 'If you like <strong>WPB WooCommerce Products Slider</strong> please leave us a <a href="https://wordpress.org/support/plugin/wpb-woocommerce-product-slider/reviews?rate=5#new-post" target="_blank" class="wpb-wcs-rating-link" data-rated="Thanks :)">★★★★★</a> rating. A huge thanks in advance!';
		}
		
		return $text;
	}
}
add_filter( 'admin_footer_text', 'wpb_wps_wp_admin_bottom_left_text' );