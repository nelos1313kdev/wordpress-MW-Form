<?php
function atua_blog_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Blog  Section
	=========================================*/
	$wp_customize->add_section(
		'blog_options', array(
			'title' => esc_html__( 'Blog Section', 'desert-companion' ),
			'priority' => 21,
			'panel' => 'atua_frontpage_options',
		)
	);
	
	/*=========================================
	Blog Setting
	=========================================*/
	$wp_customize->add_setting(
		'atua_blog_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_blog_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Blog Setting','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'atua_blog_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_blog_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_blog_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_blog_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'atua_blog_ttl',
    	array(
	        'default'			=> __('Article','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_blog_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'blog_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'atua_blog_subttl',
    	array(
	        'default'			=> __('Recent <span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Blog Post</b> <b>Blog Post</b> <b>Blog Post</b></span></span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_blog_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'blog_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'atua_blog_text',
    	array(
	        'default'			=> __('Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_blog_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'blog_options',
			'type'           => 'textarea',
		)  
	);
	
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_blog_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'atua_blog_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	// No. of Blog Display
	if ( class_exists( 'Atua_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'atua_blog_num',
			array(
				'default' => '3',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'atua_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new Atua_Customizer_Range_Control( $wp_customize, 'atua_blog_num', 
			array(
				'label'      => __( 'Number of Blog Display', 'desert-companion' ),
				'section'  => 'blog_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'    => 1,
							'max'    => 100,
							'step'   => 1,
							'default_value' => 9,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Blog After Before
	=========================================*/
	$wp_customize->add_setting(
		'atua_blog_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'atua_blog_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	// Before
	if ( class_exists( 'Atua_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'atua_blog_option_before', array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 13,
				
			)
		);

		$wp_customize->add_control(
			new Atua_Page_Editor(
				$wp_customize, 'atua_blog_option_before', array(
					'label' => esc_html__( 'Before Section', 'desert-companion' ),
					'section' => 'blog_options',
					'needsync' => true,
				)
			)
		);
	}
	
	// After
	if ( class_exists( 'Atua_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'atua_blog_option_after', array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 14,
				
			)
		);

		$wp_customize->add_control(
			new Atua_Page_Editor(
				$wp_customize, 'atua_blog_option_after', array(
					'label' => esc_html__( 'After Section', 'desert-companion' ),
					'section' => 'blog_options',
					'needsync' => true,
				)
			)
		);
	}
	
	// Upgrade
	$wp_customize->add_setting(
	'atua_blog_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 16,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'atua_blog_option_upsale', 
			array(
				'label'      => __( 'Before / After Content on All Sections', 'desert-companion' ),
				'section'    => 'blog_options'
			) 
		) 
	);	
}
add_action( 'customize_register', 'atua_blog_customize_setting' );