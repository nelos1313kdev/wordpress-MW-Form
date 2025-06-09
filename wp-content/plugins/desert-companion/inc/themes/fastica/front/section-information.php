<?php  
	$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
	$cosmobit_information3_ttl		= get_theme_mod('cosmobit_information3_ttl','Managed Services'); 
	$cosmobit_information3_subttl	= get_theme_mod('cosmobit_information3_subttl','More than 30+ years we provide business consulting'); 
	$cosmobit_information3_text		= get_theme_mod('cosmobit_information3_text','We always provide people a complete solution upon.'); 
	$cosmobit_information3_option    = get_theme_mod('cosmobit_information3_option',cosmobit_information3_options_default());
	if($cosmobit_information_options_hide_show=='1'):
?>
<section id="information3_options" class="dt__infoservices dt__infoservices--five front3--info">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-4 wow fadeInUp">
			<?php
				if ( ! empty( $cosmobit_information3_option ) ) {
				$cosmobit_information3_option = json_decode( $cosmobit_information3_option );
				foreach ( $cosmobit_information3_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information 3 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information 3 section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Information 3 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information 3 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information 3 section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-md-6 dt-col-12">
					<div class="dt__infoservices-block">
						<div class="dt__infoservices-inner">
							<div class="pattern">
                                <span class="pattern1"></span>
                                <span class="pattern2"></span>
                            </div>
							<?php if ( ! empty( $icon )) : ?>
								<div class="dt__infoservices-icon">
									<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>								
								</div>
							<?php endif; ?>
							
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><?php echo esc_html($title); ?></h5>
							<?php endif; ?>

							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>
						</div>
						<div class="dt__infoservices-back">
							<?php if ( ! empty( $icon )) : ?>
								<div class="dt__infoservices-icon">
									<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>								
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>								
							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $button ) ) : ?>
								<div class="link"><a href="<?php echo esc_url($link); ?>" class="more-link"><i class="fa fa-arrow-right"></i></a></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>