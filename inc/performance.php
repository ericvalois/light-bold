<?php

/**
 * Responsive images sizes
 */
//require get_template_directory() . '/inc/responsive-images.php';

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

/*
* ASYNC scripts
*/
$disable_js_optimisation = get_field("perf_disable_js_optimisation","option");
$manual_async = get_field("perf_manual_async_js","option");

if( !is_array($disable_js_optimisation) ) $disable_js_optimisation = array();
if( !in_array("disable_js_auto_async", $disable_js_optimisation, true) && !is_admin() ){
    add_filter( 'script_loader_tag', 'perf_add_async', 10, 2 );
}elseif( is_array($manual_async) ){
    add_filter( 'script_loader_tag', 'perf_manual_async_js', 10, 2 );
}
function perf_add_async( $tag, $handle ) {
    return str_replace( ' src', ' async src', $tag );     
}

function perf_manual_async_js( $tag, $handle ) {
    global $wp_scripts;
 
    $manual_async = get_field("perf_manual_async_js","option");
    $current_script = $wp_scripts->registered[$handle]->src;
 
    if( perf_array_find($current_script,  $manual_async) ){
        return str_replace( ' src', ' async src', $tag );
    }else{
        return $tag;
    }
        
}

function perf_array_find($needle, array $haystack){
    foreach ($haystack as $key => $value) {
        if (false !== stripos($value['perf_add_asset'], $needle)) {
            return true;
        }
    }
    return false;
}

/*
* Inject loadcss function to load stylesheet async
* @link https://github.com/filamentgroup/loadCSS
*/
$perf_disable_css_optimisation = get_field("perf_disable_css_optimisation","option");
$perf_manual_async_stylesheets = get_field("perf_manual_async_stylesheets","option");

if( !is_array($perf_disable_css_optimisation) ) $perf_disable_css_optimisation = array();
if( ( !in_array("disable_css_auto_async", $perf_disable_css_optimisation, true) || is_array($perf_manual_async_stylesheets)) && !is_admin() ){
    add_filter('wp_print_styles', 'perf_inject_loadcss_script', 10);
}
function perf_inject_loadcss_script() {
    echo '<script>!function(e){"use strict";var n=function(n,t,o){var l,r=e.document,i=r.createElement("link");if(t)l=t;else{var a=(r.body||r.getElementsByTagName("head")[0]).childNodes;l=a[a.length-1]}var d=r.styleSheets;i.rel="stylesheet",i.href=n,i.media="only x",l.parentNode.insertBefore(i,t?l:l.nextSibling);var f=function(e){for(var n=i.href,t=d.length;t--;)if(d[t].href===n)return e();setTimeout(function(){f(e)})};return i.onloadcssdefined=f,f(function(){i.media=o||"all"}),i};"undefined"!=typeof module?module.exports=n:e.loadCSS=n}("undefined"!=typeof global?global:this);</script>';
}

/*
* Critical CSS
*/
if( !in_array("disable_theme_critical_css", $perf_disable_css_optimisation, true) ){
    add_action('wp_print_styles','perf_critical_css', 5);
}
function perf_critical_css()
{
    $critical_syle = "<style>";

    $critical_syle .= '/* Critical CSS */ ';

    if( is_page_template("page-templates/template-front.php") ){
        $critical_syle .= file_get_contents( get_bloginfo("template_directory") . "/critical/home.min.css");
    }elseif( is_page_template("page-templates/template-contact.php") ){
        $critical_syle .= file_get_contents( get_bloginfo("template_directory") . "/critical/contact.min.css");
    }elseif( is_archive() || is_home() || is_search() ){
        $critical_syle .= file_get_contents( get_bloginfo("template_directory") . "/critical/archive.min.css");
    }elseif( is_404() ){
        $critical_syle .= file_get_contents( get_bloginfo("template_directory") . "/critical/404.min.css");
    }else{
        $critical_syle .= file_get_contents( get_bloginfo("template_directory") . "/critical/page.min.css");
    }

    $critical_syle .= "</style>";

    echo $critical_syle;

}

/*
* Async all stylsheets by default with loadcss.js
*/
if( !in_array("disable_css_auto_async", $perf_disable_css_optimisation, true) ){
    add_filter('wp_print_styles', 'perf_loadcss_all', 20); // Inject loadcss.js call for each stylesheets
    add_filter('wp_print_styles', 'perf_dequeue_all_stylesheets', 30); // Dequeue all stylesheets
}

function perf_loadcss_all(){
    global $wp_styles;

    $queue = $wp_styles->queue;

    // Print loadcss function
    echo '<script>';
    foreach( $queue as $stylesheet ){

        echo 'loadCSS( "' . $wp_styles->registered[$stylesheet]->src . '" );';
    }
    echo '</script>';

    // Print <noscript>
    foreach( $queue as $stylesheet ){
        echo '<noscript><link href="' . $wp_styles->registered[$stylesheet]->src . '" rel="stylesheet"></noscript>';
    }
}

function perf_dequeue_all_stylesheets( ) {
    global $wp_styles;

    $queue = $wp_styles->queue;

    foreach( $queue as $handle ){
        wp_dequeue_style( $handle );
    }
}



if( is_array($perf_manual_async_stylesheets) && !is_admin() ){
    add_action('wp_print_styles', 'perf_manual_async_css', 100); 
}

function perf_manual_async_css(){
    
    global $wp_styles;

    $perf_manual_async_stylesheets = get_field("perf_manual_async_stylesheets","option");

    $dequeue = array();
    foreach( $wp_styles->queue as $handle ) :
        
        $current_src = $wp_styles->registered[$handle]->src;

        if( perf_array_find($current_src,  $perf_manual_async_stylesheets) ){
            $dequeue[] = $handle;
        }
    endforeach;

    if( count($dequeue) > 0 ){
        
        echo '<script>';
            foreach( $dequeue as $handle ) {
                wp_dequeue_style( $handle);
                echo 'loadCSS( "' . $wp_styles->registered[$handle]->src . '" );';
            }
        echo '</script>';

        foreach( $dequeue as $handle ) {
            echo '<noscript><link href="' . $wp_styles->registered[$handle]->src . '" rel="stylesheet"></noscript>';
        }

    }
    
}


