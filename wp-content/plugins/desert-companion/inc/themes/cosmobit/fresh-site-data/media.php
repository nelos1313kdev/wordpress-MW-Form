<?php
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Celexo' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/celexo/assets/images/logo.png';
}elseif ( 'chitvi' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/chitvi/assets/images/logo.png';
}elseif ( 'Flexora' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/flexora/assets/images/logo.png';
}elseif ( 'Thinity' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/thinity/assets/images/logo.png';
}elseif ( 'EasyWiz' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/easywiz/assets/images/logo.png';
}elseif ( 'LazyPress' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/lazypress/assets/images/logo.png';
}elseif ( 'Fastica' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/fastica/assets/images/logo.png';
}elseif ( 'Arvana' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/arvana/assets/images/logo.png';
}elseif ( 'Auru' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/auru/assets/images/logo.png';
}elseif ( 'Aahana' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/aahana/assets/images/logo.png';
}elseif ( 'Crombit' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/crombit/assets/images/logo.png';
}elseif ( 'Arvita' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/arvita/assets/images/logo.png';
}else{
$site_logo = desert_companion_plugin_dir .'inc/themes/cosmobit/assets/images/logo.png';	
}
$theme_img_path = desert_companion_plugin_dir .'inc/themes/cosmobit/assets/images';

$images = array(
$site_logo
);
$parent_post_id = null;
foreach($images as $name) {
$filename = basename($name);
$upload_file = wp_upload_bits($filename, null, file_get_contents($name));
if (!$upload_file['error']) {
	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_parent' => $parent_post_id,
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_excerpt' => 'Cosmobit caption',
		'post_status' => 'inherit'
	);
	$ImageId[] = $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
	
	if (!is_wp_error($attachment_id)) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );
	}
}

}

 update_option( 'cosmobit_media_id', $ImageId );
