<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package perfthemes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function perf_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'perf_body_classes' );


function perf_add_classes_on_li($classes, $item, $args) {
  $classes[] = 'relative';
  return $classes;
}
add_filter('nav_menu_css_class','perf_add_classes_on_li',1,3);


/*
* Custom menu markup
*/
function perf_clean_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 
        $menu_list = '<ul id="primary-menu" class="list-reset">' ."\n";
 
        $count = 0;
        $submenu = false;
        
        //print_r($menu_items); exit();
        foreach( $menu_items as $menu_item ) {
             
            $link = $menu_item->url;
            $title = $menu_item->title;
             
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                 
                $menu_list .= '<li class="item p2 border relative">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="sub-menu">' ."\n";
                }
 
                $menu_list .= '<li class="item">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }
 
            }
 
            if ( is_object( isset($menu_items[ $count + 1 ]) ) && $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                $menu_list .= '</li>' ."\n";      
                $submenu = false;
            }
 
            $count++;
        }
         
        $menu_list .= '</ul>' ."\n";
 
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}

/**
 * Add a parent CSS class for nav menu items.
 *
 * @param array  $items The menu items, sorted by each menu item's menu order.
 * @return array (maybe) modified parent CSS class.
 */
function wpdocs_add_menu_parent_class( $items ) {
    $parents = array();
 
    // Collect menu items with parents.
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    //print_r($items); exit();
 
    // Add class.
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->url = 'javascript:void(0)';
            //print_r($item); exit();
            
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'wpdocs_add_menu_parent_class' );

/**
* Add search in main menu
*/
function my_nav_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'

    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';

    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';

    // the static link 
    if( get_field("perf_hide_search","option") != 1 ){
        $wrap .= '<li id="menu-item-search" class="menu-item menu-item-type-post_type menu-item-object-page"><form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '" class="main-search table col-12"><input class="border-none bold caps table-cell col-12" name="s" type="search" placeholder="Search" required><i class="_mi _after fa fa-search table-cell align-middle"></i></form></li>';
    }

    // close the <ul>
    $wrap .= '</ul>';

    // return the result
    return $wrap;
}

function clean_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 
        //$menu_list  = '<nav>' ."\n";
        $menu_list = '<ul id="primary-menu" class="list-reset">' ."\n";
 
        $count = 0;
        $submenu = false;
         
        foreach( $menu_items as $menu_item ) {
             
            $link = $menu_item->url;
            $title = $menu_item->title;
             
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                 
                $menu_list .= '<li class="relative">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="sub-menu">' ."\n";
                }
 
                $menu_list .= '<li class="relative">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }
 
            }
 
            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                $menu_list .= '</li>' ."\n";      
                $submenu = false;
            }
 
            $count++;
        }
         
        $menu_list .= '</ul>' ."\n";
        //$menu_list .= '</nav>' ."\n";
 
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}

/*
* Wrap all table for responsive table
*/
add_filter( 'the_content', 'perf_add_wrap_table', PHP_INT_MAX );
function perf_add_wrap_table( $content ) {

    if( is_feed() || is_preview() )
        return $content;

    // This is a pretty simple regex, but it works
    $content = preg_replace( '/(<table[^>]*>(?:.|\n)*(?=<\/table>))/', '<div class="overflow-scroll">${1}</div>', $content );

    return $content;
}


