<?php
function softme_information_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Information Section
	=========================================*/
	$wp_customize->add_section(
		'information_options', array(
			'title' => esc_html__( 'Information Section', 'desert-companion' ),
			'panel' => 'softme_frontpage_options',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Information Setting
	=========================================*/
	$wp_customize->add_setting(
		'softme_information_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_information_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('Information Setting','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'softme_information_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_information_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	/*=========================================
	Information Content
	=========================================*/
	$wp_customize->add_setting(
		'information_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'information_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Information Contents','desert-companion'),
			'section' => 'information_options',
		)
	);
	
	// Information 
	$desert_activated_theme = wp_get_theme(); // gets the current theme
	if( 'CozySoft' == $desert_activated_theme->name){
		$wp_customize->add_setting( 'softme_information_option2', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			 'default' => softme_information_options2_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_information_option2', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);
	}elseif( 'Suntech' == $desert_activated_theme->name  || 'SoftMunch' == $desert_activated_theme->name){
		$wp_customize->add_setting( 'softme_information_option3', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			 'default' => softme_information_options3_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_information_option3', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);	
	}elseif( 'EasyTech' == $desert_activated_theme->name || 'SoftAlt' == $desert_activated_theme->name){
		$wp_customize->add_setting( 'softme_information_option4', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			 'default' => softme_information_options3_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_information_option4', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);			
	}else{
		$wp_customize->add_setting( 'softme_information_option', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			 'default' => softme_information_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_information_option', 
					array(
						'label'   => esc_html__('Information','desert-companion'),
						'section' => 'information_options',
						'add_field_label'                   => esc_html__( 'Add New Information', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Information', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
	}
	// Upgrade
	$wp_customize->add_setting(
	'softme_information_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'softme_information_option_upsale', 
			array(
				'label'      => __( 'Information', 'desert-companion' ),
				'section'    => 'information_options'
			) 
		) 
	);	
}
add_action( 'customize_register', 'softme_information_customize_setting' );