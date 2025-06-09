<?php  
	$atua_blog_options_hide_show = get_theme_mod('atua_blog_options_hide_show','1');
	$atua_blog_ttl		= get_theme_mod('atua_blog_ttl','Article'); 
	$atua_blog_subttl	= get_theme_mod('atua_blog_subttl','Recent <span class="dt_heading dt_heading_9"><span class="dt_heading_inner"><b class="is_on">Blog Post</b> <b>Blog Post</b> <b>Blog Post</b></span></span>'); 
	$atua_blog_text		= get_theme_mod('atua_blog_text','Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.'); 
	$atua_blog_num			= get_theme_mod('atua_blog_num','3'); 
	$atua_blog_option_before	= get_theme_mod('atua_blog_option_before');
	$atua_blog_option_after	= get_theme_mod('atua_blog_option_after');
	if(!empty($atua_blog_option_before)): echo do_shortcode($atua_blog_option_before); endif;
	$tax = 'blog_categories'; 
	$tax_terms = get_terms($tax);
if($atua_blog_options_hide_show=='1'):	
?>
<section id="dt_posts" class="dt_posts dt_posts--one front-blog">
	<div class="dt-container">
		<div class="dt-container-inner dt-py-default">
			<?php if ( ! empty( $atua_blog_ttl )  || ! empty( $atua_blog_subttl ) || ! empty( $atua_blog_text )) : ?>
			<div class="dt-row">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
					<div class="dt_siteheading dt-text-center">
						<?php if ( ! empty( $atua_blog_ttl ) ) : ?>
							<span class="subtitle"><?php echo wp_kses_post($atua_blog_ttl); ?></span>
						<?php endif; ?>	
						
						<?php if ( ! empty( $atua_blog_subttl ) ) : ?>
							<h2 class="title">
								<?php echo wp_kses_post($atua_blog_subttl); ?>
							</h2>
						<?php endif; ?>	
						
						<?php if ( ! empty( $atua_blog_text ) ) : ?>
							<div class="text dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
								<p><?php echo wp_kses_post($atua_blog_text); ?></p>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
			<div class="dt-row dt-g-4">
				<?php 
				$atua_post_args = array( 'post_type' => 'post', 'posts_per_page' => $atua_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				
			$atua_wp_query = new WP_Query($atua_post_args);
				if($atua_wp_query)
				{	
				$i = 0;
				while($atua_wp_query->have_posts()):$atua_wp_query->the_post();
				?>
				<div class="dt-col-lg-4 dt-col-sm-6 dt-col-12">
					<div class="dt_post_item wow fadeInUp animated" data-wow-delay="<?php echo esc_attr(($i+1)*100); ?>ms" data-wow-duration="1500ms">
						<?php get_template_part('template-parts/content','page-2'); ?>
					</div>
				</div>
				<?php $i=(int)$i + 1; endwhile; } wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>	
<?php endif; if(!empty($atua_blog_option_after)): echo do_shortcode($atua_blog_option_after); endif; ?>