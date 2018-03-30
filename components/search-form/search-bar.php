<form role="search" method="get" class="search-bar absolute top-0 left-0 right-0 bg-white py1 px2 " action="<?php echo esc_url( home_url( '/' ) ); ?>" style="top: -100%; opacity: 0;">
	<label class="block">
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'light-bold' ); ?></span>
		<input type="search" onblur="toggleSearchBar()" class="search-field-bar block mx-auto" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'light-bold' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
</form>