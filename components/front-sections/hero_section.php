<?php
/**
 * The template used for displaying hero_section content.
 *
 * @package perfthemes
 */
?>
<?php $perf_hero_img = perf_get_field("image"); ?>
<?php if( $perf_hero_img ): ?>
	<section class="clearfix section4 px4 py3 lg-py4 white-color bg-cover bg-center center lazyload" data-sizes="auto"
		data-bgset="<?php echo $perf_hero_img['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?>">
<?php endif; ?>

<?php
	if( function_exists('have_rows')):
					
		if( have_rows('perf_front_hero_content') ):

		    while ( have_rows('perf_front_hero_content') ) : the_row();

				if( get_row_layout() == 'custom_content' ):

		        	get_template_part( 'components/front-sections/custom_content' );

		        elseif( get_row_layout() == 'lastest_posts' ): 

		        	get_template_part( 'components/front-sections/lastest_posts' );

		        elseif( get_row_layout() == 'manual_selection' ): 

		        	get_template_part( 'components/front-sections/manual_selection' );

		        endif;

		    endwhile;

		endif;

	endif;
?>

<?php if( $perf_hero_img ): ?>
	</section>
<?php endif; ?>

<?php $perf_hero_img = get_sub_field("image"); ?>
<?php if( $perf_hero_img ): ?>
	
	<section class="clearfix section4 px4 py3 lg-py4 white-color bg-cover bg-center center lazyload" data-sizes="auto"
		data-bgset="<?php echo $perf_hero_img['sizes']['perfthemes-hero-md']; ?> [(min-width: 60em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?> [(min-width: 52em)] |
		<?php echo $perf_hero_img['sizes']['perfthemes-hero-sm']; ?>">

		<h6 class="mt0 perf_sup_title_section_4 small-p upper mb1 block"><?php echo get_sub_field("sup_title"); ?></h6>
		<span class="separator alt seprarator-center"></span>
		<span class="block line-height2 h1 mb2 md-mb3 mt2"><?php echo get_sub_field("title"); ?></span>
		<a href="<?php echo get_sub_field("button_link"); ?>" class="perf_btn alt table mx-auto" <?php if( get_sub_field("external_link") == 1){ echo 'target="_blank"'; } ?>><?php echo get_sub_field("button_label"); ?></a>
		
	</section>

<?php endif; ?>