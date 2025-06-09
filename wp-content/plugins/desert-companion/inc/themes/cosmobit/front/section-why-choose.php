<?php  
$cosmobit_why_options_hide_show		= get_theme_mod('cosmobit_why_options_hide_show','1'); 
$cosmobit_hs_why_choose_left	= get_theme_mod('cosmobit_hs_why_choose_left','1'); 
$cosmobit_why_choose_left_ttl	= get_theme_mod('cosmobit_why_choose_left_ttl','Consultation'); 
$cosmobit_why_choose_left_subttl= get_theme_mod('cosmobit_why_choose_left_subttl','We Create Ideas To Grow Business and Developement'); 
$cosmobit_why_choose_left_text	= get_theme_mod('cosmobit_why_choose_left_text','There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.'); 
$cosmobit_why_left_f_icon		= get_theme_mod('cosmobit_why_left_f_icon','fa-user-secret');
$cosmobit_why_left_f_ttl		= get_theme_mod('cosmobit_why_left_f_ttl','Get Free Professional Advisor');
$cosmobit_why_left_f_text		= get_theme_mod('cosmobit_why_left_f_text','Ready To Help:<strong><a href="tel:2324567890"> +(232) 456-7890</a></strong>');
$cosmobit_hs_why_choose_right	= get_theme_mod('cosmobit_hs_why_choose_right','1');
$cosmobit_why_choose_right_ttl	= get_theme_mod('cosmobit_why_choose_right_ttl','Why Choose Us');
$cosmobit_why_choose_right_subttl= get_theme_mod('cosmobit_why_choose_right_subttl','We Are Committed To Take Care Of Clients Seriously');
$cosmobit_why_choose_right_text	 = get_theme_mod('cosmobit_why_choose_right_text','There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.');
$cosmobit_why_choose_right_f_text= get_theme_mod('cosmobit_why_choose_right_f_text','Get an Easy Quotation for Your Own Business.');
$cosmobit_why_choose_right_f_btn_lbl = get_theme_mod('cosmobit_why_choose_right_f_btn_lbl','Join Us');
$cosmobit_why_choose_right_f_btn_link= get_theme_mod('cosmobit_why_choose_right_f_btn_link','#');
$cosmobit_why_choose_right_f_img	 = get_theme_mod('cosmobit_why_choose_right_f_img',esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/what-we-do.jpg'));
if($cosmobit_why_options_hide_show=='1'):
?>	
<section id="why_choose_options" class="dt__about dt__about--why bg-gray-high dt-py-default front1--why">
	<div class="dt-container">
		<div class="dt-row dt-g-5 wow fadeInUp">
			<?php if($cosmobit_hs_why_choose_left=='1'): ?>
				<div class="dt-col-lg-<?php if($cosmobit_hs_why_choose_right =='1'): echo '6'; else: '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
					<div class="dt__about-content why-left">
						<div class="dt__siteheading">
							<?php if(!empty($cosmobit_why_choose_left_ttl)): ?>
								<div class="subtitle"><?php echo wp_kses_post($cosmobit_why_choose_left_ttl); ?></div>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose_left_subttl)): ?>
								<h2 class="title"><?php echo wp_kses_post($cosmobit_why_choose_left_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose_left_text)): ?>
								<div class="text">
									<?php echo wp_kses_post($cosmobit_why_choose_left_text); ?>
								</div>
							<?php endif; ?>
							<div class="dt__about-feature-classic">
								<div class="media">
									<?php if(!empty($cosmobit_why_left_f_icon)): ?>
										<div class="media-icon">
											<i class="fa <?php echo esc_attr($cosmobit_why_left_f_icon); ?>" aria-hidden="true"></i>
										</div>
									<?php endif; ?>
									<div class="media-body">
										<?php if(!empty($cosmobit_why_left_f_ttl)): ?>
											<h5 class="media-title"><?php echo wp_kses_post($cosmobit_why_left_f_ttl); ?></h5>
										<?php endif; ?>
										
										<?php if(!empty($cosmobit_why_left_f_text)): ?>
											<div class="media-content">
												<?php echo wp_kses_post($cosmobit_why_left_f_text); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if($cosmobit_hs_why_choose_right=='1'): ?>
				<div class="dt-col-lg-<?php if($cosmobit_hs_why_choose_left =='1'): echo '6'; else: '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
					<div class="dt__about-content why-right">
						<div class="dt__siteheading">
							<?php if(!empty($cosmobit_why_choose_right_ttl)): ?>
								<div class="subtitle"><?php echo wp_kses_post($cosmobit_why_choose_right_ttl); ?></div>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose_right_subttl)): ?>
								<h2 class="title head-ttl"><?php echo wp_kses_post($cosmobit_why_choose_right_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose_right_text)): ?>
								<div class="text">
									<?php echo wp_kses_post($cosmobit_why_choose_right_text); ?>
								</div>
							<?php endif; ?>	
							<div class="dt__about-cta" style="background-image: url('<?php echo esc_url($cosmobit_why_choose_right_f_img); ?>');">
								<div class="dt-row">
									<div class="dt-col-md-9 dt-col-12 dt-text-md-left dt-text-center dt-my-md-auto">
										<?php if(!empty($cosmobit_why_choose_right_f_text)): ?>
											<h5 class="title"><?php echo wp_kses_post($cosmobit_why_choose_right_f_text); ?></h5>
										<?php endif; ?>
									</div>
									<div class="dt-col-md-3 dt-col-12 dt-text-md-right dt-text-center dt-my-md-auto dt-mt-md-auto dt-mt-4">
										<?php if(!empty($cosmobit_why_choose_right_f_btn_lbl)): ?>
											<a href="<?php echo esc_url($cosmobit_why_choose_right_f_btn_link); ?>" class="dt-btn dt-btn-primary"><?php echo wp_kses_post($cosmobit_why_choose_right_f_btn_lbl); ?></a>
										<?php endif; ?>	
									</div>
								</div>                                            
							</div>
						</div>
					</div>
				</div>        
			<?php endif; ?>            
		</div>
	</div>
</section>
<?php endif; ?>