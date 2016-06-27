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

    // Image
    unset( $types['svg'] );

    return $types;
}
add_filter( 'menu_icons_types', 'my_remove_menu_icons_type' );

// Remove menu icon setting
//add_filter( 'menu_icons_disable_settings', '__return_true' );


/**
 * Load Font Awesome's CSS from CDN
 *
 * @param  string                $stylesheet_uri Icon type's stylesheet URI.
 * @param  string                $icon_type_id   Icon type's ID.
 * @param  Icon_Picker_Type_Font $icon_type      Icon type's instance.
 *
 * @return string
 */
function perf_font_awesome_css_from_cdn( $stylesheet_uri, $icon_type_id, $icon_type ) {
    if ( 'fa' === $icon_type_id ) {
        $stylesheet_uri = sprintf(
            get_template_directory_uri() . '/inc/font-awesome/css/font-awesome.min.css',
            $icon_type->version
        );
    }

    return $stylesheet_uri;
}
add_filter( 'icon_picker_icon_type_stylesheet_uri', 'perf_font_awesome_css_from_cdn', 10, 3 );
