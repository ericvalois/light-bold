<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfthemes
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="sticky-meta ultra-small upper mb1">
        <span class="main-color"><?php echo get_the_date(); ?></span>
        <span class="inline-block px"> | </span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>" class="dark-color"><?php echo get_the_author(); ?></a>
    </div>

    <h2 class="entry-title h2 mb1 mt0"><a href="<?php the_permalink(); ?>" class="dark-color" rel="bookmark"><?php the_title(); ?></a></h2>
    <a href="<?php the_permalink(); ?>" class="mb2 md-mb3 small-p inline-block"><?php esc_html_e("Read more","light-bold"); ?></a>
</article>