<?php
function corpiva_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'corpiva'),
		) 
	);

	/*=========================================
	Footer Widget
	=========================================*/
	$wp_customize->add_section(
        'corpiva_footer_widget',
        array(
            'title' 		=> __('Footer Widget','corpiva'),
			'panel'  		=> 'footer_options',
			'priority'      => 3,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'corpiva_footer_mid_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'corpiva_footer_mid_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Middle','corpiva'),
			'section' => 'corpiva_footer_widget',
			'priority'  => 1,
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'corpiva_footer_mid_ttl',
    	array(
	        'default'			=> __('LET’S GET In TOUCH','corpiva'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'transport'         => $selective_refresh
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_footer_mid_ttl',
		array(
		    'label'   => __('Title','corpiva'),
		    'section' => 'corpiva_footer_widget',
			'type'           => 'text',
			'priority' => 1,
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'corpiva_footer_mid_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',
		)
	);	
	
	$wp_customize->add_control( 
		'corpiva_footer_mid_link',
		array(
		    'label'   => __('Button Link','corpiva'),
		    'section' => 'corpiva_footer_widget',
			'type'           => 'text',
			'priority' => 1,
		)  
	);
	
	// Open New Tab
	$wp_customize->add_setting( 
		'corpiva_footer_mid_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_footer_mid_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'corpiva' ),
			'section'     => 'corpiva_footer_widget',
			'type'        => 'checkbox',
			'priority' => 1,
		) 
	);	
	
	// Heading
	$wp_customize->add_setting(
		'corpiva_footer_widget_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'corpiva_footer_widget_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Widget','corpiva'),
			'section' => 'corpiva_footer_widget',
			'priority'  => 1,
		)
	);
	
	
	// column // 
	$wp_customize->add_setting(
    	'corpiva_footer_widget_column',
    	array(
	        'default'			=> '4',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(
		'corpiva_footer_widget_column',
		array(
		    'label'   		=> __('Select Widget Column','corpiva'),
		    'section' 		=> 'corpiva_footer_widget',
			'type'			=> 'select',
			'choices'        => 
			array(
				'' => __( 'None', 'corpiva' ),
				'1' => __( '1 Column', 'corpiva' ),
				'2' => __( '2 Column', 'corpiva' ),
				'3' => __( '3 Column', 'corpiva' ),
				'4' => __( '4 Column', 'corpiva' )
			) 
		) 
	);
	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'corpiva_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','corpiva'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'corpiva_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'corpiva_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','corpiva'),
			'section' => 'corpiva_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer third text // 
	$corpiva_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'corpiva' );
	$wp_customize->add_setting(
    	'corpiva_footer_copyright_text',
    	array(
			'default' => $corpiva_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'corpiva_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright','corpiva'),
		    'section'		=> 'corpiva_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	

	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background_options',
        array(
            'title' 		=> __('Footer Background','corpiva'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	
	//  Footer Background Color
	$wp_customize->add_setting(
	'corpiva_footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'default' => '#0F0D1D'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'corpiva_footer_bg_color', 
			array(
				'label'      => __( 'Footer Background Color', 'corpiva' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
}
add_action( 'customize_register', 'corpiva_footer_customize_settings' );