<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>
<body <?php body_class('menu__active-five btn--effect-four section-title-two'); ?>>
<?php wp_body_open(); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'avanta' ); ?></a>
	
	<?php 
		// Theme Header
		do_action('corpiva_site_main_header'); 
		
		// Theme Breadcrumb
		if ( !is_page_template( 'page-templates/frontpage.php' )) {
				get_template_part('/template-parts/site','breadcrumb');
		}
	?>
	
	<div id="content" class="site-content">
	