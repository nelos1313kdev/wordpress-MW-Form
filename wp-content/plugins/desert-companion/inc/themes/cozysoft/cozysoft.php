<?php
/**
 * @package   CozySoft
 */

require desert_companion_plugin_dir . 'inc/themes/softme/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/softme/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-header-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-about-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-features-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/softme/customizer/softme-selective-partial.php';



/*=========================================
SoftMe Site Header
=========================================*/
if ( ! function_exists( 'cozysoft_site_header' ) ) :
function cozysoft_site_header() {
$softme_hs_hdr 	= get_theme_mod( 'softme_hs_hdr','1');
if($softme_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-5 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<ul class="dt_navbar-list-right">
							<?php do_action('softme_header_contact'); ?>
							<?php do_action('softme_header_contact2'); ?>
						</ul>
					</div>
				</div>
				<div class="dt-col-lg-7 dt-col-12">
					<div class="widget--right dt-text-lg-right"> 
						<ul class="dt_navbar-list-right">
							<?php do_action('softme_header_contact3'); ?>
							<?php do_action('softme_site_social'); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'cozysoft_site_header', 'cozysoft_site_header' );

if ( ! function_exists( 'desert_companion_softme_frontpage_sections' ) ) :
	function desert_companion_softme_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/cozysoft/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-about.php';
		require desert_companion_plugin_dir . 'inc/themes/cozysoft/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-features.php';
		require desert_companion_plugin_dir . 'inc/themes/softme/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Softme_frontpage', 'desert_companion_softme_frontpage_sections' );
endif;