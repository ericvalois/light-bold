<?php
/**
 * The template used for displaying text_and_button content.
 *
 * @package ttfb
 */
?>



<?php $items = get_sub_field("repeater_text_and_button"); ?>

<?php if( have_rows('repeater_text_and_button') ): ?>
	<?php 
		$col_width = 12 / count($items);  
	?>

	<section class="clearfix section2 alt-dark-bg lg-flex flex-stretch col-12 ">

		<?php while ( have_rows('repeater_text_and_button') ) : the_row(); ?>


				<?php
					if( get_sub_field('image') ){
						$bg_class = 'bg-cover bg-center lazyload';
						$title_class = 'mt0 separator alt white-color h3 entry-title';
						$text_class = 'white-color mb2 mt2 lg-mb3 lg-mt3 small-p normal-weight';
						$button_class = 'perf_btn alt';

						$image = get_sub_field('image');
						$data_bgset = 'data-bgset="' . esc_url( $image['sizes']['light-bold-hero-sm'] ) . ' [(max-width: 52em)] | ' . esc_url( $image['sizes']['light-bold-hero-md'] ) . ' [(min-width: 52em) and (max-width: 60em)] | '  . esc_url( $image['sizes']['light-bold-hero-lg'] ) . ' [(min-width: 60em)]"';
						$date_expand = 'data-expand="50"';
					}else{
						$bg_class = '';
						$title_class = 'mt0 separator h3 entry-title';
						$text_class = 'mb2 mt2 lg-mb3 lg-mt3 small-p';
						$button_class = 'perf_btn';
						$data_bgset = "";
						$date_expand = '';
					}
					
				?>
				<div class="py4 relative z1 <?php if( !get_sub_field('image') ){ echo 'bg-white'; }else{ echo 'dark-bg'; } ?> lg-col-<?php echo esc_attr( $col_width ); ?>">

                    <?php if( get_sub_field('image') ): ?>
                        <div class="z-3 mutted absolute top-0 right-0 bottom-0 left-0 <?php echo esc_attr( $bg_class ); ?>" <?php echo $data_bgset; ?> <?php echo $date_expand; ?> data-sizes="auto"></div>
                    <?php endif; ?>

					<div class="px2 lg-px3 py1">
						<h4 class="<?php echo esc_attr( $title_class ); ?>"><?php echo get_sub_field('title'); ?></h4>
					
						<div class="<?php echo esc_attr( $text_class ); ?>">
                            <?php 
                                $args = array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'em' => array(),
                                    'strong' => array(),
                                    'ul' => array(),
                                    'ol' => array(),
                                    'li' => array(),
                                    'p' => array(),
                                );
                                echo wp_kses( get_sub_field('content'), $args );
                            ?>
                        </div>

                        <?php if( get_sub_field('button_link') && get_sub_field('button_text') ): ?>
						    <a href="<?php echo esc_url( get_sub_field('button_link') ); ?>" class="<?php echo esc_attr( $button_class ); ?>" <?php if( get_sub_field('external_link') == 1 ){echo 'rel="noopener noreferrer" target="_blank"';} ?>><?php echo esc_html( get_sub_field('button_text') ); ?></a>
                        <?php endif; ?>
                    </div>
					
				</div>

        <?php endwhile; ?>
	  	
	</section>

<?php endif; ?>