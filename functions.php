<?php
/**
 * perfthemes functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package perfthemes
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

if ( ! function_exists( 'perf_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function perf_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on perfthemes, use a find and replace
	 * to change 'lightbold' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lightbold', get_template_directory() . '/languages' );

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

	add_image_size( 'perfthemes-hero-lg', 950, 612, true );
	add_image_size( 'perfthemes-hero-md', 767, 494, true );
	add_image_size( 'perfthemes-hero-sm', 595, 383, true );

	add_image_size( 'perfthemes-hero-placeholder', 50, 32, true );

	add_image_size( 'perfthemes-blog', 760, 360, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lightbold' ),
		'sub-footer' => esc_html__( 'Sub-footer', 'lightbold' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'perf_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );


}
endif; // perf_setup
add_action( 'after_setup_theme', 'perf_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lightbold_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lightbold_content_width', 2000 );
}
add_action( 'after_setup_theme', 'lightbold_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function perf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'lightbold' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'lightbold' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'lightbold' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'lightbold' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title main-color separator upper mb2 mt0 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog sidebar', 'lightbold' ),
		'id'            => 'blog-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="perf_widget mb3 %2$s ">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title separator upper mb2">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page sidebar', 'lightbold' ),
		'id'            => 'page-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="perf_widget mb3 %2$s ">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title separator upper mb2">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'perf_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function perf_scripts() {

	/* If using a child theme, auto-load the parent theme style. */
    if ( is_child_theme() ) {
        wp_enqueue_style( 'perf-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style( 'perf-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'perf-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }

	if ( is_page_template("page-templates/template-front.php") ){

		if ( perf_flickity_detection( get_the_id() ) ){
			// Flickity Script
			wp_enqueue_script( 'perf-flickity', get_template_directory_uri() . '/inc/3rd-party/flickity/flickity.min.js', array(), '', true );
		}
	}

	wp_enqueue_script( 'perf-init', get_template_directory_uri() . '/js/lightbold-init.min.js', array(), '', true );

	// Main menu script
	if ( has_nav_menu( 'primary' ) && perf_main_menu_has_child() ){
		wp_enqueue_script( 'perf-menu-script', get_template_directory_uri() . '/js/menu.min.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && !is_page_template("page-templates/template-front.php") ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'perf_scripts' );

/**
 * Load TGM class
 */
require get_template_directory() . '/includes/admin/tgm/tgm.php';

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
 * Load custom style
 */
require get_template_directory() . '/inc/custom-styles.php';

/**
 * Social Widget
 */
require get_template_directory() . '/inc/widget-social.php';

/**
 * Address widget
 */
require get_template_directory() . '/inc/address-widget.php';

/**
 * Image widget
 */
require get_template_directory() . '/inc/widget-image.php';

/**
 * Add custom buttons and formating to Tinymce
 */
require get_template_directory() . '/inc/extend-tinymce.php';

/**
 * Custom protected form markup
 */
require get_template_directory() . '/inc/custom-protected-form.php';

/**
 * Analytics code
 */
require get_template_directory() . '/inc/analytics.php';