/* global wpf, WPFormsBuilder, WPFormsConstantContactV3AuthVars */

/**
 * @param window.wpforms_admin
 * @param window.wpforms_builder
 * @param WPFormsConstantContactV3AuthVars.auth_url
 */

/**
 * WPForms Constant Contact V3 Popup.
 *
 * @since 1.9.3
 */
const WPFormsConstantContactV3Auth = window.WPFormsConstantContactV3Auth || ( function( document, window, $ ) {
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.3
	 *
	 * @type {Object}
	 */
	const app = {
		/**
		 * Is the authorization window opened?
		 *
		 * @since 1.9.3
		 */
		isOpened : false,

		/**
		 * URL to listen for messages from the window.
		 *
		 * @since 1.9.3
		 */
		listenURL: '',

		/**
		 * Start the engine.
		 *
		 * @since 1.9.3
		 */
		init: () => {
			$( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.9.3
		 */
		ready: () => {
			const redirectUri = new URL( WPFormsConstantContactV3AuthVars.auth_url ).searchParams.get( 'redirect_uri' );
			app.listenURL = new URL( redirectUri ).origin;

			$( document )
				.on( 'click', '.wpforms-constant-contact-v3-auth, .wpforms-builder-constant-contact-v3-provider-sign-up', app.showWindow )
				.on( 'click', '#wpforms-settings-constant-contact-v3-migration-prompt-link', app.promptMigration );
		},

		/**
		 * Show a window.
		 *
		 * @since 1.9.3
		 *
		 * @param {Event} e Click event.
		 */
		showWindow: ( e ) => {
			e.preventDefault();

			if ( app.isOpened ) {
				return;
			}

			const authUrl = WPFormsConstantContactV3AuthVars.auth_url,
				width = 500,
				height = 600,
				left = ( screen.width / 2 ) - ( width / 2 ),
				top = ( screen.height / 2 ) - ( height / 2 ),
				loginHintEmail = $( '.wpforms-constant-contact-v3-auth' ).data( 'login-hint' ),
				url = new URL( authUrl );

			if ( loginHintEmail ) {
				url.searchParams.set( 'login_hint', loginHintEmail );
			}

			const newWindow = window.open(
				url.toString(),
				'authPopup',
				'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left
			);

			window.addEventListener( 'message', app.listenResponse );
			const checkWindowClosed = setInterval( () => {
				if ( newWindow.closed ) {
					clearInterval( checkWindowClosed );
					app.isOpened = false;
				}
			}, 1000 );

			app.isOpened = true;
		},

		/**
		 * Listen for response.
		 *
		 * @since 1.9.3
		 *
		 * @param {Event} event Message event.
		 */
		listenResponse: ( event ) => {
			if ( event.origin !== app.listenURL ) {
				return;
			}

			if ( ! event.data ) {
				app.errorModal( WPFormsConstantContactV3AuthVars.strings.error );

				return;
			}

			app.saveAccount( event.data );
		},

		/**
		 * Save account.
		 *
		 * @since 1.9.3
		 *
		 * @param {string} code Authorization code.
		 */
		saveAccount: ( code ) => {
			const modal = app.waitModal();

			$.post(
				WPFormsConstantContactV3AuthVars.ajax_url,
				{
					action: 'wpforms_constant_contact_popup_auth',
					data:   JSON.stringify( { code } ),
					nonce: WPFormsConstantContactV3AuthVars.nonce,
				}
			)
				.done( ( response ) => {
					if ( ! response.success ) {
						modal.close();

						const errorMessage =
							'<p>' + WPFormsConstantContactV3AuthVars.strings.error + '</p><p><strong>' + wpf.sanitizeHTML( response.data ) + '</strong></p>';

						app.errorModal( errorMessage );

						return;
					}

					if ( typeof WPFormsBuilder === 'undefined' ) {
						modal.close();
						window.location.href = WPFormsConstantContactV3AuthVars.page_url;

						return;
					}

					WPFormsBuilder.formSave( false ).done( () => {
						WPFormsBuilder.setCloseConfirmation( false );
						WPFormsBuilder.showLoadingOverlay();
						location.reload();
					} );
				} );
		},

		/**
		 * Show a waiting modal.
		 *
		 * @since 1.9.3
		 *
		 * @return {Object} Modal object.
		 */
		waitModal: () => {
			return $.alert( {
				title: '',
				content: WPFormsConstantContactV3AuthVars.strings.wait,
				icon: 'fa fa-info-circle',
				type: 'blue',
				buttons: false,
			} );
		},

		/**
		 * Show an error modal.
		 *
		 * @since 1.9.3
		 *
		 * @param {string} content Alert text.
		 *
		 * @return {Object} Modal object.
		 */
		errorModal: ( content ) => {
			const strings = window?.wpforms_builder || window?.wpforms_admin;

			return $.alert( {
				title: strings.uh_oh,
				content,
				icon: 'fa fa-exclamation-circle',
				type: 'red',
				buttons: {
					cancel: {
						text: strings.cancel,
						action: () => {
							app.isOpened = false;
						},
					},
				},
			} );
		},

		/**
		 * Prompt and start migration from v2 to v3 in the notice.
		 *
		 * @since 1.9.3
		 *
		 * @param {Object} e Event object.
		 */
		promptMigration( e ) {
			e.preventDefault();

			const modal = app.waitModal();

			$.post( {
				url: WPFormsConstantContactV3AuthVars.ajax_url,
				data: {
					action: 'wpforms_constant_contact_migration_prompt',
					nonce: WPFormsConstantContactV3AuthVars.nonce,
				},
				success: () => {
					modal.close();
					window.location.href = WPFormsConstantContactV3AuthVars.page_url;
				},
				error: () => {
					modal.close();
					app.errorModal( WPFormsConstantContactV3AuthVars.strings.error );
				},
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsConstantContactV3Auth.init();
