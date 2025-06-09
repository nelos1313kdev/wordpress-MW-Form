<?php  
$softme_blog_options_hide_show = get_theme_mod('softme_blog_options_hide_show','1');
$softme_blog_ttl		= get_theme_mod('softme_blog_ttl','<b class="is_on">What’s Happening</b><b>What’s Happening</b><b>What’s Happening</b>'); 
$softme_blog_subttl	= get_theme_mod('softme_blog_subttl','Latest News & Articles from the </br><span>Posts</span>'); 
$softme_blog_text		= get_theme_mod('softme_blog_text','Amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim ad minim veniam.'); 
$softme_blog_num			= get_theme_mod('softme_blog_num','3'); 
$softme_blog_option_before	= get_theme_mod('softme_blog_option_before');
$softme_blog_option_after	= get_theme_mod('softme_blog_option_after');
if(!empty($softme_blog_option_before)): echo do_shortcode($softme_blog_option_before); endif;
$tax = 'blog_categories'; 
$tax_terms = get_terms($tax);
if($softme_blog_options_hide_show=='1'):
?>
<section id="dt_posts" class="dt_posts dt-py-default front-posts">
	<div class="dt-container">
		<?php if ( ! empty( $softme_blog_ttl )  || ! empty( $softme_blog_subttl ) || ! empty( $softme_blog_text )) : ?>
			<div class="dt-row">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
					<div class="dt_siteheading dt-text-center">
						<?php if ( ! empty( $softme_blog_ttl ) ) : ?>
							 <span class="subtitle">
								<span class="dt_heading dt_heading_8">
									<span class="dt_heading_inner">
										<?php echo wp_kses_post($softme_blog_ttl); ?>
									</span>
								</span>
							</span>
						<?php endif; ?>
						
						<?php if ( ! empty( $softme_blog_subttl ) ) : ?>
							<h2 class="title">
								<?php echo wp_kses_post($softme_blog_subttl); ?>
							</h2>
						<?php endif; ?>	
						
						<?php if ( ! empty( $softme_blog_text ) ) : ?>
						<div class="text dt-mt-3 wow fadeInUp" data-wow-duration="1500ms">
							<p><?php echo wp_kses_post($softme_blog_text); ?></p>
						</div>
					<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="dt-row dt-g-4">
			<?php 
				$softme_post_args = array( 'post_type' => 'post', 'posts_per_page' => $softme_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				
				$softme_wp_query = new WP_Query($softme_post_args);
				if($softme_wp_query)
				{	
				$i = 0;
				while($softme_wp_query->have_posts()):$softme_wp_query->the_post();
			?>
				<div class="dt-col-lg-4 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr(($i+1)*100); ?>ms" data-wow-duration="1500ms">
					<?php get_template_part('template-parts/content','page');  ?>
				</div>
			<?php $i=(int)$i + 1; endwhile; } wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php if(!empty($softme_blog_option_after)): echo do_shortcode($softme_blog_option_after); endif; endif; ?>