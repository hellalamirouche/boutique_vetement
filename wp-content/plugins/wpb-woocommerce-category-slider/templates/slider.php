<?php

/**
 * WPB WooCommerce Category Slider Plugin
 *
 * Template file for category slider
 *
 * Author: WpBean
 */
	
?>

<?php do_action( 'wpb_wcs_before_slider' ); ?>

<div class="wpb-woo-cat-items wpb-woo-cat-slider owl-theme owl-carousel wpb-wcs-category-type-<?php echo esc_attr( $type ); ?> wpb-wcs-content-type-<?php echo esc_attr( $content_type ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-items="<?php echo esc_attr( $items ); ?>" data-desktopsmall="<?php echo esc_attr( $desktopsmall ); ?>" data-tablet="<?php echo esc_attr( $tablet ); ?>" data-mobile="<?php echo esc_attr( $mobile ); ?>" data-navigation="<?php echo esc_attr( $navigation) ; ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-direction="<?php echo esc_attr( ( is_rtl() ? 'true' : 'false' ) ); ?>">

	<?php foreach ( $terms as $term ): ?>

		<?php do_action( 'wpb_wcs_before_slider_loop' ); ?>

		<?php require ( WPB_WCS_PLUGIN_DIR .'/templates/loop/slider-'.$content_type.'.php' ); ?>

		<?php do_action( 'wpb_wcs_after_slider_loop' ); ?>
		
	<?php endforeach; ?>

</div>

<?php do_action( 'wpb_wcs_after_slider' ); ?>