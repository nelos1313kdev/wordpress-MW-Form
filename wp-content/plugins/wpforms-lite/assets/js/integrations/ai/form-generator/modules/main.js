/* global wpf, wpforms_ai_form_generator, wpforms_ai_chat_element, WPFormsBuilder, wpforms_builder, WPFormsChallenge */

/**
 * @param strings.panel.backToTemplates
 * @param strings.panel.emptyStateDesc
 * @param strings.panel.emptyStateTitle
 * @param strings.templateCard.buttonTextContinue
 * @param wpforms_ai_chat_element.forms.responseHistory
 * @param wpforms_builder.template_slug
 */

/**
 * The WPForms AI form generator app.
 *
 * Main module.
 *
 * @since 1.9.2
 *
 * @param {Object} generator The AI form generator.
 * @param {Object} $         jQuery function.
 *
 * @return {Object} The main module object.
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
	 * The main module object.
	 *
	 * @since 1.9.2
	 */
	const main = {
		/**
		 * DOM elements.
		 *
		 * @since 1.9.2
		 */
		el: {},

		/**
		 * Init generator.
		 *
		 * @since 1.9.2
		 */
		init() {
			main.initState();
			main.initElementsCache();
			main.initStateProxy();

			// Magic, we just need to set the state property to `true` to add the panel to the DOM.
			generator.state.panelAdd = true;

			generator.preview.init();
			generator.modals.init();
			main.events();
		},

		/**
		 * Init generator state.
		 *
		 * @since 1.9.2
		 */
		initState() {
			generator.state = {
				formId: $( '#wpforms-builder-form' ).data( 'id' ),
				panelAdd: false,
				panelOpen: false,
				chatStart: false,
				aiResponse: null,
			};
		},

		/**
		 * Events.
		 *
		 * @since 1.9.2
		 */
		events() {
			// Setup panel events.
			main.el.$setupPanel
				.on( 'click', '.wpforms-template-generate', main.event.clickGenerateFormBtn )
				.on( 'click', '.wpforms-template-generate-install-addons', generator.modals.openAddonsModal );

			// Generator panel events.
			main.el.$generatorPanel
				.on( 'click', '.wpforms-btn-back-to-templates', main.event.clickBackToTemplatesBtn )
				.on( 'click', '.wpforms-ai-chat-reload-link', main.event.reloadPage )
				.on( 'click', '.wpforms-ai-chat-use-form', main.event.useForm );

			// The Form Builder events
			main.el.$builder
				.on( 'wpformsPanelSwitch', main.event.panelSwitch );

			// AI chat events.
			main.el.$doc
				.on( 'wpformsBuilderReady', main.maybeOpenPanel )
				.on( 'wpformsAIChatBeforeAddAnswer', main.event.chatBeforeAddAnswer )
				.on( 'wpformsAIChatAddedAnswer', main.event.chatAddedAnswer )
				.on( 'wpformsAIChatAfterRefresh', main.event.chatAfterRefresh )
				.on( 'wpformsAIChatSetActiveAnswer', main.event.chatSetActiveAnswer );
		},

		/**
		 * Init elements cache.
		 *
		 * @since 1.9.2
		 */
		initElementsCache() {
			// Cache DOM elements.
			main.el.$doc = $( document );
			main.el.$builder = $( '#wpforms-builder' );
			main.el.$builderToolbar = $( '#wpforms-builder .wpforms-toolbar' );
			main.el.$templatesList = $( '#wpforms-setup-templates-list .list' ); // The templates list container.
			main.el.$templateCard = $( '#wpforms-template-generate' ); // The generator template card.
			main.el.$generatorPanel = $( '#wpforms-panel-ai-form' ); // The generator panel.
			main.el.$setupPanel = $( '#wpforms-panel-setup' ); // The Setup panel.
			main.el.$panelsContainer = $( '.wpforms-panels' ); // All panels container.
			main.el.$allPanels = $( '.wpforms-panel' ); // All panels.
			main.el.$chat = main.el.$generatorPanel.find( 'wpforms-ai-chat .wpforms-ai-chat' ); // The chat container.
		},

		/**
		 * Init state proxy.
		 *
		 * @since 1.9.2
		 */
		initStateProxy() {
			generator.state = new Proxy( generator.state, {
				set( state, key, value ) {
					// Set the state property.
					state[ key ] = value;

					if ( typeof main.setStateHandler[ key ] !== 'function' ) {
						return true;
					}

					// Run the set state property handler.
					main.setStateHandler[ key ]( value );

					// Debug log.
					wpf.debug( 'Form Generator state changed:', key, '=', value );

					return true;
				},
			} );
		},

		/**
		 * Event handlers
		 *
		 * @since 1.9.2
		 */
		event: {
			/**
			 * Click on the `Generate Form` button.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			clickGenerateFormBtn( e ) {
				e.preventDefault();

				if ( $( this ).hasClass( 'wpforms-prevent-default' ) ) {
					return;
				}

				// Open the Form Generator panel.
				generator.state.panelOpen = true;
			},

			/**
			 * Click on the `Back to Templates` button.
			 *
			 * @since 1.9.2
			 */
			clickBackToTemplatesBtn() {
				// Close the Form Generator panel.
				generator.state.panelOpen = false;
			},

			/**
			 * Before adding the answer to the chat.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			chatBeforeAddAnswer( e ) {
				// Store the AI response data in state.
				generator.state.aiResponse = e.originalEvent.detail?.response;
				generator.state.aiResponseHistory = generator.state.aiResponseHistory || {};
				generator.state.aiResponseHistory[ generator.state.aiResponse?.responseId ] = generator.state.aiResponse;
			},

			/**
			 * The answer added to the chat.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			chatAddedAnswer( e ) {
				const chat = e.originalEvent.detail?.chat || {};

				// Set chatStart state.
				if ( chat?.sessionId && ! generator.state.chatStart ) {
					generator.state.chatStart = true;
				}
			},

			/**
			 * Refresh the chat triggered.
			 *
			 * @since 1.9.2
			 */
			chatAfterRefresh() {
				generator.preview.clear();
			},

			/**
			 * Set active answer. Switch form preview to the active answer.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			chatSetActiveAnswer( e ) {
				generator.state.aiResponse = generator.state.aiResponseHistory[ e.originalEvent.detail?.responseId ];
			},

			/**
			 * Click on the "use this form" button.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			useForm( e ) {
				e?.preventDefault();

				const $button = $( this );
				const formId = generator.state.formId;

				if ( ! formId || wpforms_builder.template_slug === 'generate' ) {
					main.useFormAjax( $button );
				} else {
					generator.modals.openExistingFormModal( $button );
				}
			},

			/**
			 * Click on the "reload" link.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} e Event object.
			 */
			reloadPage( e ) {
				e?.preventDefault();
				window.location = window.location + '&ai-form';
			},

			/**
			 * Switch the Form Builder panel.
			 *
			 * @since 1.9.2
			 */
			panelSwitch() {
				generator.state.panelOpen = false;
			},
		},

		/**
		 * Set state property handlers.
		 *
		 * Each handler runs when the appropriate state property was set.
		 * For example, when `panelAdd` state property was set, the `setStateHandler.panelAdd()` handler will run.
		 *
		 * @since 1.9.2
		 */
		setStateHandler: {
			/**
			 * `panelAdd` state handler.
			 *
			 * When the value is `true`, the panel will be added to the DOM, otherwise removed.
			 *
			 * @since 1.9.2
			 *
			 * @param {boolean} value The state value.
			 */
			panelAdd( value ) {
				// Remove the panel from DOM.
				if ( ! value ) {
					main.el.$generatorPanel?.remove();

					return;
				}

				// The panel already added, no need to add again.
				if ( main.el.$generatorPanel?.length ) {
					return;
				}

				// Add panel to DOM.
				main.el.$panelsContainer.append( main.render.generatorPanel() );

				// Cache elements.
				main.el.$generatorPanel = $( '#wpforms-panel-ai-form' );
				main.el.$chat = main.el.$generatorPanel.find( 'wpforms-ai-chat .wpforms-ai-chat' );
			},

			/**
			 * Panel open state handler.
			 *
			 * @since 1.9.2
			 *
			 * @param {boolean} value The state value.
			 */
			panelOpen( value ) {
				main.el.$generatorPanel.toggleClass( 'active', value );
				main.el.$templateCard.addClass( 'selected' );
				main.setToolbarState( value );

				// Freeze/unfreeze the Challenge.
				window.WPFormsChallenge?.core.freezeChallenge( value, strings.misc.frozenChallengeTooltip );
				$( 'body' ).toggleClass( 'wpforms-ai-form-generator-active', value );

				if (
					generator.state.aiResponseHistory ||
					! wpforms_ai_chat_element.forms.responseHistory
				) {
					return;
				}

				// Update the response history if it exists.
				generator.state.aiResponseHistory = wpforms_ai_chat_element.forms.responseHistory;

				const $activeResponse = main.el.$chat.find( '.wpforms-chat-item-answer.active' );
				const activeResponseId = $activeResponse.data( 'response-id' );

				generator.state.aiResponse = generator.state.aiResponseHistory[ activeResponseId ];

				// Scroll to the active response.
				$activeResponse[ 0 ].scrollIntoView( { behavior: 'smooth', block: 'end' } );
			},

			/**
			 * Chat start state handler.
			 *
			 * @since 1.9.2
			 *
			 * @param {boolean} value The state value.
			 */
			chatStart( value ) {
				if ( ! value ) {
					return;
				}

				// Update the generator template card button text.
				main.el.$templateCard
					.addClass( 'selected' )
					.find( '.wpforms-template-generate' )
					.text( strings.templateCard.buttonTextContinue );
			},

			/**
			 * AI response state handler.
			 *
			 * @since 1.9.2
			 *
			 * @param {Object} response The response data.
			 */
			aiResponse( response ) {
				if ( ! response ) {
					return;
				}

				// Update the preview.
				generator.preview.update();
			},

			/**
			 * Is the form preview update in progress.
			 *
			 * @since 1.9.2
			 *
			 * @param {boolean} value Flag value.
			 */
			isPreviewUpdate( value ) {
				main.el.$chat.toggleClass( 'wpforms-ai-chat-inactive', value );
			},
		},

		/**
		 * HTML renderers.
		 *
		 * @since 1.9.2
		 */
		render: {
			/**
			 * Render generator panel HTML.
			 *
			 * @since 1.9.2
			 *
			 * @return {string} The panel markup.
			 */
			generatorPanel() {
				return `
					<div class="wpforms-panel wpforms-panel-fields" id="wpforms-panel-ai-form">
						<div class="wpforms-panel-sidebar-content">
							<div class="wpforms-panel-sidebar">
								<div class="wpforms-panel-sidebar-header">
									<button type="button" class="wpforms-btn-back-to-templates" aria-label="${ strings.panel.backToTemplates }">
										${ strings.panel.backToTemplates }
									</button>
								</div>
								<wpforms-ai-chat mode="forms" class="wpforms-ai-chat-blue"/>
							</div>
							<div class="wpforms-panel-content-wrap">
								<div class="wpforms-panel-content">
									<div class="wpforms-panel-empty-state">
										<h4>${ strings.panel.emptyStateTitle }</h4>
										<p>${ strings.panel.emptyStateDesc }</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				`;
			},
		},

		/**
		 * Maybe open the form generator panel.
		 *
		 * @since 1.9.2
		 */
		maybeOpenPanel() {
			// Open the panel only if the `ai-form` query string parameter exists.
			if ( ! window.location.search.includes( '&ai-form' ) ) {
				return;
			}

			// Remove the query string parameter from the URL.
			history.replaceState( {}, null, wpf.updateQueryString( 'ai-form', null ) );

			// Open the LiteConnect modal if it is not enabled.
			const $buttonLiteConnect = $( '.wpforms-template-generate.enable-lite-connect-modal' );

			if ( $buttonLiteConnect.length ) {
				setTimeout(
					function() {
						$buttonLiteConnect.trigger( 'click' );
					},
					0
				);
				return;
			}

			// Open the panel if all addons are installed OR the modal is dismissed.
			if ( ! Object.keys( strings.addonsData ).length || strings.dismissed.installAddons ) {
				generator.state.panelOpen = true;

				return;
			}

			// Open the addons install modal.
			generator.modals.openAddonsModal( null );
		},

		/**
		 * The "Use this form" ajax call.
		 *
		 * @since 1.9.2
		 *
		 * @param {jQuery} $button Button element.
		 */
		useFormAjax( $button ) {
			const sessionId = $button.closest( '.wpforms-ai-chat' ).data( 'session-id' );
			const responseId = $button.closest( '.wpforms-chat-item' ).data( 'response-id' );

			WPFormsBuilder.showLoadingOverlay();

			// Rate the response.
			main.getChatElement()?.wpformsAiApi.rate( true, responseId );

			// Do not display the alert about unsaved changes.
			WPFormsBuilder.setCloseConfirmation( false );

			const data = {
				action: 'wpforms_use_ai_form',
				nonce: strings.nonce,
				formId: generator.state.formId,
				formData: generator.state.aiResponseHistory[ responseId ],
				sessionId,
				chatHtml: $button.closest( 'wpforms-ai-chat' ).html(),
				responseHistory: generator.state.aiResponseHistory,
			};

			generator.preview.closeTooltips();

			$.post( strings.ajaxUrl, data )
				.done( function( res ) {
					if ( ! res.success ) {
						wpf.debug( 'Form Generator AJAX error:', res.data.error ?? res.data );
						return;
					}

					const newForm = ! data.formId ? '&newform=1' : '';

					if ( ! window.WPFormsChallenge ) {
						window.location.assign( res.data.redirect + newForm );

						return;
					}

					// When the Challenge is active, we need to resume it and continue the steps.
					WPFormsChallenge.core.resumeChallengeAndExec( {}, () => {
						WPFormsChallenge.core.stepCompleted( 2 )
							.done( () => {
								window.location.assign( res.data.redirect + newForm );
							} );
					} );
				} )
				.fail( function( xhr ) {
					wpf.debug( 'Form Generator AJAX error:', xhr.responseText ?? xhr.statusText );
				} );
		},

		/**
		 * Set the Builder's toolbar state.
		 *
		 * @since 1.9.2
		 *
		 * @param {boolean} isEmpty The toolbar is empty.
		 */
		setToolbarState( isEmpty ) {
			main.el.$builderToolbar.toggleClass( 'empty', isEmpty );
			main.el.$builderToolbar.find( '#wpforms-help span' ).toggleClass( 'screen-reader-text', ! isEmpty );
		},

		/**
		 * Get the AI chat element.
		 *
		 * @since 1.9.2
		 *
		 * @return {HTMLElement} The chat element.
		 */
		getChatElement() {
			return main.el.$chat.parent()[ 0 ];
		},
	};

	return main;
}
