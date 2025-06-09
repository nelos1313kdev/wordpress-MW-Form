<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Corpiva
 */
if ( ! is_active_sidebar( 'corpiva-sidebar-primary' ) ) {	return; } ?>
<div id="dt-sidebar" class="dt-col-lg-4 dt-col-md-12 dt-col-12">
	<div class="dt_widget-area">
		<?php dynamic_sidebar('corpiva-sidebar-primary'); ?>
	</div>
</div>