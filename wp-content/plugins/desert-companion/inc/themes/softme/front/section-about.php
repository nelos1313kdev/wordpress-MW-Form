<?php  
$softme_about_options_hide_show = get_theme_mod('softme_about_options_hide_show','1');
$softme_about_left_content = get_theme_mod('softme_about_left_content','<div class="dt_image_box image-1 paroller">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/softme/assets/images/resource/about-1.jpg" alt=""/>                                        
                                </figure>
                                <div class="dt_image_video">
                                    <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play2 dt-btn-primary" data-caption="">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="dt_image_box image-2 paroller-2">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/softme/assets/images/resource/about-2.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="dt_image_text">
                                <span class="dt_count_box">
                                    <span class="dt_count_text" data-speed="2500" data-stop="25">0</span><span class="text">Years Experience</span>
                                </span>                                
                            </div>');
$softme_about_right_ttl		= get_theme_mod('softme_about_right_ttl','<b class="is_on">About Our Company</b><b>About Our Company</b><b>About Our Company</b>'); 
$softme_about_right_subttl	= get_theme_mod('softme_about_right_subttl','We are Partner of Your </br><span>Innovations</span>'); 
$softme_about_right_text		= get_theme_mod('softme_about_right_text',"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even."); 
$softme_about_right_content	= get_theme_mod('softme_about_right_content','<ul class="dt_content_about_info style1 wow fadeInUp" data-wow-duration="1500ms">
                                    <li>
                                        <aside class="widget widget_contact">
                                            <div class="contact__list">
                                                <i class="fas fa-cubes" aria-hidden="true"></i>
                                                <div class="contact__body">
                                                    <h5 class="title"><a href="#">IT Consultant</a></h5>
                                                    <p class="description">Smarter Solutions</p>
                                                </div>
                                            </div>
                                        </aside>
                                    </li>
                                    <li>
                                        <aside class="widget widget_contact">
                                            <div class="contact__list">
                                                <i class="fas fa-medal" aria-hidden="true"></i>
                                                <div class="contact__body">
                                                    <h5 class="title"><a href="#">IT Specialist</a></h5>
                                                    <p class="description">Faster Solutions</p>
                                                </div>
                                            </div>
                                        </aside>
                                    </li>
                                </ul>
                                <ul class="dt_list_style dt_list_style--two dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
                                    <li>Exploring version oflorem veritatis proin.</li>
                                    <li>Auctor aliquet aenean simply free text veritatis quis.</li>
                                    <li>Consequat ipsum nec lorem sagittis sem nibh.</li>
                                </ul>
                                <div class="dt_btn-group dt-mt-5 wow fadeInUp" data-wow-duration="1500ms">
                                    <a href="#" class="dt-btn dt-btn-primary">
                                        <span class="dt-btn-text" data-text="Learn More">Learn More</span>
                                    </a>
                                </div>'); 	
if($softme_about_options_hide_show=='1'):								
?>	
<section id="dt_about" class="dt_about dt_about--one dt-py-default front-about">
	<div class="pattern-layer parallax-scene parallax-scene-1">
		<div data-depth="0.40" class="pattern-1"></div>
		<div data-depth="0.50" class="pattern-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/shape/shape_1.svg);"></div>
		<div data-depth="0.40" class="pattern-3" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/shape/shape_2.svg);"></div>
		<div data-depth="0.50" class="pattern-4" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/shape/shape_2.svg);"></div>
	</div>
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if(!empty($softme_about_left_content)): ?>
				<div class="dt-col-lg-6 dt-col-md-12 dt-col-sm-12">
					<div class="dt_image_block style1">
						<?php echo do_shortcode($softme_about_left_content); ?>
					</div>
				</div>
			<?php endif; ?>
			
			<div class="dt-col-lg-<?php if(!empty($softme_about_left_content)): echo '6'; else: echo '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
				<div class="dt_content_block">
					<div class="dt_content_box">
						<div class="dt_siteheading">
							<?php if(!empty($softme_about_right_ttl)): ?>
								<span class="subtitle">
									<span class="dt_heading dt_heading_8">
										<span class="dt_heading_inner">
											<?php echo wp_kses_post($softme_about_right_ttl); ?>
										</span>
									</span>
								</span>
							<?php endif; ?>
							
							<?php if(!empty($softme_about_right_subttl)): ?>
								<h2 class="title"><?php echo wp_kses_post($softme_about_right_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($softme_about_right_text)): ?>
								<div class="text dt-mt-3 wow fadeInUp" data-wow-duration="1500ms">
									<p><?php echo wp_kses_post($softme_about_right_text); ?></p>
								</div>
							<?php endif; ?>
						</div>
						
						<?php if(!empty($softme_about_right_content)): ?>
							<?php echo do_shortcode($softme_about_right_content); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>