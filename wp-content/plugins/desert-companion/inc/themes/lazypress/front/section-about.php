<?php   
$cosmobit_about_options_hide_show	= get_theme_mod('cosmobit_about_options_hide_show','1');
$cosmobit_about5_left_img		= get_theme_mod('cosmobit_about5_left_img',esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/what-we-do.jpg')); 
$cosmobit_about5_right_ttl		= get_theme_mod('cosmobit_about5_right_ttl','About Us'); 
$cosmobit_about5_right_subttl	= get_theme_mod('cosmobit_about5_right_subttl','One Of The Fastest Way To Gain Business Success'); 
$cosmobit_about5_right_text		= get_theme_mod('cosmobit_about5_right_text','Proin viverra posuere varius lorem nisi. Egestas odio urna sed in accumsan curabitur. Fringilla magna sed orci, et sit sapien nunc non vel. Quam elit non sed mus amet, tortor ullamcorper. Ligula eu malesuada pellentesque nec tincidunt. Ut pharetra dolor nulla. Ut enim ad minim veniam.<br><br>
                                    You need to be sure there isn’t anything embarrassing hidden in the middle of text. All the lorem generators on the Internet.'); 
$cosmobit_about5_right_content	= get_theme_mod('cosmobit_about5_right_content','<div class="dt__about-feature-classic">
                                    <ul class="business-list">
                                        <li>Product Engineering</li>
                                        <li>IT Consultancy</li>
                                        <li>Digital Services</li>
                                        <li>100% Security</li>
                                        <li>Varius lacus vel donec in</li>
                                        <li>Scelerisque venenatis</li>
                                    </ul>
                                </div>
                                <a href="#" class="dt-btn dt-btn-primary dt-mt-5">Discover More</a>');
if($cosmobit_about_options_hide_show=='1'):								
?>
<section id="about5_options" class="dt__about dt__about--four dt-py-default front5--about">
	<div class="dt__floating dt__floating--two"><img src="<?php echo esc_url(desert_companion_plugin_url); ?>/inc/themes/lazypress/assets/images/shapeline02.png" alt=""></div>
	<div class="dt-container">
		<div class="dt-row dt-g-5 wow fadeInUp">
			<div class="dt-col-lg-6 dt-col-md-12 dt-col-sm-12 tilter">
				<div class="dt__about-img tilter__figure">
					<?php if(!empty($cosmobit_about5_left_img)): ?>
						<img src="<?php echo esc_url($cosmobit_about5_left_img); ?>" class="tilter__image" alt="">
					<?php endif; ?>
				</div>
			</div>
			<div class="dt-col-lg-6 dt-col-md-12 dt-col-sm-12">
				<div class="dt__about-content">
					<div class="dt__siteheading">
						<?php if(!empty($cosmobit_about5_right_ttl)): ?>
							<div class="subtitle"><?php echo wp_kses_post($cosmobit_about5_right_ttl); ?></div>
						<?php endif; ?>
						
						<?php if(!empty($cosmobit_about5_right_subttl)): ?>
							<h2 class="title"><?php echo wp_kses_post($cosmobit_about5_right_subttl); ?></h2>
						<?php endif; ?>
						
						<?php if(!empty($cosmobit_about5_right_text)): ?>
							<div class="text">
								<?php echo wp_kses_post($cosmobit_about5_right_text); ?>
							</div>
						<?php endif; ?>
						<?php if(!empty($cosmobit_about5_right_content)): ?>
							<?php echo do_shortcode($cosmobit_about5_right_content); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>                    
		</div>
	</div>
</section>
<?php endif; ?>