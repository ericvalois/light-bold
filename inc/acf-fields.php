<?php
	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title' 	=> 'Theme general options',
			'menu_title'	=> 'Theme options',
			'menu_slug' 	=> 'perfthemes-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Styles',
			'menu_title'	=> 'Styles',
			'parent_slug'	=> 'perfthemes-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Performance',
			'menu_title'	=> 'Performance',
			'parent_slug'	=> 'perfthemes-settings',
		));
		
	}

	