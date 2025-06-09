<?php
function corpiva_typography_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_panel(
		'corpiva_typography_options', array(
			'priority' => 38,
			'title' => esc_html__( 'Typography', 'corpiva' ),
		)
	);	
	
	/*=========================================
	corpiva Typography
	=========================================*/
	$wp_customize->add_section(
        'corpiva_typography_options',
        array(
        	'priority'      => 1,
            'title' 		=> __('Body Typography','corpiva'),
			'panel'  		=> 'corpiva_typography_options',
		)
    );
	
	
	// Body Font Size // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_body_font_size_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_body_font_size_option', 
			array(
				'label'      => __( 'Size', 'corpiva' ),
				'section'  => 'corpiva_typography_options',
				'priority'      => 2,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                ),
			) ) 
		);
	}
	
	// Body Font Size // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_body_line_height_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_body_line_height_option', 
			array(
				'label'      => __( 'Line Height', 'corpiva' ),
				'section'  => 'corpiva_typography_options',
				'priority'      => 3,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font Size // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_body_ltr_space_option',
			array(
                'default'           => '0.1',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_body_ltr_space_option', 
			array(
				'label'      => __( 'Letter Spacing', 'corpiva' ),
				'section'  => 'corpiva_typography_options',
				'priority'      => 4,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font weight // 
	 $wp_customize->add_setting( 'corpiva_body_font_weight_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'corpiva_body_font_weight_option', array(
            'label'       => __( 'Weight', 'corpiva' ),
            'section'     => 'corpiva_typography_options',
            'type'        =>  'select',
            'priority'    => 5,
            'choices'     =>  array(
                'inherit'   =>  __( 'Default', 'corpiva' ),
                '100'       =>  __( 'Thin: 100', 'corpiva' ),
                '200'       =>  __( 'Light: 200', 'corpiva' ),
                '300'       =>  __( 'Book: 300', 'corpiva' ),
                '400'       =>  __( 'Normal: 400', 'corpiva' ),
                '500'       =>  __( 'Medium: 500', 'corpiva' ),
                '600'       =>  __( 'Semibold: 600', 'corpiva' ),
                '700'       =>  __( 'Bold: 700', 'corpiva' ),
                '800'       =>  __( 'Extra Bold: 800', 'corpiva' ),
                '900'       =>  __( 'Black: 900', 'corpiva' ),
                ),
            )
        )
    );
	
	// Body Font style // 
	 $wp_customize->add_setting( 'corpiva_body_font_style_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'corpiva_body_font_style_option', array(
            'label'       => __( 'Font Style', 'corpiva' ),
            'section'     => 'corpiva_typography_options',
            'type'        =>  'select',
            'priority'    => 6,
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'corpiva' ),
                'normal'       =>  __( 'Normal', 'corpiva' ),
                'italic'       =>  __( 'Italic', 'corpiva' ),
                'oblique'       =>  __( 'oblique', 'corpiva' ),
                ),
            )
        )
    );
	// Body Text Transform // 
	 $wp_customize->add_setting( 'corpiva_body_text_transform_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'corpiva_body_text_transform_option', array(
                'label'       => __( 'Transform', 'corpiva' ),
                'section'     => 'corpiva_typography_options',
                'type'        => 'select',
                'priority'    => 7,
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'corpiva' ),
                    'uppercase'     =>  __( 'Uppercase', 'corpiva' ),
                    'lowercase'     =>  __( 'Lowercase', 'corpiva' ),
                    'capitalize'    =>  __( 'Capitalize', 'corpiva' ),
                ),
            )
        )
    );
	
	// Body Text Decoration // 
	 $wp_customize->add_setting( 'corpiva_body_txt_decoration_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'corpiva_body_txt_decoration_option', array(
                'label'       => __( 'Text Decoration', 'corpiva' ),
                'section'     => 'corpiva_typography_options',
                'type'        => 'select',
                'priority'    => 8,
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'corpiva' ),
                    'underline'     =>  __( 'Underline', 'corpiva' ),
                    'overline'     =>  __( 'Overline', 'corpiva' ),
                    'line-through'    =>  __( 'Line Through', 'corpiva' ),
					'none'    =>  __( 'None', 'corpiva' ),
                ),
            )
        )
    );
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'corpiva_body_typography_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'corpiva_body_typography_option_upsale', 
				array(
					'label'      => __( 'Typography Features', 'corpiva' ),
					'section'    => 'corpiva_typography_options',
					'priority' => 8,
				) 
			) 
		);	
	}
	
	/*=========================================
	 corpiva Typography Headings
	=========================================*/
	$wp_customize->add_section(
        'corpiva_headings_typography',
        array(
        	'priority'      => 2,
            'title' 		=> __('Headings (H1-H6) Typography','corpiva'),
			'panel'  		=> 'corpiva_typography_options',
		)
    );
	
	/*=========================================
	 corpiva Typography H1
	=========================================*/
	for ( $i = 1; $i <= 6; $i++ ) {
	if($i  == '1'){$j=36;}elseif($i  == '2'){$j=32;}elseif($i  == '3'){$j=28;}elseif($i  == '4'){$j=24;}elseif($i  == '5'){$j=20;}else{$j=16;}
	$wp_customize->add_setting(
		'h' . $i . '_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'h' . $i . '_typography',
		array(
			'type' => 'hidden',
			'label' => esc_html('H' . $i .' Typography','corpiva'),
			'section' => 'corpiva_headings_typography',
		)
	);
	
	// Heading Font Size // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_h' . $i . '_font_size_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_h' . $i . '_font_size_option', 
			array(
				'label'      => __( 'Font Size', 'corpiva' ),
				'section'  => 'corpiva_headings_typography',
				'media_query'   => true,
				'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'tablet'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'desktop' => array(
                       'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
					    'default_value' => $j,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font Size // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_h' . $i . '_line_height_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_h' . $i . '_line_height_option', 
			array(
				'label'      => __( 'Line Height', 'corpiva' ),
				'section'  => 'corpiva_headings_typography',
				'media_query'   => true,
				'input_attrs' => array(
					'min'    => 0,
					'max'    => 5,
					'step'   => 0.1,
					//'suffix' => 'px', //optional suffix
				),
				 'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
				)	
			) ) 
		);
		}
	// Heading Letter Spacing // 
	if ( class_exists( 'corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_h' . $i . '_ltr_space_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_h' . $i . '_ltr_space_option', 
			array(
				'label'      => __( 'Letter Spacing', 'corpiva' ),
				'section'  => 'corpiva_headings_typography',
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font weight // 
	 $wp_customize->add_setting( 'corpiva_h' . $i . '_font_weight_option', array(
		  'capability'        => 'edit_theme_options',
		  'default'           => '700',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'corpiva_sanitize_select',
		) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'corpiva_h' . $i . '_font_weight_option', array(
            'label'       => __( 'Font Weight', 'corpiva' ),
            'section'     => 'corpiva_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'corpiva' ),
                '100'       =>  __( 'Thin: 100', 'corpiva' ),
                '200'       =>  __( 'Light: 200', 'corpiva' ),
                '300'       =>  __( 'Book: 300', 'corpiva' ),
                '400'       =>  __( 'Normal: 400', 'corpiva' ),
                '500'       =>  __( 'Medium: 500', 'corpiva' ),
                '600'       =>  __( 'Semibold: 600', 'corpiva' ),
                '700'       =>  __( 'Bold: 700', 'corpiva' ),
                '800'       =>  __( 'Extra Bold: 800', 'corpiva' ),
                '900'       =>  __( 'Black: 900', 'corpiva' ),
                ),
            )
        )
    );
	
	// Heading Font style // 
	 $wp_customize->add_setting( 'corpiva_h' . $i . '_font_style_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'corpiva_h' . $i . '_font_style_option', array(
            'label'       => __( 'Font Style', 'corpiva' ),
            'section'     => 'corpiva_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'corpiva' ),
                'normal'       =>  __( 'Normal', 'corpiva' ),
                'italic'       =>  __( 'Italic', 'corpiva' ),
                'oblique'       =>  __( 'oblique', 'corpiva' ),
                ),
            )
        )
    );
	
	// Heading Text Transform // 
	 $wp_customize->add_setting( 'corpiva_h' . $i . '_text_transform_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'corpiva_h' . $i . '_text_transform_option', array(
                'label'       => __( 'Text Transform', 'corpiva' ),
                'section'     => 'corpiva_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'corpiva' ),
                    'uppercase'     =>  __( 'Uppercase', 'corpiva' ),
                    'lowercase'     =>  __( 'Lowercase', 'corpiva' ),
                    'capitalize'    =>  __( 'Capitalize', 'corpiva' ),
                ),
            )
        )
    );
	
	// Heading Text Decoration // 
	 $wp_customize->add_setting( 'corpiva_h' . $i . '_txt_decoration_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'corpiva_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'corpiva_h' . $i . '_txt_decoration_option', array(
                'label'       => __( 'Text Decoration', 'corpiva' ),
                'section'     => 'corpiva_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'corpiva' ),
                    'underline'     =>  __( 'Underline', 'corpiva' ),
                    'overline'     =>  __( 'Overline', 'corpiva' ),
                    'line-through'    =>  __( 'Line Through', 'corpiva' ),
					'none'    =>  __( 'None', 'corpiva' ),
                ),
            )
        )
    );
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'corpiva_h' . $i . '_typography_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'corpiva_h' . $i . '_typography_option_upsale', 
				array(
					'label'      => __( 'Typography Features', 'corpiva' ),
					'section'    => 'corpiva_headings_typography',
				) 
			) 
		);	
	}
}
}
add_action( 'customize_register', 'corpiva_typography_customize' );