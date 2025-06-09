<?php

namespace WPForms\Forms\Fields\Password;

use WPForms\Forms\Fields\Traits\ProField as ProFieldTrait;
use WPForms_Field;

/**
 * Password field.
 *
 * @since 1.9.4
 */
class Field extends WPForms_Field {

	use ProFieldTrait;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.9.4
	 */
	public function init() {

		// Define field type information.
		$this->name     = esc_html__( 'Password', 'wpforms-lite' );
		$this->keywords = esc_html__( 'user', 'wpforms-lite' );
		$this->type     = 'password';
		$this->icon     = 'fa-lock';
		$this->order    = 130;
		$this->group    = 'fancy';

		$this->init_pro_field();
		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.9.4
	 */
	protected function hooks() {
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data.
	 *
	 * @noinspection PackedHashtableOptimizationInspection
	 */
	public function field_options( $field ) {
		/*
		 * Basic field options.
		 */

		// Options open markup.
		$this->field_option(
			'basic-options',
			$field,
			[
				'markup'      => 'open',
				'after_title' => $this->get_field_options_notice(),
			]
		);

		// Label.
		$this->field_option( 'label', $field );

		// Description.
		$this->field_option( 'description', $field );

		// Required toggle.
		$this->field_option( 'required', $field );

		// Confirmation toggle.
		$fld  = $this->field_element(
			'toggle',
			$field,
			[
				'slug'    => 'confirmation',
				'value'   => isset( $field['confirmation'] ) ? '1' : '0',
				'desc'    => esc_html__( 'Enable Password Confirmation', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Check this option to ask users to provide their password twice.', 'wpforms-lite' ),
			],
			false
		);
		$args = [
			'slug'    => 'confirmation',
			'content' => $fld,
		];

		$this->field_element( 'row', $field, $args );

		// Password strength.
		$meter = $this->field_element(
			'toggle',
			$field,
			[
				'slug'    => 'password-strength',
				'value'   => isset( $field['password-strength'] ) ? '1' : '0',
				'desc'    => esc_html__( 'Enable Password Strength', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Check this option to set minimum password strength.', 'wpforms-lite' ),
			],
			false
		);
		$args  = [
			'slug'    => 'password-strength',
			'content' => $meter,
		];

		$this->field_element( 'row', $field, $args );

		$strength_label = $this->field_element(
			'label',
			$field,
			[
				'value'   => esc_html__( 'Minimum Strength', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select minimum password strength level.', 'wpforms-lite' ),
			],
			false
		);

		$strength = $this->field_element(
			'select',
			$field,
			[
				'slug'    => 'password-strength-level',
				'options' => [
					'2' => esc_html__( 'Weak', 'wpforms-lite' ),
					'3' => esc_html__( 'Medium', 'wpforms-lite' ),
					'4' => esc_html__( 'Strong', 'wpforms-lite' ),
				],
				'value'   => $field['password-strength-level'] ?? '3',

			],
			false
		);
		$args = [
			'slug'    => 'password-strength-level',
			'class'   => ! isset( $field['password-strength'] ) ? 'wpforms-hidden' : '',
			'content' => $strength_label . $strength,
		];

		$this->field_element( 'row', $field, $args );

		// Options close markup.
		$args = [
			'markup' => 'close',
		];

		$this->field_option( 'basic-options', $field, $args );

		/*
		 * Advanced field options.
		 */

		// Options open markup.
		$args = [
			'markup' => 'open',
		];

		$this->field_option( 'advanced-options', $field, $args );

		// Size.
		$this->field_option( 'size', $field );

		// Placeholder.
		$this->field_option( 'placeholder', $field );

		// Confirmation Placeholder.
		$lbl  = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'confirmation_placeholder',
				'value'   => esc_html__( 'Confirmation Placeholder Text', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Enter text for the confirmation field placeholder.', 'wpforms-lite' ),
			],
			false
		);
		$fld  = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'confirmation_placeholder',
				'value' => ! empty( $field['confirmation_placeholder'] ) ? esc_attr( $field['confirmation_placeholder'] ) : '',
			],
			false
		);
		$args = [
			'slug'    => 'confirmation_placeholder',
			'content' => $lbl . $fld,
		];

		$this->field_element( 'row', $field, $args );

		// Default value.
		$this->field_option( 'default_value', $field );

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Hide Label.
		$this->field_option( 'label_hide', $field );

		// Hide sublabels.
		$this->field_option( 'sublabel_hide', $field );

		// Options close markup.
		$args = [
			'markup' => 'close',
		];

		$this->field_option( 'advanced-options', $field, $args );
	}

	/**
	 * Field preview inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Current field specific data.
	 */
	public function field_preview( $field ) {

		$placeholder         = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
		$confirm_placeholder = ! empty( $field['confirmation_placeholder'] ) ? $field['confirmation_placeholder'] : '';
		$default_value       = ! empty( $field['default_value'] ) ? $field['default_value'] : '';
		$confirm             = ! empty( $field['confirmation'] ) ? 'enabled' : 'disabled';

		// Label.
		$this->field_preview_option(
			'label',
			$field,
			[
				'label_badge' => $this->get_field_preview_badge(),
			]
		);
		?>

		<div class="wpforms-confirm wpforms-confirm-<?php echo esc_attr( $confirm ); ?>">

			<div class="wpforms-confirm-primary">
				<input type="password" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $default_value ); ?>" class="primary-input" readonly>
				<label class="wpforms-sub-label"><?php esc_html_e( 'Password', 'wpforms-lite' ); ?></label>
			</div>

			<div class="wpforms-confirm-confirmation">
				<input type="password" placeholder="<?php echo esc_attr( $confirm_placeholder ); ?>" class="secondary-input" readonly>
				<label class="wpforms-sub-label"><?php esc_html_e( 'Confirm Password', 'wpforms-lite' ); ?></label>
			</div>

		</div>

		<?php
		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field      Field data and settings.
	 * @param array $deprecated Deprecated field attributes. Use field properties.
	 * @param array $form_data  Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {
	}
}
