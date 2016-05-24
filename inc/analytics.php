<?php
/*
* Analytics or other JS inline scripts
*/
add_action( 'wp_head', 'perf_analytics' );
function perf_analytics() {
	if( get_field("perf_analytics","option") != '' ){
		echo '<script>' . strip_tags( get_field("perf_analytics","option") ) . '</script>';
	}
}
