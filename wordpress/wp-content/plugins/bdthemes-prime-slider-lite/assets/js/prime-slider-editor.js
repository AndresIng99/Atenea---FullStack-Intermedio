( function( $ ) {

	'use strict';

	var ElementPackEditor = {

		init: function() {
			elementor.channels.editor.on( 'section:activated', ElementPackEditor.onAnimatedBoxSectionActivated );

			window.elementor.on( 'preview:loaded', function() {
				elementor.$preview[0].contentWindow.ElementPackEditor = ElementPackEditor;

				ElementPackEditor.onPreviewLoaded();
			});
		},

		onPreviewLoaded: function() {
			var elementorFrontend = $('#elementor-preview-iframe')[0].contentWindow.elementorFrontend;

			elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ){

				$scope.find( '.bdt-elementor-template-edit-link' ).on( 'click', function( event ){
					window.open( $( this ).attr( 'href' ) );
				});
			});
		}
	};

	$( window ).on( 'elementor:init', ElementPackEditor.init );

	window.ElementPackEditor = ElementPackEditor;

}( jQuery ) );
