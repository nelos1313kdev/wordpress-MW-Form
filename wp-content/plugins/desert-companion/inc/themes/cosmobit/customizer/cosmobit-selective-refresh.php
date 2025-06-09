<?php
function cosmobit_site_lite_selective_partials( $wp_customize ){
	// cosmobit_information_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_information_option', array(
		'selector'            => '.dt__infoservices--one .dt__infoservices-carousel'
	) );
	
	// cosmobit_service_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service_ttl', array(
		'selector'            => '.front1--service .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_service_ttl',
		'render_callback'  => 'cosmobit_service_ttl_render_callback',
	) );
	
	// cosmobit_service_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service_subttl', array(
		'selector'            => '.front1--service .dt__siteheading .title',
		'settings'            => 'cosmobit_service_subttl',
		'render_callback'  => 'cosmobit_service_subttl_render_callback',
	) );
	
	// cosmobit_service_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service_text', array(
		'selector'            => '.front1--service .dt__siteheading .text',
		'settings'            => 'cosmobit_service_text',
		'render_callback'  => 'cosmobit_service_text_render_callback',
	) );
	
	// cosmobit_service_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service_option', array(
		'selector'            => '.front1--service .dt-servicess1',
	) );
	
	
	// cosmobit_cta2_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta2_text', array(
		'selector'            => '.front1--cta2 .dt__siteheading h2.title',
		'settings'            => 'cosmobit_cta2_text',
		'render_callback'  => 'cosmobit_cta2_text_render_callback',
	) );
	
	// cosmobit_cta2_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta2_btn_lbl', array(
		'selector'            => '.front1--cta2  a.dt-btn',
		'settings'            => 'cosmobit_cta2_btn_lbl',
		'render_callback'  => 'cosmobit_cta2_btn_lbl_render_callback',
	) );
	
	
	// cosmobit_why_choose_left_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_left_ttl', array(
		'selector'            => '.front1--why .why-left .subtitle',
		'settings'            => 'cosmobit_why_choose_left_ttl',
		'render_callback'  => 'cosmobit_why_choose_left_ttl_render_callback',
	) );
	
	// cosmobit_why_choose_left_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_left_subttl', array(
		'selector'            => '.front1--why .why-left h2.title',
		'settings'            => 'cosmobit_why_choose_left_subttl',
		'render_callback'  => 'cosmobit_why_choose_left_subttl_render_callback',
	) );
	
	// cosmobit_why_choose_left_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_left_text', array(
		'selector'            => '.front1--why .why-left .text',
		'settings'            => 'cosmobit_why_choose_left_text',
		'render_callback'  => 'cosmobit_why_choose_left_text_render_callback',
	) );
	
	// cosmobit_why_left_f_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_left_f_ttl', array(
		'selector'            => '.front1--why .why-left .media-body h5.media-title',
		'settings'            => 'cosmobit_why_left_f_ttl',
		'render_callback'  => 'cosmobit_why_left_f_ttl_render_callback',
	) );
	
	// cosmobit_why_left_f_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_left_f_text', array(
		'selector'            => '.front1--why .why-left .media-body .media-content',
		'settings'            => 'cosmobit_why_left_f_text',
		'render_callback'  => 'cosmobit_why_left_f_text_render_callback',
	) );
	
	// cosmobit_why_choose_right_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_right_ttl', array(
		'selector'            => '.front1--why .why-right .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_why_choose_right_ttl',
		'render_callback'  => 'cosmobit_why_choose_right_ttl_render_callback',
	) );
	
	// cosmobit_why_choose_right_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_right_subttl', array(
		'selector'            => '.front1--why .why-right .dt__siteheading .title.head-ttl',
		'settings'            => 'cosmobit_why_choose_right_subttl',
		'render_callback'  => 'cosmobit_why_choose_right_subttl_render_callback',
	) );
	
	// cosmobit_why_choose_right_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_right_text', array(
		'selector'            => '.front1--why .why-right .dt__siteheading .text',
		'settings'            => 'cosmobit_why_choose_right_text',
		'render_callback'  => 'cosmobit_why_choose_right_text_render_callback',
	) );
	
	// cosmobit_why_choose_right_f_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_right_f_text', array(
		'selector'            => '.front1--why .why-right .dt__about-cta .title',
		'settings'            => 'cosmobit_why_choose_right_f_text',
		'render_callback'  => 'cosmobit_why_choose_right_f_text_render_callback',
	) );
	
	// cosmobit_why_choose_right_f_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose_right_f_btn_lbl', array(
		'selector'            => '.front1--why .why-right .dt__about-cta a.dt-btn',
		'settings'            => 'cosmobit_why_choose_right_f_btn_lbl',
		'render_callback'  => 'cosmobit_why_choose_right_f_btn_lbl_render_callback',
	) );
	
	// cosmobit_blog_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog_ttl', array(
		'selector'            => '.front1--blog .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_blog_ttl',
		'render_callback'  => 'cosmobit_blog_ttl_render_callback',
	) );
	
	// cosmobit_blog_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog_subttl', array(
		'selector'            => '.front1--blog .dt__siteheading .title',
		'settings'            => 'cosmobit_blog_subttl',
		'render_callback'  => 'cosmobit_blog_subttl_render_callback',
	) );
	
	// cosmobit_blog_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog_text', array(
		'selector'            => '.front1--blog .dt__siteheading .text',
		'settings'            => 'cosmobit_blog_text',
		'render_callback'  => 'cosmobit_blog_text_render_callback',
	) );
	
	// cosmobit_service2_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service2_ttl', array(
		'selector'            => '.front2--service .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_service2_ttl',
		'render_callback'  => 'cosmobit_service2_ttl_render_callback',
	) );
	
	// cosmobit_service2_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service2_subttl', array(
		'selector'            => '.front2--service .dt__siteheading .title',
		'settings'            => 'cosmobit_service2_subttl',
		'render_callback'  => 'cosmobit_service2_subttl_render_callback',
	) );
	
	// cosmobit_service2_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service2_text', array(
		'selector'            => '.front2--service .dt__siteheading .text',
		'settings'            => 'cosmobit_service2_text',
		'render_callback'  => 'cosmobit_service2_text_render_callback',
	) );
	
	// cosmobit_service2_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service2_option', array(
		'selector'            => '.front2--service .dt-servicess1',
	) );
	
	// cosmobit_cta3_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta3_text', array(
		'selector'            => '.front2--cta .dt__siteheading .title',
		'settings'            => 'cosmobit_cta3_text',
		'render_callback'  => 'cosmobit_cta3_text_render_callback',
	) );
	
	// cosmobit_cta3_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta3_btn_lbl', array(
		'selector'            => '.front2--cta .btn-dt a',
		'settings'            => 'cosmobit_cta3_btn_lbl',
		'render_callback'  => 'cosmobit_cta3_btn_lbl_render_callback',
	) );
	
	// cosmobit_blog2_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog2_ttl', array(
		'selector'            => '.front2--blog .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_blog2_ttl',
		'render_callback'  => 'cosmobit_blog2_ttl_render_callback',
	) );
	
	// cosmobit_blog2_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog2_subttl', array(
		'selector'            => '.front2--blog .dt__siteheading .title',
		'settings'            => 'cosmobit_blog2_subttl',
		'render_callback'  => 'cosmobit_blog2_subttl_render_callback',
	) );
	
	// cosmobit_blog2_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog2_text', array(
		'selector'            => '.front2--blog .dt__siteheading .text',
		'settings'            => 'cosmobit_blog2_text',
		'render_callback'  => 'cosmobit_blog2_text_render_callback',
	) );
	
	
	// cosmobit_why_choose4_left_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_left_ttl', array(
		'selector'            => '.front4--why .why-left .subtitle',
		'settings'            => 'cosmobit_why_choose4_left_ttl',
		'render_callback'  => 'cosmobit_why_choose4_left_ttl_render_callback',
	) );
	
	// cosmobit_why_choose4_left_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_left_subttl', array(
		'selector'            => '.front4--why .why-left h2.title',
		'settings'            => 'cosmobit_why_choose4_left_subttl',
		'render_callback'  => 'cosmobit_why_choose4_left_subttl_render_callback',
	) );
	
	// cosmobit_why_choose4_left_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_left_text', array(
		'selector'            => '.front4--why .why-left .text',
		'settings'            => 'cosmobit_why_choose4_left_text',
		'render_callback'  => 'cosmobit_why_choose4_left_text_render_callback',
	) );
	
	// cosmobit_why4_left_f_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why4_left_f_ttl', array(
		'selector'            => '.front4--why .why-left .media-body h5.media-title',
		'settings'            => 'cosmobit_why4_left_f_ttl',
		'render_callback'  => 'cosmobit_why4_left_f_ttl_render_callback',
	) );
	
	// cosmobit_why4_left_f_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why4_left_f_text', array(
		'selector'            => '.front4--why .why-left .media-body .media-content',
		'settings'            => 'cosmobit_why4_left_f_text',
		'render_callback'  => 'cosmobit_why4_left_f_text_render_callback',
	) );
	
	// cosmobit_why_choose4_right_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_right_ttl', array(
		'selector'            => '.front4--why .why-right .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_why_choose4_right_ttl',
		'render_callback'  => 'cosmobit_why_choose4_right_ttl_render_callback',
	) );
	
	// cosmobit_why_choose4_right_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_right_subttl', array(
		'selector'            => '.front4--why .why-right .dt__siteheading .title.head-ttl',
		'settings'            => 'cosmobit_why_choose4_right_subttl',
		'render_callback'  => 'cosmobit_why_choose4_right_subttl_render_callback',
	) );
	
	// cosmobit_why_choose4_right_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_why_choose4_right_text', array(
		'selector'            => '.front4--why .why-right .dt__siteheading .text',
		'settings'            => 'cosmobit_why_choose4_right_text',
		'render_callback'  => 'cosmobit_why_choose4_right_text_render_callback',
	) );
	
	// cosmobit_blog4_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog4_ttl', array(
		'selector'            => '.front4--blog .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_blog4_ttl',
		'render_callback'  => 'cosmobit_blog4_ttl_render_callback',
	) );
	
	// cosmobit_blog4_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog4_subttl', array(
		'selector'            => '.front4--blog .dt__siteheading .title',
		'settings'            => 'cosmobit_blog4_subttl',
		'render_callback'  => 'cosmobit_blog4_subttl_render_callback',
	) );
	
	// cosmobit_blog4_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog4_text', array(
		'selector'            => '.front4--blog .dt__siteheading .text',
		'settings'            => 'cosmobit_blog4_text',
		'render_callback'  => 'cosmobit_blog4_text_render_callback',
	) );
	
	// cosmobit_service4_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service4_ttl', array(
		'selector'            => '.front4--service .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_service4_ttl',
		'render_callback'  => 'cosmobit_service4_ttl_render_callback',
	) );
	
	// cosmobit_service4_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service4_subttl', array(
		'selector'            => '.front4--service .dt__siteheading .title',
		'settings'            => 'cosmobit_service4_subttl',
		'render_callback'  => 'cosmobit_service4_subttl_render_callback',
	) );
	
	// cosmobit_service4_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service4_text', array(
		'selector'            => '.front4--service .dt__siteheading .text',
		'settings'            => 'cosmobit_service4_text',
		'render_callback'  => 'cosmobit_service4_text_render_callback',
	) );
	
	// cosmobit_service4_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service4_option', array(
		'selector'            => '.front4--service .dt-servicess4',
	) );
	
	// cosmobit_information3_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_information3_ttl', array(
		'selector'            => '.front3--info .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_information3_ttl',
		'render_callback'  => 'cosmobit_information3_ttl_render_callback',
	) );
	
	// cosmobit_information3_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_information3_subttl', array(
		'selector'            => '.front3--info .dt__siteheading .title',
		'settings'            => 'cosmobit_information3_subttl',
		'render_callback'  => 'cosmobit_information3_subttl_render_callback',
	) );
	
	// cosmobit_information3_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_information3_text', array(
		'selector'            => '.front3--info .dt__siteheading .text',
		'settings'            => 'cosmobit_information3_text',
		'render_callback'  => 'cosmobit_information3_text_render_callback',
	) );
	
	// cosmobit_information3_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_information3_option', array(
		'selector'            => '.front3--info .dt__infoservices-row'
	) );
	
	
	// cosmobit_service3_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service3_ttl', array(
		'selector'            => '.front3--service .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_service3_ttl',
		'render_callback'  => 'cosmobit_service3_ttl_render_callback',
	) );
	
	// cosmobit_service3_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service3_subttl', array(
		'selector'            => '.front3--service .dt__siteheading .title',
		'settings'            => 'cosmobit_service3_subttl',
		'render_callback'  => 'cosmobit_service3_subttl_render_callback',
	) );
	
	// cosmobit_service3_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service3_text', array(
		'selector'            => '.front3--service .dt__siteheading .text',
		'settings'            => 'cosmobit_service3_text',
		'render_callback'  => 'cosmobit_service3_text_render_callback',
	) );
	
	// cosmobit_service3_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service3_option', array(
		'selector'            => '.front3--service .dt-servicess3',
	) );
	
	// cosmobit_blog3_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog3_ttl', array(
		'selector'            => '.front3--blog .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_blog3_ttl',
		'render_callback'  => 'cosmobit_blog3_ttl_render_callback',
	) );
	
	// cosmobit_blog3_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog3_subttl', array(
		'selector'            => '.front3--blog .dt__siteheading .title',
		'settings'            => 'cosmobit_blog3_subttl',
		'render_callback'  => 'cosmobit_blog3_subttl_render_callback',
	) );
	
	// cosmobit_blog3_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog3_text', array(
		'selector'            => '.front3--blog .dt__siteheading .text',
		'settings'            => 'cosmobit_blog3_text',
		'render_callback'  => 'cosmobit_blog3_text_render_callback',
	) );
	
	// cosmobit_service5_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service5_ttl', array(
		'selector'            => '.front5--service .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_service5_ttl',
		'render_callback'  => 'cosmobit_service5_ttl_render_callback',
	) );
	
	// cosmobit_service5_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service5_subttl', array(
		'selector'            => '.front5--service .dt__siteheading .title',
		'settings'            => 'cosmobit_service5_subttl',
		'render_callback'  => 'cosmobit_service5_subttl_render_callback',
	) );
	
	// cosmobit_service5_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service5_text', array(
		'selector'            => '.front5--service .dt__siteheading .text',
		'settings'            => 'cosmobit_service5_text',
		'render_callback'  => 'cosmobit_service5_text_render_callback',
	) );
	
	// cosmobit_service5_option
	$wp_customize->selective_refresh->add_partial( 'cosmobit_service5_option', array(
		'selector'            => '.front5--service .dt-servicess5',
	) );
	
	// cosmobit_blog5_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog5_ttl', array(
		'selector'            => '.front5--blog .dt__siteheading .subtitle',
		'settings'            => 'cosmobit_blog5_ttl',
		'render_callback'  => 'cosmobit_blog5_ttl_render_callback',
	) );
	
	// cosmobit_blog5_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog5_subttl', array(
		'selector'            => '.front5--blog .dt__siteheading .title',
		'settings'            => 'cosmobit_blog5_subttl',
		'render_callback'  => 'cosmobit_blog5_subttl_render_callback',
	) );
	
	// cosmobit_blog5_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_blog5_text', array(
		'selector'            => '.front5--blog .dt__siteheading .text',
		'settings'            => 'cosmobit_blog5_text',
		'render_callback'  => 'cosmobit_blog5_text_render_callback',
	) );
	
	// cosmobit_cta5_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta5_text', array(
		'selector'            => '.front5--cta .dt__siteheading h2.title',
		'settings'            => 'cosmobit_cta5_text',
		'render_callback'  => 'cosmobit_cta5_text_render_callback',
	) );
	
	// cosmobit_cta5_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_cta5_btn_lbl', array(
		'selector'            => '.front5--cta  a.dt-btn',
		'settings'            => 'cosmobit_cta5_btn_lbl',
		'render_callback'  => 'cosmobit_cta5_btn_lbl_render_callback',
	) );
	
	// cosmobit_funfact6_right_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_funfact6_right_ttl', array(
		'selector'            => '.front6--funfact  .fancy__list .title',
		'settings'            => 'cosmobit_funfact6_right_ttl',
		'render_callback'  => 'cosmobit_funfact6_right_ttl_render_callback',
	) );
	
	// cosmobit_funfact6_right_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_funfact6_right_subttl', array(
		'selector'            => '.front6--funfact  .fancy__list .text',
		'settings'            => 'cosmobit_funfact6_right_subttl',
		'render_callback'  => 'cosmobit_funfact6_right_subttl_render_callback',
	) );
	
	// cosmobit_about5_right_ttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_about5_right_ttl', array(
		'selector'            => '.front5--about .dt__about-content .subtitle',
		'settings'            => 'cosmobit_about5_right_ttl',
		'render_callback'  => 'cosmobit_about5_right_ttl_render_callback',
	) );
	
	// cosmobit_about5_right_subttl
	$wp_customize->selective_refresh->add_partial( 'cosmobit_about5_right_subttl', array(
		'selector'            => '.front5--about .dt__about-content .title',
		'settings'            => 'cosmobit_about5_right_subttl',
		'render_callback'  => 'cosmobit_about5_right_subttl_render_callback',
	) );
	
	
	// cosmobit_about5_right_text
	$wp_customize->selective_refresh->add_partial( 'cosmobit_about5_right_text', array(
		'selector'            => '.front5--about .dt__about-content .text',
		'settings'            => 'cosmobit_about5_right_text',
		'render_callback'  => 'cosmobit_about5_right_text_render_callback',
	) );
	}
add_action( 'customize_register', 'cosmobit_site_lite_selective_partials' );