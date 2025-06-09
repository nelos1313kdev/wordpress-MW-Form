<?php
function cosmobit_why_choose4_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Why Choose Section
	=========================================*/
	$wp_customize->add_section(
		'why_choose4_options', array(
			'title' => esc_html__( 'Why Choose Section', 'desert-companion' ),
			'priority' => 8,
			'panel' => 'cosmobit_frontpage4_options',
		)
	);
	/*=========================================
	Why Choose Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_why_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Why Choose Setting','desert-companion'),
			'section' => 'why_choose4_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_why_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'why_choose4_options',
		)
	);
	
	/*=========================================
	Left Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_why_choose4_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_choose4_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'why_choose4_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_why_choose4_left' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_why_choose4_left', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'why_choose4_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_left_ttl',
    	array(
	        'default'			=> __('Consultation','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_left_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_left_subttl',
    	array(
	        'default'			=> __('We Create Ideas To Grow Business & Developement','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_left_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_left_text',
    	array(
	        'default'			=> __('There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_left_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'textarea',
		)  
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_why4_left_f_icon',
    	array(
	        'default' => 'fa-user-secret',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(
		'cosmobit_why4_left_f_icon',
		array(
		    'label'   		=> __('Feature Icon','desert-companion'),
		    'section' 		=> 'why_choose4_options',
			'type'           => 'text',
			
		)  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why4_left_f_ttl',
    	array(
	        'default'			=> __('Get Free Professional Advisor','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why4_left_f_ttl',
		array(
		    'label'   => __('Feature Title','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'text',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why4_left_f_text',
    	array(
	        'default'			=> __('Ready To Help:<strong><a href="tel:2324567890"> +(232) 456-7890</a></strong>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why4_left_f_text',
		array(
		    'label'   => __('Feature Content','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'textarea',
		)  
	);
	
	/*=========================================
	Right Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_why_choose4_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 8,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_choose4_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'why_choose4_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_why_choose4_right' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 9,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_why_choose4_right', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'why_choose4_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_right_ttl',
    	array(
	        'default'			=> __('Why Choose Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_right_subttl',
    	array(
	        'default'			=> __('We Are Committed To Take Care Of Clients Seriously','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose4_right_text',
    	array(
	        'default'			=> __('There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 12,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose4_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'why_choose4_options',
			'type'           => 'textarea',
		)  
	);
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_why_choose4_funfact' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_why_choose4_funfact', 
		array(
			'label'	      => esc_html__( 'Hide/Show Funfact ?', 'desert-companion' ),
			'section'     => 'why_choose4_options',
			'type'        => 'checkbox'
		) 
	);	
	
	// Funfact 
		$wp_customize->add_setting( 'cosmobit_why_choose4_funfact', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 12,
			  'default' => cosmobit_why_choose4_funfact_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_why_choose4_funfact', 
					array(
						'label'   => esc_html__('Funfact','desert-companion'),
						'section' => 'why_choose4_options',
						'add_field_label'                   => esc_html__( 'Add New Funfact', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Funfact', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_funfact_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 13,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_funfact_option_upsale', 
			array(
				'label'      => __( 'Funfact', 'desert-companion' ),
				'section'    => 'why_choose4_options'
			) 
		) 
	);			
}
add_action( 'customize_register', 'cosmobit_why_choose4_customize_setting' );