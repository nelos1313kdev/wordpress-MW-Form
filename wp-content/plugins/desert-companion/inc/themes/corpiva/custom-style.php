<?php
/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'desert_corpiva_user_custom_style' ) ):
    function desert_corpiva_user_custom_style() {

		$corpiva_print_style = '';
		
		/*=========================================
		Slider 
		=========================================*/
		$corpiva_slider_overlay 	= get_theme_mod('corpiva_slider_overlay','#000000');
		$corpiva_slider_opacity	= get_theme_mod('corpiva_slider_opacity','0.6');
		list($color1, $color2, $color3) = sscanf($corpiva_slider_overlay, "#%02x%02x%02x");
				$corpiva_print_style .=".dt_slider .dt_slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $corpiva_slider_opacity);
				}\n";	
				
        wp_add_inline_style( 'atua-style', $corpiva_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'desert_corpiva_user_custom_style' );