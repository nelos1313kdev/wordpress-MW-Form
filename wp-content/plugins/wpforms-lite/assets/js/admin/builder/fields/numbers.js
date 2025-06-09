/* global wpf */

/**
 * Form Builder Field Numbers module.
 *
 * @since 1.9.4
 */
var WPForms = window.WPForms || {}; // eslint-disable-line no-var

WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

WPForms.Admin.Builder.FieldNumbers = WPForms.Admin.Builder.FieldNumbers || ( function( document, window, $ ) { // eslint-disable-line
	/**
	 * Public functions and properties.
	 *
	 * @since 1.9.4
	 *
	 * @type {Object}
	 */
	const app = {

		/**
		 * WPForms builder element.
		 *
		 * @since 1.9.4
		 *
		 * @type {jQuery}
		 */
		$builder: null,

		/**
		 * Track if a tag was clicked recently.
		 *
		 * @since 1.9.5
		 *
		 * @type {boolean}
		 */
		tagClicked: false,

		/**
		 * Initialize the application.
		 *
		 * @since 1.9.4
		 */
		init() {
			$( app.ready );
		},

		/**
		 * Called when the DOM is fully loaded.
		 *
		 * @since 1.9.4
		 */
		ready() {
			app.$builder = $( '#wpforms-builder' );
			app.numbersEvents();
		},

		/**
		 * Binds separate events for min, max, and default value inputs.
		 *
		 * @since 1.9.4
		 */
		numbersEvents() {
			app.$builder.on(
				'change',
				'.wpforms-field-option-number .wpforms-numbers-min',
				app.onChangeNumbersMin
			);

			app.$builder.on(
				'change',
				'.wpforms-field-option-number .wpforms-numbers-max',
				app.onChangeNumbersMax
			);

			app.$builder.on(
				'input',
				'.wpforms-field-option-number .wpforms-field-option-row-default_value .wpforms-smart-tags-widget-original',
				_.debounce( app.onChangeNumbersDefaultValue, 500 )
			);

			app.$builder.on(
				'click',
				'.wpforms-smart-tags-widget .tag',
				app.smartTagClickTracking
			);
		},

		/**
		 * Track clicks on the smart tag bricks.
		 *
		 * @since 1.9.5
		 */
		smartTagClickTracking() {
			app.tagClicked = true;

			// Reset the flag after a short delay.
			setTimeout( () => {
				app.tagClicked = false;
			}, 200 );
		},

		/**
		 * Parses the numeric value of a field, returning null if invalid or empty.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $field The jQuery object for the input field.
		 *
		 * @return {number|null} The parsed numeric value or null.
		 */
		parseFieldValue( $field ) {
			if ( ! $field.length || $field.val() === '' ) {
				return null;
			}

			const value = parseFloat( $field.val() );

			return isNaN( value ) ? null : value;
		},

		/**
		 * Determines if the min value is greater than the max value.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $minField jQuery object for the min input field.
		 * @param {jQuery} $maxField jQuery object for the max input field.
		 *
		 * @return {boolean} True if min is greater than max, otherwise false.
		 */
		isInvalidMinMaxRange( $minField, $maxField ) {
			const min = app.parseFieldValue( $minField ),
				max = app.parseFieldValue( $maxField );

			return min !== null && max !== null && min > max;
		},

		/**
		 * Synchronizes the min attribute on the max field.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $minField jQuery object for the min input field.
		 * @param {jQuery} $maxField jQuery object for the max input field.
		 */
		syncNumberMinAttribute( $minField, $maxField ) {
			$maxField.attr( 'min', app.parseFieldValue( $minField ) );
		},

		/**
		 * Synchronizes the max attribute on the min field.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $minField jQuery object for the min input field.
		 * @param {jQuery} $maxField jQuery object for the max input field.
		 */
		syncNumberMaxAttribute( $minField, $maxField ) {
			$minField.attr( 'max', app.parseFieldValue( $maxField ) );
		},

		/**
		 * Adjusts the target field's value to match the source field's value.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $sourceField jQuery object for the field with the value to copy.
		 * @param {jQuery} $targetField jQuery object for the field to update.
		 */
		adjustValue( $sourceField, $targetField ) {
			$targetField.val( app.parseFieldValue( $sourceField ) ).trigger( 'input' ).trigger( 'wpformsSmartTagsInputSync' );
		},

		/**
		 * Handles the 'input' event for the min field, ensuring correct min <= max and default value.
		 *
		 * @since 1.9.4
		 *
		 * @param {Event} event The input event object.
		 */
		onChangeNumbersMin( event ) {
			const $minField = $( event.target ),
				$container = $minField.closest( '.wpforms-field-option-group' ),
				$maxField = $container.find( '.wpforms-numbers-max' ),
				$defaultValueField = $container.find( '.wpforms-field-option-row-default_value input.wpforms-smart-tags-widget-original' );

			if ( app.isInvalidMinMaxRange( $minField, $maxField ) ) {
				app.adjustValue( $maxField, $minField );
			}

			if ( app.isNeedAdjustDefaultValueByMinValue( $defaultValueField, $minField ) ) {
				app.adjustValue( $minField, $defaultValueField );
			}

			app.syncNumberMinAttribute( $minField, $maxField );
		},

		/**
		 * Handles the 'change' event for the max field, ensuring correct min <= max and default value.
		 *
		 * @since 1.9.4
		 *
		 * @param {Event} event The change event object.
		 *
		 * @return {void}
		 */
		onChangeNumbersMax( event ) {
			const $maxField = $( event.target ),
				$container = $maxField.closest( '.wpforms-field-option-group' ),
				$minField = $container.find( '.wpforms-numbers-min' ),
				$defaultValueField = $container.find( '.wpforms-field-option-row-default_value input.wpforms-smart-tags-widget-original' );

			if ( app.isInvalidMinMaxRange( $minField, $maxField ) ) {
				app.adjustValue( $minField, $maxField );
			}

			if ( app.isNeedAdjustDefaultValueByMaxValue( $defaultValueField, $maxField ) ) {
				app.adjustValue( $maxField, $defaultValueField );
			}

			app.syncNumberMaxAttribute( $minField, $maxField );
		},

		/**
		 * Normalize a float value of the input field by replacing commas with dots.
		 * If the normalized value differs from the original,
		 * the input field will be updated and the 'input' event will be triggered.
		 * Non-numeric values are ignored and remain unchanged.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $field The input field to normalize.
		 *
		 * @return {void}
		 */
		normalizeFloatValue( $field ) {
			const value = $field.val(),
				valueWithoutComma = value.replace( ',', '.' );

			if ( wpf.isNumber( valueWithoutComma ) && value !== parseFloat( value ).toString() ) {
				$field.val( parseFloat( valueWithoutComma ) ).trigger( 'input' );
			}
		},

		/**
		 * Checks if the default value is below the current min value.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $defaultValueField jQuery object for the default value input.
		 * @param {jQuery} $minField          jQuery object for the min input field.
		 *
		 * @return {boolean} True if default value is less than min, otherwise false.
		 */
		isNeedAdjustDefaultValueByMinValue( $defaultValueField, $minField ) {
			const defaultValue = app.parseFieldValue( $defaultValueField ),
				min = app.parseFieldValue( $minField );

			return wpf.isNumber( defaultValue ) && min !== null && defaultValue < min;
		},

		/**
		 * Checks if the default value is above the current max value.
		 *
		 * @since 1.9.4
		 *
		 * @param {jQuery} $defaultValueField jQuery object for the default value input.
		 * @param {jQuery} $maxField          jQuery object for the max input field.
		 *
		 * @return {boolean} True if default value is greater than max, otherwise false.
		 */
		isNeedAdjustDefaultValueByMaxValue( $defaultValueField, $maxField ) {
			const defaultValue = app.parseFieldValue( $defaultValueField ),
				max = app.parseFieldValue( $maxField );

			return wpf.isNumber( defaultValue ) && max !== null && defaultValue > max;
		},

		/**
		 * Handles the 'change' event for the default value field, keeping it in range.
		 *
		 * @since 1.9.4
		 *
		 * @param {Event} event The change event object.
		 */
		onChangeNumbersDefaultValue( event ) {
			if (
				app.tagClicked || // Tag was recently clicked to prevent unnecessary updates.
				event.handleObj?.type === 'focusout' // Event was triggered when editable tag was changed.
			) {
				return;
			}

			const $defaultValueField = $( event.target );
			const $container = $defaultValueField.closest( '.wpforms-field-option-group' );
			const $minField = $container.find( '.wpforms-numbers-min' );
			const $maxField = $container.find( '.wpforms-numbers-max' );

			app.normalizeFloatValue( $defaultValueField );

			if ( app.isNeedAdjustDefaultValueByMinValue( $defaultValueField, $minField ) ) {
				app.adjustValue( $minField, $defaultValueField );
			}

			if ( app.isNeedAdjustDefaultValueByMaxValue( $defaultValueField, $maxField ) ) {
				app.adjustValue( $maxField, $defaultValueField );
			}
		},
	};

	return app;
}( document, window, jQuery ) );

WPForms.Admin.Builder.FieldNumbers.init();
