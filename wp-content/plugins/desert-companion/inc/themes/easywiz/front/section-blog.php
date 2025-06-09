<?php  
	$cosmobit_blog_options_hide_show= get_theme_mod('cosmobit_blog_options_hide_show','1');
	$cosmobit_blog5_ttl		= get_theme_mod('cosmobit_blog5_ttl','Our Blog'); 
	$cosmobit_blog5_subttl	= get_theme_mod('cosmobit_blog5_subttl','Latest Posts'); 
	$cosmobit_blog5_text	= get_theme_mod('cosmobit_blog5_text','The majority have suffered alteration in some form, by cted ipsum dolor sit amet, consectetur adipisicing elit.'); 
	$cosmobit_blog5_num		= get_theme_mod('cosmobit_blog5_num','6'); 
	if($cosmobit_blog_options_hide_show=='1'):
?>	
<section id="blog5_options" class="dt__posts dt__posts--two dt-py-default front5--blog">
	<div class="dt-container">
		<?php if ( ! empty( $cosmobit_blog5_ttl )  || ! empty( $cosmobit_blog5_subttl ) || ! empty( $cosmobit_blog5_text )) : ?>
			<div class="dt-row dt-mb-5 dt-pb-2">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-mx-auto dt-text-center">
					<div class="dt__siteheading wow fadeIn">
						<?php if ( ! empty( $cosmobit_blog5_ttl ) ) : ?>
							<div class="subtitle"><?php echo wp_kses_post($cosmobit_blog5_ttl); ?></div>
						<?php endif; ?>
						
						<?php if ( ! empty( $cosmobit_blog5_subttl ) ) : ?>
							<h2 class="title"><?php echo wp_kses_post($cosmobit_blog5_subttl); ?></h2>
						<?php endif; ?>
						
						<?php if ( ! empty( $cosmobit_blog5_text ) ) : ?>
							<div class="text">
								<?php echo wp_kses_post($cosmobit_blog5_text ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<div class="dt-row wow fadeIn">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12">
				<div class="dt__posts-carousel dt__dotstyle--one owl-carousel owl-theme">
					<?php 
						$cosmobit_post_args = array( 'post_type' => 'post','posts_per_page' => $cosmobit_blog5_num,'post__not_in'=>get_option("sticky_posts")) ; 	
						
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