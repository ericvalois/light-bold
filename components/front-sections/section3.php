<?php
/**
 * The template used for displaying section3 content.
 *
 * @package perfthemes
 */
?>

<?php 
	$section3 = get_field("perf_section_3"); 
	$nb_per_row = get_field("perf_section3_items_row"); 
?>

<?php if( is_array($section3) && count($section3) > 0 ): ?>
	<?php $col_width = 12 / $nb_per_row;  ?>
	<section class="clearfix section3 bg-main-color py3 lg-py4">

		<?php $cpt = 1; foreach($section3 as $box ): ?>
			
			<div class="section3_box col md-col-<?php echo $col_width; ?> px2 lg-px3 mt1 mb1 lg-mt2 lg-mb2">

				<div class="table">
					<div class="table-cell align-top white-color">
						<?php echo $box['icon']; ?>
					</div>
				
					<div class="table-cell align-top white-color pl2">
						<h4 class="mt0 h2"><?php echo $box['title']; ?></h4>

						<p class="small-p mb0"><?php echo $box['content']; ?></p>
					</div>
				</div>
				
			</div>

			<?php if( $cpt % $nb_per_row == 0 ){ echo '<div class="clearfix"></div>'; } ?>

		<?php $cpt++; endforeach; ?>
	  	
	</section>

<?php endif; ?>