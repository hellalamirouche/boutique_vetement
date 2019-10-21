<?php

/**
 * WPB WooCommerce Category Slider Plugin
 *
 * Template file for category grid
 *
 * Author: WpBean
 */
	
?>

<?php 
	wp_enqueue_style('wpb-wcs-bootstrap-grid');
?>

<?php do_action( 'wpb_wcs_before_slider' ); ?>

<div class="wpb-woo-cat-items wpb-wcs-category-type-<?php echo esc_attr( $type ); ?> wpb-wcs-content-type-<?php echo esc_attr( $content_type ); ?> row">

	<?php foreach ( $terms as $term ): ?>

		<?php do_action( 'wpb_wcs_before_slider_loop' ); ?>

			<div class="wpb-wcs-column <?php echo esc_attr( $loop_css_classes )?>">
				<?php require ( WPB_WCS_PLUGIN_DIR .'/templates/loop/slider-'.$content_type.'.php' ); ?>
			</div>

		<?php do_action( 'wpb_wcs_after_slider_loop' ); ?>
		
	<?php endforeach; ?>

</div>

<?php do_action( 'wpb_wcs_after_slider' ); ?>