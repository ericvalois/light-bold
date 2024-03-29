<?php
/**
 * The template used for displaying sub_sections content.
 *
 * @package ttfb
 */
?>

<?php
    $id_section = get_field("perf_section_id");
    $sub_sections = get_field("perf_sub_section"); 
?>

<?php if( is_array($sub_sections) && count($sub_sections) > 0 ): ?>
	<?php $col_width = 12 / count($sub_sections);  ?>
	<section <?php if( !empty( $id_section ) ){ echo 'id="'.esc_attr( $id_section ).'"'; } ?> class="clearfix section1 dark-bg lg-flex ">
		<?php $cpt = 1; ?>
		<?php foreach($sub_sections as $box ): ?>

			<?php $image = $box['box']['image']; ?>

			<div class="lg-flex lg-col-<?php echo esc_attr( $col_width ); ?>">
				<div class="lg-flex flex-column fit col-12">
					<div class="thumb_section1 bg-cover bg-center relative lazyload"  	data-sizes="auto"
																						data-bgset="<?php echo esc_attr( $image['sizes']['light-bold-hero-md'] ); ?> [(min-width: 52em)] | 
																						<?php echo esc_attr( $image['sizes']['light-bold-hero-sm'] ); ?>">
						<div class="absolute bottom-0 left-0 z1 col-12">
							<h2 class="alt-dark-bg mt0 neg_bm1 ml2 mr2 py2 px2 separator white-color h4 entry-title"><?php echo esc_html( $box['box']['title'] ); ?></h2>
						</div>
					</div>

					<div class="ml2 mr2 px2 py2 lg-py3 alt-dark-bg mb2 md-flex flex-column flex-auto">
						<div class="flex-auto">
							<div class="white-color mb2 lg-mb3 small-p normal-weight clearfix last-mb0">
                                <?php echo wp_kses_post( $box['box']['content'] ); ?>
                            </div>

                            <?php if( !empty( $box['box']['link']['url'] )  ): ?>
                                <div><a href="<?php echo esc_url( $box['box']['link']['url'] ); ?>" class="perf_btn center" <?php if( $box['box']['link']['target'] == '_blank' ){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo esc_html( $box['box']['link']['title'] ); ?></a></div>
                            <?php endif; ?>
						</div>
					</div>

				</div>

			</div>
			<?php $cpt++; ?>
		<?php endforeach; ?>

	</section>

<?php endif; ?>