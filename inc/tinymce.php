<?php
	
	// Include WordPress
  	define('WP_USE_THEMES', false);
  	require('../../../../wp-blog-header.php');

    header("Content-type: text/css; charset: UTF-8");
    $temp_css = wp_remote_get(get_template_directory_uri() . "/style.css");
    $stylesheet = $temp_css['body'];

    echo $stylesheet;
    do_action( 'perf_mobile_styles' );

?>
#tinymce{ padding: 30px !important;}