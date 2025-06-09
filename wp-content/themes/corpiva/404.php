<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Corpiva
 */

get_header();
?>
<section id="dt_not_found" class="dt_not_found">
	<div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/assets/images/not_found_shape.png);"></div>
	<div class="scroll-text">
		<div class="text-box-one">
			<div class="text-inner">
				<?php for( $i = 0; $i < 30; $i++){ echo sprintf(__('<h4>%1$s</h4>', 'corpiva'),'Page not found!'); } ?>
			</div>
		</div>
		<div class="text-box-two">
			<div class="text-inner">
				<?php for( $i = 0; $i < 30; $i++){ echo sprintf(__('<h4>%1$s</h4>', 'corpiva'),'Page not found!'); } ?>
			</div>
		</div>
	</div>
	<div class="content-box">
		<div class="inner-box">
			<h3><?php esc_html_e('Oops!','corpiva'); ?></h3>
			
			<div class="not_found"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/not_found.svg"/></div>
			
			<h2><?php esc_html_e('Page not found!','corpiva'); ?></h2>
			
			<p><?php esc_html_e('Unfortunately, something went wrong and this page does not exist. Try using click the button and return to the Home page.','corpiva'); ?></p>
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dt-btn dt-btn-primary"><?php esc_html_e('Back To Home','corpiva'); ?></a>
		</div>
	</div>
</section>
<?php get_footer(); ?>
