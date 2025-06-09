<?php  
	$cosmobit_service_options_hide_show	= get_theme_mod('cosmobit_service_options_hide_show','1'); 
	$cosmobit_service_ttl		= get_theme_mod('cosmobit_service_ttl','Services'); 
	$cosmobit_service_subttl	= get_theme_mod('cosmobit_service_subttl','We Serve the Best Work'); 
	$cosmobit_service_text		= get_theme_mod('cosmobit_service_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_service_option    = get_theme_mod('cosmobit_service_option',cosmobit_service_options_default());
	if($cosmobit_service_options_hide_show=='1'):	
?>	
<section id="service_options" class="dt__services dt__services--one dt-py-default front1--service">
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_service_ttl )  || ! empty( $cosmobit_service_subttl ) || ! empty( $cosmobit_service_text )) : ?>
		<div class="dt-row dt-mb-5 dt-pb-2">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
				<div class="dt__siteheading wow fadeInUp">
					<?php if ( ! empty( $cosmobit_service_ttl ) ) : ?>
						<div class="subtitle"><?php echo wp_kses_post($cosmobit_service_ttl); ?></div>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service_subttl ) ) : ?>
						<h2 class="title"><?php echo wp_kses_post($cosmobit_service_subttl); ?></h2>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service_text ) ) : ?>
						<div class="text">
							<?php echo wp_kses_post($cosmobit_service_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4 wow fadeInUp loadmore dt-servicess1" data-col="3">
			<?php
				if ( ! empty( $cosmobit_service_option ) ) {
				$cosmobit_service_option = json_decode( $cosmobit_service_option );
				foreach ( $cosmobit_service_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Service section' ) : '';
					$image2 = ! empty( $item->image_url2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url2, 'Service section' ) : '';
			?>
				<div class="dt-col-lg-4 dt-col-md-6 dt-col-12">
					<div class="dt__services-block">
						<div class="dt__services-inner">
							<div class="dt__services-icon">
								<?php if ( ! empty( $image ) ) : ?>
									<img src="<?php echo esc_url($image); ?>" alt="">
								<?php endif; ?>	
								
								<?php if ( ! empty( $image2 ) ) : ?>
									<span class="icon"><img src="<?php echo esc_url($image2); ?>" alt=""></span>
								<?php endif; ?>	
							</div>
							
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
	</div>
</section>
<?php endif; ?>