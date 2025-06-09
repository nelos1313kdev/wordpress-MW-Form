<?php  
	$cosmobit_service6_image	= get_theme_mod('cosmobit_service6_image',esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/cta-two-bg.jpg')); 
	$cosmobit_service5_ttl		= get_theme_mod('cosmobit_service5_ttl','Services'); 
	$cosmobit_service5_subttl	= get_theme_mod('cosmobit_service5_subttl','We Serve the Best Work'); 
	$cosmobit_service5_text		= get_theme_mod('cosmobit_service5_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_service6_option    = get_theme_mod('cosmobit_service6_option',cosmobit_service3_options_default());
	$cosmobit_service5_column		= get_theme_mod('cosmobit_service5_column','4'); 
	if($cosmobit_service5_column=='4'): $data_col='3'; elseif($cosmobit_service5_column=='3'): $data_col='4'; elseif($cosmobit_service5_column=='6'): $data_col='2'; endif;
	$cosmobit_service5_option_before	= get_theme_mod('cosmobit_service5_option_before');
	$cosmobit_service5_option_after	= get_theme_mod('cosmobit_service5_option_after');
	if(!empty($cosmobit_service5_option_before)): echo do_shortcode($cosmobit_service5_option_before); endif;
?>
<section id="service5_options" class="dt__services dt__services--seven dt-py-default front5--service">
	<div style="position:absolute;inset:0;z-index:-1;background: url(<?php echo esc_url($cosmobit_service6_image); ?>) no-repeat center center / cover var(--dt-sec-color); background-blend-mode: overlay;"></div>
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_service5_ttl )  || ! empty( $cosmobit_service5_subttl ) || ! empty( $cosmobit_service5_text )) : ?>
		<div class="dt-row dt-mb-5 dt-pb-2">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
				<div class="dt__siteheading wow fadeInUp">
					<?php if ( ! empty( $cosmobit_service5_ttl ) ) : ?>
						<div class="subtitle"><?php echo wp_kses_post($cosmobit_service5_ttl); ?></div>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service5_subttl ) ) : ?>
						<h2 class="title"><?php echo wp_kses_post($cosmobit_service5_subttl); ?></h2>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_service5_text ) ) : ?>
						<div class="text">
							<?php echo wp_kses_post($cosmobit_service5_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4 wow fadeIn loadmore dt-servicess6"  data-col="<?php echo esc_attr($data_col); ?>">
			<?php
				if ( ! empty( $cosmobit_service6_option ) ) {
				$cosmobit_service6_option = json_decode( $cosmobit_service6_option );
				foreach ( $cosmobit_service6_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Service section' ) : '';
					$image2 = ! empty( $item->image_url2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url2, 'Service section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Service section' ) : '';
			?>
				<div class="dt-col-lg-<?php echo esc_attr($cosmobit_service5_column); ?> dt-col-md-6 dt-col-12">
					<div class="dt__services-block">
						<div class="dt__services-icon">
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>
						</div>							
						<div class="dt__services-inner">
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text dt-mt-2 dt-pt-1"><?php echo esc_html($text); ?></div>
							<?php endif; ?>

							<?php if ( ! empty( $button ) ) : ?>
								<a class="more-link dt-mt-3" href="<?php echo esc_url($link); ?>"><?php echo esc_html($button); ?> <i class="fa fa-long-arrow-right"></i></a>
							<?php endif; ?>
							
							<?php if ( ! empty( $image ) ) : ?>
							<div class="overlay" style="background-image: url(<?php echo esc_url($image); ?>)"></div>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php if(!empty($cosmobit_service5_option_after)): echo do_shortcode($cosmobit_service5_option_after); endif; ?>