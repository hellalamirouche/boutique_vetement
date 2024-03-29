<?php
/**
 * Displays post entry read more
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Text
$text = esc_html__( 'lire la suite', 'oceanwp' );

// Apply filters for child theming
$text = apply_filters( 'ocean_post_readmore_link_text', $text ); ?>

<?php do_action( 'ocean_before_blog_entry_readmore' ); ?>

<div class="blog-entry-readmore clr lire_encore">
    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $text ); ?>"><?php echo esc_html( $text ); ?><i class="fa fa-angle-right"></i></a>
</div><!-- .blog-entry-readmore -->

<?php do_action( 'ocean_after_blog_entry_readmore' ); ?>
<!-- fermeture de la <div class="style-blog"> que j'ai ajouté dans partial/entry/header.php -->
</div>

<?php
