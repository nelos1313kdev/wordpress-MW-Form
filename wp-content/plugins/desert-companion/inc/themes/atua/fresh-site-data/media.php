<?php
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Flexeo' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/flexeo/assets/images/logo.png';
}elseif ( 'Altra' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/altra/assets/images/logo.png';
}elseif ( 'Avvy' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/avvy/assets/images/logo.png';	
}elseif ( 'Atus' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/atus/assets/images/logo.png';
}elseif ( 'Flexea' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/flexea/assets/images/logo.png';
}elseif ( 'Atrux' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/atrux/assets/images/logo.png';
}elseif ( 'Fluxa' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/fluxa/assets/images/logo.png';
}elseif ( 'Atuxa' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/atuxa/assets/images/logo.png';
}elseif ( 'Atuvi' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/atuvi/assets/images/logo.png';
}elseif ( 'Flexina' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/flexina/assets/images/logo.png';
}elseif ( 'Flexiva' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/flexiva/assets/images/logo.png';
}else{
$site_logo = desert_companion_plugin_dir .'inc/themes/atua/assets/images/logo.png';
}
$theme_img_path = desert_companion_plugin_dir .'inc/themes/atua/assets/images';

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
		'post_excerpt' => 'Atua caption',
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

 update_option( 'atua_media_id', $ImageId );
