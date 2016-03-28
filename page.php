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

	<div id="primary" class="content-area clearfix py2 sm-py3 md-py4 px2 sm-px3 md-px4">

		<div class="md-col md-col-9 lg-col-10 md-col-right">
			<main id="main" class="site-main lg-col lg-col-10 md-ml3 lg-m0 lg-px4 break-word" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->

			<?php get_sidebar("social"); ?>
		</div>

		<?php get_sidebar("page"); ?>

	</div><!-- #primary -->

	
<?php get_footer(); ?>