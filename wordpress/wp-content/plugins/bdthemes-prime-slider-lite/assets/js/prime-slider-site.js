(function($, elementor) {

    'use strict';

    var primeSliderScrollButton = function($scope, $) {

        var $primeSlider = $scope.find('.bdt-prime-slider'),
            $scrollButton = $primeSlider.find('.bdt-scroll-down'),
            $selector = $scrollButton.data('selector'),
            $settings = $scrollButton.data('settings');

        //console.log($scrollButton);

        if (!$scrollButton.length) {
            return;
        }

        $($scrollButton).on('click', function(event) {
            event.preventDefault();
            bdtUIkit.scroll($scrollButton, $settings).scrollTo($($selector));
        });

    };
    var RevealEffects = function ($scope, $) {
        var widgetID = $scope.data("id"),
        $revealEnable = $scope.find(`[data-reveal-enable]`).data('reveal-enable');
         if (($revealEnable === undefined) || ($revealEnable !== 'yes')) {
           return;
        }


        const revealID = $('.reveal-active-' + widgetID).find(`[data-reveal="reveal-active"]`);
        $(revealID).css({'opacity': '1' });
        const revealOptions = $scope.find(`[data-reveal-settings]`).data(`reveal-settings`);
        let counter = 0;
        $(revealID).each(function (index, revealWrapper) {
            counter += 80;
            const revealFX = new RevealFx(revealWrapper, {
                revealSettings: {
                    bgColors: [revealOptions.bgColors],
                    direction: String(revealOptions.direction),
                    duration: Number(revealOptions.duration + counter),
                    easing: String(revealOptions.easing),
                    onHalfway: function (contentEl, ngsrevealerEl) {
                        contentEl.style.opacity = 1;
                    },
                },
            });
            var runReveal = function () {
                revealFX.reveal();
                this.destroy();
            };
            new Waypoint({
                element: revealWrapper,
                handler: runReveal,
                offset: "bottom-in-view",
            });
        });

        setTimeout(() => {
            const revealWrap = $('.reveal-active-' + widgetID);
            var mutedClass = $(revealWrap).find('.reveal-muted');
            $(mutedClass).each(function (index, muted) {
                $(muted).addClass('reveal-loaded');
                $(muted).removeClass('reveal-muted');
            });
        }, (revealOptions.duration + counter) * 1.3);
    }

    jQuery(window).on('elementor/frontend/init', function() {
        // initialize reveal effects
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.slide', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.crelly', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.meteor', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.coral', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.folio', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.zinest', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-isolate.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-isolate.locate', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-isolate.slice', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-dragon.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-flogia.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-mount.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-elysium.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-fiestar.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-sequester.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-mercury.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-pacific.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-paranoia.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-rubix.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-storker.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-tango.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-vertex.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-woocommerce.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-woolamp.default', RevealEffects);

        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-astoria.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-avatar.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-flexure.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-fluent.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-fortune.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-knily.default', RevealEffects);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-monster.default', RevealEffects);
        

        //scroll button
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.default', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-general.meteor', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.default', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-blog.coral', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-isolate.default', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-isolate.locate', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-woocommerce.default', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-fluent.default', primeSliderScrollButton);
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-astoria.default', primeSliderScrollButton);
    });

}(jQuery, window.elementorFrontend));
