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

	<div id="primary" class="content-area clearfix py3 md-py4 px2 sm-px3 md-px3 lg-px4">

		<div class="lg-col lg-col-9 lg-col-right">

			<div class="clearfix">
				<?php  
					$perf_disable_all_ss = get_field("perf_disable_all_ss","option");

					if( $perf_disable_all_ss == 1 ){
						$col_class = 'lg-col lg-col-12';
					}else{
						$col_class = 'md-col md-col-10';
					}
				?>

				<main id="main" class="site-main <?php echo $col_class; ?>  break-word" role="main">

					<div class="lg-ml4">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'template-parts/content', 'page' ); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>

						<?php endwhile; // End of the loop. ?>
					</div>

				</main><!-- #main -->

				<?php 
					if( $perf_disable_all_ss != 1 ){
						get_sidebar("social");
					}
				?>
			</div>
		</div><?php // lg-col-right ?>

		<?php get_sidebar("page"); ?>

	</div><?php // #primary ?>

	
<?php get_footer(); ?>