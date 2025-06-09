/* global $e, elementor */

// noinspection ES6ConvertVarToLetConst
/**
 * WPForms script for editor context.
 *
 * @since 1.9.6
 */
var WPFormsElementorEditorContext = window.WPFormsElementorEditorContext || ( function( document, window, $ ) { // eslint-disable-line no-var
	// noinspection JSUnusedGlobalSymbols
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.9.6
		 */
		init() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.9.6
		 */
		events() {
			$( window ).on( 'elementor/init', function() {
				// To add action on save event, we should use hookUI.After.
				$e.hooks.registerUIAfter( new class extends $e.modules.hookUI.After {
					// noinspection JSUnusedGlobalSymbols
					getCommand() {
						return 'document/save/save';
					}

					// noinspection JSUnusedGlobalSymbols
					getId() {
						return 'wpforms-elementor-editor-context-after-save';
					}

					// noinspection JSUnusedGlobalSymbols
					getConditions() {
						return true;
					}

					apply() {
						// Save custom themes in a preview window.
						const previewWindow = elementor.$preview[ 0 ]?.contentWindow;

						if ( previewWindow ) {
							previewWindow.WPFormsElementorThemes.saveCustomThemes();
						}
					}
				} );
			} );
		},
	};

	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsElementorEditorContext.init();
