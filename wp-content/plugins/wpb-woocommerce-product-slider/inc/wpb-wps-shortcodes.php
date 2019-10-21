<?php

/**
 * WPB WooCommerce Product slider
 * By WpBean
 */

/**
 * Product Slider ShortCode
 */

add_shortcode('wpb-product-slider', 'wpb_wps_shortcode_function');

if( !function_exists( 'wpb_wps_shortcode_function' ) ):
	function wpb_wps_shortcode_function( $atts ){
		extract(shortcode_atts(array(
			'title' 				=> '',
			'posts' 				=> wpb_wps_get_option( 'wpb_wps_number', 'wpb_wps_general', 12 ),
			'product_type' 			=> wpb_wps_get_option( 'wpb_wps_product_type', 'wpb_wps_general', 'latest' ), // latest, featured, category, tags, id
			'theme' 				=> wpb_wps_get_option( 'wpb_wps_slider_theme', 'wpb_wps_general', 'hover_effect' ), // hover_effect, grid_no_animation
			'show_reviews'     		=> wpb_wps_get_option( 'wpb_wps_show_reviews', 'wpb_wps_general', 'off' ),
			'show_price'     		=> wpb_wps_get_option( 'wpb_wps_show_price', 'wpb_wps_general', 'on' ),
			'show_cart'     		=> wpb_wps_get_option( 'wpb_wps_show_cart', 'wpb_wps_general', 'on' ),
			'orderby'				=> wpb_wps_get_option( 'wpb_wps_orderby', 'wpb_wps_general', 'date' ),
			'order'					=> wpb_wps_get_option( 'wpb_wps_order', 'wpb_wps_general', 'DESC' ),
			'autoplay'				=> ( wpb_wps_get_option( 'wpb_slider_autoplay', 'wpb_wps_slider_settings', 'on' ) == 'on' ? 'true' : 'false' ),
			'loop'					=> ( wpb_wps_get_option( 'wpb_slider_loop', 'wpb_wps_slider_settings', 'on' ) == 'on' ? 'true' : 'false' ),
			'nav'					=> ( wpb_wps_get_option( 'wpb_slider_navigation', 'wpb_wps_slider_settings', 'on' ) == 'on' ? 'true' : 'false' ),
			'slideby'				=> ( wpb_wps_get_option( 'wpb_slider_slideby', 'wpb_wps_slider_settings', 1 ) ),
			'pagination' 			=> ( wpb_wps_get_option( 'wpb_slider_pagination', 'wpb_wps_slider_settings', 'off' ) == 'on' ? 'true' : 'false' ),
			'pagination_number' 	=> ( wpb_wps_get_option( 'wpb_slider_pagination_number', 'wpb_wps_slider_settings', 'off' ) == 'on' ? 'true' : 'false' ),
			'items' 				=> wpb_wps_get_option( 'wpb_wps_items', 'wpb_wps_slider_settings', 4 ), // Number of product on default screen
			'items_desktop_small'	=> wpb_wps_get_option( 'wpb_wps_items_desktop_small', 'wpb_wps_slider_settings', 3 ), // Number of product on screen size 979px
			'items_tablet'			=> wpb_wps_get_option( 'wpb_wps_items_tablet', 'wpb_wps_slider_settings', 2 ), // Number of product on screen size 768px
			'items_mobile'			=> wpb_wps_get_option( 'wpb_wps_items_mobile', 'wpb_wps_slider_settings', 1 ), // Number of product on screen size 479px
			'category'				=> wpb_wps_get_option( 'wpb_wps_categories', 'wpb_wps_general', '' ), // comma separated categories id
			'tags'					=> wpb_wps_get_option( 'wpb_wps_tags', 'wpb_wps_general', '' ), // comma separated tags id
			'id'					=> wpb_wps_get_option( 'wpb_wps_ids', 'wpb_wps_general', '' ), // comma separated products id
			'woo_image'				=> 'true',
			'disable_loop_on'		=> 3,
		), $atts));

		$slider_data_attr = array(
	    	'autoplay'			=> $autoplay,
	    	'loop'				=> $loop,
	    	'navigation'		=> $nav,
	    	'slideby'			=> $slideby,
	    	'pagination'		=> $pagination,
	    	'items'				=> $items,
	    	'desktopsmall'		=> $items_desktop_small,
	    	'tablet'			=> $items_tablet,
	    	'mobile'			=> $items_mobile,
	    	'direction'			=> ( is_rtl() ? 'true' : 'false' ),
	    );

    	$slider_data_attr = apply_filters( 'wpb_wps_data_attributes', $slider_data_attr );

		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page' 	=> $posts,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
		);

		// From selected product ids

		if( $product_type == 'id' ){
			$args['post__in'] = ( $id ? explode( ',', $id ) : null );
		}

		// Woo meta featured post check 
		if($product_type == 'featured'){
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
			);
		}

		// only selected categories
		if( $product_type == 'category' && $category != '' ){
			$category = explode(',', $category);
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'product_cat',
		        'field'    	=> 'term_id',
				'terms'    	=> $category,
			);
		}

		// only selected tags
		if( $product_type == 'tags' && $tags != '' ){
			$tags = explode(',', $tags);
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'product_tag',
		        'field'    	=> 'id',
				'terms'    	=> $tags,
		        'operator' 	=> 'IN' 
			);
		}

		$args = apply_filters( 'wpb_wcs_shortcode_quary_args', $args );
						
		$loop = new WP_Query( $args );
		
		wp_enqueue_script( 'wpb-wps-owl-carousel' );	
		wp_enqueue_style( 'wpb_wps_owl_carousel' );	
		wp_enqueue_script( 'wpb_wps_main_script' );
		wp_enqueue_style( 'wpb_wps_main_style' );

		if( $theme == 'hover_effect' ){
			$theme = 'grid cs-style-3';
		}
		$classes = array();
		$classes[] = $theme;
		$classes[] = 'woocommerce';
		$classes[] = 'wpb-wps-product-type-' . $product_type;
		if( $pagination_number == 'true' ){
			$classes[] = 'wpb-wps-pagination-number';
		}
			
		ob_start();
		if ( $loop->have_posts() ) {

			if( $loop->found_posts && $loop->found_posts <= (int)$disable_loop_on ){
				$slider_data_attr['loop'] = false;
 			}

			?>
			<div class="wpb_slider_area wpb_fix_cart">

				<?php ( $title ? printf( '<h3 class="wpb_slider_title">%s</h3>', esc_html( $title ) ) : '' ); ?>

				<div class="wpb-woo-products-slider owl-carousel owl-theme <?php echo esc_attr( implode(' ', $classes) )?>" <?php wpb_wps_data_attributes( $slider_data_attr ); ?>>

					<?php
						while ( $loop->have_posts() ) : $loop->the_post();
							global $woocommerce, $post, $product;

								?>
								<div <?php post_class( 'wpb-wps-slider-item' ) ?>>
									<figure>
										<a href="<?php the_permalink(); ?>" class="wpb_pro_img_url">
											<?php 
												if( has_post_thumbnail() ){

													if( function_exists('woocommerce_template_loop_product_thumbnail') && $woo_image == 'true' ){
														woocommerce_template_loop_product_thumbnail();
													}else{
														the_post_thumbnail( apply_filters( 'wpb_wps_product_archive_thumbnail_size', 'woocommerce_thumbnail' ) );
													}

												}else{
													printf( '<img src="%s" alt="%s" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', WPB_WPS_TEXTDOMAIN ) );
												}
											?>
										</a>
										<figcaption>
											<a href="<?php the_permalink(); ?>" class="wpb-wps-product-title">
												<?php the_title( '<h3 class="pro_title">', '</h3>' ) ?>
											</a>

											<?php 
												if( $show_price == 'on' && $price_html = $product->get_price_html() ){
													printf( '<div class="pro_price_area">%s</div>', $price_html );
												}
											?>

											<?php 
												if( $show_reviews == 'on' ){
													wpb_wps_show_product_review();
												}
											?>

											<?php 
												if( $show_cart == 'on' ){
													wpb_wps_cart_button();
												}
											?>

										</figcaption>
									</figure>
								</div>
								<?php

							wp_reset_postdata();
				    	endwhile;
			  		?>
		  		</div>
		  	</div>
		  	<?php  	

		} else {
			printf( '<div class="wpb-alert alert alert-danger"><b>%s</b></div>', esc_html__( 'No Products Found', WPB_WPS_TEXTDOMAIN ) );
		}

	    return ob_get_clean();   
	}
endif;