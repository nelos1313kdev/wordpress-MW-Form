/* global wpforms_builder, Choices, wpf */

/**
 * WPForms ChoicesJS utility methods for the Admin Builder.
 *
 * @since 1.7.9
 */

'use strict';

var WPForms = window.WPForms || {};

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.WPFormsChoicesJS = WPForms.Admin.Builder.WPFormsChoicesJS || ( function( document, window, $ ) {

	/**
	 * Public functions and properties.
	 *
	 * @since 1.7.9
	 *
	 * @type {object}
	 */
	const app = {

		/**
		 * Setup the Select Page ChoicesJS instance.
		 *
		 * @since 1.7.9
		 *
		 * @param {object}  element       DOM Element where to init ChoicesJS.
		 * @param {object}  choicesJSArgs ChoicesJS init options.
		 * @param {object}  ajaxArgs      Object containing `action` and `nonce` to perform AJAX search.
		 *
		 * @returns {Choices} ChoicesJS instance.
		 */
		setup: function( element, choicesJSArgs, ajaxArgs ) {

			choicesJSArgs.searchEnabled = true;
			choicesJSArgs.allowHTML = false; // TODO: Remove after next Choices.js release.
			choicesJSArgs.searchChoices = ajaxArgs.nonce === null; // Enable searchChoices when not using AJAX.
			choicesJSArgs.renderChoiceLimit = -1;
			choicesJSArgs.noChoicesText = choicesJSArgs.noChoicesText || wpforms_builder.no_pages_found;
			choicesJSArgs.noResultsText = choicesJSArgs.noResultsText || wpforms_builder.no_pages_found;

			const choicesJS = new Choices( element, choicesJSArgs );

			if ( ajaxArgs.nonce === null ) {
				return choicesJS;
			}

			$( element ).data( 'choicesjs', choicesJS );

			/*
			 * ChoicesJS doesn't handle empty string search with it's `search` event handler,
			 * so we work around it by detecting empty string search with `keyup` event.
			 */
			choicesJS.input.element.addEventListener( 'keyup', function( ev ) {

				// Only capture backspace and delete keypress that results to empty string.
				if (
					( ev.which !== 8 && ev.which !== 46 ) ||
					ev.target.value.length > 0
				) {
					return;
				}

				app.performSearch( choicesJS, '', ajaxArgs );
			} );

			choicesJS.passedElement.element.addEventListener( 'search', _.debounce( function( ev ) {

				// Make sure that the search term is actually changed.
				if ( choicesJS.input.element.value.length === 0 ) {
					return;
				}

				app.performSearch( choicesJS, ev.detail.value, ajaxArgs );
			}, 800 ) );

			choicesJS.passedElement.element.addEventListener( 'change', function() {
				const select = $( this ),
					isMultiple = select.prop( 'multiple' );

				if ( ! isMultiple ) {
					return;
				}

				const fieldId = select.data( 'field-id' ),
					fieldName = select.data( 'field-name' ),
					value = choicesJS.getValue();

				const selected = value.map( function( item ) {
					return item.value;
				} );

				const $hidden = $( `#wpforms-field-${ fieldId }-${ fieldName }-select-multiple-options` );

				$hidden.val( JSON.stringify( selected ) );
			} );

			// Add ability to close the drop-down menu.
			choicesJS.containerOuter.element.addEventListener( 'click', function() {
				if ( $( this ).hasClass( 'is-open' ) ) {
					choicesJS.hideDropdown();
				}
			} );

			// Show more button for choices after the group is toggled.
			$( document )
				.on( 'wpformsFieldOptionGroupToggled', function() {
					wpf.showMoreButtonForChoices( choicesJS.containerOuter.element );
				} )
				.on( 'wpformsBeforeFieldDuplicate', function( event, id ) {
					if ( $( element ).data( 'field-id' ) !== id ) {
						return;
					}

					const choices = choicesJS.getValue( true );

					$( element ).data( 'choicesjs' ).destroy();

					$( element ).find( 'option' ).each( function( index, option ) {
						if ( choices.includes( $( option ).val() ) ) {
							$( option ).prop( 'selected', true );
						}
					} );
				} )
				.on( 'wpformsFieldDuplicated', function( event, id ) {
					if ( $( element ).data( 'field-id' ) !== id ) {
						return;
					}

					$( element ).data( 'choicesjs' ).init();
				} );

			return choicesJS;
		},

		/**
		 * Perform search in ChoicesJS instance.
		 *
		 * @since 1.7.9
		 *
		 * @param {Choices} choicesJS  ChoicesJS instance.
		 * @param {string}  searchTerm Search term.
		 * @param {Object}  ajaxArgs   Object containing `action` and `nonce` to perform AJAX search.
		 */
		performSearch( choicesJS, searchTerm, ajaxArgs ) {
			if ( ! ajaxArgs.action || ! ajaxArgs.nonce ) {
				return;
			}

			app.displayLoading( choicesJS );

			const requestSearchChoices = app.ajaxSearch( ajaxArgs.action, searchTerm, ajaxArgs.nonce, choicesJS.getValue( true ) );

			requestSearchChoices.done( function( response ) {
				choicesJS.setChoices( response.data, 'value', 'label', true );
			} );
		},

		/**
		 * Display "Loading" in ChoicesJS instance.
		 *
		 * @since 1.7.9
		 *
		 * @param {Choices} choicesJS ChoicesJS instance.
		 */
		displayLoading( choicesJS ) {
			choicesJS.setChoices(
				[
					{ value: '', label: `${ wpforms_builder.loading }...`, disabled: true },
				],
				'value',
				'label',
				true
			);
		},

		/**
		 * Perform AJAX search request.
		 *
		 * @since 1.7.9
		 * @deprecated 1.9.4 Use `ajaxSearch` instead.
		 *
		 * @param {string} action     Action to be used when doing ajax request for search.
		 * @param {string} searchTerm Search term.
		 * @param {string} nonce      Nonce to be used when doing ajax request.
		 *
		 * @return {Promise} jQuery ajax call promise.
		 */
		ajaxSearchPages( action, searchTerm, nonce ) {
			// eslint-disable-next-line no-console
			console.warn( 'WPForms.Admin.Builder.WPFormsChoicesJS.ajaxSearchPages is deprecated. Use WPForms.Admin.Builder.WPFormsChoicesJS.ajaxSearch instead.' );

			return app.ajaxSearch( action, searchTerm, nonce );
		},

		/**
		 * Perform AJAX search request.
		 *
		 * @since 1.9.4
		 *
		 * @param {string} action     Action to be used when doing ajax request for search.
		 * @param {string} searchTerm Search term.
		 * @param {string} nonce      Nonce to be used when doing ajax request.
		 * @param {Array}  exclude    Array of values to exclude from search results.
		 *
		 * @return {Promise} jQuery ajax call promise.
		 */
		ajaxSearch( action, searchTerm, nonce, exclude = [] ) {
			const args = {
				action,
				search: searchTerm,
				_wpnonce: nonce,
				exclude,
			};

			return $.get(
				wpforms_builder.ajax_url,
				args
			).fail(
				function( err ) {
					console.error( err );
				}
			);
		},
	};

	// Provide access to public functions/properties.
	return app;

}( document, window, jQuery ) );
