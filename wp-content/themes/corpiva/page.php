<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corpiva
 */

get_header();
$corpiva_default_pg_sidebar_option= get_theme_mod('corpiva_default_pg_sidebar_option', 'right_sidebar'); 
?>
<section class="dt_posts dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if($corpiva_default_pg_sidebar_option == 'left_sidebar'): 
					if ( class_exists( 'WooCommerce' ) ) {
						if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woocommerce'); 
						}else{ 
							get_sidebar(); 
						}	
					}else{ 
						get_sidebar(); 
					}	
			endif; ?>
			<?php if($corpiva_default_pg_sidebar_option == 'no_sidebar'): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div id="dt-main" class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif;		
					if( have_posts()) :  the_post();
					
					the_content(); 
					endif;
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
			<?php if($corpiva_default_pg_sidebar_option == 'right_sidebar'): 
					if ( class_exists( 'WooCommerce' ) ) {
						if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woocommerce'); 
						}else{ 
							get_sidebar(); 
						}	
					}else{ 
						get_sidebar(); 
					}	
			endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>