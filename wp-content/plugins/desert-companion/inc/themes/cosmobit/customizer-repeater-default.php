<?php
/*
 *
 * Social Icon
 */
function cosmobit_get_social_icon_default() {
	return apply_filters(
		'cosmobit_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fa-facebook', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-google-plus', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-twitter', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-linkedin', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_004',
				)
			)
		)
	);
}


/*
 *
 * Cosmobit Footer Top Default
 */
 function cosmobit_get_footer_top_default() {
	return apply_filters(
		'cosmobit_get_footer_top_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-globe',
					'title'           => esc_html__( 'Become a Partner of Strike', 'desert-companion' ),
					'text'            => esc_html__( 'To take a trivial example, which of us undertakes laborious physical exercise.', 'desert-companion' ),
					'id'              => 'customizer_repeater_footer_top_001'					
				),
				array(
					'icon_value'       => 'fa-file-text-o',
					'title'           => esc_html__( 'Career Opportunities in Strike', 'desert-companion' ),
					'text'            => esc_html__( 'Who chooses to enjoy a pleasure that has no one annoying consequences.', 'desert-companion' ),
					'id'              => 'customizer_repeater_footer_top_002'	
				)
			)
		)
	);
}



/*
 *
 * Slider Default
 */
 function cosmobit_slider_options_default() {
	return apply_filters(
		'cosmobit_slider_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one01.jpg'),
					'title'           => esc_html__( 'We Are Here', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Better Insights for', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Business.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'cosmobit_customizer_repeater_slider_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one02.jpg'),
					'title'           => esc_html__( 'Best For Your Success', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Digital Marketing', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Agency', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Our Services', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'cosmobit_customizer_repeater_slider_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one03.jpg'),
					'title'           => esc_html__( 'We Are Here', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Better Insights for', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Business', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'cosmobit_customizer_repeater_slider_003',
				),
			)
		)
	);
}

/*
 *
 * Cosmobit Information Default
 */
 function cosmobit_information_options_default() {
	return apply_filters(
		'cosmobit_information_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-bar-chart',
					'title'           => esc_html__( 'Business Planning & Advice', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Build relationships and share your company values with well-crafted content tailored', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information_001'					
				),
				array(
					'icon_value'       => 'fa-line-chart',
					'title'           => esc_html__( 'Business Planning & Advice', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Build relationships and share your company values with well-crafted content tailored', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information_002'	
				),
				array(
					'icon_value'       => 'fa-lightbulb-o',
					'title'           => esc_html__( 'Business Planning & Advice', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Build relationships and share your company values with well-crafted content tailored', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information_003'	
				)
			)
		)
	);
}


/*
 *
 * Service Default
 */
 function cosmobit_service_options_default() {
	return apply_filters(
		'cosmobit_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'image_url2'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/monitoring.png'),
					'title'           => esc_html__( 'Strategy and Planning', 'desert-companion' ),
					'text'            => esc_html__( 'How To Creat a Great Company With Strategy and Planning I must explain..', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'image_url2'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/analytics.png'),
					'title'           => esc_html__( 'Corporate Finance', 'desert-companion' ),
					'text'            => esc_html__( 'How To Creat a Great Company With Strategy and Planning I must explain..', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'image_url2'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/stock-market.png'),
					'title'           => esc_html__( 'Market Research', 'desert-companion' ),
					'text'            => esc_html__( 'How To Creat a Great Company With Strategy and Planning I must explain..', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service_003',
				)
			)
		)
	);
}