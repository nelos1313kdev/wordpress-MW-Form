/* global wpforms_admin, WPFormsAdmin, wpf */

/**
 * WPForms Square settings function.
 *
 * @since 1.9.5
 */
const WPFormsSettingsSquare = window.WPFormsSettingsSquare || ( function( document, window, $ ) {
	/**
	 * Elements.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const $el = {
		sandboxModeCheckbox: $( '#wpforms-setting-square-sandbox-mode' ),
		sandboxConnectionStatusBlock: $( '#wpforms-setting-row-square-connection-status-sandbox' ),
		productionConnectionStatusBlock: $( '#wpforms-setting-row-square-connection-status-production' ),
		sandboxLocationBlock: $( '#wpforms-setting-row-square-location-id-sandbox' ),
		sandboxLocationStatusBlock: $( '#wpforms-setting-row-square-location-status-sandbox' ),
		productionLocationBlock: $( '#wpforms-setting-row-square-location-id-production' ),
		productionLocationStatusBlock: $( '#wpforms-setting-row-square-location-status-production' ),
		refreshBtn: $( '.wpforms-square-refresh-btn' ),
		copyButton: $( '#wpforms-setting-row-square-webhooks-endpoint-set .wpforms-copy-to-clipboard' ),
		webhooksEnableCheckbox: $( '#wpforms-setting-square-webhooks-enabled' ),
		webhookEndpointUrl: $( 'input#wpforms-square-webhook-endpoint-url' ),
		webhookMethod: $( 'input[name="square-webhooks-communication"]' ),
		webhookCommunicationStatusNotice: $( '#wpforms-setting-row-square-webhooks-communication-status' ),
		webhookConnectBtn: $( '#wpforms-setting-square-webhooks-connect' ),
		webhookConnectRow: $( '#wpforms-setting-row-square-webhooks-connect' ),
		webhookConnectStatusRow: $( '#wpforms-setting-row-square-webhooks-connect-status-production, #wpforms-setting-row-square-webhooks-connect-status-sandbox' ),
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
		 * Start the engine.
		 *
		 * @since 1.9.5
		 */
		init() {
			$( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.9.5
		 */
		ready() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.9.5
		 */
		events() {
			$el.sandboxModeCheckbox.on( 'change', app.credentialsFieldsDisplay );
			$el.refreshBtn.on( 'click', app.refreshTokensCallback );
			$el.webhooksEnableCheckbox.on( 'change', app.webhooksEnableCallback );
			$el.webhookConnectBtn.on( 'click', app.modals.displayWebhookConfigPopup );
			$el.webhookMethod.on( 'change', app.updateWebhookEndpointUrl );
			$el.copyButton.on( 'click', function( e ) {
				wpf.copyValueToClipboard( e, $( this ), $el.webhookEndpointUrl );
			} );
		},

		/**
		 * Update the endpoint URL.
		 *
		 * @since 1.9.5
		 */
		updateWebhookEndpointUrl() {
			const checked = $el.webhookMethod.filter( ':checked' ).val(),
				newUrl = wpforms_admin.square.webhook_urls[ checked ];

			$el.webhookEndpointUrl.val( newUrl );
			$el.webhookCommunicationStatusNotice.removeClass( 'wpforms-hide' );
		},

		/**
		 * Enable webhooks.
		 *
		 * @since 1.9.5
		 */
		webhooksEnableCallback() {
			$el.webhookConnectRow.toggleClass( 'wpforms-hide', ! $( this ).is( ':checked' ) );
			$el.webhookConnectStatusRow.toggleClass( 'wpforms-hide', ! $( this ).is( ':checked' ) );
		},

		/**
		 * Create a webhook.
		 *
		 * @since 1.9.5
		 *
		 * @param {string} token Personal access token.
		 *
		 * @return {Promise} Promise an object.
		 */
		createWebhook( token ) {
			return new Promise( ( resolve, reject ) => {
				$.ajax( {
					url: wpforms_admin.ajax_url,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'wpforms_square_create_webhook',
						nonce: wpforms_admin.nonce,
						token,
					},
					success( response ) {
						if ( response.success ) {
							resolve( response );

							return;
						}

						reject( response );
					},
					error() {
						reject( { success: false, message: 'An error occurred.' } );
					},
				} );
			} );
		},

		/**
		 * Refresh tokens.
		 *
		 * @since 1.9.5
		 */
		refreshTokensCallback() {
			const $btn = $( this );
			const buttonWidth = $btn.outerWidth();
			const buttonLabel = $btn.text();
			const settings = {
				url: wpforms_admin.ajax_url,
				type: 'post',
				dataType: 'json',
				data: {
					action: 'wpforms_square_refresh_connection',
					nonce: wpforms_admin.nonce,
					mode: $btn.data( 'mode' ),
				},
				beforeSend() {
					$btn.css( 'width', buttonWidth ).html( WPFormsAdmin.settings.iconSpinner ).prop( 'disabled', true );
				},
			};

			let errorMessage = wpforms_admin.square.refresh_error;

			// Perform an Ajax request.
			$.ajax( settings )
				.done( function( response ) {
					if ( response.success ) {
						$btn
							.css( 'pointerEvents', 'none' )
							.removeClass( 'wpforms-btn-light-grey' )
							.addClass( 'wpforms-btn-grey' )
							.html( 'Refreshed!' );

						$btn.closest( 'form' ).css( 'cursor', 'wait' );

						window.location = $btn.data( 'url' );

						return;
					}

					if (
						Object.prototype.hasOwnProperty.call( response, 'data' ) &&
						response.data !== ''
					) {
						errorMessage = response.data;
					}

					$btn
						.css( 'width', 'auto' )
						.html( buttonLabel )
						.prop( 'disabled', false );
					app.modals.refreshTokensError( errorMessage );
				} )
				.fail( function() {
					$btn
						.css( 'width', 'auto' )
						.html( buttonLabel )
						.prop( 'disabled', false );
					app.modals.refreshTokensError( errorMessage );
				} );
		},

		/**
		 * Conditionally show Square mode switch warning.
		 *
		 * @since 1.9.5
		 */
		credentialsFieldsDisplay() {
			const sandboxModeEnabled = $el.sandboxModeCheckbox.is( ':checked' );

			if ( sandboxModeEnabled ) {
				$el.sandboxConnectionStatusBlock.show();
				$el.sandboxLocationBlock.show();
				$el.sandboxLocationStatusBlock.show();

				$el.productionConnectionStatusBlock.hide();
				$el.productionLocationBlock.hide();
				$el.productionLocationStatusBlock.hide();
			} else {
				$el.sandboxConnectionStatusBlock.hide();
				$el.sandboxLocationBlock.hide();
				$el.sandboxLocationStatusBlock.hide();

				$el.productionConnectionStatusBlock.show();
				$el.productionLocationBlock.show();
				$el.productionLocationStatusBlock.show();
			}

			if ( sandboxModeEnabled && $el.sandboxConnectionStatusBlock.find( '.wpforms-square-connected' ).length ) {
				return;
			}

			if ( ! sandboxModeEnabled && $el.productionConnectionStatusBlock.find( '.wpforms-square-connected' ).length ) {
				return;
			}

			app.modals.modeChangedWarning();
		},

		/**
		 * Modals.
		 *
		 * @since 1.9.5
		 */
		modals: {

			/**
			 * Show the warning modal when Square mode is changed.
			 *
			 * @since 1.9.5
			 */
			modeChangedWarning() {
				$.alert( {
					title: wpforms_admin.heads_up,
					content: wpforms_admin.square.mode_update,
					icon: 'fa fa-exclamation-circle',
					type: 'orange',
					buttons: {
						confirm: {
							text: wpforms_admin.ok,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
						},
					},
				} );
			},

			/**
			 * Refresh tokens error handling.
			 *
			 * @since 1.9.5
			 *
			 * @param {string} error Error message.
			 */
			refreshTokensError( error ) {
				$.alert( {
					title: false,
					content: error,
					icon: 'fa fa-exclamation-circle',
					type: 'orange',
					buttons: {
						confirm: {
							text: wpforms_admin.ok,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
						},
					},
				} );
			},

			/**
			 * Show popup with the ability to register a new webhook route or retrieve existing one.
			 *
			 * @since 1.9.5
			 */
			// eslint-disable-next-line max-lines-per-function
			displayWebhookConfigPopup() {
				$.confirm( {
					title: wpforms_admin.square.webhook_create_title,
					content: wpforms_admin.square.webhook_create_description +
						'<input type="text" id="wpforms-square-personal-access-token" placeholder="' + wpforms_admin.square.webhook_token_placeholder + '" value="">' +
						'<p class="wpforms-square-webhooks-connect-error error" style="display:none;">' + wpforms_admin.square.token_is_required + '</p>',
					icon: 'fa fa-info-circle',
					type: 'blue',
					buttons: {
						confirm: {
							text: wpforms_admin.ok,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
							action() {
								const modal = this;
								const tokenField = modal.$content.find( '#wpforms-square-personal-access-token' );
								const errorMsg = modal.$content.find( '.error' );
								const token = tokenField.val().trim();
								const title = modal.$title;

								// Disable the button to prevent multiple clicks.
								$el.webhookConnectBtn.addClass( 'inactive' );

								// Reset error message before validation
								errorMsg.hide().text( '' );

								if ( token === '' ) {
									errorMsg.text( wpforms_admin.square.token_is_required ).show();
									return false; // Prevent modal from closing.
								}

								// Show loading indicator.
								modal.buttons.confirm.setText( wpforms_admin.loading );
								modal.buttons.confirm.disable();

								// Call API.
								app.createWebhook( token )
									.then( ( response ) => {
										modal.setContent( '<p>' + response.data.message + '</p>' );
										// Hide OK button and rename Cancel to Close.
										modal.buttons.confirm.hide();
										title.text( '' ).hide();
										modal.buttons.cancel.setText( wpforms_admin.close );

										// Ensure user can manually close the modal.
										modal.buttons.cancel.action = function() {
											window.location.reload();
										};
									} )
									.catch( ( responseError ) => {
										errorMsg.text( responseError.data.message ).show();

										// Re-enable confirm button for retrying.
										modal.buttons.confirm.setText( wpforms_admin.ok );
										modal.buttons.confirm.enable();
									} );

								return false; // Prevent modal from closing immediately.
							},
						},
						cancel: {
							text: wpforms_admin.cancel,
							action() {
								// Re-enable the button.
								$el.webhookConnectBtn.removeClass( 'inactive' );

								this.close();
							},
						},
					},
				} );
			},
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsSettingsSquare.init();
