// eslint-disable-next-line no-unused-vars
/* global wpforms_builder, wpf, WPFormsBuilder, WPFormsUtils, tinyMCE, DropdownList, tooltipster */

/**
 * @param wpforms_builder.smart_tags_disabled_for_confirmations
 * @param wpforms_builder.fields_available
 * @param wpforms_builder.fields_unavailable
 * @param wpforms_builder.no_results_found
 * @param wpforms_builder.smart_tags
 * @param wpforms_builder.smart_tags_button_tooltip
 * @param wpforms_builder.smart_tags_disabled_for_fields
 * @param wpforms_builder.smart_tags_dropdown_title
 * @param wpforms_builder.smart_tags_edit_ok_button
 * @param wpforms_builder.smart_tags_delete_button
 * @param wpforms_builder.smart_tags_edit
 * @param wpforms_builder.smart_tags_unknown_field
 * @param wpforms_builder.smart_tags_templates
 * @param wpforms_builder.smart_tags_arg
 */

// noinspection ES6ConvertVarToLetConst
/**
 * Form Builder Smart Tags module.
 *
 * @since 1.9.5
 */

var WPForms = window.WPForms || {}; // eslint-disable-line no-var

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.SmartTags = WPForms.Admin.Builder.SmartTags || ( function( document, window, $ ) {
	/**
	 * Elements holder.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const el = {};

	/**
	 * Saved ranges holder.
	 *
	 * @since 1.9.5
	 *
	 * @type {Object}
	 */
	const savedRanges = new WeakMap();

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
		 * DOM is fully loaded.
		 *
		 * @since 1.9.5
		 */
		ready() {
			app.setup();
			app.events();
		},

		/**
		 * Setup. Prepare some variables.
		 *
		 * @since 1.9.5
		 */
		setup() {
			// Cache DOM elements.
			el.$builder = $( '#wpforms-builder' );
		},

		/**
		 * Bind events.
		 *
		 * @since 1.9.5
		 */
		events() {
			el.$builder
				.on( 'wpformsBuilderReady', () => {
					app.initWidgets( el.$builder );
				} )
				.on( 'wpformsBuilderReady', app.initDropdowns )
				.on( 'connectionsDataLoaded', app.initWidgetsInConnections )
				.on( 'connectionRendered', app.initWidgetsInConnections )
				.on( 'wpformsSettingsBlockAdded wpformsSettingsBlockCloned ', app.reinitWidgetInClone )
				.on( 'wpformsFieldAdd', app.fieldAdd )
				.on( 'wpformsFieldDuplicated', app.fieldDuplicated )
				.on( 'change', '.wpforms-field-option-row-label input', app.fieldLabelChangeEvent );

			// Open the dropdown on click.
			el.$builder.on( 'click', '.wpforms-show-smart-tags, .mce-wpforms-smart-tags-mce-button', function() {
				app.showSmartTagDropdown( $( this ) );
			} );

			$( document )
				.on( 'wpformsFieldUpdate', app.initDropdowns )
				.on( 'click', '.wpforms-smart-tags-widget .tag', app.smartTagClick );
		},

		/**
		 * Init widgets.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $scope The scope where the widgets should be initialized.
		 */
		// eslint-disable-next-line max-lines-per-function
		initWidgets( $scope = el.$builder ) {
			const $smartTagsInputs = $scope.find( '.wpforms-smart-tags-enabled' );

			// eslint-disable-next-line max-lines-per-function,complexity
			$smartTagsInputs.each( function() {
				// Skip if the element is already initialized.
				if ( $( this ).hasClass( 'wpforms-smart-tags-widget-original' ) ) {
					return;
				}

				const $element = $( this );
				const widgetType = $element.is( 'input' ) ? 'input' : 'textarea';
				const widgetTypeClass = 'wpforms-smart-tags-widget-' + widgetType;
				const isReadonly = $element.prop( 'readonly' ) || $element.prop( 'disabled' );
				const readonlyClass = isReadonly ? 'wpforms-readonly' : '';

				// Create a new div with the required attributes and content.
				const $widgetContainer = $( '<div>', {
					class: 'wpforms-smart-tags-widget-container',
				} );

				// Insert the widget container before the current element.
				$element.before( $widgetContainer );

				// Create a new div with the required attributes and content.
				const $widget = $( '<div>', {
					class: [ 'wpforms-smart-tags-widget', widgetTypeClass, readonlyClass ].filter( Boolean ).join( ' ' ),
					contenteditable: ! isReadonly ? 'true' : 'false',
					spellcheck: 'false',
					text: $element.val(),
				} );

				// Append the widget to the container.
				$widgetContainer.append( $widget );

				// Append the show smart tags button.
				$widgetContainer.append( '<span class="wpforms-show-smart-tags"><i class="fa fa-tags"></i></span>' );

				// Add class to the original input field.
				$element.addClass( 'wpforms-smart-tags-widget-original' );

				// Listen for the input disable/readonly state change.
				app.setupOriginalInputObserver( $element );

				// Listen to the sync event to update the widget content when the original input is updated.
				$element.on( 'wpformsSmartTagsInputSync', function() {
					app.syncWidgetContent( $element, $widget );
				} );

				// Attach the input event listener to the newly created widget.
				$widget.on( 'input', app.renderWidgetContent );

				// Save the caret position on focus, blur, keyup, and mouseup events.
				$widget.on( 'focus blur keyup mouseup', function() {
					app.saveCaretPosition( $widget[ 0 ] );
				} );

				// Mimic the focusout event for the original input.
				$widget.on( 'focusout', function() {
					$element.trigger( 'focusout' );
				} );

				// Prevent the Enter key from creating a new line.
				$widget.on( 'keydown', function( event ) {
					if ( widgetType === 'input' && event.key === 'Enter' ) {
						event.preventDefault();
					}

					if ( widgetType === 'textarea' && event.key === 'Enter' && ! event.shiftKey ) {
						event.preventDefault();
						app.insertLineBreak();
					}
				} );

				// Attach the paste event listener only once.
				if ( ! $widget.data( 'pasteHandlerAttached' ) ) {
					$widget.on( 'paste', ( event ) => {
						event.preventDefault();

						if ( $widget.hasClass( 'wpforms-readonly' ) ) {
							return;
						}

						// Insert the text using Range API.
						const selection = document.defaultView.getSelection();

						if ( ! selection.rangeCount ) {
							return;
						}

						// Get plain text from the clipboard.
						const text = event.originalEvent.clipboardData.getData( 'text/plain' );
						const range = selection.getRangeAt( 0 );

						// Remove selected content, if any.
						range.deleteContents();

						// Insert it as a text.
						range.insertNode( document.createTextNode( text ) );

						// Place the cursor at the end of the inserted text.
						range.collapse( false );

						// Trigger the input event for the widget
						app.renderWidgetContent( { target: $widget[ 0 ] }, true, 'end' );
					} );

					$widget.data( 'pasteHandlerAttached', true );
				}

				app.renderWidgetContent( { target: $widget[ 0 ] }, true );

				// Trigger custom initialization event
				WPFormsUtils.triggerEvent( $widget, 'wpformsSmartTagWidgetInitialized' );

				// Init tooltip.
				app.initTooltip( $widget );
			} );
		},

		/**
		 * Re-init Smart Tags widgets in given scope.
		 *
		 * @since 1.9.5
		 *
		 *
		 * @param {jQuery} $scope Scope where widgets should be reinitialized.
		 */
		reinitWidgets( $scope ) {
			// Destroy Smart Tags widgets.
			$scope.find( '.wpforms-smart-tags-widget-container' ).each( function() {
				const $this = $( this );
				$this.next( '.wpforms-smart-tags-enabled' ).removeClass( 'wpforms-smart-tags-widget-original' );
				$this.remove();
			} );

			// Init Smart Tags widgets again.
			app.initWidgets( $scope );
		},

		/**
		 * Re-init Smart Tags widgets in the cloned block.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object } event  Event.
		 * @param {jQuery}  $clone Cloned block.
		 */
		reinitWidgetInClone( event, $clone ) {
			app.reinitWidgets( $clone );
		},

		/**
		 * Init Smart Tags widgets in loaded connections.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object } event Event.
		 */
		initWidgetsInConnections( event ) {
			const $target = $( event.target );

			app.initWidgets( $target );
		},

		/**
		 * Event handler for `input` event for smart tag widgets.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object}  e              Event object.
		 * @param {boolean} forceUpdate    Force update the widget content.
		 * @param {string}  cursorPosition Cursor position.
		 */
		renderWidgetContent( e, forceUpdate = false, cursorPosition = '' ) { // eslint-disable-line max-lines-per-function, complexity
			const widget = e.target;

			// Skip if cursor located inside the editable tag.
			if ( widget.classList.contains( 'tag' ) ) {
				return;
			}

			// Normalize the widget content.
			// In a normalized subtree, no text nodes in the subtree are empty and there are no adjacent text nodes.
			widget.normalize();

			// Save the current cursor position.
			const selection = document.defaultView.getSelection();

			if ( ! selection.rangeCount && ! forceUpdate ) {
				return;
			}

			const nodes = Array.from( widget.childNodes );
			let lastInsertedTag = null;

			// Process all text nodes.
			nodes.forEach( ( node ) => {
				if ( node.nodeType !== Node.TEXT_NODE ) {
					return;
				}

				let text = node.nodeValue;
				const tagRegex = /{([^{}]+)}/g;
				let match;

				while ( ( match = tagRegex.exec( text ) ) !== null ) {
					const tagValue = wpf.sanitizeHTML( match[ 1 ].trim() );
					const fullMatch = match[ 0 ];

					// If it's an email smart tag, remove the curly braces.
					const result = app.handleEmailTag( fullMatch, tagValue, match, text, node );
					if ( result.handled ) {
						text = result.text;
						node = result.node;
						continue;
					}

					const tagTitle = app.getSmartTagTitle( tagValue );
					const tagElement = document.createElement( 'span' );
					tagElement.classList.add( 'tag' );
					tagElement.contentEditable = 'false';
					tagElement.setAttribute( 'data-value', tagValue );
					tagElement.innerText = tagTitle;

					const removeIcon = document.createElement( 'i' );
					removeIcon.classList.add( 'fa', 'fa-times-circle' );
					removeIcon.setAttribute( 'title', wpforms_builder.smart_tags_delete_button );

					// Remove the tag when the remove icon is clicked.
					removeIcon.addEventListener( 'click', () => {
						tagElement.remove();
						app.updateOriginalInput( widget );
					} );

					tagElement.appendChild( removeIcon );

					const beforeText = text.slice( 0, match.index );
					const afterText = text.slice( match.index + fullMatch.length );

					const beforeNode = document.createTextNode( beforeText );
					const afterNode = document.createTextNode( afterText );

					const parent = node.parentNode;
					parent.insertBefore( beforeNode, node );
					parent.insertBefore( tagElement, node );
					parent.insertBefore( afterNode, node );
					parent.removeChild( node );

					text = afterText;
					node = afterNode;

					lastInsertedTag = tagElement;

					tagRegex.lastIndex = 0;
				}
			} );

			// Restore cursor position.
			if ( lastInsertedTag && ! forceUpdate ) {
				const restoredRange = document.createRange();

				// Place the cursor after the last inserted tag.
				restoredRange.setStartAfter( lastInsertedTag );
				restoredRange.collapse( true );
				selection.removeAllRanges();
				selection.addRange( restoredRange );
			}

			// Set the cursor position to the end of the widget.
			if ( cursorPosition === 'end' ) {
				const range = document.createRange();
				range.selectNodeContents( widget );
				range.collapse( false );
				selection.removeAllRanges();
				selection.addRange( range );
			}

			// Update the original input with the new content.
			app.updateOriginalInput( widget );
		},

		/**
		 * Update the original input field with the text content of the widget.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} widget Widget element.
		 */
		updateOriginalInput( widget ) {
			const $widget = $( widget );
			const $originalInput = $widget.parent().next( '.wpforms-smart-tags-widget-original' );

			if ( ! $originalInput.length ) {
				return;
			}

			const value = app.getWidgetContent( widget );

			$originalInput.val( value );

			// If input is readonly, don't trigger the input event.
			if ( $widget.hasClass( 'wpforms-readonly' ) ) {
				return;
			}

			$originalInput.trigger( 'input' );
		},

		/**
		 * Get the Smart Tag title.
		 *
		 * @since 1.9.5
		 *
		 * @param {string} value The Smart Tag value.
		 *
		 * @return {string} The Smart Tag title.
		 */
		getSmartTagTitle( value ) { // eslint-disable-line complexity
			if ( ! value ) {
				return '';
			}

			value = value.toString().trim();

			const tagTitle = app.getSmartTagFieldTitle( value ) ||
				app.getSmartTagWithArgsTitle( value ) ||
				wpforms_builder.smart_tags[ value ];

			return tagTitle ? tagTitle : value;
		},

		/**
		 * Get the `field_id="N"` Smart Tag title.
		 *
		 * @since 1.9.5
		 *
		 * @param {string} value The Smart Tag value.
		 *
		 * @return {string} The Smart Tag title.
		 */
		getSmartTagFieldTitle( value ) { // eslint-disable-line complexity
			// Parse value for the tags field_id, field_value_id, field_html_id and `="N"` or `="N|subfield"`.
			const matches = value.match( /^(field_id|field_value_id|field_html_id)="(\d+)?(\|[^"]+)?"$/ );

			if ( ! matches || ! matches.length ) {
				return '';
			}

			const tag = matches[ 1 ];
			const fieldId = matches[ 2 ];
			const subField = matches[ 3 ] ? matches[ 3 ].replace( '|', '' ) : '';

			// Prepare the `#ID: Field Label` string.
			let fieldIdLabelString = `[ ${ wpforms_builder.smart_tags_edit } ID ]`;

			if ( fieldId ) {
				const subFieldCapitalize = subField.length ? subField.charAt( 0 ).toUpperCase() + subField.slice( 1 ) : '';
				const subFieldLabel = subField.length ? ` - ${ subFieldCapitalize }` : '';

				// Get the field label.
				let fieldLabel = fieldId ? $( `#wpforms-field-option-${ fieldId }-label` ).val() : '';
				fieldLabel = ( fieldLabel || wpforms_builder.smart_tags_unknown_field ) + subFieldLabel;

				fieldIdLabelString = `#${ fieldId }: ${ fieldLabel }`;
			}

			// Return formatted Smart Tag title.
			return wpforms_builder.smart_tags_templates[ tag ]
				.replace( '%1$s', fieldIdLabelString );
		},

		/**
		 * Get the `field_id="N"` Smart Tag title.
		 *
		 * @since 1.9.5
		 *
		 * @param {string} value The Smart Tag value.
		 *
		 * @return {string} The Smart Tag title.
		 */
		getSmartTagWithArgsTitle( value ) {
			// Parse value for the `query_var`, `user_meta`, `date` and `key="foo"` or `format="foo"`.
			const matches = value.match( /^(query_var|user_meta|date|entry_date) (key|format)="([^"]+)?"$/ );

			if ( ! matches || ! matches.length ) {
				return '';
			}

			const tag = matches[ 1 ];
			const arg = matches[ 2 ] || wpforms_builder.smart_tags_arg;
			const key = matches[ 3 ] || `[ ${ wpforms_builder.smart_tags_edit } ${ arg } ]`;

			// Return formatted Smart Tag title.
			return wpforms_builder.smart_tags_templates[ tag ]
				.replace( '%1$s', key );
		},

		/**
		 * Handle the field label change event.
		 *
		 * @since 1.9.5
		 */
		fieldLabelChangeEvent() {
			app.updateSmartTagsTitles( el.$builder );
		},

		/**
		 * Update the Smart Tags titles.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $scope Scope.
		 */
		updateSmartTagsTitles( $scope ) {
			$scope.find( '.wpforms-smart-tags-widget .tag' ).each( function() {
				const $tag = $( this );
				const $close = $tag.find( 'i' ).detach();

				$tag
					.text( app.getSmartTagTitle( $tag.data( 'value' ) ) )
					.append( $close );
			} );
		},

		/**
		 * Get the text content of the smart tag widget.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} widget Widget element.
		 *
		 * @return {string} Text content of the widget without html.
		 */
		getWidgetContent( widget ) {
			if ( ! widget || ! widget.childNodes ) {
				return '';
			}

			let content = '';

			// Iterate through all child nodes of the widget.
			widget.childNodes.forEach( ( node ) => {
				if ( node.nodeType === Node.TEXT_NODE ) {
					// If it's a text node, add its value to the content
					content += node.nodeValue.replaceAll( '\u200B', '' );
					return;
				}

				if ( node.nodeType === Node.ELEMENT_NODE && node.nodeName === 'BR' ) {
					content += `\n`;
					return;
				}

				if ( node.nodeType === Node.ELEMENT_NODE && node.classList.contains( 'tag' ) ) {
					// If it's a "brick" (smart tag), add its {value} to the content.
					const tagValue = $( node ).data( 'value' );
					content += `{${ tagValue }}`;
				}
			} );

			return content.trim();
		},

		/**
		 * Init the show Smart Tags button tooltip.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $widget widget jQuery object.
		 */
		initTooltip( $widget ) {
			const $button = $widget.next( '.wpforms-show-smart-tags' );

			//Define the tooltipster args.
			const args = {
				content: wpforms_builder.smart_tags_button_tooltip,
				contentAsHTML: true,
				interactive: true,
				animationDuration: 100,
				delay: [ 1500, 200 ],
				side: [ 'top' ],
				maxWidth: 270,
				functionBefore( instance, helper ) {
					if ( $( helper.origin ).hasClass( 'active' ) ) {
						return false; // Prevent showing the tooltip.
					}
				},
			};

			// Initialize.
			$button.tooltipster( args );
		},

		/**
		 * Click the Smart Tag.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e Event.
		 */
		smartTagClick( e ) {
			const $tag = $( this );

			// Skip if the click was on the remove icon.
			if ( ! $tag.is( e.target ) || $tag.attr( 'contenteditable' ) === 'true' ) {
				return;
			}

			e.preventDefault();

			const value = $tag.data( 'value' );
			const $close = $tag.find( 'i' ).detach();

			const $editOk = $( '<i class="tag-edit-ok fa fa-check-circle"></i>' )
				.attr( 'title', wpforms_builder.smart_tags_edit_ok_button );

			$tag
				.attr( 'contenteditable', true )
				.data( 'restore', value )
				.data( 'close', $close )
				.css( 'min-width', $tag.outerWidth() )
				.text( value )
				.after( $editOk )
				.parent()
				.attr( 'contenteditable', false );

			if ( ! $tag.data( 'bind-events' ) ) {
				$tag
					.on( 'blur', app.smartTagBlurEvent )
					.on( 'keydown', app.smartTagKeyDown )
					.data( 'bind-events', true );
			}

			app.setCaretSmartTagEnd( $tag );

			setTimeout( () => $tag.focus(), 0 );
		},

		/**
		 * The Smart Tag blur event handler.
		 *
		 * @since 1.9.5
		 */
		smartTagBlurEvent() {
			const $tag = $( this );

			if ( $tag.attr( 'contenteditable' ) === 'true' ) {
				app.smartTagBlur( $tag );
			}
		},

		/**
		 * Blur the Smart Tag.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery}  $tag    Tag element.
		 * @param {boolean} restore Restore the Smart Tag.
		 */
		smartTagBlur( $tag, restore = false ) {
			let value = restore ? $tag.data( 'restore' ) : $tag.text();

			// Remove curly braces from tag value if they exist.
			// It is necessary to avoid further issues as the value already wrapped by the curly braces.
			value = value.replace( /\{|\}/g, '' ).trim();
			value = wpf.sanitizeHTML( value );

			$tag
				.data( 'value', value )
				.attr( 'data-value', value )
				.text( app.getSmartTagTitle( value ) )
				.attr( 'style', null )
				.append( $tag.data( 'close' ) )
				.attr( 'contenteditable', false )
				.next( '.tag-edit-ok' ).remove(); // Remove the Ok button (check icon).

			const $widget = $tag.parent();

			$widget
				.attr( 'contenteditable', true )
				.trigger( 'input' );

			app.setCaretAfterSmartTag( $tag );
		},

		/**
		 * Set the caret position in the widget after the Smart Tag.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $tag The Smart Tag element.
		 */
		setCaretAfterSmartTag( $tag ) {
			if ( ! $tag || ! $tag.length ) {
				return;
			}

			// Set the caret position after the tag element.
			const selection = document.defaultView.getSelection();
			const range = document.createRange();
			const parentNode = $tag[ 0 ].parentNode;

			// Find the position of the tag in the parent's childNodes.
			for ( let i = 0; i < parentNode.childNodes.length; i++ ) {
				if ( parentNode.childNodes[ i ] === $tag[ 0 ] ) {
					// Set range position after the tag.
					range.setStart( parentNode, i + 1 );
					range.collapse( true );

					// Apply the range to selection.
					selection.removeAllRanges();
					selection.addRange( range );
					return;
				}
			}
		},

		/**
		 * Set the caret position at the end of the Smart Tag value.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $tag The Smart Tag element.
		 */
		setCaretSmartTagEnd( $tag ) {
			if ( ! $tag || ! $tag.length ) {
				return;
			}

			// Set the caret position after the tag element.
			const selection = document.defaultView.getSelection();
			const range = document.createRange();

			range.selectNodeContents( $tag[ 0 ] );
			range.collapse( false );

			// Apply the range to selection.
			selection.removeAllRanges();
			selection.addRange( range );
		},

		/**
		 * The Smart Tag Key Down event.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e Event.
		 */
		smartTagKeyDown( e ) {
			const $tag = $( this );

			switch ( e.code ) {
				case 'Enter':
					e.preventDefault();
					e.stopImmediatePropagation();
					app.smartTagBlur( $tag, false );
					break;

				case 'Escape':
					e.preventDefault();
					e.stopImmediatePropagation();
					app.smartTagBlur( $tag, true );
					break;

				default:
			}
		},

		/**
		 * Init dropdown lists.
		 *
		 * @since 1.9.5
		 */
		initDropdowns() {
			el.$builder.find( '.wpforms-show-smart-tags, .mce-wpforms-smart-tags-mce-button' ).each( function() {
				const $button = $( this ),
					dropdownList = $button.data( 'dropdown-list' );

				// Destroy the dropdown list if it exists.
				if ( dropdownList ) {
					dropdownList.destroy();
				}

				// Initialize the dropdown list.
				app.getDropdownListInstance( $button );

				$button.removeClass( 'active' );
			} );
		},

		/**
		 * Get the DropdownList instance of the Smart tag button.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $button Insert Field button jQuery object.
		 *
		 * @return {DropdownList|null} DropdownList instance.
		 */
		getDropdownListInstance( $button ) {
			let dropdownList = $button.data( 'dropdown-list' );

			// Return the existing DropdownList instance if it exists.
			if ( dropdownList ) {
				return dropdownList;
			}

			// Check if the button is inside the TinyMCE editor.
			const isMceButton = $button.hasClass( 'mce-wpforms-smart-tags-mce-button' );
			const originalInput = isMceButton ? $button.closest( '.wp-editor-container' ).find( 'textarea' ) : $button.closest( '.wpforms-smart-tags-widget-container' ).next( '.wpforms-smart-tags-widget-original' );
			const id = originalInput?.attr( 'id' );
			const isFieldOption = id ? id.includes( 'wpforms-field-option-' ) : false;

			// Copy the data attributes from the original input to the button.
			const attributesToCopy = [ 'location', 'type', 'fields', 'allow-repeated-fields' ];

			attributesToCopy.forEach( ( attr ) => {
				const dataValue = originalInput.data( attr );
				if ( dataValue !== undefined ) {
					$button.attr( `data-${ attr }`, dataValue );
				}
			} );

			// Get the Smart Tags list.
			const list = app.getSmartTagsList( $button, isFieldOption );

			// Bail and disable the button if there are no variables in the list.
			if ( ! list.length ) {
				$button.addClass( 'disabled' );

				return null;
			}

			$button.removeClass( 'disabled' );

			// Initialize the DropdownList instance.
			dropdownList = app.initDropdownInstance( $button, list, isMceButton );

			// Save the DropdownList instance to the button.
			$button.data( 'dropdown-list', dropdownList );

			return dropdownList;
		},

		/**
		 * Init Dropdown instance with given options.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery}  $button     Insert Field button jQuery object.
		 * @param {Array}   list        List of Smart Tags.
		 * @param {boolean} isMceButton Is a TinyMCE button.
		 *
		 * @return {Object} Dropdown Instance.
		 */
		initDropdownInstance( $button, list, isMceButton = false ) {
			const $container = app.getDropdownContainer( $button, isMceButton );

			return WPForms.Admin.Builder.DropdownList.init( {
				class: 'insert-smart-tag-dropdown',
				title: wpforms_builder.smart_tags_dropdown_title,
				list,
				container: $container,
				button: $button,
				search: {
					enabled: true,
					searchBy: [ 'wpforms-smart-tags-widget-item' ],
					placeholder: wpforms_builder.search,
					noResultsText: wpforms_builder.no_results_found,
				},
				noLeftOffset: true,
				itemFormat( item ) {
					const additionalAttr = item.additional ? ` data-additional="${ item.additional }"` : '';

					let format = `<span class="wpforms-smart-tags-widget-item"
						data-type="${ item.type }"${ additionalAttr }>
						${ item.text }
				    </span>`;

					// If the item is a heading, add a special class.
					if ( item?.heading ) {
						format = `<span class="heading">${ item.text }</span>`;
					}

					return format;
				},
				onSelect( event, value, text, $item, dropdownListInstance ) {
					// Don't close the dropdown if the heading is clicked.
					if ( $item.find( '.heading' ).length > 0 ) {
						return;
					}

					// Insert the selected Smart Tag.
					app.smartTagInsert( $item, value, dropdownListInstance );
				},
			} );
		},

		/**
		 * Get the appropriate dropdown container.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery}  $button     Insert Field button jQuery object.
		 * @param {boolean} isMceButton Is a TinyMCE button.
		 *
		 * @return {jQuery} Dropdown container.
		 */
		getDropdownContainer( $button, isMceButton ) {
			let $container = isMceButton
				? $button.closest( '.wp-editor-wrap' )
				: $button.closest( '.wpforms-smart-tags-widget-container' );

			// If the button is inside the table cell, get the closest table row.
			if ( $button.closest( 'td' ).length ) {
				$container = $button.parent().parent().parent();
			}

			return $container;
		},

		/**
		 * Click on button event handler.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $button Insert Field button jQuery object.
		 */
		showSmartTagDropdown( $button ) {
			// Close all opened dropdowns.
			$( '.insert-smart-tag-dropdown' ).each( function() {
				$( this ).addClass( 'closed' );
			} );

			// Get the Dropdown List instance.
			const dropdownList = app.getDropdownListInstance( $button );

			// Bail if the button is disabled and the list is empty.
			if ( ! dropdownList ) {
				return;
			}

			const isActive = $button.hasClass( 'active' );

			$button.toggleClass( 'active', ! isActive );

			// Close the dropdown and focus back to the editor.
			if ( isActive ) {
				dropdownList.close();

				return;
			}

			// Remove all active classes from the buttons except the current one.
			$( '.wpforms-show-smart-tags' ).not( $button ).removeClass( 'active' );

			// Open the dropdown.
			dropdownList.open();
		},

		/**
		 * Get a Smart Tag list.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery}  $el           Show a smart tags button element.
		 * @param {boolean} isFieldOption Is a field option.
		 *
		 * @return {Array} Smart Tags list array.
		 */
		getSmartTagsList( $el, isFieldOption ) {
			return [
				...app.getSmartTagsListFieldsElements( $el ),
				...app.getSmartTagsListOtherElements( $el, isFieldOption ),
			];
		},

		/**
		 * Get Smart Tag fields elements markup.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $el Show Smart Tag button.
		 *
		 * @return {Array} Smart Tags list elements markup.
		 */
		getSmartTagsListFieldsElements( $el ) {
			const type = $el.data( 'type' );

			if ( ! [ 'fields', 'all' ].includes( type ) ) {
				return [];
			}

			const fields = app.getSmartTagsFields( $el );

			// Bail if there are no fields and add a message to the list.
			if ( ! fields ) {
				return [
					{
						value: 0,
						heading: true,
						text: wpforms_builder.fields_unavailable,
					},
				];
			}

			const smartTagListElements = [];

			// Add a heading for the fields.
			smartTagListElements.push( {
				value: 0,
				text: wpforms_builder.fields_available,
				heading: true,
			} );

			// Add fields to the list.
			for ( const fieldKey in fields ) {
				smartTagListElements.push( ...app.getSmartTagsListFieldsElement( fields[ fieldKey ] ) );
			}

			return smartTagListElements;
		},

		/**
		 * Get fields that possible to create smart tag.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $el Button element.
		 *
		 * @return {Array} Fields for smart tags.
		 */
		getSmartTagsFields( $el ) {
			const allowed = $el.data( 'fields' );
			const isAllowedRepeater = $el.data( 'allow-repeated-fields' );
			const allowedFields = allowed ? allowed.split( ',' ) : undefined;

			return wpf.getFields( allowedFields, true, isAllowedRepeater );
		},

		/**
		 * Get field markup for the Smart Tags list.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} field A field.
		 *
		 * @return {Array} Smart Tags field markup.
		 */
		getSmartTagsListFieldsElement( field ) {
			const label = field.label
				? wpf.encodeHTMLEntities( wpf.sanitizeHTML( field.label ) )
				: wpforms_builder.field + ' #' + field.id;

			const item = [ {
				value: field.id,
				text: label,
				type: 'field',
			} ];

			const additionalTags = field.additional || [];

			// Add additional tags for `name`, `date/time` and `address` fields.
			if ( additionalTags.length > 1 ) {
				additionalTags.forEach( ( additionalTag ) => {
					// Capitalize the first letter and add space before numbers.
					const additionalTagLabel = additionalTag.charAt( 0 ).toUpperCase() + additionalTag.slice( 1 ).replace( /(\D)(\d)/g, '$1 $2' );
					item.push( {
						value: field.id,
						text: `${ label } – ${ additionalTagLabel }`,
						type: 'field',
						additional: additionalTag,
					} );
				} );
			}

			return item;
		},

		/**
		 * Get Smart Tag other elements' markup.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery}  $el           Button element.
		 * @param {boolean} isFieldOption Is a field option.
		 *
		 * @return {Array} Smart Tags list elements markup.
		 */
		// eslint-disable-next-line complexity
		getSmartTagsListOtherElements( $el, isFieldOption ) {
			const type = $el.data( 'type' );
			const smartTagListElements = [];

			// Bail if the type is not 'other' or 'all'.
			if ( type !== 'other' && type !== 'all' ) {
				return smartTagListElements;
			}

			// Add a heading for the other Smart Tags.
			smartTagListElements.push( {
				value: 0,
				text: wpforms_builder.other,
				heading: true,
			} );

			// Add the other Smart Tags to the list.
			for ( const smartTagKey in wpforms_builder.smart_tags ) {
				if (
					( isFieldOption && wpforms_builder.smart_tags_disabled_for_fields.includes( smartTagKey ) ) ||
					(
						$el.data( 'location' ) === 'confirmations' &&
						wpforms_builder.smart_tags_disabled_for_confirmations.includes( smartTagKey )
					)
				) {
					continue;
				}

				smartTagListElements.push( {
					value: smartTagKey,
					type: 'other',
					text: wpforms_builder.smart_tags[ smartTagKey ],
				} );
			}

			return smartTagListElements;
		},

		/**
		 * Smart Tag insert.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $el              Selected a Smart Tag li element.
		 * @param {string} value            Selected Smart Tag value.
		 * @param {Object} dropdownInstance DropdownList instance.
		 */
		smartTagInsert( $el, value, dropdownInstance ) {
			const $this = $el.find( 'span' ),
				$widget = $el.parent().parent().parent().find( '.wpforms-smart-tags-widget' ),
				meta = value,
				additional = $this.data( 'additional' ) ? '|' + $this.data( 'additional' ) : '',
				type = $this.data( 'type' ),
				isMCE = dropdownInstance.$button.hasClass( 'mce-wpforms-smart-tags-mce-button' );

			// Prepare the Smart Tag.
			let smartTag = type === 'field' ? '{field_id="' + meta + additional + '"}' : '{' + meta + '}';
			smartTag = ' ' + smartTag + ' ';

			if ( ! isMCE ) {
				// Restore the caret position for the widget.
				app.restoreCaretPosition( $widget[ 0 ] );

				// Insert the Smart Tag at the current cursor position.
				app.insertTagAtCaret( $widget[ 0 ], smartTag );
			} else {
				// Insert the Smart Tag at the current cursor position.
				app.insertSmartTagToTinyMCE( dropdownInstance, smartTag );
			}

			// Close the dropdown.
			dropdownInstance.$button.removeClass( 'active' );
			dropdownInstance.close();
		},

		/**
		 * Smart Tag insert to TinyMCE.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} dropdownInstance DropdownList instance.
		 * @param {string} smartTag         Selected a Smart Tag text.
		 */
		insertSmartTagToTinyMCE( dropdownInstance, smartTag ) {
			if ( typeof tinyMCE === 'undefined' ) {
				return;
			}

			// Get the TinyMCE editor instance.
			const inputId = dropdownInstance.$button.closest( '.wp-editor-container' ).find( 'textarea' ).attr( 'id' );
			const editor = tinyMCE.get( inputId );

			// Bail if the editor is not available.
			if ( ! editor ) {
				return;
			}

			// Focus on the editor.
			if ( ! editor.hasFocus() ) {
				editor.focus( true );
			}

			// Insert the Smart Tag at the current cursor position.
			editor.insertContent( smartTag );
		},

		/**
		 * Save caret position for widget.
		 *
		 * @param {Object} widget Widget object.
		 *
		 * @since 1.9.5
		 */
		saveCaretPosition( widget ) {
			// eslint-disable-next-line @wordpress/no-global-get-selection
			const selection = window.getSelection();

			if ( ! selection.rangeCount ) {
				return;
			}

			const range = selection.getRangeAt( 0 );

			// Save the range if the widget contains the start container.
			if ( widget.contains( range.startContainer ) ) {
				savedRanges.set( widget, range );
			}
		},

		/**
		 * Restore the caret position.
		 *
		 * @param {Object} widget Widget object.
		 *
		 * @since 1.9.5
		 */
		restoreCaretPosition( widget ) {
			const range = savedRanges.get( widget );

			const selection = widget.ownerDocument.defaultView.getSelection();

			// Restore the caret position. If the range is not available, set the caret to the end of the widget.
			if ( range ) {
				selection.removeAllRanges();
				selection.addRange( range );
			} else {
				const fallbackRange = document.createRange();
				fallbackRange.selectNodeContents( widget );
				fallbackRange.collapse( false );
				selection.removeAllRanges();
				selection.addRange( fallbackRange );
			}

			// Focus back to the widget.
			widget.focus();
		},

		/**
		 * Insert text at the current cursor position.
		 *
		 * @param {Object} widget Widget object.
		 * @param {string} text   Text to insert.
		 *
		 * @since 1.9.5
		 */
		insertTagAtCaret( widget, text ) {
			// Get the current selection.
			const selection = document.defaultView.getSelection();
			const range = selection.getRangeAt( 0 );

			// Create a text node with the provided text.
			const textNode = document.createTextNode( text );

			// Insert text into the current cursor position.
			range.deleteContents();
			range.insertNode( textNode );

			// Move the cursor after the inserted text.
			range.setStartAfter( textNode );
			range.setEndAfter( textNode );

			// Set updated range.
			selection.removeAllRanges();
			selection.addRange( range );

			// Re-render the widget content.
			app.renderWidgetContent( { target: widget }, true );

			// Focus back to the widget.
			widget.focus();

			// Scroll to the cursor position if it's out of view.
			this.scrollToCursorPosition( widget );
		},

		/**
		 * Scroll to the cursor position if it's outside the visible area.
		 *
		 * @param {Element} container The container element to scroll.
		 *
		 * @since 1.9.5
		 */
		scrollToCursorPosition( container ) {
			// Wait for the DOM to update.
			setTimeout( () => { // eslint-disable-line complexity
				// Create a temporary marker element.
				const tempMarker = document.createElement( 'span' );
				tempMarker.style.display = 'inline-block';
				tempMarker.style.width = '0px';
				tempMarker.style.height = '0px';

				// Get current selection and range.
				const selection = document.getSelection();

				if ( ! selection.rangeCount ) {
					return;
				}

				// Clone the range to avoid modifying the actual selection.
				const currentRange = selection.getRangeAt( 0 ).cloneRange();
				currentRange.collapse( true );

				// Insert the marker at the current position.
				currentRange.insertNode( tempMarker );

				// Get the marker and container positions.
				const markerRect = tempMarker.getBoundingClientRect();
				const containerRect = container.getBoundingClientRect();

				// Check if the marker is outside the visible area horizontally.
				const isMarkerHorizontallyVisible = markerRect.left >= containerRect.left &&
					markerRect.right <= containerRect.right;

				// Check if the marker is outside the visible area vertically.
				const isMarkerAbove = markerRect.top < containerRect.top;
				const isMarkerBelow = markerRect.bottom > containerRect.bottom;

				// If the marker is not visible horizontally, scroll to make it visible.
				if ( ! isMarkerHorizontallyVisible && markerRect.left > 0 ) {
					// Calculate the scroll amount needed to make the marker visible.
					const scrollAmount = markerRect.left - containerRect.left - ( containerRect.width / 2 );

					// Scroll the container horizontally.
					container.scrollLeft += scrollAmount;
				}

				// If the marker is not visible vertically, scroll to make it visible.
				if ( isMarkerAbove ) {
					container.scrollTop -= ( containerRect.top - markerRect.top + 20 );
				} else if ( isMarkerBelow ) {
					container.scrollTop += ( markerRect.bottom - containerRect.bottom + 20 );
				}

				// Remove the temporary marker.
				if ( tempMarker.parentNode ) {
					tempMarker.parentNode.removeChild( tempMarker );
				}
			}, 50 ); // Small delay to ensure the DOM has updated.
		},

		/**
		 * Insert a line break at the current cursor position.
		 *
		 * @since 1.9.5
		 */
		insertLineBreak() {
			const selection = document.getSelection();

			if ( ! selection.rangeCount ) {
				return;
			}

			const range = selection.getRangeAt( 0 );
			const br = document.createElement( 'br' );

			// Insert the line break.
			range.deleteContents();
			range.insertNode( br );

			// Remove any zero-width spaces in the widget.
			app.removeZeroWidthSpaces( br.parentNode );

			// Insert a zero-width space after the line break to ensure the cursor can move to the next line.
			const textNode = document.createTextNode( '\u200B' );
			range.setStartAfter( br );
			range.insertNode( textNode );

			// Move the cursor after the inserted line break and zero-width space.
			range.setStartAfter( textNode );
			range.setEndAfter( textNode );
			selection.removeAllRanges();
			selection.addRange( range );

			// Scroll to cursor position if it's out of view.
			this.scrollToCursorPosition( br.parentNode );

			// Get the widget element that contains the cursor.
			const widget = br.closest( '.wpforms-smart-tags-widget' );

			// Update the original input with the new content including the line break.
			if ( widget ) {
				this.updateOriginalInput( widget );
			}
		},

		/**
		 * Check if the tag is an email tag and remove curly braces.
		 *
		 * @since 1.9.5
		 *
		 * @param {string}    fullMatch The full match.
		 * @param {string}    tagValue  The tag value.
		 * @param {Array}     match     The match.
		 * @param {string}    text      The text.
		 * @param {Node|null} node      The node.
		 *
		 * @return {Object} The result.
		 */
		handleEmailTag( fullMatch, tagValue, match, text, node ) {
			const emailRegex = /^{[^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*@([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}}$/;

			if ( emailRegex.test( fullMatch ) ) {
				const beforeText = text.slice( 0, match.index );
				const afterText = text.slice( match.index + fullMatch.length );
				const beforeNode = document.createTextNode( beforeText );
				const emailNode = document.createTextNode( tagValue );
				const afterNode = document.createTextNode( afterText );

				const parent = node.parentNode;
				parent.insertBefore( beforeNode, node );
				parent.insertBefore( emailNode, node );
				parent.insertBefore( afterNode, node );
				parent.removeChild( node );

				return { handled: true, text: afterText, node: afterNode };
			}

			return { handled: false };
		},

		/**
		 * Init dropdowns for newly added fields.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e       Event object.
		 * @param {number} fieldId Field ID.
		 */
		fieldAdd( e, fieldId ) {
			const $fieldSettingsWrapper = $( `#wpforms-field-option-${ fieldId }` );

			app.initWidgets( $fieldSettingsWrapper );
		},

		/**
		 * Re-init widgets for duplicated field.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} e          Event object.
		 * @param {number} id         Field ID.
		 * @param {Object} $field     Field jQuery object.
		 * @param {number} newFieldId New field ID.
		 */
		fieldDuplicated( e, id, $field, newFieldId ) {
			const $fieldSettingsWrapper = $( `#wpforms-field-option-${ newFieldId }` );

			app.reinitWidgets( $fieldSettingsWrapper );
		},

		/**
		 * Setup observer for original input readonly and disabled attributes changes.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $element Original input element.
		 */
		setupOriginalInputObserver( $element ) {
			if ( ! window.MutationObserver || ! $element || ! $element[ 0 ] ) {
				return;
			}

			const builder = el.$builder[ 0 ];
			const element = $element[ 0 ];

			// Check if the element is still in the DOM.
			if ( ! builder.contains( element ) ) {
				return;
			}

			// Create a new observer.
			const observer = new MutationObserver( ( mutations ) => {
				if ( mutations.length ) {
					app.reinitWidgets( $element.parent() );
				}
			} );

			observer.observe( element, { attributes: true, attributeFilter: [ 'readonly', 'disabled' ] } );

			// Remove the observer when the element is removed from the DOM.
			const parentObserver = new MutationObserver( () => {
				if ( ! builder.contains( element ) ) {
					observer.disconnect();
					parentObserver.disconnect();
				}
			} );

			parentObserver.observe( builder, { childList: true, subtree: true, attributes: false } );
		},

		/**
		 * Sync the widget content with the original input content via re-init.
		 *
		 * @since 1.9.5
		 *
		 * @param {jQuery} $element Original input element.
		 * @param {jQuery} $widget  Widget element.
		 */
		syncWidgetContent( $element, $widget ) {
			if ( $widget.text() !== $element.val() ) {
				app.reinitWidgets( $widget.parent().parent() );
			}
		},

		/**
		 * Remove zero-width spaces while preserving HTML structure.
		 *
		 * @since 1.9.5
		 *
		 * @param {Object} widget Widget object.
		 */
		removeZeroWidthSpaces( widget ) {
			// Use TreeWalker to find all text nodes in the widget.
			const walker = document.createTreeWalker(
				widget,
				NodeFilter.SHOW_TEXT,
				null,
				false
			);

			let currentNode;

			// Replace zero-width spaces with empty string.
			while ( ( currentNode = walker.nextNode() ) ) {
				if ( currentNode.nodeValue.includes( '\u200B' ) ) {
					currentNode.nodeValue = currentNode.nodeValue.replaceAll( '\u200B', '' );
				}
			}
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

// Initialize.
WPForms.Admin.Builder.SmartTags.init();
