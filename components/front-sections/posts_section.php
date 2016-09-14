<?php
/**
 * The template used for displaying posts_section content.
 *
 * @package perfthemes
 */
?>

<section class="clearfix posts_section px4 py3 lg-py4 white-bg ">

	<h2 class="mt0 upper mb1 block center"><?php echo get_sub_field("title"); ?></h2>
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

			
			$latest_posts = new WP_Query( $args );
		?>
		<?php if ( $latest_posts->have_posts() ) : ?>

			<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>

				<article <?php post_class("border-box px2 break-word mb3 " . $col_class); ?> id="post-<?php the_ID(); ?>">

					<?php if( get_sub_field("show_post_thumbnail") ): ?>
						<a href="<?php the_permalink(); ?>" class="no-border hover-opacity"><?php the_post_thumbnail( "perfthemes-blog", array("class" => "lazyload mb1 rounded") ); ?></a>
					<?php endif; ?>

					<div class="small-p"><?php the_category( ", " ); ?> </div>

					<h2 class="h3 mb1 mt0"><a class="dark-color" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

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