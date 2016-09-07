<?php
/*
* Create option pages
*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme general options',
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'perfthemes-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
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

/*
* Add custom image for ACF layout
*/
add_filter('acf/load_field/name=perf_section3_layout', 'perf_layout_options');
function perf_layout_options( $field ) {
    $field['choices'] = array(
	    "1" => '<img src="' . trailingslashit( get_template_directory_uri() ) . 'images/one-column.png">',
	    "2" => '<img src="' . trailingslashit( get_template_directory_uri() ) . 'images/two-columns.png">',
	    "3" => '<img src="' . trailingslashit( get_template_directory_uri() ) . 'images/three-columns.png">',
	    "4" => '<img src="' . trailingslashit( get_template_directory_uri() ) . 'images/four-columns.png">',
	);

    return $field;
}

/*
* Add custom css for ACF
*/
add_action('admin_head', 'perf_my_custom_acf_style');
function perf_my_custom_acf_style() {
  echo '<style>
    .acf-image-select label input {
	    display: none;
	}
	.acf-image-select label p {
	    margin: 0;
	    font-weight: bold;
	    text-align: center;
	}
	.acf-image-select label img {
	    -webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
		outline: none;
		border: 6px solid #fefefe;
	}
	.acf-image-select label.selected img {
		border: 6px solid #DDDDDD;
	}
  </style>';
}