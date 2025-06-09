<?php
function atua_features_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Features  Section
	=========================================*/
	$wp_customize->add_section(
		'features_options', array(
			'title' => esc_html__( 'Features Section', 'desert-companion' ),
			'priority' => 10,
			'panel' => 'atua_frontpage_options',
		)
	);
	
	/*=========================================
	Features Setting
	=========================================*/
	$wp_customize->add_setting(
		'atua_features_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_features_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Features Setting','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'atua_features_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_features_options_hide_show',
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
		'atua_features_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_features_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'atua_features_ttl',
    	array(
	        'default'			=> __('Why Choose Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_features_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'atua_features_subttl',
    	array(
	        'default'			=> __('Find Out More Our<span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Features</b> <b>Features</b> <b>Features</b></span></span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_features_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'atua_features_text',
    	array(
	        'default'			=> __('Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_features_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'atua_features_btn_lbl',
    	array(
	        'default'			=> __('View All','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_features_btn_lbl',
		array(
		    'label'   => __('Button Label','desert-companion'),
		    'section' => 'features_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'atua_features_btn_link',
    	array(
	        'default'			=> __('#','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_url',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_features_btn_link',
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
		'atua_features_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'atua_features_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Features 
		$wp_customize->add_setting( 'atua_features_option', 
			array(
			 'sanitize_callback' => 'atua_repeater_sanitize',
			 'priority' => 5,
			  'default' => atua_features_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Atua_Repeater( $wp_customize, 
				'atua_features_option', 
					array(
						'label'   => esc_html__('Features','desert-companion'),
						'section' => 'features_options',
						'add_field_label'                   => esc_html__( 'Add New Features', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Features', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);
	
	// Upgrade
	$wp_customize->add_setting(
	'atua_feature_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'atua_feature_option_upsale', 
			array(
				'label'      => __( 'Features', 'desert-companion' ),
				'section'    => 'features_options'
			) 
		) 
	);	
	
	/*=========================================
	Background  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_features_cta_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'atua_features_cta_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','desert-companion'),
			'section' => 'features_options',
		)
	);
	
	// Image
	$wp_customize->add_setting( 
    	'atua_features_cta_bg_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/slider/slider_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_url',	
			'priority' => 6,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'atua_features_cta_bg_img' ,
		array(
			'label'          => __( 'Background Image', 'desert-companion' ),
			'section'        => 'features_options',
		) 
	));
	
	
	// slider opacity
	if ( class_exists( 'Atua_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'atua_features_cta_opacity',
			array(
				'default'	      => '0.95',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'atua_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
		new Atua_Customizer_Range_Control( $wp_customize, 'atua_features_cta_opacity', 
			array(
				'label'      => __( 'opacity', 'desert-companion' ),
				'section'  => 'features_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 1,
							'step'          => 0.1,
							'default_value' => 0.95,
						),
					),
			) ) 
		);
	}
	
	 // Overlay Color
	$wp_customize->add_setting(
	'atua_features_cta_overlay', 
	array(
		'default'	      => '#0e1422',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'atua_features_cta_overlay', 
			array(
				'label'      => __( 'Overlay Color', 'desert-companion' ),
				'section'    => 'features_options'
			) 
		) 
	);
	
}
add_action( 'customize_register', 'atua_features_customize_setting' );