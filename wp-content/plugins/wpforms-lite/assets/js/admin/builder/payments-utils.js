/* global wpforms_builder, wpforms_builder_payments_utils */

// eslint-disable-next-line no-unused-vars
const WPFormsBuilderPaymentsUtils = window.WPFormsBuilderPaymentsUtils || ( function( document, window, $ ) {
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Toggle payments content.
		 *
		 * @since 1.9.5
		 */
		// eslint-disable-next-line complexity
		toggleContent() {
			const $input = $( this ),
				$paymentSettings = $input.closest( '.wpforms-payment-settings' );

			if (
				$paymentSettings.find( '.wpforms-panel-content-section-payment-toggle-one-time .wpforms-toggle-control > input' ).is( ':checked' ) &&
				$paymentSettings.find( '.wpforms-panel-content-section-payment-toggle-recurring .wpforms-toggle-control > input' ).is( ':checked' )
			) {
				$input.prop( 'checked', false );

				$.alert( {
					title: wpforms_builder.heads_up,
					content: $input.attr( 'name' ).includes( 'enable_recurring' ) ? wpforms_builder_payments_utils.payments_disabled_recurring : wpforms_builder_payments_utils.payments_disabled_one_time,
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
			}

			const $wrapper = $input.closest( '.wpforms-panel-content-section-payment' ),
				isChecked = $input.prop( 'checked' ) && ! $( '#wpforms-panel-field-settings-disable_entries' ).prop( 'checked' );

			$wrapper.find( '.wpforms-panel-content-section-payment-toggled-body' ).toggle( isChecked );
			$wrapper.toggleClass( 'wpforms-panel-content-section-payment-open', isChecked );
		},

		/**
		 * Check a plan name on empty value.
		 *
		 * @since 1.9.5
		 */
		checkPlanName() {
			const $input = $( this ),
				$plan = $input.closest( '.wpforms-panel-content-section-payment-plan' ),
				$planName = $plan.find( '.wpforms-panel-content-section-payment-plan-head-title' );

			if ( $input.val() ) {
				$planName.html( $input.val() );

				return;
			}

			const defaultValue = wpforms_builder_payments_utils.payments_plan_placeholder;

			$planName.html( defaultValue );
			$input.val( defaultValue );
		},

		/**
		 * Toggle a plan content.
		 *
		 * @since 1.9.5
		 */
		togglePlan() {
			const $plan = $( this ).closest( '.wpforms-panel-content-section-payment-plan' ),
				$icon = $plan.find( '.wpforms-panel-content-section-payment-plan-head-buttons-toggle' );

			$icon.toggleClass( 'fa-chevron-circle-up fa-chevron-circle-down' );
			$plan.find( '.wpforms-panel-content-section-payment-plan-body' ).toggle( $icon.hasClass( 'fa-chevron-circle-down' ) );
		},

		/**
		 * Delete a plan.
		 *
		 * @since 1.9.5
		 */
		deletePlan() {
			// Trigger a warning modal when trying to delete a single plan without pro addon.
			$( this ).closest( '.wpforms-panel-content-section-payment' ).find( '.wpforms-panel-content-section-payment-button-add-plan' ).trigger( 'click' );
		},

		/**
		 * Rename a plan.
		 *
		 * @since 1.9.5
		 */
		renamePlan() {
			const $input = $( this ),
				$plan = $input.closest( '.wpforms-panel-content-section-payment-plan' ),
				$planName = $plan.find( '.wpforms-panel-content-section-payment-plan-head-title' );

			if ( ! $input.val() ) {
				$planName.html( '' );

				return;
			}

			$planName.html( $input.val() );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );
