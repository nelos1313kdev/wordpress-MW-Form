<?php
namespace WprAddons\Classes\Modules\Forms;

use Elementor\Utils;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Actions_Status setup
 *
 * @since 3.4.6
 */

 class WPR_Actions_Status {

    public function __construct() {
        add_action('wp_ajax_wpr_update_form_action_meta', [$this, 'wpr_update_form_action_meta']);
        add_action('wp_ajax_nopriv_wpr_update_form_action_meta', [$this, 'wpr_update_form_action_meta']);
    }
    
    // In your PHP file
    public function wpr_update_form_action_meta() {
        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'wpr-addons-js' ) ) {
          return; // Get out of here, the nonce is rotten!
        }

        // Validate custom token
        // $custom_token = $_POST['custom_token'];
        
        // if ( is_user_logged_in() ) {
        //     // For logged-in users, validate against their user ID
        //     $user_id = get_current_user_id();
        //     $stored_token = get_transient( 'wpr_custom_token_' . $user_id );
        // } else {
        //     // For non-logged-in users, use the guest token from the cookie
        //     if ( isset( $_COOKIE['wpr_guest_token'] ) ) {
        //         $guest_id = sanitize_text_field( $_COOKIE['wpr_guest_token'] );
        //         $stored_token = get_transient( 'wpr_custom_guest_token_' . $guest_id );
        //     } else {
        //         wp_send_json_error( 'Invalid token.' );
        //         return;
        //     }
        // }
    
        // if ( ! $stored_token || $custom_token !== $stored_token ) {
        //     wp_send_json_error( 'Invalid token.' );
        //     return;
        // }

        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $action_name = isset($_POST['action_name']) ? sanitize_text_field($_POST['action_name']) : '';
        $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';
        $message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';

        $meta_value = [
            'status' => $status,
            'message' => $message
        ];

        $actions_whitelist = [
            'wpr_form_builder_email',
            'wpr_form_builder_submissions',
            'wpr_form_builder_mailchimp',
            'wpr_form_builder_webhook'
        ];

        if ($post_id && $action_name && $status && in_array($action_name, $actions_whitelist)) {
            update_post_meta($post_id, '_action_' . $action_name, $meta_value);
            wp_send_json_success('Post meta updated successfully');
        } else {
            wp_send_json_error('Invalid data provided');
        }
    }
 }

 new WPR_Actions_Status();