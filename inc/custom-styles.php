<?php
/**
 * @package perfthemes
 */

/*
* Inline styles
*/
add_action( 'wp_head', 'perf_inline_styles' );
function perf_inline_styles() {

    echo '<style>';
        
        do_action( 'perf_mobile_styles' );
        
        echo '@media (min-width: 40em)  {';
            do_action( 'perf_sm_styles' );
        echo '}';

        echo '@media (min-width: 52em)  {';
            do_action( 'perf_md_styles' );
        echo '}';

        echo '@media (min-width: 64em)  {';
            do_action( 'perf_lg_styles' );
        echo '}';

        echo '@media (min-width: 1200px)  {';
            do_action( 'perf_1200_styles' );
        echo '}';
    echo '</style>';
}

/*
* Mobile hero
*/
add_action( 'perf_mobile_styles', 'perf_sm_hero' );
function perf_sm_hero() {

    $hero = perf_select_hero_image();

?>
    #perf-main-hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-sm']; ?>);
    }
<?php
}

/*
* Tablet hero
*/
add_action( 'perf_md_styles', 'perf_md_hero' );
function perf_md_hero() {

    $hero = perf_select_hero_image();
?>
    #perf-main-hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-md']; ?>);
    }
<?php
}

/*
* Desktop hero
*/
add_action( 'perf_lg_styles', 'perf_lg_hero' );
function perf_lg_hero() {

    $hero = perf_select_hero_image();

?>
    #perf-main-hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-lg']; ?>);
    }
<?php
}

/**
 * Print custom inline CSS in the head
 */
add_action('perf_mobile_styles','perf_custom_color', 5);
function perf_custom_color(){

    if( get_field("perf_main_site_color","option") != 'other' ){
        $perf_main_color = get_field("perf_main_site_color","option");
    }else{
        $perf_main_color = get_field("perf_custom_color","option");
    }
    
    ?>

    .main-color{ color: <?php echo $perf_main_color; ?>; }
    a,
    .tagcloud a:hover{ color: <?php echo $perf_main_color; ?>;}
    a.dark-color:hover,
    a.white-color:hover,
    .tags:hover,
    .widget_categories a:hover, 
    .widget_archive a:hover,
    .comment-reply-link:hover{ color: <?php echo $perf_main_color; ?> }
    #primary-menu i,
    #primary-menu a:hover,
    .address_row i { color: <?php echo $perf_main_color; ?>; }
    a:hover,a:focus{ border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu a:before,
    .separator:after,
    .perf_btn.alt2{ background-color: <?php echo $perf_main_color; ?>; }
    .perf_btn,
    .submit{ color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    .perf_btn:hover,
    .submit:hover{ background-color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu > li.menu-item-has-children:hover,
    #primary-menu  .sub-menu li{ background-color:  <?php echo perf_hex2rgba($perf_main_color, 0.05); ?>;}
    .bg-main-color{ background-color: <?php echo $perf_main_color; ?>;}
    blockquote, .perf_alert_default{ border-left-color: <?php echo $perf_main_color; ?>}
    .social_share{ border-color: <?php echo $perf_main_color; ?>; }
    input:focus, textarea:focus, select:focus { border-color: <?php echo $perf_main_color; ?>; }
    ::selection { background: <?php echo perf_hex2rgba($perf_main_color, 0.25); ?>; }
    ::-moz-selection{ background: <?php echo perf_hex2rgba($perf_main_color, 0.25); ?>; }
    .comment-author-admin > article{ border-bottom: 0.5rem solid <?php echo $perf_main_color; ?>; background-color: <?php echo perf_hex2rgba($perf_main_color, 0.05); ?>; }
    .opacity-zero{ opacity: 0; }
    <?php
}


add_action('perf_lg_styles','perf_section1_bg_lg', 10);
function perf_section1_bg_lg(){

    if( is_page_template("page-templates/template-front.php") ){
        global $post;

        $section1 = get_field("perf_section_1", $post->ID);

        if( is_array($section1) && count($section1) > 0 ){

            $cpt = 1;
            foreach($section1 as $box ){
            ?>
                .section1_box<?php echo $cpt; ?>{ background-image: url(<?php echo $box['image']['sizes']['perfthemes-hero-md']; ?>); }
            <?php
                $cpt++;
            }
        }
    }
}

add_action('perf_mobile_styles','perf_section1_bg_sm', 10);
function perf_section1_bg_sm(){

    if( is_page_template("page-templates/template-front.php") ){
        global $post;

        $section1 = get_field("perf_section_1", $post->ID);

        if( is_array($section1) && count($section1) > 0 ){

            $cpt = 1;
            foreach($section1 as $box ){
            ?>
                .section1_box<?php echo $cpt; ?>{ background-image: url(<?php echo $box['image']['sizes']['perfthemes-hero-sm']; ?>); }
            <?php
                $cpt++;
            }
        }
    }
}

/*
* Mobile logo
*/
add_action( 'perf_mobile_styles', 'perf_mobile_logo' );
function perf_mobile_logo() {
?>
    #logo{ background-image: url(<?php echo get_field("perf_log_sm","option"); ?>); }
<?php
}

/*
* Tablet logo
*/
//add_action( 'perf_sm_styles', 'perf_tablet_logo' );
function perf_tablet_logo() {
?>
    #logo{ background-image: url(<?php echo get_field("perf_log_lg","option"); ?>); }
<?php
}

/*
* Desktop logo
*/
add_action( 'perf_1200_styles', 'perf_desktop_logo' );
function perf_desktop_logo() {
?>
    #logo{ background-image: url(<?php echo get_field("perf_log_lg","option"); ?>); min-height: 80px; }
<?php
}

function perf_hex2rgba($color, $opacity = false) {
 
    $default = 'rgb(0,0,0)';
 
    //Return default if no color provided
    if(empty($color))
          return $default; 
 
    //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

