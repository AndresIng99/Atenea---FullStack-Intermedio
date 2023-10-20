jQuery(document).ready(function ($) {

    jQuery('.prime-slider-notice.is-dismissible .notice-dismiss').on('click', function () {
        $this = jQuery(this).parents('.prime-slider-notice');
        var $id = $this.attr('id') || '';
        var $time = $this.attr('dismissible-time') || '';
        var $meta = $this.attr('dismissible-meta') || '';

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'prime-slider-notices',
                id: $id,
                meta: $meta,
                time: $time,
            },
        });

    });

});