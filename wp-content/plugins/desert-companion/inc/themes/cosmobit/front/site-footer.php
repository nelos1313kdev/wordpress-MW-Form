<?php 
/*=========================================
Cosmobit Footer Top
=========================================*/
if ( ! function_exists( 'cosmobit_footer_top' ) ) :
function cosmobit_footer_top() {
	$cosmobit_hs_footer_top		= get_theme_mod('cosmobit_hs_footer_top','1'); 
	$cosmobit_footer_top_info	= get_theme_mod('cosmobit_footer_top_info',cosmobit_get_footer_top_default());
	if ($cosmobit_hs_footer_top == '1'): ?>
		<div class="dt__footer-top">
			<div class="dt-container">
				<div class="dt-row dt-g-4">
					<?php
						if ( ! empty( $cosmobit_footer_top_info ) ) {
						$cosmobit_footer_top_info = json_decode( $cosmobit_footer_top_info );
						foreach ( $cosmobit_footer_top_info as $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'footer section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'cosmobit_translate_single_string', $item->text, 'footer section' ) : '';
							$choice = ! empty( $item->choice ) ? apply_filters( 'cosmobit_translate_single_string', $item->choice, 'footer section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'footer section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'footer section' ) : '';;
					?>
						<div class="dt-col-lg-6 dt-col-md-6">
							<aside class="widget widget_contact">
								<div class="contact__list">
									<?php if(!empty($icon)): ?>
										<i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
									<?php endif; ?>	
									<div class="contact__body">
										<?php if(!empty($title)): ?>
											<h6 class="title">
												<?php if(!empty($link)): ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>	
												<?php echo esc_html($title); ?>
												<?php if(!empty($link)): ?></a><?php endif; ?>	
											</h6>
										<?php endif; ?>	
										<?php if(!empty($text)): ?>
											<p class="description dt-mb-0"><?php echo esc_html($text); ?></p>
										<?php endif; ?>		
									</div>
								</div>
							</aside>
						</div>
					<?php }}?>
				</div>
			</div>
		</div>
	<?php endif;
	} 
endif;
add_action( 'cosmobit_footer_top', 'cosmobit_footer_top' );
?>