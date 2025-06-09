<?php  
	$cosmobit_information_options_hide_show	= get_theme_mod('cosmobit_information_options_hide_show','1'); 
	$cosmobit_information_option = get_theme_mod('cosmobit_information8_option',cosmobit_information6_options_default());
	if($cosmobit_information_options_hide_show=='1'):
?>	
<section id="information_options" class="dt__infoservices dt__infoservices--ten">
	<div class="dt-container">
		<div class="dt-row dt__infoservices-row dt-g-5 wow fadeInUp">
			<?php
				if ( ! empty( $cosmobit_information_option ) ) {
				$cosmobit_information_option = json_decode( $cosmobit_information_option );
				foreach ( $cosmobit_information_option as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Information section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'Information section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Information section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Information section' ) : '';
					$align = ! empty( $item->slide_align ) ? apply_filters( 'cosmobit_translate_single_string', $item->slide_align, 'Information section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'cosmobit_translate_single_string', $item->image_url, 'Information 6 section' ) : '';
			?>
			<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12">
				<div class="dt__infoservices-block">
					<div class="dt__infoservices-inner">
						<div class="dt__infoservices-icon">
							<?php if ( ! empty( $icon ) ) : ?>
								<span class="icon"><i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i></span>
							<?php endif; ?>	
						</div>
						
						<?php if ( ! empty( $title ) ) : ?>
							<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h5>
						<?php endif; ?>
					</div>
					<div class="contentbox">
						<div class="inner">
							<?php if ( ! empty( $image ) ) : ?>
								<div class="image">
									<img src="<?php echo esc_url($image); ?>" alt="">
								</div>
							<?php endif; ?>
							<div class="content">
								<?php if ( ! empty( $text ) ) : ?>
									<div class="text"><?php echo esc_html($text); ?></div>
								<?php endif; ?>
								<?php if ( ! empty( $link ) ) : ?>
								<a class="more-link" href="<?php echo esc_url($link); ?>">
									<i class="fa fa-angle-right"></i>
								</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>