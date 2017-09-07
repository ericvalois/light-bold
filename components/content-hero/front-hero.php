<?php
/**
 * The template used for displaying hero content.
 *
 * @package ttfb
 */
?>

<div class="front-hero-section flex-stretch clearfix md-flex col-12 alt-dark-bg overflow-hidden">

    <?php $front_hero = get_field("perf_front_hero"); ?>

    <?php if( !empty( $front_hero ) ): ?>
        <?php
            $perf_image_id = $front_hero['image'];
            $perf_image_src_sm = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-sm' );
            $perf_image_src_md = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-md' );
            $perf_image_src_lg = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-lg' );
        ?>
        <div class="front-hero md-col-7 hide-print bg-cover bg-center relative">
            <div class="bg-default front-hero absolute top-0 right-0 bottom-0 left-0 z1 bg-cover bg-center"></div>
            <div id="perf-main-hero" class="front-hero absolute top-0 right-0 bottom-0 left-0 z2 bg-cover bg-center"
                data-bgset="<?php echo esc_url( $perf_image_src_lg[0] ); ?> [(min-width: 64em)] | 
                <?php echo esc_url( $perf_image_src_md[0] ); ?> [(min-width: 52em)] | 
                <?php echo esc_url( $perf_image_src_sm[0] ); ?>">
            </div>
        </div>

        <?php
            if( $front_hero['content_type'] === 'custom' ){
                get_template_part( 'components/front-sections/hero_custom_content' );
            }else{
                get_template_part( 'components/front-sections/hero_posts_content' );
            }
        ?>
    <?php endif; ?>

</div>
