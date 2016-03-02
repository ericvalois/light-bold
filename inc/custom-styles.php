<?php
/**
 * @package perfthemes
 */

/**
 * Print custom inline CSS in the head
 */
add_action('wp_head','perf_custom_color', 5);
function perf_custom_color(){
    if( function_exists("get_field") ){
        
        echo '<style>';
        
        $perf_main_color = get_field("perf_main_site_color","option");
        
        if( $perf_main_color ){
            if( $perf_main_color == "other" ){
                $perf_custom_color = get_field("perf_custom_color","option");
                echo '
                    a{ color:' . $perf_custom_color . ';}
                    #primary-menu a i { color:' . $perf_custom_color . '; }
                ';
            }else{
                echo '
                    a{ color:' . $perf_main_color . ';}
                    #primary-menu i,
                    #primary-menu a:hover { color:' . $perf_main_color . '; }
                    a:hover,a:focus{ border-color:' . $perf_main_color . '; }
                    #primary-menu a:before,
                    .separator:after{ background-color: ' . $perf_main_color . '; }
                    .perf_btn{ color: ' . $perf_main_color . '; border-color: ' . $perf_main_color . '; }
                    .perf_btn:hover{ background-color: ' . $perf_main_color . '; border-color: ' . $perf_main_color . '; }
                    #primary-menu > li.menu-item-has-children:hover,
                    #primary-menu  .sub-menu li{ background-color: ' . perf_hex2rgba($perf_main_color, 0.05) . ';}

                ';
            }
        }else{
            echo 'a{ color: #3498db;}';
        }

        echo '</style>';
    }
}

add_action('wp_head','perf_custom_css_inline', 10);
function perf_custom_css_inline(){
    if( function_exists("get_field") ){
        
        $perf_custom_css_styles = get_field("perf_custom_css_styles","option");

        if( $perf_custom_css_styles != "" ){
            echo '<style>';
            echo $perf_custom_css_styles;
            echo '</style>'; 
        }
        
    }
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
