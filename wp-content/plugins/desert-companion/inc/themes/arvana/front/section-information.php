<?php  
$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
$cosmobit_information4_ttl		= get_theme_mod('cosmobit_information4_ttl','Modern Business'); 
$cosmobit_information4_subttl	= get_theme_mod('cosmobit_information4_subttl','Lets Take Your Experience'); 
$cosmobit_information4_text		= get_theme_mod('cosmobit_information4_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
$cosmobit_information6_option    = get_theme_mod('cosmobit_information6_option',cosmobit_information6_options_default());
if($cosmobit_information_options_hide_show=='1'):
?>
<section id="information4_options" class="dt__infoservices dt__infoservices--eight front4--info">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-5 wow fadeInUp">
			<?php
				if ( ! empty( $cosmobit_information6_option ) ) {
				$cosmobit_information6_option = json_decode( $cosmobit_information6_option );
				foreach ( $cosmobit_information6_option as $index => $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information 6 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information 6 section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'cosmobit_translate_single_string', $item->text2, 'Information 6 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information 6 section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information 6 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Information 6 section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12">
					<div class="dt__infoservices-block">						
						<div class="overlay" style="background-image: url(<?php echo esc_url($image); ?>);"> </div>
						<div class="dt__infoservices-inner">
							<?php if ( ! empty( $icon )) : ?>
								<div class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>
							<?php if ( ! empty( $title ) ) : ?>
							<h5 class="title"><?php echo esc_html($title); ?></h5>
							<?php endif; ?>
						</div>
						<div class="dt__infoservices-back">
							<?php if ( ! empty( $icon )) : ?>
								<div class="icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
							<?php endif; ?>

							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
							<?php endif; ?>

							<?php if ( ! empty( $text ) ) : ?>
								<div class="text"><?php echo esc_html($text); ?></div>
							<?php endif; ?>

							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_url($link); ?>" class="dt-btn dt-btn-white"><?php echo esc_html($button); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>