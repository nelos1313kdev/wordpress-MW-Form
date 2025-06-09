/* global WPForms, wpf */

/**
 * WPForms Providers Builder ConstantContactV3 module.
 *
 * @since 1.9.3
 */
WPForms.Admin.Builder.Providers.ConstantContactV3 = WPForms.Admin.Builder.Providers.ConstantContactV3 || ( function( document, window, $ ) {
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.3
	 *
	 * @type {Object}
	 */
	const app = {
		/**
		 * CSS selectors.
		 *
		 * @since 1.9.3
		 *
		 * @type {Object}
		 */
		selectors: {
			accountField: '.js-wpforms-builder-constant-contact-v3-provider-connection-account',
			actionData: '.wpforms-builder-constant-contact-v3-provider-actions-data',
			actionField: '.js-wpforms-builder-constant-contact-v3-provider-connection-action',
			connection: '.wpforms-panel-content-section-constant-contact-v3 .wpforms-builder-provider-connection',
		},

		/**
		 * jQuery elements.
		 *
		 * @since 1.9.3
		 *
		 * @type {Object}
		 */
		$elements: {
			$connections: $( '.wpforms-panel-content-section-constant-contact-v3 .wpforms-builder-provider-connections' ),
			$holder: $( '#wpforms-panel-providers' ),
			$panel: $( '#constant-contact-v3-provider' ),
		},

		/**
		 * Current provider slug.
		 *
		 * @since 1.9.3
		 *
		 * @type {string}
		 */
		provider: 'constant-contact-v3',

		/**
		 * This is a shortcut to the WPForms.Admin.Builder.Providers object,
		 * that handles the parent all-providers functionality.
		 *
		 * @since 1.9.3
		 *
		 * @type {Object}
		 */
		Providers: {},

		/**
		 * This is a shortcut to the WPForms.Admin.Builder.Templates object,
		 * that handles all the template management.
		 *
		 * @since 1.9.3
		 *
		 * @type {Object}
		 */
		Templates: {},

		/**
		 * This is a shortcut to the WPForms.Admin.Builder.Providers.cache object,
		 * that handles all the cache management.
		 *
		 * @since 1.9.3
		 *
		 * @type {Object}
		 */
		Cache: {},

		/**
		 * This is a flag for ready state.
		 *
		 * @since 1.9.3
		 *
		 * @type {boolean}
		 */
		isReady: false,

		/**
		 * Start the engine.
		 *
		 * Run initialization on the providers panel only.
		 *
		 * @since 1.9.3
		 */
		init() {
			// We are requesting/loading a Providers panel.
			if ( wpf.getQueryString( 'view' ) === 'providers' ) {
				app.$elements.$holder.on( 'WPForms.Admin.Builder.Providers.ready', app.ready );
			}

			// We have switched to a Providers panel.
			$( document ).on( 'wpformsPanelSwitched', function( event, panel ) {
				if ( panel === 'providers' ) {
					app.ready();
				}
			} );
		},

		/**
		 * Initialized once the DOM and Providers are fully loaded.
		 *
		 * @since 1.9.3
		 */
		ready() {
			if ( app.isReady ) {
				return;
			}

			app.Providers = WPForms.Admin.Builder.Providers;
			app.Templates = WPForms.Admin.Builder.Templates;
			app.Cache = app.Providers.cache;

			// Register custom Underscore.js templates.
			app.Templates.add( [
				'wpforms-constant-contact-v3-builder-content-connection',
				'wpforms-constant-contact-v3-builder-content-connection-error',
				'wpforms-constant-contact-v3-builder-content-connection-select-field',
				'wpforms-constant-contact-v3-builder-content-connection-conditionals',
			] );

			// Events registration.
			app.bindUIActions();
			app.bindTriggers();

			app.processInitial();

			// Save a flag for ready state.
			app.isReady = true;
		},

		/**
		 * Process various events as a response to UI interactions.
		 *
		 * @since 1.9.3
		 */
		bindUIActions() {
			app.$elements.$panel
				.on( 'connectionCreate', app.connection.create )
				.on( 'connectionDelete', app.connection.delete )
				.on( 'change', app.selectors.accountField, app.ui.accountField.change )
				.on( 'change', app.selectors.actionField, app.ui.actionField.change );
		},

		/**
		 * Fire certain events on certain actions, specific for related connections.
		 * These are not directly caused by user manipulations.
		 *
		 * @since 1.9.3
		 */
		bindTriggers() {
			app.$elements.$connections.on( 'connectionsDataLoaded', function( event, data ) {
				if ( _.isEmpty( data.connections ) ) {
					return;
				}

				for ( const connectionId in data.connections ) {
					app.connection.generate( {
						connection: data.connections[ connectionId ],
						conditional: data.conditionals[ connectionId ],
					} );
				}
			} );

			app.$elements.$connections.on( 'connectionGenerated', function( event, data ) {
				const $connection = app.connection.getById( data.connection.id );

				if ( _.has( data.connection, 'isNew' ) && data.connection.isNew ) {
					// Run replacing temporary connection ID if it's a new connection.
					app.connection.replaceIds( data.connection.id, $connection );
					return;
				}

				$( app.selectors.actionField, $connection ).trigger( 'change' );
			} );
		},

		/**
		 * Compile template with data if any and display them on a page.
		 *
		 * @since 1.9.3
		 */
		processInitial() {
			app.connection.dataLoad();
		},

		/**
		 * Connection property.
		 *
		 * @since 1.9.3
		 */
		connection: {
			/**
			 * Sometimes we might need to a get a connection DOM element by its ID.
			 *
			 * @since 1.9.3
			 *
			 * @param {string} connectionId Connection ID to search for a DOM element by.
			 *
			 * @return {jQuery} jQuery object for connection.
			 */
			getById( connectionId ) {
				return app.$elements.$connections.find( '.wpforms-builder-provider-connection[data-connection_id="' + connectionId + '"]' );
			},

			/**
			 * Sometimes in DOM we might have placeholders or temporary connection IDs.
			 * We need to replace them with actual values.
			 *
			 * @since 1.9.3
			 *
			 * @param {string} connectionId New connection ID to replace to.
			 * @param {Object} $connection  jQuery DOM connection element.
			 */
			replaceIds( connectionId, $connection ) {
				// Replace old temporary %connection_id% from PHP code with the new one.
				$connection.find( 'input, select, label' ).each( function() {
					const $this = $( this );

					if ( $this.attr( 'name' ) ) {
						$this.attr( 'name', $this.attr( 'name' ).replace( /%connection_id%/gi, connectionId ) );
					}

					if ( $this.attr( 'id' ) ) {
						$this.attr( 'id', $this.attr( 'id' ).replace( /%connection_id%/gi, connectionId ) );
					}

					if ( $this.attr( 'for' ) ) {
						$this.attr( 'for', $this.attr( 'for' ).replace( /%connection_id%/gi, connectionId ) );
					}

					if ( $this.attr( 'data-name' ) ) {
						$this.attr( 'data-name', $this.attr( 'data-name' ).replace( /%connection_id%/gi, connectionId ) );
					}
				} );
			},

			/**
			 * Create a connection using the user entered name.
			 *
			 * @since 1.9.3
			 *
			 * @param {Object} event Event object.
			 * @param {string} name  Connection name.
			 */
			create( event, name ) {
				const connectionId = new Date().getTime().toString( 16 ),
					connection = {
						id: connectionId,
						name,
						isNew: true,
					};

				app.Cache.addTo( app.provider, 'connections', connectionId, connection );

				app.connection.generate( {
					connection,
				} );
			},

			/**
			 * Connection is deleted - delete a cache as well.
			 *
			 * @since 1.9.3
			 *
			 * @param {Object} event       Event object.
			 * @param {Object} $connection jQuery DOM element for a connection.
			 */
			delete( event, $connection ) {
				const $holder = app.Providers.getProviderHolder( app.provider );

				if ( ! $connection.closest( $holder ).length ) {
					return;
				}

				const connectionId = $connection.data( 'connection_id' );

				if ( _.isString( connectionId ) ) {
					app.Cache.deleteFrom( app.provider, 'connections', connectionId );
				}
			},

			/**
			 * Get the template and data for a connection and process it.
			 *
			 * @since 1.9.3
			 *
			 * @param {Object} data Connection data.
			 *
			 * @return {void}
			 */
			generate( data ) {
				const accounts = app.Cache.get( app.provider, 'accounts' );

				if ( _.isEmpty( accounts ) || ! app.account.isAccountExists( data.connection.account_id, accounts ) ) {
					return;
				}

				const actions = app.Cache.get( app.provider, 'actions' ),
					lists = app.Cache.get( app.provider, 'lists' );

				return app.connection.renderConnections( accounts, lists, actions, data );
			},

			/**
			 * Render connections.
			 *
			 * @since 1.9.3
			 *
			 * @param {Object} accounts List of accounts.
			 * @param {Object} lists    List of lists.
			 * @param {Object} actions  List of actions.
			 * @param {Object} data     Connection data.
			 */
			renderConnections( accounts, lists, actions, data ) {
				if ( ! app.account.isAccountExists( data.connection.account_id, accounts ) ) {
					return;
				}

				const tmplConnection = app.Templates.get( 'wpforms-' + app.provider + '-builder-content-connection' ),
					tmplConditional = app.Templates.get( 'wpforms-constant-contact-v3-builder-content-connection-conditionals' ),
					conditional = _.has( data.connection, 'isNew' ) && data.connection.isNew ? tmplConditional() : data.conditional;

				app.$elements.$connections.prepend(
					tmplConnection( {
						accounts,
						lists,
						actions,
						connection: data.connection,
						conditional,
						provider: app.provider,
					} )
				);

				app.$elements.$connections.trigger( 'connectionGenerated', [ data ] );
			},

			/**
			 * Fire AJAX-request to retrieve the list of all saved connections.
			 *
			 * @since 1.9.3
			 */
			dataLoad() {
				app
					.Providers.ajax
					.request( app.provider, {
						data: {
							task: 'connections_get',
						},
					} )
					.done( function( response ) {
						if (
							! response.success ||
							! _.has( response.data, 'connections' )
						) {
							return;
						}

						[
							'accounts',
							'actions',
							'actions_fields',
							'conditionals',
							'connections',
							'custom_fields',
							'lists',
						].forEach( ( dataType ) => {
							app.Cache.set( app.provider, dataType, jQuery.extend( {}, response.data[ dataType ] ) );
						} );

						app.$elements.$connections.trigger( 'connectionsDataLoaded', [ response.data ] );
					} );
			},
		},

		/**
		 * Account property.
		 *
		 * @since 1.9.3
		 */
		account: {
			/**
			 * Check if a provided account is listed inside an account list.
			 *
			 * @since 1.9.3
			 *
			 * @param {string} accountId Connection account ID to check.
			 * @param {Object} accounts  Array of objects, usually received from API.
			 *
			 * @return {boolean} True if an account exists.
			 */
			isAccountExists( accountId, accounts ) {
				if ( _.isEmpty( accounts ) ) {
					return false;
				}

				// New connections that have not been saved don't have the account ID yet.
				if ( _.isEmpty( accountId ) ) {
					return true;
				}

				return _.has( accounts, accountId );
			},
		},

		/**
		 * All methods that modify the UI of a page.
		 *
		 * @since 1.9.3
		 */
		ui: {
			/**
			 * Account field methods.
			 *
			 * @since 1.9.3
			 */
			accountField: {
				/**
				 * Callback-function on change event.
				 *
				 * @since 1.9.3
				 */
				change() {
					const $this = $( this ),
						$connection = $this.closest( app.selectors.connection ),
						$actionName = $( app.selectors.actionField, $connection );

					$actionName.prop( 'selectedIndex', 0 ).trigger( 'change' );

					// If an account is empty.
					if ( _.isEmpty( $this.val() ) ) {
						$actionName.prop( 'disabled', true );
						$( app.selectors.actionData, $connection ).html( '' );

						return;
					}

					$actionName.prop( 'disabled', false );
					$this.removeClass( 'wpforms-error' );
				},
			},

			/**
			 * Action methods.
			 *
			 * @since 1.9.3
			 */
			actionField: {
				/**
				 * Callback-function on change event.
				 *
				 * @since 1.9.3
				 */
				change() {
					const $this = $( this ),
						$connection = $this.closest( app.selectors.connection ),
						$account = $( app.selectors.accountField, $connection ),
						$action = $( app.selectors.actionField, $connection );

					app.ui.actionField.render( {
						action: 'action',
						target: $this,
						/* eslint-disable camelcase */
						account_id: $account.val(),
						action_name: $action.val(),
						connection_id: $connection.data( 'connection_id' ),
						/* eslint-enable camelcase */
					} );

					$this.removeClass( 'wpforms-error' );
				},

				/**
				 * Render HTML.
				 *
				 * @since 1.9.3
				 *
				 * @param {Object} args Arguments.
				 */
				render( args ) {
					const fields = app.tmpl.renderActionFields( args ),
						$connection = app.connection.getById( args.connection_id ),
						$connectionData = $( app.selectors.actionData, $connection );

					$connectionData.html( fields );

					app.$elements.$holder.trigger( 'connectionRendered', [ app.provider, args.connection_id ] );
				},

				/**
				 * Get a list of constant-contact lists.
				 *
				 * @since 1.9.3
				 *
				 * @param {string} accountId Account ID.
				 *
				 * @return {Array} List of constant-contact lists.
				 */
				getList( accountId ) {
					const listsCache = app.Cache.get( app.provider, 'lists' );

					return ! _.isEmpty( listsCache ) && ! _.isEmpty( listsCache[ accountId ] ) ? listsCache[ accountId ] : [];
				},
			},
		},

		/**
		 * All methods for JavaScript templates.
		 *
		 * @since 1.9.3
		 */
		tmpl: {
			/**
			 * Compile and retrieve an HTML for common elements.
			 *
			 * @since 1.9.3
			 * @deprecated 1.9.5
			 *
			 * @return {string} Compiled HTML.
			 */
			commonsHTML() {
				// eslint-disable-next-line no-console
				console.warn( 'WARNING! Function "WPForms.Admin.Builder.Providers.ConstantContactV3.tmpl.commonsHTML()" has been deprecated!' );

				const tmplError = app.Templates.get( 'wpforms-' + app.provider + '-builder-content-connection-error' );

				return tmplError();
			},

			/**
			 * Compile and retrieve an HTML for "Custom Fields Table".
			 *
			 * @since 1.9.3
			 *
			 * @param {Object} args Arguments
			 *
			 * @return {string} Compiled HTML.
			 */
			renderActionFields( args ) {
				const fields = wpf.getFields(),
					actionsFields = app.Cache.get( app.provider, 'actions_fields' ),
					customFields = app.Cache.get( app.provider, 'custom_fields' ),
					connection = app.Cache.getById( app.provider, 'connections', args.connection_id );

				let fieldHTML = '';

				$.each( actionsFields[ args.target.val() ], function( key, field ) {
					if ( key === 'custom_fields' ) {
						const tmplFields = app.Templates.get( 'wpforms-providers-builder-content-connection-fields' );

						fieldHTML += tmplFields( {
							connection,
							fields,
							provider: {
								slug: app.provider,
								fields: customFields[ args.account_id ],
							},
							isSupportSubfields: true,
						} );

						return;
					}

					const options = key === 'list' ? app.ui.actionField.getList( args.account_id ) : Object.values( fields );
					const templateName = 'wpforms-' + app.provider + '-builder-content-connection-' + field.type + '-field';
					const tmplField = app.Templates.get( templateName );

					fieldHTML += tmplField( {
						connection,
						name: key,
						field,
						provider: {
							slug: app.provider,
							fields: actionsFields[ args.target.val() ],
						},
						options,
					} );
				} );

				return fieldHTML;
			},
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPForms.Admin.Builder.Providers.ConstantContactV3.init();
