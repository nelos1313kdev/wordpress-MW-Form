<?php  
$softme_service_options_hide_show = get_theme_mod('softme_service_options_hide_show','1');
$softme_service_option    = get_theme_mod('softme_service_option',softme_service_options_default());
if($softme_service_options_hide_show=='1'):
?>
<section id="dt_service_two" class="dt_service dt_service--two front-service">
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<?php
				if ( ! empty( $softme_service_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$softme_service_option = json_decode( $softme_service_option );
				foreach ( $softme_service_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'softme_translate_single_string', $item->text, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Service section' ) : '';
			?>
				<div class="dt-col-lg-4 dt-col-sm-6 dt-col-12">
					<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
						<?php if ( ! empty( $image ) ) : ?>
							<div class="dt_item_image">
								<a href="<?php echo esc_url($link); ?>">
									<img src="<?php echo esc_url($image); ?>" alt="" title="" />
								</a>
							</div>
						<?php endif; ?>
						<div class="dt_item_holder">
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="dt_item_icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
							<?php endif; ?>
							
							<?php if ( ! empty( $text ) ) : ?>
								<p class="dt_item_text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>