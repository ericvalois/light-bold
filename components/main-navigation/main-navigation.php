<nav id="nav-container" class="nav-container site-sidebar bg-white">
	<a class="accessibility skip-link" href="#content"><?php _e("Skip to main content","perf"); ?></a>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => '', 'menu_class' => 'list-reset', 'items_wrap' => perf_add_search_menu(), 'walker' => new perf_Walker_Nav_Menu() ) ); ?>
</nav>