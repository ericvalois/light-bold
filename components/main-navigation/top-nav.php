<header class="top-main-header bg-white overflow-hidden flex flex-center col-12 m0 hide-print p2 justify-between">

    <?php get_template_part( 'components/menu-toggle/menu-toggle' ); ?>

    <?php get_template_part( 'components/menu-toggle/menu-close' ); ?>

    <?php get_template_part( 'components/site-logo/site-logo' ); ?>

    <?php
        if( has_nav_menu('primary') ){
            wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_id' => 'top-main-menu','container_class' => 'lg-show', 'menu_class' => 'inline-flex list-reset m0') );
        }
    ?>

</header>