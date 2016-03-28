<?php
	
	// Include WordPress
  	define('WP_USE_THEMES', false);
  	require('../../../../wp-blog-header.php');

    header("Content-type: text/css; charset: UTF-8");

    $stylesheet = file_get_contents("../style.css");

    echo $stylesheet;
    do_action( 'perf_mobile_styles' );

?>
#tinymce{ padding: 30px !important;}