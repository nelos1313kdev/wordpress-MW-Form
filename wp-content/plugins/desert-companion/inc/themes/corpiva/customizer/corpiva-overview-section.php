<?php
function corpiva_overview_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Overview  Section
	=========================================*/
	$wp_customize->add_section(
		'overview_options', array(
			'title' => esc_html__( 'Overview Section', 'desert-companion' ),
			'priority' => 4,
			'panel' => 'corpiva_frontpage_options',
		)
	);
	
	/*=========================================
	Overview Setting
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_overview_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_overview_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Overview Setting','desert-companion'),
			'section' => 'overview_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'corpiva_overview_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'corpiva_overview_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'overview_options',
		)
	);
	
	/*=========================================
	Left  Section
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_overview_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_overview_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'overview_options',
		)
	);
	
	// Image // 
    $wp_customize->add_setting( 
    	'corpiva_overview_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/overview01.png'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',	
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'corpiva_overview_img' ,
		array(
			'label'          => esc_html__( 'Image 1', 'desert-companion'),
			'section'        => 'overview_options',
		) 
	));
	
	// Image // 
    $wp_customize->add_setting( 
    	'corpiva_overview_img2' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/overview02.png'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',	
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'corpiva_overview_img2' ,
		array(
			'label'          => esc_html__( 'Image 2', 'desert-companion'),
			'section'        => 'overview_options',
		) 
	));
	
	
	// icon // 
	$wp_customize->add_setting(
    	'corpiva_overview_icon',
    	array(
	        'default' => 'fat fa-file-chart-pie',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		)
	);	

	$wp_customize->add_control(new Corpiva_Icon_Picker_Control($wp_customize, 
		'corpiva_overview_icon',
		array(
		    'label'   		=> __('Icon','desert-companion'),
		    'section' 		=> 'overview_options'
			
		))  
	);
	
	/*=========================================
	Right  Section
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_overview_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_overview_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'overview_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'corpiva_overview_right_ttl',
    	array(
	        'default'			=> __('Company Overview','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_overview_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'overview_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'corpiva_overview_right_subttl',
    	array(
	        'default'			=> __('Plan your business strategy with Our Experts','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_overview_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'overview_options',
			'type'           => 'text',
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'corpiva_overview_right_text',
    	array(
	        'default'			=> __('Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.Borem ipsum dolor sit amet, consectetur adipiscing elita florai psum.</br>Morem ipsum dolor sit amet, consectetur adipiscing elita florai psum dolor sit amet, consecteture.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 8,
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_overview_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'overview_options',
			'type'           => 'textarea',
		)  
	);
	
	// counter 
		$wp_customize->add_setting( 'corpiva_ov_counter_option', 
			array(
			 'sanitize_callback' => 'corpiva_repeater_sanitize',
			 'priority' => 8,
			 'default' => corpiva_ov_counter_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Corpiva_Repeater( $wp_customize, 
				'corpiva_ov_counter_option', 
					array(
						'label'   => esc_html__('Counter','desert-companion'),
						'section' => 'overview_options',
						'add_field_label'                   => esc_html__( 'Add New Counter', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Counter', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'corpiva_ov_counter_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 8,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'corpiva_ov_counter_option_upsale', 
			array(
				'label'      => __( 'Counter', 'desert-companion' ),
				'section'    => 'overview_options'
			) 
		) 
	);			
}
add_action( 'customize_register', 'corpiva_overview_customize_setting' );