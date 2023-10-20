(function ($, elementor) {

    'use strict';

    var widgetPacific = function ($scope, $) {

        var $pacific = $scope.find('.bdt-pacific-slider'),
            $settings = $pacific.data('settings'),
            $sliderSettings = $pacific.data('slider-settings'),
            $pacificContainer = $pacific.find(".swiper-pacific");

        if (!$pacific.length) {
            return;
        }


        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($pacificContainer, $settings);
            if ($sliderSettings.showPagination !== false) {
                $pacific.find(".swiper-pagination-bullets").children().each(function (i) {
                    $(this).text(i += 1);
                });
            }
        };

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-pacific.default', widgetPacific);
    });

}(jQuery, window.elementorFrontend));