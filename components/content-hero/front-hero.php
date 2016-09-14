<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>
<?php
    if( get_field("perf_main_title") ){
        $perf_full_width = false;
    }else{
        $perf_full_width = true;
    }
?>
<div class="clearfix md-flex md-flex-stretch col-12">
    <div class="<?php if( !$perf_full_width ){ echo 'md-col-7'; }else{ echo 'front-hero-content col-12';} ?> front-hero relative hide-print">
        <div id="perf-main-hero" class="bg-cover bg-center absolute top-0 left-0 col-12 overflow-hidden m0 p0"></div>
    </div>

    <?php if( !$perf_full_width ): ?>
      	<div class="md-col-5 dark-bg front-hero-content ">
      		<div class="table col-12 front-hero-content">
      			<div class="px2 md-px3 table-cell align-middle py2">
      				<h1 class="h3 separator white-color mt2"><?php echo get_field("perf_main_title"); ?></h1>
    		  		<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color"><?php echo get_field("perf_main_content"); ?></p>
    		  		<a href="<?php echo get_field("perf_main_link"); ?>" class="perf_btn mb3" <?php if( get_field("perf_main_new_window") ){ echo 'target="_blank"'; } ?>><?php echo get_field("perf_main_button_text"); ?></a>
      			</div>
      		</div>
      	</div>
    <?php endif; ?>

</div>
