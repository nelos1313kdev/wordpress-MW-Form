<?php
function corpiva_information_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Information Section
	=========================================*/
	$wp_customize->add_section(
		'information_options', array(
			'title' => esc_html__( 'Information Section', 'desert-companion' ),
			'panel' => 'corpiva_frontpage_options',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Information Setting
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_information_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_information_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Information Setting','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'corpiva_information_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_information_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	/*=========================================
	Information Content
	=========================================*/
	$wp_customize->add_setting(
		'information_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'information_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Information Contents','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	// Information 
		$wp_customize->add_setting( 'corpiva_information_option', 
			array(
			 'sanitize_callback' => 'corpiva_repeater_sanitize',
			 'priority' => 5,
			 'default' => corpiva_information_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Corpiva_Repeater( $wp_customize, 
				'corpiva_information_option', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'corpiva_information_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'corpiva_information_option_upsale', 
			array(
				'label'      => __( 'Information', 'desert-companion' ),
				'section'    => 'information_options'
			) 
		) 
	);			
}
add_action( 'customize_register', 'corpiva_information_customize_setting' );