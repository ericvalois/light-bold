<?php
	// Include WordPress
  	define('WP_USE_THEMES', false);
  	require('../../../../wp-blog-header.php');
    header("Content-type: text/css; charset: UTF-8");

    include_once( '../style.css' );

    do_action( 'perf_mobile_styles' );

?>
#tinymce{ padding: 30px !important; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;}