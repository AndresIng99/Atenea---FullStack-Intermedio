(function ($, elementor) {

    'use strict';

    var widgetRubix = function ($scope, $) {

        var $rubix = $scope.find('.bdt-rubix-slider');
        if (!$rubix.length) {
            return;
        }
        var $rubixContainer = $rubix.find('.bdt-main-slider'),
            $settings = $rubix.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($rubixContainer, $settings);
            if ($settings.pauseOnHover) {
                $($rubixContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }



            var $mainWrapper = $scope.find('.bdt-rubix-slider'),
                $thumbs = $mainWrapper.find('.bdt-thumb-slider');

            var sliderThumbs = await new Swiper($thumbs, {
                slidesPerView: 2,
                spaceBetween: 10,
                loop: ($settings.loop) ? $settings.loop : false,
                speed: ($settings.speed) ? $settings.speed : 500,
                touchRatio: 0.2,
                slideToClickedSlide: true,
                loopedSlides: 4,
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                }
            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;



            var sliderAnimation = {
                initAnim: function () {
                    $($rubixContainer).find(".bdt-item.swiper-slide-active .bdt-slider-progress").animate({
                        width: '100%'
                    }, sliderAutoplayDelay);
                },
                destroyAnim: function () {
                    swiper.on('slideChange', function (e) {
                        $($rubixContainer).find(".bdt-item .bdt-slider-progress").animate({
                            width: '0%'
                        }, 2);
                    });
                },
                onChangeAnim: function () {
                    swiper.on('slideChangeTransitionEnd', function (e) {
                        $($rubixContainer).find(".bdt-item.swiper-slide-active .bdt-slider-progress").animate({
                            width: '100%'
                        }, sliderAutoplayDelay);
                    });
                }
            };


            if ($settings.hasOwnProperty('autoplay') === false) {
                var sliderAutoplayDelay = $settings.speed;
            } else {
                var sliderAutoplayDelay = $settings.autoplay.delay;
            }

            if (sliderAutoplayDelay == undefined) {
                return;
            }

            sliderAnimation.initAnim();
            sliderAnimation.destroyAnim();
            sliderAnimation.onChangeAnim();
        }


    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-rubix.default', widgetRubix);
    });

}(jQuery, window.elementorFrontend));