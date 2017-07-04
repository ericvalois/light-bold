<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ttfb
 */

/*
* Custom action hook
*/
add_action("wp_head","light_bold_action_head_open", 5);
function light_bold_action_head_open(){
    do_action('light_bold_head_open');
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function light_bold_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'light_bold_pingback_header' );

/*
* Wrap all table for a better responsive world
*/
add_filter( 'the_content', 'light_bold_filter_tableContentWrapper' );
function light_bold_filter_tableContentWrapper($content) {

	$light_bold_content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $light_bold_doc = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($light_bold_content) ){
    	$light_bold_doc->loadHTML(utf8_decode($light_bold_content));
    }else{
    	return;
    }


	$items = $light_bold_doc->getElementsByTagName('table');
	foreach ($items as $item) {

		if( $item->parentNode->tagName == 'body' ) {

			$wrapperDiv = $light_bold_doc->createElement('div');
			$wrapperDiv->setAttribute('class', 'overflow-scroll');

			$item->parentNode->replaceChild($wrapperDiv, $item);
    		$wrapperDiv->appendChild($item);

		}
	}

	$light_bold_html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $light_bold_doc->saveHTML()));
    return $light_bold_html_fragment;
}

/*
* Same tag cloud font size
*/
add_filter('widget_tag_cloud_args','light_bold_tag_cloud');
function light_bold_tag_cloud($args) {
    $args['smallest'] = 12; /* Set the smallest size to 12px */
    $args['largest'] = 12;  /* set the largest size to 19px */
    $args['unit'] = "px";
    return $args; 
}

/*
* Show or hide content animation
*/
function light_bold_content_animation(){
    if( get_field("perf_show_fade","option") == 1 ){
        return 'animated fadeIn opacity-zero';
    }else{
        return;
    }
}

/*
* Hero image selection
*/
function light_bold_select_hero_image(){
   global $post;

    if( is_object( $post ) && get_field("perf_hero_image", $post->ID) ){
        $light_bold_hero = get_field("perf_hero_image", $post->ID);
    }elseif( ( is_home() || is_archive() ) && get_field("perf_hero_blog_archive", "option") ){
        $light_bold_hero = get_field("perf_hero_blog_archive", "option");
    }elseif( is_404() && get_field("perf_hero_404", "option") ){
        $light_bold_hero = get_field("perf_hero_404", "option");
    }else{
        $light_bold_hero = get_field("perf_hero_image", "option");
    }

    return $light_bold_hero;
}

/**
 * Move Comment field to the end
 */
add_filter( 'comment_form_fields', 'light_bold_move_comment_field_to_bottom' );
function light_bold_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/**
 * Remove novalidate from comment form
 */
add_action( 'wp_footer', 'light_bold_enable_comment_form_validation' );
function light_bold_enable_comment_form_validation() {
    if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') && current_theme_supports( 'html5' ) && !is_page_template("page-templates/template-front.php") )  {
        echo '<script>document.getElementById("commentform").removeAttribute("novalidate");</script>' . PHP_EOL;
    }
}

/**
 * Custom comment markup
 */
function light_bold_custom_comments($comment, $args, $depth) {
    global $post;
   
    $post_author = get_userdata($post->post_author);
    $GLOBALS['comment'] = $comment; ?>


    <li <?php comment_class("mt2 mb2"); ?> id="comment-<?php comment_ID() ?>">
            
        <div class="comment-intro clearfix">
            <div class="left mr1 mb1 "><?php echo get_avatar( $comment->comment_author_email, 57, "", "", array("class" => "rounded") ); ?></div> 
            <span class="small-p regular upper"><?php printf( esc_html__('%s','light-bold'), get_comment_author_link()) ?> </span>
            <strong><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></strong>
            <?php 
                if( $comment->comment_author_email == $post_author->user_email ){
                    echo '<span class="comment_author">' . esc_html__("Author","light-bold") . '</span>';
                }
            ?>
            <br>
            <span class="comment_date upper small-p"><?php printf( esc_html__('%1$s','light-bold'), get_comment_date(), get_comment_time() ); ?></span>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em><php esc_html_e('Your comment is awaiting moderation.','light-bold'); ?></em><br>
        <?php endif; ?>

        <div class="small-p">
            <?php comment_text(); ?>
        </div>
        
<?php } 

/**
 * Custom WordPress Menu Markup
 */
function light_bold_custom_menu( $theme_location ) {

    global $post;

    $menu_name = $theme_location;
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $menu_object = wp_get_nav_menu_object($menu_id);

    // Prevent errors on 404 page
    if( !empty( $post ) ){
        $post_id = $post->ID;
    }else{
        $post_id = null;
    }

    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = wp_get_nav_menu_items( $menu_object->slug );
        $menu_zero_with_child = array();
        
        if( is_home() ){
            $post = get_post( get_option( 'page_for_posts' ) );
        }else{
           global $post; 
        }

        // Menu
        $html_menu = '<ul data-menu="main" class="menu__level absolute top-0 left-0 overflow-hidden m0 p0 list-reset ' . (( !light_bold_main_menu_has_child() )?'visible':'') . '">';

        foreach( $menu as $item ):

            if( light_bold_menu_item_has_child($item->ID) ){
                $menu_zero_with_child[] = $item->ID;
                $has_child = true;
            }else{
                $has_child = false;
            }

            $menu_icon = get_field( 'perf_icon_name', $item->ID );

            if(  $item->object_id == $post_id ){
                $current_page = 'active';
            }else{
                $current_page = '';
            }

            if( $item->menu_item_parent == 0 ):
                
                $html_menu .= '<li class="menu__item ultra-small '. esc_attr( $current_page ) .'">';
                    $html_menu .= '<a class="menu__link small-p normal-weight overflow-hidden relative px2 z3 border-none text-color flex flex-center" ' . (($has_child)?'data-submenu="submenu-'. esc_attr( $item->ID ) .'" href="#"':'href="'. esc_url( $item->url ) .'"') . '>';
                    
                    $html_menu .= '<span class="flex-auto" ' . (($has_child)?'data-submenu="submenu-'. esc_attr( $item->ID ) .'"':'') . '>' . esc_html( $item->title ) . '</span>';
                    
                    if( $menu_icon ){ 
                        $html_menu .= '<svg class="fa flex-none '. esc_attr( $menu_icon ) .'"><use xlink:href="#'. esc_attr( $menu_icon ) .'"></use></svg>'; 
                    }

                    $html_menu .= '</a>';

                $html_menu .= '</li>';
                
            endif;

        endforeach;

        $html_menu .= '</ul>';

        echo $html_menu;

        $menu_sub_with_child = array();

        // Sub menu
        if( count( $menu_zero_with_child ) > 0 ):

            foreach( $menu_zero_with_child as $item ):
                echo '<ul data-menu="submenu-' . esc_attr( $item ) . '" class="menu__level absolute top-0 left-0 overflow-hidden m0 p0 list-reset">';
                    foreach( $menu as $starter_item ):

                        if(  $starter_item->menu_item_parent == $item ):

                            if( light_bold_menu_item_has_child($starter_item->ID) ){
                                $menu_sub_with_child[] = $starter_item->ID;
                                $has_child = true;
                            }else{
                                $has_child = false;
                            }

                            $menu_icon = get_field( 'perf_icon_name', $starter_item->ID );
                            
                            if(  $starter_item->object_id == $post_id ){
                                $current_page = 'active';
                            }else{
                                $current_page = '';
                            }

                            ?>
                                <li class="menu__item ultra-small <?php echo esc_attr( $current_page ); ?>">
                                    <a class="menu__link small-p normal-weight overflow-hidden relative px2 z3 border-none text-color flex flex-center" <?php if( $has_child ){ echo 'data-submenu="submenu-'. esc_attr( $starter_item->ID ) .'" href="#"'; }else{ echo 'href="'. esc_url( $starter_item->url ) .'"';} ?>>
                                        <span class="flex-auto" <?php if( $has_child ){ echo 'data-submenu="submenu-'. esc_attr( $starter_item->ID ) . '"'; } ?>>
                                            <?php echo esc_html( $starter_item->title ); ?> 
                                        </span>

                                        <?php 
                                            if( $menu_icon ){ 
                                                echo '<svg class="fa flex-none '. esc_attr( $menu_icon ) .'"><use xlink:href="#'. esc_attr( $menu_icon ) .'"></use></svg>'; 
                                            }
                                        ?>
                                    </a>
                                </li>
                            <?php
                        endif;

                    endforeach;
                echo '</ul>';
            endforeach;
        endif;

        // Sub sub menu
        if( count( $menu_sub_with_child ) > 0 ):

            foreach( $menu_sub_with_child as $item ):
                echo '<ul data-menu="submenu-' . esc_attr( $item ) . '" class="menu__level absolute top-0 left-0 overflow-hidden m0 p0 list-reset">';
                    foreach( $menu as $starter_item ):

                        $menu_icon = get_field( 'light_bold_menu_icon', $starter_item->ID );

                        if(  $starter_item->object_id == $post_id ){
                            $current_page = 'active';
                        }else{
                            $current_page = '';
                        } 


                    
                        if(  $starter_item->menu_item_parent == $item ):
                            ?>
                                <li class="menu__item ultra-small <?php echo esc_attr( $current_page ); ?>">
                                    <a class="menu__link small-p normal-weight overflow-hidden relative px2 z3 border-none text-color flex flex-center" <?php echo 'href="'. esc_url( $starter_item->url ) .'"'; ?>>
                                        <span class="flex-auto">
                                            <?php echo esc_html( $starter_item->title ); ?>
                                        </span>

                                        <?php 
                                            if( $menu_icon ){ 
                                                echo '<i class="fa flex-none '. esc_attr( $menu_icon ) .'"></i>'; 
                                            }
                                        ?>
                                    </a>
                                </li>
                            <?php
                        endif;

                    endforeach;
                echo '</ul>';
            endforeach;
         
        endif;
 
    } else {
        $menu_list = '<!-- no menu defined in location "'. esc_html( $theme_location ) .'" -->';
    }

}

/**
 * Detect if primary menu item has child
 */
function light_bold_menu_item_has_child( $item_id ){
    $menu_name = 'primary';
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $menu_object = wp_get_nav_menu_object($menu_id);

    $menu = wp_get_nav_menu_items( $menu_object->slug );

    if( is_array($menu) ){
        foreach( $menu as $item ){
            if( $item->menu_item_parent == $item_id ){
                return true;
            }
        }
    }

    return false;
}

/**
 * Detect if primary menu has child
 */
function light_bold_main_menu_has_child() {

    $menu_name = 'primary';
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $menu_object = wp_get_nav_menu_object($menu_id);

    $menu = wp_get_nav_menu_items( $menu_object->slug );

    if( is_array($menu) ){
      foreach( $menu as $item ):

          if( $item->menu_item_parent ){
              return true;
          }

      endforeach;
    }

    return false;
}

/**
 * Load fontawesome sprite ASYNC
 */
add_action("light_bold_footer_scripts","light_bold_call_sprite_fontawesome");
function light_bold_call_sprite_fontawesome(){
    ?>
    /* Get fontawesome.svg */ 
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?php echo get_template_directory_uri(); ?>/inc/3rd-party/font-awesome/fontawesome.svg", true);
    ajax.send();
    ajax.onload = function(e) {
      var div = document.createElement("div");
      div.innerHTML = ajax.responseText;
      document.body.insertBefore(div, document.body.childNodes[0]);
    }
    <?php
}



add_action("wp_footer","light_bold_custom_js", 99);
function light_bold_custom_js(){
  echo '<script>';

  do_action('light_bold_footer_scripts');

  echo '</script>';
}

/**
 * Retrieves the response from the specified URL using one of PHP's outbound request facilities.
 *
 * @params  $url  The URL of the feed to retrieve.
 * @returns The response from the URL; null if empty.
 */
function light_bold_get_response( $url ) {
    $response = null;

    // First, we try to use wp_remote_get
    $response = wp_remote_get( $url );

    // If the response is an array, it's coming from wp_remote_get,
    // so we just want to capture to the body index for json_decode.
    if( is_array( $response ) && !is_wp_error( $response ) ) {
        $response = $response['body'];
    }

    return $response;
}

/**
 * Detect if flickity is needed
 *
 * @params  $post_id  post ID
 * @returns True/False
 */
function light_bold_flickity_detection( $post_id ){
    $flickity = false;
    $rows = get_post_meta( $post_id, 'perf_front_hero_content', true );

    foreach( (array) $rows as $count => $row ) {
        switch( $row ) {
        
            // Custom content
            case 'custom_content':
                if( get_post_meta( $post_id, 'perf_front_hero_content_' . $count . '_custom_content', true ) > 1 ){
                    $flickity = true;
                }else{
                    $flickity = false;
                }
            break;
            
            // Posts content
            case 'posts_content':
                $args = array(
                    'post_type' => 'post',
                );

                if( get_post_meta( $post_id, 'perf_front_hero_content_' . $count . '_latest_posts_or_manual_selection', true ) == "latest" ){
                    $args['posts_per_page'] = get_post_meta( $post_id, 'perf_front_hero_content_' . $count . '_how_many_posts', true );
                }else{
                    $args['post__in'] = $args['posts_per_page'] = get_post_meta( $post_id, 'perf_front_hero_content_' . $count . '_manual_selection', true );
                }

                $posts = new WP_Query( $args );

                if( $posts->post_count > 1 ){
                    $flickity = true;
                }else{
                    $flickity = false;
                }
            break;
        }
    }

    return $flickity;
}

/**
 * Minify string on the fly
 *
 * @params  $minify  String to minify
 * @returns String minified
 */
function light_bold_compress( $minify ){
    // Remove space after colons
    $minify = str_replace(': ', ':', $minify);
    // Remove whitespace
    $minify = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minify);

    return $minify;
}

/**
 * Add custom body class for system font
 */
add_filter( 'body_class','light_bold_body_classes_system_font' );
function light_bold_body_classes_system_font( $classes ) {
    $classes[] = 'system-font';

    return $classes;
}

/**
 * Add custom body class for multi author
 */
add_filter( 'body_class','light_bold_body_classes_multi_author' );
function light_bold_body_classes_multi_author( $classes ) {

    if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
      
    return $classes;
}

/**
 * Add custom post class for blog page
 */
add_filter( 'post_class','light_bold_post_classes_blog_template' );
function light_bold_post_classes_blog_template( $classes ) {
    if( is_archive() || is_home() || is_search() ){
        $classes[] = 'border-bottom break-word mb2 md-mb3';
    }
      
    return $classes;
}