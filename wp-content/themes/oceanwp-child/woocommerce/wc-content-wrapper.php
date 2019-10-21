<?php
/**
 * After Container template.
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<?php do_action( 'ocean_before_content_wrap' ); ?>

<div id="content-wrap" class="container clr">

	<?php do_action( 'ocean_before_primary' ); ?>

	<div id="primary" class="content-area clr">

		<?php do_action( 'ocean_before_content' ); ?>

		<div id="content" class="clr site-content">

			<?php do_action( 'ocean_before_content_inner' ); ?>
     <!--  affichage de l'id article selon la page soi shop ou produit simple -->
			<article class="entry-content entry clr conteneur_page_produit_simple" <?php if ( is_product()){ echo 'id="page_produit"' ;} if ( is_shop()){ echo 'id="id_shop"' ;} ?>>
			<h2 style="display:none">display none</h2>
				<!--  affichage du titre du produit sur la fiche produit non pas à l'interieur -->
				<?php if ( is_product()){
                      echo woocommerce_template_single_title(); 
				}
				