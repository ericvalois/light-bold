<?php
/**
 * The template used for displaying icon_and_text content.
 *
 * @package ttfb
 */
?>

<?php 
    $id_section = get_sub_field("section_id");
	$items = get_sub_field("repeater_icon_and_text"); 
	$nb_per_row = get_sub_field("radio_icon_and_text_layout"); 
	$icon_section_title = get_sub_field("icon_section_title");
	$link = get_sub_field("icon_section_button");
?>
<?php if( have_rows('repeater_icon_and_text') ): ?>
	<?php $col_width = 12 / $nb_per_row;  ?>
	<section <?php if( !empty( $id_section ) ){ echo 'id="'.esc_attr( $id_section ).'"'; } ?> class="clearfix icon_section py3 lg-py4 px1 px2 lg-px3 md-flex flex-wrap flex-stretch">
		<?php
			if( $col_width == 3 ){
				$col_class = "md-col-6 lg-col-3";
			}else{
				$col_class = "md-col-" . $col_width;
			}
		?>

		

		<?php if( $icon_section_title ): ?>
			<?php if( !empty( $link['url'] ) ): ?>
				<a href="<?php echo esc_attr( $link['url'] ); ?>" class="icon_section_box bg-main-color <?php echo esc_attr( $col_class ); ?> flex flex-center flex-auto  white-color py2 px2 lg-py3 lg-px3">
			<?php else: ?>
				<div class="icon_section_box bg-main-color <?php echo esc_attr( $col_class ); ?> flex flex-center flex-auto  white-color py2 px2 lg-py3 lg-px3">
			<?php endif; ?>

				<div>
					<h3 class="weight-1 m0"><?php echo esc_html( $icon_section_title ); ?></h3>
					<?php if( !empty( $link['title'] ) ): ?>
						<span class="small-p upper mt1"><?php echo esc_html( $link['title'] ); ?></span>
					<?php endif; ?>
				</div>

			<?php if( !empty( $link['url'] ) ): ?>
				</a>
			<?php else: ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php $cpt = 1; while ( have_rows('repeater_icon_and_text') ) : the_row(); ?>
			
			<?php if( get_sub_field('link') ): ?>
                <?php
                    if( get_sub_field('external') ){
                        $external = '_blank';
                    }else{
                        $external = '';
                    }
                ?>
				<a href="<?php echo esc_attr( get_sub_field('link') ); ?>" target="<?php echo esc_attr( $external ); ?>" class="icon_section_box <?php echo esc_attr( $col_class ); ?> bg-white flex flex-center flex-auto py2 px2 lg-py3 lg-px3">
			<?php else: ?>
				<div class="icon_section_box <?php echo esc_attr( $col_class ); ?> bg-white flex flex-center flex-auto py2 px2 lg-py3 lg-px3">
			<?php endif; ?>

				<div>
					<?php if( get_sub_field('icon_name') ): ?>
						<div class="front_icon">
							<svg class="fa flex-none <?php echo esc_attr( get_sub_field('icon_name') ); ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo esc_attr( get_sub_field('icon_name') ); ?>"></use></svg>
						</div>
					<?php endif; ?>
					<p class="small-p mt1 mb1 bold "><?php echo esc_html( get_sub_field('title') ); ?></p>
					<p class="small-p  mb0"><?php echo wp_kses_post( get_sub_field('content') ); ?></p>
				</div>
				
			<?php if( get_sub_field('link') ): ?>
				</a>
			<?php else: ?>
				</div>
			<?php endif; ?>

		<?php $cpt++; endwhile; ?>
	  	
	</section>

<?php endif; ?>