<?php  
	$cosmobit_service_options_hide_show	= get_theme_mod('cosmobit_service_options_hide_show','1');
	$cosmobit_service2_ttl		= get_theme_mod('cosmobit_service2_ttl','Our Core Services'); 
	$cosmobit_service2_subttl	= get_theme_mod('cosmobit_service2_subttl','We Have the Knowledge and Experience'); 
	$cosmobit_service2_text		= get_theme_mod('cosmobit_service2_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_service2_option    = get_theme_mod('cosmobit_service2_option',cosmobit_service2_options_default());
	if($cosmobit_service_options_hide_show=='1'):
?>	
<section id="service2_options" class="dt__services dt__services--two dt-py-default front2--service">
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_service2_ttl )  || ! empty( $cosmobit_service2_subttl ) || ! empty( $cosmobit_service2_text )) : ?>
		<div class="dt-row dt-mb-5 dt-pb-2">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
				<div class="dt__siteheading wow fadeInUp">
					<?php if ( ! empty( $cosmobit_service2_ttl ) ) : ?>
						<div class="subtitle"><?php echo wp_kses_post($cosmobit_service2_ttl); ?></div>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service2_subttl ) ) : ?>
						<h2 class="title"><?php echo wp_kses_post($cosmobit_service2_subttl); ?></h2>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service2_text ) ) : ?>
						<div class="text">
							<?php echo wp_kses_post($cosmobit_service2_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4 wow fadeInUp dt-servicess1">
			<?php
				if ( ! empty( $cosmobit_service2_option ) ) {
				$cosmobit_service2_option = json_decode( $cosmobit_service2_option );
				foreach ( $cosmobit_service2_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Service 2 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Service 2 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Service 2 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Service 2 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Service 2 section' ) : '';
			?>
				<div class="dt-col-lg-6 dt-col-md-6 dt-col-12">
					<div class="dt__services-block">
						<div class="dt__services-inner">
							<?php if ( ! empty( $image ) || ! empty( $icon )) : ?>
								<div class="dt__services-icon">
									<?php if ( ! empty( $image )) : ?>
										<span class="icon"><img src="<?php echo esc_url($image); ?>" alt=""></span>
									<?php else: ?>
										<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
									<?php endif; ?>									
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>		
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
		<?php if ( ! empty( $cosmobit_service2_more ) ) : ?>
			<div class="dt-row dt-mt-5">
				<div class="dt-col-12">
					<p class="dt-text-center dt-mb-0 dt-mt-3 service-mre"><?php echo wp_kses_post($cosmobit_service2_more ); ?></p>
				</div>
			</div>
		<?php endif; ?>		
	</div>
</section>
<?php endif; ?>