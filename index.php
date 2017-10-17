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
 * @package ttfb
 */

get_header(); ?>
	
	<?php get_template_part( 'components/content-hero/content-hero' ); ?>

    <?php 
        if( is_home() ){
            get_template_part( 'components/content/content-sticky' );
        }
    ?>

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4 <?php echo esc_attr( light_bold_content_animation() ); ?>">

		<?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
            <?php 
                $sidebar_layout = get_field("perf_layouts","option");
                if( !isset($sidebar_layout['sidebar']) ){
                    $sidebar_layout['sidebar'] = "";
                }
            ?>
		    <div class="lg-col lg-col-8 <?php if( $sidebar_layout['sidebar'] != 2 ){echo 'lg-col-right lg-pl4'; }else{ echo 'lg-pr4'; } ?> ">
        <?php endif; ?>

			<main id="main" class="site-main break-word block">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'components/content/content', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>

                    <?php 
                        $count_posts = wp_count_posts(); 

                        if( $count_posts->publish < 1 ){
                            get_template_part( 'components/content/content', 'none' );
                        }
                    ?>

				<?php endif; ?>
			</main><!-- #main -->

		<?php if( is_active_sidebar( "blog-sidebar" ) ): ?>
		    </div><?php // lg-col-right ?>

            <?php get_sidebar(); ?>
        <?php endif; ?>

	</div><?php // #primary ?>

	
<?php get_footer(); ?>