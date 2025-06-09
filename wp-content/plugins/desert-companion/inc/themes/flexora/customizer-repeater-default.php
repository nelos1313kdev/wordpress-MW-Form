<?php
/*
 *
 * Slider 3 Default
 */
 function cosmobit_slider3_options_default() {
	return apply_filters(
		'cosmobit_slider3_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/flexora/assets/images/slider/img01.jpg'),
					'title'           => esc_html__( 'Welcome To Cosmobit', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Your Investments in', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Safe Hands.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Free Consultation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'cosmobit_customizer_repeater_slider3_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/slider/slider_one02.jpg'),
					'title'           => esc_html__( 'We Are Here', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Future Investments for', 'desert-companion' ),
					'subtitle2'         => esc_html__( 'Your Future.', 'desert-companion' ),
					'text'            => esc_html__( 'We create and build flexible & creative design in your budget. Helping your get increase sales.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Our Services', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'cosmobit_customizer_repeater_slider3_002',
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
					'id'              => 'cosmobit_customizer_repeater_slider3_003',
				),
			)
		)
	);
}


/*
 *
 * Cosmobit Information 3 Default
 */
 function cosmobit_information3_options_default() {
	return apply_filters(
		'cosmobit_information3_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'           => ' fa-lightbulb-o',
					'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information3_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'           => 'fa-cart-arrow-down',
					'title'           => esc_html__( 'Ecommerce Ready', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information3_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'           => 'fa-bar-chart',
					'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information3_003'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'           => 'fa-headphones',
					'title'           => esc_html__( 'Supports', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution upon.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information3_004'	
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
					'title'           => esc_html__( 'Strategy Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'text2'           => esc_html__( 'VIEW MORE', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service3_001',
				),
				array(
					'icon_value'           => 'fa-tachometer',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'title'           => esc_html__( 'Corporate Finance', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'text2'           => esc_html__( 'VIEW MORE', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service3_002',
				),
				array(
					'icon_value'           => 'fa-money',
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'title'           => esc_html__( 'Market Research', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'text2'           => esc_html__( 'VIEW MORE', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service3_003',
				)
			)
		)
	);
}