<?php
/**
 * @package   SoftMe
 */

require desert_companion_plugin_dir . 'inc/themes/softme/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/softme/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/suntech/customizer/softme-protect-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-features-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-selective-partial.php';


if ( ! function_exists( 'desert_companion_softme_frontpage_sections' ) ) :
	function desert_companion_softme_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/suntech/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/suntech/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/suntech/front/section-protect.php';
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-features.php';
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Softme_frontpage', 'desert_companion_softme_frontpage_sections' );
endif;