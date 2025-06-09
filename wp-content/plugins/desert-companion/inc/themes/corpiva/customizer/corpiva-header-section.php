<?php
function desert_corpiva_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Top Header
	=========================================*/
	$wp_customize->add_section(
        'corpiva_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Header','desert-companion'),
			'panel'  		=> 'header_options',
		)
    );	
	
	/*=========================================
	Global Setting
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','desert-companion'),
			'section' => 'corpiva_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'corpiva_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'corpiva_top_header',
			'type'        => 'checkbox'
		) 
	);		
	
	/*=========================================
	Address
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_hdr_top_ads'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_top_ads',
		array(
			'type' => 'hidden',
			'label' => __('Address','desert-companion'),
			'section' => 'corpiva_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_top_ads', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_top_ads', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'corpiva_top_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_hdr_top_ads_icon',
    	array(
	        'default' => 'fas fa-location-arrow',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_hdr_top_ads_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'corpiva_top_header',			
		))  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'corpiva_hdr_top_ads_title',
    	array(
	        'default'			=> __('60 Golden Street, New York','desert-companion'),
			'sanitize_callback' => 'corpiva_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_top_ads_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'corpiva_hdr_top_ads_link',
    	array(
			'sanitize_callback' => 'corpiva_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_top_ads_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
		
		
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','desert-companion'),
			'section' => 'corpiva_top_header',
		)
	);
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'corpiva_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_hdr_email_icon',
    	array(
	        'default' => 'far fa-envelope-open',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_hdr_email_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'corpiva_hdr_email_title',
    	array(
	        'default'			=> __('info@example.com','desert-companion'),
			'sanitize_callback' => 'corpiva_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_email_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'corpiva_hdr_email_link',
    	array(
			'default'=> 'mailto:info@example.com',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_email_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	/*=========================================
	Time
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_hdr_top_time'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 14,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_top_time',
		array(
			'type' => 'hidden',
			'label' => __('Time','desert-companion'),
			'section' => 'corpiva_top_header',
		)
	);
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_time' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_time', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'corpiva_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_hdr_time_icon',
    	array(
	        'default' => 'far fa-clock',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_hdr_time_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'corpiva_hdr_time_title',
    	array(
	        'default'			=> __('Mon-Sat: 9.00am To 7.00pm','desert-companion'),
			'sanitize_callback' => 'corpiva_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_time_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'corpiva_hdr_time_link',
    	array(
			'sanitize_callback' => 'corpiva_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_time_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'corpiva_top_header',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'Corpiva_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Corpiva_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','desert-companion'),
			'section' => 'corpiva_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'corpiva_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'corpiva_hdr_social', 
			array(
			 'sanitize_callback' => 'corpiva_repeater_sanitize',
			 'priority' => 26,
			 'default' => corpiva_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new CORPIVA_Repeater( $wp_customize, 
				'corpiva_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','desert-companion'),
						'section' => 'corpiva_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'corpiva_social_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 26,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'corpiva_social_option_upsale', 
			array(
				'label'      => __( 'Icons', 'desert-companion' ),
				'section'    => 'corpiva_top_header'
			) 
		) 
	);			
}
add_action( 'customize_register', 'desert_corpiva_header_customize_settings' );