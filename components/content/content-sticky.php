<?php
/**
 * Template part for displaying sticky posts.
 *
 * @package ttfb
 */
	$sticky = get_option( 'sticky_posts' );
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if ( is_array( $sticky ) && count($sticky) > 0 ) :
		$args = array(
			'posts_per_page'      => -1,
			'post__in'            => $sticky,
			'ignore_sticky_posts' => 1,
		);

		// Remove sticky post from the main loop
		query_posts( array( 'post__not_in' => get_option( 'sticky_posts' ), 'paged' => $paged ) );
	else:
		$args = array(
			'posts_per_page'      => 1,
		);

		$number_of_feature_posts = 1;
		$number_of_secondary_posts = 8;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$how_many_secondary_posts_past = ($number_of_secondary_posts * ($paged - 1));
		$off = $number_of_feature_posts + (($paged > 1) ? $how_many_secondary_posts_past : 0);

		query_posts( "posts_per_page=$number_of_secondary_posts&offset=$off&showposts=$number_of_secondary_posts" );
	endif;

	$featured_query = new WP_Query( $args );
?>
	
<?php if ( $featured_query->have_posts() ) : ?>

	<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("sticky break-word table col-12"); ?>>
			<div class="<?php if( has_post_thumbnail() ){ echo 'md-col-7 md-table-cell'; } ?> align-top dark-bg px2 sm-px3 md-px4 py3 md-py4 ">

				<div class="sticky-meta ultra-small upper mb1">
					<span class="main-color"><?php echo get_the_date(); ?></span>
					<span class="white-color inline-block px"> | </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="white-color"><?php echo get_the_author(); ?></a>
				</div>

				<h2 class="entry-title h2 separator mb3 mt0"><a class="white-color" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

				<p class="small-p white-color">
					<?php
                        if( has_excerpt() ){
                            echo esc_html( get_the_excerpt() );
                        }else{
                            $content = wp_trim_words( get_the_content(), 20, '...' ); 
                            echo esc_html( strip_tags( $content ) );
                        }
					?>
				</p>

				<a href="<?php the_permalink(); ?>" class="perf_btn"><?php esc_html_e("Read more","light-bold"); ?></a>
			</div>

			<?php if( has_post_thumbnail() ): ?>
				<div class="col-12 md-col-5 md-table-cell bg-cover bg-center center lazyload" data-sizes="auto"
					data-bgset="<?php the_post_thumbnail_url( 'light-bold-hero-lg' ); ?> [(min-width: 100em)] |
					<?php the_post_thumbnail_url( 'light-bold-hero-md' ); ?> [(min-width: 52em)]">
				</div>
			<?php endif; ?>
		</article>

	<?php endwhile;  ?>
    
<?php endif; ?>