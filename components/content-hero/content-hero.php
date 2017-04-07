<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>


<div class="relative px2 sm-px3 md-px3 lg-px4 md-py3 dark-bg break-word z1">

	<?php light_bold_breadcrumbs(); ?>

	<h1 class="h0-responsive white-color m0 entry-title">
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
					echo '&nbsp;' . __("page ","light-bold") . $paged;
				}
			?>
		<?php elseif( is_archive() ): ?>
			<?php the_archive_title(); ?>
		<?php elseif( is_404() ): ?>
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'light-bold' ); ?>
		<?php elseif( is_search() ): ?>
			<?php printf( esc_html__( 'Search Results for: %s', 'light-bold' ), '<span>' . get_search_query() . '</span>' ); ?>
		<?php else: ?>
			<?php the_title(); ?>
		<?php endif; ?>
	</h1>

	<?php if( is_single() && get_post_type() == 'post' ): ?>
		<div class="entry-meta white-color upper normal-weight">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php light_bold_posted_on(); ?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- .entry-meta -->
	<?php elseif( is_archive() ): ?>
		<div class="entry-meta white-color upper absolute normal-weight">
			<?php the_archive_description(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php
        $perf_image_id = light_bold_select_hero_image();

		if( $perf_image_id ):
			$perf_image_src_sm = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-sm' );
			$perf_image_src_md = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-md' );
			$perf_image_src_lg = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-lg' );
    ?>
			<div class="perf-main-hero bg-cover bg-center absolute top-0 left-0 right-0 bottom-0 overflow-hidden m0 p0 hide-print">
				<div class="bg-default absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"></div>
				<div id="perf-main-hero" class="absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"   
					data-sizes="auto"
					data-bgset="<?php echo $perf_image_src_lg[0]; ?> [(min-width: 64em)] | 
					<?php echo $perf_image_src_md[0]; ?> [(min-width: 52em)] | 
					<?php echo $perf_image_src_sm[0]; ?>">
				</div>
			</div>
	<?php
		endif;
	?>

</div>