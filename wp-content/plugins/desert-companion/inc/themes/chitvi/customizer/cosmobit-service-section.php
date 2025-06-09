<?php
function cosmobit_service4_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Service  Section
	=========================================*/
	$wp_customize->add_section(
		'service4_options', array(
			'title' => esc_html__( 'Service Section', 'cosmobit-pro' ),
			'priority' => 5,
			'panel' => 'cosmobit_frontpage4_options',
		)
	);
	
	/*=========================================
	Service Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Service Setting','desert-companion'),
			'section' => 'service4_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_service_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'service4_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service4_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service4_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','cosmobit-pro'),
			'section' => 'service4_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_service4_ttl',
    	array(
	        'default'			=> __('Services','cosmobit-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service4_ttl',
		array(
		    'label'   => __('Title','cosmobit-pro'),
		    'section' => 'service4_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_service4_subttl',
    	array(
	        'default'			=> __('We Serve the Best Work','cosmobit-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service4_subttl',
		array(
		    'label'   => __('Subtitle','cosmobit-pro'),
		    'section' => 'service4_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'cosmobit_service4_text',
    	array(
	        'default'			=> __('The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.','cosmobit-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service4_text',
		array(
		    'label'   => __('Description','cosmobit-pro'),
		    'section' => 'service4_options',
			'type'           => 'textarea',
		)  
	);
	
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service4_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service4_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','cosmobit-pro'),
			'section' => 'service4_options',
		)
	);
	
	// Service 
		$wp_customize->add_setting( 'cosmobit_service4_option', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 5,
			  'default' => cosmobit_service3_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_service4_option', 
					array(
						'label'   => esc_html__('Service','cosmobit-pro'),
						'section' => 'service4_options',
						'add_field_label'                   => esc_html__( 'Add New Service', 'cosmobit-pro' ),
						'item_name'                         => esc_html__( 'Service', 'cosmobit-pro' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true,
						'customizer_repeater_icon_control' => true
					) 
				) 
			);
	
	
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_service_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_service_option_upsale', 
			array(
				'label'      => __( 'Service', 'desert-companion' ),
				'section'    => 'service4_options'
			) 
		) 
	);	
}
add_action( 'customize_register', 'cosmobit_service4_customize_setting' );