<?php
/**
 * @package   Atua
 */

require desert_companion_plugin_dir . 'inc/themes/atua/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/atua/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-about-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-features-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/atua/customizer/atua-selective-partial.php';
require desert_companion_plugin_dir . 'inc/themes/flexeo/front/site-header.php';

if ( ! function_exists( 'desert_companion_atua_frontpage_sections' ) ) :
	function desert_companion_atua_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/flexeo/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/flexeo/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/atua/front/section-about.php';
		require desert_companion_plugin_dir . 'inc/themes/flexeo/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/atua/front/section-features.php';
		require desert_companion_plugin_dir . 'inc/themes/atua/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Atua_frontpage', 'desert_companion_atua_frontpage_sections' );
endif;