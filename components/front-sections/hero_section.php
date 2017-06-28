<?php
/**
 * The template used for displaying hero_section content.
 *
 * @package ttfb
 */
?>
<?php $perf_hero_img = get_sub_field("image"); ?>
<?php if( $perf_hero_img ): ?>
	
	<section class="clearfix section4 px4 py3 lg-py4 white-color center dark-bg relative z1">

        
        <div class="z-3 mutted absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center lazyload"  data-sizes="auto"
		data-bgset="<?php echo esc_attr( $perf_hero_img['sizes']['light-bold-hero-md'] ); ?> [(min-width: 60em)] |
		<?php echo esc_attr( $perf_hero_img['sizes']['light-bold-hero-sm'] ); ?> [(min-width: 52em)] |
		<?php echo esc_attr( $perf_hero_img['sizes']['light-bold-hero-sm'] ); ?>"
        data-sizes="auto"></div>
                    

		<h6 class="mt0 perf_sup_title_section_4 small-p upper mb1 block entry-title"><?php echo esc_html( get_sub_field("sup_title") ); ?></h6>
		<span class="separator alt seprarator-center"></span>
		<span class="block line-height2 h1 mb2 md-mb3 mt2 entry-title"><?php echo wp_kses( get_sub_field("title"), array( 'br' => array() ) ); ?></span>
		<a href="<?php echo esc_url( get_sub_field("button_link") ); ?>" class="perf_btn alt table mx-auto" <?php if( get_sub_field("external_link") == 1){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo esc_html( get_sub_field("button_label") ); ?></a>
		
	</section>

<?php endif; ?>