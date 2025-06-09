<?php

namespace WPForms\Forms\Fields\FileUpload;

use WPForms\Forms\Fields\Traits\ProField as ProFieldTrait;
use WPForms_Field;

/**
 * File upload field.
 *
 * @since 1.9.4
 */
class Field extends WPForms_Field {

	use ProFieldTrait;

	/**
	 * Classic (old) style of file uploader field.
	 *
	 * @since 1.9.4
	 *
	 * @var string
	 */
	public const STYLE_CLASSIC = 'classic';

	/**
	 * Modern style of file uploader field.
	 *
	 * @since 1.9.4
	 *
	 * @var string
	 */
	public const STYLE_MODERN = 'modern';

	/**
	 * Maximum file number.
	 *
	 * @since 1.9.4
	 *
	 * @var int
	 */
	private const MAX_FILE_NUM = 100;

	/**
	 * Replaceable (either in PHP or JS) template for a maximum file number.
	 *
	 * @since 1.9.4
	 *
	 * @var string
	 */
	protected const TEMPLATE_MAXFILENUM = '{maxFileNumber}';

	/**
	 * User roles.
	 *
	 * @since 1.9.4
	 *
	 * @var array
	 */
	private $user_roles = [];

	/**
	 * Primary class constructor.
	 *
	 * @since 1.9.4
	 */
	public function init() {

		// Define field type information.
		$this->name  = esc_html__( 'File Upload', 'wpforms-lite' );
		$this->type  = 'file-upload';
		$this->icon  = 'fa-upload';
		$this->order = 100;
		$this->group = 'fancy';

		$this->default_settings = [
			'style' => self::STYLE_MODERN,
		];

		$this->init_pro_field();
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @noinspection HtmlUnknownTarget
	 */
	public function field_options( $field ) {

		$style = ! empty( $field['style'] ) ? $field['style'] : self::STYLE_MODERN;

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

		// Allowed extensions.
		$lbl = $this->field_element(
			'label',
			$field,
			[
				'slug'          => 'extensions',
				'value'         => esc_html__( 'Allowed File Extensions', 'wpforms-lite' ),
				'tooltip'       => esc_html__( 'Enter the extensions you would like to allow, comma separated.', 'wpforms-lite' ),
				'after_tooltip' => sprintf(
					'<a href="%1$s" class="after-label-description" target="_blank" rel="noopener noreferrer">%2$s</a>',
					esc_url( wpforms_utm_link( 'https://wpforms.com/docs/a-complete-guide-to-the-file-upload-field/#file-types', 'Field Options', 'File Upload Extensions Documentation' ) ),
					esc_html__( 'See More Details', 'wpforms-lite' )
				),
			],
			false
		);

		$fld = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'extensions',
				'value' => ! empty( $field['extensions'] ) ? $field['extensions'] : '',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'extensions',
				'content' => $lbl . $fld,
			]
		);

		// Max file size.
		$lbl = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'max_size',
				'value'   => esc_html__( 'Max File Size', 'wpforms-lite' ),
				'tooltip' => sprintf( /* translators: %s - max upload size. */
					esc_html__( 'Enter the max size of each file, in megabytes, to allow. If left blank, the value defaults to the maximum size the server allows which is %s.', 'wpforms-lite' ),
					wpforms_max_upload()
				),
			],
			false
		);
		$fld = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'max_size',
				'type'  => 'number',
				'attrs' => [
					'min'     => 1,
					'max'     => 512,
					'step'    => 1,
					'pattern' => '[0-9]',
				],
				'value' => ! empty( $field['max_size'] ) ? abs( $field['max_size'] ) : '',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'max_size',
				'content' => $lbl . $fld,
			]
		);

		// Max file number.
		$lbl = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'max_file_number',
				'value'   => esc_html__( 'Max File Uploads', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Enter the max number of files to allow. If left blank, the value defaults to 1.', 'wpforms-lite' ),
			],
			false
		);

		$fld = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'max_file_number',
				'type'  => 'number',
				'attrs' => [
					'min'     => 1,
					'max'     => self::MAX_FILE_NUM,
					'step'    => 1,
					'pattern' => '[0-9]',
				],
				'value' => $this->get_max_file_number( $field ),
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'max_file_number',
				'content' => $lbl . $fld,
				'class'   => $style === self::STYLE_CLASSIC ? 'wpforms-hidden' : '',
			]
		);

		// Required toggle.
		$this->field_option( 'required', $field );

		// Options close markup.
		$this->field_option( 'basic-options', $field, [ 'markup' => 'close' ] );

		/*
		 * Advanced field options.
		 */

		// Options open markup.
		$this->field_option( 'advanced-options', $field, [ 'markup' => 'open' ] );

		// Style.
		$lbl = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'style',
				'value'   => esc_html__( 'Style', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Modern Style supports multiple file uploads, displays a drag-and-drop upload box, and uses AJAX. Classic Style supports single file upload and displays a traditional upload button.', 'wpforms-lite' ),
			],
			false
		);

		$fld = $this->field_element(
			'select',
			$field,
			[
				'slug'    => 'style',
				'value'   => $style,
				'options' => [
					self::STYLE_MODERN  => esc_html__( 'Modern', 'wpforms-lite' ),
					self::STYLE_CLASSIC => esc_html__( 'Classic', 'wpforms-lite' ),
				],
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'style',
				'content' => $lbl . $fld,
			]
		);

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Media Library toggle.
		$fld = $this->field_element(
			'toggle',
			$field,
			[
				'slug'    => 'media_library',
				'value'   => ! empty( $field['media_library'] ) ? 1 : '',
				'desc'    => esc_html__( 'Store Files in WordPress Media Library', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Check this option to store the final uploaded file in the WordPress Media Library', 'wpforms-lite' ),
				'class'   => 'wpforms-file-upload-media-library',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'media_library',
				'content' => $fld,
			]
		);

		// Access Restrictions.
		$this->access_restrictions_options( $field );

		// Hide Label.
		$this->field_option( 'label_hide', $field );

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
	 * Add access restrictions options to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function access_restrictions_options( array $field ): void {

		$access_restrictions = $this->field_element(
			'toggle',
			$field,
			[
				'slug'    => 'is_restricted',
				'value'   => ! empty( $field['is_restricted'] ) ? 1 : '',
				'desc'    => esc_html__( 'Enable File Access Restrictions', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Choose who can access the uploaded files.', 'wpforms-lite' ),
				'class'   => 'wpforms-file-upload-access-restrictions',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'access_restrictions',
				'attrs'   => $this->get_access_restrictions_options_attrs(),
				'content' => $access_restrictions,
			]
		);

		// User Restriction.
		$this->user_restriction_options( $field );

		// Password Protection.
		$this->password_protection_options( $field );
	}

	/**
	 * Get access restrictions options attributes.
	 *
	 * @since 1.9.4
	 *
	 * @return array
	 */
	protected function get_access_restrictions_options_attrs(): array {

		return [];
	}

	/**
	 * Add user restrictions options to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function user_restriction_options( array $field ): void {

		$user_restrictions_value = $this->get_user_restrictions_value( $field );

		$this->add_user_restrictions_select( $field, $user_restrictions_value );

		$hide_user_restrictions = $this->should_hide_user_restrictions( $user_restrictions_value, $field );

		$this->add_user_roles_restrictions( $field, $hide_user_restrictions );
		$this->add_user_names_restrictions( $field, $hide_user_restrictions );
	}

	/**
	 * Get user restrictions value.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return string
	 */
	private function get_user_restrictions_value( array $field ): string {

		return ! empty( $field['user_restrictions'] ) ? $field['user_restrictions'] : 'none';
	}

	/**
	 * Add user restrictions select to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array  $field                   Field data and settings.
	 * @param string $user_restrictions_value User restrictions value.
	 */
	private function add_user_restrictions_select( array $field, string $user_restrictions_value ): void {

		$label = $this->field_element(
			'label',
			$field,
			[
				'slug'  => 'user_restrictions',
				'value' => esc_html__( 'User Restriction', 'wpforms-lite' ),
			],
			false
		);

		$select = $this->field_element(
			'select',
			$field,
			[
				'slug'    => 'user_restrictions',
				'value'   => $user_restrictions_value,
				'options' => [
					'none'   => esc_html__( 'None', 'wpforms-lite' ),
					'logged' => esc_html__( 'Logged-in Users', 'wpforms-lite' ),
				],
				'class'   => 'wpforms-file-upload-user-restrictions',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'user_restrictions',
				'content' => $label . $select,
				'class'   => $this->is_restricted( $field ) ? '' : 'wpforms-hidden',
			]
		);
	}

	/**
	 * Check if user restrictions should be hidden.
	 *
	 * @since 1.9.4
	 *
	 * @param string $user_restrictions_value User restrictions value.
	 * @param array  $field                   Field data and settings.
	 *
	 * @return bool
	 */
	private function should_hide_user_restrictions( string $user_restrictions_value, array $field ): bool {

		return $user_restrictions_value === 'none' || ! $this->is_restricted( $field );
	}

	/**
	 * Add user roles restrictions to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field                  Field data and settings.
	 * @param bool  $hide_user_restrictions Should user restrictions be hidden.
	 */
	private function add_user_roles_restrictions( array $field, bool $hide_user_restrictions ): void {

		$label = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'user_roles_restrictions',
				'value'   => esc_html__( 'User Roles', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select the user roles that can access the uploaded files.', 'wpforms-lite' ),
			],
			false
		);

		$select = $this->field_element(
			'select-multiple',
			$field,
			[
				'slug'      => 'user_roles_restrictions',
				'value'     => $this->get_selected_roles( $field ),
				'desc'      => esc_html__( 'All users with selected roles will be able to access the uploaded files.', 'wpforms-lite' ),
				'options'   => $this->get_user_roles(),
				'choicesjs' => false,
				'class'     => 'wpforms-file-upload-user-roles-select',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'user_roles_restrictions',
				'content' => $label . $select,
				'class'   => $hide_user_restrictions ? 'wpforms-hidden' : '',
			]
		);
	}

	/**
	 * Get selected roles.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return array
	 */
	private function get_selected_roles( array $field ): array {

		$selected_roles = ! empty( $field['user_roles_restrictions'] ) ? json_decode( $field['user_roles_restrictions'], true ) : [];

		array_unshift( $selected_roles, 'administrator' );

		return array_unique( $selected_roles );
	}

	/**
	 * Get user roles.
	 *
	 * @since 1.9.4
	 *
	 * @return array
	 */
	private function get_user_roles(): array {

		if ( empty( $this->user_roles ) ) {
			$roles = get_editable_roles();

			$this->user_roles = array_map(
				static function ( $item ) {

					return $item['name'];
				},
				$roles
			);
		}

		return $this->user_roles;
	}

	/**
	 * Add user names restrictions to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field                  Field data and settings.
	 * @param bool  $hide_user_restrictions Should user restrictions be hidden.
	 */
	private function add_user_names_restrictions( array $field, bool $hide_user_restrictions ): void {

		$label = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'user_names_restrictions',
				'value'   => esc_html__( 'Users', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select the users that can access the uploaded files.', 'wpforms-lite' ),
			],
			false
		);

		$select = $this->field_element(
			'select-multiple',
			$field,
			[
				'slug'      => 'user_names_restrictions',
				'value'     => array_map( 'intval', $this->get_user_ids( $field ) ),
				'options'   => $this->get_user_list( $field ),
				'choicesjs' => false,
				'class'     => 'wpforms-file-upload-user-names-select',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'user_names_restrictions',
				'content' => $label . $select,
				'class'   => $hide_user_restrictions ? 'wpforms-hidden' : '',
			]
		);
	}

	/**
	 * Get user ids.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return array
	 */
	private function get_user_ids( array $field ): array {

		return ! empty( $field['user_names_restrictions'] ) ? json_decode( $field['user_names_restrictions'], true ) : [];
	}

	/**
	 * Get user list.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return array
	 */
	private function get_user_list( array $field ): array {

		$user_ids = $this->get_user_ids( $field );

		return $this->get_selected_users( $user_ids );
	}

	/**
	 * Get selected users.
	 *
	 * @since 1.9.4
	 *
	 * @param array $user_ids User IDs.
	 *
	 * @return array
	 */
	private function get_selected_users( array $user_ids ): array {

		$selected_users = [];

		if ( ! empty( $user_ids ) ) {
			$users = get_users(
				[
					'include' => $user_ids,
					'fields'  => [ 'ID', 'display_name' ],
					'orderby' => 'include',
				]
			);

			$selected_users = wp_list_pluck( $users, 'display_name', 'ID' );
		}

		return $selected_users;
	}

	/**
	 * Add password protection options to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function password_protection_options( array $field ): void {

		$this->add_password_toggle( $field );
		$this->add_password_label( $field );
		$this->add_password_fields( $field );
	}

	/**
	 * Add password toggle to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function add_password_toggle( array $field ): void {

		$password = $this->field_element(
			'toggle',
			$field,
			[
				'slug'    => 'is_protected',
				'value'   => ! empty( $field['is_protected'] ) ? 1 : '',
				'desc'    => esc_html__( 'Password Protection', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Check this option to password protect the uploaded files.', 'wpforms-lite' ),
				'class'   => 'wpforms-file-upload-password-restrictions',
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'password_restrictions',
				'content' => $password,
				'class'   => $this->is_restricted( $field ) ? '' : 'wpforms-hidden',
			]
		);
	}

	/**
	 * Add password label to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function add_password_label( array $field ): void {

		$password_label = $this->field_element(
			'label',
			$field,
			[
				'slug'    => 'protection_password_label',
				'value'   => esc_html__( 'Password', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Set a password to protect the uploaded files.', 'wpforms-lite' ),
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'protection_password_label',
				'content' => $password_label,
				'class'   => $this->is_protected( $field ) ? '' : 'wpforms-hidden',
			]
		);
	}

	/**
	 * Add password fields to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function add_password_fields( array $field ): void {

		$password_field_row         = $this->get_password_field( $field );
		$password_confirm_field_row = $this->get_password_confirm_field( $field );

		$password_columns = $this->field_element(
			'row',
			$field,
			[
				'content' => $password_field_row . $password_confirm_field_row,
				'class'   => [
					'wpforms-field-options-columns',
				],
			],
			false
		);

		$this->field_element(
			'row',
			$field,
			[
				'slug'    => 'protection_password_columns',
				'content' => $password_columns,
				'class'   => $this->is_protected( $field ) ? '' : 'wpforms-hidden',
			]
		);
	}

	/**
	 * Add password field to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function get_password_field( array $field ): string {

		$clean_button = $this->field_element(
			'button',
			$field,
			[
				'slug'  => 'password_restrictions_clean_button',
				'value' => '<i class="fa fa-times-circle fa-lg"></i>',
				'class' => [
					'wpforms-file-upload-password-clean',
					'wpforms-hidden',
				],
				'data'  => [
					'field-id' => $field['id'],
				],
				'attrs' => [
					'tabindex' => '-1',
				],
			],
			false
		);

		$password_field = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'protection_password',
				'value' => ! empty( $field['protection_password'] ) ? $field['protection_password'] : '',
				'after' => esc_html__( 'Enter Password', 'wpforms-lite' ),
				'type'  => 'password',
				'class' => 'wpforms-file-upload-password',
				'attrs' => [
					'autocomplete' => 'new-password',
				],
			],
			false
		);

		return $this->field_element(
			'row',
			$field,
			[
				'slug'    => 'protection_password',
				'content' => $password_field . $clean_button,
			],
			false
		);
	}

	/**
	 * Add password confirm field to the field.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 */
	private function get_password_confirm_field( array $field ): string {

		$password_confirm_field = $this->field_element(
			'text',
			$field,
			[
				'slug'  => 'protection_password_confirm',
				'value' => ! empty( $field['protection_password_confirm'] ) ? $field['protection_password_confirm'] : '',
				'after' => esc_html__( 'Confirm Password', 'wpforms-lite' ),
				'type'  => 'password',
				'class' => 'wpforms-file-upload-password-confirm',
			],
			false
		);

		$password_confirm_field_error = $this->field_element(
			'row',
			$field,
			[
				'slug'    => 'protection_password_confirm_error',
				'content' => esc_html__( 'Passwords do not match', 'wpforms-lite' ),
				'class'   => [
					'wpforms-hidden',
					'wpforms-error',
					'wpforms-error-message',
				],
			],
			false
		);

		return $this->field_element(
			'row',
			$field,
			[
				'slug'    => 'protection_password_confirm',
				'content' => $password_confirm_field . $password_confirm_field_error,
			],
			false
		);
	}

	/**
	 * Check if the field has access restrictions enabled.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return bool True if the field has access restrictions enabled, false otherwise.
	 */
	private function is_restricted( array $field ): bool {

		return ! empty( $field['is_restricted'] );
	}

	/**
	 * Check if the field has password protection enabled.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data and settings.
	 *
	 * @return bool True if the field has password protection enabled, false otherwise.
	 */
	private function is_protected( array $field ): bool {

		return ! empty( $field['is_protected'] );
	}

	/**
	 * Field preview panel inside the builder.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data.
	 */
	public function field_preview( $field ) {

		// Label.
		$this->field_preview_option(
			'label',
			$field,
			[
				'label_badge' => $this->get_field_preview_badge(),
			]
		);

		$modern_classes  = [ 'wpforms-file-upload-builder-modern' ];
		$classic_classes = [ 'wpforms-file-upload-builder-classic' ];

		if ( empty( $field['style'] ) || $field['style'] !== self::STYLE_CLASSIC ) {
			$classic_classes[] = 'wpforms-hide';
		} else {
			$modern_classes[] = 'wpforms-hide';
		}

		$strings         = $this->get_strings();
		$max_file_number = $this->get_max_file_number( $field );

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wpforms_render(
			'fields/file-upload/file-upload-backend',
			[
				'max_file_number' => $max_file_number,
				'preview_hint'    => str_replace( self::TEMPLATE_MAXFILENUM, $max_file_number, $strings['preview_hint'] ),
				'modern_classes'  => implode( ' ', $modern_classes ),
				'classic_classes' => implode( ' ', $classic_classes ),
			],
			true
		);

		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * File Upload specific strings.
	 *
	 * @since 1.9.4
	 *
	 * @return array Field specific strings.
	 */
	public function get_strings(): array {

		return [
			'preview_title_single'       => esc_html__( 'Click or drag a file to this area to upload.', 'wpforms-lite' ),
			'preview_title_plural'       => esc_html__( 'Click or drag files to this area to upload.', 'wpforms-lite' ),
			'preview_hint'               => sprintf( /* translators: % - max number of files as a template string (not a number), replaced by a number later. */
				esc_html__( 'You can upload up to %s files.', 'wpforms-lite' ),
				self::TEMPLATE_MAXFILENUM
			),
			'password_match_error_title' => esc_html__( 'Passwords Do Not Match', 'wpforms-lite' ),
			'password_match_error_text'  => esc_html__( 'Please check the password for the following fields: {fields}', 'wpforms-lite' ),
			'password_empty_error_title' => esc_html__( 'Passwords Are Empty', 'wpforms-lite' ),
			'password_empty_error_text'  => esc_html__( 'Please enter a password for the following fields: {fields}', 'wpforms-lite' ),
			'notification_warning_title' => esc_html__( 'Cannot Enable Restrictions', 'wpforms-lite' ),
			'notification_warning_text'  => esc_html__( 'This field is attached to Notifications. In order to enable restrictions, please first remove it from File Upload Attachments in Notifications.', 'wpforms-lite' ),
			'notification_error_title'   => esc_html__( 'Cannot Enable Attachments', 'wpforms-lite' ),
			'notification_error_text'    => esc_html__( 'The following fields ({fields}) cannot be attached to notifications because restrictions are enabled for them.', 'wpforms-lite' ),
			'all_user_roles_selected'    => esc_html__( 'All User Roles already selected', 'wpforms-lite' ),
			'incompatible_addon_text'    => esc_html__( 'File Upload Restrictions can’t be enabled because the current version of the Post Submissions addon is incompatible.', 'wpforms-lite' ),
		];
	}

	/**
	 * Getting max file number.
	 *
	 * @since 1.9.4
	 *
	 * @param array $field Field data.
	 *
	 * @return int
	 * @noinspection PhpMissingParamTypeInspection
	 */
	protected function get_max_file_number( $field ): int {

		if ( empty( $field['max_file_number'] ) ) {
			return 1;
		}

		$max_file_number = absint( $field['max_file_number'] );

		if ( $max_file_number < 1 ) {
			return 1;
		}

		if ( $max_file_number > self::MAX_FILE_NUM ) {
			return self::MAX_FILE_NUM;
		}

		return $max_file_number;
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
