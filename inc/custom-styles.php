<?php
/**
 * @package perfthemes
 */

/*
* Inline styles
*/
add_action( 'light_bold_head_open', 'light_bold_inline_styles', 10 );
function light_bold_inline_styles() {

    echo '<style>';

        do_action( 'light_bold_mobile_styles' );

        echo '@media (min-width: 40em)  {';
            do_action( 'light_bold_sm_styles' );
        echo '}';

        echo '@media (min-width: 52em)  {';
            do_action( 'light_bold_md_styles' );
        echo '}';

        echo '@media (min-width: 64em)  {';
            do_action( 'light_bold_lg_styles' );
        echo '}';

        echo '@media (min-width: 1200px)  {';
            do_action( 'light_bold_1200_styles' );
        echo '}';

        echo '@media (min-width: 1650px)  {';
            do_action( 'light_bold_96em_styles' );
        echo '}';

    echo '</style>';
}

/**
 * Print custom inline CSS in the head
 */
add_action('light_bold_mobile_styles','light_bold_custom_color', 5);
function light_bold_custom_color(){

    if( get_field("perf_main_site_color","option") ){
        $light_bold_main_color = get_field("perf_main_site_color","option");
    }else{
        $light_bold_main_color = '#3498db';
    }

    $light_bold_custom_css = '
        .main-color{ color: ' . $light_bold_main_color . '; }
        a,
        .tagcloud a:hover{ color: ' . $light_bold_main_color . ';}
        a.dark-color:hover,
        a.white-color:hover,
        .tags:hover,
        .widget_categories a:hover,
        .widget_archive a:hover,
        .comment-reply-link:hover,
        .site-footer li a:hover,
        .icons_social:hover,
        .icons_social:focus,
        .button-row button,
        .active .menu__link,
        .site-footer .address_row .fa{ color: ' . $light_bold_main_color . '; border-color: ' . $light_bold_main_color . '; }
        .menu__item i,
        .menu__link:hover,
        .menu__breadcrumbs a,
        .address_row i { color: ' . $light_bold_main_color . '; }
        a:hover,a:focus{ border-color: ' . $light_bold_main_color . '; }
        .menu__link:before,
        .separator:after,
        .perf_btn.alt2{ background-color: ' . $light_bold_main_color . '; }
        .perf_btn,
        .submit,
        .gform_button,
        input[type="submit"]{ color: ' . $light_bold_main_color . '; border-color: ' . $light_bold_main_color . '; }
        .perf_btn:hover,
        .perf_btn:focus,
        .submit:hover,
        .submit:focus,
        .gform_button:hover,
        .gform_button:focus,
        input[type="submit"]:hover,
        input[type="submit"]:focus{ background-color: ' . $light_bold_main_color . '; border-color: ' . $light_bold_main_color . '; }
        #primary-menu > li.menu-item-has-children:hover,
        #primary-menu  .sub-menu li{ background-color:  ' . light_bold_hex2rgba($light_bold_main_color, 0.05) . ';}
        .bg-main-color{ background-color: ' . $light_bold_main_color . ';}
        blockquote, .perf_alert_default{ border-left-color: ' . $light_bold_main_color . '}
        .social_share{ border-color: ' . $light_bold_main_color . '; }
        input:focus, textarea:focus, select:focus { border-color: ' . $light_bold_main_color . ' !important; }
        ::selection { background: ' . light_bold_hex2rgba($light_bold_main_color, 0.25) . '; }
        ::-moz-selection{ background: ' . light_bold_hex2rgba($light_bold_main_color, 0.25) . '; }
        .comment-author-admin > article{ border-bottom: 0.5rem solid ' . $light_bold_main_color . '; background-color: ' . light_bold_hex2rgba($light_bold_main_color, 0.05) . '; }
        .opacity-zero{ opacity: 0; }
    ';
    echo light_bold_compress( $light_bold_custom_css );
}

function light_bold_hex2rgba($color, $opacity = false) {

    $light_bold_default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
          return $light_bold_default;

    //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $light_bold_hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $light_bold_hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $light_bold_default;
        }

        //Convert hexadec to rgb
        $light_bold_rgb =  array_map('hexdec', $light_bold_hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$light_bold_rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$light_bold_rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}