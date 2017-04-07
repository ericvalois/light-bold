<?php
/**
 * perfthemes tinymce extensions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package perfthemes
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
			'title'	=> __( 'Custom Styles', 'light-bold' ),
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
		        array(
			        'title' => 'Perf button2',
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
* Add editor styles
*/
add_filter( 'mce_css', 'light_bold_add_editor_styles' );
function light_bold_add_editor_styles( $mce_css ) {
    if ( ! empty( $mce_css ) )
        $mce_css .= ',';

    $mce_css .= get_template_directory_uri() . "/inc/tinymce.php";

    return $mce_css;
}

