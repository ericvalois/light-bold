<?php
	// Include WordPress
  	define('WP_USE_THEMES', false);
  	require('../../../../wp-blog-header.php');

    header("Content-type: text/css; charset: UTF-8");
    $perf_temp_css = wp_remote_get(get_template_directory_uri() . "/style.css");
    $perf_stylesheet = $perf_temp_css['body'];

    echo $perf_stylesheet;
    do_action( 'perf_mobile_styles' );

?>
#tinymce{ padding: 30px !important;}