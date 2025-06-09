<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */


defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="loop-product-wrap">
		<div class="woo-thumb-wrap">
			<?php if ( $product->is_on_sale() ) : ?>
				<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale', 'corpiva' ) . '</span>', $product ); ?>
			<?php endif; ?>
			<?php the_post_thumbnail(); ?>
			<div class="product-icons-pack">
				<?php
					/**
					 * Hook: woocommerce_after_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>
		</div>
		<a href="<?php echo esc_url(get_permalink()); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
			<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
		</a>
		<?php echo $product->get_price_html(); ?>
	</div>
</li>