<?php
namespace WprAddons\Classes\Modules;

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Custom_Meta_Keys setup
 *
 * @since 3.4.6
 */

 class WPR_Custom_Meta_Keys {

    public function __construct() {
        add_action('wp_ajax_wpr_get_custom_meta_keys' , [$this, 'get_custom_meta_keys']);
        add_action('wp_ajax_nopriv_wpr_get_custom_meta_keys',[$this, 'get_custom_meta_keys']);
    }

    public function get_custom_meta_keys() {

        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'wpr-addons-editor-js' ) ) {
            return; // Get out of here, the nonce is rotten!
        }

        $keys = Utilities::get_custom_meta_keys();

        if ( empty( $keys ) ) {
            wp_send_json_error( 'No keys found' );
        } else {
            wp_send_json_success( wp_json_encode($keys[0]) );
        }
    }
 }

 new WPR_Custom_Meta_Keys();