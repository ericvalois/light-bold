<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package perfthemes
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>

	</head>

<body <?php body_class(); ?>>

	<?php do_action('light_bold_body_open'); ?>
	
	<header class="main-header site-sidebar bg-white overflow-hidden block fixed left-0 top-0 col-12 m0">

		<div class="main-header_container hide-print">

			<?php get_template_part( 'components/menu-toggle/menu-toggle' ); ?>

			<?php get_template_part( 'components/site-logo/site-logo' ); ?>

		</div>

	</header>

	<?php get_template_part( 'components/main-navigation/main-navigation' ); ?>

		<div id="content" class="site-content clearfix">
