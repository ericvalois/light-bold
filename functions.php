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
	 * to change 'perf' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'perf', get_template_directory() . '/languages' );

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

	add_image_size( 'perfthemes-hero-xl', 1630, 612, true );
	add_image_size( 'perfthemes-hero-lg', 950, 612, true );
	add_image_size( 'perfthemes-hero-md', 767, 612, true );
	add_image_size( 'perfthemes-hero-sm', 595, 448, true );
	
	//add_image_size( 'perfthemes-thumbnail-avatar', 100, 100, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'perf' ),
		'sub-footer' => esc_html__( 'sub-footer', 'perf' ),
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
		'default-image' => '',
	) ) );


}
endif; // perf_setup
add_action( 'after_setup_theme', 'perf_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function perf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'perf' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 white-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator alt upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'perf' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 white-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator alt upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'perf' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 white-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator alt upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'perf' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 white-color %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator alt upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog sidebar', 'perf' ),
		'id'            => 'blog-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="perf_widget mb3 %2$s ">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title separator upper mb2">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page sidebar', 'perf' ),
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
	wp_enqueue_style( 'perf-stylesheet', get_stylesheet_uri()  );

	wp_dequeue_style( 'menu-icons-extra' );

	wp_enqueue_script( 'perf-main-script', get_template_directory_uri() . '/js/main.js', array(), '', true );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( function_exists( 'get_field' ) && get_field("perf_contact_recaptcha","option") && is_page_template("page-templates/template-contact.php") ){
		wp_enqueue_script( 'perf-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'perf_scripts' );

if( function_exists( 'get_field' ) ):

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/inc/extras.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	/**
	 * Load Jetpack compatibility file.
	 */
	require get_template_directory() . '/inc/jetpack.php';

	/**
	 * Load ACF 
	 */
	//require get_template_directory() . '/inc/acf.php';

	/**
	 * Load ACF fields
	 */
	require get_template_directory() . '/inc/acf-fields.php';

	/**
	 * Load ACF metabox
	 */
	require get_template_directory() . '/inc/acf-metabox.php';

	/**
	 * WordPress cleanup
	 */
	require get_template_directory() . '/inc/clean.php';

	/**
	 * Performances optimizations
	 */
	require get_template_directory() . '/inc/performance.php';

	/**
	 * Load TGM class
	 */
	require get_template_directory() . '/inc/tgm.php';

	/**
	 * Load Breadcrumb helper
	 */
	require get_template_directory() . '/inc/breadcrumb.php';

	/**
	 * Load custom style
	 */
	require get_template_directory() . '/inc/custom-styles.php';

	/**
	 * Menu icons
	 */
	require get_template_directory() . '/inc/menu-icons.php';

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
	 * Plugins compatibility
	 */
	require get_template_directory() . '/inc/plugins-compatibility.php';

	/**
	 * Google Font
	 */
	require get_template_directory() . '/inc/google-font.php';

	/**
	 * Custom protected form markup
	 */
	require get_template_directory() . '/inc/custom-protected-form.php';

	/**
	 * Custom contact form
	 */
	require get_template_directory() . '/inc/contact-form.php';
endif; // if_function_exits
