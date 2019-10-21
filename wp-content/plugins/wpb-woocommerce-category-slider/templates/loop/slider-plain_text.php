<?php

/**
 * WPB WooCommerce Category Slider Plugin
 *
 * Template file for category slider plain text loop
 *
 * Author: WpBean
 */
	
?>


<div class="wpb-woo-cat-item">
	<a href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>">

		<?php echo esc_html( $term->name ); ?>

		<?php if( $need_cat_count == 'on' ): ?>
			<span class="wpb-woo-cat-item-count">(<?php echo esc_html( $term->count ); ?>)</span>
		<?php endif; ?>

	</a>
</div>