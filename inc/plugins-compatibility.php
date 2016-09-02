<?php
/**
 * Plugin compatibility module
 *
 * @package perfthemes
 */

/*
* Autoptimize
*/
if ( class_exists( 'autoptimizeConfig' ) ){ 
	add_action( 'admin_notices', 'perf_autoptimize_admin_notice' );
}
function perf_autoptimize_admin_notice() {
	?>
    <div class="notice notice-warning is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("The Light & Bold CSS/JavaScript optimisation are not compatible with the Autoptimize one. Please, choose only on of those.", "lightbold"); ?></p>
    </div>
    <?php
}

/*
* WP Rocket
*/
if ( function_exists( 'rocket_init' ) ){ 
	add_action( 'admin_notices', 'perf_wp_rocket_admin_notice' );
}
function perf_wp_rocket_admin_notice() {
	?>
    <div class="notice notice-warning is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("You are using WP Rocket it's a good thing. However, be notice that the Light & Bold CSS/JavaScript optimization are not compatible with the WP Rocket one. Please, choose only on of those.", "lightbold"); ?></p>
    </div>
    <?php
}