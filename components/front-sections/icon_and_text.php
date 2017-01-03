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
	$icon_section_title = get_sub_field("icon_section_title");
	$title_button_label = get_sub_field("icon_button_label");
	$title_button_link = get_sub_field("icon_button_link");
?>
<?php if( have_rows('repeater_icon_and_text') ): ?>
	<?php $col_width = 12 / $nb_per_row;  ?>
	<section class="clearfix icon_section py3 lg-py4 px1 sm-px2 md-px3 md-flex flex-wrap flex-stretch">
		<?php
			if( $col_width == 3 ){
				$col_class = "md-col-6 lg-col-3";
			}else{
				$col_class = "md-col-" . $col_width;
			}
		?>

		

		<?php if( $icon_section_title ): ?>
			<?php if( $title_button_link ): ?>
				<a href="<?php echo $title_button_link; ?>" class="icon_section_box bg-main-color <?php echo $col_class; ?> flex flex-center white-color py2 md-py2 lg-py3 px2 md-py2 lg-px3">
			<?php else: ?>
				<div class="icon_section_box bg-main-color <?php echo $col_class; ?> flex flex-center white-color py2 md-py2 lg-py3 px2 md-py2 lg-px3">
			<?php endif; ?>

				<div>
					<h3 class="weight-1 m0"><?php echo $icon_section_title; ?></h3>
					<?php if( $title_button_label ): ?>
						<span class="small-p upper"><?php echo $title_button_label; ?></span>
					<?php endif; ?>
				</div>

			<?php if( $title_button_link ): ?>
				</a>
			<?php else: ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php $cpt = 1; while ( have_rows('repeater_icon_and_text') ) : the_row(); ?>
			
			<?php if( get_sub_field('link') ): ?>
				<a href="<?php echo get_sub_field('link'); ?>" class="icon_section_box <?php echo $col_class; ?> bg-white flex flex-center py2 md-py2 lg-py3 px2 md-py2 lg-px3">
			<?php else: ?>
				<div class="icon_section_box <?php echo $col_class; ?> bg-white flex flex-center py2 md-py2 lg-py3 px2 md-py2 lg-px3">
			<?php endif; ?>

				<div>
					<div class="front_icon">
						<svg class="fa flex-none <?php echo get_sub_field('icon_name'); ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo get_sub_field('icon_name'); ?>"></use></svg>
					</div>
					<p class="small-p mt1 mb1 bold "><?php echo get_sub_field('title'); ?></p>
					<p class="small-p  mb0"><?php echo get_sub_field('content'); ?></p>
				</div>
				
			<?php if( get_sub_field('link') ): ?>
				</a>
			<?php else: ?>
				</div>
			<?php endif; ?>

			<?php if( $col_width == 3 && $cpt % 2 == 0 ){ echo '<div class="lg-hide clearfix"></div>'; } ?>
			<?php if( $cpt % $nb_per_row == 0 ){ echo '<div class="clearfix"></div>'; } ?>

		<?php $cpt++; endwhile; ?>
	  	
	</section>

<?php endif; ?>