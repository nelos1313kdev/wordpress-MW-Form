<?php  
$softme_protect_left_content = get_theme_mod('softme_protect_left_content','<div class="circle_shapes">
                                <div class="circle"></div>
                            </div>
                            <div class="dt_image_box image-1">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/suntech/assets/images/resource/protect-1.png" alt=""/>                                        
                                </figure>
                            </div>
                            <div class="dt_image_box image-2">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/suntech/assets/images/resource/protect-2.jpg" alt=""/>
                                </figure>
                                <div class="dt_image_video">
                                    <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play dt-btn-primary" data-caption="">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>');
$softme_protect_right_ttl		= get_theme_mod('softme_protect_right_ttl','<b class="is_on">Advance Protect</b><b>Advance Protect</b><b>Advance Protect</b>'); 
$softme_protect_right_subttl	= get_theme_mod('softme_protect_right_subttl','Protecting your privacy Is </br><span>Our Priority</span>'); 
$softme_protect_right_text		= get_theme_mod('softme_protect_right_text','Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.'); 
$softme_protect_option	= get_theme_mod('softme_protect_option',softme_protect_options_default()); 					
?>	
<section id="dt_protect" class="dt_protect dt_protect--one dt-py-default front-protect">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if(!empty($softme_protect_left_content)): ?>
				<div class="dt-col-lg-6 dt-col-md-12 dt-col-sm-12">
					<div class="dt_image_block">
						<?php echo do_shortcode($softme_protect_left_content); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="dt-col-lg-<?php if(!empty($softme_protect_left_content)): echo '6'; else: echo '12'; endif; ?> dt-col-md-12 dt-col-sm-12">
				<div class="dt_content_block">
					<div class="dt_content_box">
						<div class="dt_siteheading">
							<?php if(!empty($softme_protect_right_ttl)): ?>
								<span class="subtitle">
									<span class="dt_heading dt_heading_8">
										<span class="dt_heading_inner">
											<?php echo wp_kses_post($softme_protect_right_ttl); ?>
										</span>
									</span>
								</span>
							<?php endif; ?>
							
							<?php if(!empty($softme_protect_right_subttl)): ?>
								<h2 class="title"><?php echo wp_kses_post($softme_protect_right_subttl); ?></h2>
							<?php endif; ?>
							
							<?php if(!empty($softme_protect_right_text)): ?>
								<div class="text dt-mt-3 wow fadeInUp" data-wow-duration="1500ms">
									<p><?php echo wp_kses_post($softme_protect_right_text); ?></p>
								</div>
							<?php endif; ?>
						</div>
						<div class="dt-row dt-g-4 dt-mt-2 protect-wrp">
							<?php
								if ( ! empty( $softme_protect_option ) ) {
									$allowed_html = array(
										'br'     => array(),
										'em'     => array(),
										'strong' => array(),
										'span' => array(),
										'b'      => array(),
										'i'      => array(),
										);
								$softme_protect_option = json_decode( $softme_protect_option );
								foreach ( $softme_protect_option as $i=>$item ) {
									$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Protect section' ) : '';
									$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Protect section' ) : '';
									$icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Protect section' ) : '';
							?>
							<div class="dt-col-lg-6 dt-col-sm-6 dt-col-12">
								<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
									<?php if ( ! empty( $icon ) ) : ?>
										<div class="dt_item_icon"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></div>
									<?php endif; ?>
									
									<?php if ( ! empty( $title ) ) : ?>
										<div class="dt_item_holder">                                                
											<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>                    
		</div>
	</div>
</section>