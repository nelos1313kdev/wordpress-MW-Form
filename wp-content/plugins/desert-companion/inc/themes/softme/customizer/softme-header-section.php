<?php
function desert_softme_header_customize_settings( $wp_customize ) {
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
        'softme_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Header','desert-companion'),
			'panel'  		=> 'header_options',
		)
    );	
	
	$desert_activated_theme = wp_get_theme(); // gets the current theme
	if( 'CozySoft' !== $desert_activated_theme->name && 'Suntech' !== $desert_activated_theme->name){
	/*=========================================
	Global Setting
	=========================================*/
	$wp_customize->add_setting(
		'softme_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','desert-companion'),
			'section' => 'softme_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'softme_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Text
	=========================================*/
	$wp_customize->add_setting(
		'SoftMe_hdr_left_text_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'SoftMe_hdr_left_text_head',
		array(
			'type' => 'hidden',
			'label' => __('Left Text','desert-companion'),
			'section' => 'softme_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'softme_hs_hdr_left_text' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 24,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_left_text', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	//  title // 
	$wp_customize->add_setting(
    	'softme_hdr_left_ttl',
    	array(
	        'default'			=> __('Now Hiring:','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 24,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_left_ttl',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'softme_hdr_left_text',
    	array(
	        'default'			=> __('<b class="is_on">Welcome to IT Solutions & Services WordPress Theme</b><b>Are you passionate about first line IT support?</b>','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 24,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_left_text',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'textarea'
		)  
	);
	
	
			
	
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'softme_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','desert-companion'),
			'section' => 'softme_top_header',
		)
	);
	$wp_customize->add_setting( 
		'softme_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_email_icon',
    	array(
	        'default'			=> __('fas fa-envelope','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 24,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_email_icon',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'softme_hdr_email_title',
    	array(
	        'default'			=> __('needhelp@company.com','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_email_title',
		array(
		    'label'   		=> __('Subtitle','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'softme_hdr_email_link',
    	array(
			'default'=> 'mailto:needhelp@company.com',
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_email_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	
	/*=========================================
	Address
	=========================================*/
	$wp_customize->add_setting(
		'softme_hdr_top_ads'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_top_ads',
		array(
			'type' => 'hidden',
			'label' => __('Address','desert-companion'),
			'section' => 'softme_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'softme_hs_hdr_top_ads', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 17,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_top_ads', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_top_header',
			'type'        => 'checkbox'
		) 
	);	

	//  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_top_ads_icon',
    	array(
	        'default'			=> __('fas fa-map-marker-alt','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 17,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_top_ads_icon',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'softme_hdr_top_ads_title',
    	array(
	        'default'			=> __('60 Golden Street, New York','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_top_ads_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'softme_hdr_top_ads_link',
    	array(
			'sanitize_callback' => 'softme_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 19,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_top_ads_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'softme_top_header',
			'type'		 =>	'text'
		)  
	);
		
	}
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'SoftMe_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'SoftMe_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','desert-companion'),
			'section' => 'softme_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'softme_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'softme_hdr_social', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 26,
			 'default' => softme_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new SOFTME_Repeater( $wp_customize, 
				'softme_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','desert-companion'),
						'section' => 'softme_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'softme_social_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 26,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'softme_social_option_upsale', 
			array(
				'label'      => __( 'Icons', 'desert-companion' ),
				'section'    => 'softme_top_header'
			) 
		) 
	);	

	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'softme_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','softme'),
			'section' => 'softme_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'softme_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'softme' ),
			'section'     => 'softme_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
   //  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_btn_icon',
    	array(
	        'default'			=> __('fab fa-whatsapp','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_btn_icon',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'softme_hdr_btn_lbl',
    	array(
	        'default'			=> __('+1 631 112 1134','softme'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','softme'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'softme_hdr_btn_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'softme_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','softme'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'softme_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'softme' ),
			'section'     => 'softme_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	

	/*=========================================
	Header Contact
	=========================================*/	
	$wp_customize->add_setting(
		'softme_hdr_contact'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_contact',
		array(
			'type' => 'hidden',
			'label' => __('Contact','desert-companion'),
			'section' => 'softme_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'softme_hs_hdr_contact' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_contact', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_icon',
    	array(
	        'default'			=> __('fas fa-phone-volume','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_icon',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_ttl',
    	array(
	        'default'			=> __('Call Anytime','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_ttl',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_txt',
    	array(
			'default'			=> '<a href="tel:+8898006802">+ 88 ( 9800 ) 6802</a>',
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_txt',
		array(
		    'label'   		=> __('Text','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);	

	$desert_activated_theme = wp_get_theme(); // gets the current theme
	if('Softinn' == $desert_activated_theme->name || 'CozySoft' == $desert_activated_theme->name || 'Suntech' == $desert_activated_theme->name  || 'SoftAlt' == $desert_activated_theme->name){
	/*=========================================
	Header Contact
	=========================================*/	
	$wp_customize->add_setting(
		'softme_hdr_contact2'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_contact2',
		array(
			'type' => 'hidden',
			'label' => __('Contact 2','desert-companion'),
			'section' => 'softme_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'softme_hs_hdr_contact2' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_contact2', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_icon2',
    	array(
	        'default'			=> __('fas fa-envelope','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_icon2',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_ttl2',
    	array(
	        'default'			=> __('Get a Estimate','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_ttl2',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_txt2',
    	array(
			'default'			=> '<a href="mailto:info@gmail.com">info@gmail.com</a>',
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_txt2',
		array(
		    'label'   		=> __('Text','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);	
	}	
	
	
if('CozySoft' == $desert_activated_theme->name || 'Suntech' == $desert_activated_theme->name || 'SoftAlt' == $desert_activated_theme->name){
	/*=========================================
	Header Contact
	=========================================*/	
	$wp_customize->add_setting(
		'softme_hdr_contact3'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'softme_hdr_contact3',
		array(
			'type' => 'hidden',
			'label' => __('Contact 3','desert-companion'),
			'section' => 'softme_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'softme_hs_hdr_contact3' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'softme_hs_hdr_contact3', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'softme_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_icon3',
    	array(
	        'default'			=> __('fas fa-clock','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_icon3',
		array(
		    'label'   		=> __('icon','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_ttl3',
    	array(
	        'default'			=> __('Monday - Friday','desert-companion'),
			'sanitize_callback' => 'softme_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_ttl3',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'softme_hdr_contact_txt3',
    	array(
			'default'			=> '10 am - 05 pm',
			'sanitize_callback' => 'softme_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'softme_hdr_contact_txt3',
		array(
		    'label'   		=> __('Text','desert-companion'),
		    'section' 		=> 'softme_hdr_nav',
			'type'		 =>	'text'
		)  
	);	
	}	
}
add_action( 'customize_register', 'desert_softme_header_customize_settings' );