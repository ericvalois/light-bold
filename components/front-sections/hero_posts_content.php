<?php
/**
 * The template used for displaying hero posts content.
 *
 * @package ttfb
 */
?>
<?php

    $front_hero = get_field("perf_front_hero");

	$args = array(
		'post_type' => 'post',
        'ignore_sticky_posts' => 1,
	);

	if( $front_hero['content_type'] === 'latest_posts' ){
		$args['posts_per_page'] = $front_hero['how_many_posts'];
	}else{
		$args['post__in'] = $front_hero['manual_selection'];
	}

	$posts = new WP_Query( $args );
?>
<div class="md-col-5 dark-bg relative">
	<div class="flex flex-stretch flex-column col-12 front-hero-content<?php if( $posts->post_count == 1 ){ echo ' single-slide'; } ?>">
		<div class="flex flex-center front-hero col-12 px2 py3">
			<div <?php if( $posts->post_count > 1 ){ echo 'class="col-12 main-carousel is-hidden"'; }else{ echo 'class="fit"'; } ?>>
				
				<?php if ( $posts->have_posts() ) : ?>

					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

						<article <?php post_class("carousel-cell col-12 md-px1 break-word"); ?>>

							<h3 class="h2 entry-title separator white-color mt0"><?php the_title(); ?></h3>
				  			<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color">
				  				<?php 
								  	$content = wp_trim_words( get_the_content(), 45, '...' ); 
									echo esc_html( strip_tags( $content ) );
								?>
				  			</p>
				  			<a href="<?php the_permalink(); ?>" class="perf_btn"><?php esc_html_e("Read more","light-bold"); ?></a>

						</article>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if( $posts->post_count > 1 ): ?>
		<div class="button-row alt-dark-bg px2 md-px3  flex flex-stretch">
			<button class="alt-dark-bg border-none button--previous"><svg class="fa fa-chevron-left"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-chevron-left"></use></svg></button>
			<button class="alt-dark-bg border-none button--next"><svg class="fa fa-chevron-right"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-chevron-right"></use></svg></button>

			<?php if( $front_hero['archive_link'] == 1 ): ?>
				<a href="<?php echo esc_url( get_post_type_archive_link("post") ); ?>" class="archive-link upper px2"><?php esc_html_e("Archive","light-bold"); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</div>