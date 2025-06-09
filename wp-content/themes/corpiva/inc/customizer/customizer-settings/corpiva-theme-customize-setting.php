<?php
function corpiva_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'corpiva_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'corpiva' ),
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'corpiva' ),
			'priority' => 1,
			'panel' => 'corpiva_theme_options',
		)
	);
	
	
	/*=========================================
	Preloader
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'corpiva_preloader_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_preloader_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Preloader','corpiva'),
			'section' => 'site_general_options',
		)
	);
	
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'corpiva_hs_preloader_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_preloader_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'corpiva' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'corpiva_scroller_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'corpiva_scroller_option',
		array(
			'type' => 'hidden',
			'label' => __('Top Scroller','corpiva'),
			'section' => 'site_general_options',
		)
	);
	
	// Hide/show
	$wp_customize->add_setting( 
		'corpiva_hs_scroller_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'corpiva' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Corpiva Container
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'corpiva_site_container_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'corpiva_site_container_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Container','corpiva'),
			'section' => 'site_general_options',
		)
	);
	
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		//container width
		$wp_customize->add_setting(
			'corpiva_site_container_width',
			array(
				'default'			=> '2304',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 6,
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_site_container_width', 
			array(
				'label'      => __( 'Container Width', 'corpiva' ),
				'section'  => 'site_general_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 768,
                        'max'           => 2500,
                        'step'          => 1,
                        'default_value' => 2304,
                    ),
                ),
			) ) 
		);
	}
	
	
	/*=========================================
	Corpiva Search Result
	=========================================*/
	
	//  Head // 
	$wp_customize->add_setting(
		'corpiva_search_result_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'corpiva_search_result_head',
		array(
			'type' => 'hidden',
			'label' => __('Search Result','corpiva'),
			'section' => 'site_general_options',
		)
	);
	
	//  Style
	$wp_customize->add_setting( 
		'corpiva_search_result' , 
			array(
			'default' => 'post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'corpiva_search_result' , 
		array(
			'label'          => __( 'Search Result Page will Show ?', 'corpiva' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'post' 	=> __( 'Posts', 'corpiva' ),
				'product' 	=> __( 'WooCommerce Products', 'corpiva' ),
			) 
		) 
	);
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'corpiva_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'corpiva' ),
			'priority' => 12,
			'panel' => 'corpiva_theme_options',
		)
	);
	
	// Heading
	$wp_customize->add_setting(
		'corpiva_site_breadcrumb_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_site_breadcrumb_option',
		array(
			'type' => 'hidden',
			'label' => __('Settings','corpiva'),
			'section' => 'corpiva_site_breadcrumb',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'corpiva_hs_site_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'corpiva_hs_site_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'corpiva' ),
			'section'     => 'corpiva_site_breadcrumb',
			'type'        => 'checkbox'
		) 
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'corpiva_site_breadcrumb_content'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_site_breadcrumb_content',
		array(
			'type' => 'hidden',
			'label' => __('Content','corpiva'),
			'section' => 'corpiva_site_breadcrumb',
		)
	);
	
	
	// Type
	$wp_customize->add_setting( 
		'corpiva_breadcrumb_type' , 
			array(
			'default' => 'theme',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'corpiva_breadcrumb_type' , 
		array(
			'label'          => __( 'Select Breadcrumb Type', 'corpiva' ),
			'description'          => __( 'You need to install and activate the respected plugin to show their Breadcrumb. Otherwise, your default theme Breadcrumb will appear. If you see error in search console, then we recommend to use plugin Breadcrumb.', 'corpiva' ),
			'section'        => 'corpiva_site_breadcrumb',
			'type'           => 'select',
			'choices'        => 
			array(
				'theme' 	=> __( 'Theme Default', 'corpiva' ),
				'yoast' 	=> __( 'Yoast Plugin', 'corpiva' ),
				'rankmath' 	=> __( 'Rank Math Plugin', 'corpiva' ),
				'navxt' 	=> __( 'NavXT Plugin', 'corpiva' ),
			) 
		) 
	);
	
	// Height // 
	$wp_customize->add_setting(
    	'corpiva_breadcrumb_height_option',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority' => 8,
		)
	);
	$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_breadcrumb_height_option', 
			array(
				'label'      => __( 'Top/Bottom Padding', 'corpiva'),
				'section'  => 'corpiva_site_breadcrumb',
				'media_query'   => true,
				'input_attr'    => array(
					'mobile'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
					'tablet'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
					'desktop' => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 12,
					),
				),
			) ) 
		);
		
	// Background // 
	$wp_customize->add_setting(
		'corpiva_breadcrumb_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'corpiva_breadcrumb_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','corpiva'),
			'section' => 'corpiva_site_breadcrumb',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'corpiva_breadcrumb_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/pagetitle.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'corpiva_breadcrumb_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'corpiva'),
			'section'        => 'corpiva_site_breadcrumb',
		) 
	));
	
	$wp_customize->add_setting(
	'corpiva_breadcrumb_opacity_color', 
	array(
		'default' => '#0f0d1d',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 12,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'corpiva_breadcrumb_opacity_color', 
			array(
				'label'      => __( 'Background Color', 'corpiva'),
				'section'    => 'corpiva_site_breadcrumb',
			) 
		) 
	);
	
	// Typography
	$wp_customize->add_setting(
		'corpiva_breadcrumb_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority'  => 13,
		)
	);

	$wp_customize->add_control(
	'corpiva_breadcrumb_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','corpiva'),
			'section' => 'corpiva_site_breadcrumb',
		)
	);
	
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
	// Title size // 
	$wp_customize->add_setting(
    	'corpiva_breadcrumb_title_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 14,
		)
	);
	$wp_customize->add_control( 
	new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_breadcrumb_title_size', 
		array(
			'label'      => __( 'Title Font Size', 'corpiva' ),
			'section'  => 'corpiva_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 6,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 6,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 6,
				),
			),
		) ) 
	);
	// Content size // 
	$wp_customize->add_setting(
    	'corpiva_breadcrumb_content_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 15,
		)
	);
	$wp_customize->add_control( 
	new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_breadcrumb_content_size', 
		array(
			'label'      => __( 'Content Font Size', 'corpiva' ),
			'section'  => 'corpiva_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
			),
		) ) 
	);
	}
	
	
	/*=========================================
	Corpiva Blog 
	=========================================*/
	$wp_customize->add_section(
        'site_blog_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Blog Options','corpiva'),
			'panel'  		=> 'corpiva_theme_options',
		)
    );
	
	/*=========================================
	Excerpt
	=========================================*/
	$wp_customize->add_setting(
		'corpiva_blog_excerpt_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_blog_excerpt_options',
		array(
			'type' => 'hidden',
			'label' => __('Post Excerpt','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'corpiva_enable_post_excerpt'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_excerpt',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Excerpt','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// post Exerpt // 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_post_excerpt_length',
			array(
				'default'     	=> '30',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'priority'      => 5,
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_post_excerpt_length', 
			array(
				'label'      => __( 'Excerpt Length', 'corpiva' ),
				'section'  => 'site_blog_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
				)	
			) ) 
		);
	}
	
	// excerpt more // 
	$wp_customize->add_setting(
    	'corpiva_blog_excerpt_more',
    	array(
			'default'      => '...',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'corpiva_blog_excerpt_more',
		array(
		    'label'   => esc_html__('Excerpt More','corpiva'),
		    'section' => 'site_blog_options',
			'type' => 'text',
		)  
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'corpiva_show_post_btn'
			,array(
			'default'      => '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_show_post_btn',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Read More Button','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Readmore button
	$wp_customize->add_setting(
		'corpiva_read_btn_txt'
			,array(
			'default' => __('Read more','corpiva'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_html',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'corpiva_read_btn_txt',
		array(
			'type' => 'text',
			'label' => __('Read More Button Text','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Hide/Show Category
	$wp_customize->add_setting(
		'corpiva_enable_post_cat'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_cat',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Category ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Date
	$wp_customize->add_setting(
		'corpiva_enable_post_date'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_date',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Date ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Author
	$wp_customize->add_setting(
		'corpiva_enable_post_author'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_author',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Author ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Comments
	$wp_customize->add_setting(
		'corpiva_enable_post_comments'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_comments',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Comments ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Views
	$wp_customize->add_setting(
		'corpiva_enable_post_views'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_views',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Views ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Reading Time
	$wp_customize->add_setting(
		'corpiva_enable_post_rt'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_rt',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Reading Time ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Tag
	$wp_customize->add_setting(
		'corpiva_enable_post_tag'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_tag',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Tag ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Title
	$wp_customize->add_setting(
		'corpiva_enable_post_ttl'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'corpiva_enable_post_ttl',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Title ?','corpiva'),
			'section' => 'site_blog_options',
		)
	);
	/*=========================================
	Corpiva Sidebar
	=========================================*/
	$wp_customize->add_section(
        'corpiva_sidebar_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Sidebar Options','corpiva'),
			'panel'  		=> 'corpiva_theme_options',
		)
    );
	
	//  Pages Layout // 
	$wp_customize->add_setting(
		'corpiva_pages_sidebar_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'corpiva_pages_sidebar_option',
		array(
			'type' => 'hidden',
			'label' => __('Sidebar Layout','corpiva'),
			'section' => 'corpiva_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'corpiva_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'corpiva_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'corpiva_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'corpiva_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' => __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'corpiva_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'corpiva_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' => __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'corpiva_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'corpiva_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' => __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'corpiva_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'corpiva_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' => __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'corpiva_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'corpiva_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'corpiva' ),
			'section'        => 'corpiva_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'corpiva' ),
				'right_sidebar' => __( 'Right Sidebar', 'corpiva' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'corpiva' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'corpiva_sidebar_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 7,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'corpiva_sidebar_option_upsale', 
				array(
					'label'      => __( 'Sidebar Features', 'corpiva' ),
					'section'    => 'corpiva_sidebar_options'
				) 
			) 
		);	
	}
	
	// Widget options
	$wp_customize->add_setting(
		'sidebar_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
			'priority'  => 6
		)
	);

	$wp_customize->add_control(
	'sidebar_options',
		array(
			'type' => 'hidden',
			'label' => __('Options','corpiva'),
			'section' => 'corpiva_sidebar_options',
		)
	);
	// Sidebar Width 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_sidebar_width',
			array(
				'default'	      => esc_html__( '33', 'corpiva' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'  => 7
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_sidebar_width', 
			array(
				'label'      => __( 'Sidebar Width', 'corpiva' ),
				'section'  => 'corpiva_sidebar_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 25,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 33,
						),
					),
			) ) 
		);
	}
	
	// Widget Typography
	$wp_customize->add_setting(
		'sidebar_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpiva_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'sidebar_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','corpiva'),
			'section' => 'corpiva_sidebar_options',
			'priority'  => 21,
		)
	);
	
	// Widget Title // 
	if ( class_exists( 'Corpiva_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'corpiva_widget_ttl_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'corpiva_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Corpiva_Customizer_Range_Control( $wp_customize, 'corpiva_widget_ttl_size', 
			array(
				'label'      => __( 'Widget Title Font Size', 'corpiva' ),
				'section'  => 'corpiva_sidebar_options',
				'priority'  => 22,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                    'tablet'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                    'desktop' => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                ),
			) ) 
		);
	}	
}
add_action( 'customize_register', 'corpiva_theme_options_customize' );
