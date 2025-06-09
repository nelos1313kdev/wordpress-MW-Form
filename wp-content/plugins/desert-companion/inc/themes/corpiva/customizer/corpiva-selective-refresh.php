<?php
function desert_corpiva_site_selective_partials( $wp_customize ){	
	// corpiva_information_option
	$wp_customize->selective_refresh->add_partial( 'corpiva_information_option', array(
		'selector'            => '.front-info .dt-row',
	) );
	
	// corpiva_service_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_service_ttl', array(
		'selector'            => '.front-services .section-title .sub-title',
		'settings'            => 'corpiva_service_ttl',
		'render_callback'  => 'corpiva_service_ttl_render_callback',
	) );
	
	// corpiva_service_subttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_service_subttl', array(
		'selector'            => '.front-services .section-title .title',
		'settings'            => 'corpiva_service_subttl',
		'render_callback'  => 'corpiva_service_subttl_render_callback',
	) );
	
	// corpiva_service_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'corpiva_service_btn_lbl', array(
		'selector'            => '.front-services .view-all-btn .dt-btn',
		'settings'            => 'corpiva_service_btn_lbl',
		'render_callback'  => 'corpiva_service_btn_lbl_render_callback',
	) );
	
	// corpiva_overview_right_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_overview_right_ttl', array(
		'selector'            => '.front-overview .section-title .sub-title',
		'settings'            => 'corpiva_overview_right_ttl',
		'render_callback'  => 'corpiva_overview_right_ttl_render_callback',
	) );
	
	// corpiva_overview_right_subttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_overview_right_subttl', array(
		'selector'            => '.front-overview .section-title .title',
		'settings'            => 'corpiva_overview_right_subttl',
		'render_callback'  => 'corpiva_overview_right_subttl_render_callback',
	) );
	
	// corpiva_overview_right_text
	$wp_customize->selective_refresh->add_partial( 'corpiva_overview_right_text', array(
		'selector'            => '.front-overview .info-one',
		'settings'            => 'corpiva_overview_right_text',
		'render_callback'  => 'corpiva_overview_right_text_render_callback',
	) );
	
	// corpiva_features_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_features_ttl', array(
		'selector'            => '.front-feature .feature-content .title',
		'settings'            => 'corpiva_features_ttl',
		'render_callback'  => 'corpiva_features_ttl_render_callback',
	) );
	
	// corpiva_features_text
	$wp_customize->selective_refresh->add_partial( 'corpiva_features_text', array(
		'selector'            => '.front-feature .feature-content .info-one',
		'settings'            => 'corpiva_features_text',
		'render_callback'  => 'corpiva_features_text_render_callback',
	) );
	
	// corpiva_features_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'corpiva_features_btn_lbl', array(
		'selector'            => '.front-feature .feature-content .dt-btn-play-two span',
		'settings'            => 'corpiva_features_btn_lbl',
		'render_callback'  => 'corpiva_features_btn_lbl_render_callback',
	) );
	
	// corpiva_features_option
	$wp_customize->selective_refresh->add_partial( 'corpiva_features_option', array(
		'selector'            => '.front-feature .dt-row.dt-g-3',
	) );

	// corpiva_blog_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_blog_ttl', array(
		'selector'            => '.front-posts .section-title .sub-title',
		'settings'            => 'corpiva_blog_ttl',
		'render_callback'  => 'corpiva_blog_ttl_render_callback',
	) );
	
	// corpiva_blog_subttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_blog_subttl', array(
		'selector'            => '.front-posts .section-title .title',
		'settings'            => 'corpiva_blog_subttl',
		'render_callback'  => 'corpiva_blog_subttl_render_callback',
	) );
	
	// corpiva_blog_text
	$wp_customize->selective_refresh->add_partial( 'corpiva_blog_text', array(
		'selector'            => '.front-posts .section-title p.dt-mb-0',
		'settings'            => 'corpiva_blog_text',
		'render_callback'  => 'corpiva_blog_text_render_callback',
	) );
	}
add_action( 'customize_register', 'desert_corpiva_site_selective_partials' );