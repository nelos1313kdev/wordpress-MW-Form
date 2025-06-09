<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Corpiva
 */

get_header(); 
?>
<section class="woo-products dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-5">
			<?php if (  !is_active_sidebar( 'corpiva-woocommerce-sidebar' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div id="dt-main" class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif; ?>	
				<?php woocommerce_content();  // WooCommerce Content ?>
			</div>
			<?php get_sidebar('woocommerce'); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>

