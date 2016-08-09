<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package perfthemes
 */

if ( ! function_exists( 'perf_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function perf_posted_on() {
	$time_string = '<span class="posted-on"><time class="entry-date published updated" datetime="%1$s">' . __("Posted on","lightbold") . ': ' .'%2$s</time></span> ';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<span class="posted-on"><time class="entry-date published" datetime="%1$s">' . __("Posted on","lightbold") . ': ' .' %2$s</time></span><span class="posted-on">' . __("Last Update","lightbold") . ': ' . '<time class="updated" datetime="%3$s">%4$s</time></span> ';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = $time_string;

	$byline = '<span class="author vcard">' . __("By","lightbold") . ': ' . '<a class="url fn n white-color" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';


	echo $posted_on;

	echo $byline;

	$categories = get_the_category();
	$cat_separator = ', ';
	$output = '';
	if ( ! empty( $categories ) ) {

		echo '<span class="cat">' . __("Categories", "lightbold") . ': ';

	    foreach( $categories as $category ) {
	        $output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $cat_separator;
	    }
	    echo trim( $output, $cat_separator );

	    echo '</span>';

	}


	$posttags = get_the_tags();
	if ($posttags) {

		echo '<span class="tag">' . __("Tags", "lightbold") . ': ';
		$cpt = 1;
		foreach($posttags as $tag) {
			if( $cpt != 1){
				echo ', ';
			}
			echo '<a class="white-color upper" href="' . get_tag_link($tag->term_id) . '">';
			echo $tag->name;
			echo '</a> ';
			$cpt++;
		}

		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'perf_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function perf_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'lightbold' ) );
		if ( $categories_list && perf_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'lightbold' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'lightbold' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'lightbold' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'lightbold' ), esc_html__( '1 Comment', 'lightbold' ), esc_html__( '% Comments', 'lightbold' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'lightbold' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function perf_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'perf_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'perf_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so perf_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so perf_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in perf_categorized_blog.
 */
function perf_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'perf_categories' );
}
add_action( 'edit_category', 'perf_category_transient_flusher' );
add_action( 'save_post',     'perf_category_transient_flusher' );
