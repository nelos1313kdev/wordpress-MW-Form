<?php
/*
 *
 * Social Icon
 */
function softme_get_social_icon_default() {
	return apply_filters(
		'softme_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-google-plus-g', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-twitter', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_005',
				)
			)
		)
	);
}

/*
 *
 * Slider Default
 */
 function softme_slider_options_default() {
	return apply_filters(
		'softme_slider_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/banner/banner-3.jpg'),
					'title'           => esc_html__( 'Welcome to best IT Solutions', 'desert-companion' ),
					'subtitle'         => esc_html__( 'IT Solutions & Services.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Learn More', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fas fa-play', 
					'link3'	  =>  esc_html__( 'https://youtu.be/MLpWrANjFbI', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'softme_customizer_repeater_slider_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/banner/banner-2.jpg'),
					'title'           => esc_html__( 'Experience the best IT Solution', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Provide IT Solutions & Services.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Learn More', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fas fa-play', 
					'link3'	  =>  esc_html__( 'https://youtu.be/MLpWrANjFbI', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'softme_customizer_repeater_slider_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one03.jpg'),
					'title'           => esc_html__( 'Experience the best IT Solutions', 'desert-companion' ),
					'subtitle'         => esc_html__( 'IT Solutions & Services.', 'desert-companion' ),
					'text'            => esc_html__( 'Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit Dui feugiat fusce conubia ridiculus tristique parturient sint occaecat non proident.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Learn More', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fas fa-play', 
					'link3'	  =>  esc_html__( 'https://youtu.be/MLpWrANjFbI', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'softme_customizer_repeater_slider_003',
				)
			)
		)
	);
}


/*
 *
 * SoftMe Information Default
 */
 function softme_information_options_default() {
	return apply_filters(
		'softme_information_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-laptop-house',
					'title'           => esc_html__( 'Quality Service', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Expert Team', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Excellent Support', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_003'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img04.jpg'),
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Management', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_004'	
				)
			)
		)
	);
}


/*
 *
 * SoftMe Information Default
 */
 function softme_information_options2_default() {
	return apply_filters(
		'softme_information_options2_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-laptop-house',
					'title'           => esc_html__( 'Quality Service', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_001'					
				),
				array(
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Expert Team', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_002'
				),
				array(
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Excellent Support', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_003'
				),
				array(
					'icon_value'       => 'fa fa-cart-arrow-down',
					'title'           => esc_html__( 'Ecommerce', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_004'	
				),
				array(
					'icon_value'       => 'fa fa-bar-chart',
					'title'           => esc_html__( 'Save Money', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_005'	
				),
				array(
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Management', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information2_006'	
				)
			)
		)
	);
}


/*
 *
 * SoftMe Information Default
 */
 function softme_information_options3_default() {
	return apply_filters(
		'softme_information_options3_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-laptop-house',
					'title'           => esc_html__( 'Quality Service', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_001'					
				),
				array(
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Expert Team', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_002'
				),
				array(
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Excellent Support', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_003'
				),
				array(
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Management', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'softme_customizer_repeater_information_004'	
				)
			)
		)
	);
}

/*
 *
 * Service Default
 */
 function softme_service_options_default() {
	return apply_filters(
		'softme_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Perfect solutions that business demands', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Reduced Spending with IT Talent Sourcing', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Access to Experts and the Latest Technology', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service_003',
				)
			)
		)
	);
}


/*
 *
 * Service Default
 */
 function softme_service_options2_default() {
	return apply_filters(
		'softme_service_options2_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Online Security', 'desert-companion' ),
					'text'           => esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.','desert-companion' ),
					'text2'           => esc_html__( 'Read More','desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service2_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Website Audit', 'desert-companion' ),
					'text'           => esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.','desert-companion' ),
					'text2'           => esc_html__( 'Read More','desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service2_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Strategic Planning', 'desert-companion' ),
					'text'           => esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.','desert-companion' ),
					'text2'           => esc_html__( 'Read More','desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service2_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-cart-arrow-down',
					'title'           => esc_html__( 'eCommerce Solution', 'desert-companion' ),
					'text'           => esc_html__( 'Sed perspe unde omnis natus sit voluptatem acc doloremue.','desert-companion' ),
					'text2'           => esc_html__( 'Read More','desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_service2_004',
				)
			)
		)
	);
}

/*
 *
 * Features Default
 */
 function softme_features_options_default() {
	return apply_filters(
		'softme_features_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img01.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Security </br>System', 'desert-companion' ),
					'text'            => esc_html__( 'Lorem Ipsum has been the industry text ever since then.', 'desert-companion' ),
					'link'              => '#',
					'id'              => 'softme_customizer_repeater_features_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img02.jpg'),
					'icon_value'       => 'fas fa-shield-alt',
					'title'           => esc_html__( 'Product </br>Development', 'desert-companion' ),
					'text'            => esc_html__( 'Lorem Ipsum has been the industry text ever since then.', 'desert-companion' ),
					'link'              => '#',
					'id'              => 'softme_customizer_repeater_features_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img03.jpg'),
					'icon_value'       => 'fas fa-laptop',
					'title'           => esc_html__( 'Digital </br>Marketing', 'desert-companion' ),
					'text'            => esc_html__( 'Lorem Ipsum has been the industry text ever since then.', 'desert-companion' ),
					'link'              => '#',
					'id'              => 'softme_customizer_repeater_features_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img04.jpg'),
					'icon_value'       => 'fa fa-chart-line',
					'title'           => esc_html__( 'UI/UX </br>Designing', 'desert-companion' ),
					'text'            => esc_html__( 'Lorem Ipsum has been the industry text ever since then.', 'desert-companion' ),
					'link'              => '#',
					'id'              => 'softme_customizer_repeater_features_004',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/softme/assets/images/service/img05.jpg'),
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Data </br>Analysis', 'desert-companion' ),
					'text'            => esc_html__( 'Lorem Ipsum has been the industry text ever since then.', 'desert-companion' ),
					'link'              => '#',
					'id'              => 'softme_customizer_repeater_features_005',
				)
			)
		)
	);
}


/*
 *
 * Protect Default
 */
 function softme_protect_options_default() {
	return apply_filters(
		'softme_protect_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-tv',
					'title'           => esc_html__( 'Product Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_001',
				),
				array(
					'icon_value'       => 'fas fa-trophy',
					'title'           => esc_html__( 'Security Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_002',
				),
				array(
					'icon_value'       => 'fas fa-lock',
					'title'           => esc_html__( 'Operational Security', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_003',
				),
				array(
					'icon_value'       => 'fas fa-mask',
					'title'           => esc_html__( 'Smarter Insights', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_004',
				),
				array(
					'icon_value'       => 'fas fa-magnet',
					'title'           => esc_html__( 'Supper Faster', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_005',
				),
				array(
					'icon_value'       => 'fas fa-laptop-code',
					'title'           => esc_html__( 'Developer Friendly', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_007',
				),
				array(
					'icon_value'       => 'fas fa-network-wired',
					'title'           => esc_html__( 'Organize Easily', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_006',
				),
				array(
					'icon_value'       => 'fas fa-paint-brush',
					'title'           => esc_html__( 'User Friendly Design', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'softme_customizer_repeater_protect_008',
				),
			)
		)
	);
}



/*=========================================
SoftMe Header Left Text
=========================================*/
if ( ! function_exists( 'softme_header_left_text' ) ) :
function softme_header_left_text() {
	$softme_hs_hdr_left_text 	= get_theme_mod( 'softme_hs_hdr_left_text','1'); 
	$softme_hdr_left_ttl  		= get_theme_mod( 'softme_hdr_left_ttl','Now Hiring:');
	$softme_hdr_left_text 		= get_theme_mod( 'softme_hdr_left_text','<b class="is_on">Welcome to IT Solutions & Services WordPress Theme</b><b>Are you passionate about first line IT support?</b>');
	if($softme_hs_hdr_left_text=='1'): ?>
		<aside class="widget widget_text left">
			<div class="widget_text_heading">
				<?php if(!empty($softme_hdr_left_ttl)): ?>
					<strong class="dt-mr-1"><?php echo wp_kses_post($softme_hdr_left_ttl); ?></strong>
				<?php endif; ?>
				
				<?php if(!empty($softme_hdr_left_text)): ?>
					<span class="dt_heading dt_heading_2">
						<span class="dt_heading_inner">
							<?php echo wp_kses_post($softme_hdr_left_text); ?>
						</span>
					</span>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'softme_header_left_text', 'softme_header_left_text' );


/*=========================================
SoftMe Header Email
=========================================*/
if ( ! function_exists( 'softme_header_email' ) ) :
function softme_header_email() {
	$softme_hs_hdr_email 	= get_theme_mod( 'softme_hs_hdr_email','1'); 
	$softme_hdr_email_icon 	= get_theme_mod( 'softme_hdr_email_icon','fas fa-envelope'); 
	$softme_hdr_email_title = get_theme_mod( 'softme_hdr_email_title','needhelp@company.com');
	$softme_hdr_email_link 	= get_theme_mod( 'softme_hdr_email_link','mailto:needhelp@company.com');
	if($softme_hs_hdr_email=='1'): ?>
		<aside class="widget widget_contact email">
			<div class="contact__list">
				<?php if(!empty($softme_hdr_email_icon)): ?>
					<i class="<?php echo esc_attr($softme_hdr_email_icon); ?>" aria-hidden="true"></i>  
				<?php endif; ?>
				
				<?php if(!empty($softme_hdr_email_title)): ?>	
					<div class="contact__body">
						<h6 class="title"><a href="<?php echo esc_url($softme_hdr_email_link); ?>"><?php echo wp_kses_post($softme_hdr_email_title); ?></a></h6>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'softme_header_email', 'softme_header_email' );


/*=========================================
SoftMe Header Address
=========================================*/
if ( ! function_exists( 'softme_header_address' ) ) :
function softme_header_address() {
	$softme_hs_hdr_top_ads 	= get_theme_mod( 'softme_hs_hdr_top_ads','1'); 
	$softme_hdr_top_ads_icon= get_theme_mod( 'softme_hdr_top_ads_icon','fas fa-map-marker-alt'); 
	$softme_hdr_top_ads_title = get_theme_mod( 'softme_hdr_top_ads_title','60 Golden Street, New York');
	$softme_hdr_top_ads_link = get_theme_mod( 'softme_hdr_top_ads_link');
	if($softme_hs_hdr_top_ads=='1'): ?>
		<aside class="widget widget_contact address">
			<div class="contact__list">
				<?php if(!empty($softme_hdr_top_ads_icon)): ?>
					<i class="<?php echo esc_attr($softme_hdr_top_ads_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>
				
				<?php if(!empty($softme_hdr_top_ads_title)): ?>
					<div class="contact__body">
						<?php if(!empty($softme_hdr_top_ads_title)): ?>
							<h6 class="title"><a href="<?php echo esc_url($softme_hdr_top_ads_link); ?>"><?php echo wp_kses_post($softme_hdr_top_ads_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($softme_hdr_top_ads_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'softme_header_address', 'softme_header_address' );

/*=========================================
SoftMe Social Icon
=========================================*/
if ( ! function_exists( 'softme_site_social' ) ) :
function softme_site_social() {
	// Social 
	$softme_hs_hdr_social 	= get_theme_mod( 'softme_hs_hdr_social','1'); 
	$softme_hdr_social 		= get_theme_mod( 'softme_hdr_social',softme_get_social_icon_default());
	if($softme_hs_hdr_social=='1'): ?>
		<aside class="widget widget_social">
			<ul>
				<?php
					$softme_hdr_social = json_decode($softme_hdr_social);
					if( $softme_hdr_social!='' )
					{
					foreach($softme_hdr_social as $item){	
					$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Header section' ) : '';	
					$social_link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a></li>
				<?php }} ?>
			</ul>
		</aside>
	<?php endif;
} 
endif;
add_action( 'softme_site_social', 'softme_site_social' );

/*=========================================
SoftMe Site Header
=========================================*/
if ( ! function_exists( 'softme_site_header' ) ) :
function softme_site_header() {
$softme_hs_hdr 	= get_theme_mod( 'softme_hs_hdr','1');
if($softme_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-5 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('softme_header_left_text'); ?>
					</div>
				</div>
				<div class="dt-col-lg-7 dt-col-12">
					<div class="widget--right dt-text-lg-right">    
						<?php  do_action('softme_header_email'); ?>
						<?php  do_action('softme_header_address'); ?>
						<?php  
							$desert_activated_theme = wp_get_theme(); // gets the current theme
							if('Softinn' !== $desert_activated_theme->name && 'SoftAlt' !== $desert_activated_theme->name){ do_action('softme_site_social'); } 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'softme_site_header', 'softme_site_header' );


/*=========================================
SoftMe Header Button
=========================================*/
if ( ! function_exists( 'softme_header_button' ) ) :
function softme_header_button() {
	$softme_hs_hdr_btn 		= get_theme_mod( 'softme_hs_hdr_btn','1'); 
	$softme_hdr_btn_icon 		= get_theme_mod( 'softme_hdr_btn_icon','fab fa-whatsapp'); 
	$softme_hdr_btn_lbl 		= get_theme_mod( 'softme_hdr_btn_lbl','+1 631 112 1134'); 
	$softme_hdr_btn_link 		= get_theme_mod( 'softme_hdr_btn_link'); 
	$softme_hdr_btn_target 		= get_theme_mod( 'softme_hdr_btn_target');
	if($softme_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($softme_hs_hdr_btn=='1'  && !empty($softme_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($softme_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary">
			<span class="dt-btn-text" data-text="<?php echo wp_kses_post($softme_hdr_btn_lbl); ?>"><i class="<?php echo esc_attr($softme_hdr_btn_icon); ?>"></i> <?php echo wp_kses_post($softme_hdr_btn_lbl); ?></span>
		</a>
	</li>
<?php else: 
$desert_activated_theme = wp_get_theme(); // gets the current theme
if( 'CozySoft' == $desert_activated_theme->name || 'Softinn' == $desert_activated_theme->name  || 'Suntech' == $desert_activated_theme->name){
?>	
<li class="dt_navbar-button-item"></li>
<?php } endif;
	} 
endif;
add_action( 'softme_header_button', 'softme_header_button' );

/*=========================================
SoftMe Header Contact
=========================================*/
if ( ! function_exists( 'softme_header_contact' ) ) :
function softme_header_contact() {
	$softme_hs_hdr_contact 		= get_theme_mod( 'softme_hs_hdr_contact','1'); 
	$softme_hdr_contact_icon 		= get_theme_mod( 'softme_hdr_contact_icon','fas fa-phone-volume'); 
	$softme_hdr_contact_ttl 		= get_theme_mod( 'softme_hdr_contact_ttl','Call Anytime'); 
	$softme_hdr_contact_txt 		= get_theme_mod( 'softme_hdr_contact_txt','<a href="tel:+8898006802">+ 88 ( 9800 ) 6802</a>'); 
	if($softme_hs_hdr_contact=='1'):	
?>
	<li class="dt_navbar-info-contact">
		<aside class="widget widget_contact">
			<div class="contact__list">
				<?php if(!empty($softme_hdr_contact_icon)): ?>
					<i class="<?php echo esc_attr($softme_hdr_contact_icon); ?>" aria-hidden="true"></i>
				<?php endif; ?>	
				<div class="contact__body one">
					<?php if(!empty($softme_hdr_contact_ttl)): ?>
						<h6 class="title"><?php echo wp_kses_post($softme_hdr_contact_ttl); ?></h6>
					<?php endif; ?>
					<?php if(!empty($softme_hdr_contact_txt)): ?>
						<p class="description"><?php echo wp_kses_post($softme_hdr_contact_txt); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</aside>
	</li>
<?php endif;
	} 
endif;
add_action( 'softme_header_contact', 'softme_header_contact' );


/*=========================================
SoftMe Header Contact
=========================================*/
if ( ! function_exists( 'softme_header_contact2' ) ) :
function softme_header_contact2() {
	$softme_hs_hdr_contact2 		= get_theme_mod( 'softme_hs_hdr_contact2','1'); 
	$softme_hdr_contact_icon2 		= get_theme_mod( 'softme_hdr_contact_icon2','fas fa-envelope'); 
	$softme_hdr_contact_ttl2 		= get_theme_mod( 'softme_hdr_contact_ttl2','Get a Estimate'); 
	$softme_hdr_contact_txt2 		= get_theme_mod( 'softme_hdr_contact_txt2','<a href="mailto:info@gmail.com">info@gmail.com</a>'); 
	if($softme_hs_hdr_contact2=='1'):	
?>
	<li class="dt_navbar-info-contact">
		<aside class="widget widget_contact">
			<div class="contact__list">
				<?php if(!empty($softme_hdr_contact_icon2)): ?>
					<i class="<?php echo esc_attr($softme_hdr_contact_icon2); ?>" aria-hidden="true"></i>
				<?php endif; ?>	
				<div class="contact__body two">
					<?php if(!empty($softme_hdr_contact_ttl2)): ?>
						<h6 class="title"><?php echo wp_kses_post($softme_hdr_contact_ttl2); ?></h6>
					<?php endif; ?>
					<?php if(!empty($softme_hdr_contact_txt2)): ?>
						<p class="description"><?php echo wp_kses_post($softme_hdr_contact_txt2); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</aside>
	</li>
<?php endif;
	} 
endif;
add_action( 'softme_header_contact2', 'softme_header_contact2' );


/*=========================================
SoftMe Header Contact
=========================================*/
if ( ! function_exists( 'softme_header_contact3' ) ) :
function softme_header_contact3() {
	$softme_hs_hdr_contact3 		= get_theme_mod( 'softme_hs_hdr_contact3','1'); 
	$softme_hdr_contact_icon3 		= get_theme_mod( 'softme_hdr_contact_icon3','fas fa-clock'); 
	$softme_hdr_contact_ttl3 		= get_theme_mod( 'softme_hdr_contact_ttl3','Monday - Friday'); 
	$softme_hdr_contact_txt3 		= get_theme_mod( 'softme_hdr_contact_txt3','10 am - 05 pm'); 
	if($softme_hs_hdr_contact3=='1'):	
?>
	<li class="dt_navbar-info-contact">
		<aside class="widget widget_contact">
			<div class="contact__list">
				<?php if(!empty($softme_hdr_contact_icon3)): ?>
					<i class="<?php echo esc_attr($softme_hdr_contact_icon3); ?>" aria-hidden="true"></i>
				<?php endif; ?>	
				<div class="contact__body three">
					<?php if(!empty($softme_hdr_contact_ttl3)): ?>
						<h6 class="title"><?php echo wp_kses_post($softme_hdr_contact_ttl3); ?></h6>
					<?php endif; ?>
					<?php if(!empty($softme_hdr_contact_txt3)): ?>
						<p class="description"><?php echo wp_kses_post($softme_hdr_contact_txt3); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</aside>
	</li>
<?php endif;
	} 
endif;
add_action( 'softme_header_contact3', 'softme_header_contact3' );