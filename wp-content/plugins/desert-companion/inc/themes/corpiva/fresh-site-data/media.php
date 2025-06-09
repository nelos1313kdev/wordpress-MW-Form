<?php
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Corvita' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/corvita/assets/images/logo.png';
}elseif ( 'Corvia' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/corvia/assets/images/logo.png';
}elseif ( 'Advancea' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/advancea/assets/images/logo.png';
}elseif ( 'Avanta' == $desert_activated_theme->name){
$site_logo = desert_companion_plugin_dir .'inc/themes/avanta/assets/images/logo.png';
}else{
$site_logo = desert_companion_plugin_dir .'inc/themes/corpiva/assets/images/logo.png';
}
$theme_img_path = desert_companion_plugin_dir .'inc/themes/corpiva/assets/images';

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
		'post_excerpt' => 'Corpiva caption',
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

 update_option( 'corpiva_media_id', $ImageId );
