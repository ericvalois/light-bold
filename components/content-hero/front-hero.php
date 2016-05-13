<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>

<section class="clearfix table col-12">
	<div class="md-table-cell md-col-7 front-hero relative">
        <div id="perf-main-hero" class="bg-cover bg-center absolute top-0 left-0 col-12 overflow-hidden m0 p0"></div> 
    </div>
	
  	<div class="md-table-cell md-col-5 dark-bg front-hero-content ">
  		<div class="table col-12 front-hero-content">
  			<div class="px2 md-px3 table-cell align-middle py2">
  				<h1 class="h3 separator white-color py2"><?php echo get_field("perf_main_title"); ?></h1>
		  		<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color"><?php echo get_field("perf_main_content"); ?></p>
		  		<a href="<?php echo get_field("perf_main_link"); ?>" class="perf_btn mb3"><?php _e("Read more","perf"); ?></a>
  			</div>
  		</div>
  	</div>

    

</section>