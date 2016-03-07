<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>

<section class="clearfix">
	<div id="hero" class="md-col md-col-7 relative front-hero bg-cover bg-center"></div>
	
  	<div class="md-col md-col-5 dark-bg front-hero-content ">
  		<div class="table col-12 front-hero-content">
  			<div class="px2 md-px3 table-cell align-middle">
  				<h1 class=" separator white-color"><?php echo get_field("perf_main_title"); ?></h1>
		  		<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color"><?php echo get_field("perf_main_content"); ?></p>
		  		<a href="<?php echo get_field("perf_main_link"); ?>" class="perf_btn mb3"><?php _e("Read more","perf"); ?></a>
  			</div>
  		</div>
  	</div>
</section>