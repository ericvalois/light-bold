<?php
/**
 * The template used for displaying sub_sections content.
 *
 * @package perfthemes
 */
?>

<?php $sub_sections = get_field("perf_above_fold_sub_section"); ?>

<?php if( is_array($sub_sections) && count($sub_sections) > 0 ): ?>
	<?php $col_width = 12 / count($sub_sections);  ?>
	<section class="clearfix section1 dark-bg lg-flex ">
		<?php $cpt = 1; ?>
		<?php foreach($sub_sections as $box ): ?>

			<?php $image = $box['image']; ?>

			<div class="lg-flex lg-col-<?php echo $col_width; ?>">
				<div class="lg-flex flex-column fit col-12">
					<div class="thumb_section1 bg-cover bg-center relative lazyload"  	data-sizes="auto"
																						data-bgset="<?php echo $image['sizes']['light-bold-hero-md']; ?> [(min-width: 52em)] | 
																						<?php echo $image['sizes']['light-bold-hero-sm']; ?>">
						<div class="absolute bottom-0 left-0 z1 col-12">
							<h3 class="alt-dark-bg mt0 neg_bm1 ml2 mr2 py2 px2 separator white-color h4 entry-title"><?php echo $box['title']; ?></h3>
						</div>
					</div>

					<div class="ml2 mr2 px2 py2 lg-py3 alt-dark-bg mb2 md-flex flex-column flex-auto">
						<div class="flex-auto">
							<p class="white-color mb2 lg-mb3 small-p "><?php echo $box['content']; ?></p>
						</div>

						<div><a href="<?php echo $box['button_link']; ?>" class="perf_btn center" <?php if( $box['open_in_a_new_window'] ){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo $box['button_text']; ?></a></div>
						
					</div>

				</div>

			</div>
			<?php $cpt++; ?>
		<?php endforeach; ?>

	</section>

<?php endif; ?>
