<?php
/**
 * Corpiva Customizer Class
 *
 * @package Corpiva
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'Corpiva_Customizer' ) ) :

	class Corpiva_Customizer {

		// Constructor customizer
		public function __construct() {
			add_action( 'customize_register',array( $this, 'corpiva_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'corpiva_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'corpiva_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'corpiva_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'corpiva_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'corpiva_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function corpiva_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function corpiva_customizer_control( $wp_customize ) {
			
			$corpiva_control_dir =  CORPIVA_THEME_INC_DIR . '/customizer/controls';
			
			// Load custom control classes.
			$wp_customize->register_control_type( 'Corpiva_Customizer_Range_Control' );
			require $corpiva_control_dir . '/code/corpiva-slider-control.php';
			require $corpiva_control_dir . '/code/corpiva-icon-picker-control.php';
			require $corpiva_control_dir . '/code/corpiva-category-dropdown-control.php';

		}
		
		
		// selective refresh.
		public function corpiva_customizer_sainitization_selective_refresh() {

			require CORPIVA_THEME_INC_DIR . '/customizer/sanitization.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function corpiva_customize_preview_js() {
			wp_enqueue_script( 'corpiva-customizer', CORPIVA_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), CORPIVA_THEME_VERSION, true );
		}
		
		public function corpiva_customizer_navigation_script() {
			 wp_enqueue_script( 'corpiva-customizer-section', CORPIVA_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}
		

		// Include customizer settings.
			
		public function corpiva_customizer_settings() {
			// Recommended Plugin
			require CORPIVA_THEME_INC_DIR . '/customizer/customizer-plugin-notice/corpiva-notify-plugin.php';
			
			// Upsale
			require CORPIVA_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			
			$corpiva_customize_dir =  CORPIVA_THEME_INC_DIR . '/customizer/customizer-settings';
			require $corpiva_customize_dir . '/corpiva-header-customize-setting.php';
			require $corpiva_customize_dir . '/corpiva-footer-customize-setting.php';
			require $corpiva_customize_dir . '/corpiva-theme-customize-setting.php';
			require $corpiva_customize_dir . '/corpiva-typography-customize-setting.php';
			require CORPIVA_THEME_INC_DIR . '/customizer/corpiva-selective-partial.php';
			require CORPIVA_THEME_INC_DIR . '/customizer/corpiva-selective-refresh.php';
		}

	}
endif;
new Corpiva_Customizer();