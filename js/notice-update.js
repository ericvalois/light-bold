// autoptimize
jQuery(document).on( 'click', '.perf-autoptimize-notice .notice-dismiss', function() {
    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'light_bold_autoptimize_dismiss_notice'
        }
    })
});

// wp-rocket
jQuery(document).on( 'click', '.perf-rocket-notice .notice-dismiss', function() {
    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'light_bold_rocket_dismiss_notice'
        }
    })
});