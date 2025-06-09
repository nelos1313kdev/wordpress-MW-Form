<?php  
$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
$cosmobit_information4_ttl		= get_theme_mod('cosmobit_information4_ttl','Modern Business'); 
$cosmobit_information4_subttl	= get_theme_mod('cosmobit_information4_subttl','Lets Take Your Experience'); 
$cosmobit_information4_text		= get_theme_mod('cosmobit_information4_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
$cosmobit_information4_option    = get_theme_mod('cosmobit_information4_option',cosmobit_information4_options_default());
if($cosmobit_information_options_hide_show=='1'):
?>	
<section id="information4_options" class="dt__infoservices dt__infoservices--four front4--info">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-5 wow fadeInUp">
			<?php
				if ( ! empty( $cosmobit_information4_option ) ) {
				$cosmobit_information4_option = json_decode( $cosmobit_information4_option );
				foreach ( $cosmobit_information4_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information 4 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information 4 section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Information 4 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information 4 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information 4 section' ) : '';
			?>
				<div class="dt-col-lg-4 dt-col-md-6 dt-col-12">
					<div class="dt__infoservices-block">
						<div class="dt__infoservices-inner">
							<?php if ( ! empty( $icon ) || ! empty( $title )) : ?>
								<div class="dt__infoservices-icon">
									<?php if ( ! empty( $icon )) : ?>
										<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
									<?php endif; ?>
									<?php if ( ! empty( $title ) ) : ?>
									<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<div class="dt__infoservices-content">
								<?php if ( ! empty( $icon )) : ?>
									<span class="icon icon--light"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
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
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>