<?php
/**
 * Template Name: Contact us
 *
 * @package perfthemes
 */
get_header(); ?>
	
	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php get_template_part( 'components/content/content-contact' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
		</main>
	</div>

<?php get_footer(); ?>
