<?php  
$softme_service_options_hide_show = get_theme_mod('softme_service_options_hide_show','1');
$softme_service_ttl	= get_theme_mod('softme_service_ttl','<b class="is_on">What We’re Offering</b><b>What We’re Offering</b><b>What We’re Offering</b>'); 
$softme_service_subttl	= get_theme_mod('softme_service_subttl','Dealing in all Professional IT </br><span>Services</span>'); 
$softme_service_text	= get_theme_mod('softme_service_text',"There are many variations of passages of available but majority have suffered alteration in some form, by humou or randomised words which don't look even slightly believable.");	
$softme_service_option    = get_theme_mod('softme_service_option2',softme_service_options2_default());
if($softme_service_options_hide_show=='1'):
?>
<section id="dt_service_two" class="dt_service dt_service--five front-service dt-py-default">
	<div class="shape-slide">
		<div class="sliders scroll">
			<img src="<?php echo esc_url(desert_companion_plugin_url) ?>/inc/themes/cozysoft/assets/images/services_1.png" />
		</div>
		<div class="sliders scroll">
		  <img src="<?php echo esc_url(desert_companion_plugin_url) ?>/inc/themes/cozysoft/assets/images/services_1.png" />
		</div>
	</div>
	<div class="dt-container">
		<?php if ( ! empty( $softme_service_ttl )  || ! empty( $softme_service_subttl ) || ! empty( $softme_service_text )) : ?>
			<div class="dt-row">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
					<div class="dt_siteheading dt-text-center">
						<?php if ( ! empty( $softme_service_ttl ) ) : ?>
							 <span class="subtitle">
								<span class="dt_heading dt_heading_8">
									<span class="dt_heading_inner">
										<?php echo wp_kses_post($softme_service_ttl); ?>
									</span>
								</span>
							</span>
						<?php endif; ?>
						
						<?php if ( ! empty( $softme_service_subttl ) ) : ?>
							<h2 class="title">
								<?php echo wp_kses_post($softme_service_subttl); ?>
							</h2>
						<?php endif; ?>	
						
						<?php if ( ! empty( $softme_service_text ) ) : ?>
						<div class="text dt-mt-3 wow fadeInUp" data-wow-duration="1500ms">
							<p><?php echo wp_kses_post($softme_service_text); ?></p>
						</div>
					<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4">
			<?php
				if ( ! empty( $softme_service_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$softme_service_option = json_decode( $softme_service_option );
				foreach ( $softme_service_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'softme_translate_single_string', $item->text, 'Service section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'softme_translate_single_string', $item->text2, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Service section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12">
					<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
						<?php if ( ! empty( $image ) ) : ?>
							<div class="dt_item_image">
								<a href="<?php echo esc_url($link); ?>">
									<img src="<?php echo esc_url($image); ?>" alt="" title="" />
								</a>
							</div>
						<?php endif; ?>
						<div class="dt_item_holder">
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="dt_item_icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
							<?php endif; ?>
							
							<?php if ( ! empty( $text ) ) : ?>
								<p class="dt_item_text text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
							<?php endif; ?>
							
							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_url($link); ?>" class="readmore"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?><i class="fas fa-long-arrow-right"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>