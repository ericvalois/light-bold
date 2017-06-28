<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ttfb
 */

if ( ! is_active_sidebar( 'page-sidebar' ) ) {
	return;
}
?>

<div class="widget-area lg-col lg-col-4 mt4 lg-mt0 hide-print" role="complementary">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</div><!-- #secondary -->
