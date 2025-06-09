<?php
function corpiva_features_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Features  Section
	=========================================*/
	$wp_customize->add_section(
		'features_options', array(
			'title' => esc_html__( 'Features Section', 'desert-companion' ),
			'priority' => 7,
			'panel' => 'corpiva_frontpage_options',
		)
	);
	
	/*=========================================
	Features Setting
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_features_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_features_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Features Setting','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'corpiva_features_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_features_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_features_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_features_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'corpiva_features_ttl',
    	array(
	        'default'			=> __('We’ll Ensure You Always Get the Best Guidance.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_features_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'text',
		)  
	);
	
	//  Description // 
	$wp_customize->add_setting(
    	'corpiva_features_text',
    	array(
	        'default'			=> __('Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_features_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_features_icon',
    	array(
	        'default' => 'fas fa-play',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_features_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'features_options'
			
		))  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'corpiva_features_btn_lbl',
    	array(
	        'default'			=> __('Watch Video','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_features_btn_lbl',
		array(
		    'label'   => __('Button Label','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'corpiva_features_btn_url',
    	array(
	        'default'			=> 'https://www.youtube.com/watch?v=6mkoGSqTqFI',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_features_btn_url',
		array(
		    'label'   => __('Button Link','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_features_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_features_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Features 
		$wp_customize->add_setting( 'corpiva_features_option', 
			array(
			 'sanitize_callback' => 'corpiva_repeater_sanitize',
			 'priority' => 5,
			  'default' => corpiva_features_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Corpiva_Repeater( $wp_customize, 
				'corpiva_features_option', 
					array(
						'label'   => esc_html__('Features','desert-companion'),
						'section' => 'features_options',
						'add_field_label'                   => esc_html__( 'Add New Features', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Features', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'corpiva_features_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'corpiva_features_option_upsale', 
			array(
				'label'      => __( 'Features', 'desert-companion' ),
				'section'    => 'features_options'
			) 
		) 
	);			
			
	/*=========================================
	Background
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_features_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'corpiva_features_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Image
	$wp_customize->add_setting( 
    	'corpiva_features_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/feature_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',	
			'priority' => 6,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'corpiva_features_img' ,
		array(
			'label'          => __( 'Image', 'desert-companion' ),
			'section'        => 'features_options',
		) 
	));	
}
add_action( 'customize_register', 'corpiva_features_customize_setting' );