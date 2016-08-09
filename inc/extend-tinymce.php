<?php
/**
 * perfthemes tinymce extensions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package perfthemes
 */

add_filter( 'mce_buttons_2', 'perf_mce_editor_buttons' );
function perf_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'perf_styles_dropdown' );
function perf_styles_dropdown( $settings ) {

	// Create array of new styles
	$new_styles = array(
		array(
			'title'	=> __( 'Custom Styles', 'lightbold' ),
			'items'	=> array(
				array(
			        'title' => 'Intro text',
			        'selector' => 'p',
			        'classes' => 'intro-text separator'
		        ),
		        array(
			        'title' => 'Perf alert default',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_alert_default',
		        ),
		        array(
			        'title' => 'Perf alert warning',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_warning',
		        ),
		        array(
			        'title' => 'Perf alert info',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_info',
		        ),
		        array(
			        'title' => 'Perf alert danger',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_danger',
		        ),
		        array(
			        'title' => 'Perf alert success',
			        'selector' => 'p',
			        'classes' => 'perf_alert perf_success',
		        ),
		        array(
			        'title' => 'Perf button',
			        'block' => 'a',
			        'classes' => 'perf_btn',
			        'wrapper' => true,
		        ),
			),
		),
	);

	// Merge old & new styles
	$settings['style_formats_merge'] = true;

	// Add new styles
	$settings['style_formats'] = json_encode( $new_styles );

	// Return New Settings
	return $settings;

}

/*
* Add editor styles
*/
function perf_theme_add_editor_styles() {
    add_editor_style( 'inc/tinymce.php' );
}
add_action( 'admin_init', 'perf_theme_add_editor_styles' );