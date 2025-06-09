/* global Square, wpforms, wpforms_settings, wpforms_square, WPForms, WPFormsUtils */

/**
 * WPForms Square function.
 *
 * @since 1.9.5
 */
const WPFormsSquare = window.WPFormsSquare || ( function( document, window, $ ) {
	/**
	 * Holder for original form submit handler.
	 *
	 * @since 1.9.5
	 *
	 * @type {Function}
	 */
	let originalSubmitHandler;

	/**
	 * Credit card data.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const cardData = {
		cardNumber: {
			empty: true,
			valid: false,
		},
		expirationDate: {
			empty: true,
			valid: false,
		},
		cvv: {
			empty: true,
			valid: false,
		},
		postalCode: {
			empty: true,
			valid: false,
		},
	};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Square payments object.
		 *
		 * @since 1.9.5
		 *
		 * @type {Object}
		 */
		payments: null,

		/**
		 * Number of page locked to switch.
		 *
		 * @since 1.9.5
		 *
		 * @type {number}
		 */
		lockedPageToSwitch: 0,

		/**
		 * Start the engine.
		 *
		 * @since 1.9.5
		 */
		init() {
			app.payments = app.getPaymentsInstance();

			// Bail if a Square payments object isn't initialized.
			if ( app.payments === null ) {
				return;
			}

			$( document )
				.on( 'wpformsReady', app.setupForms )
				.on( 'wpformsBeforePageChange', app.pageChange )
				.on( 'wpformsPageChange', app.afterPageChange )
				.on( 'wpformsProcessConditionalsField', app.conditionalLogicHandler );
		},

		/**
		 * Setup and configure Square forms.
		 *
		 * @since 1.9.5
		 */
		setupForms() {
			if ( typeof $.fn.validate === 'undefined' ) {
				return;
			}

			$( '.wpforms-square form' )
				.filter( ( _, form ) => typeof $( form ).data( 'formid' ) === 'number' ) // filter out forms which are locked (formid changed to 'locked-...').
				.each( app.updateSubmitHandler );
		},

		/**
		 * Update submitHandler for the forms containing Square.
		 *
		 * @since 1.9.5
		 */
		async updateSubmitHandler() {
			const $form = $( this );
			const validator = $form.data( 'validator' );

			if ( ! validator || $form.hasClass( 'wpforms-square-initialization' ) || $form.hasClass( 'wpforms-square-initialized' ) ) {
				return;
			}

			// if the form is inside the "raw" elementor popup, we should not initialize the Square and wait for the popup to be opened.
			if ( $form.closest( '.elementor-location-popup' ).length && ! $form.closest( '.elementor-popup-modal' ).length ) {
				return;
			}

			$form.addClass( 'wpforms-square-initialization' );

			// Store the original submitHandler.
			originalSubmitHandler = validator.settings.submitHandler;

			// Replace the default submit handler.
			validator.settings.submitHandler = app.submitHandler;

			// Get a new Card object.
			await app.getCardInstance( $form );
		},

		/**
		 * Trigger resize event if Square field has been conditionally unhidden.
		 *
		 * Allows Square Card field to resize itself (fixes the issue with doubled field height on some screen resolutions).
		 *
		 * @since 1.9.5
		 *
		 * @param {Event}   e       Event.
		 * @param {number}  formID  Form ID.
		 * @param {number}  fieldID Field ID.
		 * @param {boolean} pass    Pass condition logic.
		 * @param {string}  action  Action name.
		 */
		conditionalLogicHandler( e, formID, fieldID, pass, action ) {
			if ( ! app.isVisibleField( pass, action ) ) {
				return;
			}

			const el = document.getElementById( 'wpforms-' + formID + '-field_' + fieldID );

			if ( ! el || ! el.classList.contains( 'wpforms-field-square-cardnumber' ) ) {
				return;
			}

			window.dispatchEvent( new Event( 'resize' ) );
		},

		/**
		 * Determine if the field is visible after being triggered by Conditional Logic.
		 *
		 * @since 1.9.5
		 *
		 * @param {boolean} pass   Pass condition logic.
		 * @param {string}  action Action name.
		 *
		 * @return {boolean} The field is visible.
		 */
		isVisibleField( pass, action ) {
			return ( action === 'show' && pass ) || ( action === 'hide' && ! pass );
		},

		/**
		 * Update submitHandler for forms containing Square.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} form JS form element.
		 */
		submitHandler( form ) {
			const $form = $( form );
			const validator = $form.data( 'validator' );
			const validForm = validator.form();
			const card = $form.find( '.wpforms-square-credit-card-hidden-input' ).data( 'square-card' );

			if ( ! validForm || typeof card === 'undefined' || ! app.isProcessedCard( $form ) ) {
				originalSubmitHandler( $form );
				return;
			}

			app.tokenize( $form, card );
		},

		/**
		 * Tokenize a card payment.
		 *
		 * @param {jQuery} $form Form element.
		 * @param {Object} card  Square Card object.
		 */
		async tokenize( $form, card ) {
			app.disableSubmitBtn( $form );

			const sourceId = await app.getSourceId( $form, card );

			if ( sourceId === null ) {
				app.enableSubmitBtn( $form );
				return;
			}

			app.submitForm( $form );
		},

		/**
		 * Initialize a Square payments object and retrieve it.
		 *
		 * @since 1.9.5
		 *
		 * @return {Object|null} Square payments object or null.
		 */
		getPaymentsInstance() {
			if ( ! window.Square ) {
				app.displaySdkError( $( '.wpforms-square form' ), wpforms_square.i18n.missing_sdk_script );

				return null;
			}

			try {
				return Square.payments( wpforms_square.client_id, wpforms_square.location_id );
			} catch ( e ) {
				const message = ( typeof e === 'object' && Object.prototype.hasOwnProperty.call( e, 'message' ) ) ? e.message : wpforms_square.i18n.missing_creds;

				app.displaySdkError( $( '.wpforms-square form' ), message );

				return null;
			}
		},

		/**
		 * Try to retrieve a Square Card object.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @return {Object|null} Square Card object or null.
		 */
		async getCardInstance( $form ) {
			// Applying the modern styles to the card config if needed.
			// eslint-disable-next-line prefer-const
			let cardConfig = {};

			cardConfig.style = wpforms_square.card_config.style ? wpforms_square.card_config.style : app.getModernMarkupCardStyles( $form );

			try {
				const card = await app.payments.card( cardConfig );

				// Attach the Card form to the page.
				await card.attach( $form.find( '.wpforms-field-square-cardnumber' ).get( 0 ) );

				const eventsList = [ 'focusClassAdded', 'focusClassRemoved' ];
				const eventsLength = eventsList.length;
				let counter = 0;

				// Bind the Card events.
				for ( ; counter < eventsLength; counter++ ) {
					card.addEventListener( eventsList[ counter ], function( e ) {
						// Card field is filled.
						cardData[ e.detail.field ].empty = e.detail.currentState.isEmpty;
						cardData[ e.detail.field ].valid = e.detail.currentState.isCompletelyValid;
					} );
				}

				$form.find( '.wpforms-square-credit-card-hidden-input' ).data( 'square-card', card );

				$form.removeClass( 'wpforms-square-initialization' );
				$form.addClass( 'wpforms-square-initialized' );

				return card;
			} catch ( e ) {
				app.displaySdkError( $form, wpforms_square.i18n.card_init_error );

				$form.removeClass( 'wpforms-square-initialization' );

				console.log( 'Error:', e ); // eslint-disable-line no-console
				console.log( 'Config', cardConfig ); // eslint-disable-line no-console

				return null;
			}
		},

		/**
		 * Retrieve a source ID (card nonce).
		 *
		 * @param {jQuery} $form Form element.
		 * @param {Object} card  Square Card object.
		 *
		 * @return {string|null} The source ID or null.
		 */
		async getSourceId( $form, card ) {
			try {
				const response = await card.tokenize( app.getChargeVerifyBuyerDetails( $form ) );

				$form.find( '.wpforms-square-payment-source-id' ).remove();

				if ( response.status !== 'OK' || ! response.token ) {
					app.displayFormError( app.getCreditCardInput( $form ), app.getResponseError( response ) );

					return null;
				}

				$form.append( '<input type="hidden" name="wpforms[square][source_id]" class="wpforms-square-payment-source-id" value="' + app.escapeTextString( response.token ) + '">' );

				return response.token;
			} catch ( e ) {
				app.displayFormError( app.getCreditCardInput( $form ), wpforms_square.i18n.token_process_fail );
			}

			return null;
		},

		/**
		 * Retrieve a response error message.
		 *
		 * @param {Object} response The response received from a tokenization call.
		 *
		 * @return {string} The response error message.
		 */
		getResponseError( response ) {
			const hasErrors = response.errors && Array.isArray( response.errors ) && response.errors.length;

			return hasErrors ? response.errors[ 0 ].message : wpforms_square.i18n.token_status_error + ' ' + response.status;
		},

		/**
		 * Retrieve details about the buyer for a charge.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @return {Object} Buyer details.
		 */
		getChargeVerifyBuyerDetails( $form ) {
			return {
				amount: app.getTotalInMinorUnits( wpforms.amountTotalCalc( $form ) ),
				billingContact: app.getBillingContactDetails( $form ),
				currencyCode: wpforms_settings.currency_code,
				intent: 'CHARGE',
				customerInitiated: true,
				sellerKeyedIn: false,
			};
		},

		/**
		 * Retrieve the total amount in minor units.
		 *
		 * @since 1.9.5
		 *
		 * @param {number} total Total amount.
		 *
		 * @return {string} Total amount in minor units.
		 */
		getTotalInMinorUnits( total ) {
			return parseInt( wpforms.numberFormat( total, wpforms_settings.currency_decimal, '', '' ), 10 ).toString();
		},

		/**
		 * Retrieve billing contact details.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @return {Object} Billing contact details.
		 */
		getBillingContactDetails( $form ) { // eslint-disable-line complexity
			// Get the form ID and billing mapping for this form, if available.
			const formId = $form.data( 'formid' );
			const mapping = ( wpforms_square.billing_details && wpforms_square.billing_details[ formId ] ) || {};
			const result = {};

			// Use mapped selectors if provided.
			const $emailField = mapping.buyer_email ? $( `.wpforms-field-email[data-field-id="${ mapping.buyer_email }"]` ) : '';
			const $nameField = mapping.billing_name ? $( `.wpforms-field-name[data-field-id="${ mapping.billing_name }"]` ) : '';
			const $addressField = mapping.billing_address ? $( `.wpforms-field-address[data-field-id="${ mapping.billing_address }"]` ) : '';

			if ( $emailField.length ) {
				const emailValue = $emailField.find( 'input' ).first().val(); // Use the first input field knowing there could be confirmation email input as well.
				if ( emailValue && emailValue.trim() !== '' ) {
					result.email = emailValue;
				}
			}

			if ( $nameField.length ) {
				jQuery.extend( result, app.getBillingNameDetails( $nameField ) );
			}

			if ( $addressField.length ) {
				jQuery.extend( result, app.getBillingAddressDetails( $addressField ) );
			}

			return result;
		},

		/**
		 * Retrieve billing name details.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $field Field element.
		 *
		 * @return {Object} Billing name details.
		 */
		getBillingNameDetails( $field ) { // eslint-disable-line complexity
			const result = {};

			let givenName = '';
			let familyName = '';

			// Try to find separate first and last name fields.
			const $firstNameField = $field.find( '.wpforms-field-name-first' );
			const $lastNameField = $field.find( '.wpforms-field-name-last' );

			if ( $firstNameField.length && $lastNameField.length ) {
				// Use separate fields if both are present.
				givenName = $firstNameField.val() || '';
				familyName = $lastNameField.val() || '';

				if ( givenName && givenName.trim() !== '' ) {
					result.givenName = givenName;
				}

				if ( familyName && familyName.trim() !== '' ) {
					result.familyName = familyName;
				}

				return result;
			}

			// Otherwise, fall back to a single name input field.
			const $nameField = $field.find( 'input' );

			if ( ! $nameField.length ) {
				return result;
			}
			const fullName = $nameField.val().trim();

			if ( ! fullName.length ) {
				return result;
			}

			// Split full name by space; the first part is givenName,
			// the rest (if any) are combined as familyName.
			const nameParts = fullName.split( ' ' );
			givenName = nameParts.shift() || '';
			familyName = nameParts.join( ' ' ) || '';

			if ( givenName && givenName.trim() !== '' ) {
				result.givenName = givenName;
			}

			if ( familyName && familyName.trim() !== '' ) {
				result.familyName = familyName;
			}

			return result;
		},

		/**
		 * Retrieve billing address details.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $addressField Field element.
		 *
		 * @return {Object} Billing address details.
		 */
		getBillingAddressDetails( $addressField ) { // eslint-disable-line complexity
			const result = {};

			// For address fields, use the closest wrapper.
			const $addressWrapper = $addressField.closest( '.wpforms-field' );

			// Retrieve address components, defaulting to empty strings if not found.
			const addressLine1 = $addressWrapper.find( '.wpforms-field-address-address1' ).val() || '';
			const addressLine2 = $addressWrapper.find( '.wpforms-field-address-address2' ).val() || '';
			const city = $addressWrapper.find( '.wpforms-field-address-city' ).val() || '';
			const state = $addressWrapper.find( '.wpforms-field-address-state' ).val() || '';
			const country = $addressWrapper.find( '.wpforms-field-address-country' ).val() || 'US';
			const addressLines = [ addressLine1, addressLine2 ].filter( ( line ) => line && line.trim() !== '' );

			if ( addressLines.length ) {
				result.addressLines = addressLines;
			}

			if ( city && city.trim() !== '' ) {
				result.city = city;
			}
			if ( state && state.trim() !== '' ) {
				result.state = state;
			}
			if ( country && country.trim() !== '' ) {
				result.countryCode = country;
			}

			return result;
		},

		/**
		 * Retrieve a jQuery selector for Credit Card hidden input.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @return {jQuery} Credit Card hidden input.
		 */
		getCreditCardInput( $form ) {
			return $form.find( '.wpforms-square-credit-card-hidden-input' );
		},

		/**
		 * Submit the form using the original submitHandler.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 */
		submitForm( $form ) {
			const validator = $form.data( 'validator' );

			if ( validator ) {
				originalSubmitHandler( $form );
			}
		},

		/**
		 * Determine if a credit card should be processed.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 *
		 * @return {boolean} True if a credit card should be processed.
		 */
		isProcessedCard( $form ) {
			const $squareDiv = $form.find( '.wpforms-field-square-cardnumber' );
			const condHidden = $squareDiv.closest( '.wpforms-field-square' ).hasClass( 'wpforms-conditional-hide' );
			const ccRequired = !! $squareDiv.data( 'required' );

			if ( condHidden ) {
				return false;
			}

			return ccRequired || app.isCardDataNotEmpty();
		},

		/**
		 * Determine if card data not empty.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} True if at least one credit card sub-field is filled.
		 */
		isCardDataNotEmpty() {
			return ! cardData.cardNumber.empty || ! cardData.expirationDate.empty || ! cardData.cvv.empty || ! cardData.postalCode.empty;
		},

		/**
		 * Determine if card data is completely valid.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} True if at least one credit card sub-field is filled.
		 */
		isCardDataValid() {
			return cardData.cardNumber.valid && cardData.expirationDate.valid && cardData.cvv.valid && cardData.postalCode.valid;
		},

		/**
		 * Display a SDK error.
		 *
		 * @param {jQuery} $form   Form element.
		 * @param {string} message Error messages.
		 *
		 * @since 1.9.5
		 */
		displaySdkError( $form, message ) {
			$form
				.find( '.wpforms-square-credit-card-hidden-input' )
				.closest( '.wpforms-field-square-number' )
				.append( $( '<label></label>', {
					text: message,
					class: 'wpforms-error',
				} ) );
		},

		/**
		 * Display a field error using jQuery Validate library.
		 *
		 * @param {jQuery} $field  Form element.
		 * @param {string} message Error messages.
		 *
		 * @since 1.9.5
		 */
		displayFormError( $field, message ) {
			const fieldName = $field.attr( 'name' );
			const $form = $field.closest( 'form' );
			const error = {};

			error[ fieldName ] = message;

			wpforms.displayFormAjaxFieldErrors( $form, error );
			wpforms.scrollToError( $field );
		},

		/**
		 * Disable submit button for the form.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 */
		disableSubmitBtn( $form ) {
			$form.find( '.wpforms-submit' ).prop( 'disabled', true );
		},

		/**
		 * Enable submit button for the form.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Form element.
		 */
		enableSubmitBtn( $form ) {
			$form.find( '.wpforms-submit' ).prop( 'disabled', false );
		},

		/**
		 * Replaces &, <, >, ", `, and ' with their escaped counterparts.
		 *
		 * @since 1.9.5
		 *
		 * @param {string} string String to escape.
		 *
		 * @return {string} Escaped string.
		 */
		escapeTextString( string ) {
			return $( '<span></span>' ).text( string ).html();
		},

		/**
		 * Callback for a page changing.
		 *
		 * @since 1.9.5
		 *
		 * @param {Event}  event       Event.
		 * @param {number} currentPage Current page.
		 * @param {jQuery} $form       Current form.
		 * @param {string} action      The navigation action.
		 */
		pageChange( event, currentPage, $form, action ) { // eslint-disable-line complexity
			const $squareDiv = $form.find( '.wpforms-field-square-cardnumber' );

			// Stop navigation through page break pages.
			if (
				! $squareDiv.is( ':visible' ) ||
				( ! $squareDiv.data( 'required' ) && ! app.isCardDataNotEmpty() ) ||
				( app.lockedPageToSwitch && app.lockedPageToSwitch !== currentPage ) ||
				action === 'prev'
			) {
				return;
			}

			if ( app.isCardDataValid() ) {
				$squareDiv.parent().find( 'label.wpforms-error' ).remove();

				return;
			}

			app.lockedPageToSwitch = currentPage;

			app.displayFormError( app.getCreditCardInput( $form ), wpforms_square.i18n.empty_details );
			event.preventDefault();
		},

		/**
		 * Callback for a after page changing.
		 *
		 * @since 1.9.5
		 */
		afterPageChange() {
			window.dispatchEvent( new Event( 'resize' ) );
		},

		/**
		 * Get CSS property value.
		 * In case of exception return empty string.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $element Element.
		 * @param {string} property Property.
		 *
		 * @return {string} Property value.
		 */
		getCssPropertyValue( $element, property ) {
			try {
				return $element.css( property );
			} catch ( e ) {
				return '';
			}
		},

		/**
		 * Determine whether modern style are needed.
		 *
		 * Force run on the classic markup if it is conversational or lead form.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} True if the form needs styles.
		 */
		needsStyles() {
			// Styles are not needed if the classic markup is used
			// and it's neither conversational nor lead form.
			if (
				( ! window.WPForms || ! WPForms.FrontendModern ) &&
				! $( '#wpforms-conversational-form-page' ).length &&
				! $( '.wpforms-lead-forms-container' ).length
			) {
				return false;
			}

			return true;
		},

		/**
		 * Get modern card styles.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $form Current form.
		 *
		 * @return {Object} Card styles object.
		 */
		getModernMarkupCardStyles( $form ) {
			if ( ! app.needsStyles() ) {
				return {};
			}

			const $hiddenInput = app.getCreditCardInput( $form ),
				hiddenInputColor = app.getCssPropertyValue( $hiddenInput, 'color' ),
				inputStyle = {
					fontSize: app.getCssPropertyValue( $hiddenInput, 'font-size' ),
					colorText: hiddenInputColor,
					colorTextPlaceholder: hiddenInputColor,
				};

			// Check if WPFormsUtils.cssColorsUtils object is available.
			if ( WPFormsUtils.hasOwnProperty( 'cssColorsUtils' ) &&
				typeof WPFormsUtils.cssColorsUtils.getColorWithOpacity === 'function' ) {
				inputStyle.colorText = WPFormsUtils.cssColorsUtils.getColorWithOpacity( hiddenInputColor );
				inputStyle.colorTextPlaceholder = WPFormsUtils.cssColorsUtils.getColorWithOpacity( hiddenInputColor, '0.5' );
			}

			return {
				input: {
					color: inputStyle.colorText,
					fontSize: inputStyle.fontSize,
				},
				'input::placeholder': {
					color: inputStyle.colorTextPlaceholder,
				},
				'input.is-error': {
					color: inputStyle.colorText,
				},
			};
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsSquare.init();
