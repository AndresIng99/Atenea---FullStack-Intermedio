(function ($, elementor) {

    'use strict';

    var widgetElysium = function ($scope, $) {

        var $elysium = $scope.find('.bdt-prime-slider-elysium');
            // $settings = $elysium.data('settings');

        if (!$elysium.length) {
            return;
        }

        var $elysiumContainer = $elysium.find('.bdt-slider-continer'),
            $settings = $elysium.data('settings');
        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($elysiumContainer, $settings);

            if ($settings.pauseOnHover) {
                $($elysiumContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }
        }

        // start animation 
        // var $slideItem = $($settings.id + ' .swiper-wrapper > .bdt-item');
        // $($elysium).find('.bdt-item').each(function (i, e) {

        //     var self = $(this),
        //         $quote = self.find($settings.animation_of),
        //         mySplitText = new SplitText($quote, {
        //             type: 'chars, words, lines'
        //         }),
        //         splitTextTimeline = gsap.timeline();

        //     gsap.set($quote, {
        //         perspective: 400
        //     });

        //     function kill() {
        //         splitTextTimeline.clear().time(0);
        //         mySplitText.revert();
        //     }

        //     function gsapAnimation() {
        //         kill();
        //         mySplitText.split({
        //             type: 'chars, words, lines'
        //         });

        //         var stringType = '';

        //         if ('lines' == $settings.animation_on) {
        //             stringType = mySplitText.lines;
        //         } else if ('chars' == $settings.animation_on) {
        //             stringType = mySplitText.chars;
        //         } else {
        //             stringType = mySplitText.words;
        //         }

        //         splitTextTimeline.staggerFrom(stringType, 0.5, {
        //             opacity: 0,
        //             scale: $settings.anim_scale, //0
        //             y: $settings.anim_rotation_y, //80
        //             rotationX: $settings.anim_rotation_x, //180
        //             transformOrigin: $settings.anim_transform_origin, //0% 50% -50  
        //         }, 0.1).then(function () {
        //             // $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-invisible');
        //         });

        //         splitTextTimeline.play();
        //     }

        //     if ($settings.animation_status == 'yes') {
        //         $slideItem.on('itemshow', function () {
        //             gsapAnimation();
        //         });
        //         gsapAnimation();
        //     }


        // });
        // end animation 

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-elysium.default', widgetElysium);
    });

}(jQuery, window.elementorFrontend));