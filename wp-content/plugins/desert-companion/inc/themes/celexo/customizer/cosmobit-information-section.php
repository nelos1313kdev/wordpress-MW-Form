<?php
function cosmobit_information2_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Information Section
	=========================================*/
	$wp_customize->add_section(
		'information2_options', array(
			'title' => esc_html__( 'Information Section', 'desert-companion' ),
			'panel' => 'cosmobit_frontpage2_options',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Information Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_information_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_information_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Information Setting','desert-companion'),
			'section' => 'information2_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_information_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_information_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'information2_options',
		)
	);
	
	
	/*=========================================
	Information Content
	=========================================*/
	$wp_customize->add_setting(
		'information2_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'information2_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Information Contents','desert-companion'),
			'section' => 'information2_options',
		)
	);
	
	// Information 
		$wp_customize->add_setting( 'cosmobit_information2_option', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 5,
			  'default' => cosmobit_information2_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_information2_option', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information2_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_information_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_information_option_upsale', 
			array(
				'label'      => __( 'Information', 'desert-companion' ),
				'section'    => 'information2_options'
			) 
		) 
	);				
}
add_action( 'customize_register', 'cosmobit_information2_customize_setting' );