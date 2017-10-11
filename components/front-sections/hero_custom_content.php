<?php
/**
 * The template used for displaying hero custom content.
 *
 * @package ttfb
 */
?>

<div class="md-col-5 dark-bg relative ">

	<?php
        $front_hero = get_field("perf_front_hero");
        $perf_slides = $front_hero['custom_content']; 
    ?>

	<div class="flex flex-stretch col-12 fit front-hero-content<?php if( count($perf_slides) == 1 ){  echo " single-slide"; } ?>">
		<div class="flex flex-center front-hero col-12 px2 py3">

			<div <?php if( count($perf_slides) > 1 ){ echo 'class="col-12 main-carousel is-hidden"'; }else{ echo 'class="fit"'; } ?>>
				
				<?php if ( is_array($perf_slides) && count($perf_slides) > 0 ) : ?>

					<?php foreach( $perf_slides as $slide ): ?>

						<div class="carousel-cell col-12 md-px1">

                            <?php if( !empty( $slide['title'] ) ): ?>
                                <?php if( count($perf_slides) > 1): ?>
							        <h3 class="h2 separator white-color mt0 mb0"><?php echo esc_html( $slide['title'] ); ?></h3>
                                <?php else: ?>
                                    <h1 class="h2 separator white-color mt0 mb0"><?php echo esc_html( $slide['title'] ); ?></h1>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if( !empty( $slide['content'] ) ): ?>
                                <div class="small-p mt2 mb2 lg-mb3 white-color clearfix last-mb0">
                                    <?php echo wp_kses_post( $slide['content'] ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if( !empty( $slide['btn']['url'] ) && !empty( $slide['btn']['title'] ) ): ?>
				  			    <a href="<?php echo esc_url( $slide['btn']['url'] ); ?>" class="perf_btn" <?php if( $slide['btn']['target'] === '_blank' ){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo esc_html( $slide['btn']['title'] ); ?></a>
                            <?php endif; ?>
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