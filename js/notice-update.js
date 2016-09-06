// autoptimize
jQuery(document).on( 'click', '.perf-autoptimize-notice .notice-dismiss', function() {
    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'perf_autoptimize_dismiss_notice'
        }
    })
});

// wp-rocket
jQuery(document).on( 'click', '.perf-rocket-notice .notice-dismiss', function() {
    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'perf_rocket_dismiss_notice'
        }
    })
});