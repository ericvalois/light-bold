<nav id="ml-menu" class="menu nav-container site-sidebar hide-print">
	<a class="accessibility skip-link" href="#content"><?php _e("Skip to main content","lightbold"); ?></a>
	<button class="action action--close flex flex-center" aria-label="Close Menu">
		<span class="main-nav__toggle__icon block ">
			<span class="main-nav__toggle__line main-nav__toggle__line--1"></span>
			<span class="main-nav__toggle__line main-nav__toggle__line--2"></span>
			<span class="main-nav__toggle__line main-nav__toggle__line--3"></span>
		</span>
	</button>
	<a id="all" class="hide"><?php _e("All","lightbold"); ?></a>
	<div class="menu__wrap">
		<?php
			if ( has_nav_menu( 'primary' ) ) {
				perf_custom_menu('primary');
			}
		?>
	</div>
</nav>