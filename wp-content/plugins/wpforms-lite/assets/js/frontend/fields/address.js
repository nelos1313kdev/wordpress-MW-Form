/* global wpforms_settings */

/**
 * @param wpforms_settings.address_field.list_countries_without_states
 */

( function( window, $ ) {
	const app = {

		/**
		 * List of countries without states.
		 *
		 * @see WPForms\Forms\Fields\Address\Frontend::strings for PHP filter.
		 *
		 * @since 1.9.5
		 */
		noStateCountries: [],

		/**
		 * Init Address field.
		 *
		 * @since 1.9.5
		 */
		init() {
			$( window ).on( 'load', app.onLoad );
			$( document )
				.on( 'wpformsRepeaterFieldCloneCreated', app.setChangeHandlers );
		},

		/**
		 * On load event.
		 *
		 * @since 1.9.5
		 */
		onLoad() {
			app.noStateCountries = wpforms_settings?.address_field?.list_countries_without_states || [];

			if ( ! app.noStateCountries.length ) {
				return;
			}

			app.setChangeHandlers();
		},

		/**
		 * Set change handlers.
		 *
		 * @since 1.9.5
		 */
		setChangeHandlers() {
			$( '.wpforms-field-address' ).each( function() {
				const $countrySelect = $( this ).find( 'select.wpforms-field-address-country' );

				if ( ! $countrySelect.length ) {
					return;
				}

				app.handleCountryChange( $countrySelect );

				$countrySelect
					.off( 'change' )
					.on( 'change', function() {
						app.handleCountryChange( this );
					} );
			} );
		},

		/**
		 * Handle country change.
		 *
		 * @since 1.9.5
		 *
		 * @param {HTMLElement} field Country select field.
		 */
		handleCountryChange( field ) {
			const $this = $( field ),
				$stateInput = $this.closest( '.wpforms-field' ).find( '.wpforms-field-address-state' ),
				$rowWithState = $stateInput.closest( '.wpforms-field-row' );

			if ( ! $rowWithState.length ) {
				return;
			}

			const value = $this.val();

			app.handleStateInput( $stateInput, $rowWithState, value );
		},

		/**
		 * Handle state input.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $stateInput   State input.
		 * @param {jQuery} $rowWithState Row with state.
		 * @param {string} countryValue  Country value.
		 */
		handleStateInput( $stateInput, $rowWithState, countryValue ) {
			if ( app.noStateCountries.includes( countryValue ) ) {
				$stateInput
					.val( '' )
					.prop( 'disabled', true )
					.prop( 'required', false )
					.on( 'change', function() {
						$( this ).val( '' );
					} );

				$rowWithState.addClass( 'wpforms-without-state' );

				return;
			}

			$stateInput
				.prop( 'disabled', false )
				.prop( 'required', $rowWithState.find( '.wpforms-first input' ).prop( 'required' ) ) // Set required same as first input.
				.off( 'change' );

			$rowWithState.removeClass( 'wpforms-without-state' );
		},
	};

	app.init();

	return app;
}( window, jQuery ) );
