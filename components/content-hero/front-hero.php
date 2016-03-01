<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>

<?php $hero = get_field("perf_hero_image"); ?>
<section class="clearfix">
	<div class="md-col md-col-7 relative front-hero bg-cover bg-center lazyload " data-sizes="auto"
		data-bgset="<?php echo $hero['sizes']['perfthemes-hero-lg']; ?> [(min-width: 60em)] |
			<?php echo $hero['sizes']['perfthemes-hero-md']; ?> [(min-width: 52em)] |
			<?php echo $hero['sizes']['perfthemes-hero-sm']; ?>">
	</div>
  	<div class="md-col md-col-5 dark-bg front-hero-content ">
  		<div class="table col-12 front-hero-content">
  			<div class="px2 md-px4 table-cell align-middle">
  				<h1 class="h2 separator white-color"><?php echo get_field("perf_main_title"); ?></h1>
		  		<p class="small-p mt3 lg-mt4 mb3 lg-mb4 white-color"><?php echo get_field("perf_main_content"); ?></p>
		  		<a href="<?php echo get_field("perf_main_link"); ?>" class="perf_btn mb3"><?php _e("Read more","perf"); ?></a>
  			</div>
  		</div>
  	</div>
</section>