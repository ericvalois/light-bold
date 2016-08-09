<?php
/**
 * perfthemes custom protected form
 *
 * @package perfthemes
 */
add_filter( 'the_password_form', 'perf_custom_password_form' );
function perf_custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">';
	
	$o .= '<p>' . __( "This content is password protected. To view it please enter your password below:","lightbold" ) . '</p>';

	$o .= '<label for="' . $label . '">' . __( "Password:","lightbold" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" class="perf_btn mt1 mb1" name="Submit" value="' . esc_attr__( "Submit","lightbold" ) . '" />
	</form>';
	return $o;
}