/* global elementor, elementorCommon, wpformsElementorVars, WPFormsElementorModern */
// noinspection TypeScriptUMDGlobal

/**
 * @param wpformsElementorVars.route_namespace
 * @param strings.form_themes
 * @param strings.theme_name
 * @param strings.theme_delete
 * @param strings.theme_delete_title
 * @param strings.theme_delete_confirm
 * @param strings.theme_delete_cant_undone
 * @param strings.theme_delete_yes
 * @param strings.theme_copy
 * @param strings.theme_custom
 * @param strings.theme_noname
 * @param strings.themes_error
 * @param strings.button_background
 * @param strings.button_text
 * @param strings.field_label
 * @param strings.field_sublabel
 * @param strings.field_border
 */

// noinspection ES6ConvertVarToLetConst
/**
 * WPForms integration with Elementor (modern widget).
 *
 * @since 1.9.6
 */
var WPFormsElementorThemes = window.WPFormsElementorThemes || ( function( document, window, $ ) { // eslint-disable-line no-var
	/**
	 * Localized data aliases.
	 *
	 * @since 1.9.6
	 */
	const { isAdmin, isPro, isLicenseActive, strings, route_namespace: routeNamespace } = wpformsElementorVars;

	/**
	 * Runtime state.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const state = {};

	/**
	 * Themes data.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const themesData = {
		wpforms: null,
		custom: null,
	};

	/**
	 * Enabled themes.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	let enabledThemes = null;

	/**
	 * Elements holder.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const el = {};

	// noinspection JSUnusedGlobalSymbols
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.6
	 *
	 * @type {Object}
	 */
	const app = {
		/**
		 * Start the engine.
		 *
		 * @since 1.9.6
		 */
		init() {
			el.$window = $( window );

			app.fetchThemesData();

			app.events();
		},

		/**
		 * Register JS events.
		 *
		 * @since 1.9.6
		 */
		events() {
			// noinspection JSUnusedLocalSymbols
			$( window )
				.on( 'elementor/frontend/init', function() {
					elementor.channels.editor.on( 'section:activated', app.themesControlSetup );
				} );
		},

		/**
		 * Get all themes data.
		 *
		 * @since 1.9.6
		 *
		 * @return {Object} Themes data.
		 */
		getAllThemes() {
			return { ...( themesData.custom || {} ), ...( themesData.wpforms || {} ) };
		},

		/**
		 * On section change event handler.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} sectionName The current section name.
		 * @param {Object} editor      Editor instance.
		 */
		themesControlSetup( sectionName, editor ) {
			if ( sectionName !== 'themes' || editor.model.attributes.widgetType !== 'wpforms' ) {
				return;
			}

			const $panelContent = editor.$childViewContainer[ 0 ];
			const $themesControl = $( $panelContent ).find( '.wpforms-elementor-themes-control' );

			// Scrollbar fix for Mac.
			if ( app.isMac() ) {
				$themesControl.addClass( 'wpforms-is-mac' );
			}

			app.updateThemesList( editor, $themesControl );
		},

		/**
		 * Update themes list.
		 *
		 * @since 1.9.6
		 * @param {Object} editor         Editor instance.
		 * @param {Object} $themesControl Themes control object.
		 */
		updateThemesList( editor, $themesControl ) {
			const selectedTheme = editor.model.attributes.settings.attributes.wpformsTheme ?? 'default';

			// Get all themes.
			const html = app.getThemesListMarkup( selectedTheme );

			$themesControl.html( html );

			app.addThemesEvents( $themesControl, editor );
		},

		/**
		 * On settings change event handler.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} $themesControl Themes control element.
		 * @param {Object} editor         Editor instance.
		 */
		addThemesEvents( $themesControl, editor ) {
			const debouncedMaybeCreate = _.debounce( ( settings ) => {
				app.maybeCreateCustomTheme( settings );
			}, 300 );

			const settingsModel = editor.model.get( 'settings' );

			if ( settingsModel.attributes.isMigrated !== 'true' ) {
				app.maybeMigrateToCustomTheme( settingsModel, $themesControl, editor );
			}

			settingsModel.on( 'change', ( one ) => {
				debouncedMaybeCreate( one.attributes );
				app.maybeUpdateCustomTheme( one );
			} );

			const $radioButtons = $themesControl.find( '[role="radio"]' );

			// Add event listeners to the radio buttons.
			$radioButtons.off( 'click' ).on( 'click', function() {
				$radioButtons.removeClass( 'is-active' );

				$( this ).addClass( 'is-active' );

				const selectedValue = $( this ).val();

				app.selectTheme( selectedValue );
			} );

			// Add event listeners to the theme delete button.
			elementor.channels.editor
				.off( 'WPFormsDeleteThemeButtonClick' )
				.on( 'WPFormsDeleteThemeButtonClick', () => {
					app.deleteThemeModal( editor.model.attributes.settings.attributes, editor );
				} );

			// Listen for the theme name change.
			editor.model.get( 'settings' )
				.off( 'change:customThemeName' )
				.on( 'change:customThemeName', function( model ) {
					const newName = model.get( 'customThemeName' );

					app.changeThemeName( newName, model );
					app.updateThemesList( editor, $themesControl );
				} );
		},

		/**
		 * Maybe migrate to the custom theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} settingsModel  Settings model.
		 * @param {Object} $themesControl Themes Control object.
		 * @param {Object} editor         Editor object.
		 */
		maybeMigrateToCustomTheme( settingsModel, $themesControl, editor ) {
			const previousSettings = settingsModel._previousAttributes;
			const atts = settingsModel.attributes;

			if ( 'copyPasteJsonValue' in previousSettings && ! previousSettings.wpformsTheme && ! atts.isCustomTheme ) {
				const currentStyles = app.getCurrentStyleAttributes( settingsModel.attributes );
				app.createCustomTheme( settingsModel.attributes, currentStyles, true );
				app.updateThemesList( editor, $themesControl );
			}

			settingsModel.setExternalChange( {
				isMigrated: 'true',
			} );
		},

		/**
		 * Maybe update the custom theme settings.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} model Settings model.
		 */
		maybeUpdateCustomTheme( model ) {
			const atts = model.attributes;
			const isCustomTheme = atts.isCustomTheme === 'true';

			if ( ! isCustomTheme ) {
				return;
			}

			const changedAtts = model.changed;
			const allowedKeys = WPFormsElementorModern.getStyleAttributesKeys();

			// Update only allowed attributes.
			for ( const element in changedAtts ) {
				if ( ! allowedKeys.includes( element ) ) {
					continue;
				}

				const attrValue = WPFormsElementorModern.prepareComplexAttrValues( changedAtts[ element ], element );

				app.updateCustomThemeAttribute( element, attrValue, atts );
			}
		},

		/**
		 * Get the Themes control markup.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} selectedTheme Selected theme slug.
		 *
		 * @return {string} Themes items HTML.
		 */
		// eslint-disable-next-line complexity
		getThemesListMarkup( selectedTheme ) {
			if ( ! themesData.wpforms ) {
				app.fetchThemesData();

				// Return markup with an error message if themes are not available.
				return `<div class="wpforms-no-themes">${ strings.themes_error }</div>`;
			}

			const allThemes = app.getAllThemes();

			if ( ! allThemes ) {
				return '';
			}

			const themes = Object.keys( allThemes );
			let theme, firstThemeSlug;
			let html = '';
			let itemsHtml = '';

			if ( ! app.isWPFormsTheme( selectedTheme ) ) {
				firstThemeSlug = selectedTheme;

				itemsHtml += app.getThemesItemMarkup( app.getTheme( firstThemeSlug ), firstThemeSlug, firstThemeSlug );
			}

			for ( const key in themes ) {
				const slug = themes[ key ];

				// Skip the first theme.
				if ( firstThemeSlug && firstThemeSlug === slug ) {
					continue;
				}

				// Ensure that all the theme settings are present.
				theme = { ...allThemes.default, ...( allThemes[ slug ] || {} ) };
				theme.settings = { ...allThemes.default.settings, ...( theme.settings || {} ) };

				itemsHtml += app.getThemesItemMarkup( theme, slug, selectedTheme );
			}

			html = `<div role="radiogroup" class="wpforms-elementor-themes-radio-group">
						${ itemsHtml }
					</div>`;

			return html;
		},

		/**
		 * Get the Themes list item markup.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} theme         Theme properties.
		 * @param {string} slug          Theme slug.
		 * @param {string} selectedTheme Selected theme slug.
		 *
		 * @return {string} Themes items HTML.
		 */
		getThemesItemMarkup( theme, slug, selectedTheme ) {
			if ( ! theme ) {
				return '';
			}

			const title = theme.name?.length > 0 ? theme.name : strings.theme_noname;
			let radioClasses = 'wpforms-elementor-themes-radio ';
			const buttonClass = slug === selectedTheme ? 'is-active' : '';

			radioClasses += app.isDisabledTheme( slug ) ? 'wpforms-elementor-themes-radio-disabled' : ' wpforms-elementor-themes-radio-enabled';

			return `<button type="button" class="${ buttonClass }" value="${ slug }" role="radio">
						<div class="wpforms-elementor-themes-radio  ${ radioClasses }">
							<div class="wpforms-elementor-themes-radio-title">${ title }</div>
						</div>

						<div class="wpforms-elementor-themes-indicators">
							<span class="component-color-indicator" title="${ strings.button_background }" style="background: ${ theme.settings.buttonBackgroundColor };" data-index="0"></span>
							<span class="component-color-indicator" title="${ strings.button_text }" style="background: ${ theme.settings.buttonTextColor }" data-index="1"></span>
							<span class="component-color-indicator" title="${ strings.field_label }" style="background: ${ theme.settings.labelColor };" data-index="2"></span>
							<span class="component-color-indicator" title="${ strings.field_sublabel } " style="background: ${ theme.settings.labelSublabelColor };" data-index="3"></span>
							<span class="component-color-indicator" title="${ strings.field_border }"  style="background: ${ theme.settings.fieldBorderColor };" data-index="4"></span>
						</div>
					</button>`;
		},

		/**
		 * Get theme data.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} slug Theme slug.
		 *
		 * @return {Object|null} Theme settings.
		 */
		getTheme( slug ) {
			return app.getAllThemes()[ slug ] || null;
		},

		/**
		 * Get enabled themes data.
		 *
		 * @since 1.9.6
		 *
		 * @return {Object} Themes data.
		 */
		getEnabledThemes() {
			if ( enabledThemes ) {
				return enabledThemes;
			}

			const allThemes = app.getAllThemes();

			if ( isPro && isLicenseActive ) {
				return allThemes;
			}

			enabledThemes = Object.keys( allThemes ).reduce( ( acc, key ) => {
				if ( allThemes[ key ].settings?.fieldSize && ! allThemes[ key ].disabled ) {
					acc[ key ] = allThemes[ key ];
				}
				return acc;
			}, {} );

			return enabledThemes;
		},

		/**
		 * Update enabled themes.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} slug  Theme slug.
		 * @param {Object} theme Theme settings.
		 */
		updateEnabledThemes( slug, theme ) {
			if ( ! enabledThemes ) {
				return;
			}

			enabledThemes = {
				...enabledThemes,
				[ slug ]: theme,
			};
		},

		/**
		 * Whether the theme is disabled.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} slug Theme slug.
		 *
		 * @return {boolean} True if the theme is disabled.
		 */
		isDisabledTheme( slug ) {
			return ! app.getEnabledThemes()?.[ slug ];
		},

		/**
		 * Whether the theme is one of the WPForms themes.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} slug Theme slug.
		 *
		 * @return {boolean} True if the theme is one of the WPForms themes.
		 */
		isWPFormsTheme( slug ) {
			return Boolean( themesData.wpforms[ slug ]?.settings );
		},

		/**
		 * Fetch themes data from API.
		 *
		 * @since 1.9.6
		 */
		fetchThemesData() {
			// If a fetch is already in progress, exit the function.
			if ( state.isFetchingThemes || themesData.wpforms ) {
				return;
			}

			// Set the flag to true indicating a fetch is in progress.
			state.isFetchingThemes = true;

			try {
				// Fetch themes data.
				wp.apiFetch( {
					path: routeNamespace + 'elementor/themes/',
					method: 'GET',
					cache: 'no-cache',
				} )
					.then( ( response ) => {
						themesData.wpforms = response.wpforms || {};
						themesData.custom = response.custom || {};
					} )
					.catch( ( error ) => {
						// eslint-disable-next-line no-console
						console.error( error?.message );
					} )
					.finally( () => {
						state.isFetchingThemes = false;
					} );
			} catch ( error ) {
				// eslint-disable-next-line no-console
				console.error( error );
			}
		},

		/**
		 * Save the custom themes.
		 *
		 * @since 1.9.6
		 */
		saveCustomThemes() {
			if ( ! isAdmin ) {
				return;
			}

			// Custom themes do not exist.
			if ( state.isSavingThemes || ! themesData.custom ) {
				return;
			}

			// Set the flag to true indicating a saving is in progress.
			state.isSavingThemes = true;

			try {
				// Save themes.
				wp.apiFetch( {
					path: routeNamespace + 'elementor/themes/custom/',
					method: 'POST',
					data: { customThemes: themesData.custom },
				} )
					.then( ( response ) => {
						if ( ! response?.result ) {
							// eslint-disable-next-line no-console
							console.log( response?.error );
						}
					} )
					.catch( ( error ) => {
						// eslint-disable-next-line no-console
						console.error( error?.message );
					} )
					.finally( () => {
						state.isSavingThemes = false;
					} );
			} catch ( error ) {
				// eslint-disable-next-line no-console
				console.error( error );
			}
		},

		/**
		 * Get the current style attributes state.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} atts Widget attributes.
		 *
		 * @return {Object} Whether the custom theme is created.
		 */
		getCurrentStyleAttributes( atts ) {
			const defaultAttributes = Object.keys( themesData.wpforms.default?.settings );

			const currentStyleAttributes = {};

			for ( const key in defaultAttributes ) {
				const attr = defaultAttributes[ key ];
				currentStyleAttributes[ attr ] = WPFormsElementorModern.prepareComplexAttrValues( atts[ attr ], defaultAttributes[ key ] ) ?? '';
			}

			return currentStyleAttributes;
		},

		/**
		 * Maybe create a custom theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} atts Widget attributes.
		 *
		 * @return {boolean} Whether the custom theme is created.
		 */
		// eslint-disable-next-line complexity
		maybeCreateCustomTheme( atts ) {
			const currentStyles = app.getCurrentStyleAttributes( atts );
			const isWPFormsTheme = !! themesData.wpforms[ atts.wpformsTheme ];
			const isCustomTheme = !! themesData.custom[ atts.wpformsTheme ];

			// It is one of the default themes without any changes.
			if (
				isWPFormsTheme &&
				JSON.stringify( themesData.wpforms[ atts.wpformsTheme ]?.settings ) === JSON.stringify( currentStyles )
			) {
				return false;
			}

			// It is a modified default theme OR unknown custom theme.
			if ( isWPFormsTheme || ! isCustomTheme ) {
				app.createCustomTheme( atts, currentStyles );
			}

			return true;
		},

		/**
		 * Create a custom theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object}  atts                 Widget properties.
		 * @param {Object}  currentStyles        Current style settings.
		 * @param {boolean} migrateToCustomTheme Whether it is necessary to migrate to custom theme.
		 *
		 * @return {boolean} Whether the custom theme is created.
		 */
		createCustomTheme( atts, currentStyles = null, migrateToCustomTheme = false ) { // eslint-disable-line complexity
			let counter = 0;
			let themeSlug = atts.wpformsTheme;

			const baseTheme = app.getTheme( atts.wpformsTheme ) || themesData.wpforms.default;
			let themeName = baseTheme.name;

			themesData.custom = themesData.custom || {};

			if ( migrateToCustomTheme ) {
				themeSlug = 'custom';
				themeName = strings.theme_custom;
			}

			// Determine the theme slug and the number of copies.
			do {
				counter++;
				themeSlug = themeSlug + '-copy-' + counter;
			} while ( themesData.custom[ themeSlug ] && counter < 10000 );

			const copyStr = counter < 2 ? strings.theme_copy : strings.theme_copy + ' ' + counter;

			themeName += ' (' + copyStr + ')';

			// The first migrated Custom Theme should be without a ` (Copy)` suffix.
			themeName = migrateToCustomTheme && counter < 2 ? strings.theme_custom : themeName;

			// Add the new custom theme.
			themesData.custom[ themeSlug ] = {
				name: themeName,
				settings: currentStyles || app.getCurrentStyleAttributes( atts ),
			};

			app.updateEnabledThemes( themeSlug, themesData.custom[ themeSlug ] );

			const widget = elementor.getPanelView().getCurrentPageView().getOption( 'editedElementView' );
			const settingsModel = widget.model.get( 'settings' );

			settingsModel.setExternalChange( {
				wpformsTheme: themeSlug,
				isCustomTheme: 'true',
				customThemeName: themeName,
			} );

			return true;
		},

		/**
		 * Maybe create a custom theme by given attributes.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} attributes Widget attributes.
		 *
		 * @return {string} New theme's slug.
		 */
		maybeCreateCustomThemeFromAttributes( attributes ) { // eslint-disable-line complexity
			const newThemeSlug = attributes.theme;
			/**
			 * @type     {Object|null}
			 * @property {Object} settings Theme settings.
			 */
			const existingTheme = app.getTheme( attributes.theme );
			const keys = Object.keys( attributes );

			let isExistingTheme = Boolean( existingTheme?.settings );

			// Check if the theme already exists and has the same settings.
			if ( isExistingTheme ) {
				for ( const i in keys ) {
					const key = keys[ i ];

					if ( ! existingTheme.settings[ key ] || existingTheme.settings[ key ] !== attributes[ key ] ) {
						isExistingTheme = false;

						break;
					}
				}
			}

			// The theme exists and has the same settings.
			if ( isExistingTheme ) {
				return newThemeSlug;
			}

			// The theme doesn't exist.
			// Normalize the attributes to the default theme settings.
			const defaultAttributes = Object.keys( themesData.wpforms.default.settings );
			const newSettings = {};

			for ( const i in defaultAttributes ) {
				const attr = defaultAttributes[ i ];

				newSettings[ attr ] = attributes[ attr ] ?? '';
			}

			// Create a new custom theme.
			themesData.custom[ newThemeSlug ] = {
				name: attributes.themeName ?? strings.theme_custom,
				settings: newSettings,
			};

			app.updateEnabledThemes( newThemeSlug, themesData.custom[ newThemeSlug ] );

			return newThemeSlug;
		},

		/**
		 * Update custom theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} attribute Attribute name.
		 * @param {string} value     New attribute value.
		 * @param {Object} atts      Widget properties.
		 */
		updateCustomThemeAttribute( attribute, value, atts ) { // eslint-disable-line complexity
			const themeSlug = atts.wpformsTheme;

			// Skip if it is one of the WPForms themes OR the attribute is not in the theme settings.
			if (
				themesData.wpforms[ themeSlug ] ||
				(
					attribute !== 'themeName' &&
					! themesData.wpforms.default.settings[ attribute ]
				)
			) {
				return;
			}

			// Skip if the custom theme doesn't exist in some rare cases.
			if ( ! themesData.custom[ themeSlug ] ) {
				return;
			}

			// Update the theme data.
			if ( attribute === 'themeName' ) {
				themesData.custom[ themeSlug ].name = value;
			} else {
				themesData.custom[ themeSlug ].settings = themesData.custom[ themeSlug ].settings || themesData.wpforms.default.settings;
				themesData.custom[ themeSlug ].settings[ attribute ] = value;
			}
		},

		/**
		 * Set the widget theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} themeSlug The theme slug.
		 *
		 * @return {boolean} True on success.
		 */
		setWidgetTheme( themeSlug ) { // eslint-disable-line complexity
			if ( app.maybeDisplayUpgradeModal( themeSlug ) ) {
				return false;
			}

			const theme = app.getTheme( themeSlug );

			if ( ! theme?.settings ) {
				return false;
			}

			const attributes = Object.keys( theme.settings );
			const widget = elementor.getPanelView().getCurrentPageView().getOption( 'editedElementView' );
			const settingsModel = widget.model.get( 'settings' );
			const isCustomTheme = !! themesData.custom[ themeSlug ];

			// Set the theme attribute.
			settingsModel.setExternalChange( {
				wpformsTheme: themeSlug,
				isCustomTheme: isCustomTheme ? 'true' : '',
				customThemeName: isCustomTheme ? themesData.custom[ themeSlug ].name : '',
			} );

			// Clean up the attributes.
			const cleanSettings = {};

			for ( const key in attributes ) {
				const attr = attributes[ key ];
				const value = theme.settings[ attr ];

				cleanSettings[ attr ] = typeof value === 'string'
					? value.replace( /px$/, '' )
					: value;
			}

			// Update the theme settings.
			app.updateStylesAtts( cleanSettings, settingsModel );

			// Activate the Publish button.
			const $pageView = elementor.getPanelView().getCurrentPageView().$el;
			$pageView.find( '.elementor-control-isCustomTheme input' ).trigger( 'input' );

			return true;
		},

		/**
		 * Update styles atts.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} themeSettings Theme settings.
		 * @param {Object} settingsModel Settings model.
		 */
		// eslint-disable-next-line complexity
		updateStylesAtts( themeSettings, settingsModel ) {
			const allowedKeys = WPFormsElementorModern.getStyleAttributesKeys();
			const validSettings = {};

			for ( const key in themeSettings ) {
				if ( ! allowedKeys.includes( key ) ) {
					continue;
				}

				let value = themeSettings[ key ];

				if ( key === 'backgroundUrl' && typeof value === 'string' ) {
					const match = value.match( /^url\(\s*['"]?(.*?)['"]?\s*\)$/i );
					if ( match && match[ 1 ] ) {
						value = { id: '', url: match[ 1 ] };
					} else {
						value = '';
					}
				}

				validSettings[ key ] = value;
			}

			// Update the widget settings.
			if ( Object.keys( validSettings ).length ) {
				settingsModel.setExternalChange( validSettings );
			}
		},

		/**
		 * Maybe display upgrades modal in Lite.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} themeSlug The theme slug.
		 *
		 * @return {boolean} True if modal was displayed.
		 */
		maybeDisplayUpgradeModal( themeSlug ) {
			if ( ! app.isDisabledTheme( themeSlug ) ) {
				return false;
			}

			if ( ! isPro ) {
				WPFormsElementorModern.showProModal( 'themes', strings.form_themes );

				return true;
			}

			if ( ! isLicenseActive ) {
				WPFormsElementorModern.showLicenseModal( strings.form_themes );

				return true;
			}

			return false;
		},

		/**
		 * Select widget theme event handler.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} value New attribute value.
		 */
		selectTheme( value ) {
			if ( ! app.setWidgetTheme( value ) ) {
				return;
			}

			app.onSelectThemeWithBG( value );
		},

		/**
		 * Change theme name event handler.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} value New attribute value.
		 * @param {Object} model Model object.
		 */
		changeThemeName( value, model ) {
			app.updateCustomThemeAttribute( 'themeName', value, model.attributes );
		},

		/**
		 * Open the theme delete confirmation window.
		 *
		 * @since 1.9.6
		 *
		 * @param {Object} atts   Widget properties.
		 * @param {Object} editor Editor object.
		 */
		deleteThemeModal( atts, editor ) {
			const themeName = app.getTheme( atts.wpformsTheme )?.name;
			const confirm = strings.theme_delete_confirm.replace( '%1$s', `<b>${ themeName }</b>` );
			const content = `<p class="wpforms-theme-delete-text">${ confirm } ${ strings.theme_delete_cant_undone }</p>`;
			const $panelContent = editor.$childViewContainer[ 0 ];
			const $themesControl = $( $panelContent ).find( '.wpforms-elementor-themes-control' );

			const dialog = elementorCommon.dialogsManager.createWidget( 'confirm', {
				message: content,
				headerMessage: strings.theme_delete_title,

				onConfirm: () => {
					// Remove theme from the theme storage.
					delete themesData.custom[ atts.wpformsTheme ];
					app.selectTheme( 'default' );
					app.updateThemesList( editor, $themesControl );
				},
			} );

			dialog.show();
		},

		/**
		 * Open stock photos install modal on the select theme.
		 *
		 * @since 1.9.6
		 *
		 * @param {string} themeSlug The theme slug.
		 */
		onSelectThemeWithBG( themeSlug ) {
			if ( WPFormsElementorModern.stockPhotos.isPicturesAvailable() ) {
				return;
			}

			// Check only WPForms themes.
			if ( ! app.isWPFormsTheme( themeSlug ) ) {
				return;
			}

			/**
			 * @type {Object|null}
			 * @property {Object|null} settings Settings.
			 */
			const theme = app.getTheme( themeSlug );
			const bgUrl = theme.settings?.backgroundUrl;

			if ( bgUrl?.length && bgUrl !== 'url()' ) {
				WPFormsElementorModern.stockPhotos.installModal( 'themes' );
			}
		},

		/**
		 * Determine if the user is on a Mac.
		 *
		 * @return {boolean} True if the user is on a Mac.
		 */
		isMac() {
			return navigator.userAgent.includes( 'Macintosh' );
		},
	};

	return app;
}( document, window, jQuery ) );

// Initialize.
WPFormsElementorThemes.init();
