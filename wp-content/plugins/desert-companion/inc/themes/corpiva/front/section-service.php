<?php  
$corpiva_service_options_hide_show  = get_theme_mod('corpiva_service_options_hide_show','1');
$corpiva_service_ttl		  = get_theme_mod('corpiva_service_ttl','What We Do For You'); 
$corpiva_service_subttl	  	  = get_theme_mod('corpiva_service_subttl','We can inspire and Offer Different Services'); 
$corpiva_service_btn_lbl	  = get_theme_mod('corpiva_service_btn_lbl','See All Service');	
$corpiva_service_btn_url	  = get_theme_mod('corpiva_service_btn_url','#');
$corpiva_service_option    	  = get_theme_mod('corpiva_service_option',corpiva_service_options_default());
do_action('corpiva_service_option_before');
if($corpiva_service_options_hide_show=='1'):
?>
<section id="dt_service" class="dt_service dt_service--two dt-py-default front-services" data-background="<?php echo esc_url(desert_companion_plugin_url);?>/inc/themes/corpiva/assets/images/services_bg.jpg">
	<div class="dt-container">
		<div class="dt-row align-items-center dt-mb-6">
			<div class="dt-col-lg-6 dt-col-md-8">
				<?php if ( ! empty( $corpiva_service_ttl )  || ! empty( $corpiva_service_subttl )) : ?>
					<div class="section-title animation-style3">
						<?php if ( ! empty( $corpiva_service_ttl ) ) : ?>
							<span class="sub-title"><?php echo wp_kses_post($corpiva_service_ttl); ?></span>
						<?php endif; ?>	
						
						<?php if ( ! empty( $corpiva_service_subttl ) ) : ?>
							<h2 class="title dt-element-title"><?php echo wp_kses_post($corpiva_service_subttl); ?></h2>
						<?php endif; ?>	
					</div>
				<?php endif; ?>	
			</div>
			<div class="dt-col-lg-6 dt-col-md-4">
				<div class="view-all-btn dt-text-lg-right dt-text-center dt-mt-3">
					<?php if ( ! empty( $corpiva_service_btn_lbl ) ) : ?>
						<a href="<?php echo esc_url($corpiva_service_btn_url); ?>" class="dt-btn dt-btn-primary"><?php echo wp_kses_post($corpiva_service_btn_lbl); ?></a>
					<?php endif; ?>	
				</div>
			</div>
		</div>
		<div class="dt-row dt-g-4 justify-content-center">
			<?php
				if ( ! empty( $corpiva_service_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$corpiva_service_option = json_decode( $corpiva_service_option );
				foreach ( $corpiva_service_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'corpiva_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'corpiva_translate_single_string', $item->text, 'Service section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'corpiva_translate_single_string', $item->text2, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'corpiva_translate_single_string', $item->image_url, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'corpiva_translate_single_string', $item->icon_value, 'Service section' ) : '';
			?>
				<div class="dt-col-xl-3 dt-col-lg-4 dt-col-md-6 dt-col-sm-8">
					<div class="services-item">
						<?php if ( ! empty( $image ) ) : ?>
							<div class="services-image" style="background-image: url(<?php echo esc_url($image); ?>);"></div>
						<?php endif; ?>
						
						<?php if ( ! empty( $icon ) ) : ?>
							<div class="services-icon">
								<i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i>
							</div>
						<?php endif; ?>
						
						<div class="services-content">
							<?php if ( ! empty( $title ) ) : ?>
								<?php if ( ! empty( $link ) ) : ?>
									<h5 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
								<?php else: ?>	
									<h5 class="title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
								<?php endif; ?>
							<?php endif; ?>
							
							<?php if ( ! empty( $text ) ) : ?>
								<p><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
							<?php endif; ?>
							
							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_url($link); ?>" class="link-btn"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?> <i aria-hidden="true" class="far fa-long-arrow-right"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>
<?php do_action('corpiva_service_option_after'); ?>