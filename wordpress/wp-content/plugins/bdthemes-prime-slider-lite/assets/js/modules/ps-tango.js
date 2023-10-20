(function ($, elementor) {

    'use strict';

    var widgetTango = function ($scope, $) {

        var $tango = $scope.find('.bdt-prime-slider-tango');
        if (!$tango.length) {
            return;
        }

        var $tangoContainer = $tango.find('.swiper-tango'),
            $settings = $tango.data('settings');


        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($tangoContainer, $settings);

            if ($settings.pauseOnHover) {
                $($tangoContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-tango.default', widgetTango);
    });

}(jQuery, window.elementorFrontend));