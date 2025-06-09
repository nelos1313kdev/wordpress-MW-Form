<?php
/**
 * Theme functions and definitions
 *
 * @package Avanta
 */

/**
 * After setup theme hook
 */
function avanta_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'avanta' );	
}
add_action( 'after_setup_theme', 'avanta_theme_setup' );

/**
 * Load assets.
 */

function avanta_theme_css() {
	wp_enqueue_style( 'avanta-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'avanta_theme_css', 99);

require get_stylesheet_directory() . '/theme-functions/controls/class-customize.php';

/**
 * Import Options From Parent Theme
 *
 */
function avanta_parent_theme_options() {
	$corpiva_mods = get_option( 'theme_mods_corpiva' );
	if ( ! empty( $corpiva_mods ) ) {
		foreach ( $corpiva_mods as $corpiva_mod_k => $corpiva_mod_v ) {
			set_theme_mod( $corpiva_mod_k, $corpiva_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'avanta_parent_theme_options' );

/**
 * Sample implementation of the Custom Header feature
 */
function avanta_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'avanta_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'corpiva_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'avanta_custom_header_setup' );