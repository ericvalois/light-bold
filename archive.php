<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfthemes
 */

get_header(); ?>

	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo light_bold_content_animation(); ?>">

		<?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
		    <div class="lg-col lg-col-8 lg-col-right ">
        <?php endif; ?>

			<main id="main" class="site-main break-word <?php if( is_active_sidebar( "blog-sidebar" ) ): ?>lg-ml4<?php endif; ?>">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'components/content/content', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>

					<?php get_template_part( 'components/content/content', 'none' ); ?>

				<?php endif; ?>
			</main><!-- #main -->

		<?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
		    </div><?php // lg-col-right ?>

            <?php get_sidebar(); ?>
        <?php endif; ?>

	</div><?php // #primary ?>

	
<?php get_footer(); ?>