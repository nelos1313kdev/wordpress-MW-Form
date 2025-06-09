<?php  
	$cosmobit_service_options_hide_show	= get_theme_mod('cosmobit_service_options_hide_show','1');
	$cosmobit_service3_ttl		= get_theme_mod('cosmobit_service3_ttl','Services'); 
	$cosmobit_service3_subttl	= get_theme_mod('cosmobit_service3_subttl','We Serve the Best Work'); 
	$cosmobit_service3_text		= get_theme_mod('cosmobit_service3_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_service3_option    = get_theme_mod('cosmobit_service3_option',cosmobit_service3_options_default());
	if($cosmobit_service_options_hide_show=='1'):
?>	
<section id="service3_options" class="dt__services dt__services--three dt-py-default front3--service">
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_service3_ttl )  || ! empty( $cosmobit_service3_subttl ) || ! empty( $cosmobit_service3_text )) : ?>
		<div class="dt-row dt-mb-5 dt-pb-2">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
				<div class="dt__siteheading wow fadeInUp">
					<?php if ( ! empty( $cosmobit_service3_ttl ) ) : ?>
						<div class="subtitle"><?php echo wp_kses_post($cosmobit_service3_ttl); ?></div>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service3_subttl ) ) : ?>
						<h2 class="title"><?php echo wp_kses_post($cosmobit_service3_subttl); ?></h2>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service3_text ) ) : ?>
						<div class="text">
							<?php echo wp_kses_post($cosmobit_service3_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4 wow fadeInUp loadmore dt-servicess3">
			<?php
				if ( ! empty( $cosmobit_service3_option ) ) {
				$cosmobit_service3_option = json_decode( $cosmobit_service3_option );
				foreach ( $cosmobit_service3_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Service 3 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Service 3 section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Service 3 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Service 3 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Service 3 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Service 3 section' ) : '';
			?>
				<div class="dt-col-lg-4 dt-col-md-6 dt-col-12">
					<div class="dt__services-block">
						<div class="dt__services-inner">
							<?php if ( ! empty( $icon )) : ?>
								<div class="dt__services-icon">
									<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>		
						</div>
						<div class="dt__services-back">
							<?php if ( ! empty( $image )) : ?>
								<div class="bg-img"><img src="<?php echo esc_url($image); ?>" alt="" /></div>
							<?php endif; ?>
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>		
							
							<?php if ( ! empty( $button ) ) : ?>
								<a class="read-more" href="<?php echo esc_url($link); ?>"><?php echo esc_html($button); ?></a>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>