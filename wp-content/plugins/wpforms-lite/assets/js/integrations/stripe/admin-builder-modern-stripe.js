/* global wpforms_builder, wpforms_builder_stripe, WPFormsBuilderPaymentsUtils */

// noinspection ES6ConvertVarToLetConst
/**
 * Stripe builder function.
 *
 * @since 1.8.4
 */
// eslint-disable-next-line no-var
var WPFormsStripeModernBuilder = window.WPFormsStripeModernBuilder || ( function( document, window, $ ) {
	/**
	 * Elements holder.
	 *
	 * @since 1.8.4
	 *
	 * @type {Object}
	 */
	let el = {};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.8.4
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.8.4
		 */
		init() {
			$( app.ready );
		},

		/**
		 * Initialized once the DOM is fully loaded.
		 *
		 * @since 1.8.4
		 */
		ready() {
			app.customMetadataActions();

			if ( app.isLegacySettings() ) {
				return;
			}

			// Cache DOM elements.
			el = {
				$alert:        $( '#wpforms-stripe-credit-card-alert' ),
				$panelContent: $( '#wpforms-panel-content-section-payment-stripe' ),
				$feeNotice:    $( '.wpforms-stripe-notice-info' ),
			};

			app.bindUIActions();
			app.bindPlanUIActions();

			if ( ! wpforms_builder_stripe.is_pro ) {
				const baseSelector = '.wpforms-panel-content-section-stripe',
					toggleInput = `${ baseSelector } .wpforms-panel-content-section-payment-toggle input`,
					planNameInput = `${ baseSelector } .wpforms-panel-content-section-payment-plan-name input`;

				$( toggleInput ).each( WPFormsBuilderPaymentsUtils.toggleContent );
				$( planNameInput ).each( WPFormsBuilderPaymentsUtils.checkPlanName );

				$( '#wpforms-panel-payments' )
					.on( 'click', toggleInput, WPFormsBuilderPaymentsUtils.toggleContent )
					.on( 'click', `${ baseSelector } .wpforms-panel-content-section-payment-plan-head-buttons-toggle`, WPFormsBuilderPaymentsUtils.togglePlan )
					.on( 'click', `${ baseSelector } .wpforms-panel-content-section-payment-plan-head-buttons-delete`, WPFormsBuilderPaymentsUtils.deletePlan )
					.on( 'input', planNameInput, WPFormsBuilderPaymentsUtils.renamePlan )
					.on( 'focusout', planNameInput, WPFormsBuilderPaymentsUtils.checkPlanName );
			}
		},

		/**
		 * Process custom metadata actions.
		 *
		 * @since 1.9.6
		 */
		customMetadataActions() {
			$( '#wpforms-panel-payments' )
				.on( 'focusout', '.wpforms-panel-field-stripe-custom-metadata-meta-key', function() {
					// Remove invalid characters for meta key.
					$( this ).val( $( this ).val().replace( /[^\p{L}\p{N}_-]/gu, '' ) );
				} )
				// Add metadata row.
				.on( 'click', '.wpforms-panel-content-section-stripe-custom-metadata-add', function( e ) {
					e.preventDefault();

					const $table = $( this ).parents( '.wpforms-panel-content-section-stripe-custom-metadata-table' ),
						$lastRow = $table.find( 'tr' ).last(),
						$clone = $lastRow.clone( true ),
						lastID = $lastRow.data( 'key' ),
						nextID = lastID + 1;

					// Update row key ID.
					$clone.attr( 'data-key', nextID );

					// Increment the counter.
					$clone.html( $clone.html().replaceAll( '[' + lastID + ']', '[' + nextID + ']' ).replaceAll( '-' + lastID + '-', '-' + nextID + '-' ) );

					// Clear values.
					$clone.find( 'select, input' ).val( '' );

					// Re-enable "delete" button.
					$clone.find( '.wpforms-panel-content-section-stripe-custom-metadata-delete' ).removeClass( 'hidden' );

					// Put it back to the table.
					$table.find( 'tbody' ).append( $clone.get( 0 ) );
				} )
				// Delete metadata row.
				.on( 'click', '.wpforms-panel-content-section-stripe-custom-metadata-delete', function( e ) {
					e.preventDefault();

					$( this ).parents( '.wpforms-panel-content-section-stripe-custom-metadata-table tr' ).remove();
				} );
		},

		/**
		 * Process various events as a response to UI interactions.
		 *
		 * @since 1.8.4
		 */
		bindUIActions() {
			const $builder = $( '#wpforms-builder' );

			$builder.on( 'wpformsFieldDelete', app.disableNotifications )
				.on( 'wpformsSaved', app.requiredFieldsCheck )
				.on( 'wpformsFieldAdd', app.fieldAdded )
				.on( 'wpformsFieldDelete', app.fieldDeleted )
				.on( 'wpformsPaymentsPlanCreated', app.toggleMultiplePlansWarning )
				.on( 'wpformsPaymentsPlanCreated', app.bindPlanUIActions )
				.on( 'wpformsPaymentsPlanDeleted', app.toggleMultiplePlansWarning );
		},

		/**
		 * Bind plan UI actions.
		 *
		 * @since 1.9.5
		 */
		bindPlanUIActions() {
			el.$panelContent.find( '.wpforms-panel-content-section-payment-plan-body .wpforms-panel-field-select select[name*="email"]' ).on( 'change', app.resetEmailAlertErrorClass );
		},

		/**
		 * On form save notify users about required fields.
		 *
		 * @since 1.8.4
		 */
		requiredFieldsCheck() {
			if ( ! $( '#wpforms-panel-field-stripe-enable_recurring' ).is( ':checked' ) || el.$panelContent.hasClass( 'wpforms-hidden' ) ) {
				return;
			}

			let showAlert = false;

			el.$panelContent.find( '.wpforms-panel-content-section-payment-plan' ).each( function() {
				const $plan = $( this ),
					planId = $plan.data( 'plan-id' ),
					$emailField = $( `#wpforms-panel-field-stripe-recurring-${ planId }-email` );

				if ( ! $emailField.val() ) {
					$emailField.addClass( 'wpforms-required-field-error' );

					showAlert = true;
				}
			} );

			if ( ! showAlert ) {
				return;
			}

			app.recurringEmailAlert();
		},

		/**
		 * Maybe reset required email field error class.
		 *
		 * @since 1.9.5
		 */
		resetEmailAlertErrorClass() {
			$( this ).toggleClass( 'wpforms-required-field-error', ! $( this ).val() );
		},

		/**
		 * Show alert for required recurring email field.
		 *
		 * @since 1.8.4
		 */
		recurringEmailAlert() {
			let alertMessage = wpforms_builder.stripe_recurring_email;

			if ( ! $( '.wpforms-panel-content-section-stripe' ).is( ':visible' ) ) {
				alertMessage += ' ' + wpforms_builder.stripe_recurring_settings;
			}

			$.alert( {
				title: wpforms_builder.stripe_recurring_heading,
				content: alertMessage,
				icon: 'fa fa-exclamation-circle',
				type: 'red',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
				onOpen() {
					$( '.wpforms-stripe-settings-redirect' ).on( 'click', app.settingsRedirect );
				},
			} );
		},

		/**
		 * Redirect to the settings tab.
		 *
		 * @since 1.9.5
		 */
		settingsRedirect() {
			// Open the Stripe settings tab.
			$( '.wpforms-panel-payments-button' ).trigger( 'click' );
			$( '.wpforms-panel-sidebar-section-stripe' ).trigger( 'click' );

			// Scroll to the Stripe settings.
			window.location.href = window.location.pathname + window.location.search + '#wpforms-panel-field-stripe-enable_recurring-wrap';

			// Close the alert.
			$( this ).closest( '.jconfirm-box' ).find( '.btn-confirm' ).trigger( 'click' );
		},

		/**
		 * Disable notifications.
		 *
		 * @since 1.8.4
		 *
		 * @param {Object} e    Event object.
		 * @param {number} id   Field ID.
		 * @param {string} type Field type.
		 */
		disableNotifications( e, id, type ) {
			if ( ! app.isStripeField( type ) ) {
				return;
			}

			if ( app.hasStripeCreditCardFieldInBuilder() ) {
				return;
			}

			const $notificationWrap = $( '.wpforms-panel-content-section-notifications [id*="-stripe-wrap"]' );

			$notificationWrap.find( 'input[id*="-stripe"]' ).prop( 'checked', false );
			$notificationWrap.addClass( 'wpforms-hidden' );
		},

		/**
		 * Determine is legacy settings is loaded.
		 *
		 * @since 1.8.4
		 *
		 * @return {boolean} True is legacy settings loaded.
		 */
		isLegacySettings() {
			return $( '#wpforms-panel-field-stripe-enable' ).length;
		},

		/**
		 * We have to do several actions when the "Stripe" field is added.
		 *
		 * @since 1.8.4
		 *
		 * @param {Object} e    Event object.
		 * @param {number} id   Field ID.
		 * @param {string} type Field type.
		 */
		fieldAdded( e, id, type ) {
			if ( ! app.isStripeField( type ) ) {
				return;
			}

			if ( ! app.hasStripeCreditCardFieldInBuilder() ) {
				return;
			}

			app.settingsToggle( true );
			el.$feeNotice.toggleClass( 'wpforms-hidden' );
		},

		/**
		 * We have to do several actions when the "Stripe" field is deleted.
		 *
		 * @since 1.8.4
		 *
		 * @param {Object} e    Event object.
		 * @param {number} id   Field ID.
		 * @param {string} type Field type.
		 */
		fieldDeleted( e, id, type ) {
			if ( ! app.isStripeField( type ) ) {
				return;
			}

			if ( app.hasStripeCreditCardFieldInBuilder() ) {
				return;
			}

			app.settingsToggle( false );
			app.disablePayments();
			el.$feeNotice.toggleClass( 'wpforms-hidden' );
		},

		/**
		 * Determine if a field type is Stripe credit card.
		 *
		 * @since 1.8.4
		 *
		 * @param {string} type Field type.
		 *
		 * @return {boolean} True if Stripe field.
		 */
		isStripeField( type ) {
			return type === wpforms_builder_stripe.field_slug;
		},

		/**
		 * Checks if the Stripe Credit Card field is in the form builder.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} True if the Stripe Credit Card field is in the builder.
		 */
		hasStripeCreditCardFieldInBuilder() {
			return $( `.wpforms-field.wpforms-field-${ wpforms_builder_stripe.field_slug }` ).length > 0;
		},

		/**
		 * Toggles visibility of multiple plans warning.
		 *
		 * @since 1.8.4
		 */
		toggleMultiplePlansWarning() {
			el.$panelContent.find( '.wpforms-stripe-multiple-plans-warning' ).toggleClass( 'wpforms-hidden', el.$panelContent.find( '.wpforms-panel-content-section-payment-plan' ).length === 1 );
		},

		/**
		 * Toggles visibility of the Stripe addon settings.
		 *
		 * @since 1.8.4
		 *
		 * @param {boolean} display Show or hide settings.
		 */
		settingsToggle( display ) {
			if (
				! el.$alert.length &&
				! el.$panelContent.length
			) {
				return;
			}

			el.$alert.toggleClass( 'wpforms-hidden', display );
			el.$panelContent.toggleClass( 'wpforms-hidden', ! display );
		},

		/**
		 * Toggle payments content.
		 *
		 * @since 1.8.4
		 */
		toggleContent() {
			// eslint-disable-next-line no-console
			console.warn( 'WARNING! Function "WPFormsStripeModernBuilder.toggleContent()" has been deprecated, please use the new "WPFormsPaymentsUtils.toggleContent()" function instead!' );

			WPFormsBuilderPaymentsUtils.toggleContent();
		},

		/**
		 * Toggle a plan content.
		 *
		 * @since 1.8.4
		 */
		togglePlan() {
			// eslint-disable-next-line no-console
			console.warn( 'WARNING! Function "WPFormsStripeModernBuilder.togglePlan()" has been deprecated, please use the new "WPFormsPaymentsUtils.togglePlan()" function instead!' );

			WPFormsBuilderPaymentsUtils.togglePlan();
		},

		/**
		 * Delete a plan.
		 *
		 * @since 1.8.4
		 */
		deletePlan() {
			// eslint-disable-next-line no-console
			console.warn( 'WARNING! Function "WPFormsStripeModernBuilder.checkPlanName()" has been deprecated, please use the new "WPFormsPaymentsUtils.deletePlan()" function instead!' );

			WPFormsBuilderPaymentsUtils.deletePlan();
		},

		/**
		 * Check a plan name on empty value.
		 *
		 * @since 1.8.4
		 */
		checkPlanName() {
			// eslint-disable-next-line no-console
			console.warn( 'WARNING! Function "WPFormsStripeModernBuilder.checkPlanName()" has been deprecated, please use the new "WPFormsPaymentsUtils.checkPlanName()" function instead!' );

			WPFormsBuilderPaymentsUtils.checkPlanName();
		},

		/**
		 * Rename a plan.
		 *
		 * @since 1.8.4
		 */
		renamePlan() {
			// eslint-disable-next-line no-console
			console.warn( 'WARNING! Function "WPFormsStripeModernBuilder.renamePlan()" has been deprecated, please use the new "WPFormsPaymentsUtils.renamePlan()" function instead!' );

			WPFormsBuilderPaymentsUtils.renamePlan();
		},

		/**
		 * Make sure that "One-Time Payments" and "Recurring Payments" toggles are turned off.
		 *
		 * @since 1.9.5
		 */
		disablePayments() {
			const toggleInput = $( '#wpforms-panel-field-stripe-enable_one_time, #wpforms-panel-field-stripe-enable_recurring' );

			toggleInput.prop( 'checked', false ).trigger( 'change' ).each( WPFormsBuilderPaymentsUtils.toggleContent );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsStripeModernBuilder.init();
