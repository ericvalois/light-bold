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
 * @package ttfb
 */

get_header(); ?>

	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo esc_attr( light_bold_content_animation() ); ?>">

        <?php if( is_active_sidebar( "page-sidebar" ) ): ?>
            <?php 
                $sidebar_layout = get_field("perf_layouts","option");
                if( !isset($sidebar_layout['sidebar']) ){
                    $sidebar_layout['sidebar'] = "";
                }
            ?>
		    <div class="lg-col lg-col-8 <?php if( $sidebar_layout['sidebar'] != 2 ){echo 'lg-col-right lg-pl4'; }else{ echo 'lg-pr4'; } ?> ">
        <?php endif; ?>

			<main id="main" class="site-main break-word block">

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
        
        <?php if( is_active_sidebar( "page-sidebar" ) ): ?>
		    </div><?php // lg-col-right ?>

            <?php get_sidebar("page"); ?>
        <?php endif; ?>

	</div><?php // #primary ?>


<?php get_footer(); ?>
