
(function ($, elementor) {

    'use strict';

    var widgetOmatic = function ($scope, $) {

        var $omatic = $scope.find('.bdt-omatic-slider');
        if (!$omatic.length) {
            return;
        }
        var $omaticContainer = $omatic.find('.bdt-omatic-slider'),
            $settings = $omatic.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($omaticContainer, $settings);
            if ($settings.pauseOnHover) {
                $($omaticContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

            var $thumbs = $scope.find('.bdt-omatic-thumbs-slide');

            var sliderThumbs = await new Swiper($thumbs, {
                loop: ($settings.loop) ? $settings.loop : true,
                speed: ($settings.speed) ? $settings.speed : 500,
                effect: "fade",
                fadeEffect: {
                    crossFade: true
                  },
                grabCursor: true,
                touchRatio: 0.2,
                slideToClickedSlide: true,
                loopedSlides: 4,


            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;
            // sliderThumbs.controller.control = swiper;
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-omatic.default', widgetOmatic);
    });

}(jQuery, window.elementorFrontend));