jQuery(document).ready(function ($) {

    // total activate
    function total_widget_status() {
        var total_widget_active_status = [];

        var totalActivatedWidgets = [];
        jQuery('#prime_slider_active_modules_page input:checked').each(function () {
            totalActivatedWidgets.push(jQuery(this).attr('name'));
        });

        total_widget_active_status.push(totalActivatedWidgets.length);

        var totalActivated3rdparty = [];
        jQuery('#prime_slider_third_party_widget_page input:checked').each(function () {
            totalActivated3rdparty.push(jQuery(this).attr('name'));
        });

        total_widget_active_status.push(totalActivated3rdparty.length);

        var totalActivatedExtensions = [];
        jQuery('#prime_slider_elementor_extend_page input:checked').each(function () {
            totalActivatedExtensions.push(jQuery(this).attr('name'));
        });

        total_widget_active_status.push(totalActivatedExtensions.length);


        jQuery('#bdt-total-widgets-status').attr('data-value', total_widget_active_status);
        jQuery('#bdt-total-widgets-status-core').text(total_widget_active_status[0]);
        jQuery('#bdt-total-widgets-status-3rd').text(total_widget_active_status[1]);

        jQuery('#bdt-total-widgets-status-heading').text(total_widget_active_status[0] + total_widget_active_status[1] + total_widget_active_status[2]);

    }

    total_widget_status();

    jQuery('.prime-slider-settings-save-btn').on('click', function () {
        setTimeout(function () {
            total_widget_status();
        }, 2000);
    });

    // end total active



    // modules
    var moduleUsedWidget = jQuery('#prime_slider_active_modules_page').find('.ps-used-widget');
    var moduleUsedWidgetCount = jQuery('#prime_slider_active_modules_page').find('.ps-options .ps-used').length;
    moduleUsedWidget.text(moduleUsedWidgetCount);
    var moduleUnusedWidget = jQuery('#prime_slider_active_modules_page').find('.ps-unused-widget');
    var moduleUnusedWidgetCount = jQuery('#prime_slider_active_modules_page').find('.ps-options .ps-unused').length;
    moduleUnusedWidget.text(moduleUnusedWidgetCount);

    // 3rd party
    var thirdPartyUsedWidget = jQuery('#prime_slider_third_party_widget_page').find('.ps-used-widget');
    var thirdPartyUsedWidgetCount = jQuery('#prime_slider_third_party_widget_page').find('.ps-options .ps-used').length;
    thirdPartyUsedWidget.text(thirdPartyUsedWidgetCount);
    var thirdPartyUnusedWidget = jQuery('#prime_slider_third_party_widget_page').find('.ps-unused-widget');
    var thirdPartyUnusedWidgetCount = jQuery('#prime_slider_third_party_widget_page').find('.ps-options .ps-unused').length;
    thirdPartyUnusedWidget.text(thirdPartyUnusedWidgetCount);


    // total widgets

    var dashboardChatItems = ['#bdt-db-total-status', '#bdt-db-only-widget-status', '#bdt-db-only-3rdparty-status', '#bdt-total-widgets-status'];

    dashboardChatItems.forEach(function ($el) {

        const ctx = jQuery($el);

        var $value = ctx.data('value');
        $value = $value.split(',');

        var $labels = ctx.data('labels');
        $labels = $labels.split(',');

        var $bg = ctx.data('bg');
        $bg = $bg.split(',');

        // var $bgHover = ctx.data('bg-hover');
        // $bgHover = $bgHover.split(',');


        const data = {
            labels: $labels,
            datasets: [{
                data: $value,
                backgroundColor: $bg,
                // hoverBackgroundColor: false, //$bgHover,
                borderWidth: 0,
            }],

        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                animation: {
                    duration: 3000,
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                title: {
                    display: false,
                    text: ctx.data('label'),
                    fontSize: 16,
                    fontColor: '#333',
                },
                hover: {
                    mode: null
                },

            }
        };

        if (window.myChart instanceof Chart) {
            window.myChart.destroy();
        }

        var myChart = new Chart(ctx, config);
        // if (x != 'init'){
        //     // myChart.destroy();

        //     // var myChart = new Chart(ctx, config);
        //      myChart.update();
        // }


    });

});