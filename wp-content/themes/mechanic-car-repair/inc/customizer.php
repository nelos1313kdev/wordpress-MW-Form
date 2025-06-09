<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage mechanic-car-repair
 * @since mechanic-car-repair 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mechanic_car_repair_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
    // Add the "Go to Premium" upsell section
	$wp_customize->add_section( new Mechanic_Car_Repair_Upsell_Section( $wp_customize, 'upsell_premium_section', array(
		'title'       => __( 'Mechanic Car Repair', 'mechanic-car-repair' ),
		'button_text' => __( 'GO TO PREMIUM', 'mechanic-car-repair' ),
		'url'         => esc_url( MECHANIC_CAR_REPAIR_BUY_NOW ),
		'priority'    => 0,
	)));

	// Add the "Bundle" upsell section
	$wp_customize->add_section( new Mechanic_Car_Repair_Upsell_Section( $wp_customize, 'upsell_bundle_section', array(
		'title'       => __( 'All themes in Single Package', 'mechanic-car-repair' ),
		'button_text' => __( 'GET BUNDLE', 'mechanic-car-repair' ),
		'url'         => esc_url( MECHANIC_CAR_REPAIR_BUNDLE ),
		'priority'    => 1,
	)));
}
add_action( 'customize_register', 'mechanic_car_repair_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class Mechanic_Car_Repair_Upsell_Section extends WP_Customize_Section {
		public $type = 'mechanic-car-repair-upsell';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="mechanic_car_repair_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title premium-details">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function mechanic_car_repair_custom_control_scripts() {
	wp_enqueue_script( 'mechanic-car-repair-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'mechanic-car-repair-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'mechanic_car_repair_custom_control_scripts' );
