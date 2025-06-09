<?php

namespace WPForms\Forms\Fields\Pagebreak;

use WPForms\Forms\Fields\Traits\ProField as ProFieldTrait;
use WPForms_Field;

/**
 * Pagebreak field.
 *
 * @since 1.9.4
 */
class Field extends WPForms_Field {

	use ProFieldTrait;

	/**
	 * Default indicator color.
	 *
	 * @since 1.9.4
	 */
	private const DEFAULT_INDICATOR_COLOR = [
		'classic' => '#72b239',
		'modern'  => '#066aab',
	];

	/**
	 * Pages information.
	 *
	 * @since 1.9.4
	 *
	 * @var array|bool
	 */
	protected $pagebreak;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.9.4
	 */
	public function init() {

		// Define field type information.
		$this->name     = esc_html__( 'Page Break', 'wpforms-lite' );
		$this->keywords = esc_html__( 'progress bar, multi step, multi part', 'wpforms-lite' );
		$this->type     = 'pagebreak';
		$this->icon     = 'fa-files-o';
		$this->order    = 160;
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

		add_filter( 'wpforms_field_preview_class', [ $this, 'preview_field_class' ], 10, 2 );
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data.
	 */
	public function field_options( $field ) {

		$position       = ! empty( $field['position'] ) ? esc_attr( $field['position'] ) : '';
		$position_class = ! empty( $field['position'] ) ? 'wpforms-pagebreak-' . $position : '';

		$this->field_options_basic( $field, $position, $position_class );
		$this->field_options_advanced( $field, $position, $position_class );
	}

	/**
	 * Advanced field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array  $field          Field data.
	 * @param string $position       Position.
	 * @param string $position_class Position CSS class.
     */
	private function field_options_basic( array $field, string $position, string $position_class ): void { // phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh

		// Hidden field indicating the position.
		$this->field_element(
			'text',
			$field,
			[
				'type'  => 'hidden',
				'slug'  => 'position',
				'value' => $position,
				'class' => 'position',
			]
		);

		/*
		 * Basic field options.
		 */

		// Options open markup.
		$this->field_option(
			'basic-options',
			$field,
			[
				'markup'      => 'open',
				'class'       => $position_class,
				'after_title' => $this->get_field_options_notice(),
			]
		);

		$this->field_options_basic_top( $field, $position );

		// Page Title, don't display for bottom pagebreaks.
		if ( $position !== 'bottom' ) {
			$lbl = $this->field_element(
				'label',
				$field,
				[
					'slug'    => 'title',
					'value'   => esc_html__( 'Page Title', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Enter text for the page title.', 'wpforms-lite' ),
				],
				false
			);

			$fld = $this->field_element(
				'text',
				$field,
				[
					'slug'  => 'title',
					'value' => ! empty( $field['title'] ) ? esc_attr( $field['title'] ) : '',
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'title',
					'content' => $lbl . $fld,
				]
			);
		}

		// Next label.
		if ( empty( $position ) ) {
			$lbl = $this->field_element(
				'label',
				$field,
				[
					'slug'    => 'next',
					'value'   => esc_html__( 'Next Label', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Enter text for Next page navigation button.', 'wpforms-lite' ),
				],
				false
			);
			$fld = $this->field_element(
				'text',
				$field,
				[
					'slug'  => 'next',
					'value' => ! empty( $field['next'] ) ? esc_attr( $field['next'] ) : esc_html__( 'Next', 'wpforms-lite' ),
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'next',
					'content' => $lbl . $fld,
				]
			);
		}

		// Options are not available to top pagebreaks.
		if ( $position !== 'top' ) {

			// Previous button toggle.
			$fld = $this->field_element(
				'toggle',
				$field,
				[
					'slug'    => 'prev_toggle',
					// Backward compatibility for forms that were created before the toggle was added.
					'value'   => ! empty( $field['prev_toggle'] ) || ! empty( $field['prev'] ),
					'desc'    => esc_html__( 'Display Previous', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Toggle displaying the Previous page navigation button.', 'wpforms-lite' ),
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'prev_toggle',
					'content' => $fld,
				]
			);

			// Previous button label.
			$lbl = $this->field_element(
				'label',
				$field,
				[
					'slug'    => 'prev',
					'value'   => esc_html__( 'Previous Label', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Enter text for Previous page navigation button.', 'wpforms-lite' ),
				],
				false
			);
			$fld = $this->field_element(
				'text',
				$field,
				[
					'slug'  => 'prev',
					'value' => ! empty( $field['prev'] ) ? esc_attr( $field['prev'] ) : '',
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'prev',
					'content' => $lbl . $fld,
					'class'   => empty( $field['prev_toggle'] ) ? 'wpforms-hidden' : '',
				]
			);
		}

		// Options close markup.
		$this->field_option(
			'basic-options',
			$field,
			[
				'markup' => 'close',
			]
		);
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array  $field    Field data.
	 * @param string $position Position.
	 */
	private function field_options_basic_top( array $field, string $position ): void {

		// Options specific to the top pagebreak.
		if ( $position !== 'top' ) {
			return;
		}

		// Indicator themes.
		$themes = [
			'progress'  => esc_html__( 'Progress Bar', 'wpforms-lite' ),
			'circles'   => esc_html__( 'Circles', 'wpforms-lite' ),
			'connector' => esc_html__( 'Connector', 'wpforms-lite' ),
			'none'      => esc_html__( 'None', 'wpforms-lite' ),
		];

		/**
		 * Filter the available Pagebreak Indicator themes.
		 *
		 * @since 1.6.6
		 *
		 * @param array $themes Available themes.
		 */
		$themes = apply_filters( 'wpforms_pagebreak_indicator_themes', $themes ); // phpcs:ignore WPForms.PHP.ValidateHooks.InvalidHookName
		$lbl    = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'indicator',
				'value'   => esc_html__( 'Progress Indicator', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select theme for Page Indicator which is displayed at the top of the form.', 'wpforms-lite' ),
			],
			false
		);
		$fld    = $this->field_element(
			'select',
			$field,
			[
				'slug'    => 'indicator',
				'value'   => ! empty( $field['indicator'] ) ? esc_attr( $field['indicator'] ) : 'progress',
				'options' => $themes,
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'indicator',
				'content' => $lbl . $fld,
			]
		);

		// Indicator color picker.
		$lbl = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'indicator_color',
				'value'   => esc_html__( 'Page Indicator Color', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select the primary color for the Page Indicator theme.', 'wpforms-lite' ),
			],
			false
		);

		$indicator_color = isset( $field['indicator_color'] ) ? wpforms_sanitize_hex_color( $field['indicator_color'] ) : self::get_default_indicator_color();

		$fld = $this->field_element(
			'color',
			$field,
			[
				'slug'  => 'indicator_color',
				'value' => $indicator_color,
				'data'  => [
					'fallback-color' => $indicator_color,
				],
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'indicator_color',
				'content' => $lbl . $fld,
				'class'   => 'color-picker-row',
			]
		);
	}

	/**
	 * Advanced field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array  $field          Field data.
	 * @param string $position       Position.
	 * @param string $position_class Position CSS class.
     */
	private function field_options_advanced( array $field, string $position, string $position_class ): void {

		if ( $position === 'bottom' ) {
			return;
		}

		/**
		 * Advanced field options.
		 */

		// Options open markup.
		$this->field_option(
			'advanced-options',
			$field,
			[
				'markup' => 'open',
				'class'  => $position_class,
			]
		);

		// Navigation alignment, only available to the top.
		if ( $position === 'top' ) {
			$lbl = $this->field_element(
				'label',
				$field,
				[
					'slug'    => 'nav_align',
					'value'   => esc_html__( 'Page Navigation Alignment', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Select the alignment for the Next/Previous page navigation buttons', 'wpforms-lite' ),
				],
				false
			);
			$fld = $this->field_element(
				'select',
				$field,
				[
					'slug'    => 'nav_align',
					'value'   => ! empty( $field['nav_align'] ) ? esc_attr( $field['nav_align'] ) : '',
					'options' => [
						'left'  => esc_html__( 'Left', 'wpforms-lite' ),
						'right' => esc_html__( 'Right', 'wpforms-lite' ),
						''      => esc_html__( 'Center', 'wpforms-lite' ),
						'split' => esc_html__( 'Split', 'wpforms-lite' ),
					],
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'nav_align',
					'content' => $lbl . $fld,
				]
			);

			// Scroll animation toggle.
			$fld = $this->field_element(
				'toggle',
				$field,
				[
					'slug'    => 'scroll_disabled',
					'value'   => ! empty( $field['scroll_disabled'] ),
					'desc'    => esc_html__( 'Disable Scroll Animation', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'By default, a user\'s view is pulled to the top of each form page. Set to ON to disable this animation.', 'wpforms-lite' ),
				],
				false
			);

			$this->field_element(
				'row',
				$field,
				[
					'slug'    => 'scroll_disabled',
					'content' => $fld,
				]
			);
		}

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Options close markup.
		$this->field_option(
			'advanced-options',
			$field,
			[
				'markup' => 'close',
			]
		);
	}

	/**
	 * Field preview inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data.
	 */
	public function field_preview( $field ) { // phpcs:ignore Generic.Metrics.CyclomaticComplexity.MaxExceeded

		$nav_align  = 'wpforms-pagebreak-buttons-left';
		$prev       = ! empty( $field['prev'] ) ? $field['prev'] : esc_html__( 'Previous', 'wpforms-lite' );
		$prev_class = empty( $field['prev'] ) && empty( $field['prev_toggle'] ) ? 'wpforms-hidden' : '';
		$next       = ! empty( $field['next'] ) ? $field['next'] : esc_html__( 'Next', 'wpforms-lite' );
		$next_class = empty( $next ) ? 'wpforms-hidden' : '';
		$position   = ! empty( $field['position'] ) ? $field['position'] : 'normal';
		$title      = ! empty( $field['title'] ) ? $field['title'] : '';
		$label      = $position === 'top' ? esc_html__( 'First Page / Progress Indicator', 'wpforms-lite' ) : '';
		$label      = $position === 'normal' && empty( $label ) ? esc_html__( 'Page Break', 'wpforms-lite' ) : $label;

		/**
		 * Fires before page break is displayed on the preview.
		 *
		 * @since 1.7.9
		 *
		 * @param array $form_data Form data and settings.
		 * @param array $field     Field data.
		 */
		do_action( 'wpforms_field_page_break_field_preview_before', $this->form_data, $field ); // phpcs:ignore WPForms.PHP.ValidateHooks.InvalidHookName

		if ( $position !== 'top' ) {
			if ( empty( $this->form_data ) ) {
				$this->form_data = wpforms()->obj( 'form' )->get( $this->form_id, [ 'content_only' => true ] );
			}

			if ( empty( $this->pagebreak ) ) {
				$this->pagebreak = wpforms_get_pagebreak_details( $this->form_data );
			}

			if ( ! empty( $this->pagebreak['top']['nav_align'] ) ) {
				$nav_align = 'wpforms-pagebreak-buttons-' . $this->pagebreak['top']['nav_align'];
			}

			echo '<div class="wpforms-pagebreak-buttons ' . sanitize_html_class( $nav_align ) . '">';
			printf(
				'<button class="wpforms-pagebreak-button wpforms-pagebreak-prev %s">%s</button>',
				sanitize_html_class( $prev_class ),
				esc_html( $prev )
			);

			if ( $position !== 'bottom' ) {
				printf(
					'<button class="wpforms-pagebreak-button wpforms-pagebreak-next %s">%s</button>',
					sanitize_html_class( $next_class ),
					esc_html( $next )
				);

				if ( $next_class !== 'wpforms-hidden' ) {

					/** This action is documented in includes/class-frontend.php. */
					do_action( 'wpforms_display_submit_after', $this->form_data, 'next' ); // phpcs:ignore WPForms.PHP.ValidateHooks.InvalidHookName
				}
			}
			echo '</div>';
		}

		// Visual divider.
		echo '<div class="wpforms-pagebreak-divider">';
		if ( $position !== 'bottom' ) {
			printf(
				'<span class="pagebreak-label">%1$s <span class="wpforms-pagebreak-title">%2$s</span>%3$s</span>',
				esc_html( $label ),
				esc_html( $title ),
				$this->get_field_preview_badge() // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		echo '<span class="line"></span>';
		echo '</div>';

		/**
		 * Fires after page break is displayed on the preview.
		 *
		 * @since 1.7.9
		 *
		 * @param array $form_data Form data and settings.
		 * @param array $field     Field data.
		 */
		do_action( 'wpforms_field_page_break_field_preview_after', $this->form_data, $field ); // phpcs:ignore WPForms.PHP.ValidateHooks.InvalidHookName
	}

	/**
	 * Add class to the builder field preview.
	 *
	 * @since 1.9.4
	 *
	 * @param string|mixed $css   CSS classes.
	 * @param array        $field Field data and settings.
	 *
	 * @return string
	 */
	public function preview_field_class( $css, $field ): string {

		$css = (string) $css;

		if ( $field['type'] !== 'pagebreak' ) {
			return $css;
		}

		if ( ! empty( $field['position'] ) && $field['position'] === 'top' ) {
			$css .= ' wpforms-field-stick wpforms-pagebreak-top';
		} elseif ( ! empty( $field['position'] ) && $field['position'] === 'bottom' ) {
			$css .= ' wpforms-field-stick wpforms-pagebreak-bottom';
		} else {
			$css .= ' wpforms-pagebreak-normal';
		}

		return $css;
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field      Field data and settings.
	 * @param array $deprecated Field attributes.
	 * @param array $form_data  Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {
	}

	/**
	 * Get the default indicator color.
	 *
	 * @since 1.9.4
	 *
	 * @return string
	 */
	public static function get_default_indicator_color(): string {

		$render_engine = wpforms_get_render_engine();

		return array_key_exists( $render_engine, self::DEFAULT_INDICATOR_COLOR ) ? self::DEFAULT_INDICATOR_COLOR[ $render_engine ] : self::DEFAULT_INDICATOR_COLOR['modern'];
	}
}
