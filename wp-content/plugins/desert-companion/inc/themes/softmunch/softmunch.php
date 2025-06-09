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


/*=========================================
SoftMunch Site Header
=========================================*/
if ( ! function_exists( 'softmunch_site_header' ) ) :
function softmunch_site_header() {
$softme_hs_hdr 	= get_theme_mod( 'softme_hs_hdr','1');
if($softme_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-2 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('softme_site_social'); ?>
					</div>
				</div>
				<div class="dt-col-lg-10 dt-col-12">
					<div class="widget--right dt-text-lg-right">   
						<?php  do_action('softme_header_left_text'); ?>					
						<?php  do_action('softme_header_email'); ?>
						<?php  do_action('softme_header_address'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'softmunch_site_header', 'softmunch_site_header' );