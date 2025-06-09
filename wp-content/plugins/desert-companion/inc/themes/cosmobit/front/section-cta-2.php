<?php  
$cosmobit_cta2_options_hide_show= get_theme_mod('cosmobit_cta2_options_hide_show','1'); 
$cosmobit_cta2_text		= get_theme_mod('cosmobit_cta2_text','“Some of the History of Our Company is that We are Catching up through Video”'); 
$cosmobit_cta2_btn_lbl	= get_theme_mod('cosmobit_cta2_btn_lbl','Contact Us'); 
$cosmobit_cta2_btn_link	= get_theme_mod('cosmobit_cta2_btn_link','#'); 
$cosmobit_cta2_bg_img	= get_theme_mod('cosmobit_cta2_bg_img',esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/cta-two-bg.jpg')); 
if($cosmobit_cta2_options_hide_show=='1'):	
?>	
<section id="cta2_options" class="dt__cta dt__cta--two front1--cta2">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-md-12 dt-col-12">
				<div class="dt__cta-row" style="background-image: url('<?php echo esc_url($cosmobit_cta2_bg_img); ?>');">
					<div class="dt-row wow fadeInUp">
						<div class="dt-col-md-9 dt-col-12 dt-text-md-left dt-text-center dt-my-md-auto">
							<div class="dt__siteheading">
								<?php if(!empty($cosmobit_cta2_text)): ?>
									<h2 class="title"><?php echo wp_kses_post($cosmobit_cta2_text); ?></h2>
								<?php endif; ?>
							</div>
						</div>
						<div class="dt-col-md-3 dt-col-12 dt-text-md-right dt-text-center dt-my-md-auto dt-mt-md-auto dt-mt-4">
							<?php if(!empty($cosmobit_cta2_btn_lbl)): ?>
								<a href="<?php echo esc_url($cosmobit_cta2_btn_link); ?>" class="dt-btn dt-btn-white"><?php echo wp_kses_post($cosmobit_cta2_btn_lbl); ?></a>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>