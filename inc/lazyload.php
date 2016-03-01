<?php
/**
 * Add Lazy Load JavaScript
 *
 * @since 1.0
 */
if ( ! get_field("perf_disable_lazy_load","option") ) {
	
	

	add_filter( 'get_avatar'			, 'add_image_placeholders', PHP_INT_MAX );
	add_filter( 'the_content'			, 'add_image_placeholders', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'add_image_placeholders', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'add_image_placeholders', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'add_image_placeholders', PHP_INT_MAX );

	add_action( 'wp_enqueue_scripts', 'perf_lazysizes_script' );

	add_filter( 'get_avatar'			, 'add_responsive_class', PHP_INT_MAX );
	add_filter( 'the_content'			, 'add_responsive_class', PHP_INT_MAX );
	add_filter( 'widget_text'			, 'add_responsive_class', PHP_INT_MAX );
	add_filter( 'get_image_tag'			, 'add_responsive_class', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html'	, 'add_responsive_class', PHP_INT_MAX );

}

function perf_lazysizes_script() {
	wp_enqueue_script( 'perf-picturefill', get_template_directory_uri() . '/js/picturefill.min.js', '', '', false );
	//wp_enqueue_script( 'perf-lazysizes-respimg', get_template_directory_uri() . '/lazysizes/plugins/respimg/ls.respimg.min.js', '', '', false );
	wp_enqueue_script( 'perf-lazysizes-bgset', get_template_directory_uri() . '/lazysizes/plugins/bgset/ls.bgset.min.js', '', '', false );
	wp_enqueue_script( 'perf-lazysizes', get_template_directory_uri() . '/lazysizes/lazysizes.min.js', '', '', false );
}


function add_image_placeholders( $content ) {

	// Don't lazyload for feeds, previews, mobile
	if( is_feed() || is_preview() )
		return $content;

	// Don't lazy-load if the content has already been run through previously
	if ( false !== strpos( $content, 'data-normal' ) )
		return $content;

	// In case you want to change the placeholder image
	$placeholder_image = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

	// This is a pretty simple regex, but it works
	$content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1} data-src="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );

	// srcset change
	$content = str_replace('srcset', 'data-srcset', $content);

	return $content;
}

function add_responsive_class($content){

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {           
           $existing_class = $img->getAttribute('class');
			$img->setAttribute('class', "lazyload blur-up  $existing_class");
        }

        $html = $document->saveHTML();
        return $html;   
}