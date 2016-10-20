<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package perfthemes
 */

?>


	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
		<footer class="site-footer clearfix dark-bg hide-print">

			<div class="clearfix mt3 mb3 lg-mt4 px2 lg-px3 ">
				<div class="md-col md-col-3">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>

				<div class="md-col md-col-3">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>

				<div class="md-col md-col-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>

				<div class="md-col md-col-3">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>

		</footer><!-- #colophon -->

	<?php endif; ?>

	<div class="site-info py2 px2 lg-px3 bg-black clearfix hide-print">
		<div class="md-col md-col-6 mb1 md-mb0">
			<div class="white-color copy">&copy; <?php echo date("Y"); ?><?php echo perf_get_field("perf_footer_copy","option"); ?></div>
		</div>

		<div class="md-col md-col-6">
			<?php if( perf_get_field("perf_disble_top_anchor","option") != 1 ){ echo '<a href="#content" id="to_top" class="right ml2 bg-black border-none"><i class="fa fa-chevron-up"></i></a>'; } ?>
			<?php
				wp_nav_menu( array( 'theme_location' => 'sub-footer', 'menu_id' => 'sub-footer', 'container' => '', 'fallback_cb' => false, 'menu_class' => 'list-reset md-right' ) );
			?>

		</div>
	</div><!-- .site-info -->

</div><!-- .site-content -->

<script>
    function loadJS(u) {
        var r = document.getElementsByTagName("script")[0],
            s = document.createElement("script");
        s.src = u;
        r.parentNode.insertBefore(s, r);
    }

    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        loadJS("https://afarkas.github.io/lazysizes/plugins/respimg/ls.respimg.min.js");
    }
</script>

<?php wp_footer(); ?>

</body>
</html>
