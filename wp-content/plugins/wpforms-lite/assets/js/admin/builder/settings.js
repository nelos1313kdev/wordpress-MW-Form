/* global wpforms_builder_settings, Choices, wpforms_builder */

// noinspection ES6ConvertVarToLetConst
/**
 * Form Builder Settings Panel module.
 *
 * @since 1.7.5
 */

// eslint-disable-next-line no-var
var WPForms = window.WPForms || {};

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.Settings = WPForms.Admin.Builder.Settings || ( function( document, window, $ ) {
	/**
	 * Elements holder.
	 *
	 * @since 1.7.5
	 *
	 * @type {Object}
	 */
	let el = {};

	/**
	 * Runtime variables.
	 *
	 * @since 1.7.5
	 *
	 * @type {Object}
	 */
	const vars = {};

	// noinspection JSUnusedLocalSymbols,ES6ConvertVarToLetConst
	/**
	 * Public functions and properties.
	 *
	 * @since 1.7.5
	 *
	 * @type {Object}
	 */
	// eslint-disable-next-line no-var
	var app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.7.5
		 */
		init() {
			$( app.ready );
		},

		/**
		 * DOM is fully loaded.
		 *
		 * @since 1.7.5
		 */
		ready() {
			app.setup();
			app.initTags();
			app.events();
		},

		/**
		 * Setup. Prepare some variables.
		 *
		 * @since 1.7.5
		 */
		setup() {
			// Cache DOM elements.
			el = {
				$builder:    $( '#wpforms-builder' ),
				$panel:      $( '#wpforms-panel-settings' ),
				$selectTags: $( '#wpforms-panel-field-settings-form_tags' ),
			};

			// Give a chance to interact with "Disable entry..." option immediately.
			app.allowEditDisabledEntriesOption();
		},

		/**
		 * Bind events.
		 *
		 * @since 1.7.5
		 */
		events() {
			el.$panel
				.on( 'keydown', '#wpforms-panel-field-settings-form_tags-wrap input', app.addCustomTagInput )
				.on( 'removeItem', '#wpforms-panel-field-settings-form_tags-wrap select', app.editTagsRemoveItem )
				.on( 'change', '#wpforms-panel-field-settings-antispam_v3', app.enableAntispamV3 )
				.on( 'change', '#wpforms-panel-field-settings-disable_entries', app.disableEntries )
				.on( 'change', '#wpforms-panel-field-settings-store_spam_entries', app.storeSpamEntries );

			el.$selectTags
				.on( 'change', app.changeTags );

			$( document ).on( 'connectionsDataLoaded', app.allowEditDisabledEntriesOption );
		},

		/**
		 * Enable Anti spam v3 toggle change event.
		 *
		 * @since 1.9.0
		 */
		enableAntispamV3() {
			// Hide and disable old anti-spam.
			$( '#wpforms-panel-field-settings-antispam' )
				.prop( 'checked', false )
				.closest( '.wpforms-panel-field' )
				.toggleClass( 'wpforms-hidden' );
		},

		/**
		 * Disable Entries toggle change event.
		 *
		 * @since 1.9.2
		 */
		disableEntries() {
			const $this = $( this );
			const isChecked = $this.prop( 'checked' );
			const isStoreSpamEntriesChecked = $( '#wpforms-panel-field-settings-store_spam_entries' ).prop( 'checked' );

			app.toggleFilteringMessages( ! isChecked && isStoreSpamEntriesChecked );
			// Toggle the store spam entries toggle.
			$( '#wpforms-panel-field-settings-store_spam_entries-wrap' ).toggleClass( 'wpforms-hidden', $this.prop( 'checked' ) );

			if ( ! $this.prop( 'checked' ) ) {
				return;
			}

			const entryRequirement = app.getEntryRequirement();

			// Don't allow users to disable entries if some third-party integrations
			// require it.
			if ( entryRequirement.required ) {
				$.confirm( {
					title: wpforms_builder.entry_storage_required,
					content: app.getDisabledEntryMessage( entryRequirement ),
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
				$this.prop( 'checked', false );

				return;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder.disable_entries,
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
		 * Store Spam Entries toggle change event.
		 *
		 * @since 1.9.2
		 */
		storeSpamEntries() {
			app.toggleFilteringMessages( $( this ).prop( 'checked' ) );
		},

		/**
		 * Toggle Filtering Messages.
		 *
		 * @since 1.9.2
		 *
		 * @param {boolean} $hide Whether to hide or show messages.
		 */
		toggleFilteringMessages( $hide ) {
			if ( ! $( '#wpforms-panel-field-anti_spam-filtering_store_spam' ).is( ':checked' ) ) {
				return;
			}

			// Toggle Country Filter Message.
			$( '#wpforms-panel-field-anti_spam-country_filter-message-wrap' ).toggleClass( 'wpforms-hidden', $hide );

			// Toggle Keyywords Filter Message.
			$( '#wpforms-panel-field-anti_spam-keyword_filter-message-wrap' ).toggleClass( 'wpforms-hidden', $hide );
		},

		/**
		 * Init Choices.js on the Tags select an input element.
		 *
		 * @param {Object} $el Element.
		 * @since 1.7.5
		 */
		initTags( $el = null ) {
			$el = $el?.length ? $el : el.$selectTags;

			// Skip in certain cases.
			if (
				! $el.length ||
				typeof window.Choices !== 'function'
			) {
				return;
			}

			// Init Choices.js object instance.
			vars.tagsChoicesObj = new Choices( $el[ 0 ], wpforms_builder_settings.choicesjs_config );

			// Backup current value.
			const	currentValue = vars.tagsChoicesObj.getValue( true );

			// Update all tags choices.
			vars.tagsChoicesObj
				.clearStore()
				.setChoices(
					wpforms_builder_settings.all_tags_choices,
					'value',
					'label',
					true
				)
				.setChoiceByValue( currentValue );

			$el.data( 'choicesjs', vars.tagsChoicesObj );

			app.initTagsHiddenInput();
		},

		/**
		 * Init Tags hidden input element.
		 *
		 * @since 1.7.5
		 */
		initTagsHiddenInput() {
			// Create additional hidden input.
			el.$selectTagsHiddenInput = $( '<input type="hidden" name="settings[form_tags_json]">' );
			el.$selectTags
				.closest( '.wpforms-panel-field' )
				.append( el.$selectTagsHiddenInput );

			// Update hidden input value.
			app.changeTags( null );
		},

		/**
		 * Add custom item to Tags dropdown on input.
		 *
		 * @since 1.7.5
		 *
		 * @param {Object} event Event object.
		 */
		addCustomTagInput( event ) {
			if ( [ 'Enter', ',' ].indexOf( event.key ) < 0 ) {
				return;
			}

			event.preventDefault();
			event.stopPropagation();

			if ( ! vars.tagsChoicesObj || event.target.value.length === 0 ) {
				return;
			}

			const tagLabel = _.escape( event.target.value ).trim(),
				labels = _.map( vars.tagsChoicesObj.getValue(), 'label' ).map( function( label ) {
					return label.toLowerCase().trim();
				} );

			if ( tagLabel === '' || labels.indexOf( tagLabel.toLowerCase() ) >= 0 ) {
				vars.tagsChoicesObj.clearInput();

				return;
			}

			app.addCustomTagInputCreate( tagLabel );
			app.changeTags( event );
		},

		/**
		 * Remove tag from Tags field event handler.
		 *
		 * @since 1.7.5
		 *
		 * @param {Object} event Event object.
		 */
		editTagsRemoveItem( event ) {
			const allValues = _.map( wpforms_builder_settings.all_tags_choices, 'value' );

			if ( allValues.indexOf( event.detail.value ) >= 0 ) {
				return;
			}

			// We should remove new tag from the list of choices.
			const choicesObj = $( event.target ).data( 'choicesjs' ),
				currentValue = choicesObj.getValue( true ),
				choices = _.filter( choicesObj._currentState.choices, function( item ) {
					return item.value !== event.detail.value;
				} );

			choicesObj
				.clearStore()
				.setChoices( choices, 'value', 'label', true )
				.setChoiceByValue( currentValue );
		},

		/**
		 * Add custom item to Tags dropdown on input (second part).
		 *
		 * @since 1.7.5
		 *
		 * @param {Object} tagLabel Event object.
		 */
		addCustomTagInputCreate( tagLabel ) {
			const tag = _.find( wpforms_builder_settings.all_tags_choices, { label: tagLabel } );

			if ( tag && tag.value ) {
				vars.tagsChoicesObj.setChoiceByValue( tag.value );
			} else {
				vars.tagsChoicesObj.setChoices(
					[
						{
							value: tagLabel,
							label: tagLabel,
							selected: true,
						},
					],
					'value',
					'label',
					false
				);
			}

			vars.tagsChoicesObj.clearInput();
		},

		/**
		 * Change Tags field event handler.
		 *
		 * @since 1.7.5
		 *
		 * @param {Object} event Event object.
		 */
		// eslint-disable-next-line no-unused-vars
		changeTags( event ) {
			const tagsValue = vars.tagsChoicesObj.getValue(),
				tags = [];

			for ( let i = 0; i < tagsValue.length; i++ ) {
				tags.push( {
					value: tagsValue[ i ].value,
					label: tagsValue[ i ].label,
				} );
			}

			// Update Tags field hidden input value.
			el.$selectTagsHiddenInput.val(
				JSON.stringify( tags )
			);
		},

		/**
		 * Generates a message to indicate why certain entries are disabled,
		 * including necessary dependencies for enabling them.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} entryRequirement An object containing details about the requirements.
		 *
		 * @return {string} The customized message indicating why the entries are disabled.
		 */
		getDisabledEntryMessage( entryRequirement ) {
			const dependencies = entryRequirement?.dependencies || {};

			if ( ! Object.keys( dependencies ).length ) {
				return wpforms_builder.payments_on_entries_off;
			}

			const dependenciesHTML = Object.values( dependencies ).map( ( { text, href }, index, arr ) => {
				const linkHTML = `<a href="${ href }" target="_blank">${ text }</a>`;

				if ( index === arr.length - 1 && arr.length > 1 ) {
					// The very last item when array has multiple items, prepend with "and".
					return `and ${ linkHTML }`;
				} else if ( index < arr.length - 2 ) {
					// Any item except the last two, append comma.
					return `${ linkHTML },`;
				}

				// Second-to-last item, no comma needed as next item will prepend "and".
				return linkHTML;
			} ).join( ' ' );

			return wpforms_builder.payments_on_entries_off.replace( '{integration}', dependenciesHTML );
		},

		/**
		 * Allows interacting with the option for disabled entries in the WPForms settings panel.
		 * This method ensures that the entry requirement is met before enabling the option.
		 * If some providers or gateways are still loading, the process is aborted.
		 *
		 * @since 1.9.6
		 */
		allowEditDisabledEntriesOption() {
			const $toggleSpan = $( '#wpforms-panel-field-settings-disable_entries-wrap > span' );

			if ( ! $toggleSpan.hasClass( 'wpforms-toggle-control-disabled' ) ) {
				return;
			}

			const entryRequirement = app.getEntryRequirement();

			if ( entryRequirement?.loadingStack?.size ) {
				return;
			}

			$toggleSpan.removeClass( 'wpforms-toggle-control-disabled' );
		},

		/**
		 * Allows modifying the entry requirement configuration, including whether
		 * the entry is required and any dependencies associated with it.
		 *
		 * @since 1.9.6
		 *
		 * @property {boolean} required     Indicates whether the entry is required.
		 * @property {Object}  dependencies Specifies dependencies for the entry. See app.getDisabledEntryMessage for more details.
		 * @property {Set}     loadingStack A set used to manage loading states.
		 *
		 * @return {Object} The entry requirement object.
		 */
		getEntryRequirement() {
			return wp.hooks.applyFilters(
				'wpforms.Builder.entryRequirement',
				{ required: false, dependencies: {}, loadingStack: new Set() }
			);
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPForms.Admin.Builder.Settings.init();
