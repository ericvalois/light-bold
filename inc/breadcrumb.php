<?php
function light_bold_breadcrumbs() {
    global $post;
	$light_bold_separator = '<span class="white-color upper"> | </span>'; // Simply change the separator to what ever you need e.g. / or >
	
    echo '<nav class="perf_breadcrumbs hide-print normal-weight flex-center">';
	if (!is_front_page()) {
		echo '<a class="white-color home_icon" href="';
		echo esc_url( home_url( '/' ) );
		echo '">';
		echo '<svg class="fa fa-home white-color"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-home"></use></svg>';
		echo "</a> ".$light_bold_separator;
		if ( is_single() ) {
			if ( get_post_type() == 'post' ) {
				echo '<span class="white-color">';
				
				$light_bold_categories = get_the_category();
				$light_bold_cat_separator = ', ';
				$light_bold_output = '';
				if ( ! empty( $light_bold_categories ) ) {
				    foreach( $light_bold_categories as $category ) {
				        $light_bold_output .= '<a class="white-color upper" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $light_bold_cat_separator;
				    }
				    echo trim( $light_bold_output, $light_bold_cat_separator );
				}

				echo '</span>';

				echo $light_bold_separator;
			}
			if ( is_single() ) {
				echo '<span class="white-color upper">';
				esc_html( the_title() );
				echo '</span>';
			}
		} elseif ( is_page() && $post->post_parent ) {
			$light_bold_home = get_page(get_option('page_on_front'));
			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
				if (($light_bold_home->ID) != ($post->ancestors[$i])) {
					echo '<a class="white-color upper" href="';
					echo esc_url( get_permalink($post->ancestors[$i]) ); 
					echo '">';
					echo esc_html( get_the_title($post->ancestors[$i]) );
					echo "</a>".$light_bold_separator;
				}
			}
			echo '<span class="white-color upper">' . esc_html( get_the_title() ) . '</span>';
		} elseif (is_page()) {
			echo '<span class="white-color upper">' . esc_html( get_the_title() ) . '</span>';
		} elseif ( is_home() ) {
			echo '<span class="white-color upper">' . esc_html( get_the_title( get_option('page_for_posts', true) ) ) . '</span>';
		} elseif ( is_archive() ) {
			echo '<span class="white-color upper">' . wp_kses( get_the_archive_title(), array( 'span' => array() ) ) . '</span>';
		} elseif (is_404()) {
			echo '<span class="white-color upper">' . esc_html__("404 page","light-bold") . '</span>';
		} elseif (is_search()) {
			echo '<span class="white-color upper">';
			printf( esc_html__( 'Search Results for: %s', 'light-bold' ),  get_search_query() );
			echo '</span>';
		}
	}
	echo '</nav>';
}