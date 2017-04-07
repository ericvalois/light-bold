<?php
/**
 * The template used for displaying posts_section content.
 *
 * @package perfthemes
 */
?>

<section class="clearfix posts_section px2 lg-px3 py1 lg-py2 white-bg ">

	<h2 class="mt2 lg-mt3 upper mb1 block center entry-title"><?php echo get_sub_field("title"); ?></h2>
	<span class="separator seprarator-center"></span>
	
	<div class="flex flex-wrap mxn2 mt2">
		<?php
			if( get_sub_field("latest_posts_or_manual_selection") == "latest" ){
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => get_sub_field("how_many_posts"),
				);
			}else{
				$args = array(
					'post_type' => 'post',
					'post__in' => get_sub_field("manual_selection"),
				);
			}

			$layout = 12 / get_sub_field("radio_posts_section_layout");

			$col_class = "md-col-" . $layout;

			$posts = new WP_Query( $args );
		?>
		<?php if ( $posts->have_posts() ) : ?>

			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

				<article <?php post_class("border-box px2 break-word mb3 " . $col_class); ?> id="post-<?php the_ID(); ?>">

					<?php if( get_sub_field("show_post_thumbnail") ): ?>
						<a href="<?php the_permalink(); ?>" class="no-border hover-opacity">
							<img alt="<?php the_title(); ?>" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-src="<?php the_post_thumbnail_url("perfthemes-blog"); ?>" class="blur-up lazyload mb1 rounded" data-sizes="auto" />
						</a>
					<?php endif; ?>

					<div class="small-p mb1 md-mb0 sm-show"><?php the_category( ", " ); ?> </div>

					<h3 class="h3 mb1 mt0 entry-title"><a class="dark-color" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<div class="small-p">
						<strong><?php _e("By","lightbold"); ?> <?php echo get_the_author(); ?></strong><br>
						<?php the_date(); ?>
					</div><!-- .entry-meta -->

				</article>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>	
	</div>
	
</section>