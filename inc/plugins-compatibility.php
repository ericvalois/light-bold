<?php
/**
 * Plugin compatibility module
 *
 * @package perfthemes
 */

/************
* Autoptimize
*************/
if ( class_exists( 'autoptimizeConfig' ) && empty( get_option( 'perf-autoptimize-notice-dismissed' ) ) ){ 
	add_action( 'admin_notices', 'perf_autoptimize_admin_notice' );
}

// Detect Plugin deactivation
add_action( 'deactivated_plugin', 'perf_autoptimize_plugin_deactivation', 10, 2 );
function perf_autoptimize_plugin_deactivation(  $plugin, $network_activation ) {
    if( $plugin == "autoptimize/autoptimize.php" ){
        delete_option("perf-autoptimize-notice-dismissed");
    }
}

// Update autoptimize option
add_action( 'wp_ajax_perf_autoptimize_dismiss_notice', 'perf_autoptimize_dismiss_notice' );
function perf_autoptimize_dismiss_notice() {
    update_option( 'perf-autoptimize-notice-dismissed', 1 );
}

// Autoptimize HTML notice
function perf_autoptimize_admin_notice() {
	?>
    <div class="notice notice-warning perf-autoptimize-notice is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("Your theme CSS and JavaScript optimisation options are not compatible with Autoptimize one. Please, choose only on of those.", "lightbold"); ?></p>
    </div>
    <?php
}

/************
* WP Rocket
************/
if ( function_exists( 'rocket_init' ) && empty( get_option( 'perf-rocket-notice-dismissed' ) ) ){ 
    add_action( 'admin_notices', 'perf_wp_rocket_admin_notice' );
}

// Detect Plugin deactivation
add_action( 'deactivated_plugin', 'perf_rocket_plugin_deactivation', 10, 2 );
function perf_rocket_plugin_deactivation(  $plugin, $network_activation ) {
    if( $plugin == "wp-rocket/wp-rocket.php" ){
        delete_option("perf-rocket-notice-dismissed");
    }
}

// Update rocket option
add_action( 'wp_ajax_perf_rocket_dismiss_notice', 'perf_rocket_dismiss_notice' );
function perf_rocket_dismiss_notice() {
    update_option( 'perf-rocket-notice-dismissed', 1 );
}

function perf_wp_rocket_admin_notice() {
	?>
    <div class="notice notice-warning perf-rocket-notice is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("You are using WP Rocket it's a good thing. However, your theme CSS and JavaScript optimization options are not compatible with the WP Rocket one. Please, choose only on of those.", "lightbold"); ?></p>
    </div>
    <?php
}


/*
* Enqueue Notices update
*/
add_action( 'admin_enqueue_scripts', 'perf_notice_update' );
function perf_notice_update() {
    wp_enqueue_script( 'perf-notice-update', trailingslashit( get_template_directory_uri() ) . '/js/notice-update.js', array( 'jquery' ), '1.0', true  );
}