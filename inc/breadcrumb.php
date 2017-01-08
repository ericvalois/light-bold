<?php
function perf_breadcrumbs() {
    global $post;
	$perf_separator = '<span class="white-color upper"> | </span>'; // Simply change the separator to what ever you need e.g. / or >
	
    echo '<nav class="perf_breadcrumbs hide-print normal-weight flex-center">';
	if (!is_front_page()) {
		echo '<a class="white-color home_icon" href="';
		echo esc_url( home_url( '/' ) );
		echo '">';
		echo '<svg class="fa fa-home white-color"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-home"></use></svg>';
		echo "</a> ".$perf_separator;
		if ( is_category() || is_single() ) {
			if ( get_post_type() == 'post' ) {
				echo '<span class="white-color">';
				
				$perf_categories = get_the_category();
				$perf_cat_separator = ', ';
				$perf_output = '';
				if ( ! empty( $perf_categories ) ) {
				    foreach( $perf_categories as $category ) {
				        $perf_output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'lightbold' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $perf_cat_separator;
				    }
				    echo trim( $perf_output, $perf_cat_separator );
				}

				echo '</span>';

				echo $perf_separator;
			}
			if ( is_single() ) {
				echo '<span class="white-color upper">';
				the_title();
				echo '</span>';
			}
		} elseif ( is_page() && $post->post_parent ) {
			$perf_home = get_page(get_option('page_on_front'));
			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
				if (($perf_home->ID) != ($post->ancestors[$i])) {
					echo '<a class="white-color upper" href="';
					echo get_permalink($post->ancestors[$i]); 
					echo '">';
					echo get_the_title($post->ancestors[$i]);
					echo "</a>".$perf_separator;
				}
			}
			echo '<span class="white-color upper">' . get_the_title() . '</span>';
		} elseif (is_page()) {
			echo '<span class="white-color upper">' . get_the_title() . '</span>';
		} elseif ( is_home() ) {
			echo '<span class="white-color upper">' . get_the_title( get_option('page_for_posts', true) ) . '</span>';
		} elseif ( is_archive() ) {
			echo '<span class="white-color upper">' . get_the_archive_title() . '</span>';
		} elseif (is_404()) {
			echo '<span class="white-color upper">' . __("404 page","lightbold") . '</span>';
		} elseif (is_search()) {
			echo '<span class="white-color upper">';
			printf( esc_html__( 'Search Results for: %s', 'lightbold' ),  get_search_query() );
			echo '</span>';
		}
	} else {
		echo '<span class="white-color upper">' . get_bloginfo('name') . '</span>';
	}
	echo '</nav>';
}