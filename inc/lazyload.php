<?php
/**
 * Add Lazy Load JavaScript
 *
 * @since 1.0
 */


$disable_lazy_load = get_field("perf_disable_lazy_load","option");
if( !is_array($disable_lazy_load) ) $disable_lazy_load = array();

if ( !in_array("disable_img", $disable_lazy_load, true) && !is_admin() ) {
	
	add_filter( 'get_avatar'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'the_content'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'perf_lazy_load_image', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'perf_lazy_load_image', PHP_INT_MAX );

}

if ( !in_array("disable_iframe", $disable_lazy_load, true) && !is_admin() ) {
	add_filter( 'the_content', 'perf_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'widget_text', 'perf_lazyload_iframes', PHP_INT_MAX );
}

add_action( 'wp_enqueue_scripts', 'perf_lazysizes_script' );
function perf_lazysizes_script() {
	wp_enqueue_script( 'perf-picturefill', get_template_directory_uri() . '/js/picturefill.min.js', '', '', true );
	wp_enqueue_script( 'perf-lazysizes-bgset', get_template_directory_uri() . '/lazysizes/plugins/bgset/ls.bgset.min.js', '', '', true );
	wp_enqueue_script( 'perf-lazysizes', get_template_directory_uri() . '/lazysizes/lazysizes.min.js', '', '', true );
}

function perf_lazy_load_image( $content ){
	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $document = new DOMDocument();

    libxml_use_internal_errors(true);
    if( !empty($content) ){
    	$document->loadHTML(utf8_decode($content));
    }else{
    	return; 
    }
    	

    $imgs = $document->getElementsByTagName('img');
    foreach ($imgs as $img) { 

    	// add data-sizes
    	$img->setAttribute('data-size', "auto");

    	// remove sizes
    	$img->removeAttribute('sizes');

    	// src
    	if($img->hasAttribute('src')){
    		$existing_src = $img->getAttribute('src');
    		$img->setAttribute('src', "data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=");
        }

    	// srcset
    	if($img->hasAttribute('srcset')){
    		$existing_srcset = $img->getAttribute('srcset');
    		$img->removeAttribute('srcset');
    		$img->setAttribute('data-srcset', "$existing_srcset");
        }else{
        	$img->setAttribute('data-src', $existing_src);
        }

    	// Class
       	$existing_class = $img->getAttribute('class');
		$img->setAttribute('class', "lazyload blur-up  $existing_class");


		// noscript
		$noscript = $document->createElement('noscript');
		$img->parentNode->insertBefore($noscript);
		
		$image = $document->createElement('image');
		$imageAttribute = $document->createAttribute('src');
		$imageAttribute->value = $existing_src;
		$image->appendChild($imageAttribute);

		$noscript->appendChild($image);

    }

    $html_fragment = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $document->saveHTML()));
    return $html_fragment;  
}

/**
 * Replace iframes by LazyLoad
 */
function perf_lazyload_iframes( $html ) {

	$matches = array();
	preg_match_all( '/<iframe\s+.*?>/', $html, $matches );

	foreach ( $matches[0] as $k=>$iframe ) {

		// Don't mess with the Gravity Forms ajax iframe
		if ( strpos( $iframe, 'gform_ajax_frame' ) ) {
			continue;
		}
		
		$placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';
		
		$iframe = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src="' . $placeholder . '" class="lazyload blur-up" data-src=', $iframe );

		$html = str_replace( $matches[0][ $k ], $iframe, $html );
		
	}

	return $html;
}