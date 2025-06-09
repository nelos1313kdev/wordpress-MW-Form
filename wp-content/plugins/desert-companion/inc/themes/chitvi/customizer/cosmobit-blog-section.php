<?php
function cosmobit_blog4_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Blog  Section
	=========================================*/
	$wp_customize->add_section(
		'blog4_options', array(
			'title' => esc_html__( 'Blog Section', 'desert-companion' ),
			'priority' => 11,
			'panel' => 'cosmobit_frontpage4_options',
		)
	);
	
	/*=========================================
	Blog Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_blog_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Blog Setting','desert-companion'),
			'section' => 'blog4_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_blog_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'blog4_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_blog4_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog4_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'blog4_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_blog4_ttl',
    	array(
	        'default'			=> __('Our Blog','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog4_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'blog4_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_blog4_subttl',
    	array(
	        'default'			=> __('Latest Posts','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog4_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'blog4_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'cosmobit_blog4_text',
    	array(
	        'default'			=> __('The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog4_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'blog4_options',
			'type'           => 'textarea',
		)  
	);
	
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_blog4_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog4_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'blog4_options',
		)
	);
	
	// No. of Blog Display
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'cosmobit_blog4_num',
			array(
				'default' => '6',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_blog4_num', 
			array(
				'label'      => __( 'Number of blog Display', 'desert-companion' ),
				'section'  => 'blog4_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'    => 1,
							'max'    => 100,
							'step'   => 1,
							'default_value' => 6,
						),
					),
			) ) 
		);
	}
}
add_action( 'customize_register', 'cosmobit_blog4_customize_setting' );