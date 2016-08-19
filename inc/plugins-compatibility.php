<?php
/**
 * Plugin compatibility module
 *
 * @package perfthemes
 */
if ( class_exists( 'autoptimizeConfig' ) ){
	add_action( 'admin_notices', 'sample_admin_notice__error' );
}

function sample_admin_notice__error() {
	?>
    <div class="notice notice-error is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("Autoptimize is not compatible with Light & Bold and will generate unexpected results.", "lightbold"); ?></p>
    	<br>
    </div>
    <?php
}