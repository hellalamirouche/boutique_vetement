<?php
/**
 * The Header for our theme.
 *
 * @package OceanWP WordPress theme
 */ ?>

<!DOCTYPE html>
<html class="<?php echo esc_attr( oceanwp_html_classes() ); ?>" <?php language_attributes(); ?><?php oceanwp_schema_markup( 'html' ); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- ajout de jquery par moi même -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<?php wp_head(); ?>


</head>

<body <?php body_class(); ?> >

	<?php do_action( 'ocean_before_outer_wrap' ); ?>

	<div id="outer-wrap" class="site clr">

		<?php do_action( 'ocean_before_wrap' ); ?>

		<div id="wrap" class="clr">
			<?php do_action( 'ocean_top_bar' ); ?>
            
			<?php do_action( 'ocean_header' ); ?>

			<?php do_action( 'ocean_before_main' ); ?>
			
			<main id="main" class="site-main clr <?php
			 if ( is_shop() ||  is_product_category() || is_product() || ( !is_front_page() && is_home() )){ echo 'main_content_page_boutique_product_blog' ;}
			 else if(is_page(9)||is_cart()){echo'main_content_page_compte_panier';}elseif( is_page('contact')){echo'main_content_page_contact'; } elseif(is_single()){
				echo'main_content_post_single';}elseif(is_checkout() ){
					echo'main_content_page_commande';} 
					elseif (isset($_GET['s'])){
                     echo'resultat_recherche_ajax';
} ?> "<?php oceanwp_schema_markup( 'main' ); ?> >
			
			<?php do_action( 'ocean_page_header' ); ?>


			