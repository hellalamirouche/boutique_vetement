<?php

/**
 * Plugin functions
 * Author : WpBean
 */


/**
 * Enqueue Script For Front-end
 */

if( !function_exists('wpb_wcs_adding_scripts') ){

	function wpb_wcs_adding_scripts() {

		wp_register_style( 'font-awesoume', plugins_url( '../assets/icons/font-awesome/css/font-awesome.min.css', __FILE__ ), array(), '4.7.0' );
		wp_register_style( 'wpb-wcs-plugin-icons-collections', plugins_url( '../assets/icons/plugin-icons-collections/css/flaticon.css', __FILE__ ), array(), '1.0' );

		wp_register_style( 'owl-carousel',  plugins_url( '../assets/css/owl.carousel.css', __FILE__ ), array(), '2.2.1' );
		wp_register_script( 'owl-carousel', plugins_url( '../assets/js/owl.carousel.js', __FILE__ ), array('jquery'), '2.2.1', false);

		wp_register_style( 'wpb-wcs-bootstrap-grid', plugins_url( '../assets/css/bootstrap-grid.min.css', __FILE__ ), array(), '4.0' );

		wp_register_style( 'wpb-wcs-main', plugins_url( '../assets/css/main.css', __FILE__ ), array(), '1.0' );
		wp_register_script('wpb-wcs-main', plugins_url( '../assets/js/main.js', __FILE__ ), array('jquery'), '1.0', false);
		
	}

}
add_action( 'wp_enqueue_scripts', 'wpb_wcs_adding_scripts' );


/**
 * Custom styles
 */

add_action('wp_enqueue_scripts','wpb_wcs_custom_style');

if( !function_exists('wpb_wcs_custom_style') ){
	function wpb_wcs_custom_style(){
		wp_enqueue_style( 'wpb-wcs-main', plugins_url('../assets/css/main.css', __FILE__), '', '1.0', false);

		$text_color = wpb_wcs_get_option( 'text_color', 'style_settings', '' );
		$primary_color = wpb_wcs_get_option( 'primary_color', 'style_settings', '#39a1f4' );
		$secondary_color = wpb_wcs_get_option( 'secondary_color', 'style_settings', '#2196F3' );
		$slider_bg_color = wpb_wcs_get_option( 'slider_bg_color', 'style_settings', '#ededed' );

		ob_start();
		?>
			<?php if( $text_color ): ?>
				body .wpb-woo-cat-items, body  .wpb-woo-cat-items a:visited {
				    color: <?php echo $text_color; ?>;
				}
			<?php endif; ?>

			.wpb-woo-cat-items .wpb-woo-cat-item a.btn:hover,
			.wpb-woo-cat-items.owl-theme .owl-nav [class*=owl-]:hover,
			.wpb-woo-cat-items.owl-theme .owl-dots .owl-dot.active span, .wpb-woo-cat-items.owl-theme .owl-dots .owl-dot:hover span {
				background: <?php echo $primary_color; ?>;
			}
			.wpb-woo-cat-items.wpb-wcs-content-type-plain_text .wpb-woo-cat-item a:hover,
			.wpb-woo-cat-items .wpb-woo-cat-item a:hover {
				color: <?php echo $primary_color; ?>;
			}

			.wpb-woo-cat-items .wpb-woo-cat-item a.btn,
			.wpb-woo-cat-items.owl-theme .owl-nav [class*=owl-] {
				background: <?php echo $secondary_color; ?>;
			}

			.wpb-woo-cat-items .wpb-woo-cat-item {
				background: <?php echo $slider_bg_color; ?>;
			}

		<?php
		$custom_css = ob_get_clean();
		wp_add_inline_style( 'wpb-wcs-main', $custom_css );
	}
}


/**
 * Admin scripts
 */

if( !function_exists('wpb_wcs_load_admin_scripts') ){
	function wpb_wcs_load_admin_scripts() {
	    wp_register_style( 'wpb-wcs-admin', plugins_url( '../admin/assets/css/admin-style.css', __FILE__ ), array(), '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'wpb_wcs_load_admin_scripts' );


/**
 * Get the setting values 
 */

if( !function_exists('wpb_wcs_get_option') ){
	function wpb_wcs_get_option( $option, $section, $default = '' ) {
	 
	    $options = get_option( $section );
	 
	    if ( isset( $options[$option] ) ) {
	        return $options[$option];
	    }
	 
	    return $default;
	}
}



/**
 * Adding the menu page
 */

if( !function_exists('wpb_wcs_register_menu_page') ){
	function wpb_wcs_register_menu_page() {
	    add_menu_page(
	        __( 'WPB WooCommerce Category Slider', WPB_WCS_TEXTDOMAIN ),
	        __( 'Woo Cat Slider', WPB_WCS_TEXTDOMAIN ),
	        apply_filters( 'wpb_wcs_settings_user_capability', 'manage_options' ),
	        WPB_WCS_TEXTDOMAIN.'-about',
	        'wpb_wcs_get_menu_page',
	        'dashicons-images-alt'
	    );
	}
}
add_action( 'admin_menu', 'wpb_wcs_register_menu_page' );


/**
 * Getting the menu page
 */

if( !function_exists('wpb_wcs_get_menu_page') ){
	function wpb_wcs_get_menu_page(){
		require ( WPB_WCS_PLUGIN_DIR . '/admin/wpb-wcs-admin-page.php' );
	}
}


/**
 * bottom left admin text
 */

if( !function_exists('wpb_wcs_wp_admin_bottom_left_text') ){
	function wpb_wcs_wp_admin_bottom_left_text( $text ) {
		$screen = get_current_screen();

		if( $screen->base == 'toplevel_page_wpb-woocommerce-category-slider-about' || $screen->base == 'woo-cat-slider_page_wpb-woocommerce-category-slider-settings' ){
			$text = 'If you like <strong>WooCommerce Category Slider</strong> please leave us a <a href="https://wordpress.org/support/plugin/wpb-woocommerce-category-slider/reviews?rate=5#new-post" target="_blank" class="wpb-wcs-rating-link" data-rated="Thanks :)">★★★★★</a> rating. A huge thanks in advance!';
		}
		
		return $text;
	}
}
add_filter( 'admin_footer_text', 'wpb_wcs_wp_admin_bottom_left_text' );


/**
 * Show Categories ID's in admin column
 */

add_filter( "manage_edit-product_cat_columns",          'wpb_wcs_add_new_col_for_id' );
add_filter( "manage_edit-product_cat_sortable_columns", 'wpb_wcs_add_new_col_for_id' );
add_filter( "manage_product_cat_custom_column",         'wpb_wcs_product_cat_id_display', 10, 3 );

if( !function_exists('wpb_wcs_add_new_col_for_id') ){
	function wpb_wcs_add_new_col_for_id( $columns ) {

	    $columns['tax_id'] = __( 'ID', WPB_WCS_TEXTDOMAIN );

	    return $columns;
	}
}


if( !function_exists('wpb_wcs_product_cat_id_display') ){
	function wpb_wcs_product_cat_id_display( $columns, $column, $id ) {    

	    if ( 'tax_id' == $column ) {
	    	$columns .= esc_html( $id ); 
	    }

	    return $columns;
	}
}