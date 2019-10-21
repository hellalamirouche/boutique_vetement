<?php
/**
 * Outputs correct page layout
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="<?php if (is_page(9)||is_cart()) { echo'conteneur_page_compte' ; }else { echo'conteneur_page';}?> clr">

	<?php
	// Get page entry
	get_template_part( 'partials/page/article' );

	// Display comments
	comments_template(); ?>

</div>