<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>


<section id="perf-main-hero" class="relative bg-cover bg-center px2 sm-px3 md-px4 perf-main-hero">

	<?php perf_breadcrumbs(); ?>

	
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<?php global $post; ?>
		<h1 class="h0-responsive regular white-color m0 entry-title"><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h1>
	<?php else: ?>
		<h1 class="h0-responsive regular white-color m0 entry-title"><?php the_title(); ?></h1>
	<?php endif; ?>

	<?php if( is_single() ): ?>
		<div class="entry-meta white-color upper absolute">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php perf_posted_on(); ?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</section>