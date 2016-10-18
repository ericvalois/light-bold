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

/*
* ASYNC scripts
*/
$perf_disable_js_optimisation = perf_get_field("perf_disable_js_optimisation","option");

if( !is_array($perf_disable_js_optimisation) ) $perf_disable_js_optimisation = array();
if( !in_array("disable_js_auto_async", $perf_disable_js_optimisation, true) && !is_admin() ){
    add_filter( 'script_loader_tag', 'perf_add_async', 10, 2 );
}

function perf_add_async( $tag, $handle ) {
    global $post;

    if( is_object( $post ) ){
        $perf_disable_options = perf_get_field('perf_disable_options', $post->ID);

        if( !is_array($perf_disable_options) ){
            $perf_disable_options = array();
        }
    }else{
        $perf_disable_options = array();
    }

    if( is_search() || is_array($perf_disable_options) && !in_array('js', $perf_disable_options) ){
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
$perf_disable_css_optimisation = perf_get_field("perf_disable_css_optimisation","option");

if( !is_array($perf_disable_css_optimisation) ) $perf_disable_css_optimisation = array();
if( ( !in_array("disable_css_auto_async", $perf_disable_css_optimisation, true) ) && !is_admin() ){
    add_filter('wp_print_styles', 'perf_inject_loadcss_script', 10);
}
function perf_inject_loadcss_script() {

    global $post;

    if( is_object( $post ) ){
        $perf_disable_options = perf_get_field('perf_disable_options', $post->ID);

        if( !is_array($perf_disable_options) ){
            $perf_disable_options = array();
        }
    }else{
        $perf_disable_options = array();
    }

    if( is_search() || is_array($perf_disable_options) && !in_array('css', $perf_disable_options) ){
        echo '<script>!function(e){"use strict";var n=function(n,t,o){var l,r=e.document,i=r.createElement("link");if(t)l=t;else{var a=(r.body||r.getElementsByTagName("head")[0]).childNodes;l=a[a.length-1]}var d=r.styleSheets;i.rel="stylesheet",i.href=n,i.media="only x",l.parentNode.insertBefore(i,t?l:l.nextSibling);var f=function(e){for(var n=i.href,t=d.length;t--;)if(d[t].href===n)return e();setTimeout(function(){f(e)})};return i.onloadcssdefined=f,f(function(){i.media=o||"all"}),i};"undefined"!=typeof module?module.exports=n:e.loadCSS=n}("undefined"!=typeof global?global:this);</script>';
    }
}

/*
* Critical CSS
*/
if( !in_array("disable_theme_critical_css", $perf_disable_css_optimisation, true) ){
    add_action('perf_mobile_styles','perf_critical_css', 5);
}
function perf_critical_css()
{
    global $post;

    $perf_disable_options = perf_get_field('perf_disable_options', $post->ID);
    if( !is_array($perf_disable_options) ){ $perf_disable_options = array(); }

    if( !in_array('css', $perf_disable_options) ){
        $critical_syle = '/* Critical CSS */ ';

        if( is_page_template("page-templates/template-front.php") ){
            $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/home.min.css");
            $critical_syle .= $temp_css['body'];
        }elseif( is_page_template("page-templates/template-contact.php") ){
            $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/contact.min.css");
            $critical_syle .= $temp_css['body'];
        }elseif( is_archive() || is_home() || is_search() ){
            $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/archive.min.css");
            $critical_syle .= $temp_css['body'];
        }elseif( is_single() ){
            $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/single.min.css");
            $critical_syle .= $temp_css['body'];
        }else{
            $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/page.min.css");
            $critical_syle .= $temp_css['body'];
        }

        echo $critical_syle;
    }

}

/*
* Async all stylsheets with loadcss.js
*/
if( !in_array("disable_css_auto_async", $perf_disable_css_optimisation, true) ){
    add_filter('wp_print_styles', 'perf_async_stylsheets', 20); // Inject loadcss.js call for each stylesheets
    add_filter('wp_print_styles', 'perf_dequeue_stylesheets', 30); // Dequeue all stylesheets
}

function perf_async_stylsheets(){
    global $wp_styles;
    global $post;

    if( is_object( $post ) ){
        $perf_disable_options = perf_get_field('perf_disable_options', $post->ID);

        if( !is_array($perf_disable_options) ){
            $perf_disable_options = array();
        }
    }else{
        $perf_disable_options = array();
    }

    if( is_search() || is_array($perf_disable_options) && !in_array('css', $perf_disable_options) ){

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

function perf_dequeue_stylesheets( ) {
    global $wp_styles;
    global $post;

    if( is_object( $post ) ){
        $perf_disable_options = perf_get_field('perf_disable_options', $post->ID);

        if( !is_array($perf_disable_options) ){
            $perf_disable_options = array();
        }
    }else{
        $perf_disable_options = array();
    }

    if( is_search() || is_array($perf_disable_options) && !in_array('css', $perf_disable_options) ){

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
if( !perf_get_field("perf_disable_preload","option") ){
    add_action( 'perf_head_open', 'perf_preload' );
    add_action( 'perf_head_open', 'perf_more_preload' );
}
function perf_preload() {
    if( perf_get_field("perf_log_sm","option") ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_sm","option"); ?>" media="(max-width: 1200px)">
	<?php
    }

    if( perf_get_field("perf_log_md","option") ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_md","option"); ?>" media="(min-width: 1200px) and (max-width: 1650px)">
    <?php
    }

    if( perf_get_field("perf_log_lg","option") ){
    ?>
        <link rel="preload" as="image" href="<?php echo perf_get_field("perf_log_lg","option"); ?>" media="(min-width: 1650px)">
	<?php
    }

    $perf_image_id = perf_select_hero_image();
    $perf_image_src_sm = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-sm' );
    $perf_image_src_md = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-md' );
    $perf_image_src_lg = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-lg' );

    if( $perf_image_id ){
    ?>
        <link rel="preload" as="image" href="<?php echo $perf_image_src_sm[0]; ?>" media="(max-width: 52em)">
        <link rel="preload" as="image" href="<?php echo $perf_image_src_md[0]; ?>" media="(min-width: 52em) and (max-width: 64em)">
        <link rel="preload" as="image" href="<?php echo $perf_image_src_lg[0]; ?>" media="(min-width: 64em)">
    <?php
    }
}

/*
* More preload added by user
*/
function perf_more_preload() {
    if( perf_get_field("perf_add_preload","option") ){
        echo perf_get_field("perf_add_preload","option");
    }
}


/*
* Critical mobile fix
*/
add_action( 'perf_mobile_styles', 'perf_critical_mobile_fix' );
function perf_critical_mobile_fix() {
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

/*
* Critical md  fix
*/
add_action( 'perf_md_styles', 'perf_critical_md_fix' );
function perf_critical_md_fix() {
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

/*
* Critical lg  fix
*/
add_action( 'perf_lg_styles', 'perf_critical_lg_fix' );
function perf_critical_lg_fix() {
?>
    #primary-menu a, .main-search input[type="search"] { min-height: 8.33333vh; }

<?php
}

/*
* Critical 1200  fix
*/
add_action( 'perf_1200_styles', 'perf_critical_1200_fix' );
function perf_critical_1200_fix() {
?>
    .main-header_container,
    .site-logo {
        height: 223px;
        display: flex;
        align-items: center;
        display: -ms-flexbox; 
        -ms-flex-align: center;
    }

    .nav-container {
        overflow: hidden; /* Fix critical fout */
    }

    .sub-menu {
        display: none; /* Fix fout on page load */
    }

    .nav-container{transform: translateX(0);}

<?php
}

/*
* Critical 96em fix
*/
add_action( 'perf_96em_styles', 'perf_critical_96em_fix' );
function perf_critical_96em_fix() {
?>
    .h0-responsive { font-size: 5.76rem; }

    .main-header_container,
    .site-logo {
        height: 273px;
    }
<?php
}

/*
* Critical admin bar
*/
add_action( 'perf_mobile_styles', 'perf_critical_admin' );
function perf_critical_admin() {
    if (is_user_logged_in()){
        $temp_css = wp_remote_get( get_template_directory_uri() . "/critical/critical-admin.css");
        $critical_syle = $temp_css['body'];
        echo $critical_syle;
    }
}
