<?php
/**
 * The template used for displaying hero custom content.
 *
 * @package perfthemes
 */
?>

<div class="md-col-5 dark-bg relative ">

	<?php $perf_slides = get_sub_field("custom_content"); ?>

	<div class="flex flex-stretch col-12 fit front-hero-content<?php if( count($perf_slides) == 1 ){  echo " single-slide"; } ?>">
		<div class="flex flex-center front-hero col-12 px2 py3">

			<div <?php if( count($perf_slides) > 1 ){ echo 'class="col-12 main-carousel is-hidden"'; }else{ echo 'class="fit"'; } ?>>
				
				<?php if ( is_array($perf_slides) && count($perf_slides) > 0 ) : ?>

					<?php foreach( $perf_slides as $slide ): ?>

						<div class="carousel-cell col-12 px2">

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
			<button class="alt-dark-bg border-none button--previous"><svg class="fa fa-chevron-left"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-chevron-left"></use></svg></button>
			<button class="alt-dark-bg border-none button--next"><svg class="fa fa-chevron-right"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-chevron-right"></use></svg></button>
		</div>
	<?php endif; ?>

</div>