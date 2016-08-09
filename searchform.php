<form role="search" method="get" class="search-form relative" action="<?php echo home_url( '/' ); ?>">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'lightbold', 'default' ) ?></span>
        <input type="search" class="search-field col-12 border"
            placeholder="<?php echo esc_attr_x( 'Search', 'lightbold', 'default' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'lightbold', 'default' ) ?>" required>
            <i class="fa fa-search absolute search-icon"></i>
</form>