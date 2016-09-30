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
    $perf_wrap  = '<ul id="%1$s" class="%2$s">';

    // get nav items as configured in /wp-admin/
    $perf_wrap .= '%3$s';

    // the search form
    if( perf_get_field("perf_hide_search","option") != 1 ){
        $perf_wrap .= '<li id="menu-item-search" class="menu-item menu-item-type-post_type menu-item-object-page"><form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '" class="main-search table col-12"><input class="border-none bold caps table-cell col-12 p0" name="s" type="search" placeholder="' . __("Search","lightbold") . '" required><i class="_mi _after fa fa-search table-cell align-middle"></i></form></li>';
    }

    // close the <ul>
    $perf_wrap .= '</ul>';

    // return the result
    return $perf_wrap;
}

/*
* Wrap all table for a better responsive world
*/
add_filter( 'the_content', 'filter_tableContentWrapper' );
function filter_tableContentWrapper($content) {

	$perf_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $perf_doc = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($perf_content) ){
    	$perf_doc->loadHTML(utf8_decode($perf_content));
    }else{
    	return;
    }


	$items = $perf_doc->getElementsByTagName('table');
	foreach ($items as $item) {

		if( $item->parentNode->tagName == 'body' ) {

			$wrapperDiv = $perf_doc->createElement('div');
			$wrapperDiv->setAttribute('class', 'overflow-scroll');

			$item->parentNode->replaceChild($wrapperDiv, $item);
    		$wrapperDiv->appendChild($item);

		}
	}

	$perf_html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $perf_doc->saveHTML()));
    return $perf_html_fragment;
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
    if( perf_get_field("perf_hide_fade","option") != 1 ){
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

    if( is_object( $post ) && perf_get_field("perf_hero_image", $post->ID) ){
        $perf_hero = perf_get_field("perf_hero_image", $post->ID);
    }elseif( ( is_home() || is_archive() ) && perf_get_field("perf_hero_blog_archive", "option") ){
        $perf_hero = perf_get_field("perf_hero_blog_archive", "option");
    }elseif( is_404() && perf_get_field("perf_hero_404", "option") ){
        $perf_hero = perf_get_field("perf_hero_404", "option");
    }else{
        $perf_hero = perf_get_field("perf_hero_image", "option");
    }

    return $perf_hero;
}

/**
 * Show ACF options if the user want to
 */
if( !perf_get_field("perf_show_acf","option") ){
	add_filter('acf/settings/show_admin', '__return_false');
}


/**
 * Move Comment field to the end
 */
add_filter( 'comment_form_fields', 'perf_move_comment_field_to_bottom' );
function perf_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/**
 * Remove novalidate to comment form
 */
add_action( 'wp_footer', 'perf_enable_comment_form_validation' );
function perf_enable_comment_form_validation() {
    if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') && current_theme_supports( 'html5' ) && !is_page_template("page-templates/template-front.php") )  {
        echo '<script>document.getElementById("commentform").removeAttribute("novalidate");</script>' . PHP_EOL;
    }
}

/**
 * Custom comment markup
 */
function perf_custom_comments($comment, $args, $depth) {
    global $post;
   
    $post_author = get_userdata($post->post_author);
    $GLOBALS['comment'] = $comment; ?>


    <li <?php comment_class("py1"); ?> id="comment-<?php comment_ID() ?>">
            
        <div class="comment-intro clearfix">
            <div class="left mr1 mb1 "><?php echo get_avatar( $comment->comment_author_email, 57, "", "", array("class" => "rounded") ); ?></div> 
            <span class="small-p bold upper"><?php printf(__('%s','lightbold'), get_comment_author_link()) ?> </span>
            <strong><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></strong>
            <?php 
                if( $comment->comment_author_email == $post_author->user_email ){
                    echo '<span class="comment_author">' . __("Author","lightbold") . '</span>';
                }
            ?>
            <br>
            <span class="comment_date upper small-p"><?php printf(__('%1$s','lightbold'), get_comment_date(), get_comment_time()) ?></span>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em><php _e('Your comment is awaiting moderation.','lightbold'); ?></em><br />
        <?php endif; ?>

        <div class="small-p">
            <?php comment_text(); ?>
        </div>
        
<?php } 

/**
 * Flickity slider custom behavior
 */
function perf_add_flickity_listener(){
    ?>
    <script>
        // Custom previous button
        var previousButton = document.querySelector('.button--previous');
        previousButton.addEventListener( 'click', function() {
          flkty.previous();
          flkty.pausePlayer();
        });

        // Custom Next button
        var nextButton = document.querySelector('.button--next');
        nextButton.addEventListener( 'click', function() {
          flkty.next();
          flkty.pausePlayer();
        });

        // Mouse leave unpausePlayer
        var buttonRow = document.querySelector('.button-row');
        buttonRow.addEventListener( 'mouseout', function() {
          flkty.unpausePlayer();
        });
    </script>
    <?php
}

/**
 * ACF Custom Switch True or False
 */
add_action('admin_head', 'perf_custom_switch');
function perf_custom_switch() {
  echo '<style>
    .switch {
      position: relative;
      display: inline-block !important;
      width: 60px;
      height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>';

echo '<script>
    jQuery(document).ready(function($) {
        $(".acf-bl label").addClass("switch");
        $(".acf-bl label").append( "<div class=slider></div>" );
    });
</script>';
}
