<?php  
$cosmobit_funfact6_options_hide_show= get_theme_mod('cosmobit_funfact6_options_hide_show','1'); 
$cosmobit_funfact6_option = get_theme_mod('cosmobit_funfact6_option',cosmobit_funfact_options_default());
$cosmobit_funfact6_option_before = get_theme_mod('cosmobit_funfact6_option_before');
$cosmobit_funfact6_option_after	= get_theme_mod('cosmobit_funfact6_option_after');
$cosmobit_funfact6_right_icon	= get_theme_mod('cosmobit_funfact6_right_icon','fa-phone'); 
$cosmobit_funfact6_right_ttl	= get_theme_mod('cosmobit_funfact6_right_ttl','Call for help!'); 
$cosmobit_funfact6_right_subttl	= get_theme_mod('cosmobit_funfact6_right_subttl','<a href="tel:+234-13-1810">+234-13-1810</a>');
if($cosmobit_funfact6_options_hide_show=='1'):
?>
<section id="funfact6_options" class="dt__funfacts dt__funfacts--two front6--funfact" style="background: url(<?php echo esc_url(desert_companion_plugin_url . '/inc/themes/easywiz/assets/images/funfact-bg.jpg') ?>) no-repeat center center / cover var(--dt-sec-color); background-blend-mode: overlay;">
	<div class="dt-container">
		<div class="dt-row dt-g-0">
			<div class="dt-col-md-<?php if(!empty($cosmobit_funfact6_right_ttl)  && !empty($cosmobit_funfact6_right_subttl)): echo '10'; else: echo '12'; endif; ?> dt-col-12 dt-text-md-left dt-py-5">
				<div class="dt-row dt-g-lg-0 dt-g-4 funfact-wrp">
					<?php
						if ( ! empty( $cosmobit_funfact6_option ) ) {
						$cosmobit_funfact6_option = json_decode( $cosmobit_funfact6_option );
						foreach ( $cosmobit_funfact6_option as $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Funfact section' ) : '';
							$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'cosmobit_translate_single_string', $item->subtitle, 'Funfact section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Funfact section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Funfact section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Funfact section' ) : '';
					?>
						<div class="dt-col-lg-3 dt-col-md-6 dt-col-12">
							<div class="dt__funfact-block">
								<div class="dt__funfact-inner">
									<?php if ( ! empty( $image )  || ! empty( $icon )) : ?>
										<div class="dt__funfact-left">
											<div class="dt__funfact-icon">
												<?php if ( ! empty( $image ) ) : ?>
													<img src="<?php echo esc_url($image); ?>">
												<?php else: ?>
													<i class="fa <?php echo esc_attr($icon); ?>"></i>
												<?php endif; ?>
											</div>
											<?php if ( ! empty( $title ) || ! empty( $subtitle )) : ?>
												<h3 class="title"><span class="counter"><?php echo esc_html($title); ?></span><?php echo esc_html($subtitle); ?></h3>
											<?php endif; ?>	
										</div>
									<?php endif; ?>	
									<div class="dt__funfact-right">										
										<?php if ( ! empty( $text ) ) : ?>
											<p class="description dt-mb-0"><?php echo esc_html($text); ?></p>
										<?php endif; ?>		
									</div>
								</div>
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
			<?php if(!empty($cosmobit_funfact6_right_ttl)  || !empty($cosmobit_funfact6_right_subttl)): ?>
				<div class="dt-col-md-2 dt-col-12 dt-text-md-left dt__cta-fancy dt-px-4 dt-py-5">
					<div class="fancy__list">
						<div class="fancy__head">
							<?php if(!empty($cosmobit_funfact6_right_icon)): ?>
								<i class="fa <?php echo esc_attr($cosmobit_funfact6_right_icon); ?>" aria-hidden="true"></i>
							<?php endif; ?>	
							<?php if(!empty($cosmobit_funfact6_right_ttl)): ?>									
								<h4 class="title">
									<?php echo wp_kses_post($cosmobit_funfact6_right_ttl); ?>
								</h4>
							<?php endif; ?>	
						</div>
						
						<?php if(!empty($cosmobit_funfact6_right_subttl)): ?>
							<p class="text dt-mb-0"><?php echo wp_kses_post($cosmobit_funfact6_right_subttl); ?></p>
						<?php endif; ?>	
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>