<?php  
$corpiva_blog_options_hide_show  = get_theme_mod('corpiva_blog_options_hide_show','1');
$corpiva_blog_ttl		= get_theme_mod('corpiva_blog_ttl','Blog & News'); 
$corpiva_blog_subttl	= get_theme_mod('corpiva_blog_subttl','Get Update Blog & News'); 
$corpiva_blog_text		= get_theme_mod('corpiva_blog_text','Ever find yourself staring at your computer screen a good consulting slogan to come to mind? Oftentimes.'); 
$corpiva_blog_cat			= get_theme_mod('corpiva_blog_cat','0'); 
$corpiva_blog_num			= get_theme_mod('corpiva_blog_num','3'); 
$tax = 'blog_categories'; 
$tax_terms = get_terms($tax);
if($corpiva_blog_options_hide_show=='1'):
?>
<section id="dt_posts" class="dt_posts dt-py-default front-posts" data-background="<?php echo esc_url(get_template_directory_uri());?>/assets/images/blog_bg.jpg">
	<div class="dt-container">
		<?php if ( ! empty( $corpiva_blog_ttl )  || ! empty( $corpiva_blog_subttl ) || ! empty( $corpiva_blog_text )) : ?>
			<div class="dt-row dt-mb-6">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-text-center">
					<div class="section-title animation-style3">
						<?php if ( ! empty( $corpiva_blog_ttl ) ) : ?>
							<span class="sub-title"><?php echo wp_kses_post($corpiva_blog_ttl); ?></span>
						<?php endif; ?>	
						
						<?php if ( ! empty( $corpiva_blog_subttl ) ) : ?>
							<h2 class="title dt-element-title"><?php echo wp_kses_post($corpiva_blog_subttl); ?></h2>
						<?php endif; ?>	
						<?php if ( ! empty( $corpiva_blog_text ) ) : ?>
							<p class="dt-mb-0"><?php echo wp_kses_post($corpiva_blog_text); ?></p>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4">
			<?php 
				$corpiva_post_args = array( 'post_type' => 'post', 'category__in' => $corpiva_blog_cat, 'posts_per_page' => $corpiva_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				
				$corpiva_wp_query = new WP_Query($corpiva_post_args);
				if($corpiva_wp_query)
				{	
				$i = 0;
				while($corpiva_wp_query->have_posts()):$corpiva_wp_query->the_post();
			?>
			<div class="dt-col-lg-4 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr(($i+1)*100); ?>ms" data-wow-duration="1500ms">
				<?php get_template_part('template-parts/content','page');  ?>
			</div>
			<?php $i=(int)$i + 1; endwhile; } wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>