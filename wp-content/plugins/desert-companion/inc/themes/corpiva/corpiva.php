<?php
/**
 * @package   Corpiva
 */

require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-overview-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-features-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/customizer/corpiva-selective-partial.php';
require desert_companion_plugin_dir . 'inc/themes/corpiva/front/site-header.php';

if ( ! function_exists( 'desert_companion_corpiva_frontpage_sections' ) ) :
	function desert_companion_corpiva_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-overview.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-features.php';
		require desert_companion_plugin_dir . 'inc/themes/corpiva/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Corpiva_frontpage', 'desert_companion_corpiva_frontpage_sections' );
endif;