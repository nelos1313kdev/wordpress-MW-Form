<?php
/**
Template Name: Builder Page
**/
get_header();
?>
<section id="page-builder" class="theme-builder">
	<?php 		
		the_post(); the_content(); 
		
		if( $post->comment_status == 'open' ) { 
			 comments_template( '', true ); // show comments 
		}
	?>
</section>
<?php get_footer(); ?>

