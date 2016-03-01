<?php
/**
 * The template used for displaying section2 content.
 *
 * @package perfthemes
 */
?>

<?php $section2 = get_field("perf_section_2"); ?>

<?php if( is_array($section2) && count($section2) > 0 ): ?>
	<?php $col_width = 12 / count($section2);  ?>
	<section class="clearfix section2 bg-white table col-12">

		<?php foreach($section2 as $box ): ?>

			<?php
				if( $box['image'] ){
					$div_class = 'thumb_section2 bg-cover bg-center lazyload';
					$title_class = 'mt0 separator alt white-color h2';
					$text_class = 'white-color mb4 mt4 small-p';
					$button_class = 'perf_btn alt';
					$data_bgset = 'data-bgset="' . $box['image']['sizes']['perfthemes-hero-md'] . ' [(min-width: 60em)] |' . $box['image']['sizes']['perfthemes-hero-sm'] . '[(min-width: 52em)] | ' . $box['image']['sizes']['perfthemes-hero-sm'] . '"';
				}else{
					$div_class = 'thumb_section2';
					$title_class = 'mt0 separator h2';
					$text_class = 'mb4 mt4 small-p';
					$button_class = 'perf_btn';
				}
				
			?>
			<div class="section2_box align-middle <?php echo $div_class; ?> lg-col-<?php echo $col_width; ?>" <?php echo $data_bgset; ?>>

				<div class="px4 py4">
					<h4 class="<?php echo $title_class; ?>"><?php echo $box['title']; ?></h4>
				
					<p class="<?php echo $text_class; ?>"><?php echo $box['content']; ?></p>

					<a href="<?php echo $box['button_link']; ?>" class="<?php echo $button_class; ?>"><?php echo $box['button_text']; ?></a>
				</div>
				
			</div>

		<?php endforeach; ?>
	  	
	</section>

<?php endif; ?>