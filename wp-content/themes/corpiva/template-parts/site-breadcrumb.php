<?php 
$corpiva_hs_site_breadcrumb     = get_theme_mod('corpiva_hs_site_breadcrumb','1');
$corpiva_breadcrumb_bg_img		= get_theme_mod('corpiva_breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/pagetitle.jpg'));	
$corpiva_breadcrumb_type    	= get_theme_mod('corpiva_breadcrumb_type','theme');
if($corpiva_hs_site_breadcrumb == '1'):	
?>
<section id="dt_pagetitle" class="dt_pagetitle dt-text-center" style="background-image: url(<?php echo esc_url($corpiva_breadcrumb_bg_img); ?>);">
	<div class="dt-container">
		<div class="dt_pagetitle_content">  
			<?php if($corpiva_breadcrumb_type == 'yoast' && (function_exists('yoast_breadcrumb'))):  yoast_breadcrumb(); ?>
			<?php elseif($corpiva_breadcrumb_type == 'rankmath' && (function_exists('rank_math_the_breadcrumbs'))):  rank_math_the_breadcrumbs(); ?>	
			<?php elseif($corpiva_breadcrumb_type == 'navxt' && (function_exists('bcn_display'))):  bcn_display(); else: ?>
				<div class="title">
					<?php
						if(is_home() || is_front_page()) {
							echo '<h1>'; echo single_post_title(); echo '</h1>';
						} else {
							corpiva_theme_page_header_title();
						} 
					?>
				</div>
				<ul class="dt_pagetitle_breadcrumb">
					<?php corpiva_page_header_breadcrumbs(); ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="patterns-layer pattern_1"></div>
	<div class="patterns-layer pattern_2"></div>
</section>
<?php endif; ?>	