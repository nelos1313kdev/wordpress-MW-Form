<?php
/**
 * Corpiva functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Corpiva
 */
 
if ( ! function_exists( 'corpiva_theme_setup' ) ) :
function corpiva_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Corpiva, use a find and replace
	 * to change 'Corpiva' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'corpiva' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'corpiva' ),
	) );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo');
	
	/**
	 * Custom background support.
	 */
	add_theme_support( 'custom-background', apply_filters( 'corpiva_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/**
	 * Set default content width.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}	
}
endif;
add_action( 'after_setup_theme', 'corpiva_theme_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function corpiva_widgets_init() {	
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'corpiva' ),
			'id' => 'corpiva-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'corpiva' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'corpiva' ),
		'id' => 'corpiva-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'corpiva' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	
	$corpiva_footer_widget_column = get_theme_mod('corpiva_footer_widget_column','4');
	for ($i=1; $i<=$corpiva_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'corpiva' )  . $i,
			'id' => 'corpiva-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'corpiva' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
}
add_action( 'widgets_init', 'corpiva_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function corpiva_scripts() {
	
	/**
	 * Styles.
	 */
	// Owl Crousel	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/vendors/css/owl.carousel.min.css');
	
	// Font Awesome
	wp_enqueue_style('all-css',get_template_directory_uri().'/assets/vendors/css/all.min.css');
	
	// Animate
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/vendors/css/animate.css');

	// Fancybox
	wp_enqueue_style('Fancybox',get_template_directory_uri().'/assets/vendors/css/jquery.fancybox.min.css');
	
	// aos
	wp_enqueue_style('aos',get_template_directory_uri().'/assets/vendors/css/aos.min.css');
	
	// Corpiva Core
	wp_enqueue_style('corpiva-core',get_template_directory_uri().'/assets/css/core.css');

	// Corpiva Theme
	wp_enqueue_style('corpiva-theme', get_template_directory_uri() . '/assets/css/themes.css');
	
	// Corpiva WooCommerce
	wp_enqueue_style('corpiva-woocommerce',get_template_directory_uri().'/assets/css/woo-styles.css');
	
	// Corpiva Style
	wp_enqueue_style( 'corpiva-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	
	// Owl Crousel
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/vendors/js/owl.carousel.js', array('jquery'), true);
	
	// Wow
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), false, true);
	
	// appear
	wp_enqueue_script('jquery-appear', get_template_directory_uri() . '/assets/vendors/js/jquery.appear.js', array('jquery'), false, true);
	
	// aos
	wp_enqueue_script('jquery-aos', get_template_directory_uri() . '/assets/vendors/js/aos.min.js', array('jquery'), false, true);
	
	// fancybox
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/vendors/js/jquery.fancybox.js', array('jquery'), false, true);
	
	// odometer
	wp_enqueue_script('odometer', get_template_directory_uri() . '/assets/vendors/js/jquery.odometer.min.js', array('jquery'), false, true);
		
	// lenis
	wp_enqueue_script('lenis', get_template_directory_uri() . '/assets/vendors/js/lenis.min.js', array('jquery'), false, true);
	
	// scrolltrigger
	wp_enqueue_script('scrolltrigger', get_template_directory_uri() . '/assets/vendors/js/scrolltrigger.js', array('jquery'), false, true);
	
	// splittext
	wp_enqueue_script('splittext', get_template_directory_uri() . '/assets/vendors/js/splittext.js', array('jquery'), false, true);
	
	// Corpiva Theme
	wp_enqueue_script('corpiva-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	// Corpiva custom
	wp_enqueue_script('corpiva-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'corpiva_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function corpiva_admin_enqueue_scripts(){
	wp_enqueue_style('corpiva-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css');
	wp_enqueue_script( 'corpiva-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/corpiva-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'corpiva-admin-script', 'corpiva_ajax_object',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce('corpiva_nonce')
        )
    );
}
add_action( 'admin_enqueue_scripts', 'corpiva_admin_enqueue_scripts' );


/**
 * Enqueue User Custom styles.
 */
 if( ! function_exists( 'corpiva_user_custom_style' ) ):
    function corpiva_user_custom_style() {

		$corpiva_print_style = '';
		
			
		 /*=========================================
		 Corpiva Page Title
		=========================================*/
		$corpiva_print_style   .= corpiva_customizer_value( 'corpiva_breadcrumb_height_option', '.dt_pagetitle', array( 'padding-top' ), array( 12, 12, 12 ), 'rem' );
		$corpiva_print_style   .= corpiva_customizer_value( 'corpiva_breadcrumb_height_option', '.dt_pagetitle', array( 'padding-bottom' ), array( 12, 12, 12 ), 'rem' );
		 $corpiva_print_style   .=  corpiva_customizer_value( 'corpiva_breadcrumb_title_size', '.dt_pagetitle .dt_pagetitle_content .title > *', array( 'font-size' ), array( 6, 6, 6 ), 'rem' );
		  $corpiva_print_style   .=  corpiva_customizer_value( 'corpiva_breadcrumb_content_size', '.dt_pagetitle .dt_pagetitle_content .dt_pagetitle_breadcrumb li', array( 'font-size' ), array( 2, 2, 2 ), 'rem' );
		
		$corpiva_breadcrumb_opacity_color 	= get_theme_mod('corpiva_breadcrumb_opacity_color','#0f0d1d');
			$corpiva_print_style .=".dt_pagetitle {
						background-color: " .esc_attr($corpiva_breadcrumb_opacity_color). ";
				}\n";
		
	
		 /*=========================================
		 Corpiva Logo Size
		=========================================*/
		$corpiva_print_style   .= corpiva_customizer_value( 'hdr_logo_size', '.site--logo img', array( 'max-width' ), array( 150, 150, 150 ), 'px !important' );
		$corpiva_print_style   .= corpiva_customizer_value( 'hdr_site_title_size', '.site--logo .site-title', array( 'font-size' ), array( 55, 55, 55 ), 'px !important' );
		$corpiva_print_style   .= corpiva_customizer_value( 'hdr_site_desc_size', '.site--logo .site-description', array( 'font-size' ), array( 16, 16, 16 ), 'px !important' );
		
		$corpiva_site_container_width 			 = get_theme_mod('corpiva_site_container_width','2304');
			if($corpiva_site_container_width >=768 && $corpiva_site_container_width <=2000){
				$corpiva_print_style .=".dt-container,.dt_slider .dt_owl_carousel.owl-carousel .owl-nav,.dt_slider .dt_owl_carousel.owl-carousel .owl-dots {
						max-width: " .esc_attr($corpiva_site_container_width). "px;
					}\n";
			}
		
		/**
		 *  Sidebar Width
		 */
		$corpiva_sidebar_width = get_theme_mod('corpiva_sidebar_width',33);
		if($corpiva_sidebar_width !== '') { 
			$corpiva_primary_width   = absint( 100 - $corpiva_sidebar_width );
				$corpiva_print_style .="	@media (min-width: 992px) {#dt-main {
					max-width:" .esc_attr($corpiva_primary_width). "%;
					flex-basis:" .esc_attr($corpiva_primary_width). "%;
				}\n";
				$corpiva_print_style .="#dt-sidebar {
					max-width:" .esc_attr($corpiva_sidebar_width). "%;
					flex-basis:" .esc_attr($corpiva_sidebar_width). "%;
				}}\n";
        }
		$corpiva_print_style   .= corpiva_customizer_value( 'corpiva_widget_ttl_size', '.dt_widget-area .widget .widget-title', array( 'font-size' ), array( 20, 20, 20 ), 'px' );
		
		/**
		 *  Typography Body
		 */
		 $corpiva_body_font_weight_option	 	 = get_theme_mod('corpiva_body_font_weight_option','inherit');
		 $corpiva_body_text_transform_option	 = get_theme_mod('corpiva_body_text_transform_option','inherit');
		 $corpiva_body_font_style_option	 	 = get_theme_mod('corpiva_body_font_style_option','inherit');
		 $corpiva_body_txt_decoration_option	 = get_theme_mod('corpiva_body_txt_decoration_option','none');
		
		 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 $corpiva_print_style .=" body{ 
			font-weight: " .esc_attr($corpiva_body_font_weight_option). ";
			text-transform: " .esc_attr($corpiva_body_text_transform_option). ";
			font-style: " .esc_attr($corpiva_body_font_style_option). ";
			text-decoration: " .esc_attr($corpiva_body_txt_decoration_option). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $corpiva_heading_font_weight_option	 	= get_theme_mod('corpiva_h' . $i . '_font_weight_option','700');
			 $corpiva_heading_text_transform_option 	= get_theme_mod('corpiva_h' . $i . '_text_transform_option','inherit');
			 $corpiva_heading_font_style_option	 	= get_theme_mod('corpiva_h' . $i . '_font_style_option','inherit');
			 $corpiva_heading_txt_decoration_option	= get_theme_mod('corpiva_h' . $i . '_txt_decoration_option','inherit');
			 
			 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $corpiva_print_style   .= corpiva_customizer_value( 'corpiva_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			 $corpiva_print_style .=" h" . $i . "{ 
				font-weight: " .esc_attr($corpiva_heading_font_weight_option). ";
				text-transform: " .esc_attr($corpiva_heading_text_transform_option). ";
				font-style: " .esc_attr($corpiva_heading_font_style_option). ";
				text-decoration: " .esc_attr($corpiva_heading_txt_decoration_option). ";
			}\n";
		 }
		
		
		/*=========================================
		Footer 
		=========================================*/
		$corpiva_footer_bg_color			= get_theme_mod('corpiva_footer_bg_color','#0F0D1D');
		if(!empty($corpiva_footer_bg_color)):
			 $corpiva_print_style .=".dt_footer--one{ 
				    background-color: ".esc_attr($corpiva_footer_bg_color).";
			}\n";
		endif;
        wp_add_inline_style( 'corpiva-style', $corpiva_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'corpiva_user_custom_style' );


/**
 * Define Constants
 */
 
$corpiva_theme = wp_get_theme();
define( 'CORPIVA_THEME_VERSION', $corpiva_theme->get( 'Version' ) );

// Root path/URI.
define( 'CORPIVA_THEME_DIR', get_template_directory() );
define( 'CORPIVA_THEME_URI', get_template_directory_uri() );

// Root path/URI.
define( 'CORPIVA_THEME_INC_DIR', CORPIVA_THEME_DIR . '/inc');
define( 'CORPIVA_THEME_INC_URI', CORPIVA_THEME_URI . '/inc');


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer/corpiva-customizer.php';
 require get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/customizer.php';
 
/**
 * Nav Walker for Bootstrap Dropdown Menu.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


/**
 * Control Style
 */
require CORPIVA_THEME_INC_DIR . '/customizer/controls/code/control-function/style-functions.php';

/**
 * Getting Started
 */
require CORPIVA_THEME_INC_DIR . '/admin/getting-started.php';