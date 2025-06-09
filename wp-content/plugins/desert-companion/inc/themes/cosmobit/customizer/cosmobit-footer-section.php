<?php
function desert_cosmobit_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'desert-companion'),
		) 
	);
	
	/*=========================================
	Footer Top
	=========================================*/	
	$wp_customize->add_section(
        'cosmobit_footer_top_options',
        array(
            'title' 		=> __('Footer Top','desert-companion'),
			'panel'  		=> 'footer_options',
			'priority'      => 2,
		)
    );
	// Heading
	$wp_customize->add_setting(
		'cosmobit_footer_top_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'cosmobit_footer_top_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Top','desert-companion'),
			'section' => 'cosmobit_footer_top_options',
			'priority' => 2,
		)
	);
	
	// hide/show
	$wp_customize->add_setting( 
		'cosmobit_hs_footer_top' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_footer_top', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_footer_top_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//content
	$wp_customize->add_setting( 'cosmobit_footer_top_info', 
		array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'default' => cosmobit_get_footer_top_default(),
			 'transport'         => $selective_refresh,
			 'priority' => 2,
			)
		);
		
		$wp_customize->add_control( 
			new COSMOBIT_Repeater( $wp_customize, 
				'cosmobit_footer_top_info', 
					array(
						'label'   => esc_html__('Content','desert-companion'),
						'section' => 'cosmobit_footer_top_options',
						'add_field_label'                   => esc_html__( 'Add New', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Content', 'desert-companion' ),
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);

	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_footer_top_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 2,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_footer_top_option_upsale', 
			array(
				'label'      => __( 'Content', 'desert-companion' ),
				'section'    => 'cosmobit_footer_top_options'
			) 
		) 
	);			
}
add_action( 'customize_register', 'desert_cosmobit_footer_customize_settings' );