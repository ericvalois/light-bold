<?php
/**
 * Template Name: Front Page
 *
 * @package perfthemes
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php 
				/*
				* Above the Fold 
				*/
				get_template_part( 'components/content-hero/front-hero' );

				get_template_part( 'components/front-sections/sub_sections' ); 
			?>

			<?php
				/*
				* Below the Fold 
				*/
				if( function_exists('have_rows')):
				
					if( have_rows('perf_below_the_fold') ):

					    while ( have_rows('perf_below_the_fold') ) : the_row();

							if( get_row_layout() == 'text_and_button' ):

					        	get_template_part( 'components/front-sections/text_and_button' );

					        elseif( get_row_layout() == 'icon_and_text' ): 

					        	get_template_part( 'components/front-sections/icon_and_text' );

					        elseif( get_row_layout() == 'hero_section' ): 

					        	get_template_part( 'components/front-sections/hero_section' );

					        elseif( get_row_layout() == 'posts_section' ): 

					        	get_template_part( 'components/front-sections/posts_section' );

					        endif;

					    endwhile;

					endif;

				endif;

			?>

		</main>
	</div>

<?php get_footer(); ?>
