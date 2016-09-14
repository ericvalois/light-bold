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
				<article class="<?php echo $col_class; ?> border-box px2 break-word">
					<span class="small-p"><?php the_category( ", " ); ?> </span>
					<h2 class="h3 mb1 mt0"><a class="dark-color" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="small-p">
						<?php 
						  $content = get_the_content(); 
						  echo substr(strip_tags($content), 0, 200) . '...'; 
						?><br>
						<a href="" class="mt1 inline-block">Read more</a>
					</p>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>	
	</div>
	
</section>