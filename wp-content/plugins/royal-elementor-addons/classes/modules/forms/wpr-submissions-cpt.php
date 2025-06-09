<?php
namespace WprAddons\Classes\Modules\Forms;

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Form_Builder_Submissions setup
 *
 * @since 3.4.6
 */

 class WPR_Form_Builder_Submissions {

    public function __construct() {
        add_action('wp_ajax_wpr_form_builder_submissions' , [$this, 'add_to_submissions']);
        add_action('wp_ajax_nopriv_wpr_form_builder_submissions',[$this, 'add_to_submissions']);
        add_action('save_post', [$this, 'update_submissions_post_meta']);
    }

    public function add_to_submissions() {

        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'wpr-addons-js' ) ) {
            return; // Get out of here, the nonce is rotten!
        }

        $new = [
            'post_status' => 'publish',
            'post_type' => 'wpr_submissions'
        ];
        
        $post_id = wp_insert_post( $new );
        foreach ($_POST['form_content'] as $key => $value ) {
            update_post_meta($post_id, $key, [$value[0], $value[1], $value[2]]);
        }

        $sanitized_form_name = sanitize_text_field($_POST['form_name']);
        $sanitized_form_id = sanitize_text_field($_POST['form_id']);
        $sanitized_form_page = sanitize_text_field($_POST['form_page']);
        $sanitized_form_page_id = sanitize_text_field($_POST['form_page_id']);
    
        update_post_meta($post_id, 'wpr_form_name', $sanitized_form_name);
        update_post_meta($post_id, 'wpr_form_id', $sanitized_form_id);
        update_post_meta($post_id, 'wpr_form_page', $sanitized_form_page);
        update_post_meta($post_id, 'wpr_form_page_id', $sanitized_form_page_id);
        update_post_meta($post_id, 'wpr_user_agent', sanitize_textarea_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ));
        update_post_meta($post_id, 'wpr_user_ip', Utilities::get_client_ip());
        
        if( $post_id ) {
            wp_send_json_success(array(
                'action' => 'wpr_form_builder_submissions',
                'post_id' => $post_id,
                'message' => esc_html__('Submission created successfully', 'wpr-addons'),
				'status' => 'success',
                'content' => $_POST['form_content']
            ));
        } else {
            wp_send_json_success(array(
                'action' => 'wpr_form_builder_submissions',
                'post_id' => $post_id,
                'message' => esc_html__('Submit action failed', 'wpr-addons'),
				'status' => 'error'
            ));
        }
    }
    
    public function update_submissions_post_meta($post_id) {
        // Only allow users with edit permissions
        if ( ! current_user_can('edit_post', $post_id) ) {
            return;
        }
    
        if ( isset($_POST['wpr_submission_changes']) && ! empty($_POST['wpr_submission_changes']) ) {
            $changes = json_decode(stripslashes($_POST['wpr_submission_changes']), true);
    
            if ( ! is_array($changes) ) {
                return;
            }
    
            // List of disallowed meta keys
            $disallowed_keys = [
                '_elementor_data',
                '_elementor_controls_usage',
                '_wp_attached_file',
                // Add more if needed
            ];
    
            foreach ( $changes as $key => $value ) {
                // Skip blacklisted keys
                if ( in_array($key, $disallowed_keys, true) ) {
                    continue;
                }
    
                // Sanitize key and value
                $safe_key = sanitize_key($key);
    
                if ( is_string($value) ) {
                    $safe_value = sanitize_text_field($value);
                } elseif ( is_array($value) ) {
                    $safe_value = array_map('sanitize_text_field', $value);
                } else {
                    $safe_value = sanitize_text_field((string) $value);
                }
    
                update_post_meta($post_id, $safe_key, $safe_value);
            }
        }
    }    
 }

 new WPR_Form_Builder_Submissions();