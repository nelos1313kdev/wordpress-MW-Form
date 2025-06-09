<?php  
	$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
	$cosmobit_information_option = get_theme_mod('cosmobit_information_option',cosmobit_information_options_default());
	if($cosmobit_information_options_hide_show=='1'):
?>	
<section id="information_options" class="dt__infoservices dt__infoservices--one">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-12">
				<div class="dt__infoservices-row wow fadeInUp" style="background-image: url('<?php echo esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/pattern01.png'); ?>')">					
					<div class="dt__infoservices-carousel dt__nav-carousel owl-carousel owl-theme">
							<?php
								if ( ! empty( $cosmobit_information_option ) ) {
								$cosmobit_information_option = json_decode( $cosmobit_information_option );
								foreach ( $cosmobit_information_option as $item ) {
									$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information section' ) : '';
									$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information section' ) : '';
									$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information section' ) : '';
									$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information section' ) : '';
									$align = ! empty( $item->slide_align ) ? apply_filters( 'cosmobit_translate_single_string', $item->slide_align, 'Information section' ) : '';
							?>
							<div class="dt__infoservices-block">
								<div class="dt__infoservices-inner">
									<div class="dt__infoservices-icon">
										<?php if ( ! empty( $icon ) ) : ?>
											<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i></span>
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
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>