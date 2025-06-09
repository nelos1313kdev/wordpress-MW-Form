<?php  
$corpiva_information_options_hide_show  = get_theme_mod('corpiva_information_options_hide_show','1');
$corpiva_information_option 			= get_theme_mod('corpiva_information_option',corpiva_information_options_default());
if($corpiva_information_options_hide_show=='1'):
?>
<section id="dt_information" class="dt_service dt_service--five dt-py-default front-info">
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<?php
				if ( ! empty( $corpiva_information_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$corpiva_information_option = json_decode( $corpiva_information_option );
				foreach ( $corpiva_information_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'corpiva_translate_single_string', $item->title, 'Information section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'corpiva_translate_single_string', $item->text, 'Information section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'Information section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'corpiva_translate_single_string', $item->icon_value, 'Information section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
					<div class="item-inner">
						<?php if ( ! empty( $icon ) ) : ?>
							<div class="item-icon">
								<div class="inner">
									<div class="clip">
										<i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i>
										<span class="icon2"><i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="item-content">
							<div class="item-meta">
								<div class="item-holder">
									<?php if ( ! empty( $title ) ) : ?>
										<h5 class="item-title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
									<?php endif; ?>
									<?php if ( ! empty( $text ) ) : ?>
										<div class="desc"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
									<?php endif; ?>							
								</div>
							</div>
						</div>
						<?php if ( ! empty( $link ) ) : ?>
							<a class="dt-more" href="<?php echo esc_url($link); ?>"><i class="fal fa-arrow-right" aria-hidden="true"></i></a>
						<?php endif; ?>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>