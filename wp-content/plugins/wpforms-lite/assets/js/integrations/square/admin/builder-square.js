/* global wpforms_builder, WPFormsBuilderPaymentsUtils */

/**
 * WPForms Square builder function.
 *
 * @since 1.9.5
 */
const WPFormsBuilderSquare = window.WPFormsBuilderSquare || ( function( document, window, $ ) {
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
		 * Initialized once the DOM and Providers are fully loaded.
		 *
		 * @since 1.9.5
		 */
		ready() {
			// Cache DOM elements.
			el.$singlePaymentControl = $( '#wpforms-panel-field-square-enable_one_time' );
			el.$recurringPaymentControl = $( '#wpforms-panel-field-square-enable_recurring' );
			el.$panelContent = $( '#wpforms-panel-content-section-payment-square' );
			el.$AJAXSubmitOption = $( '#wpforms-panel-field-settings-ajax_submit' );
			el.$cardButton = $( '#wpforms-add-fields-square' );
			el.$alert = $( '#wpforms-square-credit-card-alert' );
			el.$feeNotice = $( '.wpforms-square-notice-info' );

			app.bindUIActions();
			app.bindPlanUIActions();

			if ( ! wpforms_builder.square_is_pro ) {
				const baseSelector = '.wpforms-panel-content-section-square',
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
		 * Process various events.
		 *
		 * @since 1.9.5
		 */
		bindUIActions() {
			$( document ).on( 'wpformsSaved', app.ajaxRequiredCheck )
				.on( 'wpformsSaved', app.paymentsEnabledCheck )
				.on( 'wpformsSaved', app.requiredFieldsCheck )
				.on( 'wpformsFieldAdd', app.fieldAdded )
				.on( 'wpformsFieldDelete', app.fieldDeleted )
				.on( 'wpformsPaymentsPlanCreated', app.toggleMultiplePlansWarning )
				.on( 'wpformsPaymentsPlanCreated', app.bindPlanUIActions )
				.on( 'wpformsPaymentsPlanDeleted', app.toggleMultiplePlansWarning );

			el.$cardButton.on( 'click', app.connectionCheck );
		},

		/**
		 * Bind plan UI actions.
		 *
		 * @since 1.9.5
		 */
		bindPlanUIActions() {
			el.$panelContent.find( '.wpforms-panel-content-section-payment-plan-body .wpforms-panel-field-select select' ).on( 'change', app.resetRequiredPlanFieldError );
		},

		/**
		 * Notify user if AJAX submission is not required.
		 *
		 * @since 1.9.5
		 */
		ajaxRequiredCheck() {
			if ( ! $( '#wpforms-panel-fields .wpforms-field.wpforms-field-square' ).length ) {
				return;
			}

			if ( app.isAJAXSubmitEnabled() ) {
				return;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder.square_ajax_required,
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
			} );
		},

		/**
		 * Notify user if Square Payments are not enabled.
		 *
		 * @since 1.9.5
		 */
		paymentsEnabledCheck() {
			if ( ! $( '#wpforms-panel-fields .wpforms-field.wpforms-field-square' ).length ) {
				return;
			}

			if ( app.isPaymentsEnabled() ) {
				return;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder.square_payments_enabled_required,
				icon: 'fa fa-exclamation-circle',
				type: 'red',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
			} );
		},

		/**
		 * On form save notify users about required fields.
		 *
		 * @since 1.9.5
		 */
		requiredFieldsCheck() {
			if ( ! el.$recurringPaymentControl.is( ':checked' ) || el.$panelContent.hasClass( 'wpforms-hidden' ) ) {
				return;
			}

			let showAlert = false;

			el.$panelContent.find( '.wpforms-panel-content-section-payment-plan' ).each( function() {
				const $plan = $( this ),
					planId = $plan.data( 'plan-id' ),
					$emailField = $( `#wpforms-panel-field-square-recurring-${ planId }-customer_email` ),
					$nameField = $( `#wpforms-panel-field-square-recurring-${ planId }-customer_name` );

				if (
					! $emailField.val()
				) {
					$emailField.addClass( 'wpforms-required-field-error' );
					showAlert = true;
				}

				if (
					! $nameField.val()
				) {
					$nameField.addClass( 'wpforms-required-field-error' );
					showAlert = true;
				}
			} );

			if ( ! showAlert ) {
				return;
			}

			let alertMessage = wpforms_builder.square_recurring_payments_fields_required;

			if ( ! $( '.wpforms-panel-content-section-square' ).is( ':visible' ) ) {
				alertMessage += ' ' + wpforms_builder.square_recurring_payments_fields_settings;
			}

			$.alert( {
				title: wpforms_builder.square_recurring_payments_fields_heading,
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
					$( '.wpforms-square-settings-redirect' ).on( 'click', app.settingsRedirect );
				},
			} );
		},

		/**
		 * Redirect to the settings tab.
		 *
		 * @since 1.9.5
		 */
		settingsRedirect() {
			// Open the Square settings tab.
			$( '.wpforms-panel-payments-button' ).trigger( 'click' );
			$( '.wpforms-panel-sidebar-section-square' ).trigger( 'click' );

			// Scroll to the Stripe settings.
			window.location.href = window.location.pathname + window.location.search + '#wpforms-panel-field-square-enable_recurring-wrap';

			// Close the alert.
			$( this ).closest( '.jconfirm-box' ).find( '.btn-confirm' ).trigger( 'click' );
		},

		/**
		 * Maybe reset required recurring field error class.
		 *
		 * @since 1.9.5
		 */
		resetRequiredPlanFieldError() {
			const $nameAttr = $( this ).attr( 'name' );

			if ( ! $nameAttr.includes( 'customer_email' ) && ! $nameAttr.includes( 'customer_name' ) ) {
				return;
			}

			$( this ).toggleClass( 'wpforms-required-field-error', ! $( this ).val() );
		},

		// eslint-disable-next-line jsdoc/require-returns-check
		/**
		 * Notify user if Square connection are missing.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} False if button clicks should be prevented.
		 */
		connectionCheck() {
			if ( $( this ).hasClass( 'wpforms-add-fields-button-disabled' ) ) {
				return false;
			}

			if ( ! $( this ).hasClass( 'square-connection-required' ) ) {
				return true;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder.square_connection_required,
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
			} );
		},

		/**
		 * We have to do several actions when the "Square" field is added.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e    Event object.
		 * @param {number} id   Field ID.
		 * @param {string} type Field type.
		 */
		fieldAdded( e, id, type ) {
			if ( type === 'square' ) {
				app.cardButtonToggle( true );
				app.settingsToggle( true );
				app.paymentsEnabledCheck();
				el.$feeNotice.toggleClass( 'wpforms-hidden' );
			}
		},

		/**
		 * We have to do several actions for UI when the "Square" credit card field is deleted.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e    Event object.
		 * @param {number} id   Field ID.
		 * @param {string} type Field type.
		 */
		fieldDeleted( e, id, type ) {
			if ( type === 'square' ) {
				app.cardButtonToggle( false );
				app.settingsToggle( false );
				app.disablePayments();
				app.disableNotifications();
				el.$feeNotice.toggleClass( 'wpforms-hidden' );
			}
		},

		/**
		 * Toggles visibility of multiple plans warning.
		 *
		 * @since 1.9.5
		 */
		toggleMultiplePlansWarning() {
			el.$panelContent.find( '.wpforms-square-multiple-plans-warning' ).toggleClass( 'wpforms-hidden', el.$panelContent.find( '.wpforms-panel-content-section-payment-plan' ).length === 1 );
		},

		/**
		 * Enable or disable the "Square" field in the fields list.
		 *
		 * @since 1.9.5
		 *
		 * @param {boolean} isDisabled If true then a card button will be disabled.
		 */
		cardButtonToggle( isDisabled ) {
			el.$cardButton
				.prop( 'disabled', isDisabled )
				.toggleClass( 'wpforms-add-fields-button-disabled', isDisabled );
		},

		/**
		 * Toggle visibility of the Square payment settings.
		 *
		 * If the "Square" field has been added then reveal the settings,
		 * otherwise hide them.
		 *
		 * @since 1.9.5
		 *
		 * @param {boolean} display Show or hide settings.
		 */
		settingsToggle( display ) {
			if ( ! el.$alert.length ) {
				return;
			}

			el.$alert.toggleClass( 'wpforms-hidden', display );
			$( '#wpforms-panel-content-section-payment-square' ).toggleClass( 'wpforms-hidden', ! display );

			// Uncheck the Payments > Square > Enable Square Payments setting.
			if ( ! display ) {
				el.$singlePaymentControl.prop( 'checked', false ).trigger( 'change' );
				el.$recurringPaymentControl.prop( 'checked', false ).trigger( 'change' );
			}
		},

		/**
		 * Make sure that "One-Time Payments" and "Recurring Payments" toggles are turned off.
		 *
		 * @since 1.9.5
		 */
		disablePayments() {
			const toggleInput = $( '#wpforms-panel-field-square-enable_one_time, #wpforms-panel-field-square-enable_recurring' );

			toggleInput.prop( 'checked', false ).trigger( 'change' ).each( WPFormsBuilderPaymentsUtils.toggleContent );
		},

		/**
		 * Disable notifications.
		 *
		 * @since 1.9.5
		 */
		disableNotifications() {
			const $notificationWrap = $( '.wpforms-panel-content-section-notifications [id*="-square-wrap"]' );

			$notificationWrap.find( 'input[id*="-square"]' ).prop( 'checked', false );
			$notificationWrap.addClass( 'wpforms-hidden' );
		},

		/**
		 * Determine whether payments are enabled in the Payments > Square panel.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} Payments are enabled.
		 */
		isPaymentsEnabled() {
			return el.$singlePaymentControl.is( ':checked' ) || el.$recurringPaymentControl.is( ':checked' );
		},

		/**
		 * Determine whether AJAX form submission is enabled in the Settings > General.
		 *
		 * @since 1.9.5
		 *
		 * @return {boolean} AJAX form submission is enabled.
		 */
		isAJAXSubmitEnabled() {
			return el.$AJAXSubmitOption.is( ':checked' );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsBuilderSquare.init();
