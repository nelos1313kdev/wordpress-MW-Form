<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Corpiva
 */

get_header();
?>
<section class="dt_posts dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if (  !is_active_sidebar( 'corpiva-sidebar-primary' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div id="dt-main" class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif;
				if( have_posts() ):
					/* Start the Loop */
					 while( have_posts() ) : the_post();?>
						<div class="dt-col-lg-12 dt-mb-4 wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
							<?php get_template_part('template-parts/content','page'); ?>
						</div>
					<?php endwhile; 
					/* End the Loop */
					
					/* Post Navigation */
					the_posts_navigation();
					 else: get_template_part('template-parts/content','none'); 
			    endif; 
				?>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
