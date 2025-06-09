<?php
/*
 *
 * Slider 5 Default
 */
 function cosmobit_slider5_options_default() {
	return apply_filters(
		'cosmobit_slider5_options_default', json_encode(
				 array(
				array(
					'image_url'       =>  esc_url(desert_companion_plugin_url . '/inc/themes/flexora/assets/images/slider/img01.jpg'),
					'title'           => esc_html__( 'Welcome To Our Cosmobit', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Learn at Your Own Pace, with', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Lifetime Access.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'cosmobit_customizer_repeater_slider5_001',
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
					'id'              => 'cosmobit_customizer_repeater_slider5_002',
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
					'id'              => 'cosmobit_customizer_repeater_slider5_003',
				),
			)
		)
	);
}

/*
 *
 * Cosmobit Information 7 Default
 */
 function cosmobit_information7_options_default() {
	return apply_filters(
		'cosmobit_information7_options_default', json_encode(
				 array(
				array(
					'icon_value'           => 'fa-lightbulb-o',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'title'           => esc_html__( 'Corporate Finance', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information7_001'					
				),
				array(
					'icon_value'           => 'fa-cart-arrow-down',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'title'           => esc_html__( 'Training services', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information7_002'
				),
				array(
					'icon_value'           => 'fa-bar-chart',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'title'           => esc_html__( 'Market Research', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information7_003'	
				),
				array(
					'icon_value'           => 'fa-headphones',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'title'           => esc_html__( 'Market Research', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon focused of any business.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information7_004'	
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