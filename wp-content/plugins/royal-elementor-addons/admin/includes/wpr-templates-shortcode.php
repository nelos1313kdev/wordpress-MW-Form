<?php

namespace WprAddons\Admin\Includes;

use Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Templates_Shortcode setup
 *
 * @since 1.0
 */
class WPR_Templates_Shortcode {

	public function __construct() {
		add_shortcode( 'wpr-template', [ $this, 'shortcode' ] );

		add_action('elementor/element/after_section_start', [ $this, 'extend_shortcode' ], 10, 3 );
	}

	public function shortcode( $attributes = [] ) {
		if ( empty( $attributes['id'] ) ) {
			return '';
		} else {
			$id = intval($attributes['id']);
		}

		// Ensure only publicly published posts can be accessed
		$post = get_post($id);

		if (!$post || $post->post_status !== 'publish' || in_array($post->post_status, ['draft', 'private', 'future'])) {
			return 'You do not have permission to view this post.';
		}
	
		// Optionally check if the post is password protected
		if (post_password_required($post)) {
			return 'This post is password protected.';
		}
	
		// WPML language handling
		if (defined('ICL_LANGUAGE_CODE')) {
			$default_language_code = apply_filters('wpml_default_language', null);

			if ( ICL_LANGUAGE_CODE !== $default_language_code ) {
				$id = icl_object_id($id, 'elementor_library', false, ICL_LANGUAGE_CODE);
			}
		}

		$edit_link = '<span class="wpr-template-edit-btn" data-permalink="'. esc_url(get_permalink($id)) .'">Edit Template</span>';
		
		$type = get_post_meta(get_the_ID(), '_wpr_template_type', true) || get_post_meta($id, '_elementor_template_type', true);
		$has_css = 'internal' === get_option( 'elementor_css_print_method' ) || '' !== $type;

		return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id, $has_css ) . $edit_link;
	}

	public function extend_shortcode( $section, $section_id, $args ) {
		if ( $section->get_name() == 'shortcode' && $section_id == 'section_shortcode' ) {
			$section->add_control(
				'select_template' ,
				[
					'label' => esc_html__( 'Select Template', 'wpr-addons' ),
					'type' => 'wpr-ajax-select2',
					'options' => 'ajaxselect2/get_elementor_templates',
					'label_block' => true,
				]
			);
		}
	}

}