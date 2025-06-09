<?php
function softme_protect_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Protect  Section
	=========================================*/
	$wp_customize->add_section(
		'protect_options', array(
			'title' => esc_html__( 'Protect Section', 'desert-companion' ),
			'priority' => 3,
			'panel' => 'softme_frontpage_options',
		)
	);
	
	/*=========================================
	Left  Section
	=========================================*/
	$wp_customize->add_setting(
		'softme_protect_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'softme_protect_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'protect_options',
		)
	);
	
	//  Content
	if ( class_exists( 'SoftMe_Page_Editor' ) ) {
		$softme_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $softme_page_editor_path ) ) {
			require_once( $softme_page_editor_path );
		}
		$wp_customize->add_setting(
			'softme_protect_left_content', array(
				'default' => '<div class="circle_shapes">
                                <div class="circle"></div>
                            </div>
                            <div class="dt_image_box image-1">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/suntech/assets/images/resource/protect-1.png" alt=""/>                                        
                                </figure>
                            </div>
                            <div class="dt_image_box image-2">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/suntech/assets/images/resource/protect-2.jpg" alt=""/>
                                </figure>
                                <div class="dt_image_video">
                                    <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play dt-btn-primary" data-caption="">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 5,
				
			)
		);

		$wp_customize->add_control(
			new SoftMe_Page_Editor(
				$wp_customize, 'softme_protect_left_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'protect_options',
					'needsync' => true,
				)
			)
		);
	}
	
	
	/*=========================================
	Right  Section
	=========================================*/
	$wp_customize->add_setting(
		'softme_protect_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'softme_protect_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'protect_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'softme_protect_right_ttl',
    	array(
	        'default'			=> __('<b class="is_on">Advance Protect</b><b>Advance Protect</b><b>Advance Protect</b>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_protect_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'protect_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'softme_protect_right_subttl',
    	array(
	        'default'			=> __('Protecting your privacy Is </br><span>Our Priority</span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_protect_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'protect_options',
			'type'           => 'textarea',
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'softme_protect_right_text',
    	array(
	        'default'			=> 'Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 8,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_protect_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'protect_options',
			'type'           => 'textarea',
		)  
	);
	
	
	// Protect 
		$wp_customize->add_setting( 'softme_protect_option', 
			array(
			 'sanitize_callback' => 'softme_repeater_sanitize',
			 'priority' => 5,
			  'default' => softme_protect_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new SoftMe_Repeater( $wp_customize, 
				'softme_protect_option', 
					array(
						'label'   => esc_html__('Protect','desert-companion'),
						'section' => 'protect_options',
						'add_field_label'                   => esc_html__( 'Add New Protect', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Protect', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
					) 
				) 
			);
			
	// Upgrade
	$wp_customize->add_setting(
	'softme_protect_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'softme_protect_option_upsale', 
			array(
				'label'      => __( 'List', 'desert-companion' ),
				'section'    => 'protect_options'
			) 
		) 
	);		
}

add_action( 'customize_register', 'softme_protect_customize_setting' );