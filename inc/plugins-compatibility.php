<?php
if ( class_exists( 'autoptimizeConfig' ) ){
	add_action( 'admin_notices', 'sample_admin_notice__error' );
}

function sample_admin_notice__error() {
	?>
    <div class="notice notice-error is-dismissible clear">
        <p class="clear"><strong>Light & Bold:</strong> <?php _e("Autoptimize is not compatible with Light & Bold and will generate unexpected results."); ?><a href="/wp-admin/admin-post.php?action=deactivate_plugin&plugin=autoptimize%2Fautoptimize.php&_wpnonce=780147b3" class="button-secondary alignright"><?php _e( 'Deactivate', 'rocket' ) ?></a></p>
    	<br>
    </div>
    <?php
}