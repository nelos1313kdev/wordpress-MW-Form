<?php
/**
 * @package   Chitvi
 */

require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/flexora/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/flexora/customizer/cosmobit-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/flexora/customizer/cosmobit-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-cta-2-section.php';
require desert_companion_plugin_dir . 'inc/themes/flexora/customizer/cosmobit-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/flexora/customizer/cosmobit-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-footer-section.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/customizer/cosmobit-selective-partial.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/front/site-header.php';
require desert_companion_plugin_dir . 'inc/themes/cosmobit/front/site-footer.php';
require desert_companion_plugin_dir . 'inc/themes/celexo/front/site-header.php';

if ( ! function_exists( 'desert_companion_cosmobit_frontpage_sections' ) ) :
	function desert_companion_cosmobit_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/flexora/front/section-slider.php';
	    require desert_companion_plugin_dir . 'inc/themes/flexora/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/flexora/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/cosmobit/front/section-cta-2.php';
		require desert_companion_plugin_dir . 'inc/themes/flexora/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Cosmobit_frontpage', 'desert_companion_cosmobit_frontpage_sections' );
endif;