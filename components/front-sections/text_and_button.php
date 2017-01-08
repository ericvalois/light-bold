<?php
/**
 * The template used for displaying text_and_button content.
 *
 * @package perfthemes
 */
?>



<?php $items = get_sub_field("repeater_text_and_button"); ?>

<?php if( have_rows('repeater_text_and_button') ): ?>
	<?php 
		$col_width = 12 / count($items);  
	?>

	<section class="clearfix section2 alt-dark-bg lg-flex flex-stretch col-12 ">

		<?php while ( have_rows('repeater_text_and_button') ) : the_row(); ?>


				<?php
					if( get_sub_field('image') ){
						$div_class = 'bg-cover bg-center lazyload';
						$title_class = 'mt0 separator alt white-color h3 entry-title';
						$text_class = 'white-color mb2 mt2 lg-mb3 lg-mt3 small-p';
						$button_class = 'perf_btn alt';

						$image = get_sub_field('image');
						$data_bgset = 'data-bgset="' . $image['sizes']['perfthemes-hero-sm'] . ' [(max-width: 52em)] | ' . $image['sizes']['perfthemes-hero-md'] . ' [(min-width: 52em) and (max-width: 60em)] | '  . $image['sizes']['perfthemes-hero-lg'] . ' [(min-width: 60em)]"';
						$date_expand = 'data-expand="50"';
					}else{
						$div_class = 'bg-white';
						$title_class = 'mt0 separator h3 entry-title';
						$text_class = 'mb2 mt2 lg-mb3 lg-mt3 small-p';
						$button_class = 'perf_btn';
						$data_bgset = "";
						$date_expand = '';
					}
					
				?>
				<div class="py4 <?php echo $div_class; ?> lg-col-<?php echo $col_width; ?>" <?php echo $data_bgset; ?> <?php echo $date_expand; ?> data-sizes="auto">

					<div class="px2 lg-px3 py1">
						<h4 class="<?php echo $title_class; ?>"><?php echo get_sub_field('title'); ?></h4>
					
						<p class="<?php echo $text_class; ?>"><?php echo get_sub_field('content'); ?></p>

						<a href="<?php echo get_sub_field('button_link'); ?>" class="<?php echo $button_class; ?>" <?php if( get_sub_field('external_link') == 1 ){echo 'rel="noopener noreferrer" target="_blank"';} ?>><?php echo get_sub_field('button_text'); ?></a>
					</div>
					
				</div>

        <?php endwhile; ?>
	  	
	</section>

<?php endif; ?>