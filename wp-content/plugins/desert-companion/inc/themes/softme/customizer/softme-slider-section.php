<?php
function softme_slider_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	$wp_customize->add_panel(
		'softme_frontpage_options', array(
			'priority' => 32,
			'title' => esc_html__( 'Theme Frontpage', 'desert-companion' ),
		)
	);
	
	$wp_customize->add_section(
		'slider_options', array(
			'title' => esc_html__( 'Slider Section', 'desert-companion' ),
			'panel' => 'softme_frontpage_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Slider Setting
	=========================================*/
	$wp_customize->add_setting(
		'slider_options_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_options_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Setting','desert-companion'),
			'section' => 'slider_options',
		)
	);
	
	//  Animation
	$wp_customize->add_setting( 
		'softme_slider_top_anm_hs' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 6,
		) 
	);
	
	$wp_customize->add_control(
	'softme_slider_top_anm_hs', 
		array(
			'label'	      => esc_html__( 'Enable/Disable Top Animation ?', 'desert-companion' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Slider Content
	=========================================*/
	$wp_customize->add_setting(
		'slider_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Contents','desert-companion'),
			'section' => 'slider_options',
		)
	);
	
	// Slider 
		$wp_customize->add_setting( 'softme_slider_option', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			  'default' => softme_slider_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_slider_option', 
					array(
						'label'   => esc_html__('Slide','desert-companion'),
						'section' => 'slider_options',
						'add_field_label'                   => esc_html__( 'Add New Slider', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Slider', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control'=> true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_slide_align' => true,
						'customizer_repeater_image_control' => true,
					) 
				) 
			);
	
	// Upgrade
	$wp_customize->add_setting(
	'softme_slider_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'softme_slider_option_upsale', 
			array(
				'label'      => __( 'Slides', 'desert-companion' ),
				'section'    => 'slider_options'
			) 
		) 
	);	

	// slider opacity
	if ( class_exists( 'SoftMe_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'softme_slider_opacity',
			array(
				'default'	      => '0.6',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'softme_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
		new SoftMe_Customizer_Range_Control( $wp_customize, 'softme_slider_opacity', 
			array(
				'label'      => __( 'opacity', 'desert-companion' ),
				'section'  => 'slider_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 0.9,
							'step'          => 0.1,
							'default_value' => 0.6,
						),
					),
			) ) 
		);
	}
	
	 // Overlay Color
	$wp_customize->add_setting(
	'softme_slider_overlay', 
	array(
		'default'	      => '#000000',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'softme_slider_overlay', 
			array(
				'label'      => __( 'Overlay Color', 'desert-companion' ),
				'section'    => 'slider_options'
			) 
		) 
	);
}
add_action( 'customize_register', 'softme_slider_customize_setting' );