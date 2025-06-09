<?php
/*
 *
 * Social Icon
 */
function atua_get_social_icon_default() {
	return apply_filters(
		'atua_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-twitter', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-linkedin-in', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_004',
				)
			)
		)
	);
}

/*
 *
 * Slider Default
 */
 function atua_slider_options_default() {
	return apply_filters(
		'atua_slider_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one01.jpg'),
					'title'           => esc_html__( 'Welcome!', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Growing Your Business Today', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Make Business with', 'desert-companion' ),
					'subtitle3'         => esc_html__( 'Great Ideas.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'atua_customizer_repeater_slider_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one02.jpg'),
					'title'           => esc_html__( 'Welcome!', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Growing Your Business Today', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Launch Ultra', 'desert-companion' ),
					'subtitle3'         => esc_html__( 'Effective Businesss.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'atua_customizer_repeater_slider_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one03.jpg'),
					'title'           => esc_html__( 'Welcome!', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Growing Your Business Today', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Make Business with', 'desert-companion' ),
					'subtitle3'         => esc_html__( 'Next Level.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'atua_customizer_repeater_slider_003',
				),
			)
		)
	);
}


/*
 *
 * Atua Information Default
 */
 $desert_activated_theme = wp_get_theme(); // gets the current theme
if( 'Flexeo' == $desert_activated_theme->name){
 function atua_information_options_default() {
	return apply_filters(
		'atua_information_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Ecommerce', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_002'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-crown',
					'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_003'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Great Ideas', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_004'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-money-bill-wave-alt',
					'title'           => esc_html__( 'Save Money', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_005'	
				),
			)
		)
	);
}
}elseif( 'Altra' == $desert_activated_theme->name || 'Avvy' == $desert_activated_theme->name || 'Flexea' == $desert_activated_theme->name  || 'Atrux' == $desert_activated_theme->name || 'Fluxa' == $desert_activated_theme->name || 'Flexina' == $desert_activated_theme->name  || 'Flexiva' == $desert_activated_theme->name){
	function atua_information_options_default() {
		return apply_filters(
			'atua_information_options_default', json_encode(
					 array(
					array(
						'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
						'icon_value'       => 'fas fa-shield-alt',
						'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
						'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
						'link'            => '#',
						'id'              => 'atua_customizer_repeater_information_001'					
					),
					array(
						'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
						'icon_value'       => 'fas fa-shopping-cart',
						'title'           => esc_html__( 'Ecommerce Ready', 'desert-companion' ),
						'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
						'link'            => '#',
						'id'              => 'atua_customizer_repeater_information_002'	
					),
					array(
						'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
						'icon_value'       => 'fas fa-crown',
						'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
						'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
						'link'            => '#',
						'id'              => 'atua_customizer_repeater_information_003'	
					),
					array(
						'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
						'icon_value'       => 'fas fa-lightbulb',
						'title'           => esc_html__( 'Great Ideas', 'desert-companion' ),
						'text'	  =>  esc_html__( 'We always provide complete Solution.', 'desert-companion' ),
						'link'            => '#',
						'id'              => 'atua_customizer_repeater_information_004'					
					)
				)
			)
		);
	}
}else{
	function atua_information_options_default() {
	return apply_filters(
		'atua_information_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Ecommerce Ready', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_002'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'atua_customizer_repeater_information_003'	
				)
			)
		)
	);
}
}
/*
 *
 * Service Default
 */
 if( 'Altra' == $desert_activated_theme->name || 'Atus' == $desert_activated_theme->name){
	 function atua_service_options_default() {
	return apply_filters(
		'atua_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Online Security', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Website Audit', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Strategic Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_003',
				)
			)
		)
	);
}
 }else{
 function atua_service_options_default() {
	return apply_filters(
		'atua_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Online Security', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Website Audit', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Strategic Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-chart-line',
					'title'           => esc_html__( 'eCommerce Solution', 'desert-companion' ),
					'text'            => esc_html__( 'Your website should be your most effective sales tool, but most clients won’t even last a minute.', 'desert-companion' ),
					'text2'            => esc_html__( 'Read more', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_service_004',
				)
			)
		)
	);
}
}

/*
 *
 * Features Default
 */
 function atua_features_options_default() {
	return apply_filters(
		'atua_features_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-cubes',
					'title'           => esc_html__( 'Improvement', 'desert-companion' ),
					'text'            => esc_html__( 'All cash received from sales and from all other sources has to be carefully identified....', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_features_001',
				),
				array(
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Idea Generate', 'desert-companion' ),
					'text'            => esc_html__( 'All cash received from sales and from all other sources has to be carefully identified....', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_features_002',
				),
				array(
					'icon_value'       => 'fas fa-briefcase',
					'title'           => esc_html__( 'Consultancy', 'desert-companion' ),
					'text'            => esc_html__( 'All cash received from sales and from all other sources has to be carefully identified....', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_features_003',
				),
				array(
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Success Business', 'desert-companion' ),
					'text'            => esc_html__( 'All cash received from sales and from all other sources has to be carefully identified....', 'desert-companion' ),
					'id'              => 'atua_customizer_repeater_features_004',
				)
			)
		)
	);
}


/*=========================================
Atua Social Icon
=========================================*/
if ( ! function_exists( 'atua_site_social' ) ) :
function atua_site_social() {
	// Social 
	$atua_hs_hdr_social 	= get_theme_mod( 'atua_hs_hdr_social','1'); 
	$atua_hdr_social_title  = get_theme_mod( 'atua_hdr_social_title','Follow Us:');
	$atua_hdr_social 		= get_theme_mod( 'atua_hdr_social',atua_get_social_icon_default());	
	if($atua_hs_hdr_social=='1'): ?>
		<aside class="widget widget_social">
			<ul>
				<li><span class="ttl"><?php echo wp_kses_post($atua_hdr_social_title); ?></span></li>
				<?php
					$atua_hdr_social = json_decode($atua_hdr_social);
					if( $atua_hdr_social!='' )
					{
					foreach($atua_hdr_social as $item){	
					$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'atua_translate_single_string', $item->icon_value, 'Header section' ) : '';	
					$social_link = ! empty( $item->link ) ? apply_filters( 'atua_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a></li>
				<?php }} ?>
			</ul>
		</aside>  
	<?php endif;
} 
endif;
add_action( 'atua_site_social', 'atua_site_social' );	