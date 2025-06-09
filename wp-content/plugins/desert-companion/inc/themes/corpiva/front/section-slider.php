<?php  
	$corpiva_slider_options_hide_show  		= get_theme_mod('corpiva_slider_options_hide_show','1');
	$corpiva_slider_design					= get_theme_mod('corpiva_slider_design','dt_slider--one');
	$corpiva_slider_option 					= get_theme_mod('corpiva_slider_option',corpiva_slider_options_default());
if($corpiva_slider_options_hide_show=='1'):	
?>
<section id="dt_slider" class="dt_slider dt_slider--thumbnav dt_slider--kenburn <?php echo esc_attr($corpiva_slider_design); ?>">
	<div class="dt_owl_carousel owl-theme owl-carousel slider" data-owl-options='{
		"loop": true,
		"animateOut": "fadeOut",
		"animateIn": "fadeIn",
		"items": 1,
		"autoplay": true,
		"autoplayTimeout": 30000,
		"smartSpeed": 1000,
		"nav": true,
		"navText": ["<i class=\"fal fa-arrow-left\"><span class=\"imgholder\"></span></i>","<i class=\"fal fa-arrow-right\"><span class=\"imgholder\"></span></i>"],
		"dots": true,
		"margin": 0
		}'>
		<?php
			if ( ! empty( $corpiva_slider_option ) ) {
				$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
			$corpiva_slider_option = json_decode( $corpiva_slider_option );
			foreach ( $corpiva_slider_option as $item ) {
				$title = ! empty( $item->title ) ? apply_filters( 'corpiva_translate_single_string', $item->title, 'slider section' ) : '';
				$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'corpiva_translate_single_string', $item->subtitle, 'slider section' ) : '';
				$text = ! empty( $item->text ) ? apply_filters( 'corpiva_translate_single_string', $item->text, 'slider section' ) : '';
				$button = ! empty( $item->text2) ? apply_filters( 'corpiva_translate_single_string', $item->text2,'slider section' ) : '';
				$link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'slider section' ) : '';
				$image = ! empty( $item->image_url ) ? apply_filters( 'corpiva_translate_single_string', $item->image_url, 'slider section' ) : '';
				$align = ! empty( $item->slide_align ) ? apply_filters( 'corpiva_translate_single_string', $item->slide_align, 'slider section' ) : '';
		?>
			<div class="dt_slider-item">
				 <?php if ( ! empty( $image ) ) : ?>
					<img src="<?php echo esc_url($image); ?>">
				 <?php endif; ?>
				<svg class="dt_slider-bgsvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<rect class='circle0 steap' x="5.2%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle1 steap' x="15.6%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle2 steap' x="26%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle3 steap' x="36.4%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle4 steap' x="46.8%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle5 steap' x="57%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle6 steap' x="67.7%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle7 steap' x="78.1%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle8 steap' x="88.5%" y="0" rx="0" ry="0" width="100%" height="100%" />
					<rect class='circle9 steap' x="100%" y="0" rx="0" ry="0" width="100%" height="100%" />
				</svg>
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
													<a href="<?php echo esc_url($link); ?>" class="dt-btn dt-btn-primary"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></a>
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
<?php endif; ?>