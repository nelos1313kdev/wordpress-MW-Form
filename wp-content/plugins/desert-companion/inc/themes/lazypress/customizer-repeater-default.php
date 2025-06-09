<?php
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
					'title'           => esc_html__( 'Strategy Planning', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'text2'           => esc_html__( 'VIEW MORE', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service3_001',
				),
				array(
					'icon_value'           => 'fa-tachometer',
					'title'           => esc_html__( 'Corporate Finance', 'desert-companion' ),
					'text'            => esc_html__( 'Quis autem veleum reprende voluptate veesse quam molestic onseq velillum dolorem', 'desert-companion' ),
					'text2'           => esc_html__( 'VIEW MORE', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'cosmobit_customizer_repeater_service3_002',
				),
				array(
					'icon_value'           => 'fa-money',
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