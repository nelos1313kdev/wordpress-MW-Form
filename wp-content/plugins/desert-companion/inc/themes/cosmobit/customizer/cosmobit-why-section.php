<?php
function cosmobit_why_choose_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Why Choose Section
	=========================================*/
	$wp_customize->add_section(
		'why_choose_options', array(
			'title' => esc_html__( 'Why Choose Section', 'desert-companion' ),
			'priority' => 7,
			'panel' => 'cosmobit_frontpage_options',
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
			'section' => 'why_choose_options',
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
			'section' => 'why_choose_options',
		)
	);
	
	/*=========================================
	Left Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_why_choose_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_choose_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'why_choose_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_why_choose_left' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_why_choose_left', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'why_choose_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_left_ttl',
    	array(
	        'default'			=> __('Consultation','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_left_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_left_subttl',
    	array(
	        'default'			=> __('We Create Ideas To Grow Business and Developement','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_left_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_left_text',
    	array(
	        'default'			=> __('There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_left_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'cosmobit_why_left_f_icon',
    	array(
	        'default'			=> 'fa-user-secret',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control( 
		'cosmobit_why_left_f_icon',
		array(
		    'label'   		=> __('Feature Icon','desert-companion'),
		    'section' 		=> 'why_choose_options',
			'type'		 =>	'text'
		)  
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why_left_f_ttl',
    	array(
	        'default'			=> __('Get Free Professional Advisor','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_left_f_ttl',
		array(
		    'label'   => __('Feature Title','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_left_f_text',
    	array(
	        'default'			=> __('Ready To Help:<strong><a href="tel:2324567890"> +(232) 456-7890</a></strong>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_left_f_text',
		array(
		    'label'   => __('Feature Content','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	/*=========================================
	Right Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_why_choose_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 8,
		)
	);

	$wp_customize->add_control(
	'cosmobit_why_choose_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'why_choose_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'cosmobit_hs_why_choose_right' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 9,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_why_choose_right', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'why_choose_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_ttl',
    	array(
	        'default'			=> __('Why Choose Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_subttl',
    	array(
	        'default'			=> __('We Are Committed To Take Care Of Clients Seriously','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_text',
    	array(
	        'default'			=> __('There are many variations of passages of orem Ipsum available, but the majority have suffered alteration in some form, by cted ipsum dolor sit amet.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 12,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Feature Text // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_f_text',
    	array(
	        'default'			=> __('Get an Easy Quotation for Your Own Business.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_f_text',
		array(
		    'label'   => __('Feature Text','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_f_btn_lbl',
    	array(
	        'default'			=> __('Join Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 14,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_f_btn_lbl',
		array(
		    'label'   => __('Feature Button Label','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'cosmobit_why_choose_right_f_btn_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'priority' => 15,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_why_choose_right_f_btn_link',
		array(
		    'label'   => __('Feature Button Link','desert-companion'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'cosmobit_why_choose_right_f_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/what-we-do.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',	
			'priority' => 16,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_why_choose_right_f_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'desert-companion'),
			'section'        => 'why_choose_options',
		) 
	));
}
add_action( 'customize_register', 'cosmobit_why_choose_customize_setting' );