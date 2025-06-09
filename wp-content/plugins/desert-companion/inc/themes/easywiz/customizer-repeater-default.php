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
 * Cosmobit Funfact Default
 */
 function cosmobit_funfact_options_default() {
	return apply_filters(
		'cosmobit_funfact_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-calendar',
					'title'           => esc_html__( '1995', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Year Founded', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_funfact_001'					
				),
				array(
					'icon_value'       => 'fa-users',
					'title'           => esc_html__( '65', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Team Members', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_funfact_002'		
				),
				array(
					'icon_value'       => 'fa-check-circle',
					'title'           => esc_html__( '1350', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Cases Completed', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_funfact_003'
				),
				array(
					'icon_value'       => 'fa-heart',
					'title'           => esc_html__( '100', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Happy Customers', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_funfact_004'
				)
			)
		)
	);
}