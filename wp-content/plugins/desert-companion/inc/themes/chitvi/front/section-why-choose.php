<?php  
$cosmobit_why_options_hide_show		= get_theme_mod('cosmobit_why_options_hide_show','1');
$cosmobit_hs_why_choose4_left	= get_theme_mod('cosmobit_hs_why_choose4_left','1'); 
$cosmobit_why_choose4_left_ttl	= get_theme_mod('cosmobit_why_choose4_left_ttl','Consultation'); 
$cosmobit_why_choose4_left_subttl= get_theme_mod('cosmobit_why_choose4_left_subttl','We Create Ideas To Grow Business & Developement'); 
$cosmobit_why_choose4_left_text	= get_theme_mod('cosmobit_why_choose4_left_text','There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.'); 
$cosmobit_why4_left_f_icon		= get_theme_mod('cosmobit_why4_left_f_icon','fa-user-secret');
$cosmobit_why4_left_f_ttl		= get_theme_mod('cosmobit_why4_left_f_ttl','Get Free Professional Advisor');
$cosmobit_why4_left_f_text		= get_theme_mod('cosmobit_why4_left_f_text','Ready To Help:<strong><a href="tel:2324567890"> +(232) 456-7890</a></strong>');
$cosmobit_hs_why_choose4_right	= get_theme_mod('cosmobit_hs_why_choose4_right','1');
$cosmobit_why_choose4_right_ttl	= get_theme_mod('cosmobit_why_choose4_right_ttl','Why Choose Us');
$cosmobit_why_choose4_right_subttl= get_theme_mod('cosmobit_why_choose4_right_subttl','We Are Committed To Take Care Of Clients Seriously');
$cosmobit_why_choose4_right_text	 = get_theme_mod('cosmobit_why_choose4_right_text','There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.');
$cosmobit_hs_why_choose4_funfact= get_theme_mod('cosmobit_hs_why_choose4_funfact','1');
$cosmobit_why_choose4_funfact = get_theme_mod('cosmobit_why_choose4_funfact',cosmobit_why_choose4_funfact_default());
if($cosmobit_why_options_hide_show=='1'):
?>	
<section id="why_choose4_options" class="dt__about dt__about--why-two dt-py-default front4--why">
	<div class="dt-container">
		<div class="dt-row dt-g-5 wow fadeInUp">
			<?php if($cosmobit_hs_why_choose4_left=='1'): ?>
				<div class="dt-col-lg-<?php if($cosmobit_hs_why_choose4_right =='1'): echo '6'; else: '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
					<div class="dt__about-content why-left">
						<div class="dt__siteheading">
							<?php if(!empty($cosmobit_why_choose4_left_ttl)): ?>
								<div class="subtitle"><?php echo wp_kses_post($cosmobit_why_choose4_left_ttl); ?></div>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose4_left_subttl)): ?>
								<h2 class="title"><?php echo wp_kses_post($cosmobit_why_choose4_left_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose4_left_text)): ?>
								<div class="text">
									<?php echo wp_kses_post($cosmobit_why_choose4_left_text); ?>
								</div>
							<?php endif; ?>
							<div class="dt__about-feature-classic">
								<div class="media">
									<?php if(!empty($cosmobit_why4_left_f_icon)): ?>
										<div class="media-icon">
											<i class="fa <?php echo esc_attr($cosmobit_why4_left_f_icon); ?>" aria-hidden="true"></i>
										</div>
									<?php endif; ?>
									<div class="media-body">
										<?php if(!empty($cosmobit_why4_left_f_ttl)): ?>
											<h5 class="media-title"><?php echo wp_kses_post($cosmobit_why4_left_f_ttl); ?></h5>
										<?php endif; ?>
										
										<?php if(!empty($cosmobit_why4_left_f_text)): ?>
											<div class="media-content">
												<?php echo wp_kses_post($cosmobit_why4_left_f_text); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if($cosmobit_hs_why_choose4_right=='1'): ?>
				<div class="dt-col-lg-<?php if($cosmobit_hs_why_choose4_left =='1'): echo '6'; else: '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
					<div class="dt__about-content why-right">
						<div class="dt__siteheading">
							<?php if(!empty($cosmobit_why_choose4_right_ttl)): ?>
								<div class="subtitle"><?php echo wp_kses_post($cosmobit_why_choose4_right_ttl); ?></div>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose4_right_subttl)): ?>
								<h2 class="title head-ttl"><?php echo wp_kses_post($cosmobit_why_choose4_right_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_why_choose4_right_text)): ?>
								<div class="text">
									<?php echo wp_kses_post($cosmobit_why_choose4_right_text); ?>
								</div>
							<?php endif; ?>	
							<?php if($cosmobit_hs_why_choose4_funfact=='1'): ?>
								<div class="dt__about-funfact dt-mt-5">
                                    <div class="dt-row">
										<?php
											if ( ! empty( $cosmobit_why_choose4_funfact ) ) {
											$cosmobit_why_choose4_funfact = json_decode( $cosmobit_why_choose4_funfact );
											foreach ( $cosmobit_why_choose4_funfact as $item ) {
												$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Why Choose 4 section' ) : '';
												$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'cosmobit_translate_single_string', $item->subtitle, 'Why Choose 4 section' ) : '';
												$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Why Choose 4 section' ) : '';
										?>
											<div class="dt-col-md-4 dt-col-12">
												<div class="dt__funfact-block">
													<div class="dt__funfact-inner">
														<div class="dt__funfact-right">
															<?php if ( ! empty( $title ) || ! empty( $subtitle )) : ?>
																<h3 class="title"><span class="counter"><?php echo esc_html($title); ?></span><sup><?php echo esc_html($subtitle); ?></sup></h3>
															<?php endif; ?>
															
															<?php if ( ! empty( $text ) ) : ?>
																<p class="description dt-mb-0"><?php echo esc_html($text); ?></p>
															<?php endif; ?>	
														</div>
													</div>
												</div>
											</div>
										<?php } } ?>
                                    </div>                                            
                                </div>
							<?php endif; ?>		
						</div>
					</div>
				</div>        
			<?php endif; ?>            
		</div>
	</div>
</section>
<?php endif; ?>