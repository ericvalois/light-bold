<?php
/**
 * If Theme Demo Import Active
 */
if( light_bold_is_theme_demo_import_active() ){
    /**
     * light & Bold demo import
     */
    require get_template_directory() . '/includes/compatibility/theme-demo-import/demo.php';
}

/**
 * If Gutenberg Active
 */
if( light_bold_is_gutenberg_active() ){
    /**
     * Gutenberg Optimization
     */
    require get_template_directory() . '/includes/compatibility/gutenberg/gutenberg.php';
}