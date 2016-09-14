<?php
/**
 * The template used for displaying icon_and_text content.
 *
 * @package perfthemes
 */
?>

<?php 
	$items = get_sub_field("repeater_icon_and_text"); 
	$nb_per_row = get_sub_field("radio_icon_and_text_layout"); 
?>

<?php if( have_rows('repeater_icon_and_text') ): ?>
	<?php $col_width = 12 / $nb_per_row;  ?>
	<section class="clearfix section3 bg-main-color py3 lg-py4">

		<?php $cpt = 1; while ( have_rows('repeater_icon_and_text') ) : the_row(); ?>
			
			<?php
				if( $col_width == 3 ){
					$col_class = "md-col-6 lg-col-3";
				}else{
					$col_class = "md-col-" . $col_width;
				}
			?>
			<div class="section3_box md-col <?php echo $col_class; ?> px2 lg-px3 mt1 mb1 lg-mt2 lg-mb2">

				<div class="table">
					<div class="table-cell align-top white-color">
						<?php echo get_sub_field('icon'); ?>
					</div>
				
					<div class="table-cell align-top white-color pl2">
						<h4 class="mt0 h4"><?php echo get_sub_field('title'); ?></h4>

						<p class="small-p mb0"><?php echo get_sub_field('content'); ?></p>
					</div>
				</div>
				
			</div>
			<?php if( $col_width == 3 && $cpt % 2 == 0 ){ echo '<div class="lg-hide clearfix"></div>'; } ?>
			<?php if( $cpt % $nb_per_row == 0 ){ echo '<div class="clearfix"></div>'; } ?>

		<?php $cpt++; endwhile; ?>
	  	
	</section>

<?php endif; ?>