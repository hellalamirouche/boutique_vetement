<?php

/**
 * Plugin shortcode
 * Author : WpBean
 */


/**
 * WooCommerce Category Slider ShortCode
 */

add_shortcode( 'wpb-woo-category-slider', 'wpb_wcs_shortcode' );

if( !function_exists('wpb_wcs_shortcode') ){
	function wpb_wcs_shortcode( $atts ) {

		extract( shortcode_atts(
			array(
				'autoplay'				=> 'true',
				'items'					=> 4,
				'desktopsmall'			=> 3,
				'tablet'				=> 2,
				'mobile'				=> 1,
				'navigation'			=> 'true',
				'pagination'			=> 'true',
				'loop'					=> 'false',
				'type'					=> 'slider', // slider, grid
				'column'				=> '4', // bootstrap 4 columns
				'column_class'			=> '', // bootstrap formated css class
				'content_type'			=> 'plain_text', // plain_text, with_info, with_image, with_icon
				'need_description'		=> 'off',
				'need_child_cat'		=> 'off',
				'need_cat_count'		=> 'on',
				'need_btn'				=> 'off',
				'btn_text'				=> esc_html__( 'Shop Now', WPB_WCS_TEXTDOMAIN ),
				'order_by'				=> wpb_wcs_get_option( 'wpb_wcs_order_by', 'general_settings', 'name' ),
				'order'					=> wpb_wcs_get_option( 'wpb_wcs_order', 'general_settings', 'ASC' ),
				'hide_empty'			=> ( wpb_wcs_get_option( 'wpb_wcs_hide_empty', 'general_settings', 'off' ) == 'on' ? 1 : 0 ),
				'exclude'				=> wpb_wcs_get_option( 'wpb_wcs_exclude', 'general_settings', '' ),
				'include'				=> wpb_wcs_get_option( 'wpb_wcs_include', 'general_settings', '' ),
				'number'				=> wpb_wcs_get_option( 'wpb_wcs_number', 'general_settings', '' ),
				'parent'				=> 0, // If parent => 0 is passed, only top-level terms will be returned
			), $atts )
		);

		wp_enqueue_script('owl-carousel');
		wp_enqueue_style('owl-carousel');
		wp_enqueue_script('wpb-wcs-main');
		wp_enqueue_style('wpb-wcs-main');
		wp_enqueue_style('font-awesoume');
		wp_enqueue_style('wpb-wcs-plugin-icons-collections');

		$args = array(
			'taxonomy'          => 'product_cat',
			'hide_empty'		=> $hide_empty,
			'parent'        	=> $parent,
			'orderby'        	=> $order_by,
			'order'        		=> $order,
			'exclude'        	=> ( $exclude != '' ? explode(',', $exclude) : ''),
			'include'        	=> ( $include != '' ? explode(',', $include) : ''),
			'number'        	=> $number,
	    );

		$terms = get_terms( apply_filters( 'wpb_wcs_get_terms_args', $args ) );


		$loop_css_classes = '';
		if( $type == 'grid' ){
			if( $column_class ){
				$loop_css_classes = $column_class;
			}else {
				if( $column ){
					$column = 12/$column;
				}else{
					$column = '3';
				}
				$loop_css_classes = apply_filters( 'wpb_wcs_column_class', 'col-lg-' . $column . ' col-md-4 col-sm-6' );
			}
		}

		ob_start();
		
		if( $terms ){

			if( $type == 'slider' ){

				require ( WPB_WCS_PLUGIN_DIR .'/templates/slider.php' );

			}else{

				require ( WPB_WCS_PLUGIN_DIR .'/templates/grid.php' );

			}

		}

		return ob_get_clean();
	}
}