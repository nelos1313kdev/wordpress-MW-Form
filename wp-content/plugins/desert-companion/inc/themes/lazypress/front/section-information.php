<?php  
	$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
	$cosmobit_information7_option    = get_theme_mod('cosmobit_information7_option',cosmobit_information7_options_default());
	if($cosmobit_information_options_hide_show=='1'):
?>
<section id="information5_options" class="dt__infoservices dt__infoservices--seven front5--info dt-pb-default">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-4 wow fadeInUp">
			<div class="dt-col-12">
				<div class="dt__infoservices-carousel dt__nav-carousel owl-carousel owl-theme">
					<?php
						if ( ! empty( $cosmobit_information7_option ) ) {
						$cosmobit_information7_option = json_decode( $cosmobit_information7_option );
						foreach ( $cosmobit_information7_option as $index => $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information 6 section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information 6 section' ) : '';
							$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Information 6 section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information 6 section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information 6 section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Information 6 section' ) : '';
					?>
					<div class="dt__infoservices-block">
						<div class="dt__infoservices-inner">
							<div class="head">
								<?php if ( ! empty( $icon )) : ?>
									<div class="icon">
										<i class="fa <?php echo esc_attr($icon); ?>"></i>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><?php echo esc_html($title); ?></h5>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $text ) ) : ?>
							<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>
						</div>
						<div class="dt__infoservices-back">
							<div class="overlay" style="background-image: url(<?php echo esc_url($image); ?>);"> </div>
							<div class="head">
								<?php if ( ! empty( $icon )) : ?>
								<div class="icon">
									<i class="fa <?php echo esc_attr($icon); ?>"></i>
								</div>
								<?php endif; ?>
								<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><?php echo esc_html($title); ?></h5>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_url($link); ?>" class="link"><?php echo esc_html($button); ?> <svg enable-background="new 0 0 20 20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="m16 6-1.4 1.4 1.6 1.6h-16.2v2h16.2l-1.6 1.6 1.4 1.4 4-4z" fill="rgb(0,0,0)"></path></svg></a>
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