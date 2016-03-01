<?php
/**
 * Remove one or more icon types
 *
 * Uncomment one or more line to remove icon types
 *
 * @param  array $types Registered icon types.
 * @return array
 */
function my_remove_menu_icons_type( $types ) {
    // Dashicons
    unset( $types['dashicons'] );

    // Elusive
    unset( $types['elusive'] );

    // Font Awesome
    //unset( $types['fa'] );

    // Foundation
    unset( $types['foundation-icons'] );

    // Genericons
    unset( $types['genericon'] );

    // Image
    unset( $types['image'] );

    return $types;
}
add_filter( 'menu_icons_types', 'my_remove_menu_icons_type' );

// Remove menu icon setting
add_filter( 'menu_icons_disable_settings', '__return_true' );