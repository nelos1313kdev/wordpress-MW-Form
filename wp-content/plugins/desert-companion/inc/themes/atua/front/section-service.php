<?php  
	$atua_service_options_hide_show = get_theme_mod('atua_service_options_hide_show','1');
	$atua_service_ttl		= get_theme_mod('atua_service_ttl','Our Services'); 
	$atua_service_subttl	= get_theme_mod('atua_service_subttl','The Best Solutions for Best<span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Business</b> <b>Services</b> <b>Solutions</b></span></span>'); 
	$atua_service_text		= get_theme_mod('atua_service_text','Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.'); 
	$atua_service_option    = get_theme_mod('atua_service_option',atua_service_options_default());
if($atua_service_options_hide_show=='1'):	
?>	
<section id="dt_service_two" class="dt_service dt_service--two dt-py-default front-service">
	<div class="pattern-layer">
		<div class="pattern-1" data-parallax='{"x": 100}' style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape_3.svg);"></div>
		<div class="pattern-2" data-parallax='{"x": 100}' style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape_4.svg);"></div>
		<div class="pattern-3" data-parallax='{"x": 100}' style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape_5.svg);"></div>
		<div class="pattern-4" data-parallax='{"x": 100}' style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape_6.svg);"></div>
	</div>
	<div class="dt-container">
		<?php if ( ! empty( $atua_service_ttl )  || ! empty( $atua_service_subttl ) || ! empty( $atua_service_text )) : ?>
			<div class="dt-row">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
					<div class="dt_siteheading dt-text-center">
						<?php if ( ! empty( $atua_service_ttl ) ) : ?>
							<span class="subtitle"><?php echo wp_kses_post($atua_service_ttl); ?></span>
						<?php endif; ?>	
						
						<?php if ( ! empty( $atua_service_subttl ) ) : ?>
							<h2 class="title">
								<?php echo wp_kses_post($atua_service_subttl); ?>
							</h2>
						<?php endif; ?>	
						
						<?php if ( ! empty( $atua_service_text ) ) : ?>
							<div class="text dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
								<p><?php echo wp_kses_post($atua_service_text); ?></p>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4 service-wrap">
			<?php
				if ( ! empty( $atua_service_option ) ) {
				$atua_service_option = json_decode( $atua_service_option );
				foreach ( $atua_service_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'atua_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'atua_translate_single_string', $item->text, 'Service section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'atua_translate_single_string', $item->text2, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'atua_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'atua_translate_single_string', $item->image_url, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'atua_translate_single_string', $item->icon_value, 'Service section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12">
					<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
						<?php if ( ! empty( $image ) ) : ?>
							<div class="dt_item_image">
								<a href="<?php echo esc_url($link); ?>">
									<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" />
								</a>
							</div>
						<?php endif; ?>	
						<div class="dt_item_holder">
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="dt_item_icon dt-mb-4"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></div>
							<?php endif; ?>	
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="dt_item_content dt-mt-3"><?php echo esc_html($text); ?></div>
							<?php endif; ?>	
							
							<?php if ( ! empty( $button ) ) : ?>
								<div class="dt_item_readmore dt-mt-3"><a class="dt-btn-plustext" href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($button); ?></span></a></div>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>