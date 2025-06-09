<?php
/*
 *
 * Cosmobit Information 6 Default
 */
 function cosmobit_information6_options_default() {
	return apply_filters(
		'cosmobit_information6_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'           => ' fa-lightbulb-o',
					'title'           => esc_html__( 'Pixel Perfect', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information6_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img02.jpg'),
					'icon_value'           => 'fa-cart-arrow-down',
					'title'           => esc_html__( 'Ecommerce', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information6_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img03.jpg'),
					'icon_value'           => 'fa-line-chart',
					'title'           => esc_html__( 'SEO Friendly', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information6_003'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/service/img01.jpg'),
					'icon_value'           => 'fa-bar-chart',
					'title'           => esc_html__( 'Saving Money', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We always provide people a complete solution.', 'desert-companion' ),
					'text2'           => esc_html__( 'Read More', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'cosmobit_customizer_repeater_information6_004'					
				),
			)
		)
	);
}
