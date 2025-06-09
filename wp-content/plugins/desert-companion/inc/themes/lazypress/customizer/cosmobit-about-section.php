<?php
function cosmobit_about5_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About  Section
	=========================================*/
	$wp_customize->add_section(
		'about5_options', array(
			'title' => esc_html__( 'About Section', 'desert-companion' ),
			'priority' => 3,
			'panel' => 'cosmobit_frontpage5_options',
		)
	);
	
	/*=========================================
	About Setting
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_about_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_about_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('About Setting','desert-companion'),
			'section' => 'about5_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'cosmobit_about_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'cosmobit_about_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'about5_options',
		)
	);
	
	/*=========================================
	Left  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_about5_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'cosmobit_about5_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'about5_options',
		)
	);
	
	
	$wp_customize->add_setting( 
    	'cosmobit_about5_left_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/cosmobit/assets/images/what-we-do.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_url',	
			'priority' => 3,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cosmobit_about5_left_img' ,
		array(
			'label'          => __( 'Left Image', 'desert-companion' ),
			'section'        => 'about5_options',
		) 
	));
	
	
	/*=========================================
	Right  Section
	=========================================*/
	$wp_customize->add_setting(
		'cosmobit_about5_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'cosmobit_about5_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'about5_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'cosmobit_about5_right_ttl',
    	array(
	        'default'			=> __('About Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_about5_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'about5_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cosmobit_about5_right_subttl',
    	array(
	        'default'			=> __('One Of The Fastest Way To Gain Business Success','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_about5_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'about5_options',
			'type'           => 'text',
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'cosmobit_about5_right_text',
    	array(
	        'default'			=> 'Proin viverra posuere varius lorem nisi. Egestas odio urna sed in accumsan curabitur. Fringilla magna sed orci, et sit sapien nunc non vel. Quam elit non sed mus amet, tortor ullamcorper. Ligula eu malesuada pellentesque nec tincidunt. Ut pharetra dolor nulla. Ut enim ad minim veniam.<br><br>
                                    You need to be sure there isn’t anything embarrassing hidden in the middle of text. All the lorem generators on the Internet.',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 8,
		)
	);	
	
	$wp_customize->add_control( 
		'cosmobit_about5_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'about5_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Content
	if ( class_exists( 'Cosmobit_Page_Editor' ) ) {
		$cosmobit_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $cosmobit_page_editor_path ) ) {
			require_once( $cosmobit_page_editor_path );
		}
		$wp_customize->add_setting(
			'cosmobit_about5_right_content', array(
				'default' => '<div class="dt__about-feature-classic">
                                    <ul class="business-list">
                                        <li>Product Engineering</li>
                                        <li>IT Consultancy</li>
                                        <li>Digital Services</li>
                                        <li>100% Security</li>
                                        <li>Varius lacus vel donec in</li>
                                        <li>Scelerisque venenatis</li>
                                    </ul>
                                </div>
                                <a href="#" class="dt-btn dt-btn-primary dt-mt-5">Discover More</a>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 9,
				
			)
		);

		$wp_customize->add_control(
			new Cosmobit_Page_Editor(
				$wp_customize, 'cosmobit_about5_right_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about5_options',
					'needsync' => true,
				)
			)
		);
	}
}

add_action( 'customize_register', 'cosmobit_about5_customize_setting' );