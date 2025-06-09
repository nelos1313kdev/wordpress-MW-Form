<?php
/*
 *
 * Slider 4 Default
 */
 function cosmobit_slider4_options_default() {
	return apply_filters(
		'cosmobit_slider4_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one01.jpg'),
					'title'           => esc_html__( 'Welcome To Cosmobit', 'desert-companion' ),
					'subtitle'         => esc_html__( 'The Right Candidate for your', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Business.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'cosmobit_customizer_repeater_slider4_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one02.jpg'),
					'title'           => esc_html__( 'Best Services Provide', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Fastest Way To Gain Business', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Success.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Our Services', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'cosmobit_customizer_repeater_slider4_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one03.jpg'),
					'title'           => esc_html__( 'Solve Problems, Change Lives', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Clear Thinking', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Bright Future!', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'cosmobit_customizer_repeater_slider4_003',
				),
			)
		)
	);
}

/*
 *
 * Cosmobit Information 4 Default
 */
 function cosmobit_information4_options_default() {
	return apply_filters(
		'cosmobit_information4_options_default', json_encode(
				 array(
				array(
					'icon_value'           => ' fa-lightbulb-o',
					'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information4_001'					
				),
				array(
					'icon_value'           => 'fa-cart-arrow-down',
					'title'           => esc_html__( 'Ecommerce Ready', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information4_002'
				),
				array(
					'icon_value'           => 'fa-bar-chart',
					'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information4_003'	
				)
			)
		)
	);
}


/*
 *
 * Cosmobit Funfact Default
 */
 function cosmobit_why_choose4_funfact_default() {
	return apply_filters(
		'cosmobit_why_choose4_funfact_default', json_encode(
				 array(
				array(
					'title'           => esc_html__( '35', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'           => esc_html__( 'Years of Foundation', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_why_choose4_funfact_001'				
				),
				array(
					'title'           => esc_html__( '65', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'           => esc_html__( 'Team Members', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_why_choose4_funfact_002'	
				),
				array(
					'title'           => esc_html__( '600', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'           => esc_html__( 'Cases Completed', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_why_choose4_funfact_003'
				)
			)
		)
	);
}


/*
 *
 * Service Default
 */
 function cosmobit_service3_options_default() {
	return apply_filters(
		'cosmobit_service3_options_default', json_encode(
				 array(
				array(
					'icon_value'           => 'fa-bar-chart',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'title'           => esc_html__( 'Strategy Planning', 'cosmobit-pro' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'cosmobit-pro' ),
					'text2'           => esc_html__( 'VIEW MORE', 'cosmobit-pro' ),
					'link'	  =>  esc_html__( '#', 'cosmobit-pro' ),
					'id'              => 'cosmobit_customizer_repeater_service3_001',
				),
				array(
					'icon_value'           => 'fa-tachometer',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'title'           => esc_html__( 'Corporate Finance', 'cosmobit-pro' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'cosmobit-pro' ),
					'text2'           => esc_html__( 'VIEW MORE', 'cosmobit-pro' ),
					'link'	  =>  esc_html__( '#', 'cosmobit-pro' ),
					'id'              => 'cosmobit_customizer_repeater_service3_002',
				),
				array(
					'icon_value'           => 'fa-money',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'title'           => esc_html__( 'Market Research', 'cosmobit-pro' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'cosmobit-pro' ),
					'text2'           => esc_html__( 'VIEW MORE', 'cosmobit-pro' ),
					'link'	  =>  esc_html__( '#', 'cosmobit-pro' ),
					'id'              => 'cosmobit_customizer_repeater_service3_003',
				)
			)
		)
	);
}
