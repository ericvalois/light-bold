<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ttfb
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content clearfix">
        <?php 

            do_action("light_bold_before_page_content");

            the_content();

            do_action("light_bold_after_page_content");
        
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'light-bold' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'light-bold' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

