<?php  
	$atua_slider_option = get_theme_mod('atua_slider_option',atua_slider_options_default());
?>	
<section id="dt_slider" class="dt_slider dt_slider--one dt_slider--kenburn">
	<div class="dt_slider-carousel owl-theme owl-carousel owl-dots-none">
		<?php
			if ( ! empty( $atua_slider_option ) ) {
			$atua_slider_option = json_decode( $atua_slider_option );
			foreach ( $atua_slider_option as $item ) {
				$title = ! empty( $item->title ) ? apply_filters( 'atua_translate_single_string', $item->title, 'slider section' ) : '';
				$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'atua_translate_single_string', $item->subtitle, 'slider section' ) : '';
				$subtitle2 = ! empty( $item->subtitle2 ) ? apply_filters( 'atua_translate_single_string', $item->subtitle2, 'slider section' ) : '';
				$subtitle3 = ! empty( $item->subtitle3 ) ? apply_filters( 'atua_translate_single_string', $item->subtitle3, 'slider section' ) : '';
				$text = ! empty( $item->text ) ? apply_filters( 'atua_translate_single_string', $item->text, 'slider section' ) : '';
				$button = ! empty( $item->text2) ? apply_filters( 'atua_translate_single_string', $item->text2,'slider section' ) : '';
				$link = ! empty( $item->link ) ? apply_filters( 'atua_translate_single_string', $item->link, 'slider section' ) : '';
				$image = ! empty( $item->image_url ) ? apply_filters( 'atua_translate_single_string', $item->image_url, 'slider section' ) : '';
				$align = ! empty( $item->slide_align ) ? apply_filters( 'atua_translate_single_string', $item->slide_align, 'slider section' ) : '';
		?>
			<div class="dt_slider-item">
				<?php if ( ! empty( $image ) ) : ?>
					<img src="<?php echo esc_url($image); ?>">
				<?php endif; ?>	
				<div class="dt_slider-wrapper">
					<div class="dt_slider-inner">
						<div class="dt_slider-innercell">
							<div class="dt-container">
								<div class="dt-row dt-text-<?php echo esc_attr($align); ?>">
									<div class="dt-col-lg-12 dt-col-md-12 first dt-my-auto">
										<div class="dt_slider-content">
											<?php if ( ! empty( $title ) && ! empty( $subtitle )) : ?>
												<h5 class="subtitle"><span class="text-primary"><?php echo esc_html($title); ?></span> <?php echo esc_html($subtitle); ?></h5>
											<?php endif; ?>	
											
											<?php if ( ! empty( $subtitle2 ) && ! empty( $subtitle3 )) : ?>
												<h2 class="title"><span class="dt_slider-animate"><?php echo esc_html($subtitle2); ?></span><span class="dt_slider-animate"><?php echo esc_html($subtitle3); ?></span></h2>
											<?php endif; ?>	
											
											<?php if ( ! empty( $text )) : ?>
												<p class="text"><?php echo esc_html($text); ?></p>
											<?php endif; ?>
											
											<div class="dt_btn-group">
												<?php if ( ! empty( $button )) : ?>
													<a href="<?php echo esc_url($link); ?>" class="dt-btn dt-btn-primary"><span class="dt-btn-text" data-text="<?php echo esc_attr($button); ?>"><?php echo esc_html($button); ?></span></a>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } } ?>
	</div>
</section>