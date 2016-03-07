<?php
/**
 * The template used for displaying section1 content.
 *
 * @package perfthemes
 */
?>

<?php $section1 = get_field("perf_section_1"); ?>

<?php if( is_array($section1) && count($section1) > 0 ): ?>
	<?php $col_width = 12 / count($section1);  ?>
	<section class="clearfix section1 dark-bg">

		<?php foreach($section1 as $box ): ?>

			<div class="md-col md-col-<?php echo $col_width; ?> ">

				<div class="thumb_section1 bg-cover bg-center lazyload relative" data-sizes="auto"
					data-bgset="<?php echo $box['image']['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
					<?php echo $box['image']['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
					<?php echo $box['image']['sizes']['perfthemes-hero-sm']; ?>">
					<div class="absolute bottom-0 left-0 z1 col-12 neg_title ">
						<h3 class="dark-bg mt0 neg_bm1 ml2 mr2 py2 px2 separator white-color h2"><?php echo $box['title']; ?></h3>
					</div>
				</div>

				<div class="ml2 mr2 px2 py2 lg-py3">
					<p class="white-color mb2 lg-mb3 small-p"><?php echo $box['content']; ?></p>

					<a href="<?php echo $box['button_link']; ?>" class="perf_btn"><?php echo $box['button_text']; ?></a>
				</div>

			</div>

		<?php endforeach; ?>
	  	
	</section>

<?php endif; ?>