<?php
/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'desert_softme_user_custom_style' ) ):
    function desert_softme_user_custom_style() {

		$softme_print_style = '';
		
		/*=========================================
		Slider 
		=========================================*/
		$softme_slider_top_anm_hs = get_theme_mod('softme_slider_top_anm_hs','1');
		$softme_slider_overlay 	= get_theme_mod('softme_slider_overlay','#000000');
		$softme_slider_opacity	= get_theme_mod('softme_slider_opacity','0.6');
		list($color1, $color2, $color3) = sscanf($softme_slider_overlay, "#%02x%02x%02x");
				$softme_print_style .=".dt_slider .dt_slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $softme_slider_opacity);
				}\n";
			
		if($softme_slider_top_anm_hs == '1'){	
			$softme_print_style .=".dt_slider .dt_slider-wrapper::before {
									content: '';
								}\n";
		}
		
		$softme_print_style .=".dt_service--one .dt_item_inner:before {
							background-image: url('".esc_url(desert_companion_plugin_url)."/inc/themes/softme/assets/images/service_card_bg.png');
						}.dt_feature--one::before {
							background: url('".esc_url(desert_companion_plugin_url)."/inc/themes/softme/assets/images/dot_bg_two.png') no-repeat 0 100% / auto;
						}.dt_slider .dt_slider-wrapper::before {
							background-image: url('".esc_url(desert_companion_plugin_url)."/inc/themes/softme/assets/images/banner/banner_top.png');
						}\n";
				
        wp_add_inline_style( 'softme-style', $softme_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'desert_softme_user_custom_style' );