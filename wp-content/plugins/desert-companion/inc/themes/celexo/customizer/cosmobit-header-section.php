<?php
function desert_celexo_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Contact Details
	=========================================*/
	$wp_customize->add_setting(
		'Cosmobit_hdr_contact_details_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 27,
		)
	);

	$wp_customize->add_control(
	'Cosmobit_hdr_contact_details_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Details','desert-companion'),
			'section' => 'cosmobit_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'cosmobit_hs_hdr_contact_details' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 28,
		) 
	);
	
	$wp_customize->add_control(
	'cosmobit_hs_hdr_contact_details', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'desert-companion' ),
			'section'     => 'cosmobit_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	// Contact Details
		$wp_customize->add_setting( 'cosmobit_hdr_contact_details', 
			array(
			 'sanitize_callback' => 'cosmobit_repeater_sanitize',
			 'transport'         => $selective_refresh,
			 'priority' => 29,
			 'default' => cosmobit_get_header_contact_default()
			)
		);
		
		$wp_customize->add_control( 
			new Cosmobit_Repeater( $wp_customize, 
				'cosmobit_hdr_contact_details', 
					array(
						'label'   => esc_html__('Contact','desert-companion'),
						'section' => 'cosmobit_top_header',
						'add_field_label'                   => esc_html__( 'Add New Contact', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Contact', 'desert-companion' ),
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);	

	// Upgrade
	$wp_customize->add_setting(
	'cosmobit_hdr_contact_details_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'cosmobit_hdr_contact_details_upsale', 
			array(
				'label'      => __( 'Contact', 'desert-companion' ),
				'section'    => 'cosmobit_top_header'
			) 
		) 
	);		
}
add_action( 'customize_register', 'desert_celexo_header_customize_settings' );

