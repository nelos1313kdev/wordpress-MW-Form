/* global List, wpforms_builder */
/**
 * WPForms Builder Dropdown List module.
 *
 * @since 1.8.4
 */

/*
 Usage:

 dropdownList = WPForms.Admin.Builder.DropdownList.init( {
 	class: 'insert-field-dropdown',                    // Additional CSS class.
	title: 'Dropdown Title',                           // Dropdown title.
 	list: [                                            // Items list.
 		{ value: '1', text: 'Item 1' },
 		{ value: '2', text: 'Item 2' },
 		{ value: '3', text: 'Item 3' },
 	],
 	container: $( '.holder-container' ),               // Holder container. Optional.
 	scrollableContainer: $( '.scrollable-container' ), // Scrollable container. Optional.
	search: {
		enabled: false,                                // Enable search. Optional.
		searchBy : [],                                 // Search by fields.
		placeholder: 'Search',                         // Search input placeholder.
		noResultsText: 'Sorry, no results found',      // No results text.
	},
 	button: $( '.button' ),                            // Button.
 	buttonDistance: 21,                                // Distance from dropdown to the button.
    noLeftOffset: false,                               // Disable left offset for the dropdown.
 	itemFormat( item ) {                               // Item element renderer. Optional.
 		return `<span>${ item.text }</span>`;
 	},
 	onSelect( event, value, text, $item, instance ) {  // On select event handler.
		console.log( 'Item selected:', text );
 		instance.close();
 		$button.removeClass( 'active' );
 	},
 } );
*/

// noinspection ES6ConvertVarToLetConst
var WPForms = window.WPForms || {}; // eslint-disable-line no-var

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.DropdownList = WPForms.Admin.Builder.DropdownList || ( function( document, window, $ ) {
	/**
	 * DropdownList object constructor.
	 *
	 * @since 1.8.4
	 *
	 * @type {Object}
	 */
	function DropdownList( options ) { // eslint-disable-line max-lines-per-function
		const self = this;

		/**
		 * Default options.
		 *
		 * @since 1.8.4
		 *
		 * @type {Object}
		 */
		const defaultOptions = {
			class: '',
			title: '',
			list: [],
			container: null,
			scrollableContainer: null,
			search: {
				enabled: false,
				searchBy : [],
				placeholder: wpforms_builder.search,
				noResultsText: wpforms_builder.no_results_found,
			},
			button: null,
			buttonDistance: 10,
			noLeftOffset: false,
			onSelect: null,
			itemFormat( item ) {
				return item.text;
			},
		};

		/**
		 * Options.
		 *
		 * @since 1.8.4
		 *
		 * @type {jQuery}
		 */
		self.options = $.extend( defaultOptions, options );

		/**
		 * Main dropdown container.
		 *
		 * @since 1.8.4
		 *
		 * @type {jQuery}
		 */
		self.$el = null;

		/**
		 * Form builder container.
		 *
		 * @since 1.8.4
		 *
		 * @type {jQuery}
		 */
		self.$builder = $( '#wpforms-builder' );

		/**
		 * List.js instance.
		 *
		 * @since 1.9.5
		 *
		 * @type {Object}
		 */
		self.searchItems = null;

		/**
		 * Close the dropdown.
		 *
		 * @since 1.8.4
		 */
		self.close = function() {
			self.$el.addClass( 'closed' );

			// Clear search input.
			if ( self.options.search.enabled ) {
				self.clearSearch();
			}
		};

		/**
		 * Open the dropdown.
		 *
		 * @since 1.8.4
		 */
		self.open = function() {
			self.$el.removeClass( 'closed open-down' );
			self.setPosition();

			// Close dropdown on click outside.
			self.$builder.on( 'click.DropdownList', function( e ) {
				const $target = $( e.target );
				const excludedSelectors = '.button-insert-field, .wpforms-smart-tags-enabled, .wpforms-show-smart-tags, .mce-ico';

				if ( $target.closest( self.$el ).length || $target.is( excludedSelectors ) ) {
					return;
				}

				self.$builder.off( 'click.DropdownList' );

				const $button = $( self.options.button );

				if ( $button.hasClass( 'active' ) ) {
					$button.trigger( 'click' );
				}
			} );
		};

		/**
		 * Generate the dropdown HTML.
		 *
		 * @since 1.8.4
		 *
		 * @return {string} HTML.
		 */
		self.generateHtml = function() {
			const list = self.options.list;

			if ( ! list || list.length === 0 ) {
				return '';
			}

			const itemFormat = typeof self.options.itemFormat === 'function' ? self.options.itemFormat : defaultOptions.itemFormat;

			// Generate HTML list items.
			const items = list.map( ( item ) => `<li data-value='${ item.value }'>${ itemFormat( item ) }</li>` );

			// Generate search HTML if enabled.
			const searchHtml = self.options.search.enabled
				? `<div class="wpforms-builder-dropdown-list-search-container">
					<input type="search" class="wpforms-builder-dropdown-list-search-input" placeholder="${ self.options.search.placeholder }">
					<i class="fa fa-times-circle wpforms-builder-dropdown-list-search-close" aria-hidden="true"></i>
				</div>`
				: '';

			const listClass = self.options.search.enabled ? 'list' : '';

			return `<div class="wpforms-builder-dropdown-list closed ${ self.options.class }">
				<div class="title">${ self.options.title }</div>
				${ searchHtml }
				<ul class="${ listClass }">${ items.join( '' ) }</ul>
				<div class="wpforms-no-results">${ self.options.search.noResultsText }</div>
			</div>`;
		};

		/**
		 * Attach dropdown to DOM.
		 *
		 * @since 1.8.4
		 */
		self.attach = function() {
			const html = self.generateHtml();

			// Remove old dropdown.
			if ( self.$el && self.$el.length ) {
				self.$el.remove();
			}

			// Create jQuery objects.
			self.$el = $( html );
			self.$button = $( self.options.button );
			self.$container = self.options.container ? $( self.options.container ) : self.$button.parent();
			self.$scrollableContainer = self.options.scrollableContainer ? $( self.options.scrollableContainer ) : null;

			// Init List.js if search is enabled.
			if ( self.options.search.enabled ) {
				self.searchItems = new List( self.$el[ 0 ], {
					valueNames: self.options.search.searchBy,
				} );
			}

			// Add the dropdown to the container.
			self.$container.append( self.$el );

			self.setPosition();
		};

		/**
		 * Set dropdown position.
		 *
		 * @since 1.8.4
		 */
		self.setPosition = function() {
			// Calculate position.
			const buttonOffset = self.$button.offset(),
				containerOffset = self.$container.offset(),
				containerPosition = self.$container.position(),
				dropdownHeight = self.$el.height(),
				scrollTop = self.$scrollableContainer ? self.$scrollableContainer.scrollTop() : 0;

			let top = buttonOffset.top - containerOffset.top - dropdownHeight - self.options.buttonDistance;

			// In the case of the dropdown doesn't fit into the scrollable container to top,
			// it is necessary to open the dropdown to the bottom.
			if ( scrollTop + containerPosition.top - dropdownHeight < 0 ) {
				top = buttonOffset.top - containerOffset.top + self.$button.height() + self.options.buttonDistance - 11;
				self.$el.addClass( 'open-down' );
			}

			self.$el.css( 'top', top );

			// If noLeftOffset is set, do not set `left` positioning value.
			if ( self.options.noLeftOffset ) {
				return;
			}

			// The dropdown is outside the field options, it is necessary to set `left` positioning value.
			if ( self.$container.closest( '.wpforms-field-option' ).length === 0 ) {
				self.$el.css( 'left', buttonOffset.left - containerOffset.left );
			}
		};

		/**
		 * Events.
		 *
		 * @since 1.8.4
		 */
		self.events = function() {
			// Click (select) the item.
			self.$el.find( 'li' ).off()
				.on( 'click', function( event ) {
					// Bail if callback is not a function.
					if ( typeof self.options.onSelect !== 'function' ) {
						return;
					}

					const $item = $( this );

					// Clear search input.
					if ( self.options.search.enabled ) {
						self.clearSearch();
					}

					// Trigger callback.
					self.options.onSelect( event, $item.data( 'value' ), $item.text(), $item, self );
				} );

			// Search.
			if ( self.options.search.enabled ) {
				self.$el.find( 'input[type="search"]' ).on( 'keyup search', self.search );
				self.$el.find( '.wpforms-builder-dropdown-list-search-close' ).on( 'click', self.clearSearch );
			}
		};

		/**
		 * Initialize.
		 *
		 * @since 1.8.4
		 *
		 * @param {Array} list List of items.
		 */
		self.init = function( list = null ) {
			self.options.list = list ? list : self.options.list;

			self.attach();
			self.events();

			self.$button.data( 'dropdown-list', self );
		};

		/**
		 * Destroy.
		 *
		 * @since 1.8.4
		 */
		self.destroy = function() {
			self.$button.data( 'dropdown-list', null );
			self.$el.remove();
		};

		/**
		 * Search.
		 *
		 * @since 1.9.5
		 * @param {Object } event Event.
		 */
		self.search = function( event ) {
			const searchTerm = event.target.value.toLowerCase();
			const $noResults = self.$el.find( '.wpforms-no-results' );

			// Show/hide close button.
			if ( searchTerm !== '' ) {
				self.$el.find( '.wpforms-builder-dropdown-list-search-close' ).addClass( 'active' );
			}

			// Search.
			self.searchItems.search( searchTerm );

			// Show/hide no result message.
			$noResults.toggle( self.searchItems.visibleItems.length === 0 );
		};

		/**
		 * Clear search input.
		 *
		 * @since 1.9.5
		 */
		self.clearSearch = function() {
			// Clear search input.
			self.$el.find( 'input[type="search"]' ).val( '' );
			self.$el.find( '.wpforms-no-results' ).hide();
			self.$el.find( '.wpforms-builder-dropdown-list-search-close' ).removeClass( 'active' );

			// Clear search results.
			self.searchItems.search();
		};

		// Initialize.
		self.init();
	}

	/**
	 * Public functions and properties.
	 *
	 * @since 1.8.4
	 *
	 * @type {Object}
	 */
	return {

		/**
		 * Start the engine. DOM is not ready yet, use only to init something.
		 *
		 * @since 1.8.4
		 *
		 * @param {Object} options Options.
		 *
		 * @return {Object} DropdownList instance.
		 */
		init( options ) {
			return new DropdownList( options );
		},
	};
}( document, window, jQuery ) );
