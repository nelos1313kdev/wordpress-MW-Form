<?php  
$cosmobit_cta2_options_hide_show= get_theme_mod('cosmobit_cta2_options_hide_show','1'); 
$cosmobit_cta3_text		= get_theme_mod('cosmobit_cta3_text','“Some of the History of Our Company is that We are Catching up through Video”'); 
$cosmobit_cta3_btn_lbl		= get_theme_mod('cosmobit_cta3_btn_lbl','Get An Appoinment'); 
$cosmobit_cta3_btn_link		= get_theme_mod('cosmobit_cta3_btn_link','#'); 
$cosmobit_cta3_bg_img	= get_theme_mod('cosmobit_cta3_bg_img',esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/cta-two-bg.jpg')); 
if($cosmobit_cta2_options_hide_show=='1'):
?>	
<section id="cta3_options" class="dt__cta dt__cta--three bg-gray-high front2--cta">
	<div class="svg--shape bottom" data-negative="false">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
			<path class="svg--shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
		</svg>
	</div>
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-md-12 dt-col-12">
				<div class="dt__cta-row" style="background-image: url('<?php echo esc_url($cosmobit_cta3_bg_img); ?>');">
					<div class="dt-row wow fadeInUp">
						<?php if(!empty($cosmobit_cta3_text)): ?>
							<div class="dt-col-md-12 dt-col-12 dt-text-md-center dt-text-center">
								<div class="dt__siteheading">
									<h2 class="title"><?php echo wp_kses_post($cosmobit_cta3_text); ?></h2>
								</div>
							</div>
						<?php endif; ?>
						<?php if(!empty($cosmobit_cta3_btn_lbl)): ?>
							<div class="dt-col-md-12 dt-col-12 dt-text-md-center dt-text-center dt-mt-4 btn-dt ">
								<a href="<?php echo esc_url($cosmobit_cta3_btn_link); ?>" class="dt-btn dt-btn-primary"><?php echo wp_kses_post($cosmobit_cta3_btn_lbl); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>