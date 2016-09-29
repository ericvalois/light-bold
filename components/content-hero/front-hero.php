<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>

<div class="front-hero-section clearfix md-table col-12">
    <div id="perf-main-hero" class="md-col-7 front-hero relative hide-print md-table-cell bg-cover bg-center">
        
    </div>

    <?php
        if( function_exists('have_rows')):
                        
            if( have_rows('perf_front_hero_content') ):

                while ( have_rows('perf_front_hero_content') ) : the_row();

                    if( get_row_layout() == 'custom_content' ):

                        get_template_part( 'components/front-sections/hero_custom_content' );

                    elseif( get_row_layout() == 'posts_content' ): 

                        get_template_part( 'components/front-sections/hero_posts_content' );

                    endif;

                endwhile;

            endif;

        endif;
    ?>

</div>
