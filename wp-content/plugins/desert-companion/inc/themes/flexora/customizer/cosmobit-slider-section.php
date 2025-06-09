<?php
function cosmobit_slider3_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	$wp_customize->add_panel(
		'cosmobit_frontpage_options', array(
			'priority' => 32,
			'title' => esc_html__( 'Theme Frontpage', 'desert-companion' ),
		)
	);
	
	$wp_customize->add_section(
		'slider3_options', array(
			'title' => esc_html__( 'Slider Section', 'desert-companion' ),
			'panel' => 'cosmobit_frontpage_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Slider Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_slider_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_slider_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Slider Setting','desert-companion'),
			'section' => 'slider3_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_slider_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_slider_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'slider3_options',
		)
	);
	
	/*=========================================
	Slider Content
	=========================================*/
	$wp_customize->add_setting(
		'slider3_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider3_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Contents','desert-companion'),
			'section' => 'slider3_options',
		)
	);
	
	// Slider 
		$wp_customize->add_setting( 'cosmobit_slider3_option', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 5,
			  'default' => cosmobit_slider3_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_slider3_option', 
					array(
						'label'   => esc_html__('Slide','desert-companion'),
						'section' => 'slider3_options',
						'add_field_label'                   => esc_html__( 'Add New Slider', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Slider', 'desert-companion' ),
						
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control'=> true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true,
						'customizer_repeater_slide_align' => true,
					) 
				) 
			);
	
	
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_slider_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_slider_option_upsale', 
			array(
				'label'      => __( 'Slides', 'desert-companion' ),
				'section'    => 'slider3_options'
			) 
		) 
	);
	
	// slider opacity
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'cosmobit_slider3_opacity',
			array(
				'default'	      => '0.65',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_slider3_opacity', 
			array(
				'label'      => __( 'opacity', 'desert-companion' ),
				'section'  => 'slider3_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 0.9,
							'step'          => 0.1,
							'default_value' => 0.65,
						),
					),
			) ) 
		);
	}
	
	 // Overlay Color
	$wp_customize->add_setting(
	'cosmobit_slider3_overlay', 
	array(
		'default'	      => '#000000',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'cosmobit_slider3_overlay', 
			array(
				'label'      => __( 'Overlay Color', 'desert-companion' ),
				'section'    => 'slider3_options'
			) 
		) 
	);
}
add_action( 'customize_register', 'cosmobit_slider3_customize_setting' );