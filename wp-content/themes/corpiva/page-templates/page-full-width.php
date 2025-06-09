<?php
/**
Template Name: Fullwidth Page
**/

get_header();
?>
<section class="dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
				<?php 		
					the_post(); the_content(); 
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>

