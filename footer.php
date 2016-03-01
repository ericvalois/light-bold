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


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'perf' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'perf' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'perf' ), 'perf', '<a href="https://perfthemes.com" rel="designer">Perfthemes</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .site-content -->

<?php wp_footer(); ?>

</body>
</html>
