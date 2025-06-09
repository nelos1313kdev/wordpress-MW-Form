<?php
/**
 * @package   Celexo
 */

require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-cta-section.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/customizer/cosmobit-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-footer-section.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-selective-partial.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/front/site-header.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/front/site-footer.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/front/site-header.php';

if ( ! function_exists( 'desert_companion_cosmobit_frontpage_sections' ) ) :
	function desert_companion_cosmobit_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/celexo/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/celexo/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/celexo/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/celexo/front/section-cta.php';
		require desert_companion_plugin_dir . 'inc/themes/celexo/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Cosmobit_frontpage', 'desert_companion_cosmobit_frontpage_sections' );
endif;