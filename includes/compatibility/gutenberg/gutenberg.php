<?php
/* 
* Gutenberg Support
*/
add_action( 'after_setup_theme', 'light_bold_gutenberg_init' );
function light_bold_gutenberg_init(){
    add_theme_support( 'editor-color-palette',
        get_theme_mod('primary_color','#1078ff'),
        get_theme_mod('text_color','#3A4145'),
        '#fff',
        '#eee',
        '#444'
    );
    add_theme_support( 'align-wide' );
}

/*
* Enqueue Gutenberg Stylesheet
*/
add_action( 'wp_enqueue_scripts', 'enqueue' );
function enqueue() {
    wp_enqueue_style( 'light-bold-gutenberg-style', trailingslashit( get_template_directory_uri() ) . '/includes/compatibility/gutenberg/gutenberg.css' );
}

