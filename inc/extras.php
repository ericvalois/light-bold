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
add_filter('wp_generate_tag_cloud', 'perf_tag_cloud',10,1);
function perf_tag_cloud($string){
   return preg_replace("/style='font-size:.+pt;'/", '', $string);
}


/*
* Show or hide content animation
*/
function perf_content_animation(){
    if( perf_get_field("perf_show_fade","option") == 1 ){
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
 * Remove novalidate from comment form
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
    <?php
}

/**
 * Custom WordPress Menu Markup
 */
function perf_custom_menu( $theme_location ) {

    $menu_name = $theme_location;
    $locations = get_nav_menu_locations();
    $menu_id = $locations[ $menu_name ] ;
    $menu_object = wp_get_nav_menu_object($menu_id);


    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = wp_get_nav_menu_items( $menu_object->slug );
        $menu_zero_with_child = array();
        
        if( is_home() ){
            $post = get_post( get_option( 'page_for_posts' ) );
        }else{
           global $post; 
        }
        

        // Menu
        $html_menu = '<ul data-menu="main" class="menu__level ' . (( !perf_main_menu_has_child() )?'visible':'') . '">';

        foreach( $menu as $item ):

            if( perf_menu_item_has_child($item->ID) ){
                $menu_zero_with_child[] = $item->ID;
                $has_child = true;
            }else{
                $has_child = false;
            }

            $menu_icon = get_field( 'perf_icon_name', $item->ID );

            if(  $item->object_id == $post->ID ){
                $current_page = 'active';
            }else{
                $current_page = '';
            }

            if( $item->menu_item_parent == 0 ):
                
                $html_menu .= '<li class="menu__item '. $current_page .'">';
                    $html_menu .= '<a class="menu__link flex flex-center" ' . (($has_child)?'data-submenu="submenu-'. $item->ID .'" href="#"':'href="'. $item->url .'"') . '>';
                    
                    $html_menu .= '<span class="flex-auto" ' . (($has_child)?'data-submenu="submenu-'. $item->ID .'"':'') . '>' . $item->title . '</span>';
                    
                    if( $menu_icon ){ 
                        $html_menu .= '<svg class="fa flex-none '. $menu_icon .'"><use xlink:href="#'. $menu_icon .'"></use></svg>'; 
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
                echo '<ul data-menu="submenu-' . $item . '" class="menu__level">';
                    foreach( $menu as $starter_item ):

                        if(  $starter_item->menu_item_parent == $item ):

                            if( perf_menu_item_has_child($starter_item->ID) ){
                                $menu_sub_with_child[] = $starter_item->ID;
                                $has_child = true;
                            }else{
                                $has_child = false;
                            }

                            $menu_icon = get_field( 'perf_icon_name', $starter_item->ID );

                            if(  $starter_item->object_id == $post->ID ){
                                $current_page = 'active';
                            }else{
                                $current_page = '';
                            }

                            ?>
                                <li class="menu__item <?php echo $current_page; ?>">
                                    <a class="menu__link flex flex-center" <?php if( $has_child ){ echo 'data-submenu="submenu-'.$starter_item->ID .'" href="#"'; }else{ echo 'href="'. $starter_item->url .'"';} ?>>
                                        <span class="flex-auto" <?php if( $has_child ){ echo 'data-submenu="submenu-'.$starter_item->ID . '"'; } ?>>
                                            <?php echo $starter_item->title; ?> 
                                        </span>

                                        <?php 
                                            if( $menu_icon ){ 
                                                echo '<svg class="fa flex-none '. $menu_icon .'"><use xlink:href="#'. $menu_icon .'"></use></svg>'; 
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
                echo '<ul data-menu="submenu-' . $item . '" class="menu__level">';
                    foreach( $menu as $starter_item ):

                        $menu_icon = get_field( 'perf_menu_icon', $starter_item->ID );

                        if(  $starter_item->object_id == $post->ID ){
                            $current_page = 'active';
                        }else{
                            $current_page = '';
                        } 


                    
                        if(  $starter_item->menu_item_parent == $item ):
                            ?>
                                <li class="menu__item  <?php echo $current_page; ?>">
                                    <a class="menu__link flex flex-center" <?php echo 'href="'. $starter_item->url .'"'; ?>>
                                        <span class="flex-auto">
                                            <?php echo $starter_item->title; ?>
                                        </span>

                                        <?php 
                                            if( $menu_icon ){ 
                                                echo '<i class="fa flex-none '. $menu_icon .'"></i>'; 
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
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

}

/**
 * Detect if primary menu item has child
 */
function perf_menu_item_has_child( $item_id ){
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
function perf_main_menu_has_child() {

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

add_action("perf_footer_scripts","perf_menu_toggle");
function perf_menu_toggle(){
    ?>
    // Open main nav
    document.getElementById("main_nav_toggle").addEventListener("click", function () {
        
        var main_nav = document.getElementById("ml-menu");
        
        if (main_nav.classList.contains("menu--open")) {
            main_nav.classList.remove("menu--open");
        } else {
            main_nav.classList.add("menu--open");
        }

    });

    // Close main nav
    document.querySelector('.action--close').addEventListener("click", function () {
        
        var main_nav = document.getElementById("ml-menu");
        
        if (main_nav.classList.contains("menu--open")) {
            main_nav.classList.remove("menu--open");
        }

    });
    <?php
}

add_action("perf_footer_scripts","perf_call_sprite_fontawesome");
function perf_call_sprite_fontawesome(){
    ?>
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



add_action("wp_footer","perf_custom_js", 99);
function perf_custom_js(){
  echo '<script>';

  do_action('perf_footer_scripts');

  echo '</script>';
}

/**
 * Retrieves the response from the specified URL using one of PHP's outbound request facilities.
 *
 * @params  $url  The URL of the feed to retrieve.
 * @returns The response from the URL; null if empty.
 */
function perf_get_response( $url ) {
    $response = null;

    // First, we try to use wp_remote_get
    $response = wp_remote_get( $url );

    if( is_wp_error( $response ) ) {

        // If that doesn't work, then we'll try file_get_contents
        $response = file_get_contents( $url );

        if( false == $response ) {

            // And if that doesn't work, then we'll try curl
            $response = $this->curl( $url );

            if( null == $response ) {
                $response = 0;
            } // end if/else

        } 

    } 

    // If the response is an array, it's coming from wp_remote_get,
    // so we just want to capture to the body index for json_decode.
    if( is_array( $response ) ) {
        $response = $response['body'];
    }

    return $response;
}



