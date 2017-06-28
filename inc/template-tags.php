<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ttfb
 */

if ( ! function_exists( 'light_bold_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function light_bold_posted_on() {
	$light_bold_time_string = '<span class="posted-on"><time class="entry-date published updated" datetime="%1$s">' . esc_html__("Posted on","light-bold") . ': ' .'%2$s</time></span> ';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$light_bold_time_string = '<span class="posted-on"><time class="entry-date published" datetime="%1$s">' . esc_html__("Posted on","light-bold") . ': ' .' %2$s</time></span><span class="posted-on">' . esc_html__("Last Update","light-bold") . ': ' . '<time class="updated" datetime="%3$s">%4$s</time></span> ';
	}

	$light_bold_time_string = sprintf( $light_bold_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$light_bold_posted_on = $light_bold_time_string;

	$light_bold_byline = '<span class="author vcard">' . esc_html__("By","light-bold") . ': ' . '<a class="url fn n white-color" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';


	echo $light_bold_posted_on;

	echo $light_bold_byline;

	$light_bold_categories = get_the_category();
	$cat_separator = ', ';
	$light_bold_output = '';
	if ( ! empty( $light_bold_categories ) ) {

		echo '<span class="cat">' . esc_html__("Categories", "light-bold") . ': ';

	    foreach( $light_bold_categories as $category ) {
	        $light_bold_output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $cat_separator;
	    }
	    echo trim( $light_bold_output, $cat_separator );

	    echo '</span>';

	}


	$light_bold_posttags = get_the_tags();
	if ($light_bold_posttags) {

		echo '<span class="tag">' . esc_html__("Tags", "light-bold") . ': ';
		$cpt = 1;
		foreach($light_bold_posttags as $tag) {
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

if ( ! function_exists( 'light_bold_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function light_bold_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$light_bold_categories_list = get_the_category_list( esc_html__( ', ', 'light-bold' ) );
		if ( $light_bold_categories_list && light_bold_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'light-bold' ) . '</span>', $light_bold_categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'light-bold' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'light-bold' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'light-bold' ), esc_html__( '1 Comment', 'light-bold' ), esc_html__( '% Comments', 'light-bold' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'light-bold' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function light_bold_categorized_blog() {
	if ( false === ( $light_bold_all_the_cool_cats = get_transient( 'light_bold_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$light_bold_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$light_bold_all_the_cool_cats = count( $light_bold_all_the_cool_cats );

		set_transient( 'light_bold_categories', $light_bold_all_the_cool_cats );
	}

	if ( $light_bold_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so light_bold_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so light_bold_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in light_bold_categorized_blog.
 */
function light_bold_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'light_bold_categories' );
}
add_action( 'edit_category', 'light_bold_category_transient_flusher' );
add_action( 'save_post',     'light_bold_category_transient_flusher' );
