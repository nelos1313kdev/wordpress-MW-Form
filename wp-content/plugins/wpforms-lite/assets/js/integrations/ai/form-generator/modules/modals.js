/* global wpforms_ai_form_generator, wpf, WPFormsBuilder, wpforms_builder */

/**
 * @param strings.addonsAction
 * @param strings.addonsData
 * @param strings.addons.installTitle
 * @param strings.addons.installContent
 * @param strings.addons.activateContent
 * @param strings.addons.installButton
 * @param strings.addons.installConfirmButton
 * @param strings.addons.activateConfirmButton
 * @param strings.addons.cancelButton
 * @param strings.addons.dontShow
 * @param strings.addons.dismissErrorTitle
 * @param strings.addons.dismissError
 * @param strings.addons.addonsInstalledTitle
 * @param strings.addons.addonsActivatedTitle
 * @param strings.addons.addonsInstalledContent
 * @param strings.addons.okay
 * @param strings.addons.addonsInstallErrorTitle
 * @param strings.addons.addonsActivateErrorTitle
 * @param strings.addons.addonsInstallError
 * @param strings.addons.addonsInstallErrorNetwork
 * @param strings.adminNonce
 * @param strings.misc.warningExistingForm
 * @param this.$$confirm
 * @param this.$$cancel
 */

/**
 * The WPForms AI form generator app.
 *
 * Modal windows' module.
 *
 * @since 1.9.2
 *
 * @param {Object} generator The AI form generator.
 * @param {Object} $         jQuery function.
 *
 * @return {Object} The preview module object.
 */
export default function( generator, $ ) { // eslint-disable-line max-lines-per-function
	/**
	 * Localized strings.
	 *
	 * @since 1.9.2
	 *
	 * @type {Object}
	 */
	const strings = wpforms_ai_form_generator;

	/**
	 * The preview module object.
	 *
	 * @since 1.9.2
	 */
	const modals = {
		/**
		 * DOM elements.
		 *
		 * @since 1.9.2
		 */
		el: {},

		/**
		 * AJAX error debug string.
		 *
		 * @since 1.9.2
		 */
		ajaxError: 'Form Generator AJAX error:',

		/**
		 * Init generator.
		 *
		 * @since 1.9.2
		 */
		init() {
			modals.el.$doc = $( document );
			modals.el.$templateCard = $( '#wpforms-template-generate' );

			modals.events();
		},

		/**
		 * Register events.
		 */
		events() {
			modals.el.$doc.on( 'change', '.wpforms-ai-forms-install-addons-modal-dismiss', modals.dismissAddonsModal );
		},

		/**
		 * Open the addons modal.
		 *
		 * @since 1.9.2
		 *
		 * @param {Object} e Event object.
		 */
		openAddonsModal( e ) { // eslint-disable-line max-lines-per-function
			e?.preventDefault();

			const spinner = '<i class="wpforms-loading-spinner wpforms-loading-white wpforms-loading-inline"></i>';
			const isInstall = strings.addonsAction === 'install';
			const content = isInstall ? strings.addons.installContent : strings.addons.activateContent;

			const options = {
				title: strings.addons.installTitle,
				content,
				type: 'purple',
				icon: 'fa fa-info-circle',
				buttons: {
					confirm: {
						text: isInstall ? strings.addons.installConfirmButton : strings.addons.activateConfirmButton,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
						action() {
							const label = isInstall ? strings.addons.installing : strings.addons.activating;

							this.$$confirm.prop( 'disabled', true ).html( spinner + label );
							this.$$cancel.prop( 'disabled', true );

							modals.installAddonsAjax( this );

							return false;
						},
					},
					cancel: {
						text: strings.addons.cancelButton,
						keys: [ 'esc' ],
						btnClass: 'btn-cancel',
						action() {
							modals.updateGenerateFormButton( false );

							// Open the Form Generator panel.
							setTimeout( () => {
								generator.state.panelOpen = true;
							}, 250 );
						},
					},
				},
				onOpenBefore() {
					// Add the checkbox to the modal.
					const dontShowAgain = `
						<label class="jconfirm-checkbox">
							<input type="checkbox" class="jconfirm-checkbox-input wpforms-ai-forms-install-addons-modal-dismiss">
							${ strings.addons.dontShow }
						</label>
					`;

					this.$body
						.addClass( 'wpforms-ai-forms-install-addons-modal' )
						.find( '.jconfirm-buttons' )
						.after( dontShowAgain );
				},
			};

			$.confirm( options );
		},

		/**
		 * Install required addons AJAX.
		 *
		 * @since 1.9.2
		 *
		 * @param {Object} previousModal Previous modal instance.
		 */
		installAddonsAjax( previousModal ) { // eslint-disable-line max-lines-per-function
			let chain = null;
			let errorDisplayed = false;

			const postDone = function( res ) {
				if ( ! res.success ) {
					wpf.debug( modals.ajaxError, res.data.error ?? res.data );
				}

				if ( ! res.success && ! errorDisplayed ) {
					errorDisplayed = true;

					modals.openErrorModal( {
						title: strings.addonsAction === 'install' ? strings.addons.addonsInstallErrorTitle : strings.addons.addonsActivateErrorTitle,
						content: strings.addons.addonsInstallError,
					} );
				}
			};

			const postFail = function( xhr ) {
				if ( errorDisplayed ) {
					return;
				}

				const error = xhr.responseText || strings.addons.addonsInstallErrorNetwork;
				let content = strings.addons.addonsInstallError;

				content += error && error !== 'error' ? '<br>' + error : '';

				wpf.debug( modals.ajaxError, content );

				modals.openErrorModal( {
					title: strings.addonsAction === 'install' ? strings.addons.addonsInstallErrorTitle : strings.addons.addonsActivateErrorTitle,
					content,
				} );

				errorDisplayed = true;
			};

			// Do not display the alert about unsaved changes.
			WPFormsBuilder.setCloseConfirmation( false );

			// Loop through all addons and make a chained AJAX calls.
			for ( const slug in strings.addonsData ) {
				const url = strings.addonsData[ slug ]?.url;
				const data = {
					action: url ? 'wpforms_install_addon' : 'wpforms_activate_addon',
					nonce : strings.adminNonce,
					plugin: url ? url : strings.addonsData[ slug ]?.path,
					type  : 'addon',
				};

				if ( chain === null ) {
					chain = $.post( strings.ajaxUrl, data, postDone );
				} else {
					chain = chain.then( () => {
						return $.post( strings.ajaxUrl, data, postDone );
					} );
				}

				chain.fail( postFail );
			}

			// Open the Addons Installed modal after the last AJAX call.
			chain
				.then( () => {
					if ( ! errorDisplayed ) {
						modals.openAddonsInstalledModal();
					}
				} )
				.always( () => {
					previousModal.close();
					modals.updateGenerateFormButton( false );
				} );
		},

		/**
		 * Dismiss or de-dismiss element.
		 *
		 * @since 1.9.2
		 */
		dismissAddonsModal() {
			const $checkbox = $( this );
			const isChecked = $checkbox.prop( 'checked' );

			const data = {
				action: 'wpforms_dismiss_ai_form',
				nonce: strings.nonce,
				element: 'install-addons-modal',
				dismiss: isChecked,
			};

			modals.updateGenerateFormButton( ! isChecked );

			$.post( strings.ajaxUrl, data )
				.done( function( res ) {
					if ( res.success ) {
						return;
					}

					modals.openErrorModal( {
						title: strings.addons.dismissErrorTitle,
						content: strings.addons.dismissError,
					} );

					wpf.debug( modals.ajaxError, res.data.error ?? res.data );
				} )
				.fail( function( xhr ) {
					modals.openErrorModal( {
						title: strings.addons.dismissErrorTitle,
						content: strings.addons.dismissError + '<br>' + strings.addons.addonsInstallErrorNetwork,
					} );

					wpf.debug( modals.ajaxError, xhr.responseText ?? xhr.statusText );
				} );
		},

		/**
		 * Update the Generate Form button to enable/disable install addons modal window.
		 *
		 * @since 1.9.2
		 *
		 * @param {boolean} shouldInstallAddons Should open install addons modal.
		 */
		updateGenerateFormButton( shouldInstallAddons ) {
			if ( shouldInstallAddons ) {
				$( '.wpforms-template-generate' )
					.removeClass( 'wpforms-template-generate' )
					.addClass( 'wpforms-template-generate-install-addons' );
			} else {
				$( '.wpforms-template-generate-install-addons' )
					.removeClass( 'wpforms-template-generate-install-addons' )
					.addClass( 'wpforms-template-generate' );
			}
		},

		/**
		 * Open the Addons Installed modal.
		 *
		 * @since 1.9.2
		 */
		openAddonsInstalledModal() {
			const options = {
				title: strings.addonsAction === 'install' ? strings.addons.addonsInstalledTitle : strings.addons.addonsActivatedTitle,
				content: strings.addons.addonsInstalledContent,
				icon: 'fa fa-check-circle',
				type: 'green',
				buttons: {
					confirm: {
						text: strings.addons.okay,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
						action() {
							WPFormsBuilder.showLoadingOverlay();
							window.location = window.location + '&ai-form';
						},
					},
				},
				onOpenBefore() {
					this.$body
						.addClass( 'wpforms-ai-forms-addons-installed-modal' );
				},
			};

			$.confirm( options );
		},

		/**
		 * Warning for the existing form.
		 *
		 * @since 1.9.2
		 *
		 * @param {jQuery} $button The "Use This Form" button.
		 */
		openExistingFormModal( $button ) {
			$.confirm( {
				title: wpforms_builder.heads_up,
				content: strings.misc.warningExistingForm,
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				buttons: {
					confirm: {
						text: wpforms_builder.ok,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
						action() {
							generator.main.useFormAjax( $button );
						},
					},
					cancel: {
						text: wpforms_builder.cancel,
					},
				},
			} );
		},

		/**
		 * Open the error modal.
		 *
		 * @since 1.9.2
		 *
		 * @param {Object} args Arguments.
		 */
		openErrorModal( args ) {
			const options = {
				title: args.title ?? false,
				content: args.content ?? false,
				icon: 'fa fa-exclamation-circle',
				type: 'red',
				buttons: {
					confirm: {
						text: strings.addons.okay,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
					},
				},
			};

			$.confirm( options );
		},
	};

	return modals;
}
