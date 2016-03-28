<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package perfthemes
 */

if ( ! is_active_sidebar( 'page-sidebar' ) ) {
	return;
}
?>

<div class="widget-area md-col md-col-3 lg-col-2 mt4 md-mt0" role="complementary">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</div><!-- #secondary -->
