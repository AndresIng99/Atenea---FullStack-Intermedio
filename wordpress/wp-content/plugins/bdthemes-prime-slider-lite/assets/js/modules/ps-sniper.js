(function ($, elementor) {

    'use strict';

    var widgetSniper = function ($scope, $) {

        var $sniper = $scope.find('.bdt-sniper-slider');
        if (!$sniper.length) {
            return;
        }
        var $sniperContainer = $sniper.find('.bdt-main-slider'),
            $settings = $sniper.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($sniperContainer, $settings);
            if ($settings.pauseOnHover) {
                $($sniperContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

            var $thumbs = $scope.find('.bdt-thumbs-slider');

            var sliderThumbs = await new Swiper($thumbs, {
                loop: ($settings.loop) ? $settings.loop : false,
                speed: ($settings.speed) ? $settings.speed : 500,
                freemood: true,
                parallax: true,
                spaceBetween: 10,
                slideToClickedSlide: true,
                loopedSlides: 4,
                centeredSlides: true,
                slidesPerView: 2,
                initialSlide: 0,
                keyboardControl: true,
                mousewheel: ($settings.mousewheel) ? $settings.mousewheel : false,
                lazyLoading: true,
                preventClicks: false,
                preventClicksPropagation: false,
                lazyLoadingInPrevNext: true,

                pagination: {
                    el: ".bdt-pagination",
                    type: "fraction",
                    formatFractionCurrent: function (number) {
                        return '0' + number;
                        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    },
                    formatFractionTotal: function (number) {
                        return '0' + number;
                    }
                },

                breakpoints: {
                    768: {
                        slidesPerView: 2.5,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                    1440: {
                        slidesPerView: 3.5,
                    },
                }
            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-sniper.default', widgetSniper);
    });

}(jQuery, window.elementorFrontend));