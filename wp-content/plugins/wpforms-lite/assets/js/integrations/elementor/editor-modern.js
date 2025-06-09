/* global elementor, elementorCommon, wpformsElementorVars, elementorFrontend, Choices */

/**
 * @param elementorCommon.dialogsManager.createWidget
 * @param wpformsElementorVars.isPro
 */

// noinspection ES6ConvertVarToLetConst
/**
 * WPForms integration with Elementor (modern widget).
 *
 * @since 1.8.3
 */
var WPFormsElementorModern = window.WPFormsElementorModern || ( function( document, window, $ ) { // eslint-disable-line no-var
	/**
	 * Localized data aliases.
	 *
	 * @since 1.9.6
	 */

	/**
	 * @type {Object}
	 * @property {string} license_button  License button.
	 * @property {string} license_message License message.
	 * @property {string} license_url     License URL.
	 * @property {string} pro_sections    Pro sections.
	 * @property {string} upgrade_button  Upgrade button.
	 */
	const strings = wpformsElementorVars.strings;
	const routeNamespace = wpformsElementorVars.route_namespace;
	const pictureUrlPath = wpformsElementorVars.stockPhotos?.urlPath;
	const { isPro, isLicenseActive } = wpformsElementorVars;

	/**
	 * Stock photos pictures' list.
	 *
	 * @since 1.9.6
	 *
	 * @type {Array}
	 */
	let pictures = wpformsElementorVars.stockPhotos?.pictures ?? [];

	/**
	 * Stock photos picture selector markup.
	 *
	 * @since 1.9.6
	 *
	 * @type {string}
	 */
	let picturesMarkup = '';

	/**
	 * Runtime state.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const state = {};

	/**
	 * Widget sections list.
	 *
	 * @since 1.9.6
	 *
	 * @type {Array}
	 */
	const widgetSections = [ 'themes', 'field_styles', 'label_styles', 'button_styles', 'container_styles', 'background_styles', 'other_styles' ];

	/**
	 * Spinner markup.
	 *
	 * @since 1.9.6
	 *
	 * @type {string}
	 */
	const spinner = '<i class="wpforms-loading-spinner wpforms-loading-white wpforms-loading-inline"></i>';

	/**
	 * Public functions and properties.
	 *
	 * @since 1.8.3
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.8.3
		 */
		init() {
			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.8.3
		 */
		events() {
			// Widget events.
			// noinspection JSUnusedLocalSymbols
			$( window )
				// eslint-disable-next-line no-unused-vars
				.on( 'elementor/frontend/init', function( event, id, instance ) {
					elementor.channels.editor.on( 'section:activated', app.onSectionActivated );
					elementor.hooks.addAction( 'panel/open_editor/widget/wpforms', app.widgetPanelOpen );
					elementorFrontend.hooks.addAction( 'frontend/element_ready/wpforms.default', app.widgetReady );
				} );
		},

		/**
		 * Handle section activation events.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} sectionName The current section name.
		 * @param {Object} editor      Editor instance.
		 */
		onSectionActivated( sectionName, editor ) {
			app.checkForLeadForms( sectionName, editor );
			app.stockPhotos.backgroundUrlEvents( sectionName, editor );
			app.blockProControls( sectionName, editor );
		},

		/**
		 * Disable PRO sections and controls.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} sectionName The current section name.
		 * @param {Object} editor      Editor instance.
		 */
		// eslint-disable-next-line complexity
		blockProControls( sectionName, editor ) {
			if ( ( wpformsElementorVars.isPro && wpformsElementorVars.isLicenseActive ) || editor.activeTab !== 'style' ) {
				return;
			}

			// Disable all PRO sections.
			editor.$el.find( '.elementor-control-background_styles' ).addClass( 'wpforms-elementor-section-disabled' ).attr( 'data-wpforms-section', 'background' );
			editor.$el.find( '.elementor-control-container_styles' ).addClass( 'wpforms-elementor-section-disabled' ).attr( 'data-wpforms-section', 'container' );

			// Disable all PRO controls and add overlay.
			if ( sectionName === 'background_styles' || sectionName === 'container_styles' ) {
				editor.$el
					.find( '.elementor-control:not(.elementor-control-type-section)' )
					.addClass( 'wpforms-elementor-control-disabled' )
					.each( function() {
						if ( $( this ).find( '.wpforms-disabled-control-overlay' ).length === 0 ) {
							$( this )
								.css( 'position', 'relative' )
								.append( '<div class="wpforms-disabled-control-overlay"></div>' );
						}
					} );
			}

			// Add overlay handler.
			if ( ! editor.$el.data( 'wpforms-overlay-handler-bound' ) ) {
				editor.$el.on( 'click', '.wpforms-disabled-control-overlay', function( event ) {
					event.preventDefault();
					event.stopImmediatePropagation();

					const section = $( this ).closest( '.elementor-control' ).prevAll( '.elementor-control-type-section' ).first().attr( 'data-wpforms-section' );

					if ( ! isPro ) {
						app.showProModal( section, strings.pro_sections[ section ] );
						return;
					}

					if ( ! isLicenseActive ) {
						app.showLicenseModal( strings.pro_sections[ section ] );
					}
				} );

				editor.$el.data( 'wpforms-overlay-handler-bound', true );
			}
		},

		/**
		 * On section change event handler.
		 *
		 * @since 1.8.3
		 *
		 * @param {string} sectionName The current section name.
		 * @param {Object} editor      Editor instance.
		 */
		checkForLeadForms( sectionName, editor ) {
			/**
			 * @param editor.$childViewContainer
			 * @param editor.model.attributes.widgetType
			 * @param editor.options.editedElementView
			 */
			if ( ! widgetSections.includes( sectionName ) || editor.model.attributes.widgetType !== 'wpforms' ) {
				return;
			}

			const $panelContent = editor.$childViewContainer[ 0 ];
			const widgetView = editor.options.editedElementView.$el[ 0 ];
			const formId = editor.model.attributes.settings.attributes.form_id;
			const $form = $( widgetView ).find( `#wpforms-${ formId }` );

			if ( $form.length === 0 ) {
				return;
			}

			if ( $form.hasClass( 'wpforms-lead-forms-container' ) ) {
				$( $panelContent ).addClass( 'wpforms-elementor-disabled' );
				$( $panelContent ).find( '.wpforms-elementor-lead-forms-notice' ).css( 'display', 'block' );
			}
		},

		/**
		 * Initialize widget controls when widget is activated.
		 *
		 * @since 1.8.3
		 *
		 * @param {Object} panel Panel object.
		 * @param {Object} model Model object.
		 * @param {Object} view  View object.
		 */
		widgetPanelOpen( panel, model, view ) {
			const settingsModel = model.get( 'settings' );

			// Apply settings from the textarea.
			settingsModel.on( 'change:copyPasteJsonValue', ( changedModel ) => {
				app.pasteSettings( changedModel, view );
			} );

			// Change style settings.
			settingsModel.on( 'change', ( changedModel ) => {
				app.changeStyleSettings( changedModel, view );

				if ( ! changedModel.changed.copyPasteJsonValue && ! changedModel.changed.form_id ) {
					app.updateCopyPasteContent( changedModel );
				}
			} );

			// Update copy/paste content when form_id is changed and copyPasteJsonValue is not set.
			settingsModel.on( 'change:form_id', ( changedModel ) => {
				if ( ! changedModel.attributes.copyPasteJsonValue ) {
					setTimeout( function() {
						app.updateCopyPasteContent( changedModel );
					}, 0 );
				}
			} );
		},

		/**
		 * Widget ready events.
		 *
		 * @since 1.8.3
		 *
		 * @param {jQuery} $scope The current element wrapped with jQuery.
		 */
		widgetReady( $scope ) {
			const formId = $scope.find( '.wpforms-form' ).data( 'formid' );

			app.updateAccentColors( $scope, formId );
			app.loadChoicesJS( $scope, formId );
			app.initRichTextField( formId );
			app.initRepeaterField( formId );
		},

		/**
		 * Change style setting handler.
		 *
		 * @since 1.8.3
		 *
		 * @param {Object} changedModel Changed model.
		 * @param {Object} view         View.
		 */
		// eslint-disable-next-line complexity
		changeStyleSettings( changedModel, view ) {
			const wpformsContainer = view.$el.find( '.wpforms-container' )[ 0 ];

			if ( ! wpformsContainer ) {
				return;
			}

			const parsedAtts = changedModel.parseGlobalSettings( changedModel );

			for ( const element in changedModel.changed ) {
				if ( ! app.getStyleAttributesKeys().includes( element ) ) {
					view.allowRender = element !== 'copyPasteJsonValue';
					continue;
				}

				view.allowRender = false;

				const serviceAtts = [ 'customThemeName', 'isCustomTheme', 'wpformsTheme' ];

				if ( serviceAtts.includes( element ) ) {
					continue;
				}

				/**
				 * @type {Object}
				 */
				let attrValue = app.getParsedValue( element, parsedAtts );
				const property = element.replace( /[A-Z]/g, ( letter ) => `-${ letter.toLowerCase() }` );
				attrValue = app.prepareComplexAttrValues( attrValue, element );

				// Check for custom handlers.
				if ( typeof app.getStyleHandlers()[ property ] === 'function' ) {
					app.getStyleHandlers()[ property ]( wpformsContainer, attrValue, parsedAtts );
					continue;
				}

				switch ( property ) {
					case 'field-size':
					case 'label-size':
					case 'button-size':
					case 'container-shadow-size':
						for ( const key in wpformsElementorVars.sizes[ property ][ attrValue ] ) {
							wpformsContainer.style.setProperty(
								`--wpforms-${ property }-${ key }`,
								wpformsElementorVars.sizes[ property ][ attrValue ][ key ],
							);
						}

						break;

					default:
						wpformsContainer.style.setProperty( `--wpforms-${ property }`, attrValue );

						if ( parsedAtts.backgroundSize === 'cover' ) {
							wpformsContainer.style.setProperty( `--wpforms-background-size`, 'cover' );
						}
				}
			}
		},

		/**
		 * Get style handlers.
		 *
		 * @since 1.9.6
		 *
		 * @return {Object} Style handlers.
		 */
		getStyleHandlers() {
			return {
				'background-image': app.background.setContainerBackgroundImage,
				'background-position': app.background.setContainerBackgroundPosition,
				'background-repeat': app.background.setContainerBackgroundRepeat,
				'background-color': app.background.setBackgroundColor,
				'background-url': app.background.setBackgroundUrl,
				'background-size': app.background.handleSizeFromDimensions,
				'background-width': app.background.handleSizeFromWidth,
				'background-height': app.background.handleSizeFromHeight,
			};
		},

		/**
		 * Prepare complex attribute values.
		 *
		 * @since 1.9.6
		 *
		 * @param {string|Object} attrValue Attribute value.
		 * @param {string}        element   Attribute key.
		 *
		 * @return {string|Object} Prepared attribute value.
		 */
		prepareComplexAttrValues( attrValue, element ) { // eslint-disable-line complexity
			const pxItems = [
				'fieldBorderRadius',
				'fieldBorderSize',
				'buttonBorderRadius',
				'buttonBorderSize',
				'containerPadding',
				'containerBorderWidth',
				'containerBorderRadius',
				'backgroundWidth',
				'backgroundHeight',
			];

			if ( pxItems.includes( element ) ) {
				if ( typeof attrValue === 'number' || ( typeof attrValue === 'string' && ! attrValue.trim().endsWith( 'px' ) ) ) {
					attrValue = `${ attrValue }px`;
				}
			}

			if ( element === 'backgroundUrl' ) {
				// noinspection JSUnresolvedReference
				let url = typeof attrValue === 'object' ? attrValue?.url : attrValue;

				if ( typeof url === 'string' && ! url.trim().startsWith( 'url(' ) ) {
					url = url ? `url( ${ url } )` : 'url()';
				}

				attrValue = url;
			}

			return attrValue;
		},

		/**
		 * Copy/paste widget settings.
		 *
		 * @since 1.8.3
		 *
		 * @param {Object} model Settings model.
		 */
		updateCopyPasteContent( model ) {
			const styleSettings = app.getStyleAttributesKeys();
			const content = {};

			/**
			 * @param model.parseGlobalSettings
			 * @param model.setExternalChange
			 */
			const atts = model.parseGlobalSettings( model );

			styleSettings.forEach( function( element ) {
				content[ element ] = app.getParsedValue( element, atts );
			} );

			model.setExternalChange( 'copyPasteJsonValue', JSON.stringify( content ) );
		},

		/**
		 * Reset global style settings.
		 *
		 * @since 1.8.7
		 *
		 * @param {Object} model     Settings model.
		 * @param {Object} container Container.
		 */
		resetGlobalStyleSettings( model, container ) {
			const globals = model.get( '__globals__' );

			/**
			 * @param model.changed.__globals__
			 */
			if ( globals && ! model.changed.__globals__ ) {
				elementorCommon.api.run( 'document/globals/settings', {
					container,
					settings: {},
					options: {
						external: true,
						render: false,
					},
				} );
			}
		},

		/**
		 * Paste settings.
		 *
		 * @since 1.8.3
		 *
		 * @param {Object} model Settings model.
		 * @param {Object} view  View.
		 */
		pasteSettings( model, view ) {
			const copyPasteJsonValue = model.changed.copyPasteJsonValue;
			const pasteAttributes = app.parseValidateJson( copyPasteJsonValue );
			const container = view.container;

			if ( ! pasteAttributes ) {
				if ( copyPasteJsonValue ) {
					elementorCommon.dialogsManager.createWidget( 'alert', {
						message: strings.copy_paste_error,
						headerMessage: strings.heads_up,
					} ).show();
				}

				this.updateCopyPasteContent( model );

				return;
			}

			app.resetGlobalStyleSettings( model, container );

			model.set( pasteAttributes );
		},

		/**
		 * Parse and validate JSON string.
		 *
		 * @since 1.8.3
		 *
		 * @param {string} value JSON string.
		 *
		 * @return {boolean|object} Parsed JSON object OR false on error.
		 */
		parseValidateJson( value ) {
			if ( typeof value !== 'string' ) {
				return false;
			}

			let atts;

			try {
				atts = JSON.parse( value );
			} catch ( error ) {
				atts = false;
			}

			return atts;
		},

		/**
		 * Get a list of the style attributes keys.
		 *
		 * @since 1.8.3
		 *
		 * @return {Array} Style attributes keys.
		 */
		getStyleAttributesKeys() {
			return [
				'containerPadding',
				'containerBorderStyle',
				'containerBorderWidth',
				'containerBorderRadius',
				'containerShadowSize',
				'containerBorderColor',
				'fieldSize',
				'fieldBorderStyle',
				'fieldBorderRadius',
				'fieldBorderSize',
				'fieldBackgroundColor',
				'fieldBorderColor',
				'fieldTextColor',
				'fieldMenuColor',
				'pageBreakColor',
				'labelSize',
				'labelColor',
				'labelSublabelColor',
				'labelErrorColor',
				'buttonSize',
				'buttonBorderStyle',
				'buttonBorderSize',
				'buttonBorderRadius',
				'buttonBackgroundColor',
				'buttonBorderColor',
				'buttonTextColor',
				'backgroundColor',
				'backgroundPosition',
				'backgroundUrl',
				'backgroundRepeat',
				'backgroundSize',
				'backgroundSizeMode',
				'backgroundWidth',
				'backgroundHeight',
				'backgroundImage',
				'customThemeName',
				'isCustomTheme',
			];
		},

		/**
		 * Get parsed attribute value.
		 *
		 * @since 1.8.3
		 *
		 * @param {string} attrName   Attribute name.
		 * @param {Object} parsedAtts Parsed attributes.
		 *
		 * @return {string} Attribute value.
		 */
		getParsedValue( attrName, parsedAtts ) {
			const rawValue = parsedAtts[ attrName ];
			let value;

			if ( typeof rawValue === 'undefined' ) {
				value = false;
			} else if ( typeof rawValue === 'object' && Object.prototype.hasOwnProperty.call( rawValue, 'value' ) ) {
				value = rawValue.value;
			} else {
				value = rawValue;
			}

			return value;
		},

		/**
		 * Initialize the RichText field.
		 *
		 * @since 1.8.3
		 *
		 * @param {number} formId Form ID.
		 */
		initRichTextField( formId ) {
			// Set default tab to `Visual`.
			$( `#wpforms-${ formId } .wp-editor-wrap` ).removeClass( 'html-active' ).addClass( 'tmce-active' );
		},

		/**
		 * Update accent colors of some fields in Elementor widget.
		 *
		 * @since 1.8.3
		 *
		 * @param {jQuery} widgetContainer Widget container.
		 * @param {number} formId          Event details object.
		 */
		updateAccentColors( widgetContainer, formId ) {
			const $form = widgetContainer.find( `#wpforms-${ formId }` ),
				FrontendModern = window.WPForms.FrontendModern;

			FrontendModern.updateGBBlockPageIndicatorColor( $form );
			FrontendModern.updateGBBlockIconChoicesColor( $form );
			FrontendModern.updateGBBlockRatingColor( $form );
		},

		/**
		 * Init Modern style Dropdown fields (<select>).
		 *
		 * @since 1.8.3
		 *
		 * @param {jQuery} widgetContainer Widget container.
		 * @param {number} formId          Form id.
		 */
		loadChoicesJS( widgetContainer, formId ) {
			if ( typeof window.Choices !== 'function' ) {
				return;
			}

			const $form = widgetContainer.find( `#wpforms-${ formId }` );

			$form.find( '.choicesjs-select' ).each( function( idx, el ) {
				const $el = $( el );

				if ( $el.data( 'choice' ) === 'active' ) {
					return;
				}

				const args = window.wpforms_choicesjs_config || {},
					searchEnabled = $el.data( 'search-enabled' ),
					$field = $el.closest( '.wpforms-field' );

				args.searchEnabled = 'undefined' !== typeof searchEnabled ? searchEnabled : true;
				args.callbackOnInit = function() {
					/**
					 * @param self.containerOuter
					 * @param self.passedElement
					 */
					const self = this,
						$element = $( self.passedElement.element ),
						$input = $( self.input.element ),
						sizeClass = $element.data( 'size-class' );

					// Add a CSS class for size.
					if ( sizeClass ) {
						$( self.containerOuter.element ).addClass( sizeClass );
					}

					/**
					 * If a multiple select has selected choices - hide a placeholder text.
					 * In case if select is empty - we return placeholder text.
					 */
					if ( $element.prop( 'multiple' ) ) {
						// On init event.
						$input.data( 'placeholder', $input.attr( 'placeholder' ) );

						if ( self.getValue( true ).length ) {
							$input.removeAttr( 'placeholder' );
						}
					}

					this.disable();
					$field.find( '.is-disabled' ).removeClass( 'is-disabled' );
				};

				try {
					const choicesInstance = new Choices( el, args );

					// Save the Choices.js instance for future access.
					$el.data( 'choicesjs', choicesInstance );
				} catch ( e ) {
				} // eslint-disable-line no-empty
			} );
		},

		/**
		 * Initialize the Repeater field.
		 *
		 * @since 1.8.9
		 *
		 * @param {number} formId Form ID.
		 */
		initRepeaterField( formId ) {
			const $rowButtons = $( `.wpforms-form[data-formid="${ formId }"] .wpforms-field-repeater > .wpforms-field-repeater-display-rows .wpforms-field-repeater-display-rows-buttons` );

			// Get the label height and set the button position.
			$rowButtons.each( function() {
				const $cont = $( this );

				// noinspection JSCheckFunctionSignatures
				const $label = $cont.siblings( '.wpforms-layout-column' )
					.find( '.wpforms-field' ).first()
					.find( '.wpforms-field-label' );
				const labelStyle = window.getComputedStyle( $label.get( 0 ) );
				const margin = labelStyle?.getPropertyValue( '--wpforms-field-size-input-spacing' ) || 0;
				const height = $label.outerHeight() || 0;
				const top = height + parseInt( margin, 10 ) + 10;

				$cont.css( { top } );
			} );

			// Init buttons and descriptions for each repeater in each form.
			$( `.wpforms-form[data-formid="${ formId }"]` ).each( function() {
				const $repeater = $( this ).find( '.wpforms-field-repeater' );

				$repeater.find( '.wpforms-field-repeater-display-rows-buttons' ).addClass( 'wpforms-init' );
				$repeater.find( '.wpforms-field-repeater-display-rows:last .wpforms-field-description' ).addClass( 'wpforms-init' );
			} );
		},

		/**
		 * Open the educational popup for users with no Pro license.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} section Section name.
		 * @param {string} feature Feature name.
		 */
		showProModal( section, feature ) {
			const type = 'pro';
			const wpforms_education = window.parent.wpforms_education ?? [];
			const WPFormsEducation = window.parent.WPFormsEducation ?? {};
			const message = wpforms_education.upgrade[ type ].message_plural.replace( /%name%/g, feature );
			const editor = elementor.getPanelView().$el;

			// noinspection JSUnusedLocalSymbols
			const utmContent = { // eslint-disable-line no-unused-vars
				container: 'Upgrade to Pro - Container Styles',
				background: 'Upgrade to Pro - Background Styles',
				themes: 'Upgrade to Pro - Themes',
			};

			$.alert( {
				backgroundDismiss: true,
				title: feature + ' ' + wpforms_education.upgrade[ type ].title_plural,
				icon: 'fa fa-lock',
				content: message,
				boxWidth: '550px',
				useBootstrap: false,
				theme: 'modern,wpforms-education',
				closeIcon: true,
				onOpen() {
					// To not lose the focus on our widget.
					this.$el.on( 'click', function( e ) {
						e.stopPropagation();
					} );
				},
				onOpenBefore: function() { // eslint-disable-line object-shorthand
					this.$btnc.after( '<div class="discount-note">' + wpforms_education.upgrade_bonus + '</div>' );
					this.$btnc.after( wpforms_education.upgrade[ type ].doc.replace( /%25name%25/g, 'AP - ' + feature ).replace( 'gutenberg', 'elementor' ) );
					this.$body.find( '.jconfirm-content' ).addClass( 'lite-upgrade' );
					editor.addClass( 'wpforms-elementor-disabled' );
				},
				onClose() {
					editor.removeClass( 'wpforms-elementor-disabled' );
				},
				buttons: {
					confirm: {
						text: strings.upgrade_button,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
						action: () => {
							window.open( WPFormsEducation.core.getUpgradeURL( utmContent[ section ], type ).replace( 'gutenberg', 'elementor' ), '_blank' );
						},
					},
				},
			} );
		},

		/**
		 * License modal.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} feature Feature name.
		 */
		showLicenseModal( feature ) {
			const editor = elementor.getPanelView().$el;

			$.alert( {
				title: strings.heads_up,
				content: strings.license_message.replace( /%name%/g, `<strong>${ feature }</strong>` ),
				icon: 'fa fa-exclamation-circle',
				type: 'orange',
				useBootstrap: false,
				boxWidth: '400px',
				theme: 'modern',
				onOpenBefore() {
					editor.addClass( 'wpforms-elementor-disabled' );
				},
				onOpen() {
					// To not lose the focus on our widget.
					this.$el.on( 'click', function( e ) {
						e.stopPropagation();
					} );
				},
				onClose() {
					editor.removeClass( 'wpforms-elementor-disabled' );
				},
				buttons: {
					confirm: {
						text: strings.license_button,
						btnClass: 'btn-confirm',
						keys: [ 'enter' ],
						action() {
							window.open(
								strings.license_url,
								'_blank'
							);
						},
					},
					cancel: {
						text: strings.cancel,
					},
				},
			} );
		},

		/**
		 * Background Object.
		 *
		 * @since 1.9.6
		 */
		background: {

			/**
			 * Set the container background image.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setContainerBackgroundImage( container, value ) {
				if ( value === 'none' ) {
					container.style.setProperty( `--wpforms-background-url`, 'url()' );
				}
			},

			/**
			 * Set the container background url.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setBackgroundUrl( container, value ) {
				container.style.setProperty( `--wpforms-background-url`, value );
			},

			/**
			 * Set the container background color.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setBackgroundColor( container, value ) {
				container.style.setProperty( `--wpforms-background-color`, value );
			},

			/**
			 * Set the container background position.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setContainerBackgroundPosition( container, value ) {
				container.style.setProperty( `--wpforms-background-position`, value );
			},

			/**
			 * Set container background repeat.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setContainerBackgroundRepeat( container, value ) {
				container.style.setProperty( `--wpforms-background-repeat`, value );
			},

			/**
			 * Set the container background width.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setContainerBackgroundWidth( container, value ) {
				container.style.setProperty( `--wpforms-background-width`, value );
			},

			/**
			 * Set the container background height.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Container element.
			 * @param {string}      value     Value.
			 */
			setContainerBackgroundHeight( container, value ) {
				container.style.setProperty( `--wpforms-background-height`, value );
			},

			/**
			 * Handle real size from dimensions.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Widget container
			 * @param {string}      value     Value.
			 * @param {Object}      atts      Widget attributes.
			 */
			handleSizeFromDimensions( container, value, atts ) {
				const backgroundWidth = app.prepareComplexAttrValues( atts.backgroundWidth, 'backgroundWidth' );
				const backgroundHeight = app.prepareComplexAttrValues( atts.backgroundHeight, 'backgroundHeight' );

				if ( value === 'cover' ) {
					app.background.setContainerBackgroundWidth( container, backgroundWidth );
					app.background.setContainerBackgroundHeight( container, backgroundHeight );
					container.style.setProperty( `--wpforms-background-size`, 'cover' );
				} else {
					container.style.setProperty( `--wpforms-background-size`, backgroundWidth + ' ' + backgroundHeight );
				}
			},

			/**
			 * Handle real size from width.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Widget container
			 * @param {string}      value     Value.
			 * @param {Object}      atts      Widget attributes.
			 */
			handleSizeFromWidth( container, value, atts ) {
				const backgroundWidth = app.prepareComplexAttrValues( atts.backgroundWidth, 'backgroundWidth' );
				const backgroundHeight = app.prepareComplexAttrValues( atts.backgroundHeight, 'backgroundHeight' );

				app.background.setContainerBackgroundWidth( container, backgroundWidth );

				if ( atts.backgroundSize !== 'cover' ) {
					container.style.setProperty( `--wpforms-background-size`, value + ' ' + backgroundHeight );
				}
			},

			/**
			 * Handle real size from height.
			 *
			 * @since 1.9.6
			 *
			 * @param {HTMLElement} container Widget container
			 * @param {string}      value     Value.
			 * @param {Object}      atts      Widget attributes.
			 */
			handleSizeFromHeight( container, value, atts ) {
				const backgroundWidth = app.prepareComplexAttrValues( atts.backgroundWidth, 'backgroundWidth' );

				app.background.setContainerBackgroundHeight( container, value );

				if ( atts.backgroundSize !== 'cover' ) {
					container.style.setProperty( `--wpforms-background-size`, backgroundWidth + ' ' + value );
				}
			},

		},

		/**
		 * Stock Photos Object.
		 *
		 * @since 1.9.6
		 */
		stockPhotos: {
			/**
			 * Open stock photos modal.
			 *
			 * @since 1.9.6
			 *
			 * @param {string} from From where the modal was triggered, `themes` or `bg-styles`.
			 */
			openModal( from ) {
				if ( app.stockPhotos.isPicturesAvailable() ) {
					app.stockPhotos.picturesModal();

					return;
				}

				app.stockPhotos.installModal( from );
			},

			/**
			 * Open a modal prompting to download and install the Stock Photos.
			 *
			 * @since 1.9.6
			 *
			 * @param {string} from From where the modal was triggered, `themes` or `bg-styles`.
			 */
			installModal( from ) {
				const installStr = from === 'themes' ? strings.stockInstallTheme : strings.stockInstallBg;
				const editor = elementor.getPanelView().$el;

				$.confirm( {
					title: strings.heads_up,
					content: installStr + ' ' + strings.stockInstall,
					icon: 'wpforms-exclamation-circle',
					type: 'orange',
					theme: 'modern',
					useBootstrap: false,
					boxWidth: '400px',
					onOpen() {
						// To not lose the focus on our widget.
						this.$el.on( 'click', function( e ) {
							e.stopPropagation();
						} );
					},
					onOpenBefore() {
						editor.addClass( 'wpforms-elementor-disabled' );
					},
					onClose() {
						editor.removeClass( 'wpforms-elementor-disabled' );
					},
					buttons: {
						continue: {
							text: strings.continue,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
							action() {
								// noinspection JSUnresolvedReference
								this.$$continue.prop( 'disabled', true )
									.html( spinner + strings.installing );

								// noinspection JSUnresolvedReference
								this.$$cancel
									.prop( 'disabled', true );

								app.stockPhotos.install( this, from );

								return false;
							},
						},
						cancel: {
							text: strings.cancel,
							keys: [ 'esc' ],
						},
					},
				} );
			},

			/**
			 * Display the modal window with an error message.
			 *
			 * @since 1.9.6
			 *
			 * @param {string} error Error message.
			 */
			errorModal( error ) {
				elementorCommon.dialogsManager.createWidget( 'alert', {
					message: error,
					headerMessage: strings.heads_up,
				} ).show();
			},

			/**
			 * Display the modal window with pictures.
			 *
			 * @since 1.9.6
			 */
			picturesModal() {
				const editor = elementor.getPanelView().$el;

				state.picturesModal = $.alert( {
					title: `${ strings.picturesTitle }<p>${ strings.picturesSubTitle }</p>`,
					content: app.stockPhotos.getPictureMarkup(),
					type: 'picture-selector',
					useBootstrap: false,
					boxWidth: '800px',
					closeIcon: true,
					theme: 'modern',
					buttons: false,
					onOpenBefore() {
						editor.addClass( 'wpforms-elementor-disabled' );
					},
					onOpen() {
						// To not lose the focus on our widget.
						this.$el.on( 'click', function( e ) {
							e.stopPropagation();
						} );

						this.$content
							.off( 'click' )
							.on( 'click', '.wpforms-elementor-stock-photos-picture', app.stockPhotos.selectPicture );
					},
					onClose() {
						editor.removeClass( 'wpforms-elementor-disabled' );
					},
				} );
			},

			/**
			 * Install stock photos.
			 *
			 * @since 1.9.6
			 *
			 * @param {Object} modal The jQuery-confirm modal window object.
			 * @param {string} from  From where the modal was triggered, `themes` or `bg-styles`.
			 */
			install( modal, from ) {
				// If a fetch is already in progress, exit the function.
				if ( state.isInstalling ) {
					return;
				}

				// Set the flag to true indicating a fetch is in progress.
				state.isInstalling = true;

				wp.apiFetch( {
					path: routeNamespace + 'stock-photos/install/',
					method: 'POST',
				} ).then( ( response ) => {
					if ( ! response.result ) {
						app.stockPhotos.errorModal( response.error );
						return;
					}

					// Store the pictures' data.
					pictures = response.pictures || [];

					// Show the pictures modal.
					if ( from !== 'themes' ) {
						app.stockPhotos.picturesModal();
					}
				} ).catch( ( error ) => {
					app.stockPhotos.errorModal( `<p>${ strings.commonError }</p><p>${ error.message || error }</p>` );
				} ).finally( () => {
					state.isInstalling = false;
					modal.close();
				} );
			},

			/**
			 * Detect whether pictures' data available.
			 *
			 * @since 1.9.6
			 *
			 * @return {boolean} True if pictures' data available, false otherwise.
			 */
			isPicturesAvailable() {
				return Boolean( pictures?.length );
			},

			/**
			 * Generate the pictures' selector markup.
			 *
			 * @since 1.9.6
			 *
			 * @return {string} Pictures' selector markup.
			 */
			getPictureMarkup() {
				if ( ! app.stockPhotos.isPicturesAvailable() ) {
					return '';
				}

				if ( picturesMarkup !== '' ) {
					return picturesMarkup;
				}

				pictures.forEach( ( picture ) => {
					const pictureUrl = pictureUrlPath + picture;

					picturesMarkup += `<div class="wpforms-elementor-stock-photos-picture"
					data-url="${ pictureUrl }"
					style="background-image: url( '${ pictureUrl }' )"
				></div>`;
				} );

				picturesMarkup = `<div class="wpforms-elementor-stock-photos-pictures-wrap">${ picturesMarkup }</div>`;

				return picturesMarkup;
			},

			/**
			 * Select picture event handler.
			 *
			 * @since 1.9.6
			 */
			selectPicture() {
				const pictureUrl = $( this ).data( 'url' );

				// Get the current widget model
				/**
				 * @param elementor.getPanelView
				 * @param elementor.getPanelView.getCurrentPageView
				 */
				const widget = elementor.getPanelView().getCurrentPageView().getOption( 'editedElementView' );
				const settingsModel = widget.model.get( 'settings' );

				settingsModel.setExternalChange( {
					backgroundUrl: {
						id: '',
						url: pictureUrl,
					},
				} );

				// Close the modal window.
				state.picturesModal?.close();
			},

			/**
			 * On section change event handler.
			 *
			 * @since 1.9.6
			 *
			 * @param {string} sectionName The current section name.
			 * @param {Object} editor      Editor instance.
			 */
			backgroundUrlEvents( sectionName, editor ) {
				if ( sectionName !== 'background_styles' || editor.model.attributes.widgetType !== 'wpforms' ) {
					return;
				}

				const $panelContent = editor.$childViewContainer[ 0 ];
				const mediaControl = $( $panelContent ).find( '.elementor-control-backgroundUrl .elementor-control-preview-area' );

				mediaControl.off( 'click' ).on( 'click', ( e ) => {
					const imageSource = editor.model.attributes.settings.attributes.backgroundImage;

					if ( imageSource !== 'stock' ) {
						return;
					}

					if ( $( e.target ).closest( '.elementor-control-media__content__remove' ).length ) {
						return;
					}

					e.preventDefault();
					e.stopPropagation();

					app.stockPhotos.openModal( 'bg-styles' );
				} );
			},
		},
	};

	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsElementorModern.init();
