!function ($) {
    'use strict';
    $(window).on('elementor:init', function () {
        var widget = elementor.modules.controls.BaseData.extend({
            isTitlesReceived: false,
            // spinner for ajax search search input
            addControlSpinner: function () {
                this.ui.select.prop('disabled', true);
                this.$el.find('.elementor-control-title').after('<span class="elementor-control-spinner">&nbsp;<i class="eicon-spinner eicon-animation-spin"></i>&nbsp;</span>');
            },

            prepareArgs    : function () {
                var self      = this,
                    queryArgs = self.model.get('query_args');

                if (!_.isObject(queryArgs)) {
                    queryArgs = {};
                }

                if (queryArgs.widget_props && _.isObject(queryArgs.widget_props)) {
                    _.each(queryArgs.widget_props, function (item, index) {
                        queryArgs[index] = self.container.settings.get(item);
                    });
                }
                return queryArgs;
            },
            getQueryData   : function () {
                var args = $.extend({}, this.prepareArgs());
                delete args.widget_props;
                return args;
            },
            // get the title string after search
            getValueTitles : function () {
                var self = this,
                    ids  = this.getControlValue();

                if (!ids) {
                    return;
                }

                if (!_.isArray(ids)) {
                    ids = [ids];
                }

                var params = {
                    action  : ps_dynamic_select.action,
                    security: ps_dynamic_select.nonce,
                    ids     : ids
                };

                var data = $.extend({}, params, self.getQueryData());

                $.ajax({
                    url    : ajaxurl,
                    type   : 'POST',
                    data   : data,
                    before : self.addControlSpinner(),
                    success: function success(ajaxData) {
                        self.isTitlesReceived = true;
                        if (!ajaxData.success) {
                            console.log('server errors:', ajaxData.data);
                        } else {
                            var values = {};
                            _.each(ajaxData.data, function (item) {
                                values[item.id] = item.text;
                            });

                            self.model.set('options', values);
                            self.ui.select && self.ui.select.data('select2') && self.render();
                        }
                    }
                });
            },

            onReady        : function () {
                var self = this;
                this.ui.select.select2({
                    minimumInputLength: self.model.get('minlen') ? self.model.get('minlen') : 2,
                    placeholder       : self.model.get('placeholder') ? self.model.get('placeholder') : 'Type & Search',
                    allowClear        : true,
                    ajax              : {
                        url           : ajaxurl,
                        dataType      : 'json',
                        method        : 'post',
                        delay         : 300,
                        data          : function (data) {
                            var params = {
                                action     : ps_dynamic_select.action,
                                security   : ps_dynamic_select.nonce,
                                search_text: data.term
                            };
                            return $.extend({}, params, self.getQueryData());
                        },
                        processResults: function (response) {
                            if (response.success && response.data) {
                                return {
                                    results: response.data
                                };
                            } else {
                                //console.log('server error!', response.data);
                                return {
                                    results: [{
                                        id      : -1,
                                        text    : 'No Data found',
                                        disabled: true
                                    }]
                                };
                            }
                        },
                        cache         : true
                    }
                });

                if (!this.isTitlesReceived) {
                    this.getValueTitles();
                }
            },
            onBeforeDestroy: function () {
                this.ui.select.data('select2') && this.ui.select.select2('destroy');
                this.$el.remove();
            }
        });
        elementor.addControlView('ps-dynamic-select', widget);
    });
}(jQuery);