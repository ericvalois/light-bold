<?php
/**
 * ttfb functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package ttfb
 */

/**
* Detect acf to prevent fatal error
*/
if( !is_admin() ){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	// check for plugin using plugin name
	if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	    function get_field(){
			return;
		}
	}
}

if ( ! function_exists( 'light_bold_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function light_bold_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ttfb, use a find and replace
	 * to change 'light-bold' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'light-bold', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'light-bold-hero-lg', 950, 612, true );
	add_image_size( 'light-bold-hero-md', 767, 494, true );
	add_image_size( 'light-bold-hero-sm', 595, 383, true );

	add_image_size( 'light-bold-hero-placeholder', 50, 32, true );

    add_image_size( 'light-bold-blog', 760, 360, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'light-bold' ),
		'sub-footer' => esc_html__( 'Sub-footer', 'light-bold' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

    /**
    * Load TGM class
    */
    require get_template_directory() . '/includes/admin/tgm/tgm.php';

    /* Admin functionality */
	if ( is_admin() ) {
		// Getting Started page and EDD update class
		require_once( get_template_directory() . '/includes/admin/updater/theme-updater.php' );
	}

}
endif; // light_bold_setup
add_action( 'after_setup_theme', 'light_bold_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function light_bold_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'light_bold_content_width', 2000 );
}
add_action( 'after_setup_theme', 'light_bold_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function light_bold_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'light-bold' ),
		'id'            => 'footer-1',
		'description'   => esc_html__("First footer column location","light-bold"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'light-bold' ),
		'id'            => 'footer-2',
		'description'   => esc_html__("Second footer column location","light-bold"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'light-bold' ),
		'id'            => 'footer-3',
		'description'   => esc_html__("Third footer column location","light-bold"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'light-bold' ),
		'id'            => 'footer-4',
		'description'   => esc_html__("Fourth footer column location","light-bold"),
		'before_widget' => '<div id="%1$s" class="mb2 footer_widget widget %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog', 'light-bold' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__("Blog and archive sidebar location","light-bold"),
		'before_widget' => '<div id="%1$s" class="widget-side widget mb2 %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title separator upper mb2">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page', 'light-bold' ),
		'id'            => 'page-sidebar',
		'description'   => esc_html__("Default page sidebar location","light-bold"),
		'before_widget' => '<div id="%1$s" class="widget-side widget mb2 %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title separator upper mb2">',
		'after_title'   => '</h4>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Under Posts', 'light-bold' ),
		'id'            => 'under-posts-sidebar',
		'description'   => esc_html__("Under posts sidebar location","light-bold"),
		'before_widget' => '<div id="%1$s" class="widget mb2 %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb1 mt2">',
		'after_title'   => '</h5>',
    ) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Under Pages', 'light-bold' ),
		'id'            => 'under-pages-sidebar',
		'description'   => esc_html__("Under pages sidebar location","light-bold"),
		'before_widget' => '<div id="%1$s" class="widget mb2 %2$s clearfix break-word">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title mb1 mt2">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'light_bold_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function light_bold_scripts() {

	/* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'light-bold-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'light-bold-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'light-bold-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }

	if ( is_page_template("page-templates/template-front.php") ){

		if ( light_bold_flickity_detection( get_the_id() ) ){
			// Flickity Script
			wp_enqueue_script( 'flickity', get_template_directory_uri() . '/inc/3rd-party/flickity/flickity.min.js', array(), '', true );
		}
	}

	wp_enqueue_script( 'light-bold-init', get_template_directory_uri() . '/js/lightbold-init.min.js', array(), '', true );

	// Main menu script
	if ( has_nav_menu( 'primary' ) && light_bold_main_menu_has_child() ){
		wp_enqueue_script( 'light-bold-menu', get_template_directory_uri() . '/js/menu.min.js', array(), '', true );
	}

    // Logged In script
	if (  is_user_logged_in() && is_admin_bar_showing() ){
		wp_enqueue_script( 'light-bold-logged-in', get_template_directory_uri() . '/js/logged-in.min.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && !is_page_template("page-templates/template-front.php") ) {
		wp_enqueue_script( 'comment-reply' );
    }
    
    // smooth-scrolling Script
    if( get_field("perf_smooth_scroll","option") ){
        wp_enqueue_script( 'light-bold-smooth-scrolling', get_template_directory_uri() . '/js/smooth-scrolling.min.js', array(), '', true );
    }
	
}
add_action( 'wp_enqueue_scripts', 'light_bold_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Light & Bold functions
 */
require get_template_directory() . '/inc/lightbold.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Breadcrumb helper
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Social Widget
 */
require get_template_directory() . '/inc/widget-social.php';

/**
 * Address widget
 */
require get_template_directory() . '/inc/address-widget.php';

/**
 * Custom protected form markup
 */
require get_template_directory() . '/inc/custom-protected-form.php';