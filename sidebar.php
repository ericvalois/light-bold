<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package perfthemes
 */

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
	return;
}
?>

<div class="widget-area lg-col lg-col-3 mt4 lg-mt0" role="complementary">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</div><!-- #secondary -->
