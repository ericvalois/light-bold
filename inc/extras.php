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


/**
 * Add a parent CSS class for nav menu items.
 *
 * @param array  $items The menu items, sorted by each menu item's menu order.
 * @return array (maybe) modified parent CSS class.
 */
add_filter( 'wp_nav_menu_objects', 'perf_href_Return_false' );
function perf_href_Return_false( $items ) {
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
            $item->url = 'javascript:void(0);';
            //print_r($item); exit();

        }
    }
    return $items;
}


/**
* Add search in main menu
*/
function perf_add_search_menu() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'

    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';

    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';

    // the static link
    if( get_field("perf_hide_search","option") != 1 ){
        $wrap .= '<li id="menu-item-search" class="menu-item menu-item-type-post_type menu-item-object-page"><form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '" class="main-search table col-12"><input class="border-none bold caps table-cell col-12" name="s" type="search" placeholder="' . __("Search","lightbold") . '" required><i class="_mi _after fa fa-search table-cell align-middle"></i></form></li>';
    }

    // close the <ul>
    $wrap .= '</ul>';

    // return the result
    return $wrap;
}

/*
* Wrap all table for a better responsive world
*/
add_filter( 'the_content', 'filter_tableContentWrapper' );
function filter_tableContentWrapper($content) {

	/*
	$doc = new DOMDocument();
	$doc->loadHTML($content);
	*/

	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $doc = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($content) ){
    	$doc->loadHTML(utf8_decode($content));
    }else{
    	return;
    }


	$items = $doc->getElementsByTagName('table');
	foreach ($items as $item) {

		if( $item->parentNode->tagName == 'body' ) {

			$wrapperDiv = $doc->createElement('div');
			$wrapperDiv->setAttribute('class', 'overflow-scroll');

			$item->parentNode->replaceChild($wrapperDiv, $item);
    		$wrapperDiv->appendChild($item);

		}
	}

	$html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $doc->saveHTML()));
    return $html_fragment;
}



/*
* Same tag cloud font size
*/
add_filter('widget_tag_cloud_args','perf_tag_cloud_sizes');
function perf_tag_cloud_sizes($args) {
    $args['smallest'] = 13;
    $args['largest'] = 13;
    return $args;
}


/**
 * Menu Custom walker class.
 */
class perf_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="relative ' . $depth_class_names . ' ' . $class_names . '">';

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		if( is_object($args) && is_object($item) ) {
			// Build HTML output and pass through the proper filter.
	        $item_output = sprintf( '%1$s<a%2$s><span>%3$s%4$s%5$s</span></a>%6$s',
	            $args->before,
	            $attributes,
	            $args->link_before,
	            apply_filters( 'the_title', $item->title, $item->ID ),
	            $args->link_after,
	            $args->after
	        );
		}else{
			$item_output = sprintf( "\n<li><a href='%s'%s>%s</a></li>\n",
	            $item->url,
	            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
	            $item->title
	        );
		}

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class perf_Default_Walker extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );
    /**
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<li class='relative'><a href='%s'%s><span>%s</span></a></li>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }

}

/*
* Show or hide content animation
*/
function perf_content_animation(){
    if( get_field("perf_hide_fade","option") != 1 ){
        return 'animated fadeIn opacity-zero';
    }else{
        return;
    }
}

/*
* Hero image selection
*/
function perf_select_hero_image(){
   global $post;

    if( is_object( $post ) && get_field("perf_hero_image", $post->ID) ){
        $hero = get_field("perf_hero_image", $post->ID);
    }elseif( ( is_home() || is_archive() ) && get_field("perf_hero_blog_archive", "option") ){
        $hero = get_field("perf_hero_blog_archive", "option");
    }elseif( is_404() && get_field("perf_hero_404", "option") ){
        $hero = get_field("perf_hero_404", "option");
    }else{
        $hero = get_field("perf_hero_image", "option");
    }

    return $hero;
}

if( !get_field("perf_show_acf","option") ){
	add_filter('acf/settings/show_admin', '__return_false');
}
