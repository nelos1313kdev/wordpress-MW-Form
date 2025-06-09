<?php
function atua_about_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About  Section
	=========================================*/
	$wp_customize->add_section(
		'about_options', array(
			'title' => esc_html__( 'About Section', 'desert-companion' ),
			'priority' => 3,
			'panel' => 'atua_frontpage_options',
		)
	);
	
	/*=========================================
	About Setting
	=========================================*/
	$wp_customize->add_setting(
		'atua_about_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_about_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('About Setting','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'atua_about_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_about_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	/*=========================================
	Left  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_about_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_about_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Content
	if ( class_exists( 'Atua_Page_Editor' ) ) {
		$atua_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $atua_page_editor_path ) ) {
			require_once( $atua_page_editor_path );
		}
		$wp_customize->add_setting(
			'atua_about_left_content', array(
				'default' => '<div class="dt_image_block dt_image_block--one">
                                <div class="dt_image_box">
                                    <div class="shape parallax-scene parallax-scene-1">
                                        <div data-depth="0.40" class="shape-1" style="background-image: url('.esc_url(get_template_directory_uri()) . '/assets/images/shape/shape_2.svg);"></div>
                                        <div data-depth="0.50" class="shape-2" style="background-image: url('.esc_url(get_template_directory_uri()) . '/assets/images/shape/shape_2.svg);"></div>
                                    </div>
                                    <figure class="image image-1">
                                        <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/atua/assets/images/resource/about-1.jpg" alt="">
                                    </figure>
                                    <div class="video-inner" style="background-image: url('.esc_url(desert_companion_plugin_url) . '/inc/themes/atua/assets/images/resource/about-2.jpg);">
                                        <div class="video-btn">
                                            <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play" data-caption="">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 5,
				
			)
		);

		$wp_customize->add_control(
			new Atua_Page_Editor(
				$wp_customize, 'atua_about_left_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}
	
	
	/*=========================================
	Right  Section
	=========================================*/
	$wp_customize->add_setting(
		'atua_about_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'atua_about_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'atua_about_right_ttl',
    	array(
	        'default'			=> __('About Us','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_about_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'atua_about_right_subttl',
    	array(
	        'default'			=> __('The Best Solutions for Best
                                            <span class="dt_heading dt_heading_9">
                                                <span class="dt_heading_inner">
                                                    <b class="is_on">Business</b>
                                                    <b>Services</b>
                                                    <b>Solutions</b>
                                                </span>
                                            </span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_about_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'atua_about_right_text',
    	array(
	        'default'			=> 'Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam quis nostrud exercitation laboris.',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 8,
		)
	);	
	
	$wp_customize->add_control( 
		'atua_about_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Content
	if ( class_exists( 'Atua_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'atua_about_right_content', array(
				'default' => '<ul class="dt_list_style dt_list_style--one dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
                                        <li>Clients Focused</li>
                                        <li>Targeting & Positioning</li>
                                        <li>We Can Save You Money</li>
                                        <li>Tax Advantages</li>
                                        <li>Unique Ideas & Solution</li>
                                    </ul>
                                    <div class="btn-box dt-mt-5 wow fadeInUp" data-wow-duration="1500ms">
                                        <a href="#" class="dt-btn dt-btn-primary">
                                            <span class="dt-btn-text" data-text="Get A Quote">Get A Quote</span>
                                        </a>
                                    </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 9,
				
			)
		);

		$wp_customize->add_control(
			new Atua_Page_Editor(
				$wp_customize, 'atua_about_right_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}
}

add_action( 'customize_register', 'atua_about_customize_setting' );