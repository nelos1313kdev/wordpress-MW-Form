<?php  
	$softme_slider_style		= get_theme_mod('softme_slider_style','1');
	$softme_slider_option 		= get_theme_mod('softme_slider_option',softme_slider_options_default());
?>
<section id="dt_slider" class="dt_slider dt_slider--four dt_slider--thumbnav dt_slider--kenburn">
	<div class="dt_owl_carousel owl-theme owl-carousel slider" 
	data-owl-options='{
		"loop": true, 
		"items": 1, 
		"navText": ["<i class=\"fas fa-angle-left\"><span class=\"imgholder\"></span></i>","<i class=\"fas fa-angle-right\"><span class=\"imgholder\"></span></i>"], 
		"margin": 0, 
		"dots": true, 
		"nav": true, 
		"animateOut": "slideOutDown", 
		"animateIn": "fadeIn", 
		"active": true, 
		"smartSpeed": 1000, 
		"autoplay": true, 
		"autoplayTimeout":30000, 
		"autoplayHoverPause": false,
		"responsive": {
			"0": {
				"nav": false,
				"items": 1
			},
			"600": {
				"nav": false,
				"items": 1
			},
			"992": {
				"items": 1
			}
		}
	}'>
		<?php
			if ( ! empty( $softme_slider_option ) ) {
				$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
			$softme_slider_option = json_decode( $softme_slider_option );
			foreach ( $softme_slider_option as $item ) {
				$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'slider section' ) : '';
				$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'softme_translate_single_string', $item->subtitle, 'slider section' ) : '';
				$text = ! empty( $item->text ) ? apply_filters( 'softme_translate_single_string', $item->text, 'slider section' ) : '';
				$button = ! empty( $item->text2) ? apply_filters( 'softme_translate_single_string', $item->text2,'slider section' ) : '';
				$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'slider section' ) : '';
				$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'slider section' ) : '';
				$align = ! empty( $item->slide_align ) ? apply_filters( 'softme_translate_single_string', $item->slide_align, 'slider section' ) : '';
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
											<?php if ( ! empty( $title )) : ?>
												<h5 class="subtitle"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
											<?php endif; ?>	
											
											<?php if ( ! empty( $subtitle )) : ?>
												<h2 class="title"><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?></h2>
											<?php endif; ?>	
											
											<?php if ( ! empty( $text )) : ?>
												<p class="text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
											<?php endif; ?>	
											
											<div class="dt_btn-group">
												<?php if ( ! empty( $button )) : ?>
													<a href="<?php echo esc_url($link); ?>" class="dt-btn dt-btn-primary"><span class="dt-btn-text" data-text="<?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?>"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></span></a>
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