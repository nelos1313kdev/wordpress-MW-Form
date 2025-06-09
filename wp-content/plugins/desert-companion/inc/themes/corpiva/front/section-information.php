<?php  
$corpiva_information_options_hide_show  = get_theme_mod('corpiva_information_options_hide_show','1');
$corpiva_information_option 			= get_theme_mod('corpiva_information_option',corpiva_information_options_default());
if($corpiva_information_options_hide_show=='1'):
?>
<section id="dt_information" class="dt_service dt_service--one dt-py-default front-info">
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
						<div class="overlay"></div>
						<div class="item-content">
							<span class="number-wrap">
								<span class="number">/ <?php echo esc_html($i+1); ?></span>
								<span class="number-hover">/ <?php echo esc_html($i+1); ?></span>
							</span>
							<?php if ( ! empty( $icon ) ) : ?>
								<span aria-hidden="true" class="item-icon <?php echo esc_attr($icon); ?>"></span>
							<?php endif; ?>
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="item-title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
							<?php endif; ?>
							<div class="item-content-inner">
								<?php if ( ! empty( $text ) ) : ?>
									<div class="desc"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
								<?php endif; ?>
								
								<?php if ( ! empty( $link ) ) : ?>
									<a class="dt-more" href="<?php echo esc_url($link); ?>"><i class="fal fa-arrow-right" aria-hidden="true"></i></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>