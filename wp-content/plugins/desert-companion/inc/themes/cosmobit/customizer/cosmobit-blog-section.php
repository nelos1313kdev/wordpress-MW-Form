<?php
function cosmobit_blog_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Blog  Section
	=========================================*/
	$wp_customize->add_section(
		'blog_options', array(
			'title' => esc_html__( 'Blog Section', 'desert-companion' ),
			'priority' => 11,
			'panel' => 'cosmobit_frontpage_options',
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
			'section' => 'blog_options',
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
			'section' => 'blog_options',
		)
	);
	
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_blog_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_blog_ttl',
    	array(
	        'default'			=> __('Our Blog','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'blog_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_blog_subttl',
    	array(
	        'default'			=> __('Latest Posts','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'blog_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'cosmobit_blog_text',
    	array(
	        'default'			=> __('The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_blog_text',
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
		'cosmobit_blog_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	// No. of Blog Display
	if ( class_exists( 'Cosmobit_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'cosmobit_blog_num',
			array(
				'default' => '6',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new Cosmobit_Customizer_Range_Control( $wp_customize, 'cosmobit_blog_num', 
			array(
				'label'      => __( 'Number of blog Display', 'desert-companion' ),
				'section'  => 'blog_options',
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
	
	/*=========================================
	Blog After Before
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_blog_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 14,
		)
	);

	$wp_customize->add_control(
	'cosmobit_blog_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','desert-companion'),
			'section' => 'blog_options',
		)
	);
	
	// Before
	if ( class_exists( 'Cosmobit_Page_Editor' ) ) {
		$cosmobit_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $cosmobit_page_editor_path ) ) {
			require_once( $cosmobit_page_editor_path );
		}
		$frontpage_id = get_option( 'page_on_front' );
		$default = '';
		if ( ! empty( $frontpage_id ) ) {
			$default = get_post_field( 'post_content', $frontpage_id );
		}
		$wp_customize->add_setting(
			'cosmobit_blog_option_before', array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 15,
				
			)
		);

		$wp_customize->add_control(
			new Cosmobit_Page_Editor(
				$wp_customize, 'cosmobit_blog_option_before', array(
					'label' => esc_html__( 'Before Section', 'desert-companion' ),
					'section' => 'blog_options',
					'needsync' => true,
				)
			)
		);
	}
	
	// After
	if ( class_exists( 'Cosmobit_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'cosmobit_blog_option_after', array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 16,
				
			)
		);

		$wp_customize->add_control(
			new Cosmobit_Page_Editor(
				$wp_customize, 'cosmobit_blog_option_after', array(
					'label' => esc_html__( 'After Section', 'desert-companion' ),
					'section' => 'blog_options',
					'needsync' => true,
				)
			)
		);
	}
	
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_blog_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 16,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_blog_option_upsale', 
			array(
				'label'      => __( 'Before / After Content on All Sections', 'desert-companion' ),
				'section'    => 'blog_options'
			) 
		) 
	);	
	
}
add_action( 'customize_register', 'cosmobit_blog_customize_setting' );