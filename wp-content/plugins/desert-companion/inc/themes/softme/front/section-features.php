<?php  
$softme_features_options_hide_show = get_theme_mod('softme_features_options_hide_show','1');
$softme_features_ttl	= get_theme_mod('softme_features_ttl','<b class="is_on">What We’re Offering</b><b>What We’re Offering</b><b>What We’re Offering</b>'); 
$softme_features_subttl	= get_theme_mod('softme_features_subttl','Dealing in all Professional IT </br><span>Services</span>'); 
$softme_features_text	= get_theme_mod('softme_features_text',"There are many variations of passages of available but majority have suffered alteration in some form, by humou or randomised words which don't look even slightly believable.");	
$softme_features_option = get_theme_mod('softme_features_option',softme_features_options_default());
if($softme_features_options_hide_show=='1'):
?>	
<section id="dt_feature" class="dt_feature dt_feature--one dt-py-default front-feature">
	<div class="dt-container">
		<div class="dt-row dt-mb-6">
			<?php if ( ! empty( $softme_features_ttl )  || ! empty( $softme_features_subttl )) : ?>
				<div class="dt-col-xl-6 dt-col-lg-6 dt-col-md-6 dt-col-12 dt-my-md-auto">
					<div class="dt_siteheading dt-text-md-left dt-text-center">
						<?php if ( ! empty( $softme_features_ttl ) ) : ?>
							<span class="subtitle">
								<span class="dt_heading dt_heading_8">
									<span class="dt_heading_inner">
										<?php echo wp_kses_post($softme_features_ttl); ?>
									</span>
								</span>
							</span>
						<?php endif; ?>	
						
						<?php if ( ! empty( $softme_features_subttl ) ) : ?>
							<h2 class="title">
								<?php echo wp_kses_post($softme_features_subttl); ?>
							</h2>
						<?php endif; ?>	
					</div>
				</div>
			<?php endif; ?>	
			<div class="dt-col-xl-6 dt-col-lg-6 dt-col-md-6 dt-col-12 dt-my-md-auto">
				<div class="dt_siteheading dt-text-md-left dt-text-center dt-pl-lg-6">
					<?php if ( ! empty( $softme_features_text ) ) : ?>
						<div class="text dt-mt-3 wow fadeInUp" data-wow-duration="1500ms">
							<p><?php echo wp_kses_post($softme_features_text); ?></p>
						</div>
					<?php endif; ?>	
				</div>
			</div>
		</div>
		<div class="dt-row dt-g-4">
			<div class="dt-col-lg-12 dt-col-sm-12 dt-col-12">
				<div class="dt_owl_carousel owl-theme owl-carousel" 
				data-owl-options='{
					"loop": false,
					"autoplay": false,
					"nav": false,
					"navText": ["<i class=\"fas fa-angle-left\"></i>","<i class=\"fas fa-angle-right\"></i>"],
					"dots": false,
					"margin": 0,
					"items": 1,
					"smartSpeed": 700,
					"responsive": {
						"0": {
							"margin": 0,
							"items": 1
						},
						"576": {
							"margin": 30,
							"items": 2
						},
						"768": {
							"margin": 30,
							"items": 3
						},
						"992": {
							"margin": 30,
							"items": 4
						},
						"1200": {
							"margin": 30,
							"items": 5 
						}
				}}'>
					<?php
						if ( ! empty( $softme_features_option ) ) {
							$allowed_html = array(
							'br'     => array(),
							'em'     => array(),
							'strong' => array(),
							'span' => array(),
							'b'      => array(),
							'i'      => array(),
							);
						$softme_features_option = json_decode( $softme_features_option );
						foreach ( $softme_features_option as $i=>$item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Features section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'softme_translate_single_string', $item->text, 'Features section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Features section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'Features section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Features section' ) : '';
					?>
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
									<div class="dt_item_icon dt-mb-4"><i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i></div>
								<?php endif; ?>	
								
								<?php if ( ! empty( $title ) ) : ?>
									<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
								<?php endif; ?>	
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="dt_item_content dt-mt-3"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
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