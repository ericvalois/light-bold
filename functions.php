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

/*
* Custom ACF function
*/
function perf_get_field($field_name, $post_id = false, $format_value = true){
	if( function_exists("get_field") ){
		return get_field($field_name, $post_id, $format_value);
	}else{
		return false;
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
	add_image_size( 'perfthemes-hero-md', 767, 612, true );
	add_image_size( 'perfthemes-hero-sm', 595, 448, true );

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
		'before_widget' => '<div id="%1$s" class="mb2 main-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'lightbold' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 main-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'lightbold' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 main-color md-mr3 %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator upper mb2 small-p">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'lightbold' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="mb2 main-color %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title separator upper mb2 small-p">',
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
        wp_enqueue_style( 'perf-parent-style', trailingslashit( get_template_directory_uri() ) . 'style-1.0.0.css' );
        wp_enqueue_style( 'perf-stylesheet', get_stylesheet_uri()  );
    }else{
    	wp_enqueue_style( 'perf-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style-1.0.0.css' );
    }

	// add fontawsome
	wp_enqueue_style( 'perf-font-awesome', get_template_directory_uri() . '/inc/3rd-party/font-awesome/css/font-awesome.min.css'  );
	
	if ( is_page_template("page-templates/template-front.php") ){

		$flickity = false;
		$post_id = get_the_ID();
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

		if ( $flickity ){
			// Flickity Script
			wp_enqueue_script( 'perf-flickity', get_template_directory_uri() . '/inc/3rd-party/flickity/flickity.min.js', array(), '', true );
			// Custom Flickity Listener
			add_action("perf_footer_scripts","perf_add_flickity_listener"); 
		}
	}

	// Main menu script
	if ( perf_main_menu_has_child() ){
		wp_enqueue_script( 'perf-menu-script', get_template_directory_uri() . '/js/menu.min.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'perf_scripts' );

/**
 * Load TGM class
 */
require get_template_directory() . '/inc/tgm.php';

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
 * Load ACF fields
 */
require get_template_directory() . '/inc/acf-extra.php';

/**
 * Load ACF Metabox
 */
require get_template_directory() . '/inc/acf-data.php';

/**
 * WordPress cleanup
 */
require get_template_directory() . '/inc/clean.php';

/**
 * Performances optimizations
 */
require get_template_directory() . '/inc/performance.php';

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
 * Plugins compatibility
 */
require get_template_directory() . '/inc/plugins-compatibility.php';


/**
 * Custom protected form markup
 */
require get_template_directory() . '/inc/custom-protected-form.php';

/**
 * Analytics code
 */
require get_template_directory() . '/inc/analytics.php';