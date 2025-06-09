<?php
/*=========================================
Atua Site Header
=========================================*/
if ( ! function_exists( 'atua_site_header' ) ) :
function atua_site_header() {
$atua_hs_hdr 	= get_theme_mod( 'atua_hs_hdr','1');
// Email 
$atua_hs_hdr_email 		= get_theme_mod( 'atua_hs_hdr_email','1'); 
$atua_hdr_email_icon 	= get_theme_mod( 'atua_hdr_email_icon','fas fa-envelope');
$atua_hdr_email_title 	= get_theme_mod( 'atua_hdr_email_title','Email:');
$atua_hdr_email_subtitle= get_theme_mod( 'atua_hdr_email_subtitle','info@gmail.com');
$atua_hdr_email_link 	= get_theme_mod( 'atua_hdr_email_link','mailto:info@gmail.com');

// Mobile 
$atua_hs_hdr_top_mbl 	= get_theme_mod( 'atua_hs_hdr_top_mbl','1'); 
$atua_hdr_top_mbl_icon 	= get_theme_mod( 'atua_hdr_top_mbl_icon','fas fa-headphones');
$atua_hdr_top_mbl_title = get_theme_mod( 'atua_hdr_top_mbl_title','Call:');
$atua_hdr_top_mbl_subtitle = get_theme_mod( 'atua_hdr_top_mbl_subtitle','+123-456-7890');
$atua_hdr_top_mbl_link 	= get_theme_mod( 'atua_hdr_top_mbl_link','tel:+123-456-7890');
if($atua_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--left dt-text-lg-left">	
						<?php  do_action('atua_site_social'); ?>							
					</div>
				</div>
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--right dt-text-lg-right"> 
						<?php if($atua_hs_hdr_email=='1'): ?>
							<aside class="widget widget_contact contact2">
								<div class="contact__list">
									<?php if(!empty($atua_hdr_email_icon)): ?>
										<i class="<?php echo esc_attr($atua_hdr_email_icon); ?>" aria-hidden="true"></i>
									<?php endif; ?>	
									<div class="contact__body">
										<h6 class="title"><span class="ttl"><?php echo wp_kses_post($atua_hdr_email_title); ?></span> <a href="<?php echo esc_url($atua_hdr_email_link); ?>"><?php echo wp_kses_post($atua_hdr_email_subtitle); ?></a></h6>
									</div>
								</div>
							</aside>  
						<?php endif; ?>					
						<?php if($atua_hs_hdr_top_mbl=='1'): ?>		
							<aside class="widget widget_contact contact3">
								<div class="contact__list">
									<?php if(!empty($atua_hdr_top_mbl_icon)): ?>
										<i class="<?php echo esc_attr($atua_hdr_top_mbl_icon); ?>" aria-hidden="true"></i>
									<?php endif; ?>	
									
									<div class="contact__body">
										<h6 class="title"><span class="ttl"><?php echo wp_kses_post($atua_hdr_top_mbl_title); ?></span> <a href="<?php echo esc_url($atua_hdr_top_mbl_link); ?>"><?php echo wp_kses_post($atua_hdr_top_mbl_subtitle); ?></a></h6>
									</div>
								</div>
							</aside>
						<?php endif; ?>		
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'atua_site_header', 'atua_site_header' );