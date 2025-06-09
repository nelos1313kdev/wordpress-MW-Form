<?php  
	$atua_information_options_hide_show = get_theme_mod('atua_information_options_hide_show','1');
	$atua_information_option = get_theme_mod('atua_information_option',atua_information_options_default());
if($atua_information_options_hide_show=='1'):	
?>
<section id="dt_service_one" class="dt_service dt_service--three dt-py-default front-info">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12">
				<div class="dt_service_carousel owl-carousel owl-theme">
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
									<div class="dt_item_icon dt-mb-4"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></div>
								<?php endif; ?>	
								
								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="dt_item_title"><?php echo esc_html($title); ?></h5>
								<?php endif; ?>	
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="dt_item_content dt-mt-3"><?php echo esc_html($text); ?></div>
								<?php endif; ?>	
								
								<?php if ( ! empty( $link ) ) : ?>
									<div class="dt_item_readmore dt-mt-3"><a class="dt-btn-plustext" href="<?php echo esc_url($link); ?>"><span></span></a></div>
								<?php endif; ?>	
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>