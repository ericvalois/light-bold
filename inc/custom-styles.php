<?php
/**
 * @package perfthemes
 */

/*
* Inline styles
*/
add_action( 'perf_head_open', 'perf_inline_styles', 50 );
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

        echo '@media (min-width: 96em)  {';
            do_action( 'perf_96em_styles' );
        echo '}';

    echo '</style>';
}

/*
* Mobile hero
*/
add_action( 'perf_mobile_styles', 'perf_sm_hero' );
function perf_sm_hero() {

    $perf_image_id = perf_select_hero_image();
    $perf_image_src = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-sm' );
?>
    #perf-main-hero{
        background-image: url(<?php echo $perf_image_src[0]; ?>);
    }
<?php
}

/*
* Tablet hero
*/
add_action( 'perf_md_styles', 'perf_md_hero' );
function perf_md_hero() {

    $perf_image_id = perf_select_hero_image();
    $perf_image_src = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-md' );
?>
    #perf-main-hero{
        background-image: url(<?php echo $perf_image_src[0]; ?>);
    }
<?php
}

/*
* Desktop hero
*/
add_action( 'perf_lg_styles', 'perf_lg_hero' );
function perf_lg_hero() {

    $perf_image_id = perf_select_hero_image();
    $perf_image_src = wp_get_attachment_image_src( $perf_image_id, 'perfthemes-hero-lg' );
?>
    #perf-main-hero{
        background-image: url(<?php echo $perf_image_src[0]; ?>);
    }
<?php
}

/**
 * Print custom inline CSS in the head
 */
add_action('perf_mobile_styles','perf_custom_color', 5);
function perf_custom_color(){

    if( get_field("perf_main_site_color","option") == 'other' ){
        $perf_main_color = get_field("perf_custom_color","option");
    }elseif( get_field("perf_main_site_color","option") ){
        $perf_main_color = get_field("perf_main_site_color","option");
    }else{
        $perf_main_color = '#3498db';
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
    .comment-reply-link:hover,
    .icons_social:hover,
    .icons_social:focus,
    .button-row button{ color: <?php echo $perf_main_color; ?> }
    #primary-menu i,
    #primary-menu a:hover,
    .address_row i { color: <?php echo $perf_main_color; ?>; }
    a:hover,a:focus{ border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu a:before,
    .separator:after,
    .perf_btn.alt2{ background-color: <?php echo $perf_main_color; ?>; }
    .perf_btn,
    .submit,
    .gform_button,
    input[type="submit"]{ color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    .perf_btn:hover,
    .perf_btn:focus,
    .submit:hover,
    .submit:focus,
    .gform_button:hover,
    .gform_button:focus,
    input[type="submit"]:hover,
    input[type="submit"]:focus{ background-color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu > li.menu-item-has-children:hover,
    #primary-menu  .sub-menu li{ background-color:  <?php echo perf_hex2rgba($perf_main_color, 0.05); ?>;}
    .bg-main-color{ background-color: <?php echo $perf_main_color; ?>;}
    blockquote, .perf_alert_default{ border-left-color: <?php echo $perf_main_color; ?>}
    .social_share{ border-color: <?php echo $perf_main_color; ?>; }
    input:focus, textarea:focus, select:focus { border-color: <?php echo $perf_main_color; ?> !important; }
    ::selection { background: <?php echo perf_hex2rgba($perf_main_color, 0.25); ?>; }
    ::-moz-selection{ background: <?php echo perf_hex2rgba($perf_main_color, 0.25); ?>; }
    .comment-author-admin > article{ border-bottom: 0.5rem solid <?php echo $perf_main_color; ?>; background-color: <?php echo perf_hex2rgba($perf_main_color, 0.05); ?>; }
    .opacity-zero{ opacity: 0; }
    img{max-width: 100%;height: auto;}
    .main-carousel{
      opacity: 0;
  -webkit-transition: opacity 0.4s;
  transition: opacity 0.4s;
    }
    <?php
}


add_action('perf_lg_styles','perf_section1_bg_lg', 10);
function perf_section1_bg_lg(){

    if( is_page_template("page-templates/template-front.php") ){
        global $post;

        $perf_section1 = get_field("perf_section_1", $post->ID);

        if( is_array($perf_section1) && count($perf_section1) > 0 ){

            $cpt = 1;
            foreach($perf_section1 as $box ){

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

        $perf_section1 = get_field("perf_section_1", $post->ID);

        if( is_array($perf_section1) && count($perf_section1) > 0 ){

            $cpt = 1;
            foreach($perf_section1 as $box ){
            ?>
                .section1_box<?php echo $cpt; ?>{ background-image: url(<?php echo $box['image']['sizes']['perfthemes-hero-sm']; ?>); }
            <?php
                $cpt++;
            }
        }
    }
}

function perf_hex2rgba($color, $opacity = false) {

    $perf_default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
          return $perf_default;

    //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $perf_hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $perf_hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $perf_default;
        }

        //Convert hexadec to rgb
        $perf_rgb =  array_map('hexdec', $perf_hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$perf_rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$perf_rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}
