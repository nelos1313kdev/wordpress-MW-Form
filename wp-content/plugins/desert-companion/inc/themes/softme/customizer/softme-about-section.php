<?php
function softme_about_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About  Section
	=========================================*/
	$wp_customize->add_section(
		'about_options', array(
			'title' => esc_html__( 'About Section', 'desert-companion' ),
			'priority' => 3,
			'panel' => 'softme_frontpage_options',
		)
	);
	
	/*=========================================
	About Setting
	=========================================*/
	$wp_customize->add_setting(
		'softme_about_options_setting'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'cosmobit_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_about_options_setting',
		array(
			'type' => 'hidden',
			'label' => __('About Setting','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	// Hide/Show Setting
	$wp_customize->add_setting(
		'softme_about_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'softme_about_options_hide_show',
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
		'softme_about_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'softme_about_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Content
	if ( class_exists( 'SoftMe_Page_Editor' ) ) {
		$softme_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $softme_page_editor_path ) ) {
			require_once( $softme_page_editor_path );
		}
		$wp_customize->add_setting(
			'softme_about_left_content', array(
				'default' => '<div class="dt_image_box image-1 paroller">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/softme/assets/images/resource/about-1.jpg" alt=""/>                                        
                                </figure>
                                <div class="dt_image_video">
                                    <a href="https://youtu.be/MLpWrANjFbI" class="dt_lightbox_img dt-btn-play2 dt-btn-primary" data-caption="">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="dt_image_box image-2 paroller-2">
                                <figure class="image">
                                    <img src="'.esc_url(desert_companion_plugin_url) . '/inc/themes/softme/assets/images/resource/about-2.jpg" alt=""/>
                                </figure>
                            </div>
                            <div class="dt_image_text">
                                <span class="dt_count_box">
                                    <span class="dt_count_text" data-speed="2500" data-stop="25">0</span><span class="text">Years Experience</span>
                                </span>                                
                            </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 5,
				
			)
		);

		$wp_customize->add_control(
			new SoftMe_Page_Editor(
				$wp_customize, 'softme_about_left_content', array(
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
		'softme_about_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'softme_about_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'softme_about_right_ttl',
    	array(
	        'default'			=> __('<b class="is_on">About Our Company</b><b>About Our Company</b><b>About Our Company</b>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_about_right_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'softme_about_right_subttl',
    	array(
	        'default'			=> __('We are Partner of Your </br><span>Innovations</span>','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_about_right_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'softme_about_right_text',
    	array(
	        'default'			=> "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even.",
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'softme_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 8,
		)
	);	
	
	$wp_customize->add_control( 
		'softme_about_right_text',
		array(
		    'label'   => __('Text','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Content
	if ( class_exists( 'SoftMe_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'softme_about_right_content', array(
				'default' => '<ul class="dt_content_about_info style1 wow fadeInUp" data-wow-duration="1500ms">
                                    <li>
                                        <aside class="widget widget_contact">
                                            <div class="contact__list">
                                                <i class="fas fa-cubes" aria-hidden="true"></i>
                                                <div class="contact__body">
                                                    <h5 class="title"><a href="#">IT Consultant</a></h5>
                                                    <p class="description">Smarter Solutions</p>
                                                </div>
                                            </div>
                                        </aside>
                                    </li>
                                    <li>
                                        <aside class="widget widget_contact">
                                            <div class="contact__list">
                                                <i class="fas fa-medal" aria-hidden="true"></i>
                                                <div class="contact__body">
                                                    <h5 class="title"><a href="#">IT Specialist</a></h5>
                                                    <p class="description">Faster Solutions</p>
                                                </div>
                                            </div>
                                        </aside>
                                    </li>
                                </ul>
                                <ul class="dt_list_style dt_list_style--two dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
                                    <li>Exploring version oflorem veritatis proin.</li>
                                    <li>Auctor aliquet aenean simply free text veritatis quis.</li>
                                    <li>Consequat ipsum nec lorem sagittis sem nibh.</li>
                                </ul>
                                <div class="dt_btn-group dt-mt-5 wow fadeInUp" data-wow-duration="1500ms">
                                    <a href="#" class="dt-btn dt-btn-primary">
                                        <span class="dt-btn-text" data-text="Learn More">Learn More</span>
                                    </a>
                                </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 9,
				
			)
		);

		$wp_customize->add_control(
			new SoftMe_Page_Editor(
				$wp_customize, 'softme_about_right_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}
}

add_action( 'customize_register', 'softme_about_customize_setting' );