<?php  
$atua_information_options_hide_show = get_theme_mod('atua_information_options_hide_show','1');
$atua_information_option = get_theme_mod('atua_information_option',atua_information_options_default());
if($atua_information_options_hide_show=='1'):	
?>
<section id="dt_service_one" class="dt_service dt_service--twelve dt-py-default front-info">
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
					<div class="dt-col-lg-3 dt-col-md-6 dt-col-12">
						<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
							
							<div class="dt_item_hover">
								<?php if ( ! empty( $icon ) ) : ?>
								<div class="dt_item_icon">
									<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
								</div>
								<?php endif; ?>
								
								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
								<?php endif; ?>
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="dt_item_content"><?php echo esc_html($text); ?></div>
								<?php endif; ?>
							</div>
							
							<div class="dt_item_holder"<?php if ( ! empty( $image ) ) : ?> style="background-image: url(<?php echo esc_url($image); ?>);"<?php endif; ?>>
								<?php if ( ! empty( $icon ) ) : ?>
								<div class="dt_item_icon">
									<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
								</div>
								<?php endif; ?>

								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
								<?php endif; ?>
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="dt_item_content"><?php echo esc_html($text); ?></div>
								<?php endif; ?>
								
								<?php if ( ! empty( $link ) ) : ?>
									<div class="dt_item_readmore dt-mt-3"><a class="dt-btn-plustext" href="<?php echo esc_url($link); ?>"><span></span></a></div>
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