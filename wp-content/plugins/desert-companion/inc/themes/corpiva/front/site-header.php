<?php
/*=========================================
Corpiva Site Header
=========================================*/
if ( ! function_exists( 'corpiva_site_header' ) ) :
function corpiva_site_header() {
$corpiva_hs_hdr 	= get_theme_mod( 'corpiva_hs_hdr','1');
if($corpiva_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-5 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('corpiva_header_address'); ?>
						<?php  do_action('corpiva_header_email'); ?>
					</div>
				</div>
				<div class="dt-col-lg-7 dt-col-12">
					<div class="widget--right dt-text-lg-right">
						<?php  do_action('corpiva_header_time'); ?>
						<?php  do_action('corpiva_site_social'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'corpiva_site_header', 'corpiva_site_header' );