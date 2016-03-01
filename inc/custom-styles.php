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
                    #primary-menu a i,
                    #primary-menu a:hover { color:' . $perf_main_color . '; }
                    #primary-menu a:before,
                    .separator:after{ background-color: ' . $perf_main_color . '; }
                    .perf_btn{ color: ' . $perf_main_color . '; border-color: ' . $perf_main_color . '; }
                    .perf_btn:hover{ background-color: ' . $perf_main_color . '; border-color: ' . $perf_main_color . '; }

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
