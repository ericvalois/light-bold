<?php
/**
 * ttfb custom protected form
 *
 * @package ttfb
 */
add_filter( 'the_password_form', 'light_bold_custom_password_form' );
function light_bold_custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . esc_html__(  "This content is password protected. To view it please enter your password below:","light-bold" ) . '
    <label for="' . $label . '">' . esc_html__( "Password:","light-bold" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input class="light_bold_btn mt1 mb1" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}