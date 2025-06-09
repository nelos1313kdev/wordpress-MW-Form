<?php
function softme_features_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Features  Section
	=========================================*/
	$wp_customize->add_section(
		'features_options', array(
			'title' => esc_html__( 'Features Section', 'desert-companion' ),
			'priority' => 4,
			'panel' => 'softme_frontpage_options',
		)
	);
	
	/*=========================================
	Features Setting
	=========================================*/
	$wp_customize->add_setting(
		'softme_features_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_features_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Features Setting','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'softme_features_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_features_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'softme_features_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'softme_features_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'softme_features_ttl',
    	array(
	        'default'			=> __('<b class="is_on">What We’re Offering</b><b>What We’re Offering</b><b>What We’re Offering</b>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_features_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'softme_features_subttl',
    	array(
	        'default'			=> __('Dealing in all Professional IT </br><span>Services</span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_features_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'softme_features_text',
    	array(
	        'default'			=> __("There are many variations of passages of available but majority have suffered alteration in some form, by humou or randomised words which don't look even slightly believable.",'desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_features_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'softme_features_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_features_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Features 
		$wp_customize->add_setting( 'softme_features_option', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			  'default' => softme_features_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_features_option', 
					array(
						'label'   => esc_html__('Features','desert-companion'),
						'section' => 'features_options',
						'add_field_label'                   => esc_html__( 'Add New Features', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Features', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
	
	// Upgrade
	$wp_customize->add_setting(
	'softme_features_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'softme_features_option_upsale', 
			array(
				'label'      => __( 'Features', 'desert-companion' ),
				'section'    => 'features_options'
			) 
		) 
	);	
}
add_action( 'customize_register', 'softme_features_customize_setting' );