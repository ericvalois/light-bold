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
		<?php do_action('perf_head_open'); ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>

	</head>

<body <?php body_class(); ?>>

	<?php do_action('perf_body_open'); ?>

	<header class="main-header site-sidebar bg-white">

		<div class="main-header_container lg-px2">

			<?php get_template_part( 'components/menu-toggle/menu-toggle' ); ?>

			<?php get_template_part( 'components/site-logo/site-logo' ); ?>
			
		</div>

	</header>

	<?php get_template_part( 'components/main-navigation/main-navigation' ); ?>
	

		<div id="content" class="site-content clearfix">
