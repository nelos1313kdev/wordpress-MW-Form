<?php  
	$atua_features_options_hide_show = get_theme_mod('atua_features_options_hide_show','1');
	$atua_features_ttl		= get_theme_mod('atua_features_ttl','Why Choose Us'); 
	$atua_features_subttl	= get_theme_mod('atua_features_subttl','Find Out More Our<span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Features</b> <b>Features</b> <b>Features</b></span></span>'); 
	$atua_features_text		= get_theme_mod('atua_features_text','Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.');
	$atua_features_btn_lbl		= get_theme_mod('atua_features_btn_lbl','View All'); 
	$atua_features_btn_link		= get_theme_mod('atua_features_btn_link','#'); 	
	$atua_features_option    = get_theme_mod('atua_features_option',atua_features_options_default());
	$atua_features_cta_bg_img		= get_theme_mod('atua_features_cta_bg_img',esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/slider/slider_bg.jpg')); 
	$atua_features_cta_opacity		= get_theme_mod('atua_features_cta_opacity','0.95'); 
	$atua_features_cta_overlay		= get_theme_mod('atua_features_cta_overlay','#0e1422'); 
	list($color1, $color2, $color3) = sscanf($atua_features_cta_overlay, "#%02x%02x%02x");
if($atua_features_options_hide_show=='1'):	
?>	
<section id="dt_features_area" class="dt_features_area dt_features--one">
	<div class="dt_features dt-py-default front-features" style="background: url(<?php echo esc_url($atua_features_cta_bg_img); ?>) no-repeat center center/cover rgba(<?php echo esc_attr($color1); ?>, <?php echo esc_attr($color2); ?>, <?php echo esc_attr($color3); ?>, <?php echo esc_attr($atua_features_cta_opacity); ?>);background-blend-mode: overlay;">
		<div class="pattern-layer parallax-scene parallax-scene-2">
			<div data-depth="0.40" class="pattern-1"></div>
			<div data-depth="0.50" class="pattern-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape_1.svg);"></div>
		</div>
		<div class="dt-container">
			<div class="dt-row dt-g-5 dt-mt-0">
				<div class="dt-col-lg-5 dt-col-md-12 dt-col-sm-12 dt-my-md-auto dt-my-0 dt_content_column">
					<div class="dt_content_block">
						<div class="dt_content_box">
							<?php if ( ! empty( $atua_features_ttl )  || ! empty( $atua_features_subttl ) || ! empty( $atua_features_text )) : ?>
								<div class="dt_siteheading dt-mb-5">
									<?php if ( ! empty( $atua_features_ttl ) ) : ?>
										<span class="subtitle"><?php echo wp_kses_post($atua_features_ttl); ?></span>
									<?php endif; ?>	
									
									<?php if ( ! empty( $atua_features_subttl ) ) : ?>
										<h2 class="title">
											<?php echo wp_kses_post($atua_features_subttl); ?>
										</h2>
									<?php endif; ?>	
									
									<?php if ( ! empty( $atua_features_text ) ) : ?>
										<div class="text dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
											<p><?php echo wp_kses_post($atua_features_text); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $atua_features_btn_lbl ) ) : ?>
										<div class="btn-box dt-mt-5 wow fadeInUp" data-wow-duration="1500ms">
                                            <a href="<?php echo esc_url($atua_features_btn_link); ?>" class="dt-btn dt-btn-white">
                                                <span class="dt-btn-text" data-text="<?php echo wp_kses_post($atua_features_btn_lbl); ?>"><?php echo wp_kses_post($atua_features_btn_lbl); ?></span>
                                            </a>
                                        </div>
									<?php endif; ?>	
								</div>
							<?php endif; ?>							
						</div>
					</div>
				</div>
				<div class="dt-col-lg-7 dt-col-md-12 dt-col-sm-12 dt-my-md-auto dt-my-0 dt_features_column">                            
					<div class="dt-row dt-g-5">
						<?php
							if ( ! empty( $atua_features_option ) ) {
							$atua_features_option = json_decode( $atua_features_option );
							foreach ( $atua_features_option as $i=>$item ) {
								$title = ! empty( $item->title ) ? apply_filters( 'atua_translate_single_string', $item->title, 'Features section' ) : '';
								$text = ! empty( $item->text ) ? apply_filters( 'atua_translate_single_string', $item->text, 'Features section' ) : '';
								$link = ! empty( $item->link ) ? apply_filters( 'atua_translate_single_string', $item->link, 'Features section' ) : '';
								$icon = ! empty( $item->icon_value ) ? apply_filters( 'atua_translate_single_string', $item->icon_value, 'Features section' ) : '';
						?>
							<div class="dt-col-lg-6 dt-col-md-6 dt-col-12">
								<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
									<div class="dt_item_holder">
										<?php if ( ! empty( $icon ) ) : ?>
											<div class="dt_item_icon"><span class="dot1"></span><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i><span class="dot2"></span></div>
										<?php endif; ?>	
										
										<?php if ( ! empty( $title ) ) : ?>
											<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
										<?php endif; ?>	
										
										<?php if ( ! empty( $text ) ) : ?>
											<div class="dt_item_content"><?php echo esc_html($text); ?></div>
										<?php endif; ?>	
									</div>
								</div>
							</div>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>