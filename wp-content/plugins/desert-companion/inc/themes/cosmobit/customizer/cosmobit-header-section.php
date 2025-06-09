<?php
function desert_cosmobit_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'desert-companion'),
		) 
	);
	
	/*=========================================
	Top Header
	=========================================*/
	$wp_customize->add_section(
        'cosmobit_top_header',
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
		'cosmobit_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','desert-companion'),
			'section' => 'cosmobit_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Contact
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_hdr_top_contact'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_top_contact',
		array(
			'type' => 'hidden',
			'label' => __('Address','desert-companion'),
			'section' => 'cosmobit_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_contact' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_contact', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_contact_icon',
    	array(
	        'default'			=> 'fa-map-marker',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 5,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_contact_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);	
	
	// title // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_contact_title',
    	array(
	        'default'			=> __('California, TX 70240','desert-companion'),
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 5,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_contact_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_contact_link',
    	array(
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 6,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_contact_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','desert-companion'),
			'section' => 'cosmobit_top_header',
		)
	);
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// Icon
	$wp_customize->add_setting(
    	'cosmobit_hdr_email_icon',
    	array(
	        'default'			=> 'fa-envelope',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 12,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_email_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);	
	
	//  title // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_email_title',
    	array(
	        'default'			=> __('info@gmail.com','desert-companion'),
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_email_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_email_link',
    	array(
			'default'=> 'mailto:info@gmail.com',
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_email_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	
	/*=========================================
	Mobile
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_hdr_top_mbl'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_top_mbl',
		array(
			'type' => 'hidden',
			'label' => __('Mobile','desert-companion'),
			'section' => 'cosmobit_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_top_mbl', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 17,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_top_mbl', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_mbl_icon',
    	array(
	        'default'			=> 'fa-headphones',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 17,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_mbl_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_mbl_title',
    	array(
	        'default'			=> __('+123-456-7890','desert-companion'),
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_mbl_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_mbl_link',
    	array(
			'default'			=> __('tel:+123-456-7890','desert-companion'),
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 19,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_mbl_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
		
	
	
	/*=========================================
	Timing
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_hdr_top_time'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 20,
		)
	);

	$wp_customize->add_control(
	'cosmobit_hdr_top_time',
		array(
			'type' => 'hidden',
			'label' => __('Timing','desert-companion'),
			'section' => 'cosmobit_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_top_time', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 21,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_top_time', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_time_icon',
    	array(
	        'default'			=> 'fa-clock-o',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 22,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_time_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_time_title',
    	array(
	        'default'			=> __('Office Hours: 8:00 AM – 7:45 PM','desert-companion'),
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 22,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_time_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'cosmobit_hdr_top_time_link',
    	array(
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 23,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_hdr_top_time_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'cosmobit_top_header',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'Cosmobit_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Cosmobit_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','desert-companion'),
			'section' => 'cosmobit_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'cosmobit_hdr_social', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 26,
			 'default' => cosmobit_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new COSMOBIT_Repeater( $wp_customize, 
				'cosmobit_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','desert-companion'),
						'section' => 'cosmobit_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_social_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 26,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_social_option_upsale', 
			array(
				'label'      => __( 'Icons', 'desert-companion' ),
				'section'    => 'cosmobit_top_header'
			) 
		) 
	);		
}
add_action( 'customize_register', 'desert_cosmobit_header_customize_settings' );

