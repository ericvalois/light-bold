<?php
/**
 * The template used for displaying hero posts content.
 *
 * @package perfthemes
 */
?>
<div class="md-col-5 dark-bg relative md-table-cell">
	<div class="table col-12 front-hero-content">
		<div class="table-cell align-middle px2 md-px3 py3">
			<?php
				$args = array(
					'post_type' => 'post',
				);

				if( get_sub_field("latest_posts_or_manual_selection") == "latest" ){
					$args['posts_per_page'] = get_sub_field("how_many_posts");
				}else{
					$args['post__in'] = get_sub_field("manual_selection");
				}

				$posts = new WP_Query( $args );
			?>

			<div <?php if( $posts->post_count > 1 ){ echo 'class="main-carousel is-hidden"'; } ?>>
				
				<?php if ( $posts->have_posts() ) : ?>

					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

						<article <?php post_class("carousel-cell"); ?> id="post-<?php the_ID(); ?>">

							<h3 class="h3 separator white-color mt0"><?php the_title(); ?></h3>
				  			<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color">
				  				<?php 
								  	$content = wp_trim_words( get_the_content(), 45, '…' ); 
									echo $content;
								?>
				  			</p>
				  			<a href="<?php the_permalink(); ?>" class="perf_btn"><?php _e("Read more","lightbold"); ?></a>

						</article>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if( $posts->post_count > 1 ): ?>
		<div class="button-row alt-dark-bg px2 md-px3">
			<button class="alt-dark-bg border-none button--previous"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
			<button class="alt-dark-bg border-none button--next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>

			<?php if( get_sub_field("remove_archive_link") != 1 ): ?>
				<a href="<?php echo get_post_type_archive_link("post"); ?>" class="archive-link upper px2"><?php _e("Archive","lightbold"); ?></a>
			<?php endif; ?>
		</div>

		<?php
			wp_enqueue_script( 'perf-flickity', get_template_directory_uri() . '/inc/3rd-party/flickity/flickity.min.js', array(), '', true );

			// Custom Flickity Listener
			add_action("wp_footer","perf_add_flickity_listener"); 				
		?>
	<?php endif; ?>

</div>