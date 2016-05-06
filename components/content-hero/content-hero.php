<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>


<section id="perf-main-hero" class="relative bg-cover bg-center px2 sm-px3 md-px4 perf-main-hero break-word">

	<?php perf_breadcrumbs(); ?>

	<h1 class="h0-responsive regular white-color m0 entry-title">
		<?php if ( is_home() ) : ?>
			<?php global $post; ?>
			<?php
				if( get_option('page_for_posts', true) ){
					echo get_the_title( get_option('page_for_posts', true) );
				}else{
					echo get_bloginfo( "description" );
				}
			
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				if( $paged > 1 ){
					echo '&nbsp;' . __("page ","perf") . $paged;
				}
			?>
		<?php elseif( is_archive() ): ?>
			<?php the_archive_title(); ?>
		<?php elseif( is_404() ): ?>
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'perf' ); ?>
		<?php elseif( is_search() ): ?>
			<?php printf( esc_html__( 'Search Results for: %s', 'perf' ), '<span>' . get_search_query() . '</span>' ); ?>
		<?php else: ?>
			<?php the_title(); ?>
		<?php endif; ?>
	</h1>

	<?php if( is_single() ): ?>
		<div class="entry-meta white-color upper absolute">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php perf_posted_on(); ?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- .entry-meta -->
	<?php elseif( is_archive() ): ?>
		<div class="entry-meta white-color upper absolute">
			<?php the_archive_description(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</section>