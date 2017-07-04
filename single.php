<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ttfb
 */

get_header(); ?>
	
	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo esc_attr( light_bold_content_animation() ); ?>">

        <?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
		    <div class="lg-col lg-col-8 lg-col-right ">
        <?php endif; ?>

			<main id="main" class="site-main break-word <?php if( is_active_sidebar( "blog-sidebar" ) ): ?>lg-ml4<?php endif; ?>">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/content/content-single' ); ?>

					<?php
						// If comments are open or we have at least one comment load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
        
        <?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
		    </div><?php // lg-col-right ?>

            <?php get_sidebar(); ?>
        <?php endif; ?>

	</div><?php // #primary ?>

	
<?php get_footer(); ?>