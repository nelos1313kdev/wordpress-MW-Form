<?php
/**
 *
 * @link       https://themeansar.com/
 * @since      1.0.0
 *
 * @package    Ansar_Import
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('DESERT_IMPORT_VERSION', '1.0');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-desert-import.php';
require plugin_dir_path(__FILE__) . 'includes/parsers.php';

if (!class_exists('WP_Importer')) {
    $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
    if (file_exists($class_wp_importer)) {
        require_once( $class_wp_importer );
    } else {
        $importer_error = true;
    }
}
require plugin_dir_path(__FILE__) . 'includes/class-wp-import.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_desert_import() {

    $plugin = new Desert_Import();
    $plugin->run();
}

run_desert_import();