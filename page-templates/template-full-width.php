<?php
/**
 * Template Name: Full width
 *
 * @package ttfb
 */
get_header(); ?>

	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo esc_attr( light_bold_content_animation() ); ?>">

		<main id="main" class="site-main col col-12 break-word">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content/content-page' ); ?>

				<?php
					// If comments are open or we have at least one comment load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->


<?php get_footer(); ?>
