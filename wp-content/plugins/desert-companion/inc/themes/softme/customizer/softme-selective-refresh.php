<?php
function desert_softme_site_selective_partials( $wp_customize ){
	// softme_hdr_left_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_hdr_left_ttl', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_text.left strong.dt-mr-1',
		'settings'            => 'softme_hdr_left_ttl',
		'render_callback'  => 'softme_hdr_left_ttl_render_callback',
	) );
	
	// softme_hdr_left_text
	$wp_customize->selective_refresh->add_partial( 'softme_hdr_left_text', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_text.left .dt_heading_inner',
		'settings'            => 'softme_hdr_left_text',
		'render_callback'  => 'softme_hdr_left_text_render_callback',
	) );
	
	// softme_hdr_email_title
	$wp_customize->selective_refresh->add_partial( 'softme_hdr_email_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.email .contact__body .title a',
		'settings'            => 'softme_hdr_email_title',
		'render_callback'  => 'softme_hdr_email_title_render_callback',
	) );
	
	// softme_hdr_top_ads_title
	$wp_customize->selective_refresh->add_partial( 'softme_hdr_top_ads_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.address .contact__body  h6',
		'settings'            => 'softme_hdr_top_ads_title',
		'render_callback'  => 'softme_hdr_top_ads_title_render_callback',
	) );
	
	// softme_information_option
	$wp_customize->selective_refresh->add_partial( 'softme_information_option', array(
		'selector'            => '.front-info .info-wrp',
	) );
	
	// softme_information_option2
	$wp_customize->selective_refresh->add_partial( 'softme_information_option2', array(
		'selector'            => '.front-info .info-wrp',
	) );
	
	// softme_about_right_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_about_right_ttl', array(
		'selector'            => '.front-about .dt_siteheading .subtitle .dt_heading_inner',
		'settings'            => 'softme_about_right_ttl',
		'render_callback'  => 'softme_about_right_ttl_render_callback',
	) );
	
	// softme_about_right_subttl
	$wp_customize->selective_refresh->add_partial( 'softme_about_right_subttl', array(
		'selector'            => '.front-about .dt_siteheading h2.title',
		'settings'            => 'softme_about_right_subttl',
		'render_callback'  => 'softme_about_right_subttl_render_callback',
	) );
	
	// softme_about_right_text
	$wp_customize->selective_refresh->add_partial( 'softme_about_right_text', array(
		'selector'            => '.front-about .dt_siteheading .text p',
		'settings'            => 'softme_about_right_text',
		'render_callback'  => 'softme_about_right_text_render_callback',
	) );
	
	// softme_about_marque_text
	$wp_customize->selective_refresh->add_partial( 'softme_about_marque_text', array(
		'selector'            => '.front-about .marquee_wrap .marquee_text',
		'settings'            => 'softme_about_marque_text',
		'render_callback'  => 'softme_about_marque_text_render_callback',
	) );
	
	// softme_service_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_service_ttl', array(
		'selector'            => '.front-service .dt_siteheading .subtitle .dt_heading_inner',
		'settings'            => 'softme_service_ttl',
		'render_callback'  => 'softme_service_ttl_render_callback',
	) );
	
	// softme_service_subttl
	$wp_customize->selective_refresh->add_partial( 'softme_service_subttl', array(
		'selector'            => '.front-service .dt_siteheading h2.title',
		'settings'            => 'softme_service_subttl',
		'render_callback'  => 'softme_service_subttl_render_callback',
	) );
	
	// softme_service_text
	$wp_customize->selective_refresh->add_partial( 'softme_service_text', array(
		'selector'            => '.front-service .dt_siteheading .text p',
		'settings'            => 'softme_service_text',
		'render_callback'  => 'softme_service_text_render_callback',
	) );
	
	// softme_service_option
	$wp_customize->selective_refresh->add_partial( 'softme_service_option', array(
		'selector'            => '.front-service .dt-row.dt-g-4',
	) );
	
	// softme_service_option2
	$wp_customize->selective_refresh->add_partial( 'softme_service_option2', array(
		'selector'            => '.front-service .dt-row.dt-g-4',
	) );
	
	// softme_features_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_features_ttl', array(
		'selector'            => '.front-feature .dt_siteheading .subtitle .dt_heading_inner',
		'settings'            => 'softme_features_ttl',
		'render_callback'  => 'softme_features_ttl_render_callback',
	) );
	
	// softme_features_subttl
	$wp_customize->selective_refresh->add_partial( 'softme_features_subttl', array(
		'selector'            => '.front-feature .dt_siteheading h2.title',
		'settings'            => 'softme_features_subttl',
		'render_callback'  => 'softme_features_subttl_render_callback',
	) );
	
	// softme_features_text
	$wp_customize->selective_refresh->add_partial( 'softme_features_text', array(
		'selector'            => '.front-feature .dt_siteheading .text p',
		'settings'            => 'softme_features_text',
		'render_callback'  => 'softme_features_text_render_callback',
	) );
	
	// softme_features_option
	$wp_customize->selective_refresh->add_partial( 'softme_features_option', array(
		'selector'            => '.front-feature .dt_owl_carousel',
	) );
	
	// softme_blog_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_blog_ttl', array(
		'selector'            => '.front-posts .dt_siteheading .dt_heading_inner',
		'settings'            => 'softme_blog_ttl',
		'render_callback'  => 'softme_blog_ttl_render_callback',
	) );
	
	// softme_blog_subttl
	$wp_customize->selective_refresh->add_partial( 'softme_blog_subttl', array(
		'selector'            => '.front-posts .dt_siteheading .title',
		'settings'            => 'softme_blog_subttl',
		'render_callback'  => 'softme_blog_subttl_render_callback',
	) );
	
	// softme_blog_text
	$wp_customize->selective_refresh->add_partial( 'softme_blog_text', array(
		'selector'            => '.front-posts .dt_siteheading .text p',
		'settings'            => 'softme_blog_text',
		'render_callback'  => 'softme_blog_text_render_callback',
	) );
	
	// softme_protect_right_ttl
	$wp_customize->selective_refresh->add_partial( 'softme_protect_right_ttl', array(
		'selector'            => '.front-protect .dt_siteheading .subtitle .dt_heading_inner',
		'settings'            => 'softme_protect_right_ttl',
		'render_callback'  => 'softme_protect_right_ttl_render_callback',
	) );
	
	// softme_protect_right_subttl
	$wp_customize->selective_refresh->add_partial( 'softme_protect_right_subttl', array(
		'selector'            => '.front-protect .dt_siteheading h2.title',
		'settings'            => 'softme_protect_right_subttl',
		'render_callback'  => 'softme_protect_right_subttl_render_callback',
	) );
	
	// softme_protect_right_text
	$wp_customize->selective_refresh->add_partial( 'softme_protect_right_text', array(
		'selector'            => '.front-protect .dt_siteheading .text p',
		'settings'            => 'softme_protect_right_text',
		'render_callback'  => 'softme_protect_right_text_render_callback',
	) );
	
	// softme_protect_option
	$wp_customize->selective_refresh->add_partial( 'softme_protect_option', array(
		'selector'            => '.front-protect .protect-wrp',
	) );
	
	}
add_action( 'customize_register', 'desert_softme_site_selective_partials' );