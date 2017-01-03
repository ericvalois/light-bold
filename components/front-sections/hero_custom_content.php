<?php
/**
 * The template used for displaying hero custom content.
 *
 * @package perfthemes
 */
?>

<div class="md-col-5 dark-bg relative md-table-cell">

	<?php $perf_slides = get_sub_field("custom_content"); ?>

	<div class="table col-12 front-hero-content<?php if( count($perf_slides) == 1 ){  echo " single-slide"; } ?>">
		<div class="table-cell align-middle px2 md-px3 py3">

			<div <?php if( count($perf_slides) > 1 ){ echo 'class="main-carousel is-hidden"'; } ?>>
				
				<?php if ( is_array($perf_slides) && count($perf_slides) > 0 ) : ?>

					<?php foreach( $perf_slides as $slide ): ?>

						<div class="carousel-cell">

							<h3 class="h2 entry-title separator white-color mt0"><?php echo $slide['perf_main_title']; ?></h3>
				  			<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color">
				  				<?php echo $slide['perf_main_content']; ?>
				  			</p>
				  			<a href="<?php echo $slide['perf_main_link']; ?>" class="perf_btn" <?php if( $slide['perf_main_new_window'] == 1 ){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo $slide['perf_main_button_text']; ?></a>

						</div>

					<?php endforeach; ?>

				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if( count($perf_slides) > 1 ): ?>
		<div class="button-row alt-dark-bg px2 md-px3 flex flex-stretch">
			<button class="alt-dark-bg border-none button--previous"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
			<button class="alt-dark-bg border-none button--next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
		</div>
	<?php endif; ?>

</div>