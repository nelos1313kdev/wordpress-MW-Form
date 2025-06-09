<?php  
	$cosmobit_blog_options_hide_show= get_theme_mod('cosmobit_blog_options_hide_show','1'); 
	$cosmobit_blog_ttl		= get_theme_mod('cosmobit_blog_ttl','Our Blog'); 
	$cosmobit_blog_subttl	= get_theme_mod('cosmobit_blog_subttl','Latest Posts'); 
	$cosmobit_blog_text		= get_theme_mod('cosmobit_blog_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_blog_num		= get_theme_mod('cosmobit_blog_num','6'); 
	$cosmobit_blog_option_before= get_theme_mod('cosmobit_blog_option_before');
	$cosmobit_blog_option_after	= get_theme_mod('cosmobit_blog_option_after');
	if(!empty($cosmobit_blog_option_before)): echo do_shortcode($cosmobit_blog_option_before); endif;
	if($cosmobit_blog_options_hide_show=='1'):
?>	
<section id="blog_options" class="dt__posts dt__posts--one dt-py-default front1--blog">
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_blog_ttl )  || ! empty( $cosmobit_blog_subttl ) || ! empty( $cosmobit_blog_text )) : ?>
		<div class="dt-row dt-mb-5 dt-pb-2">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
				<div class="dt__siteheading wow fadeInUp">
					<?php if ( ! empty( $cosmobit_blog_ttl ) ) : ?>
						<div class="subtitle"><?php echo wp_kses_post($cosmobit_blog_ttl); ?></div>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_blog_subttl ) ) : ?>
						<h2 class="title"><?php echo wp_kses_post($cosmobit_blog_subttl); ?></h2>
					<?php endif; ?>
					
					<?php if ( ! empty( $cosmobit_blog_text ) ) : ?>
						<div class="text">
							<?php echo wp_kses_post($cosmobit_blog_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="dt-row wow fadeInUp">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12">
				<div class="dt__posts-carousel dt__dotstyle--one owl-carousel owl-theme">
					<?php 
						$cosmobit_post_args = array( 'post_type' => 'post', 'posts_per_page' => $cosmobit_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
						
					$cosmobit_wp_query = new WP_Query($cosmobit_post_args);
						if($cosmobit_wp_query)
						{	
						while($cosmobit_wp_query->have_posts()):$cosmobit_wp_query->the_post();
						?>
						<div class="owl-carousel-item">
							<?php get_template_part('template-parts/content','page'); ?>
						</div>
					<?php endwhile; } wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if(!empty($cosmobit_blog_option_after)): echo do_shortcode($cosmobit_blog_option_after); endif; ?>