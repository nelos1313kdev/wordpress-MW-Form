<?php 
/*=========================================
Cosmobit Site Header
=========================================*/
if ( ! function_exists( 'cosmobit_site_header' ) ) :
function cosmobit_site_header() {
$cosmobit_hs_hdr 	= get_theme_mod( 'cosmobit_hs_hdr','1');
// Contact 
$cosmobit_hs_hdr_contact 	= get_theme_mod( 'cosmobit_hs_hdr_contact','1'); 
$cosmobit_hdr_contact_icon 	= get_theme_mod( 'cosmobit_hdr_contact_icon','fa-map-marker');
$cosmobit_hdr_contact_title = get_theme_mod( 'cosmobit_hdr_contact_title','California, TX 70240');
$cosmobit_hdr_contact_link 	= get_theme_mod( 'cosmobit_hdr_contact_link');

// Email 
$cosmobit_hs_hdr_email 		= get_theme_mod( 'cosmobit_hs_hdr_email','1'); 
$cosmobit_hdr_email_icon 	= get_theme_mod( 'cosmobit_hdr_email_icon','fa-envelope');
$cosmobit_hdr_email_title 	= get_theme_mod( 'cosmobit_hdr_email_title','info@gmail.com');
$cosmobit_hdr_email_link 	= get_theme_mod( 'cosmobit_hdr_email_link','mailto:info@gmail.com');

// Mobile 
$cosmobit_hs_hdr_top_mbl 	= get_theme_mod( 'cosmobit_hs_hdr_top_mbl','1'); 
$cosmobit_hdr_top_mbl_icon 	= get_theme_mod( 'cosmobit_hdr_top_mbl_icon','fa-headphones');
$cosmobit_hdr_top_mbl_title = get_theme_mod( 'cosmobit_hdr_top_mbl_title','+123-456-7890');
$cosmobit_hdr_top_mbl_link 	= get_theme_mod( 'cosmobit_hdr_top_mbl_link','tel:+123-456-7890');

// Timing 
$cosmobit_hs_hdr_top_time 	 = get_theme_mod( 'cosmobit_hs_hdr_top_time','1'); 
$cosmobit_hdr_top_time_icon  = get_theme_mod( 'cosmobit_hdr_top_time_icon','fa-clock-o');
$cosmobit_hdr_top_time_title = get_theme_mod( 'cosmobit_hdr_top_time_title','Office Hours: 8:00 AM – 7:45 PM');
$cosmobit_hdr_top_time_link  = get_theme_mod( 'cosmobit_hdr_top_time_link');

// Social 
$cosmobit_hs_hdr_social 	= get_theme_mod( 'cosmobit_hs_hdr_social','1'); 
$cosmobit_hdr_social 		= get_theme_mod( 'cosmobit_hdr_social',cosmobit_get_social_icon_default());
	if($cosmobit_hs_hdr == '1') { 
	?>
	 <div class="dt__header-widget">
			<div class="dt-container">
				<div class="dt-row">
					<div class="dt-col-lg-6 dt-col-12">
						<div class="widget--left dt-text-lg-left">
							
							<?php if($cosmobit_hs_hdr_email=='1'): ?>
								<aside class="widget widget_contact contact2">
									<div class="contact__list">
										<?php if(!empty($cosmobit_hdr_email_icon)): ?>
											<i class="fa <?php echo esc_attr($cosmobit_hdr_email_icon); ?>" aria-hidden="true"></i>
										<?php endif;?>	
										<?php if(!empty($cosmobit_hdr_email_title)): ?>
											<div class="contact__body">
												<h6 class="title"><a href="<?php echo esc_url($cosmobit_hdr_email_link); ?>"><?php echo wp_kses_post($cosmobit_hdr_email_title); ?></a></h6>
											</div>
										<?php endif;?>
									</div>
								</aside>
							<?php endif; ?>
							
							<?php if($cosmobit_hs_hdr_top_mbl=='1'): ?>
								<aside class="widget widget_contact contact3">
									<div class="contact__list">
										<?php if(!empty($cosmobit_hdr_top_mbl_icon)): ?>
											<i class="fa <?php echo esc_attr($cosmobit_hdr_top_mbl_icon); ?>" aria-hidden="true"></i>
										<?php endif;?>	
										<?php if(!empty($cosmobit_hdr_top_mbl_title)): ?>
											<div class="contact__body">
												<h6 class="title"><a href="<?php echo esc_url($cosmobit_hdr_top_mbl_link); ?>"><?php echo wp_kses_post($cosmobit_hdr_top_mbl_title); ?></a></h6>
											</div>
										<?php endif;?>
									</div>
								</aside>
							<?php endif; ?>	
						</div>
					</div>
					<div class="dt-col-lg-6 dt-col-12">
						<div class="widget--right dt-text-lg-right">
							<?php if($cosmobit_hs_hdr_social=='1'): ?>
								<aside class="widget widget_social">
									<ul>
										<?php
											$cosmobit_hdr_social = json_decode($cosmobit_hdr_social);
											if( $cosmobit_hdr_social!='' )
											{
											foreach($cosmobit_hdr_social as $item){	
											$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Header section' ) : '';	
											$social_link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Header section' ) : '';
										?>
											<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
										<?php }} ?>
									</ul>
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
add_action( 'cosmobit_site_header', 'cosmobit_site_header' );
?>