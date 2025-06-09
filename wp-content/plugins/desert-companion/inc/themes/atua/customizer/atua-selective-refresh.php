<?php
function desert_atua_site_selective_partials( $wp_customize ){
	// atua_hdr_left_text
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_left_text', array(
		'selector'            => '.dt_header-topbar .left-text',
		'settings'            => 'atua_hdr_left_text',
		'render_callback'  => 'atua_hdr_left_text_render_callback',
	) );
	
	// atua_hdr_social_title
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_social_title', array(
		'selector'            => '.dt_header-topbar .widget_social .ttl',
		'settings'            => 'atua_hdr_social_title',
		'render_callback'  => 'atua_hdr_social_title_render_callback',
	) );
	
	// atua_hdr_email_title
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_email_title', array(
		'selector'            => '.dt_header-topbar .widget_contact.contact2 .title .ttl',
		'settings'            => 'atua_hdr_email_title',
		'render_callback'  => 'atua_hdr_email_title_render_callback',
	) );
	
	// atua_hdr_email_subtitle
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_email_subtitle', array(
		'selector'            => '.dt_header-topbar .widget_contact.contact2 .title a',
		'settings'            => 'atua_hdr_email_subtitle',
		'render_callback'  => 'atua_hdr_email_subtitle_render_callback',
	) );
	
	
	
	// atua_hdr_top_mbl_title
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_top_mbl_title', array(
		'selector'            => '.dt_header-topbar .widget_contact.contact3 .title .ttl',
		'settings'            => 'atua_hdr_top_mbl_title',
		'render_callback'  => 'atua_hdr_top_mbl_title_render_callback',
	) );
	
	// atua_hdr_top_mbl_subtitle
	$wp_customize->selective_refresh->add_partial( 'atua_hdr_top_mbl_subtitle', array(
		'selector'            => '.dt_header-topbar .widget_contact.contact2 .title a',
		'settings'            => 'atua_hdr_top_mbl_subtitle',
		'render_callback'  => 'atua_hdr_top_mbl_subtitle_render_callback',
	) );
	
	// atua_information_option
	$wp_customize->selective_refresh->add_partial( 'atua_information_option', array(
		'selector'            => '.front-info .dt-row',
	) );
	
	// atua_about_right_ttl
	$wp_customize->selective_refresh->add_partial( 'atua_about_right_ttl', array(
		'selector'            => '.front-about .dt_content_column .subtitle',
		'settings'            => 'atua_about_right_ttl',
		'render_callback'  => 'atua_about_right_ttl_render_callback',
	) );
	
	// atua_about_right_subttl
	$wp_customize->selective_refresh->add_partial( 'atua_about_right_subttl', array(
		'selector'            => '.front-about .dt_content_column .title',
		'settings'            => 'atua_about_right_subttl',
		'render_callback'  => 'atua_about_right_subttl_render_callback',
	) );
	
	// atua_about_right_text
	$wp_customize->selective_refresh->add_partial( 'atua_about_right_text', array(
		'selector'            => '.front-about .dt_content_column .text',
		'settings'            => 'atua_about_right_text',
		'render_callback'  => 'atua_about_right_text_render_callback',
	) );
	
	// atua_service_ttl
	$wp_customize->selective_refresh->add_partial( 'atua_service_ttl', array(
		'selector'            => '.front-service .dt_siteheading .subtitle',
		'settings'            => 'atua_service_ttl',
		'render_callback'  => 'atua_service_ttl_render_callback',
	) );
	
	// atua_service_subttl
	$wp_customize->selective_refresh->add_partial( 'atua_service_subttl', array(
		'selector'            => '.front-service .dt_siteheading .title',
		'settings'            => 'atua_service_subttl',
		'render_callback'  => 'atua_service_subttl_render_callback',
	) );
	
	// atua_service_text
	$wp_customize->selective_refresh->add_partial( 'atua_service_text', array(
		'selector'            => '.front-service .dt_siteheading .text p',
		'settings'            => 'atua_service_text',
		'render_callback'  => 'atua_service_text_render_callback',
	) );
	
	// atua_service_option
	$wp_customize->selective_refresh->add_partial( 'atua_service_option', array(
		'selector'            => '.front-service .service-wrap',
	) );
	
	// atua_features_ttl
	$wp_customize->selective_refresh->add_partial( 'atua_features_ttl', array(
		'selector'            => '.front-features .dt_siteheading .subtitle',
		'settings'            => 'atua_features_ttl',
		'render_callback'  => 'atua_features_ttl_render_callback',
	) );
	
	// atua_features_subttl
	$wp_customize->selective_refresh->add_partial( 'atua_features_subttl', array(
		'selector'            => '.front-features .dt_siteheading .title',
		'settings'            => 'atua_features_subttl',
		'render_callback'  => 'atua_features_subttl_render_callback',
	) );
	
	// atua_features_text
	$wp_customize->selective_refresh->add_partial( 'atua_features_text', array(
		'selector'            => '.front-features .dt_siteheading .text p',
		'settings'            => 'atua_features_text',
		'render_callback'  => 'atua_features_text_render_callback',
	) );
	
	// atua_features_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'atua_features_btn_lbl', array(
		'selector'            => '.front-features .dt_siteheading .btn-box span',
		'settings'            => 'atua_features_btn_lbl',
		'render_callback'  => 'atua_features_btn_lbl_render_callback',
	) );
	
	// atua_features_cta_l_ttl
	$wp_customize->selective_refresh->add_partial( 'atua_features_cta_l_ttl', array(
		'selector'            => '.features-cta .dt_features_cta_content.left .title',
		'settings'            => 'atua_features_cta_l_ttl',
		'render_callback'  => 'atua_features_cta_l_ttl_render_callback',
	) );
	
	
	// atua_blog_ttl
	$wp_customize->selective_refresh->add_partial( 'atua_blog_ttl', array(
		'selector'            => '.front-blog .dt_siteheading .subtitle',
		'settings'            => 'atua_blog_ttl',
		'render_callback'  => 'atua_blog_ttl_render_callback',
	) );
	
	// atua_blog_subttl
	$wp_customize->selective_refresh->add_partial( 'atua_blog_subttl', array(
		'selector'            => '.front-blog .dt_siteheading .title',
		'settings'            => 'atua_blog_subttl',
		'render_callback'  => 'atua_blog_subttl_render_callback',
	) );
	
	// atua_blog_text
	$wp_customize->selective_refresh->add_partial( 'atua_blog_text', array(
		'selector'            => '.front-blog .dt_siteheading .text p',
		'settings'            => 'atua_blog_text',
		'render_callback'  => 'atua_blog_text_render_callback',
	) );
	}
add_action( 'customize_register', 'desert_atua_site_selective_partials' );