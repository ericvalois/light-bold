<header class="top-main-header bg-white px2 py2 lg-py0 flex flex-center flex-wrap flex-stretch col-12 m0 hide-print justify-between">

    <?php get_template_part( 'components/menu-toggle/menu-toggle' ); ?>

    <?php get_template_part( 'components/menu-toggle/menu-close' ); ?>

    <?php get_template_part( 'components/site-logo/site-logo' ); ?>

    <?php
        if( has_nav_menu('primary') ){
            wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_id' => 'top-main-menu', 'menu_class' => 'col-12 list-reset m0') );
        }
    ?>

</header>