<?php
function corpiva_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'corpiva'),
		) 
	);
	
	/*=========================================
	Corpiva Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','corpiva'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'corpiva' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	
	// Site Title Size // 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_title_size',
			array(
				'default'			=> '55',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'hdr_site_title_size', 
			array(
				'label'      => __( 'Site Title Size', 'corpiva' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
					),
			) ) 
		);
	}
	
	// Site Tagline Size // 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_desc_size',
			array(
				'default'			=> '16',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'hdr_site_desc_size', 
			array(
				'label'      => __( 'Site Tagline Size', 'corpiva' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
					),
			) ) 
		);
	}
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'corpiva_title_tagline_seo' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_title_tagline_seo', 
		array(
			'label'	      => esc_html__( 'Enable Hidden Title (h1 missing SEO issue)', 'corpiva' ),
			'section'     => 'title_tagline',
			'type'        => 'checkbox'
		) 
	);
	
	
			
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'corpiva_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','corpiva'),
			'panel'  		=> 'header_options',
		)
    );
	
	/*=========================================
	Header Account
	=========================================*/	
	$wp_customize->add_setting(
		'corpiva_hdr_account'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_account',
		array(
			'type' => 'hidden',
			'label' => __('My Account','corpiva'),
			'section' => 'corpiva_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_account' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_account', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'corpiva_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','corpiva'),
			'section' => 'corpiva_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'corpiva_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','corpiva'),
			'section' => 'corpiva_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'corpiva_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','corpiva'),
			'section' => 'corpiva_hdr_nav',
		)
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_hdr_btn_icon',
    	array(
	        'default' => 'fab fa-whatsapp',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_hdr_btn_icon',
		array(
		    'label'   		=> __('Icon','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);
	

	$wp_customize->add_setting(
		'corpiva_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'corpiva_hdr_btn_lbl',
    	array(
	        'default'			=> __('Get A Quote','corpiva'),
			'sanitize_callback' => 'corpiva_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'corpiva_hdr_btn_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'corpiva_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'corpiva_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Contact
	=========================================*/	
	$wp_customize->add_setting(
		'corpiva_hdr_contact'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_contact',
		array(
			'type' => 'hidden',
			'label' => __('Contact','corpiva'),
			'section' => 'corpiva_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'corpiva_hs_hdr_contact' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_contact', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_hdr_contact_icon',
    	array(
	        'default' => 'fal fa-phone-volume',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_hdr_contact_icon',
		array(
		    'label'   		=> __('Icon','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'corpiva_hdr_contact_ttl',
    	array(
	        'default'			=> __('Call Anytime','corpiva'),
			'sanitize_callback' => 'corpiva_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_contact_ttl',
		array(
		    'label'   		=> __('Title','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'corpiva_hdr_contact_txt',
    	array(
			'default'			=> '<a href="tel:+1237878222">+123 7878 222</a>',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_hdr_contact_txt',
		array(
		    'label'   		=> __('Text','corpiva'),
		    'section' 		=> 'corpiva_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'corpiva_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','corpiva'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'corpiva_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','corpiva'),
			'section' => 'corpiva_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'corpiva_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'corpiva' ),
			'section'     => 'corpiva_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'corpiva_header_customize_settings' );

