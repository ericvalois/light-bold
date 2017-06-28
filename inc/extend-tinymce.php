<?php
/**
 * ttfb tinymce extensions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package ttfb
 */

add_filter( 'mce_buttons_2', 'light_bold_mce_editor_buttons' );
function light_bold_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'light_bold_styles_dropdown' );
function light_bold_styles_dropdown( $settings ) {

	// Create array of new styles
	$light_bold_new_styles = array(
		array(
			'title'	=> esc_html__( 'Custom Styles', 'light-bold' ),
			'items'	=> array(
				array(
			        'title' => 'Intro text',
			        'selector' => 'p',
			        'classes' => 'intro-text separator'
		        ),
		        array(
			        'title' => 'Alert default',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_alert_default',
		        ),
		        array(
			        'title' => 'Alert warning',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_warning',
		        ),
		        array(
			        'title' => 'Alert info',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_info',
		        ),
		        array(
			        'title' => 'Alert danger',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_danger',
		        ),
		        array(
			        'title' => 'Alert success',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_success',
		        ),
		        array(
			        'title' => 'Button',
			        'block' => 'a',
			        'classes' => 'perf_btn',
			        'wrapper' => true,
		        ),
		        array(
			        'title' => 'Button2',
			        'block' => 'a',
			        'classes' => 'perf_btn alt2',
			        'wrapper' => true,
		        ),
			),
		),
	);

	// Merge old & new styles
	$settings['style_formats_merge'] = true;

	// Add new styles
	$settings['style_formats'] = json_encode( $light_bold_new_styles );

	// Return New Settings
	return $settings;
}

/*
* Add theme dynamic styles to TinyMCE
*/
add_filter('tiny_mce_before_init','wpdocs_theme_editor_dynamic_styles');
function wpdocs_theme_editor_dynamic_styles( $mceInit ) {
    $custom_css = light_bold_custom_styles();
    $custom_css = preg_replace( "/\r|\n/", "", $custom_css );
    $styles = esc_attr($custom_css);
    $styles = $styles . '#tinymce{ padding: 30px !important; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", \"Roboto\", \"Oxygen\", \"Ubuntu\", \"Cantarell\", \"Fira Sans\", \"Droid Sans\", \"Helvetica Neue\", sans-serif;}';

    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
    return $mceInit;
}

/**
 * Registers an editor stylesheet for the theme.
 */
 add_action( 'admin_init', 'light_bold_add_editor_styles' );
function light_bold_add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/style.css' );
}


