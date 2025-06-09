<?php 
/*=========================================
Cosmobit  Header Contact Details
=========================================*/
if ( ! function_exists( 'cosmobit_site_header_contact_details' ) ) :
function cosmobit_site_header_contact_details() {
$cosmobit_hs_hdr_contact_details = get_theme_mod( 'cosmobit_hs_hdr_contact_details','1');
$cosmobit_hdr_contact_details = get_theme_mod( 'cosmobit_hdr_contact_details',cosmobit_get_header_contact_default());
if($cosmobit_hs_hdr_contact_details=='1'): ?>
	<div class="dt__navbar-right">
		<ul class="dt__navbar-list-right">
			<li class="dt__navbar-listwidget">
				<aside class="widget widget_contact">
					<?php
						if ( ! empty( $cosmobit_hdr_contact_details ) ) {
						$cosmobit_hdr_contact_details = json_decode( $cosmobit_hdr_contact_details );
						foreach ( $cosmobit_hdr_contact_details as $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'cosmobit_translate_single_string', $item->title, 'Header section' ) : '';
							$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'cosmobit_translate_single_string', $item->subtitle, 'Header section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'cosmobit_translate_single_string', $item->icon_value, 'Header section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'cosmobit_translate_single_string', $item->link, 'Header section' ) : '';
					?>
					<div class="contact__list">
						<?php if(!empty($icon)): ?>
							<i class="fa <?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
						<?php endif; ?>	
						<div class="contact__body">
							<?php if(!empty($title)): ?>
								<h6 class="title"><a href="<?php echo esc_url($link); ?>">	<?php echo esc_html($title); ?></a></h6>
							<?php endif; ?>	
							<?php if(!empty($subtitle)): ?>
								<p class="description dt-mb-0"><?php echo esc_html($subtitle); ?></p>
							<?php endif; ?>		
						</div>
					</div>
						<?php } } ?>
				</aside>
			</li>
		</ul>
	</div>
<?php endif;
	} 
endif;
add_action( 'cosmobit_site_header_contact_details', 'cosmobit_site_header_contact_details' );