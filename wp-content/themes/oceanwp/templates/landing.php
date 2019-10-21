<?php
/**
 * Template Name: Landing Page
 *
 * @package OceanWP WordPress theme
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?><?php oceanwp_schema_markup( 'html' ); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<!-- Begin Body -->
	<body <?php body_class(); ?><?php oceanwp_schema_markup( 'body' ); ?>>

		<?php do_action( 'ocean_before_outer_wrap' ); ?>
  
		<div id="outer-wrap" class="site clr">

			<?php do_action( 'ocean_before_wrap' ); ?>

			<div id="wrap" class="clr">

				<?php do_action( 'ocean_before_main' ); ?>

				<main id="main" class="site-main clr"<?php oceanwp_schema_markup( 'main' ); ?>>

					<?php do_action( 'ocean_before_content_wrap' ); ?>

					<div id="content-wrap" class="container clr">

						<?php do_action( 'ocean_before_primary' ); ?>

						<section id="primary" class="content-area clr">

							<?php do_action( 'ocean_before_content' ); ?>

							<div id="content" class="site-content clr">

								<?php do_action( 'ocean_before_content_inner' ); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<div class="entry-content entry clr">
										<?php the_content(); ?>

										Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis quibusdam ea fuga sapiente praesentium quisquam sed harum accusantium magni earum, dignissimos odio nostrum doloremque in facere ad illum labore eum.
										Itaque, mollitia architecto quam dignissimos distinctio ipsum a. Totam inventore natus eligendi commodi sunt temporibus accusamus, magnam, maxime et sed iusto veritatis harum autem repellat? Impedit debitis odit officiis quo?
										A beatae repudiandae, corporis vero hic vel minus ratione optio similique id debitis quam libero voluptatum excepturi explicabo qui voluptate! Modi qui commodi dignissimos ab est nam debitis rem doloremque?
										Accusamus dolorem mollitia autem alias vitae ea aliquam quos consequuntur suscipit iste quis explicabo placeat neque nisi ipsa, deleniti tempore fuga! Quam quos eveniet similique nesciunt amet distinctio labore dolorum.
										Modi illo a inventore laboriosam itaque aliquid voluptates dignissimos minima aspernatur tempora quos temporibus necessitatibus reprehenderit nam qui adipisci illum excepturi, quam molestiae enim cum iusto. Dolor repellat asperiores voluptatem.
									</div><!-- .entry-content -->

								<?php endwhile; ?>

								<?php do_action( 'ocean_after_content_inner' ); ?>

							</div><!-- #content -->

							<?php do_action( 'ocean_after_content' ); ?>

						</section><!-- #primary -->

						<?php do_action( 'ocean_after_primary' ); ?>

					</div><!-- #content-wrap -->

					<?php do_action( 'ocean_after_content_wrap' ); ?>

		        </main><!-- #main-content -->

		        <?php do_action( 'ocean_after_main' ); ?>
		                
		    </div><!-- #wrap -->

		    <?php do_action( 'ocean_after_wrap' ); ?>

		</div><!-- .outer-wrap -->

		<?php do_action( 'ocean_after_outer_wrap' ); ?>

		<?php wp_footer(); ?>

	</body>
</html>