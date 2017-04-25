<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfthemes
 */

get_header(); ?>

	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo light_bold_content_animation(); ?>">

        <?php if( is_active_sidebar( "page-sidebar" ) ): ?>
		    <div class="lg-col lg-col-8 lg-col-right ">
        <?php endif; ?>

			<main id="main" class="site-main break-word <?php if( is_active_sidebar( "page-sidebar" ) ): ?>lg-ml4<?php endif; ?>">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/content/content-page' ); ?>

					<?php get_template_part( 'components/content/content-share' ); ?>

					<?php
						// If comments are open or we have at least one comment load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
        
        <?php if( is_active_sidebar( "page-sidebar" ) ): ?>
		    </div><?php // lg-col-right ?>

            <?php get_sidebar("page"); ?>
        <?php endif; ?>

	</div><?php // #primary ?>


<?php get_footer(); ?>
