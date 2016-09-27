<?php
/**
 * The template used for displaying hero content.
 *
 * @package perfthemes
 */
?>

<div class="front-hero-section clearfix table col-12">
    <div class="md-col-7 front-hero relative hide-print md-table-cell">
        <div id="perf-main-hero" class="bg-cover bg-center absolute top-0 left-0 col-12 overflow-hidden m0 p0 "></div>
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
