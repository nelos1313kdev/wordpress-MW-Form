<?php
function atua_service_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	ServiceService  Section
	=========================================*/
	$wp_customize->add_section(
		'service_options', array(
			'title' => esc_html__( 'Service Section', 'desert-companion' ),
			'priority' => 5,
			'panel' => 'atua_frontpage_options',
		)
	);
	
	/*=========================================
	Service Setting
	=========================================*/
	$wp_customize->add_setting(
		'atua_service_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_service_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Service Setting','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'atua_service_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_service_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_service_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_service_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'atua_service_ttl',
    	array(
	        'default'			=> __('Our Services','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_service_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'atua_service_subttl',
    	array(
	        'default'			=> __('The Best Solutions for Best<span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Business</b> <b>Services</b> <b>Solutions</b></span></span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_service_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'atua_service_text',
    	array(
	        'default'			=> __('Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_service_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'textarea',
		)  
	);
	
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_service_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'atua_service_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	// Service 
		$wp_customize->add_setting( 'atua_service_option', 
			array(
			 'sanitize_callback' => 'atua_repeater_sanitize',
			 'priority' => 5,
			  'default' => atua_service_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Atua_Repeater( $wp_customize, 
				'atua_service_option', 
					array(
						'label'   => esc_html__('Service','desert-companion'),
						'section' => 'service_options',
						'add_field_label'                   => esc_html__( 'Add New Service', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Service', 'desert-companion' ),
						
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
	'atua_service_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'atua_service_option_upsale', 
			array(
				'label'      => __( 'Service', 'desert-companion' ),
				'section'    => 'service_options'
			) 
		) 
	);	
}
add_action( 'customize_register', 'atua_service_customize_setting' );