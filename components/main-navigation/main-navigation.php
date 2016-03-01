<nav id="nav-container" class="nav-container site-sidebar bg-white">
	<a class="accessibility skip-link" href="#content">Aller au contenu principal</a>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => '', 'menu_class' => 'list-reset', 'items_wrap' => my_nav_wrap() ) ); ?>
</nav>