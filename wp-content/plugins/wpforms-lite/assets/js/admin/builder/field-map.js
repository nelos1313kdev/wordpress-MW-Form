/* global wpforms_builder, WPFormsUtils, wpf */

/**
 * @param wpforms_builder.add_custom_value_label
 * @param wpforms_builder.select_field
 */

// noinspection ES6ConvertVarToLetConst
/**
 * Form Builder Field Map.
 *
 * @since 1.9.5
 */
var WPForms = window.WPForms || {}; // eslint-disable-line no-var

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.FieldMap = WPForms.Admin.Builder.FieldMap || ( function( document, window, $ ) {
	/**
	 * Elements holder.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const el = {};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.9.5
		 */
		init() {
			$( app.ready );
		},

		/**
		 * DOM is fully loaded.
		 *
		 * @since 1.9.5
		 */
		ready() {
			app.setup();
			app.events();
		},

		/**
		 * Setup. Prepare some variables.
		 *
		 * @since 1.9.5
		 */
		setup() {
			// Cache DOM elements.
			el.$builder = $( '#wpforms-builder' );
		},

		/**
		 * Bind events.
		 *
		 * @since 1.9.5
		 */
		events() {
			// Field map table, update key source
			el.$builder.on( 'input', '.wpforms-field-map-table .key-source', function() {
				const value = $( this ).val(),
					$dest = $( this ).parent().parent().find( '.key-destination' ),
					name = $dest.data( 'name' );

				if ( value ) {
					$dest.attr( 'name', name.replace( '{source}', value.replace( /[^0-9a-zA-Z_-]/gi, '' ) ) );
				}
			} );

			// Field map table, delete row
			el.$builder.on( 'click', '.wpforms-field-map-table .remove', function( e ) {
				e.preventDefault();
				app.fieldMapTableDeleteRow( e, $( this ) );
			} );

			// Field map table, Add row
			el.$builder.on( 'click', '.wpforms-field-map-table .add', function( e ) {
				e.preventDefault();
				app.fieldMapTableAddRow( e, $( this ) );
			} );

			// Global select field mapping
			$( document ).on( 'wpformsFieldUpdate', app.fieldMapSelect );
		},

		/**
		 * Field map table - Delete row.
		 *
		 * @since 1.2.0
		 * @since 1.6.1.2 Registered `wpformsFieldMapTableDeletedRow` trigger.
		 *
		 * @param {Event}   e       Event.
		 * @param {Element} element Element.
		 */
		fieldMapTableDeleteRow( e, element ) {
			const $this = $( element ),
				$row = $this.closest( 'tr' ),
				$table = $this.closest( 'table' ),
				$block = $row.closest( '.wpforms-builder-settings-block' ),
				total = $table.find( 'tr' ).length;

			if ( total > '1' ) {
				$row.remove();

				el.$builder.trigger( 'wpformsFieldMapTableDeletedRow', [ $block ] );
			}
		},

		/**
		 * Field map table - Add row.
		 *
		 * @since 1.2.0
		 * @since 1.6.1.2 Registered `wpformsFieldMapTableAddedRow` trigger.
		 *
		 * @param {Event}   e       Event.
		 * @param {Element} element Element.
		 */
		fieldMapTableAddRow( e, element ) {
			const $this = $( element ),
				$row = $this.closest( 'tr' ),
				$block = $row.closest( '.wpforms-builder-settings-block' ),
				choice = $row.clone().insertAfter( $row );

			choice.find( 'input' ).val( '' );
			choice.find( 'select :selected' ).prop( 'selected', false );
			choice.find( '.key-destination' ).attr( 'name', '' );

			el.$builder.trigger( 'wpformsFieldMapTableAddedRow', [ $block, choice ] );
		},

		/**
		 * Update field mapped select items on form updates.
		 *
		 * @since 1.2.0
		 * @since 1.6.1.2 Registered `wpformsFieldSelectMapped` trigger.
		 *
		 * @param {Event}  e      Event.
		 * @param {Object} fields Fields.
		 */
		fieldMapSelect( e, fields ) { // eslint-disable-line max-lines-per-function
			const event = WPFormsUtils.triggerEvent( el.$builder, 'wpformsBeforeFieldMapSelectUpdate' );

			// Allow callbacks on `wpformsBeforeFieldMapSelectUpdate` to cancel adding field
			// by triggering `event.preventDefault()`.
			if ( event.isDefaultPrevented() ) {
				return;
			}

			$( '.wpforms-field-map-select' ).each( function() { // eslint-disable-line complexity, no-unused-vars
				const $this = $( this );
				let allowedFields = $this.data( 'field-map-allowed' ),
					placeholder = $this.data( 'field-map-placeholder' );

				// Check if custom placeholder was provided.
				if ( typeof placeholder === 'undefined' || ! placeholder ) {
					placeholder = wpforms_builder.select_field;
				}

				// If allowed, fields are not defined, bail.
				if ( typeof allowedFields !== 'undefined' && allowedFields ) {
					allowedFields = allowedFields.split( ' ' );
				} else {
					return;
				}

				const selected = $this.find( 'option:selected' ).val();

				// Reset select and add a placeholder option.
				$this.empty().append( $( '<option>', { value: '', text: placeholder } ) );

				// Loop through the current fields, if we have fields for the form.
				if ( fields && ! $.isEmptyObject( fields ) ) {
					for ( const fieldID in fields ) {
						let label = '';

						if ( ! fields[ fieldID ] ) {
							continue;
						}

						// Prepare the label.
						if ( typeof fields[ fieldID ].label !== 'undefined' && fields[ fieldID ].label.toString().trim() !== '' ) {
							label = wpf.sanitizeHTML( fields[ fieldID ].label.toString().trim() );
						} else {
							label = wpforms_builder.field + ' #' + fieldID;
						}

						// Add to select if it is a field type allowed.
						if ( $.inArray( fields[ fieldID ].type, allowedFields ) >= 0 || $.inArray( 'all-fields', allowedFields ) >= 0 ) {
							$this.append( $( '<option>', { value: fields[ fieldID ].id, text: label } ) );
						}
					}
				}

				// Restore previous value if found.
				if ( selected ) {
					$this.find( 'option[value="' + selected + '"]' ).prop( 'selected', true );
				}

				// Add a "Custom Value" option if it is supported.
				const customValueSupport = $this.data( 'custom-value-support' );

				if ( typeof customValueSupport === 'boolean' && customValueSupport ) {
					$this.append(
						$( '<option>', {
							value: 'custom_value',
							text: wpforms_builder.add_custom_value_label,
							class: 'wpforms-field-map-option-custom-value',
						} )
					);
				}

				el.$builder.trigger( 'wpformsFieldSelectMapped', [ $this ] );
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPForms.Admin.Builder.FieldMap.init();
