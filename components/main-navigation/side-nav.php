<header class="main-header site-sidebar bg-white overflow-hidden block fixed left-0 top-0 col-12 m0">

    <div class="main-header_container hide-print">

        <?php get_template_part( 'components/menu-toggle/menu-toggle' ); ?>

        <?php get_template_part( 'components/site-logo/site-logo' ); ?>

    </div>

</header>

<nav id="ml-menu" class="menu nav-container site-sidebar hide-print bg-white <?php if ( has_nav_menu( 'primary' ) && light_bold_main_menu_has_child() ){ echo 'multi_level'; } ?>">

	<a class="accessibility skip-link" href="#content"><?php esc_html_e("Skip to main content","light-bold"); ?></a>
    
    <?php get_template_part( 'components/menu-toggle/menu-close' ); ?>

    <a id="all" class="hide"><svg class="fa fa-list-ul small-p"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fa-list-ul"></use></svg></a>

	<div class="menu__wrap absolute bottom-0 col-12 <?php if ( has_nav_menu( 'primary' ) && light_bold_main_menu_has_child() ){ echo 'multi_level'; } ?>">
		<?php
			if ( has_nav_menu( 'primary' ) ) {
				light_bold_custom_menu('primary');
			}
		?>
	</div>
</nav>