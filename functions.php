<?php
/**
 * perfthemes functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package perfthemes
 */

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'perf' ),
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
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function perf_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'perf_content_width', 640 );
}
add_action( 'after_setup_theme', 'perf_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function perf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'perf' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
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

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'perf_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/inc/acf.php';

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





