<?php
/**
 * Performance module
 *
 * @package perfthemes
 */

/**
 * Lazy Load
 */
require get_template_directory() . '/inc/lazyload.php';

// remove WP version from css
add_filter( 'style_loader_src', 'perf_remove_wp_ver_css_js', 9999 ); 

// remove Wp version from scripts
add_filter( 'script_loader_src', 'perf_remove_wp_ver_css_js', 9999 );

function perf_remove_wp_ver_css_js( $src ) {
    return rtrim( str_replace( array( 'ver='.$GLOBALS['wp_version'], '?&', '&&' ), array( '', '?', '&' ), $src ), '?&' );
}

function on_page_css_optimisation(){

    global $post;

    if( is_object( $post ) ){
        $on_page_css_optimisation_disabled = perf_get_field('perf_on_page_css_optimisation_disabled', $post->ID);
    }else{
        $on_page_css_optimisation_disabled = false;  
    }

    return $on_page_css_optimisation_disabled;
}

function on_page_js_optimisation(){

    global $post;

    if( is_object( $post ) ){
        $on_page_js_optimisation_disabled = perf_get_field('perf_on_page_js_optimisation_disabled', $post->ID);
    }else{
        $on_page_js_optimisation_disabled = false;
    }

    return $on_page_js_optimisation_disabled;
}

/*
* ASYNC scripts
*/
add_filter( 'script_loader_tag', 'perf_add_async', 10, 2 );
function perf_add_async( $tag, $handle ) {

    if( !on_page_js_optimisation() && perf_get_field('perf_js_optimisation_active', 'option') && !is_admin() ){
        return str_replace( ' src', ' async src', $tag );
    }else{
        return $tag;
    }

}

/*
* Inject loadcss function to load stylesheet async
* @link https://github.com/filamentgroup/loadCSS
*/
add_filter('wp_print_styles', 'perf_inject_loadcss_script', 10);
function perf_inject_loadcss_script() {

    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
        echo '<script>!function(e){"use strict";var n=function(n,t,o){var l,r=e.document,i=r.createElement("link");if(t)l=t;else{var a=(r.body||r.getElementsByTagName("head")[0]).childNodes;l=a[a.length-1]}var d=r.styleSheets;i.rel="stylesheet",i.href=n,i.media="only x",l.parentNode.insertBefore(i,t?l:l.nextSibling);var f=function(e){for(var n=i.href,t=d.length;t--;)if(d[t].href===n)return e();setTimeout(function(){f(e)})};return i.onloadcssdefined=f,f(function(){i.media=o||"all"}),i};"undefined"!=typeof module?module.exports=n:e.loadCSS=n}("undefined"!=typeof global?global:this);</script>';
    }
}

/*
* Critical CSS
*/

add_action('perf_mobile_styles','perf_critical_css', 5);
function perf_critical_css()
{
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
        $critical_syle = '/* Critical CSS */ ';

        if( is_page_template("page-templates/template-front.php") ){
            $critical_syle .= perf_get_response( get_template_directory_uri() . "/critical/home.min.css");
        }elseif( is_page_template("page-templates/template-contact.php") ){
            $critical_syle .= perf_get_response( get_template_directory_uri() . "/critical/contact.min.css");
        }elseif( is_archive() || is_home() || is_search() ){
            $critical_syle .= perf_get_response( get_template_directory_uri() . "/critical/archive.min.css");
        }elseif( is_single() ){
            $critical_syle .= perf_get_response( get_template_directory_uri() . "/critical/single.min.css");
        }else{
            $critical_syle .= perf_get_response( get_template_directory_uri() . "/critical/page.min.css");
        }

        echo $critical_syle;
    }

}

/*
* Async all stylsheets with loadcss.js
*/
add_filter('wp_print_styles', 'perf_async_stylsheets', 20); // Inject loadcss.js call for each stylesheets
function perf_async_stylsheets(){
    
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){

        global $wp_styles;

        $queue = $wp_styles->queue;

        // Print loadcss function
        echo '<script>';
        foreach( $queue as $stylesheet ){
            if( $stylesheet != "admin-bar" ){
                echo 'loadCSS( "' . $wp_styles->registered[$stylesheet]->src . '" );';
            }
        }
        echo '</script>';

        // Print <noscript>
        foreach( $queue as $stylesheet ){
            if( $stylesheet != "admin-bar" ){
                echo '<noscript><link href="' . $wp_styles->registered[$stylesheet]->src . '" rel="stylesheet"></noscript>';
            }
        }

        //echo '<pre>'; print_r($queue); echo '</pre>'; exit();
    }
}

add_filter('wp_print_styles', 'perf_dequeue_stylesheets', 30); // Dequeue all stylesheets
function perf_dequeue_stylesheets( ) {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
        global $wp_styles;
        $queue = $wp_styles->queue;

        foreach( $queue as $handle ){
            if( $handle != "admin-bar" ){
                wp_dequeue_style( $handle );
            }
        }
    }
}

/*
* Preload
*/
add_action( 'perf_head_open', 'perf_preload' );
function perf_preload() {
    $active_preload = perf_get_field("perf_preload_active","option");
    $logo_sm = perf_get_field("perf_log_sm","option");
    $logo_md = perf_get_field("perf_log_md","option");
    $logo_lg = perf_get_field("perf_log_lg","option");

    if( $active_preload && $logo_sm ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_sm","option"); ?>" media="(max-width: 1200px)">
	<?php
    }

    if( $active_preload && $logo_md ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_md","option"); ?>" media="(min-width: 1200px) and (max-width: 1650px)">
    <?php
    }

    if( $active_preload && $logo_lg ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_lg","option"); ?>" media="(min-width: 1650px)">
	<?php
    }

    $perf_image_id = perf_select_hero_image();
    $perf_image_src_sm = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-sm' );
    $perf_image_src_md = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-md' );
    $perf_image_src_lg = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-lg' );

    if( $perf_image_id && $active_preload ){
    ?>
        <link rel="preload" as="image" href="<?php echo $perf_image_src_sm[0]; ?>" media="(max-width: 52em)">
        <link rel="preload" as="image" href="<?php echo $perf_image_src_md[0]; ?>" media="(min-width: 52em) and (max-width: 64em)">
        <link rel="preload" as="image" href="<?php echo $perf_image_src_lg[0]; ?>" media="(min-width: 64em)">
    <?php
    }

    if( is_page_template("page-templates/template-front.php") && $active_preload ){
        global $post;

        $sub_sections = get_field("perf_above_fold_sub_section", $post->ID);
        if( is_array($sub_sections) && count($sub_sections) > 0 ){
            foreach( $sub_sections as $box ){
    ?>
                <link rel="preload" as="image" href="<?php echo $box['image']['sizes']['perfthemes-hero-sm']; ?>" media="(max-width: 64em)">
                <link rel="preload" as="image" href="<?php echo $box['image']['sizes']['perfthemes-hero-md']; ?>" media="(min-width: 64em)">
    <?php
            }
        }
    }
}

/*
* More preload added by user
*/
add_action( 'perf_head_open', 'perf_more_preload' );
function perf_more_preload() {
    if( perf_get_field("perf_preload_active","option") && !empty( perf_get_field("perf_add_preload","option") ) ){
        echo perf_get_field("perf_add_preload","option");
    }
}


/*
* Critical mobile fix
*/
add_action( 'perf_mobile_styles', 'perf_critical_mobile_fix' );
function perf_critical_mobile_fix() {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
    ?>
        h1.entry-title {
            padding-top: 13vh;
            padding-bottom: 15vh;
        }

        .small-p, .comment-meta, .textwidget {
            font-size: 16px;
        }

        .main-carousel.is-hidden {
          display: none;
        }

        .main-carousel.flickity-enabled {
          opacity: 1;
        }

        .nav-container{transform: translateX(-100%);}

        .button-row{
            display: flex;
            display: -ms-flexbox;
            align-items: stretch;
        }

        .button-row button{
          border-right: 1px solid #403e3e;
        }

        .button-row button.button--previous{
          border-left: 1px solid #403e3e;
        }

        .perf-main-hero { box-sizing: border-box; }

    <?php
    }
}

/*
* Critical md  fix
*/
add_action( 'perf_md_styles', 'perf_critical_md_fix' );
function perf_critical_md_fix() {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
    ?>
        h1.entry-title {
            padding-top: 12.66666666vh;
            padding-bottom: 14.66666666vh;
        }

        .front-hero, .front-hero-content { min-height: 58.33333vh; }

        @-moz-document url-prefix() { 
            .front-hero-section{ height: 600px; min-height: 58.33333vh;  }
        }

        .h0-responsive { font-size: 6vw; }

    <?php
    }
}

/*
* Critical lg  fix
*/
add_action( 'perf_lg_styles', 'perf_critical_lg_fix' );
function perf_critical_lg_fix() {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
    ?>
        #primary-menu a, .main-search input[type="search"] { min-height: 8.33333vh; }

    <?php
    }
}

/*
* Critical 1200  fix
*/
add_action( 'perf_1200_styles', 'perf_critical_1200_fix' );
function perf_critical_1200_fix() {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
    ?>
        .main-header_container,
        .site-logo {
            display: flex;
            align-items: center;
            display: -ms-flexbox; 
            -ms-flex-align: center;
        }

        .sub-menu {
            display: none; /* Fix fout on page load */
        }

        .nav-container{transform: translateX(0);}

        .nav-container.multi_level {
            margin-top: 225px;
        }

        .nav-container.multi_level .menu__breadcrumbs{
            top: -75px;
        }

    <?php
    }
}

/*
* Critical 96em fix
* 1650px
*/
add_action( 'perf_96em_styles', 'perf_critical_96em_fix' );
function perf_critical_96em_fix() {
    if( !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
    ?>
        .h0-responsive { font-size: 5.76rem; }

        .nav-container.multi_level {
            margin-top: 275px;
        }



    <?php
    }
}

/*
* Critical admin bar
*/
add_action( 'perf_mobile_styles', 'perf_critical_admin' );
function perf_critical_admin() {
    if ( is_user_logged_in() && !on_page_css_optimisation() && perf_get_field("perf_css_optimisation_active","option") && !is_admin() ){
        $critical_syle = perf_get_response( get_template_directory_uri() . "/critical/critical-admin.css");
        echo $critical_syle;
    }
}
