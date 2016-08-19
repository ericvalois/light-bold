<?php
/*
* Analytics or other JS inline scripts
*/
add_action( 'wp_head', 'perf_analytics' );
function perf_analytics() {
	if( perf_get_field("perf_analytics","option") != '' ){
		echo '<script>' . strip_tags( perf_get_field("perf_analytics","option") ) . '</script>';
	}
}
