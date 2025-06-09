<?php
function corpiva_site_selective_partials( $wp_customize ){	
	// corpiva_hdr_email_title
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_email_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.email .contact__body .title a',
		'settings'            => 'corpiva_hdr_email_title',
		'render_callback'  => 'corpiva_hdr_email_title_render_callback',
	) );
	
	// corpiva_hdr_top_ads_title
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_top_ads_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.address .contact__body  h6',
		'settings'            => 'corpiva_hdr_top_ads_title',
		'render_callback'  => 'corpiva_hdr_top_ads_title_render_callback',
	) );
	
	// corpiva_hdr_time_title
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_time_title', array(
		'selector'            => '.dt_header .dt_header-topbar .widget_contact.time .contact__body .title a',
		'settings'            => 'corpiva_hdr_time_title',
		'render_callback'  => 'corpiva_hdr_time_title_render_callback',
	) );
	
	// corpiva_hdr_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_btn_lbl', array(
		'selector'            => '.dt_header .dt_navbar-button-item .dt-btn',
		'settings'            => 'corpiva_hdr_btn_lbl',
		'render_callback'  => 'corpiva_hdr_btn_lbl_render_callback',
	) );
	
	// corpiva_hdr_contact_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_contact_ttl', array(
		'selector'            => '.dt_header .dt_navbar-info-contact .contact__body.one .title',
		'settings'            => 'corpiva_hdr_contact_ttl',
		'render_callback'  => 'corpiva_hdr_contact_ttl_render_callback',
	) );
	
	// corpiva_hdr_contact_txt
	$wp_customize->selective_refresh->add_partial( 'corpiva_hdr_contact_txt', array(
		'selector'            => '.dt_header .dt_navbar-info-contact .contact__body.one .description',
		'settings'            => 'corpiva_hdr_contact_txt',
		'render_callback'  => 'corpiva_hdr_contact_txt_render_callback',
	) );
	
	// corpiva_footer_mid_ttl
	$wp_customize->selective_refresh->add_partial( 'corpiva_footer_mid_ttl', array(
		'selector'            => '.dt_footer_middle .bounce-text a',
		'settings'            => 'corpiva_footer_mid_ttl',
		'render_callback'  => 'corpiva_footer_mid_ttl_render_callback',
	) );
	
	// corpiva_footer_copyright_text
	$wp_customize->selective_refresh->add_partial( 'corpiva_footer_copyright_text', array(
		'selector'            => '.dt_footer_copyright-text',
		'settings'            => 'corpiva_footer_copyright_text',
		'render_callback'  => 'corpiva_footer_copyright_text_render_callback',
	) );
	}
add_action( 'customize_register', 'corpiva_site_selective_partials' );