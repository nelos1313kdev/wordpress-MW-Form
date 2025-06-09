<?php
/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'desert_cosmobit_user_custom_style' ) ):
    function desert_cosmobit_user_custom_style() {

		$cosmobit_print_style = '';
		
		/*=========================================
		Slider 
		=========================================*/
		$cosmobit_slider_overlay 	= get_theme_mod('cosmobit_slider_overlay','#000000');
		$cosmobit_slider_opacity	= get_theme_mod('cosmobit_slider_opacity','0.5');
		list($color1, $color2, $color3) = sscanf($cosmobit_slider_overlay, "#%02x%02x%02x");
				$cosmobit_print_style .=".dt__slider.dt__slider--one .dt__slider-wrapper, .dt__slider.dt__slider--three .dt__slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $cosmobit_slider_opacity) !important;
				}\n";		
		
		/*=========================================
		Slider 2
		=========================================*/
		$cosmobit_slider2_overlay 	= get_theme_mod('cosmobit_slider2_overlay','#000000');
		$cosmobit_slider2_opacity	= get_theme_mod('cosmobit_slider2_opacity','0.5');
		list($color1, $color2, $color3) = sscanf($cosmobit_slider2_overlay, "#%02x%02x%02x");
				$cosmobit_print_style .=".dt__slider.dt__slider--two .dt__slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $cosmobit_slider2_opacity);
				}\n";
		
		/*=========================================
		Slider 3
		=========================================*/
		$cosmobit_slider3_overlay 	= get_theme_mod('cosmobit_slider3_overlay','#000000');
		$cosmobit_slider3_opacity	= get_theme_mod('cosmobit_slider3_opacity','0.65');
		list($color1, $color2, $color3) = sscanf($cosmobit_slider3_overlay, "#%02x%02x%02x");
				$cosmobit_print_style .=".dt__slider.dt__slider--three .dt__slider-wrapper, .dt__slider.dt__slider--seven .dt__slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $cosmobit_slider3_opacity);
				}\n";
				
		/*=========================================
		Slider 4
		=========================================*/
		$cosmobit_slider4_overlay 	= get_theme_mod('cosmobit_slider4_overlay','#000000');
		$cosmobit_slider4_opacity	= get_theme_mod('cosmobit_slider4_opacity','0.5');
		list($color1, $color2, $color3) = sscanf($cosmobit_slider4_overlay, "#%02x%02x%02x");
				$cosmobit_print_style .=".dt__slider.dt__slider--four .dt__slider-wrapper, .dt__slider.dt__slider--six .dt__slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $cosmobit_slider4_opacity);
				}\n";	
		
		/*=========================================
		Slider 5
		=========================================*/
		$cosmobit_slider5_overlay 	= get_theme_mod('cosmobit_slider5_overlay','#000000');
		$cosmobit_slider5_opacity	= get_theme_mod('cosmobit_slider5_opacity','0.7');
		list($color1, $color2, $color3) = sscanf($cosmobit_slider5_overlay, "#%02x%02x%02x");
				$cosmobit_print_style .=".dt__slider.dt__slider--five .dt__slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $cosmobit_slider5_opacity);
				}\n";
				
		/*=========================================
		CTA 2
		=========================================*/
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		 if( 'Flexora' == $desert_activated_theme->name){
			 $cta2_default_color='#03c2f6';
		 }else{
			 $cta2_default_color='#f31717';
		 } 
		$cosmobit_cta2_opacity	= get_theme_mod('cosmobit_cta2_opacity','0.85'); 
		$cosmobit_cta2_overlay	= get_theme_mod('cosmobit_cta2_overlay',$cta2_default_color); 
				$cosmobit_print_style .=".dt__cta--two .dt__cta-row:before {
					    background-color: " .esc_attr($cosmobit_cta2_overlay). ";
						opacity: " .esc_attr($cosmobit_cta2_opacity). ";
				}\n";
		
		/*=========================================
		CTA
		=========================================*/
		$cosmobit_cta3_opacity	= get_theme_mod('cosmobit_cta3_opacity','0.85'); 
		$cosmobit_cta3_overlay	= get_theme_mod('cosmobit_cta3_overlay','#161C2D'); 
				$cosmobit_print_style .=".dt__cta--three .dt__cta-row:before {
					    background-color: " .esc_attr($cosmobit_cta3_overlay). ";
						opacity: " .esc_attr($cosmobit_cta3_opacity). ";
				}\n";
				
        wp_add_inline_style( 'cosmobit-style', $cosmobit_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'desert_cosmobit_user_custom_style' );