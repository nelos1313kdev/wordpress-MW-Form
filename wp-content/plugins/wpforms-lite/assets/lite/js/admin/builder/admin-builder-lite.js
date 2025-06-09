/* global wpforms_builder_lite, wpforms_builder, Choices, wpf */

// noinspection ES6ConvertVarToLetConst

/**
 * @param wpforms_builder_lite.disable_notifications
 */

var WPFormsBuilderLite = window.WPFormsBuilderLite || ( function( document, window, $ ) { // eslint-disable-line no-var
	/**
	 * Public functions and properties.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * Start the engine.
		 *
		 * @since 1.0.0
		 */
		init() {
			// Document ready
			$( app.ready );
		},

		/**
		 * Document ready.
		 *
		 * @since 1.0.0
		 */
		ready() {
			app.bindUIActions();
		},

		/**
		 * Element bindings.
		 *
		 * @since 1.0.0
		 */
		bindUIActions() {
			// Warn users if they disable email notifications.
			$( document ).on( 'change', '#wpforms-panel-field-settings-notification_enable', function() {
				app.formBuilderNotificationAlert( $( this ).is( ':checked' ) );
			} );
		},

		/**
		 * Warn users if they disable email notifications.
		 *
		 * @since 1.5.0
		 *
		 * @param {boolean} value Whether notifications enabled or not. 0 is disabled, 1 is enabled.
		 */
		formBuilderNotificationAlert( value ) {
			if ( value !== false ) {
				return;
			}

			$.alert( {
				title: wpforms_builder.heads_up,
				content: wpforms_builder_lite.disable_notifications,
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
		 * Initialize Choices.js for the Coupon field.
		 *
		 * @since 1.9.4
		 */
		initCouponsChoicesJS() {
			if ( typeof window.Choices !== 'function' ) {
				return;
			}

			$( '.wpforms-field-option-row-allowed_coupons select:not(.choices__input)' ).each( function() {
				const $select = $( this );
				const choicesInstance = new Choices(
					$select.get( 0 ),
					{
						shouldSort: false,
						removeItemButton: true,
						renderChoicesLimit: 5,
						callbackOnInit() {
							wpf.showMoreButtonForChoices( this.containerOuter.element );
						},
					} );

				// Save Choices.js instance for future access.
				$select.data( 'choicesjs', choicesInstance );
			} );
		},
	};

	// Provide access to public functions/properties.
	return app;
}( document, window, jQuery ) );

WPFormsBuilderLite.init();
