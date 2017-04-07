<?php
/*
* Analytics or other JS inline scripts
*/
add_action( 'wp_head', 'light_bold_analytics' );
function light_bold_analytics() {
	if( get_field("perf_analytics","option") != '' ){
		echo '<script>' . strip_tags( get_field("perf_analytics","option") ) . '</script>';
	}
}
