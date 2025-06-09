<?php
/*
 *
 * Cosmobit Header Contact Default
 */
 function cosmobit_get_header_contact_default() {
	return apply_filters(
		'cosmobit_get_header_contact_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-mobile',
					'title'           => esc_html__( '+123-456-7890', 'cosmobit-pro' ),
					'subtitle'            => esc_html__( 'Mon to Fri: 08:00 - 19:00', 'cosmobit-pro' ),
					'link'	  =>  esc_html__( 'tel:+123-456-7890', 'cosmobit-pro' ),
					'id'              => 'customizer_repeater_header_contact_001'					
				),
				array(
					'icon_value'       => 'fa-envelope-o',
					'title'           => esc_html__( 'info@gmail.com', 'cosmobit-pro' ),
					'subtitle'            => esc_html__( 'Get a free Estimate', 'cosmobit-pro' ),
					'link'	  =>  esc_html__( 'mailto:info@gmail.com', 'cosmobit-pro' ),
					'id'              => 'customizer_repeater_header_contact_002'
				),
				array(
					'icon_value'       => 'fa-map-marker',
					'title'           => esc_html__( 'No. 10, Rivon Building,', 'cosmobit-pro' ),
					'subtitle'            => esc_html__( 'California, TX 70240.', 'cosmobit-pro' ),
					'id'              => 'customizer_repeater_header_contact_003'
				),
			)
		)
	);
}

/*
 *
 * Slider 2 Default
 */
 function cosmobit_slider2_options_default() {
	return apply_filters(
		'cosmobit_slider2_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/slider/slider_bg.jpg'),
					'title'           => esc_html__( 'We Are Here', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Better Insights for', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Business.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Get Details', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'cosmobit_customizer_repeater_slider2_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one01.jpg'),
					'title'           => esc_html__( 'Best For Your Success', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Digital', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Marketing', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Our Services', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Get Details', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'cosmobit_customizer_repeater_slider2_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one03.jpg'),
					'title'           => esc_html__( 'Solve Problems, Change Lives', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Clear Thinking', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Bright Future!', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'button_second'	  =>  esc_html__( 'Get Details', 'desert-companion' ),
					'link2'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'cosmobit_customizer_repeater_slider2_003',
				),
			)
		)
	);
}



/*
 *
 * Cosmobit Information 2 Default
 */
 function cosmobit_information2_options_default() {
	return apply_filters(
		'cosmobit_information2_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/info_two01.png'),
					'title'           => esc_html__( 'Business Investment', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information2_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/info_two02.png'),
					'title'           => esc_html__( 'Target Market', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information2_002'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/info_two03.png'),
					'title'           => esc_html__( 'Saving Money', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information2_003'	
				)
			)
		)
	);
}



/*
 *
 * Service Default
 */
 function cosmobit_service2_options_default() {
	return apply_filters(
		'cosmobit_service2_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/monitoring.png'),
					'title'           => esc_html__( 'Strategy and Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service2_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/analytics.png'),
					'title'           => esc_html__( 'Corporate Finance', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service2_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/stock-market.png'),
					'title'           => esc_html__( 'Market Research', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service2_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/service/monitoring.png'),
					'title'           => esc_html__( 'Strategy and Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service2_004',
				)
			)
		)
	);
}