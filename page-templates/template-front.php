<?php
/**
 * Template Name: Front Page
 *
 * @package perfthemes
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'components/content-hero/front-hero' ); ?>

			<?php get_template_part( 'components/front-sections/section1' ); ?>

			<?php get_template_part( 'components/front-sections/section2' ); ?>

			<?php get_template_part( 'components/front-sections/section3' ); ?>

			<?php get_template_part( 'components/front-sections/section4' ); ?>
		</main>
	</div>

<?php get_footer(); ?>
