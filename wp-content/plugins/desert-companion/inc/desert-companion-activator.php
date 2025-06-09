<?php
/**
 * Fired during plugin Activation
 *
 * @package    Desert Companion
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 */
class Desert_Companion_Activator {

	public static function activate() {

        $item_details_page = get_option('item_details_page'); 
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		if(!$item_details_page){
			if ( 'Cosmobit' == $desert_activated_theme->name || 'Cosmobit Child' == $desert_activated_theme->name || 'Celexo' == $desert_activated_theme->name  || 'Chitvi' == $desert_activated_theme->name  || 'Flexora' == $desert_activated_theme->name  || 'Thinity' == $desert_activated_theme->name  || 'EasyWiz' == $desert_activated_theme->name  || 'LazyPress' == $desert_activated_theme->name  || 'Fastica' == $desert_activated_theme->name || 'Arvana' == $desert_activated_theme->name  || 'Auru' == $desert_activated_theme->name  || 'Aahana' == $desert_activated_theme->name  || 'Crombit' == $desert_activated_theme->name  || 'Arvita' == $desert_activated_theme->name){
				 require desert_companion_plugin_dir .'inc/themes/cosmobit/fresh-site-data/media.php';
				require desert_companion_plugin_dir .'inc/themes/cosmobit/fresh-site-data/widget.php';
				
			}elseif('Atua' == $desert_activated_theme->name || 'Flexeo' == $desert_activated_theme->name  || 'Altra' == $desert_activated_theme->name || 'Avvy' == $desert_activated_theme->name  || 'Atus' == $desert_activated_theme->name  || 'Flexea' == $desert_activated_theme->name  || 'Atrux' == $desert_activated_theme->name || 'Fluxa' == $desert_activated_theme->name || 'Atuxa' == $desert_activated_theme->name  || 'Atuvi' == $desert_activated_theme->name  || 'Flexina' == $desert_activated_theme->name  || 'Flexiva' == $desert_activated_theme->name){
				 require desert_companion_plugin_dir .'inc/themes/atua/fresh-site-data/media.php';
				 require desert_companion_plugin_dir .'inc/themes/atua/fresh-site-data/widget.php';
			}elseif('SoftMe' == $desert_activated_theme->name || 'Softinn' == $desert_activated_theme->name || 'CozySoft' == $desert_activated_theme->name || 'CareSoft' == $desert_activated_theme->name || 'Suntech' == $desert_activated_theme->name  || 'EasyTech' == $desert_activated_theme->name  || 'TrueSoft' == $desert_activated_theme->name  || 'SoftMunch' == $desert_activated_theme->name  || 'SoftAlt' == $desert_activated_theme->name){
				 require desert_companion_plugin_dir .'inc/themes/softme/fresh-site-data/media.php';
				 require desert_companion_plugin_dir .'inc/themes/softme/fresh-site-data/widget.php';
			}elseif('Corpiva' == $desert_activated_theme->name  || 'Corvita' == $desert_activated_theme->name  || 'Corvia' == $desert_activated_theme->name  || 'Advancea' == $desert_activated_theme->name  || 'Avanta' == $desert_activated_theme->name){
				 require desert_companion_plugin_dir .'inc/themes/corpiva/fresh-site-data/media.php';
				 require desert_companion_plugin_dir .'inc/themes/corpiva/fresh-site-data/widget.php';
			}
			
			$pages = array( esc_html__( 'Home', 'desert-companion' ), esc_html__( 'Blog', 'desert-companion' ) );
					foreach ($pages as $page){ 
					$post_data = array( 'post_author' => 1, 'post_name' => $page,  'post_status' => 'publish' , 'post_title' => $page, 'post_type' => 'page', ); 	
					if($page== 'Home'): 
						$page_option = 'page_on_front';
						$template = 'page-templates/frontpage.php';	
					else: 	
						$page_option = 'page_for_posts';
						$template = 'page.php';
					endif;
					$post_data = wp_insert_post( $post_data, false );
						if ( $post_data ){
							update_post_meta( $post_data, '_wp_page_template', $template );
							$page = new WP_Query(
								array(
									'post_type'              => 'page',
									'title'                  => $page,
									'posts_per_page'         => 1,
									'no_found_rows'          => true,
									'ignore_sticky_posts'    => true,
									'update_post_term_cache' => false,
									'update_post_meta_cache' => false,
								)
							);
							update_option( 'show_on_front', 'page' );
							update_option( $page_option, $page->post->ID );
						}
					}
			
			update_option( 'item_details_page', 'Done' );
		}		
		
	}

}