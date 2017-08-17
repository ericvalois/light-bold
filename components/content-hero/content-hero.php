<?php
/**
 * The template used for displaying hero content.
 *
 * @package ttfb
 */
?>
<?php 
    $title = '';
    $description = '';

    if ( is_home() ) {
        global $post; 
    
        if( get_option('page_for_posts', true) ){
            $title .= esc_html( get_the_title( get_option('page_for_posts', true) ) );
        }

        if( empty($title) && is_plugin_active( 'extend-lightbold/extend-lightbold.php' ) ){
            $title .= get_bloginfo("name");
        }
    
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if( $paged > 1 ){
            $title .= '&nbsp;' . esc_html__("page ","light-bold") . $paged;
        }
    }elseif( is_archive() ){
        $title .= get_the_archive_title(); 
    }elseif( is_404() ){
        $title .= esc_html__( 'Oops! That page can&rsquo;t be found.', 'light-bold' ); 
    }elseif( is_search() ){
        $title .= sprintf( esc_html__( 'Search Results for: %s', 'light-bold' ), '<span>' . get_search_query() . '</span>' );
    }else{
        $title .= get_the_title(); 
    }
?>
<?php if( !empty( $title ) ): ?>
    <div class="relative px2 sm-px3 md-px3 lg-px4 md-py3 dark-bg break-word z1">

        <?php light_bold_breadcrumbs(); ?>
        
        <h1 class="h0-responsive white-color m0 entry-title">
            <?php echo $title; ?>
        </h1>

        <?php 
            if( is_single() && get_post_type() == 'post' ){
                while ( have_posts() ) : the_post(); 
                    $description = light_bold_posted_on(); 
                endwhile; 
            }elseif( is_archive() ){
                $description = get_the_archive_description();
            }elseif( is_home() && empty( $description ) ){
                $description = get_bloginfo("description");
            }
        ?>

        <?php if( !empty( $description ) ): ?>
            <div class="entry-meta white-color upper normal-weight">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>

        <?php
            $perf_image_id = light_bold_select_hero_image();

            if( $perf_image_id ):
                $perf_image_src_sm = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-sm' );
                $perf_image_src_md = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-md' );
                $perf_image_src_lg = wp_get_attachment_image_src( $perf_image_id, 'light-bold-hero-lg' );
        ?>
                <div class="perf-main-hero bg-cover bg-center absolute top-0 left-0 right-0 bottom-0 overflow-hidden m0 p0 hide-print">
                    <div class="bg-default absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"></div>
                    <div id="perf-main-hero" class="absolute top-0 right-0 bottom-0 left-0 bg-cover bg-center"   
                        data-sizes="auto"
                        data-bgset="<?php echo esc_url( $perf_image_src_lg[0] ); ?> [(min-width: 64em)] | 
                        <?php echo esc_url( $perf_image_src_md[0] ); ?> [(min-width: 52em)] | 
                        <?php echo esc_url( $perf_image_src_sm[0] ); ?>">
                    </div>
                </div>
        <?php
            endif;
        ?>
    </div>
<?php endif; ?>