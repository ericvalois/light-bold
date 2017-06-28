<?php
/**
 * perfthemes custom protected form
 *
 * @package perfthemes
 */
add_filter( 'the_password_form', 'light_bold_custom_password_form' );
function light_bold_custom_password_form() {
	global $post;
	$light_bold_label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$light_bold_o = '<form class="protected-post-form" action="' . esc_url( get_option('siteurl') ) . '/wp-pass.php" method="post">';
	
	$light_bold_o .= '<p>' . esc_html__(  "This content is password protected. To view it please enter your password below:","light-bold" ) . '</p>';

	$light_bold_o .= '<label for="' . esc_attr( $light_bold_label ) . '">' . esc_html__( "Password:","light-bold" ) . ' </label><input name="post_password" id="' . esc_attr( $light_bold_label ) . '" type="password" size="20" /><input type="submit" class="light_bold_btn mt1 mb1" name="Submit" value="' . esc_attr__( "Submit","light-bold" ) . '" />
	</form>';
	return $light_bold_o;
}