<?php  
$atua_about_options_hide_show = get_theme_mod('atua_about_options_hide_show','1');
$atua_about_left_content = get_theme_mod('atua_about_left_content','<div class="dt_image_block dt_image_block--one">
                                <div class="dt_image_box">
                                    <div class="shape parallax-scene parallax-scene-1">
                                        <div data-depth="0.40" class="shape-1" style="background-image: url('.esc_url(get_template_directory_uri()) . '/assets/images/shape/shape_2.svg);"></div>
                                        <div data-depth="0.50" class="shape-2" style="background-image: url('.esc_url(get_template_directory_uri()) . '/assets/images/shape/shape_2.svg);"></div>
                                    </div>
                                    <figure class="image image-1">
                                        <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/atua/assets/images/resource/about-1.jpg" alt="">
                                    </figure>
                                    <div class="video-inner" style="background-image: url('.esc_url(desert_companion_plugin_url) . '/inc/themes/atua/assets/images/resource/about-2.jpg);">
                                        <div class="video-btn">
                                            <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play" data-caption="">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>');
$atua_about_right_ttl		= get_theme_mod('atua_about_right_ttl','About Us'); 
$atua_about_right_subttl	= get_theme_mod('atua_about_right_subttl','The Best Solutions for Best
                                            <span class="dt_heading dt_heading_9">
                                                <span class="dt_heading_inner">
                                                    <b class="is_on">Business</b>
                                                    <b>Services</b>
                                                    <b>Solutions</b>
                                                </span>
                                            </span>'); 
$atua_about_right_text		= get_theme_mod('atua_about_right_text','Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation laboris.'); 
$atua_about_right_content	= get_theme_mod('atua_about_right_content','<ul class="dt_list_style dt_list_style--one dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
                                        <li>Clients Focused</li>
                                        <li>Targeting & Positioning</li>
                                        <li>We Can Save You Money</li>
                                        <li>Tax Advantages</li>
                                        <li>Unique Ideas & Solution</li>
                                    </ul>
                                    <div class="btn-box dt-mt-5 wow fadeInUp" data-wow-duration="1500ms">
                                        <a href="#" class="dt-btn dt-btn-primary">
                                            <span class="dt-btn-text" data-text="Get A Quote">Get A Quote</span>
                                        </a>
                                    </div>'); 
if($atua_about_options_hide_show=='1'):										
?>	
<section id="dt_about" class="dt_about dt_about--one front-about">
	<div class="pattern-layer parallax-scene parallax-scene-2">
		<div data-depth="0.40" class="pattern-1"></div>
		<div data-depth="0.50" class="pattern-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/shape/shape_1.svg);"></div>
	</div>
	<div class="dt-container">
		<div class="dt-container-inner dt-py-default">
			<div class="section-line">
				<div class="line line-1"></div>
				<div class="line line-2"></div>
				<div class="line line-3"></div>
			</div>
			<div class="dt-row dt-g-5">
				<?php if(!empty($atua_about_left_content)): ?>
					<div class="dt-col-lg-6 dt-col-md-12 dt-col-sm-12 dt_image_column">
						<?php echo do_shortcode($atua_about_left_content); ?>
					</div>
				<?php endif; ?>
				<div class="dt-col-lg-<?php if(!empty($atua_about_left_content)): echo '6'; else: echo '12'; endif; ?> dt-col-md-12 dt-col-sm-12 dt_content_column">
					<div class="dt_content_block">
						<div class="dt_content_box">
							<div class="dt_siteheading">
								<?php if(!empty($atua_about_right_ttl)): ?>
									<span class="subtitle"><?php echo wp_kses_post($atua_about_right_ttl); ?></span>
								<?php endif; ?>
								
								<?php if(!empty($atua_about_right_subttl)): ?>
									<h2 class="title">
										<?php echo wp_kses_post($atua_about_right_subttl); ?>
									</h2>
								<?php endif; ?>	
								
								<?php if(!empty($atua_about_right_text)): ?>
									<div class="text dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
										<p class="text"><?php echo wp_kses_post($atua_about_right_text); ?></p>
									</div>
								<?php endif; ?>	
							</div>
							<?php if(!empty($atua_about_right_content)): ?>
								<?php echo do_shortcode($atua_about_right_content); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>