(function ($, elementor) {

    'use strict';

    var widgetMultiscroll = function ($scope, $) {

        var $multiscroll = $scope.find('.bdt-mltiscroll-slider'),
            editMode = Boolean(elementorFrontend.isEditMode());

        if (!$multiscroll.length) {
            return;
        }
        var $settings = $multiscroll.data('settings');

        if ($settings.autoplay === true && !editMode) {
            $settings.loopBottom = true;
        }

        $($multiscroll).multiscroll({
            verticalCentered: true,
            scrollingSpeed: $settings.scrollingSpeed,
            easing: 'easeInQuart',
            menu: false,
            navigation: $settings.navigation,
            navigationPosition: $settings.navigationPosition,
            loopBottom: $settings.loopBottom,
            loopTop: $settings.loopTop,
            css3: $settings.css3,
            paddingTop: 0,
            paddingBottom: 0,
            normalScrollElements: null,
            scrollOverflowOptions: null,
            keyboardScrolling: true,
            touchSensitivity: 5
        });

        var autoPlaySpeed = ($settings.autoplay === true) ? ($settings.autoplay_speed || 5000) : 5000;

        function scrollMe() {
            $.fn.multiscroll.moveSectionDown();
        }
        if ($settings.autoplay === true && !editMode) {
            setInterval(scrollMe, autoPlaySpeed);
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-multiscroll.default', widgetMultiscroll);
    });

}(jQuery, window.elementorFrontend));