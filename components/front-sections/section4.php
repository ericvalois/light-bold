<?php
/**
 * The template used for displaying section4 content.
 *
 * @package perfthemes
 */
?>

<?php $section_4_img = get_field("perf_hero_image_section_4"); ?>
<?php if( $section_4_img ): ?>
	<section class="clearfix section4 px4 py3 lg-py4 white-color bg-cover bg-center center lazyload" data-sizes="auto"
		data-bgset="<?php echo $section_4_img['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
		<?php echo $section_4_img['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
		<?php echo $section_4_img['sizes']['perfthemes-hero-sm']; ?>">

		<span class="mt0 perf_sup_title_section_4 small-p upper mb1 block"><?php echo get_field("perf_sup_title_section_4"); ?></span>
		<span class="separator alt seprarator-center"></span>
		<span class="block lighter line-height2 h1-responsive mb2 md-mb3 mt2"><?php echo get_field("perf_title_section_4"); ?></span>
		<a href="<?php echo get_field("perf_link_section_4"); ?>" class="perf_btn alt table mx-auto"><?php _e("Read more","perf"); ?></a>
		
	  	
	</section>

<?php endif; ?>