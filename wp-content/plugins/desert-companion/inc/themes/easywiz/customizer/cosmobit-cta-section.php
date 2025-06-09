<?php
function cosmobit_cta5_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	CTA  Section
	=========================================*/
	$wp_customize->add_section(
		'cta5_options', array(
			'title' => esc_html__( 'CTA Section', 'desert-companion' ),
			'priority' => 9,
			'panel' => 'cosmobit_frontpage5_options',
		)
	);
	
	/*=========================================
	CTA Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_cta2_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_cta2_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('CTA Setting','desert-companion'),
			'section' => 'cta5_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_cta2_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_cta2_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'cta5_options',
		)
	);
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_cta5_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_cta5_content_options',
		array(
			'type' => 'hidden',
			'label' => __('CTA Content','desert-companion'),
			'section' => 'cta5_options',
		)
	);
	
	
	//  Text // 
	$wp_customize->add_setting(
    	'cosmobit_cta5_text',
    	array(
	        'default'			=> __('Do you want Join with us? Please send your Resume','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_cta5_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'cta5_options',
			'type'           => 'textarea',
		)  
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'cosmobit_cta5_btn_lbl',
    	array(
	        'default'			=> 'Apply Now',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_cta5_btn_lbl',
		array(
		    'label'   => __('Button Label','desert-companion'),
		    'section' => 'cta5_options',
			'type'           => 'text',
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'cosmobit_cta5_btn_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_cta5_btn_link',
		array(
		    'label'   => __('Button Link','desert-companion'),
		    'section' => 'cta5_options',
			'type'           => 'text',
		)  
	);
	
	
	
	/*=========================================
	Background  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_cta5_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_cta5_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Image','desert-companion'),
			'section' => 'cta5_options',
		)
	);
	
	// Image
	$wp_customize->add_setting( 
    	'cosmobit_cta5_left_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/easywiz/assets/images/success-man-1.png'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',	
			'priority' => 5,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_cta5_left_img' ,
		array(
			'label'          => __( 'Background Image', 'desert-companion' ),
			'section'        => 'cta5_options',
		) 
	));	
}
add_action( 'customize_register', 'cosmobit_cta5_customize_setting' );