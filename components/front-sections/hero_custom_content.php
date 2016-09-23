<?php
/**
 * The template used for displaying hero custom content.
 *
 * @package perfthemes
 */
?>

<div class="md-col-5 dark-bg relative">
	<div class="table col-12 front-hero-content">
		<div class="table-cell align-middle px2 md-px3 py3">
			<?php
				$perf_slides = get_sub_field("custom_content");
			?>

			<div <?php if( count($perf_slides) > 1 ){ echo 'class="main-carousel is-hidden"'; } ?>>
				
				<?php if ( is_array($perf_slides) && count($perf_slides) > 0 ) : ?>

					<?php foreach( $perf_slides as $slide ): ?>

						<div class="carousel-cell">

							<h3 class="h3 separator white-color mt0"><?php echo $slide['perf_main_title']; ?></h3>
				  			<p class="small-p mt2 lg-mt3 mb2 lg-mb3 white-color">
				  				<?php echo $slide['perf_main_content']; ?>
				  			</p>
				  			<a href="<?php echo $slide['perf_main_link']; ?>" class="perf_btn" <?php if( $slide['perf_main_new_window'] == 1 ){ echo 'target="_blank"'; } ?>><?php echo $slide['perf_main_button_text']; ?></a>

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

		<?php
			wp_enqueue_script( 'perf-flickity', get_template_directory_uri() . '/inc/3rd-party/flickity/flickity.min.js', array(), '', true );
			
			// Custom Flickity Listener
			add_action("wp_footer","perf_add_flickity_listener"); 
		?>
	<?php endif; ?>

</div>