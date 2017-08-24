<?php
/**
 * The template used for displaying posts_section content.
 *
 * @package ttfb
 */
?>

<section class="clearfix posts_section px2 lg-px3 py1 lg-py2 white-bg ">

	<h2 class="mt2 lg-mt3 upper mb1 block center entry-title"><?php echo esc_html( get_sub_field("title") ); ?></h2>

    <?php $button = get_sub_field("button"); ?>
    <?php if( !empty( $button['url'] ) && !empty( $button['title'] )  ): ?>
        <div class="center small-p mb1"><a href="<?php echo esc_url( $button['url'] ); ?>" <?php if( $button['target'] == '_blank' ){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo esc_html( $button['title'] ); ?></a></div>
    <?php endif; ?>

	<span class="separator seprarator-center"></span>
	
	<div class="flex flex-wrap mxn2 mt2">
		<?php
			if( get_sub_field("latest_posts_or_manual_selection") == "latest" ){
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => get_sub_field("how_many_posts"),
                    'ignore_sticky_posts' => 1,
				);
			}else{
				$args = array(
					'post_type' => 'post',
                    'ignore_sticky_posts' => 1,
					'post__in' => get_sub_field("manual_selection"),
				);
			}

			$layout = 12 / get_sub_field("radio_posts_section_layout");

			$col_class = "md-col-" . $layout;

			$posts = new WP_Query( $args );
		?>
		<?php if ( $posts->have_posts() ) : ?>

			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

				<article <?php post_class("border-box px2 break-word mb3 col-12 " . esc_attr( $col_class )); ?> id="post-<?php the_ID(); ?>">

					<?php if( get_sub_field("show_post_thumbnail") && has_post_thumbnail() ): ?>
						<a href="<?php the_permalink(); ?>" class="no-border hover-opacity">
							<img alt="<?php the_title(); ?>" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-src="<?php esc_url( the_post_thumbnail_url("light-bold-blog") ); ?>" class="blur-up lazyload mb1 rounded" data-sizes="auto" />
						</a>
					<?php endif; ?>

					<div class="small-p mb1 md-mb0 sm-show"><?php the_category( ", " ); ?> </div>

					<h3 class="h3 mb1 mt0 entry-title"><a class="dark-color" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<div class="small-p">
						<strong><?php esc_html_e("By","light-bold"); ?> <?php echo get_the_author(); ?></strong><br>
						<?php the_date(); ?>
					</div><!-- .entry-meta -->

				</article>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>	
	</div>
	
</section>