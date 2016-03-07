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
        
        do_action( 'perf_sm_styles' );
        
        echo '@media (min-width: 52em)  {';
            do_action( 'perf_md_styles' );
        echo '}';

        echo '@media (min-width: 64em)  {';
            do_action( 'perf_lg_styles' );
        echo '}';
    echo '</style>';
}

/*
* Mobile hero
*/
add_action( 'perf_sm_styles', 'perf_sm_hero' );
function perf_sm_hero() {

    global $post;

    $hero = get_field("perf_hero_image", $post->ID);

?>
    #hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-sm']; ?>);
    }
<?php
}

/*
* Tablet hero
*/
add_action( 'perf_md_styles', 'perf_md_hero' );
function perf_md_hero() {

    global $post;

    $hero = get_field("perf_hero_image", $post->ID);

?>
    #hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-md']; ?>);
    }
<?php
}

/*
* Desktop hero
*/
add_action( 'perf_lg_styles', 'perf_lg_hero' );
function perf_lg_hero() {

    global $post;

    $hero = get_field("perf_hero_image", $post->ID);

?>
    #hero{
        background-image: url(<?php echo $hero['sizes']['perfthemes-hero-lg']; ?>);
    }
<?php
}

/**
 * Print custom inline CSS in the head
 */
add_action('perf_sm_styles','perf_custom_color', 5);
function perf_custom_color(){

    if( get_field("perf_main_site_color","option") != 'other' ){
        $perf_main_color = get_field("perf_main_site_color","option");
    }else{
        $perf_main_color = get_field("perf_custom_color","option");
    }
    
    ?>

    a{ color: <?php echo $perf_main_color; ?>;}
    #primary-menu i,
    #primary-menu a:hover,
    .address_row i { color: <?php echo $perf_main_color; ?>; }
    a:hover,a:focus{ border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu a:before,
    .separator:after{ background-color: <?php echo $perf_main_color; ?>; }
    .perf_btn{ color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    .perf_btn:hover{ background-color: <?php echo $perf_main_color; ?>; border-color: <?php echo $perf_main_color; ?>; }
    #primary-menu > li.menu-item-has-children:hover,
    #primary-menu  .sub-menu li{ background-color:  <?php echo perf_hex2rgba($perf_main_color, 0.05); ?>;}
    .bg-main-color{ background-color: <?php echo $perf_main_color; ?>;}

    <?php
  
}

/*add_action('wp_head','perf_custom_css_inline', 10);
function perf_custom_css_inline(){
    if( function_exists("get_field") ){
        
        $perf_custom_css_styles = get_field("perf_custom_css_styles","option");

        if( $perf_custom_css_styles != "" ){
            echo '<style>';
            echo $perf_custom_css_styles;
            echo '</style>'; 
        }
        
    }
}*/

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
