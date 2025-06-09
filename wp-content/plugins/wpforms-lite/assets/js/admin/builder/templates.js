/* global wpforms_builder */

// eslint-disable-next-line no-var
var WPForms = window.WPForms || {};
WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.Templates = WPForms.Admin.Builder.Templates || ( function( document, window, $ ) {
	/**
	 * Private functions and properties.
	 *
	 * @since 1.4.8
	 *
	 * @type {Object}
	 */
	const __private = {

		/**
		 * All templating functions for providers are stored here in a Map.
		 * Key is a template name, value - Underscore.js templating function.
		 *
		 * @since 1.4.8
		 *
		 * @type {Map}
		 */
		previews: new Map(),

		/**
		 * Function to handle subfields for a given template's properties and extend
		 * the fields list if applicable. The function processes fields for specific
		 * types and formats, especially for "name" type fields, transforming them into
		 * an extended format with additional subfields (Full, First, Middle, Last).
		 *
		 * If the `isSupportSubfields` property is not enabled in the provided template's
		 * properties, the original `basePreview` function is executed without modification.
		 *
		 * @since 1.9.6
		 *
		 * @param {Function} basePreview The base preview function to execute the final output.
		 *
		 * @return {Function} A function that accepts `templateProps` and processes its fields.
		 */
		handleSubFields: ( basePreview ) => ( templateProps ) => {
			if ( ! templateProps?.isSupportSubfields ) {
				return basePreview( templateProps );
			}

			const extendedFieldsList = {};
			let counter = 0;

			_.each( templateProps.fields, function( field, key ) {
				if ( _.isEmpty( field ) || ! _.has( field, 'id' ) || ! _.has( field, 'type' ) ) {
					return;
				}

				if ( 'name' !== field.type || ! _.has( field, 'format' ) ) {
					extendedFieldsList[ counter++ ] = field;

					return;
				}

				field.id = field.id.toString();

				const fieldLabel = ! _.isUndefined( field.label ) && field.label.toString().trim() !== ''
					? field.label.toString().trim()
					: wpforms_builder.field + ' #' + key;

				// Add data for Name field in "extended" format (Full, First, Middle and Last).
				_.each( wpforms_builder.name_field_formats, function( formatLabel, valueSlug ) {
					if ( -1 !== field.format.indexOf( valueSlug ) || valueSlug === 'full' ) {
						extendedFieldsList[ counter++ ] = {
							id: field.id + '.' + valueSlug,
							label: fieldLabel + ' (' + formatLabel + ')',
							format: field.format,
						};
					}
				} );
			} );

			templateProps.fields = extendedFieldsList;

			return basePreview( templateProps );
		},
	};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.4.8
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine. DOM is not ready yet, use only to init something.
		 *
		 * @since 1.4.8
		 */
		init() {
			// Do that when DOM is ready.
			$( app.ready );
		},

		/**
		 * DOM is fully loaded.
		 *
		 * @since 1.4.8
		 */
		ready() {
			$( '#wpforms-panel-providers' ).trigger( 'WPForms.Admin.Builder.Templates.ready' );
		},

		/**
		 * Register and compile all templates.
		 * All data is saved in a Map.
		 *
		 * @since 1.4.8
		 *
		 * @param {string[]} templates Array of template names.
		 */
		add( templates ) {
			templates.forEach( function( template ) {
				if ( typeof template === 'string' ) {
					__private.previews.set( template, wp.template( template ) );
				}
			} );
		},

		/**
		 * Get a templating function (to compile later with data).
		 *
		 * @since 1.4.8
		 *
		 * @param {string} template ID of a template to retrieve from a cache.
		 *
		 * @return {*} A callable that after compiling will always return a string.
		 */
		get( template ) {
			const preview = __private.previews.get( template );

			if ( typeof preview !== 'undefined' ) {
				return __private.handleSubFields( preview );
			}

			return function() {
				return '';
			};
		},

	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPForms.Admin.Builder.Templates.init();
