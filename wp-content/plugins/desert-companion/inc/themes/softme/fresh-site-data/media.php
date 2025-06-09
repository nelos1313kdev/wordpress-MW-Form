<?php
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Softinn' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/softinn/assets/images/logo.png';
}elseif ( 'CozySoft' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/cozysoft/assets/images/logo.png';
}elseif ( 'CareSoft' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/caresoft/assets/images/logo.png';
}elseif ( 'Suntech' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/suntech/assets/images/logo.png';
}elseif ( 'EasyTech' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/easytech/assets/images/logo.png';
}elseif ( 'TrueSoft' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/truesoft/assets/images/logo.png';
}elseif ( 'SoftMunch' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/softmunch/assets/images/logo.png';
}elseif ( 'SoftAlt' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/softalt/assets/images/logo.png';
}else{
$site_logo = desert_companion_plugin_dir .'inc/themes/softme/assets/images/logo.png';	
}	
$theme_img_path = desert_companion_plugin_dir .'inc/themes/softme/assets/images';

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
		'post_excerpt' => 'Softme caption',
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

 update_option( 'softme_media_id', $ImageId );
