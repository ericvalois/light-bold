<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfthemes
 */

get_header(); ?>
	
	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<?php get_template_part( 'components/content/content-sticky' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo perf_content_animation(); ?>">

		<div class="lg-col lg-col-8 lg-col-right">

			<main id="main" class="site-main break-word lg-ml4">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class("border-bottom break-word mb2 md-mb3"); ?>>
							<div class="sticky-meta ultra-small upper mb1">
								<span class="main-color"><?php echo get_the_date(); ?></span>
								<span class="inline-block px"> | </span><a href="" class="dark-color"><?php echo get_the_author(); ?></a>
							</div>

							<h2 class="entry-title h2 mb1 md-mb0 mt0"><a href="<?php the_permalink(); ?>" class="dark-color" rel="bookmark"><?php the_title(); ?></a></h2>
							<a href="<?php the_permalink(); ?>" class="mb2 md-mb3 small-p inline-block"><?php _e("Read more","perf"); ?></a>
						</article>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>
			</main><!-- #main -->

		</div><?php // lg-col-right ?>

		<?php get_sidebar(); ?>

	</div><?php // #primary ?>

	
<?php get_footer(); ?>