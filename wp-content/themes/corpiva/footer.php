</div></div>
<?php 
if(!is_404()):
?>	
<footer id="dt_footer" class="dt_footer dt_footer--one clearfix">
	<div class="footer-shape">
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/footer-shape.png" alt="" data-aos="fade-right" data-aos-delay="200">
	</div>
	<?php 	
		// Footer Widget
		do_action('corpiva_footer_widget');

		// Footer Copyright
		do_action('corpiva_footer_bottom'); 	
	?>
</footer>
<?php 
// Top Scroller
do_action('corpiva_top_scroller'); 
endif;
wp_footer(); ?>
</body>
</html>
