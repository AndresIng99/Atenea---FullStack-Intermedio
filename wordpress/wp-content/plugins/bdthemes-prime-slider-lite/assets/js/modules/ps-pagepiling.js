(function ($, elementor) {

    'use strict';

    var widgetPagepiling = function ($scope, $) {

        var $pagepiling = $scope.find('.bdt-pagepiling-slider');

        if (!$pagepiling.length) {
            return;
        }
        var $settings = $pagepiling.data('settings');

        var interval;
        var timeout;
        var autoPlayDuration = (typeof $settings.autoplay !== 'undefined') ? ($settings.autoplay.autoplay_duration || 1000) : 1000;

        if ((typeof $settings.autoplay == 'undefined')) {
            $settings.autoplay = false;
        }

        function getInterval() {
            return setInterval(function () {
                $.fn.pagepiling.moveSectionDown();
            }, autoPlayDuration);
        }

        $($pagepiling).pagepiling({
            menu: null,
            direction: 'vertical',
            verticalCentered: true,
            scrollingSpeed: $settings.scrollingSpeed,
            easing: 'swing',
            navigation: {
                'position': 'left',
            },
            loopBottom: $settings.loopBottom,
            loopTop: $settings.loopTop,
            css3: true,
            normalScrollElements: null,
            normalScrollElementTouchThreshold: 5,
            touchSensitivity: 5,
            keyboardScrolling: true,
            sectionSelector: '.section',

            afterLoad: $settings.autoplay !== false ? function (anchorLink, index) {
                clearInterval(interval);
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    interval = getInterval();
                }, autoPlayDuration);
            } : false,
            afterRender: $settings.autoplay !== false ? function () {
                interval = getInterval();
            } : false
        });


    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-pagepiling.default', widgetPagepiling);
    });

}(jQuery, window.elementorFrontend));