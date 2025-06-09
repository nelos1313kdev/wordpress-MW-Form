<?php
function desert_atua_header_customize_settings( $wp_customize ) {
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
        'atua_top_header',
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
		'atua_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','desert-companion'),
			'section' => 'atua_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'atua_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'atua_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	
	$desert_activated_theme = wp_get_theme(); // gets the current theme
	if( 'Flexeo' == $desert_activated_theme->name || 'Avvy' == $desert_activated_theme->name){
	/*=========================================
	Text
	=========================================*/
	$wp_customize->add_setting(
		'Atua_hdr_left_text_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Atua_hdr_left_text_head',
		array(
			'type' => 'hidden',
			'label' => __('Left Text','desert-companion'),
			'section' => 'atua_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'atua_hs_hdr_left_text' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 24,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_left_text', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'atua_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	//  title // 
	$wp_customize->add_setting(
    	'atua_hdr_left_text',
    	array(
	        'default'			=> __('Welcome to our <a href="#">Flexeo</a> Service!','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 24,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_left_text',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'textarea'
		)  
	);
	}	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'Atua_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Atua_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','desert-companion'),
			'section' => 'atua_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'atua_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'atua_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	//  title // 
	$wp_customize->add_setting(
    	'atua_hdr_social_title',
    	array(
	        'default'			=> __('Follow Us:','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 26,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_social_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'atua_hdr_social', 
			array(
			 'sanitize_callback' => 'atua_repeater_sanitize',
			 'priority' => 26,
			 'default' => atua_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new ATUA_Repeater( $wp_customize, 
				'atua_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','desert-companion'),
						'section' => 'atua_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'atua_social_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 26,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'atua_social_option_upsale', 
			array(
				'label'      => __( 'Icons', 'desert-companion' ),
				'section'    => 'atua_top_header'
			) 
		) 
	);	
	
	
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'atua_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','desert-companion'),
			'section' => 'atua_top_header',
		)
	);
	$wp_customize->add_setting( 
		'atua_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'atua_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'atua_hdr_email_icon',
    	array(
	        'default'			=> 'fas fa-envelope',
			'sanitize_callback' => 'atua_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_email_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	//  title // 
	$wp_customize->add_setting(
    	'atua_hdr_email_title',
    	array(
	        'default'			=> __('Email:','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_email_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	//  subtitle // 
	$wp_customize->add_setting(
    	'atua_hdr_email_subtitle',
    	array(
	        'default'			=> __('info@gmail.com','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_email_subtitle',
		array(
		    'label'   		=> __('Subtitle','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'atua_hdr_email_link',
    	array(
			'default'=> 'mailto:info@gmail.com',
			'sanitize_callback' => 'atua_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_email_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	
	/*=========================================
	Mobile
	=========================================*/
	$wp_customize->add_setting(
		'atua_hdr_top_mbl'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_top_mbl',
		array(
			'type' => 'hidden',
			'label' => __('Mobile','desert-companion'),
			'section' => 'atua_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'atua_hs_hdr_top_mbl', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 17,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_top_mbl', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'atua_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	//  icon // 
	$wp_customize->add_setting(
    	'atua_hdr_top_mbl_icon',
    	array(
	        'default'			=> 'fas fa-headphones',
			'sanitize_callback' => 'atua_sanitize_html',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_top_mbl_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'atua_hdr_top_mbl_title',
    	array(
	        'default'			=> __('Call:','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_top_mbl_title',
		array(
		    'label'   		=> __('Title','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// subtitle // 
	$wp_customize->add_setting(
    	'atua_hdr_top_mbl_subtitle',
    	array(
	        'default'			=> __('+123-456-7890','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_text',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_top_mbl_subtitle',
		array(
		    'label'   		=> __('Subtitle','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'atua_hdr_top_mbl_link',
    	array(
			'default'			=> __('tel:+123-456-7890','desert-companion'),
			'sanitize_callback' => 'atua_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 19,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_top_mbl_link',
		array(
		    'label'   		=> __('Link','desert-companion'),
		    'section' 		=> 'atua_top_header',
			'type'		 =>	'text'
		)  
	);
}
add_action( 'customize_register', 'desert_atua_header_customize_settings' );