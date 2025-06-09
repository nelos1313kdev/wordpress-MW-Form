<?php
/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'desert_atua_user_custom_style' ) ):
    function desert_atua_user_custom_style() {

		$atua_print_style = '';
		
		/*=========================================
		Slider 
		=========================================*/
		$atua_slider_overlay 	= get_theme_mod('atua_slider_overlay','#000000');
		$atua_slider_opacity	= get_theme_mod('atua_slider_opacity','0.6');
		list($color1, $color2, $color3) = sscanf($atua_slider_overlay, "#%02x%02x%02x");
				$atua_print_style .=".dt_slider .dt_slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $atua_slider_opacity);
				}\n";
				
        wp_add_inline_style( 'atua-style', $atua_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'desert_atua_user_custom_style' );