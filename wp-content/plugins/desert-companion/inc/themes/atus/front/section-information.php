<?php  
$atua_information_options_hide_show = get_theme_mod('atua_information_options_hide_show','1');
$atua_information_option = get_theme_mod('atua_information_option',atua_information_options_default());
if($atua_information_options_hide_show=='1'):	
?>
<section id="dt_service_eight" class="dt_service dt_service--eight dt-py-default front-info">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 dt_service_row-no">
				<div class="dt-row dt-g-4">
					<?php
						if ( ! empty( $atua_information_option ) ) {
						$atua_information_option = json_decode( $atua_information_option );
						foreach ( $atua_information_option as $i=>$item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'atua_translate_single_string', $item->title, 'Information section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'atua_translate_single_string', $item->text, 'Information section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'atua_translate_single_string', $item->link, 'Information section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'atua_translate_single_string', $item->image_url, 'Information section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'atua_translate_single_string', $item->icon_value, 'Information section' ) : '';
					?>
					<div class="dt-col-lg-4 dt-col-md-6 dt-col-12">
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
									<div class="dt_item_icon">
										<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
									</div>
								<?php endif; ?>
								<div class="svg_content">
									<svg class="top-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 374 63">
										<path fill-rule="evenodd" d="M0.000,13.000 C0.000,13.000 72.000,77.250 159.000,59.000 C246.000,40.750 324.750,14.750 370.000,30.000 L370.000,19.000 C370.000,19.000 355.000,-4.750 164.000,47.000 C164.000,47.000 73.250,71.000 0.000,-0.000 L0.000,13.000 Z"></path>
									</svg>
									<svg class="bottom-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 374 63">
										<path fill-rule="evenodd" d="M0.000,13.000 C0.000,13.000 72.000,77.250 159.000,59.000 C246.000,40.750 324.750,14.750 370.000,30.000 L370.000,19.000 C370.000,19.000 355.000,-4.750 164.000,47.000 C164.000,47.000 73.250,71.000 0.000,-0.000 L0.000,13.000 Z"></path>
									</svg>

									<svg class="bottom-svgw" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 374 57">
										<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M0.000,0.000 C0.000,0.000 58.000,66.000 150.000,51.000 C150.000,51.000 325.000,1.667 370.000,21.000 L370.000,57.000 L0.000,57.000 "></path>
									</svg>
								</div>
								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
								<?php endif; ?>	
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="dt_item_content"><?php echo esc_html($text); ?></div>
								<?php endif; ?>	
								
								<?php if ( ! empty( $link ) ) : ?>
									<div class="dt_item_readmore"><a class="dt-btn-plustext" href="<?php echo esc_url($link); ?>"><span></span></a></div>
								<?php endif; ?>	
							</div>
						</div>
					</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>