(function (window, document, $, undefined) {

    'use strict';

    var BdThemesLiveCopy = {
        //Initializing properties and methods
        init: function (e) {
            BdThemesLiveCopy.globalVars();
            BdThemesLiveCopy.loadxdLocalStorage();
            BdThemesLiveCopy.loadContextMenuGroupsHooks();
        },

        setElementId              : function (elements) {
            return elements.forEach(function (item) {
                item.id = elementorCommon.helpers.getUniqueId(), 0 < item.elements.length && BdThemesLiveCopy.setElementId(item.elements)
            }), elements;
        },
        globalVars                : function (e) {
            window.lc_ajax_url   = bdt_live_copy.ajax_url;
            window.lc_ajax_nonce = bdt_live_copy.nonce;
            window.lc_key        = bdt_live_copy.magic_key;
        },
        loadxdLocalStorage        : function () {
            BdThemesLiveCopyLocalStorage.init({
                iframeUrl   : 'https://elementpack.pro/eptools/magic/index.html',
                initCallback: function () {
                    // if need any callback
                }
            });
        },
        loadContextMenuGroupsHooks: function () {
            elementor.hooks.addFilter('elements/container/contextMenuGroups', function (groups, element) {
                return BdThemesLiveCopy.prepareMenuItem(groups, element);
            });

            elementor.hooks.addFilter('elements/section/contextMenuGroups', function (groups, element) {
                return BdThemesLiveCopy.prepareMenuItem(groups, element);
            });

            elementor.hooks.addFilter('elements/widget/contextMenuGroups', function (groups, element) {
                return BdThemesLiveCopy.prepareMenuItem(groups, element);
            });

            elementor.hooks.addFilter('elements/column/contextMenuGroups', function (groups, element) {
                return BdThemesLiveCopy.prepareMenuItem(groups, element);
            });
        },
        prepareMenuItem           : function (groups, element) {
            var index = _.findIndex(groups, function (element) {
                return 'clipboard' === element.name;
            });
            groups.splice(index + 1, 0, {
                name   : 'bdt-live-copy-paste',
                actions: [
                    {
                        name    : 'bdt-live-copy',
                        title   : 'Live Copy',
                        icon    : 'eicon-copy',
                        callback: function () {
                            BdThemesLiveCopy.liveCopy(element);
                        }
                    },
                    {
                        name    : 'bdt-live-paste',
                        title   : 'Live Paste',
                        icon    : 'eicon-clone',
                        callback: function () {
                            BdThemesLiveCopy.livePaste(element);
                        }
                    }
                ]
            });

            return groups;
        },
        liveCopy                  : function (e) {
            var data = {
                elType   : e.model.attributes.elType,
                eletype  : e.model.get("widgetType"),
                modelJson: e.model.toJSON()
            }

            const params        = {};
            params[data.elType] = data;

            BdThemesLiveCopyLocalStorage.setItem('magic_copy_data', JSON.stringify(params));
        },

        livePaste: function (selectedContainer) {
            BdThemesLiveCopyLocalStorage.getItem("magic_copy_data", function (magicContent) {
                const containerElType = selectedContainer.model.get("elType");
                const magicData       = JSON.parse(magicContent.value);
                const magicDataKey    = Object.keys(magicData)[0];

                var elementData = magicData[magicDataKey];
                var elementType, elementModel, encodedElementModel;

                if ( typeof elementData.modelJson == "undefined" ) {
                    elementType  = elementData.elType;
                    elementModel = elementData;
                } else {
                    elementType  = elementData.modelJson.elType;
                    elementModel = elementData.modelJson;
                }

                encodedElementModel = JSON.stringify(elementModel);

                const hasImageFiles = /\.(jpg|png|jpeg|gif|svg)/gi.test(encodedElementModel);
                const importModel   = {
                    elType  : elementType,
                    settings: elementModel.settings
                };

                var importContainer = null;
                var importOption    = { index: 0 };

                if ( elementType == 'container' || elementType == 'section') {
                    importModel.elements = BdThemesLiveCopy.setElementId(elementModel.elements);
                    importContainer      = elementor.getPreviewContainer();

                } else if ( elementType == 'column' ) {
                    importModel.elements = BdThemesLiveCopy.setElementId(elementModel.elements);

                    if ( 'container' === containerElType || 'section' === containerElType) {
                        importContainer = selectedContainer.getContainer();
                    } else if ( 'column' === containerElType ) {
                        importContainer    = selectedContainer.getContainer().parent;
                        importOption.index = selectedContainer.getOption('_index') + 1;
                    } else if ( 'widget' === containerElType ) {
                        importContainer    = selectedContainer.getContainer().parent.parent;
                        importOption.index = selectedContainer.getContainer().parent.view.getOption('_index') + 1;
                    } else {
                        console.log('not match Live Copy ElType')
                        return;
                    }
                } else if ( elementType == 'widget' ) {
                    importModel.widgetType = elementData.eletype, importContainer = selectedContainer.getContainer();

                    if ( 'container' === containerElType ) {
                        importContainer = selectedContainer.getContainer();
                    }else if( 'section' === containerElType){
                        importContainer = selectedContainer.children.findByIndex(0).getContainer();
                    } else if ( 'column' === containerElType ) {
                        importContainer = selectedContainer.getContainer();
                    } else if ( 'widget' === containerElType ) {
                        importContainer    = selectedContainer.getContainer().parent;
                        importOption.index = selectedContainer.getOption('_index') + 1;
                        // containerElType.index = selectedContainer.getOption("_index") + 1;
                    } else {
                        console.log('not match Live Copy ElType');
                        return;
                    }
                }

                var importedContainer = $e.run("document/elements/create", {
                    model    : importModel,
                    container: importContainer,
                    options  : importOption
                });

                if ( hasImageFiles ) {
                    $.ajax({
                        url       : lc_ajax_url,
                        method    : 'POST',
                        data      : {
                            action  : 'bdt_elementor_import_live_copy_assets_files',
                            data    : encodedElementModel,
                            security: lc_ajax_nonce,
                        },
                        beforeSend: function () {
                            importedContainer.view.$el.append('<div id="bdt-live-copy-importing-images-loader">Importing Images..</div>');
                        }
                    }).done(function (response) {
                        if ( response.success ) {
                            const data           = response.data[0];
                            importModel.elType   = data.elType;
                            importModel.settings = data.settings;

                            if ( 'widget' === data.elType) {
                                importModel.widgetType = data.widgetType;
                            } else {
                                importModel.elements = data.elements;
                            }

                            setTimeout(function () {
                                $e.run('document/elements/delete', { container: importedContainer });
                                $e.run('document/elements/create', {
                                    model    : importModel,
                                    container: importContainer,
                                    options  : importOption
                                });
                            }, 800);

                            $('#bdt-live-copy-importing-images-loader').remove();
                        }
                    });
                }
            });
        }
    };

    BdThemesLiveCopy.init();

})(window, document, jQuery, BdThemesLiveCopyLocalStorage);