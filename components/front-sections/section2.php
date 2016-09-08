<?php
/**
 * The template used for displaying section2 content.
 *
 * @package perfthemes
 */
?>



<?php if( have_rows('perf_section_2') ): ?>
	<?php 
		$section2 = get_field("perf_section_2");
		$col_width = 12 / count($section2);  
	?>

	<section class="clearfix section2 alt-dark-bg lg-flex flex-stretch col-12 ">

		<?php while ( have_rows('perf_section_2') ) : the_row(); ?>

        	<?php if( get_row_layout() == 'text_and_button' ): ?>

				<?php
					if( get_sub_field('image') ){
						$div_class = 'bg-cover bg-center lazyload';
						$title_class = 'mt0 separator alt white-color h3';
						$text_class = 'white-color mb2 mt2 lg-mb3 lg-mt3 small-p';
						$button_class = 'perf_btn alt';

						$image = get_sub_field('image');
						$data_bgset = 'data-bgset="' . $image['sizes']['perfthemes-hero-md'] . ' [(min-width: 60em)] |' . $image['sizes']['perfthemes-hero-sm'] . '[(min-width: 52em)] | ' . $image['sizes']['perfthemes-hero-sm'] . '"';
					}else{
						$div_class = 'bg-white';
						$title_class = 'mt0 separator h3';
						$text_class = 'mb2 mt2 lg-mb3 lg-mt3 small-p';
						$button_class = 'perf_btn';
						$data_bgset = "";
					}
					
				?>
				<div class="py4 <?php echo $div_class; ?> lg-col-<?php echo $col_width; ?>" <?php echo $data_bgset; ?>>

					<div class="px2 lg-px3 py1">
						<h4 class="<?php echo $title_class; ?>"><?php echo get_sub_field('title'); ?></h4>
					
						<p class="<?php echo $text_class; ?>"><?php echo get_sub_field('content'); ?></p>

						<a href="<?php echo get_sub_field('button_link'); ?>" class="<?php echo $button_class; ?>" <?php if( get_sub_field('external_link') == 1 ){echo 'target="_blank"';} ?>><?php echo get_sub_field('button_text'); ?></a>
					</div>
					
				</div>

			<?php elseif( get_row_layout() == 'mailchimp_form' ): ?>

				<div class="py4 flex flex-center lg-col-<?php echo $col_width; ?>">

					<div class="px2 lg-px3">
						<h4 class="mt0 separator alt white-color h3"><?php the_sub_field('title'); ?></h4>
						
						<?php 
							$form = get_sub_field('form');
							echo do_shortcode('[mc4wp_form id="'. $form[0] .'"]'); 
						?>
					</div>
					
				</div>
        	
        	<?php endif; ?>

        <?php endwhile; ?>
	  	
	</section>

<?php endif; ?>