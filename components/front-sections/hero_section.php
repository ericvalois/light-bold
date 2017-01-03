<?php
/**
 * The template used for displaying hero_section content.
 *
 * @package perfthemes
 */
?>
<?php $perf_hero_img = get_sub_field("image"); ?>
<?php if( $perf_hero_img ): ?>
	
	<section class="clearfix section4 px4 py3 lg-py4 white-color bg-cover bg-center center lazyload" data-sizes="auto"
		data-bgset="<?php echo $perf_hero_img['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?>">

		<h6 class="mt0 perf_sup_title_section_4 small-p upper mb1 block entry-title"><?php echo get_sub_field("sup_title"); ?></h6>
		<span class="separator alt seprarator-center"></span>
		<span class="block line-height2 h1 mb2 md-mb3 mt2 entry-title"><?php echo get_sub_field("title"); ?></span>
		<a href="<?php echo get_sub_field("button_link"); ?>" class="perf_btn alt table mx-auto" <?php if( get_sub_field("external_link") == 1){ echo 'rel="noopener noreferrer" target="_blank"'; } ?>><?php echo get_sub_field("button_label"); ?></a>
		
	</section>

<?php endif; ?>