<?php

/*=========================================
Corpiva Header Email
=========================================*/
if ( ! function_exists( 'corpiva_header_email' ) ) :
function corpiva_header_email() {
	$corpiva_hs_hdr_email 	= get_theme_mod( 'corpiva_hs_hdr_email','1'); 
	$corpiva_hdr_email_icon 	= get_theme_mod( 'corpiva_hdr_email_icon','far fa-envelope-open'); 
	$corpiva_hdr_email_title = get_theme_mod( 'corpiva_hdr_email_title','info@example.com');
	$corpiva_hdr_email_link 	= get_theme_mod( 'corpiva_hdr_email_link','mailto:info@example.com');
	if($corpiva_hs_hdr_email=='1'): ?>
		<aside class="widget widget_contact email">
			<div class="contact__list">
				<?php if(!empty($corpiva_hdr_email_icon)): ?>
					<i class="<?php echo esc_attr($corpiva_hdr_email_icon); ?>" aria-hidden="true"></i>  
				<?php endif; ?>
				
				<?php if(!empty($corpiva_hdr_email_title)): ?>
					<div class="contact__body">
						<?php if(!empty($corpiva_hdr_email_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($corpiva_hdr_email_link); ?>"><?php echo wp_kses_post($corpiva_hdr_email_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($corpiva_hdr_email_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'corpiva_header_email', 'corpiva_header_email' );


/*=========================================
Corpiva Header Address
=========================================*/
if ( ! function_exists( 'corpiva_header_address' ) ) :
function corpiva_header_address() {
	$corpiva_hs_hdr_top_ads 	= get_theme_mod( 'corpiva_hs_hdr_top_ads','1'); 
	$corpiva_hdr_top_ads_icon= get_theme_mod( 'corpiva_hdr_top_ads_icon','fas fa-location-arrow'); 
	$corpiva_hdr_top_ads_title = get_theme_mod( 'corpiva_hdr_top_ads_title','60 Golden Street, New York');
	$corpiva_hdr_top_ads_link = get_theme_mod( 'corpiva_hdr_top_ads_link');
	if($corpiva_hs_hdr_top_ads=='1'): ?>
		<aside class="widget widget_contact address">
			<div class="contact__list">
				<?php if(!empty($corpiva_hdr_top_ads_icon)): ?>
					<i class="<?php echo esc_attr($corpiva_hdr_top_ads_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>  
				<?php if(!empty($corpiva_hdr_top_ads_title)): ?>
					<div class="contact__body">
						<?php if(!empty($corpiva_hdr_top_ads_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($corpiva_hdr_top_ads_link); ?>"><?php echo wp_kses_post($corpiva_hdr_top_ads_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($corpiva_hdr_top_ads_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'corpiva_header_address', 'corpiva_header_address' );


/*=========================================
Corpiva Header Time
=========================================*/
if ( ! function_exists( 'corpiva_header_time' ) ) :
function corpiva_header_time() {
	$corpiva_hs_hdr_time 	= get_theme_mod( 'corpiva_hs_hdr_time','1'); 
	$corpiva_hdr_time_icon= get_theme_mod( 'corpiva_hdr_time_icon','far fa-clock'); 
	$corpiva_hdr_time_title = get_theme_mod( 'corpiva_hdr_time_title','Mon-Sat: 9.00am To 7.00pm');
	$corpiva_hdr_time_link = get_theme_mod( 'corpiva_hdr_time_link');
	if($corpiva_hs_hdr_time=='1'): ?>
		<aside class="widget widget_contact time">
			<div class="contact__list">
				<?php if(!empty($corpiva_hdr_time_icon)): ?>
					<i class="<?php echo esc_attr($corpiva_hdr_time_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>  
				<?php if(!empty($corpiva_hdr_time_title)): ?>
					<div class="contact__body">
						<?php if(!empty($corpiva_hdr_time_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($corpiva_hdr_time_link); ?>"><?php echo wp_kses_post($corpiva_hdr_time_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($corpiva_hdr_time_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'corpiva_header_time', 'corpiva_header_time' );

/*=========================================
Corpiva Social Icon
=========================================*/
if ( ! function_exists( 'corpiva_site_social' ) ) :
function corpiva_site_social() {
	// Social 
	$corpiva_hs_hdr_social 	= get_theme_mod( 'corpiva_hs_hdr_social','1'); 
	$corpiva_hdr_social 		= get_theme_mod( 'corpiva_hdr_social',corpiva_get_social_icon_default());
	if($corpiva_hs_hdr_social=='1'): ?>
		<aside class="widget widget_social">
			<ul>
				<?php
					$corpiva_hdr_social = json_decode($corpiva_hdr_social);
					if( $corpiva_hdr_social!='' )
					{
					foreach($corpiva_hdr_social as $item){	
					$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'corpiva_translate_single_string', $item->icon_value, 'Header section' ) : '';	
					$social_link = ! empty( $item->link ) ? apply_filters( 'corpiva_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a></li>
				<?php }} ?>
			</ul>
		</aside>
	<?php endif;
} 
endif;
add_action( 'corpiva_site_social', 'corpiva_site_social' );


if ( ! function_exists( 'corpiva_after_before' ) ) { 
	function corpiva_after_before($corpiva_page) {	
		if( !empty($corpiva_page)){
			?>
			<div class="dt-container">
				<?php 
					$corpiva_page_query = new wp_query('page_id='.$corpiva_page); 
					if($corpiva_page_query->have_posts() ){ 
					   while( $corpiva_page_query->have_posts() ) { $corpiva_page_query->the_post();
							//the_title();
							the_content();
						}
					} wp_reset_postdata(); 
				?>
			</div>
		<?php }
	}
}


if ( ! function_exists( 'corpiva_service_option_before' ) ) { 
	function corpiva_service_option_before() {	
		$corpiva_page	= get_theme_mod('corpiva_service_option_before');
		corpiva_after_before($corpiva_page);
	}
	add_action('corpiva_service_option_before','corpiva_service_option_before');
}	


if ( ! function_exists( 'corpiva_service_option_after' ) ) { 
	function corpiva_service_option_after() {	
		$corpiva_page	= get_theme_mod('corpiva_service_option_after');
		corpiva_after_before($corpiva_page);
	}
	add_action('corpiva_service_option_after','corpiva_service_option_after');
}

/*
 *
 * Social Icon
 */
function corpiva_get_social_icon_default() {
	return apply_filters(
		'corpiva_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-google-plus-g', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-x-twitter', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'id'              => 'customizer_repeater_header_social_005',
				)
			)
		)
	);
}

/*
 *
 * Slider Default
 */
 function corpiva_slider_options_default() {
	return apply_filters(
		'corpiva_slider_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/slider01.jpg'),
					'title'           => esc_html__( 'Welcome to IT Solutions !', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Affordable Big IT & <br> Technology Soluti<span>o</span>ns', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'corpiva_customizer_repeater_slider_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/slider02.jpg'),
					'title'           => esc_html__( 'We’re 100% Trusted Agency', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Bridging the Gap in <br> Your IT Soluti<span>o</span>ns', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'corpiva_customizer_repeater_slider_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/slider03.jpg'),
					'title'           => esc_html__( 'Welcome to IT Solutions !', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Affordable Big IT & <br> Technology Soluti<span>o</span>ns', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'corpiva_customizer_repeater_slider_003',
				)
			)
		)
	);
}


/*
 *
 * Corpiva Information Default
 */
 function corpiva_information_options_default() {
	return apply_filters(
		'corpiva_information_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-compass',
					'title'           => esc_html__( 'Technology Solution', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'corpiva_customizer_repeater_information_001'					
				),
				array(
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'IT Service', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'corpiva_customizer_repeater_information_002'
				),
				array(
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Web & App Design', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'corpiva_customizer_repeater_information_003'
				),
				array(
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Data Tracking Security', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'corpiva_customizer_repeater_information_004'	
				)
			)
		)
	);
}

/*
 *
 * Service Default
 */
 function corpiva_service_options_default() {
	return apply_filters(
		'corpiva_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services01.jpg'),
					'title'           => esc_html__( 'Business Analysis', 'desert-companion' ),
					'text'         => esc_html__( 'Morem ipsum dolor sittemet consectetur adipiscing elitflorai psum dolor.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'See Details', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'far fa-chart-mixed-up-circle-dollar',
					'id'              => 'corpiva_customizer_repeater_service_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services02.jpg'),
					'title'           => esc_html__( 'Strategic Planning', 'desert-companion' ),
					'text'         => esc_html__( 'Morem ipsum dolor sittemet consectetur adipiscing elitflorai psum dolor.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'See Details', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'far fa-bullhorn',
					'id'              => 'corpiva_customizer_repeater_service_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services03.jpg'),
					'title'           => esc_html__( 'Business Consulting', 'desert-companion' ),
					'text'         => esc_html__( 'Morem ipsum dolor sittemet consectetur adipiscing elitflorai psum dolor.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'See Details', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'far fa-chart-pie-simple',
					'id'              => 'corpiva_customizer_repeater_service_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services04.jpg'),
					'title'           => esc_html__( 'Marketing Strategy', 'desert-companion' ),
					'text'         => esc_html__( 'Morem ipsum dolor sittemet consectetur adipiscing elitflorai psum dolor.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'See Details', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'far fa-layer-group',
					'id'              => 'corpiva_customizer_repeater_service_004',
				)
			)
		)
	);
}


/*
 *
 * Features Default
 */
 function corpiva_features_options_default() {
	return apply_filters(
		'corpiva_features_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services01.jpg'),
					'title'           => esc_html__( 'Brand Identity', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fab fa-uncharted',
					'id'              => 'corpiva_customizer_repeater_features_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services02.jpg'),
					'title'           => esc_html__( 'SEO Optimization', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fab fa-yoast',
					'id'              => 'corpiva_customizer_repeater_features_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services03.jpg'),
					'title'           => esc_html__( '3D Animation', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fal fa-cubes',
					'id'              => 'corpiva_customizer_repeater_features_003',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services04.jpg'),
					'title'           => esc_html__( 'Social Media', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fal fa-icons',
					'id'              => 'corpiva_customizer_repeater_features_004',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services05.jpg'),
					'title'           => esc_html__( 'Product Design', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fab fa-product-hunt',
					'id'              => 'corpiva_customizer_repeater_features_005',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/corpiva/assets/images/services01.jpg'),
					'title'           => esc_html__( 'Design & Concept', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					'icon_value' => 'fal fa-pen-ruler',
					'id'              => 'corpiva_customizer_repeater_features_006',
				)
			)
		)
	);
}

/*
 *
 * Corpiva Counter Default
 */
 function corpiva_ov_counter_options_default() {
	return apply_filters(
		'corpiva_ov_counter_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fal fa-trophy-star',
					'title'           => esc_html__( '235', 'desert-companion' ),
					'subtitle'           => esc_html__( '+', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Best Award', 'desert-companion' ),
					'id'              => 'corpiva_customizer_repeater_ov_counter_001'					
				),
				array(
					'icon_value'       => 'fal fa-ranking-star',
					'title'           => esc_html__( '98', 'desert-companion' ),
					'subtitle'           => esc_html__( 'k', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Happy Clients', 'desert-companion' ),
					'id'              => 'corpiva_customizer_repeater_ov_counter_002'
				)
			)
		)
	);
}
