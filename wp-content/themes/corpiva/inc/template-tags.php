<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Corpiva
 */

/**
 * Theme Page Header Title
*/
function corpiva_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Archives','corpiva'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Archives','corpiva'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Archives','corpiva'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('All posts by','corpiva'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Category','corpiva'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Tag','corpiva'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Shop','corpiva'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'corpiva' ) , esc_html__('404','corpiva') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'corpiva' ), esc_html__('Search results for','corpiva'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/**
 * Theme Breadcrumbs Url
*/
function corpiva_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/**
 * Theme Breadcrumbs
*/
if( !function_exists('corpiva_page_header_breadcrumbs') ):
	function corpiva_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
			if (is_home() || is_front_page()) :
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','corpiva').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','corpiva').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. corpiva_page_url() .'">' . __('Archive by category','corpiva').' "' . single_cat_title('', false) . '"</a></li>';
				} elseif ( is_day() ) {
					echo '<li class="breadcrumb-item active"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. corpiva_page_url() .'">'. get_the_time('d') .'</a></li>';
				} elseif ( is_month() ) {
					echo '<li class="breadcrumb-item active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
					echo '<li class="breadcrumb-item active"><a href="'. corpiva_page_url() .'">'. get_the_time('F') .'</a></li>';
				} elseif ( is_year() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. corpiva_page_url() .'">'. get_the_time('Y') .'</a></li>';
				} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {					
				if ( get_post_type() != 'post' ) {
					$cat = get_the_category(); 
					$cat = $cat[0];
					echo '<li class="breadcrumb-item">';
					echo get_category_parents($cat, TRUE, '');
					echo '</li>';
					echo '<li class="breadcrumb-item active"><a href="' . corpiva_page_url() . '">'. get_the_title() .'</a></li>';
				} }  
					elseif ( is_page() && $post->post_parent ) {
				    $parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					    echo '<li class="breadcrumb-item active"><a href="' . corpiva_page_url() . '">'. get_the_title() .'</a></li>';
                    }
					elseif( is_search() )
					{
					    echo '<li class="breadcrumb-item active"><a href="' . corpiva_page_url() . '">'. get_search_query() .'</a></li>';
					}
					elseif( is_404() )
					{
						echo '<li class="breadcrumb-item active"><a href="' . corpiva_page_url() . '">'.__('Error 404','corpiva').'</a></li>';
					}
					else { 
					    echo '<li class="breadcrumb-item active"><a href="' . corpiva_page_url() . '">'. get_the_title() .'</a></li>';
					}
				endif;
        }
endif;


// Corpiva Excerpt Read More
if ( ! function_exists( 'corpiva_execerpt_btn' ) ) :
function corpiva_execerpt_btn() {
	$corpiva_show_post_btn		= get_theme_mod('corpiva_show_post_btn','1'); 
	$corpiva_read_btn_txt		= get_theme_mod('corpiva_read_btn_txt','Read more'); 
	if ( $corpiva_show_post_btn == '1' ) { 
	?>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" class="more-link"><?php echo wp_kses_post($corpiva_read_btn_txt); ?></a>
<?php } 
	} 
endif;

// Corpiva excerpt length
function corpiva_site_excerpt_length( $length ) {
	 $corpiva_post_excerpt_length= get_theme_mod('corpiva_post_excerpt_length','30'); 
    if( $corpiva_post_excerpt_length == 1000 ) {
        return 9999;
    }
    return esc_html( $corpiva_post_excerpt_length );
}
add_filter( 'excerpt_length', 'corpiva_site_excerpt_length', 999 );



// Corpiva excerpt more
function corpiva_site_excerpt_more( $more ) {
	return get_theme_mod('corpiva_blog_excerpt_more','&hellip;');;
}
add_filter( 'excerpt_more', 'corpiva_site_excerpt_more' );

/*=========================================
Register Google fonts for Corpiva.
=========================================*/
function corpiva_google_fonts_url() {
	
    $font_families = array('Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Urbanist:ital,wght@0,100..900;1,100..900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function corpiva_google_fonts_scripts_styles() {
    wp_enqueue_style( 'corpiva-google-fonts', corpiva_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'corpiva_google_fonts_scripts_styles' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function corpiva_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	return $classes;
}
add_filter( 'body_class', 'corpiva_body_classes' );

function corpiva_post_classes( $classes ) {
	if ( is_single() ) : 
	$classes[]='single-post'; 
	endif;
	return $classes;
}
add_filter( 'post_class', 'corpiva_post_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('corpiva_str_replace_assoc')) {

    /**
     * corpiva_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function corpiva_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

/*=========================================
Corpiva Site Preloader
=========================================*/
if ( ! function_exists( 'corpiva_site_preloader' ) ) :
function corpiva_site_preloader() {
	$corpiva_hs_preloader_option 	= get_theme_mod( 'corpiva_hs_preloader_option','1'); 
	if($corpiva_hs_preloader_option == '1') { 
	?>
		<div id="dt_preloader" class="dt_preloader">
			<button type="button" class="dt_preloader-close site--close"></button>
			<div class="dt_preloader-animation">
				<div class="dt_preloader-spinner"></div>
				<div class="dt_preloader-text">
					<?php 
						$corpiva_preloader_string = get_bloginfo('name');
						//Using the explode method
						$corpiva_preloader_arr_string = str_split($corpiva_preloader_string);

						//foreach loop to display the returned array
						foreach($corpiva_preloader_arr_string as $str){
							echo sprintf(__('<span class="splitted" data-char=%1$s>%1$s</span>', 'corpiva'),$str);
						}
					?>
				</div>
				<p class="text-center"><?php esc_html_e('Loading','corpiva'); ?></p>
			</div>
			<div class="loader">
				<div class="dt-row">
					<div class="dt-col-3 loader-section section-left">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-left">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-right">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-right">
						<div class="bg"></div>
					</div>
				</div>
			</div>
		</div>
	<?php }
	} 
endif;
add_action( 'corpiva_site_preloader', 'corpiva_site_preloader' );



/*=========================================
Corpiva Site Header
=========================================*/
if ( ! function_exists( 'corpiva_site_main_header' ) ) :
function corpiva_site_main_header() {
	get_template_part('template-parts/site','header');
} 
endif;
add_action( 'corpiva_site_main_header', 'corpiva_site_main_header' );

/*=========================================
Corpiva Header Image
=========================================*/
if ( ! function_exists( 'corpiva_wp_hdr_image' ) ) :
function corpiva_wp_hdr_image() {
	if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'corpiva_wp_hdr_image', 'corpiva_wp_hdr_image' );



/*=========================================
Corpiva Site Navigation
=========================================*/
if ( ! function_exists( 'corpiva_site_header_navigation' ) ) :
function corpiva_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt_navbar-mainmenu',
			'fallback_cb' => 'corpiva_fallback_page_menu',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'corpiva_site_header_navigation', 'corpiva_site_header_navigation' );


/*=========================================
Corpiva Header Button
=========================================*/
if ( ! function_exists( 'corpiva_header_button' ) ) :
function corpiva_header_button() {
	$corpiva_hs_hdr_btn 		= get_theme_mod( 'corpiva_hs_hdr_btn','1'); 
	$corpiva_hdr_btn_icon 		= get_theme_mod( 'corpiva_hdr_btn_icon','fab fa-whatsapp'); 
	$corpiva_hdr_btn_lbl 		= get_theme_mod( 'corpiva_hdr_btn_lbl','Get A Quote'); 
	$corpiva_hdr_btn_link 		= get_theme_mod( 'corpiva_hdr_btn_link','#'); 
	$corpiva_hdr_btn_target 	= get_theme_mod( 'corpiva_hdr_btn_target');
	if($corpiva_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($corpiva_hs_hdr_btn=='1'  && !empty($corpiva_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($corpiva_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary"><i class="<?php echo esc_attr($corpiva_hdr_btn_icon); ?>"></i> <?php echo wp_kses_post($corpiva_hdr_btn_lbl); ?></a>
	</li>
<?php endif;
	} 
endif;
add_action( 'corpiva_header_button', 'corpiva_header_button' );


/*=========================================
Corpiva Header Contact
=========================================*/
if ( ! function_exists( 'corpiva_header_contact' ) ) :
function corpiva_header_contact() {
	$corpiva_hs_hdr_contact 		= get_theme_mod( 'corpiva_hs_hdr_contact','1'); 
	$corpiva_hdr_contact_icon 		= get_theme_mod( 'corpiva_hdr_contact_icon','fas fa-phone-volume'); 
	$corpiva_hdr_contact_ttl 		= get_theme_mod( 'corpiva_hdr_contact_ttl','Call Anytime'); 
	$corpiva_hdr_contact_txt 		= get_theme_mod( 'corpiva_hdr_contact_txt','<a href="tel:+1237878222">+123 7878 222</a>'); 
	if($corpiva_hs_hdr_contact=='1'):	
?>
	<li class="dt_navbar-info-contact">
		<aside class="widget widget_contact">
			<div class="contact__list">
				<?php if(!empty($corpiva_hdr_contact_icon)): ?>
					<i class="<?php echo esc_attr($corpiva_hdr_contact_icon); ?>" aria-hidden="true"></i>
				<?php endif; ?>	
				<div class="contact__body one">
					<?php if(!empty($corpiva_hdr_contact_ttl)): ?>
						<h6 class="title"><?php echo wp_kses_post($corpiva_hdr_contact_ttl); ?></h6>
					<?php endif; ?>
					<?php if(!empty($corpiva_hdr_contact_txt)): ?>
						<p class="description"><?php echo wp_kses_post($corpiva_hdr_contact_txt); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</aside>
	</li>
<?php endif;
	} 
endif;
add_action( 'corpiva_header_contact', 'corpiva_header_contact' );

/*=========================================
Corpiva Site Search
=========================================*/
if ( ! function_exists( 'corpiva_site_main_search' ) ) :
function corpiva_site_main_search() {
	$corpiva_hs_hdr_search 	= get_theme_mod( 'corpiva_hs_hdr_search','1'); 
	$corpiva_search_result 	= get_theme_mod( 'corpiva_search_result','post');
	if($corpiva_hs_hdr_search=='1'):	
?>
<li class="dt_navbar-search-item">
	<button type="button" class="dt_navbar-search-toggle"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
	<div class="dt_search search--header">
		<form method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'corpiva' ); ?>">
			<label for="dt_search-form-1">
				<?php if($corpiva_search_result=='product' && class_exists('WooCommerce')):	?>
					<input type="hidden" name="post_type" value="product" />
				 <?php endif; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'corpiva' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'corpiva' ); ?>" value="" name="s" />
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
		</form>
		<button type="button" class="dt_search-close"><i class="far fa-arrow-up" aria-hidden="true"></i></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'corpiva_site_main_search', 'corpiva_site_main_search' );



/*=========================================
Corpiva WooCommerce Cart
=========================================*/
if ( ! function_exists( 'corpiva_woo_cart' ) ) :
function corpiva_woo_cart() {
	$corpiva_hs_hdr_cart 	= get_theme_mod( 'corpiva_hs_hdr_cart','1'); 
		if($corpiva_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt_navbar-cart-item">
		<a href="javascript:void(0);" class="dt_navbar-cart-icon">
			<span class="cart_icon">
				<i class="far fa-cart-shopping" aria-hidden="true"></i>
			</span>
			<?php 
				$count = WC()->cart->cart_contents_count;
				
				if ( $count > 0 ) {
				?>
					 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
				<?php 
				}
				else {
					?>
					<strong class="cart_count"><?php  esc_html_e('0','corpiva'); ?></strong>
					<?php 
				}
		?>
		</a>
		<div class="dt_navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'corpiva_woo_cart', 'corpiva_woo_cart' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function corpiva_woo_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
			$count = WC()->cart->cart_contents_count;
			
			if ( $count > 0 ) {
			?>
				 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
			<?php 
			}
			else {
				?>
				<strong class="cart_count"><?php esc_html_e('0','corpiva'); ?></strong>
				<?php 
			}
	?>
	<?php
 
    $fragments['.cart_count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'corpiva_woo_add_to_cart_fragment' );


/*=========================================
Corpiva My Account
=========================================*/
if ( ! function_exists( 'corpiva_hdr_account' ) ) {
	function corpiva_hdr_account() {	
		$corpiva_hs_hdr_account 		= get_theme_mod( 'corpiva_hs_hdr_account','1');
		if($corpiva_hs_hdr_account=='1'): ?>
			<li class="dt_navbar-user-item">
				<?php if(is_user_logged_in()): ?>
					<a href="<?php echo esc_url(wp_logout_url( home_url())); ?>" class="dt_user_btn"><i class="fas fa-user"></i></a>
				<?php else: ?>
					<a href="<?php echo esc_url(wp_login_url( home_url())); ?>" class="dt_user_btn"><i class="fas fa-user"></i></a>
				<?php endif; ?>
			</li>
		<?php endif;
	}
}
add_action( 'corpiva_hdr_account', 'corpiva_hdr_account' );

/*=========================================
Corpiva Site Logo
=========================================*/
if ( ! function_exists( 'corpiva_site_logo' ) ) :
function corpiva_site_logo() {
	$corpiva_title_tagline_seo = get_theme_mod( 'corpiva_title_tagline_seo');
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php if($corpiva_title_tagline_seo=='1'): ?>	
			<h1 class="site-title" style="display: none;">
				<?php 
					echo esc_html(get_bloginfo('name'));
				?>
			</h1>
		<?php
			endif;
			$corpiva_description = get_bloginfo( 'description');
			if ($corpiva_description) : ?>
				<p class="site-description"><?php echo esc_html($corpiva_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'corpiva_site_logo', 'corpiva_site_logo' );

/*=========================================
Corpiva Footer Widget
=========================================*/
if ( ! function_exists( 'corpiva_footer_widget' ) ) :
function corpiva_footer_widget() {
	$corpiva_footer_mid_ttl			= get_theme_mod('corpiva_footer_mid_ttl','LET’S GET In TOUCH'); 
	$corpiva_footer_mid_link		= get_theme_mod('corpiva_footer_mid_link','#'); 
	$corpiva_footer_mid_target		= get_theme_mod('corpiva_footer_mid_target'); 
	$corpiva_footer_widget_column	= get_theme_mod('corpiva_footer_widget_column','4'); 
	if($corpiva_footer_mid_target=='1'): $target='target=_blank'; else: $target=''; endif;
		if ($corpiva_footer_widget_column == '4') {
				$column = '3';
			} elseif ($corpiva_footer_widget_column == '3') {
				$column = '4';
			} elseif ($corpiva_footer_widget_column == '2') {
				$column = '6';
			} else{
				$column = '12';
			}
	?>
	<div class="dt_footer_middle">
		<div class="dt-container">
			<?php if(!empty($corpiva_footer_mid_ttl)): ?>
				<div class="dt-row">
					<div class="dt-col-lg-12 dt-col-sm-12 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1000ms">
						<div class="dt-footer-slug-1 position-relative dt_item_active text-uppercase text-center dt-headline">
							<h3 class="bounce-text"><a href="<?php echo esc_url($corpiva_footer_mid_link); ?>" <?php echo esc_attr($target); ?>><?php echo wp_kses_post($corpiva_footer_mid_ttl); ?></a></h3>
						</div>
					</div>
				</div>
			<?php endif; 
			if($corpiva_footer_widget_column !==''): 
			?>
			<div class="dt-row dt-g-lg-4 dt-g-5">
				<?php if ( is_active_sidebar( 'corpiva-footer-widget-1' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'corpiva-footer-widget-1'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'corpiva-footer-widget-2' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'corpiva-footer-widget-2'); ?>	
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'corpiva-footer-widget-3' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'corpiva-footer-widget-3'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'corpiva-footer-widget-4' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'corpiva-footer-widget-4'); ?>
					</div>
				<?php endif; ?>	
			</div>
			<?php endif; ?>	
		</div>
	</div>
	<?php 
	 } 
endif;
add_action( 'corpiva_footer_widget', 'corpiva_footer_widget' );


/*=========================================
Corpiva Footer Bottom
=========================================*/
if ( ! function_exists( 'corpiva_footer_bottom' ) ) :
function corpiva_footer_bottom() {
	?>
	<div class="dt_footer_copyright">
		<div class="dt-container">
			<div class="dt-row dt-g-4 dt-mt-0">
				<div class="dt-col-md-12 dt-col-sm-12 dt-text-sm-center dt-text-center">
					<?php do_action('corpiva_footer_copyright_data'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	} 
endif;
add_action( 'corpiva_footer_bottom', 'corpiva_footer_bottom' );

/*=========================================
Corpiva Footer Copyright
=========================================*/
if ( ! function_exists( 'corpiva_footer_copyright_data' ) ) :
function corpiva_footer_copyright_data() {
	$corpiva_footer_copyright_text = get_theme_mod('corpiva_footer_copyright_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<?php if(!empty($corpiva_footer_copyright_text)): 
			$corpiva_copyright_allowed_tags = array(
				'[current_year]' => date_i18n('Y'),
				'[site_title]'   => get_bloginfo('name'),
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'corpiva')),
			);
	?>
		<div class="dt_footer_copyright-text">
			<?php
				echo apply_filters('corpiva_footer_copyright', wp_kses_post(corpiva_str_replace_assoc($corpiva_copyright_allowed_tags, $corpiva_footer_copyright_text)));
			?>
		</div>
<?php endif;
	} 
endif;
add_action( 'corpiva_footer_copyright_data', 'corpiva_footer_copyright_data' );

/*=========================================
Corpiva Scroller
=========================================*/
if ( ! function_exists( 'corpiva_top_scroller' ) ) :
function corpiva_top_scroller() {
	$corpiva_hs_scroller_option	=	get_theme_mod('corpiva_hs_scroller_option','1');
?>		
	<?php if ($corpiva_hs_scroller_option == '1') { ?>
		<button type="button" id="dt_uptop" class="dt_uptop">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: -0.0171453;"></path>
			</svg>
		</button>
	<?php }
	} 
endif;
add_action( 'corpiva_top_scroller', 'corpiva_top_scroller' );

function corpiva_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'corpiva_page_menu_args' );
function corpiva_fallback_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = 'Home';
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
		{
		$class = 'class="nav-item menu-item active"';
		}
		else
		{
			$class = 'class="nav-item menu-item "';
		}
		$menu .= '<li ' . $class . '><a class="nav-link " href="' . esc_url(home_url( '/' )) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new corpiva_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class corpiva_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<span class='dt_mobilenav-dropdown-toggle'><button type='button' class='fa fa-angle-right' aria-label='Mobile Dropdown Toggle'></button></span><ul class='dropdown-menu default'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 )
	 {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		if($depth === 0)
		{
			$child_class='nav-link';
		}
		else if($depth > 0)
		{
			$child_class='dropdown-item';
		}
		else
		{
			$child_class='';
		}
		extract($args, EXTR_SKIP);
		if($has_children){
			$css_class = array('menu-item page_item dropdown menu-item-has-children', 'page-item-'.$page->ID);
		}else{
			 $css_class = array('menu-item page_item dropdown', 'page-item-'.$page->ID);
		 }
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'nav-item active';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$output .= $indent . '<li class="nav-item ' . $css_class . '"><a class="' . $child_class . '" href="' . esc_url(get_permalink($page->ID)) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($date_format, $time);
		}
	}
}


// Function to retrieve the post views count
function corpiva_get_post_view($post_id) {
    $count = get_post_meta( $post_id, 'post_views_count', true );
    if (!empty($count)) {
        return $count . " views";
    } else {
        return "0 views";
    }
}

// Function to increment the post views count
function corpiva_set_post_view() {
    if (is_single()) {  // Only count views on single post page
        $post_id = get_the_ID();
        $key = 'post_views_count';
        $count = (int) get_post_meta( $post_id, $key, true );
        $count++;
        update_post_meta( $post_id, $key, $count );
    }
}
add_action('wp_head', 'corpiva_set_post_view');  // Increment views when viewing a single post

// Add custom column for post views in admin posts list
function corpiva_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';  // Add "Views" column
    return $columns;
}
add_filter('manage_posts_columns', 'corpiva_posts_column_views');

// Display views count in the custom column for posts
function corpiva_posts_custom_column_views( $column, $post_id ) {
    if ( $column === 'post_views') {
        echo corpiva_get_post_view($post_id);  // Display views in the column
    }
}
add_action( 'manage_posts_custom_column', 'corpiva_posts_custom_column_views', 10, 2 ); // Add second argument $post_id


/**
 * Calculate reading time by content length
 *
 * @param string  $text Content to calculate
 * @return int Number of minutes
 * @since  1.0
 */

if ( !function_exists( 'corpiva_read_time' ) ):
	function corpiva_read_time() {
		global $post;
		$content = get_post_field( 'post_content', $post->ID );
		$word_count = str_word_count( strip_tags( $content ) );
		$readingtime = ceil($word_count / 200);

		if ($readingtime == 1) {
		$timer = " minute Read";
		} else {
		$timer = " minutes Read";
		}
		$totalreadingtime = $readingtime . $timer;

		return $totalreadingtime;
	}
endif;