<?php  
$corpiva_overview_options_hide_show  = get_theme_mod('corpiva_overview_options_hide_show','1');
$corpiva_overview_img 			= get_theme_mod('corpiva_overview_img',esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/overview01.png'));
$corpiva_overview_img2 			= get_theme_mod('corpiva_overview_img2',esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/overview02.png'));
$corpiva_overview_icon 			= get_theme_mod('corpiva_overview_icon','fat fa-file-chart-pie');
$corpiva_overview_right_ttl		= get_theme_mod('corpiva_overview_right_ttl','Company Overview'); 
$corpiva_overview_right_subttl	= get_theme_mod('corpiva_overview_right_subttl','Plan your business strategy with Our Experts'); 
$corpiva_overview_right_text	= get_theme_mod('corpiva_overview_right_text','Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.Borem ipsum dolor sit amet, consectetur adipiscing elita florai psum.</br>Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.'); 
$corpiva_ov_counter_option		= get_theme_mod('corpiva_ov_counter_option',corpiva_ov_counter_options_default()); 	
if($corpiva_overview_options_hide_show=='1'):			
?>	
<section id="dt_overview" class="dt_overview dt_overview--one dt-py-default front-overview">
	<div class="overview-shape" data-aos="fade-left" data-aos-delay="200" data-background="<?php echo esc_url(desert_companion_plugin_url);?>/inc/themes/corpiva/assets/images/overview_shape.png"></div>
	<div class="dt-container">
		<div class="dt-row align-items-center justify-content-center">
			<div class="dt-col-lg-6 dt-col-md-10">
				<div class="overview-img-wrap">
					<?php if(!empty($corpiva_overview_img)): ?>
						<img src="<?php echo esc_url($corpiva_overview_img);?>" alt="">
					<?php endif; ?>
					
					<?php if(!empty($corpiva_overview_img2)): ?>
						<img src="<?php echo esc_url($corpiva_overview_img2);?>" alt="" data-parallax='{"x" : 50 }'>
					<?php endif; ?>
					
					<img src="<?php echo esc_url(desert_companion_plugin_url);?>/inc/themes/corpiva/assets/images/overview_shape02.png" alt="">
					
					<?php if(!empty($corpiva_overview_icon)): ?>
						<div class="icon">
							<i class="<?php echo esc_attr($corpiva_overview_icon);?>"></i>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="dt-col-lg-6">
				<div class="overview-content">
					<?php if ( ! empty( $corpiva_overview_right_ttl )  || ! empty( $corpiva_overview_right_subttl )) : ?>
						<div class="section-title animation-style3 dt-mb-3">
							<?php if(!empty($corpiva_overview_right_ttl)): ?>
								<span class="sub-title"><?php echo wp_kses_post($corpiva_overview_right_ttl); ?></span>
							<?php endif; ?>
							
							<?php if(!empty($corpiva_overview_right_subttl)): ?>
								<h2 class="title dt-element-title"><?php echo wp_kses_post($corpiva_overview_right_subttl); ?></h2>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if(!empty($corpiva_overview_right_text)): ?>
						<p class="info-one"><?php echo wp_kses_post($corpiva_overview_right_text); ?></p>
					<?php endif; ?>
					<div class="content-bottom">
						<ul class="list-wrap">
							<?php
								if ( ! empty( $corpiva_ov_counter_option ) ) {
									$allowed_html = array(
										'br'     => array(),
										'em'     => array(),
										'strong' => array(),
										'span' => array(),
										'b'      => array(),
										'i'      => array(),
										);
								$corpiva_ov_counter_option = json_decode( $corpiva_ov_counter_option );
								foreach ( $corpiva_ov_counter_option as $i=>$item ) {
									$title = ! empty( $item->title ) ? apply_filters( 'corpiva_translate_single_string', $item->title, 'Overview section' ) : '';
									$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'corpiva_translate_single_string', $item->subtitle, 'Overview section' ) : '';
									$text = ! empty( $item->text ) ? apply_filters( 'corpiva_translate_single_string', $item->text, 'Overview section' ) : '';
									$link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'Overview section' ) : '';
									$icon = ! empty( $item->icon_value ) ? apply_filters( 'corpiva_translate_single_string', $item->icon_value, 'Overview section' ) : '';
							?>
								<li>
									<?php if ( ! empty( $icon ) ) : ?>
										<div class="icon">
											<i class="<?php echo esc_attr($icon); ?>"></i>
										</div>
									<?php endif; ?>
									
									<div class="content">
										<?php if ( ! empty( $title ) || ! empty( $subtitle )) : ?>
											<h2 class="count"><span class="odometer" data-count="<?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?>"></span><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?></h2>
										<?php endif; ?>
										
										<?php if ( ! empty( $text ) ) : ?>
											<?php if ( ! empty( $link ) ) : ?>
												<p><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></a></p>
											<?php else: ?>	
												<p><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</li>
							<?php } } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>