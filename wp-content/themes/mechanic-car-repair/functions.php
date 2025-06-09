<?php
/**
 * Mechanic Car Repair functions
 */

//Admin css
add_editor_style( array( 'assets/css/admin.css' ) );

if ( ! function_exists( 'mechanic_car_repair_setup' ) ) :
function mechanic_car_repair_setup() {

    load_theme_textdomain( 'mechanic-car-repair', get_template_directory() . '/languages' );

	// Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'mechanic_car_repair_custom_background_args', array(
	    'default-color' => 'ffffff',
	    'default-image' => '',
    ) ) );

	/**
	 * About Theme Function
	 */
	require get_theme_file_path( '/about-theme/about-theme.php' );

	/**
	 * Customizer
	 */
	require get_template_directory() . '/inc/customizer.php';
}
endif; 
add_action( 'after_setup_theme', 'mechanic_car_repair_setup' );

if ( ! function_exists( 'mechanic_car_repair_styles' ) ) :
	function mechanic_car_repair_styles() {
		// Register theme stylesheet.
		wp_register_style('mechanic-car-repair-style',
			get_template_directory_uri() . '/style.css',array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'mechanic-car-repair-style' );

		wp_style_add_data( 'mechanic-car-repair-style', 'rtl', 'replace' );

		wp_enqueue_script( 'mechanic-car-repair-custom-script', get_theme_file_uri( '/assets/js/custom-script.js' ), array( 'jquery' ), true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'mechanic_car_repair_styles' );