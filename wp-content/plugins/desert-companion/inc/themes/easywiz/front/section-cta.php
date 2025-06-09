<?php 
$cosmobit_cta2_options_hide_show= get_theme_mod('cosmobit_cta2_options_hide_show','1'); 
$cosmobit_cta5_text		= get_theme_mod('cosmobit_cta5_text','Do you want Join with us? Please send your Resume'); 
$cosmobit_cta5_btn_lbl	= get_theme_mod('cosmobit_cta5_btn_lbl','Apply Now'); 
$cosmobit_cta5_btn_link	= get_theme_mod('cosmobit_cta5_btn_link','#'); 
$cosmobit_cta5_left_img	= get_theme_mod('cosmobit_cta5_left_img',esc_url(desert_companion_plugin_url . '/inc/themes/easywiz/assets/images/success-man-1.png')); 
if($cosmobit_cta2_options_hide_show=='1'):
?>
<section id="cta5_options" class="dt__cta dt__cta--four dt-py-default front5--cta">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-md-12 dt-col-12">
				<div class="dt__cta-row">
					<div class="dt-row wow fadeIn">
						<div class="dt-col-md-3 dt-col-12 dt-text-md-left dt-my-md-auto">
							<img src="<?php echo esc_url($cosmobit_cta5_left_img); ?>" title="" alt="">
						</div>
						<div class="dt-col-md-9 dt-col-12 dt-text-md-left dt-my-md-auto dt-mt-md-auto dt-mt-4">
							<?php if(!empty($cosmobit_cta5_text)): ?>
								<div class="dt__siteheading">
									<h2 class="title"><?php echo wp_kses_post($cosmobit_cta5_text); ?></h2>
								</div>
							<?php endif; ?>
							
							<?php if(!empty($cosmobit_cta5_btn_lbl)): ?>
								<a href="<?php echo esc_url($cosmobit_cta5_btn_link); ?>" class="dt-btn dt-btn-secondary dt-mt-3"><?php echo wp_kses_post($cosmobit_cta5_btn_lbl); ?></a>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<?php endif; ?>