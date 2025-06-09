<?php  
$corpiva_features_options_hide_show  = get_theme_mod('corpiva_features_options_hide_show','1');
$corpiva_features_ttl		  = get_theme_mod('corpiva_features_ttl','We’ll Ensure You Always Get the Best Guidance.'); 
$corpiva_features_text	  	  = get_theme_mod('corpiva_features_text','Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.'); 
$corpiva_features_icon	  	  = get_theme_mod('corpiva_features_icon','fas fa-play');
$corpiva_features_btn_lbl	  = get_theme_mod('corpiva_features_btn_lbl','Watch Video');	
$corpiva_features_btn_url	  = get_theme_mod('corpiva_features_btn_url','https://www.youtube.com/watch?v=6mkoGSqTqFI');
$corpiva_features_option      = get_theme_mod('corpiva_features_option',corpiva_features_options_default());
$corpiva_features_img	  	  = get_theme_mod('corpiva_features_img',esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/feature_bg.jpg'));
if($corpiva_features_options_hide_show=='1'):
?>
<section id="dt_feature" class="dt_feature dt_feature--one dt-py-default front-feature" data-background="<?php echo esc_url($corpiva_features_img);?>">
	<div class="dt_feature-shape">
		<img src="<?php echo esc_url(desert_companion_plugin_url);?>/inc/themes/corpiva/assets/images/feature_shape.png" alt="" data-aos="fade-right" data-aos-delay="0">
	</div>
	<div class="dt-container">
		<div class="dt-row align-items-center">
			<div class="dt-col-lg-6">
				<div class="feature-content dt-mb-6">
					<?php if ( ! empty( $corpiva_features_ttl ) ) : ?>
						<div class="section-title animation-style3">
							<h2 class="title dt-element-title text-white"><?php echo wp_kses_post($corpiva_features_ttl); ?></h2>
						</div>
					<?php endif; ?>	
					
					<?php if ( ! empty( $corpiva_features_text ) ) : ?>
						<p class="info-one"><?php echo wp_kses_post($corpiva_features_text); ?></p>
					<?php endif; ?>	
					
					<?php if ( ! empty( $corpiva_features_btn_lbl ) || ! empty( $corpiva_features_icon )) : ?>
						<a href="<?php echo esc_attr($corpiva_features_btn_url); ?>" class="dt-btn-play-two dt_lightbox_img">
							<i class="<?php echo esc_attr($corpiva_features_icon); ?>"></i>
							<span><?php echo wp_kses_post($corpiva_features_btn_lbl); ?></span>
						</a>
					<?php endif; ?>	
				</div>
			</div>
			<div class="dt-col-lg-6">
				<div class="dt-row dt-g-3">
					<?php
						if ( ! empty( $corpiva_features_option ) ) {
							$allowed_html = array(
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'span' => array(),
								'b'      => array(),
								'i'      => array(),
								);
						$corpiva_features_option = json_decode( $corpiva_features_option );
						foreach ( $corpiva_features_option as $i=>$item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'corpiva_translate_single_string', $item->title, 'Features section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'Features section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'corpiva_translate_single_string', $item->icon_value, 'Features section' ) : '';
					?>
						<div class="dt-col-lg-6">
							<div class="feature-item">
								<?php if ( ! empty( $icon ) ) : ?>
									<div class="feature-icon">
										<i class="<?php echo esc_attr($icon); ?>"></i>
									</div>
								<?php endif; ?>	
								
								<?php if ( ! empty( $title ) ) : ?>
									<?php if ( ! empty( $link ) ) : ?>
										<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
									<?php else: ?>	
										<h5 class="title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
									<?php endif; ?>
								<?php endif; ?>	
								
								<?php if ( ! empty( $link ) ) : ?>
									<a href="<?php echo esc_url($link); ?>" class="feature-btn"><i class="far fa-long-arrow-right"></i></a>
								<?php endif; ?>	
							</div>
						</div>
					<?php } ?>
					<div class="feature-move-cursor">
						<?php
							foreach ( $corpiva_features_option as $i=>$item ) {
								$image = ! empty( $item->image_url ) ? apply_filters( 'corpiva_translate_single_string', $item->image_url, 'Features section' ) : '';
						?>
							<?php if ( ! empty( $image ) ) : ?>
								<div class="feature-inner-image" data-image="<?php echo esc_url($image); ?>"></div>
							<?php endif; ?>	
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>