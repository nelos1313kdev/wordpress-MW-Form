<?php  
$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
$cosmobit_information2_option = get_theme_mod('cosmobit_information2_option',cosmobit_information2_options_default());
if($cosmobit_information_options_hide_show=='1'):
?>	
<section id="information2_options" class="dt__infoservices dt__infoservices--two">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-4 wow fadeInUp">
			<?php
				if ( ! empty( $cosmobit_information2_option ) ) {
				$cosmobit_information2_option = json_decode( $cosmobit_information2_option );
				foreach ( $cosmobit_information2_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information 2 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information 2 section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Information 2 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information 2 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Information 2 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information 2 section' ) : '';
			?>
				<div class="dt-col-lg-4 dt-col-md-6 dt-col-12">
					<div class="dt__infoservices-block">
						<div class="dt__infoservices-inner">
							<?php if ( ! empty( $image )  || ! empty( $icon )) : ?>
								<div class="dt__infoservices-icon">
									<?php if ( ! empty( $image ) ) : ?>
										<span class="icon"><img src="<?php echo esc_url($image); ?>"></span>
									<?php else: ?>
										<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>	
							
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>		
							
							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_url($link); ?>" class="more-link"><?php echo esc_html($button); ?> <i class="fa fa-arrow-right"></i></a>
							<?php endif; ?>		
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>