<?php
/**
 * Template Name: Empty
 *
 * @package ttfb
 */
get_header(); ?>

	<div id="primary" class="content-area clearfix">

		<main id="main" class="site-main col col-12 break-word block">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->


<?php get_footer(); ?>
