<nav id="ml-menu" class="menu nav-container site-sidebar hide-print bg-white <?php if ( has_nav_menu( 'primary' ) && perf_main_menu_has_child() ){ echo 'multi_level'; } ?>">

	<a class="accessibility skip-link" href="#content"><?php _e("Skip to main content","lightbold"); ?></a>
	<button class="action-close absolute top-0 right-0 bottom-0 z1 border-none mr2 outline-0 p0 pointer" aria-label="Close Menu">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 35.413 35.413" xml:space="preserve">
			<g>
				<path d="M20.535,17.294L34.002,3.827c0.781-0.781,0.781-2.047,0-2.828c-0.78-0.781-2.048-0.781-2.828,0L17.707,14.466L4.242,0.999
					c-0.78-0.781-2.047-0.781-2.828,0s-0.781,2.047,0,2.828l13.465,13.467L0.586,31.587c-0.781,0.781-0.781,2.047,0,2.828
					c0.39,0.391,0.902,0.586,1.414,0.586s1.024-0.195,1.414-0.586l14.293-14.293L32,34.415c0.391,0.391,0.902,0.586,1.414,0.586
					s1.023-0.195,1.414-0.586c0.781-0.781,0.781-2.047,0-2.828L20.535,17.294z"/>
			</g>
		</svg>
	</button>

	<a id="all" class="hide"><?php _e("All","lightbold"); ?></a>

	<div class="menu__wrap absolute bottom-0 col-12 <?php if ( has_nav_menu( 'primary' ) && perf_main_menu_has_child() ){ echo 'multi_level'; } ?>">
		<?php
			if ( has_nav_menu( 'primary' ) ) {
				perf_custom_menu('primary');
			}
		?>
	</div>
</nav>