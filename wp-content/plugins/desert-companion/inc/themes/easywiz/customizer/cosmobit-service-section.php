<?php
function cosmobit_service5_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
$desert_activated_theme = wp_get_theme(); // gets the current theme
	/*=========================================
	ServiceService  Section
	=========================================*/
	$wp_customize->add_section(
		'service5_options', array(
			'title' => esc_html__( 'Service Section', 'desert-companion' ),
			'priority' => 4,
			'panel' => 'cosmobit_frontpage5_options',
		)
	);
	
	/*=========================================
	Service Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Service Setting','desert-companion'),
			'section' => 'service5_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_service_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'service5_options',
		)
	);
	
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service5_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service5_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'service5_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_service5_ttl',
    	array(
	        'default'			=> __('Services','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service5_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'service5_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_service5_subttl',
    	array(
	        'default'			=> __('We Serve the Best Work','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service5_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'service5_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Description // 
	$wp_customize->add_setting(
    	'cosmobit_service5_text',
    	array(
	        'default'			=> __('The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_service5_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'service5_options',
			'type'           => 'textarea',
		)  
	);
	
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_service5_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_service5_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'service5_options',
		)
	);
	
	// Service 
	if( 'EasyWiz' == $desert_activated_theme->name  || 'Auru' == $desert_activated_theme->name){
	$wp_customize->add_setting( 'cosmobit_service6_option', 
		array(
		 'sanitize_callback' => 'cosmobit_repeater_sanitize',
		 'priority' => 5,
		  'default' => cosmobit_service3_options_default()
		)
	);
	
	$wp_customize->add_control( 
		new Cosmobit_Repeater( $wp_customize, 
			'cosmobit_service6_option', 
				array(
					'label'   => esc_html__('Service','desert-companion'),
					'section' => 'service5_options',
					'add_field_label'                   => esc_html__( 'Add New Service', 'desert-companion' ),
					'item_name'                         => esc_html__( 'Service', 'desert-companion' ),
					
					'customizer_repeater_icon_control' => true,
					'customizer_repeater_title_control' => true,
					'customizer_repeater_text_control' => true,
					'customizer_repeater_text2_control' => true,
					'customizer_repeater_link_control' => true,
					'customizer_repeater_image_control' => true,
				) 
			) 
		);
	}else{
		$wp_customize->add_setting( 'cosmobit_service6_option', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'priority' => 5,
			  'default' => cosmobit_service3_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_service6_option', 
					array(
						'label'   => esc_html__('Service','desert-companion'),
						'section' => 'service5_options',
						'add_field_label'                   => esc_html__( 'Add New Service', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Service', 'desert-companion' ),
						
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	}		
	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_service_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_service_option_upsale', 
			array(
				'label'      => __( 'Service', 'desert-companion' ),
				'section'    => 'service5_options'
			) 
		) 
	);	

	// Background Image // 
	if( 'LazyPress' == $desert_activated_theme->name){
		$wp_customize->add_setting( 
			'cosmobit_service6_image' , 
			array(
				'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/celexo/assets/images/cta-two-bg.jpg'),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'cosmobit_sanitize_url',	
				'priority' => 6,
			) 
		);
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_service6_image' ,
			array(
				'label'          => esc_html__( 'Background Image', 'desert-companion'),
				'section'        => 'service5_options',
			) 
		));	
	}
	
}
add_action( 'customize_register', 'cosmobit_service5_customize_setting' );