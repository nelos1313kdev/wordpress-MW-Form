<?php
function cosmobit_funfact6_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Funfact Section
	=========================================*/
	$wp_customize->add_section(
		'funfact6_options', array(
			'title' => esc_html__( 'Funfact Section', 'desert-companion' ),
			'panel' => 'cosmobit_frontpage5_options',
			'priority' => 2,
		)
	);
	/*=========================================
	Funfact Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_funfact6_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_funfact6_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Funfact Setting','desert-companion'),
			'section' => 'funfact6_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_funfact6_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_funfact6_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'funfact6_options',
		)
	);
	
	/*=========================================
	Funfact Content
	=========================================*/
	$wp_customize->add_setting(
		'funfact6_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'funfact6_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Funfact Contents','desert-companion'),
			'section' => 'funfact6_options',
		)
	);
	
	// Information 
		$wp_customize->add_setting( 'cosmobit_funfact6_option', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 5,
			  'default' => cosmobit_funfact_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_funfact6_option', 
					array(
						'label'   => esc_html__('Funfact','desert-companion'),
						'section' => 'funfact6_options',
						'add_field_label'                   => esc_html__( 'Add New Funfact', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Funfact', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_funfact_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_funfact_option_upsale', 
			array(
				'label'      => __( 'Funfact', 'desert-companion' ),
				'section'    => 'funfact6_options'
			) 
		) 
	);			
	
	/*=========================================
	Right Content
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_funfact6_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'cosmobit_funfact6_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'funfact6_options',
		)
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_funfact6_right_icon',
    	array(
	        'default'			=> __('fa-phone','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_funfact6_right_icon',
		array(
		    'label'   => __('Icon','desert-companion'),
		    'section' => 'funfact6_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_funfact6_right_ttl',
    	array(
	        'default'			=> __('Call for help!','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_funfact6_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'funfact6_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_funfact6_right_subttl',
    	array(
	        'default'			=> __('<a href="tel:+234-13-1810">+234-13-1810</a>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_funfact6_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'funfact6_options',
			'type'           => 'text',
		)  
	);
}
add_action( 'customize_register', 'cosmobit_funfact6_customize_setting' );