<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ttfb
 */

?>

	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
		<footer class="site-footer clearfix dark-bg hide-print">

			<div class="clearfix mt3 mb3 lg-mt4 px2 lg-px3 ">
				<div class="lg-col lg-col-3">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>

				<div class="lg-col lg-col-3">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>

				<div class="lg-col lg-col-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>

				<div class="lg-col lg-col-3">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>

		</footer><!-- #colophon -->

	<?php endif; ?>

	<div class="site-info py2 px2 lg-px3 bg-black clearfix hide-print">
		<div class="md-col md-col-6 mb1 md-mb0">
			<div class="white-color copy">&copy; <?php echo date("Y"); ?> <?php echo wp_kses( get_field("perf_footer_copy","option"), array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array() ) ) ); ?></div>
		</div>

		<div class="md-col md-col-6">
			<?php
				wp_nav_menu( array( 'theme_location' => 'sub-footer', 'menu_id' => 'sub-footer', 'container' => '', 'fallback_cb' => false, 'menu_class' => 'list-reset md-right' ) );
			?>

		</div>
	</div><!-- .site-info -->

</div><!-- .site-content -->

<?php wp_footer(); ?>

</body>
</html>
