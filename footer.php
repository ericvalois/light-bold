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
		<footer class="site-footer clearfix dark-bg hide-print break-word">

            <?php 
                $footer_data = get_field("perf_footer","option");

                if( !empty( $footer_data['copy'] ) ){
                    $footer_copy = $footer_data['copy'];
                }else{
                    $footer_copy = get_field("perf_footer_copy","option");
                }

                if( !empty( $footer_data['layout'] ) ){
                    $layout = $footer_data['layout'];
                }else{
                    $layout = 4;
                }

                if( !empty( $footer_data['col_padding'] ) ){
                    $col_padding = $footer_data['col_padding'];
                }else{
                    $col_padding = 'px2';
                }

                if( !empty( $footer_data['col_breakpoints'] ) ){
                    $col_breakpoints = $footer_data['col_breakpoints'];
                }else{
                    $col_breakpoints = 'lg';
                }
            ?>
            
			<div class="clearfix mt3 mb3 lg-mt4 px2 lg-px2 ">
                <?php $index = 1; ?>
                <?php $col_width = 12 / $layout; ?>
                <?php while ( $layout >= 1 ) : ?>
                
                    <div class="<?php echo esc_attr( $col_breakpoints ); ?>-col <?php echo esc_attr( $col_breakpoints ); ?>-col-<?php echo esc_attr( $col_width ); ?> <?php echo esc_attr( $col_breakpoints ); ?>-<?php echo esc_attr( $col_padding ); ?>">
                        <?php dynamic_sidebar( 'footer-' . $index ); ?>
                    </div>

                    <?php $layout--; $index++; ?>
                <?php endwhile; ?>
			</div>

		</footer><!-- #colophon -->

	<?php endif; ?>

	<div class="site-info py2 px2 lg-px3 bg-black clearfix hide-print">
		<div class="md-col md-col-6 mb1 md-mb0">
			<div class="white-color copy">&copy; <?php echo date("Y"); ?> <?php echo wp_kses( $footer_copy, array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array() ) ) ); ?></div>
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
