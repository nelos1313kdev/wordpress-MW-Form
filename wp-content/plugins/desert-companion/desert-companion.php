<?php
/**
* Plugin Name:       	Desert Companion
* Plugin URI:        	
* Description:       	Desert Companion Enhances Desert Themes with additional functionality.
* Version:           	1.0.85
* Author: 				Desertthemes
* Author URI: 			http://desertthemes.com/
* Tested up to: 		6.8
* Requires: 			4.6 or higher
* License: 				GPLv3 or later
* License URI: 			http://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP: 		5.6
* Text Domain: 			desert-companion
*/

define( 'desert_companion_plugin_url', plugin_dir_url( __FILE__ ) );
define( 'desert_companion_plugin_dir', plugin_dir_path( __FILE__ ) );



if( !function_exists('desert_companion_init') ){
	function desert_companion_init(){
		require_once('inc/controls/code/desert-customize-upgrade-control.php');
		/**
		 * Get Activated Theme
		 */
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		// Cosmobit Theme
		if( 'Cosmobit' == $desert_activated_theme->name  || 'Cosmobit Child' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/cosmobit/cosmobit.php';
		}
		
		// Celexo Theme
		if( 'Celexo' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/celexo/celexo.php';
		}
		
		// Chitvi Theme
		if( 'Chitvi' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/chitvi/chitvi.php';
		}
		
		// Flexora Theme
		if( 'Flexora' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexora/flexora.php';
		}
		
		// Thinity Theme
		if( 'Thinity' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/thinity/thinity.php';
		}
		
		// EasyWiz Theme
		if( 'EasyWiz' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/easywiz/easywiz.php';
		}
		
		// LazyPress Theme
		if( 'LazyPress' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/lazypress/lazypress.php';
		}
		
		// Fastica Theme
		if( 'Fastica' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/fastica/fastica.php';
		}
		
		// Arvana Theme
		if( 'Arvana' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/arvana/arvana.php';
		}
		
		// Auru Theme
		if( 'Auru' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/auru/auru.php';
		}
		
		// Atua Theme
		if( 'Atua' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/atua/atua.php';
		}
		
		// Flexeo Theme
		if( 'Flexeo' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexeo/flexeo.php';
		}
		
		// Altra Theme
		if( 'Altra' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/altra/altra.php';
		}
		
		// Avvy Theme
		if( 'Avvy' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/avvy/avvy.php';
		}
		
		// Atus Theme
		if( 'Atus' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/atus/atus.php';
		}
		
		// Flexea Theme
		if( 'Flexea' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexea/flexea.php';
		}
		
		// Atrux Theme
		if( 'Atrux' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/atrux/atrux.php';
		}
		
		// SoftMe Theme
		if( 'SoftMe' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/softme/softme.php';
		}
		
		// Softinn Theme
		if( 'Softinn' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/softinn/softinn.php';
		}
		
		// CozySoft Theme
		if( 'CozySoft' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/cozysoft/cozysoft.php';
		}
		
		// CareSoft Theme
		if( 'CareSoft' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/caresoft/caresoft.php';
		}
		
		// Suntech Theme
		if( 'Suntech' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/suntech/suntech.php';
		}
		
		// Fluxa Theme
		if( 'Fluxa' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/fluxa/fluxa.php';
		}
		
		// EasyTech Theme
		if( 'EasyTech' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/easytech/easytech.php';
		}
		
		// Aahana Theme
		if( 'Aahana' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/aahana/aahana.php';
		}
		
		// Atuxa Theme
		if( 'Atuxa' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/atuxa/atuxa.php';
		}
		
		// TrueSoft Theme
		if( 'TrueSoft' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/truesoft/truesoft.php';
		}
		
		// Atuvi Theme
		if( 'Atuvi' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/atuvi/atuvi.php';
		}
		
		// Corpiva Theme
		if( 'Corpiva' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/corpiva/corpiva.php';
		}
		
		// SoftMunch Theme
		if( 'SoftMunch' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/softmunch/softmunch.php';
		}
		
		// Flexina Theme
		if( 'Flexina' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexina/flexina.php';
		}
		
		// Crombit Theme
		if( 'Crombit' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/crombit/crombit.php';
		}
		
		// Corvita Theme
		if( 'Corvita' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/corvita/corvita.php';
		}
		
		// Corvia Theme
		if( 'Corvia' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/corvia/corvia.php';
		}
		
		// SoftAlt Theme
		if( 'SoftAlt' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/softalt/softalt.php';
		}
		
		// Arvita Theme
		if( 'Arvita' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/arvita/arvita.php';
		}
		
		// Flexiva Theme
		if( 'Flexiva' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/flexiva/flexiva.php';
		}
		
		// Advancea Theme
		if( 'Advancea' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/advancea/advancea.php';
		}
		
		// Avanta Theme
		if( 'Avanta' == $desert_activated_theme->name){
			require desert_companion_plugin_dir . 'inc/themes/avanta/avanta.php';
		}
	}
	add_action( 'init', 'desert_companion_init' );
}

require_once plugin_dir_path( __FILE__ ) . 'inc/check-theme.php';

if (desert_companion_check_theme() == true){
	require_once plugin_dir_path( __FILE__ ) . 'inc/desert-import/desert-import.php';
}

/**
 * The code during plugin activation.
 */
function desert_companion_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/desert-companion-activator.php';
	Desert_Companion_Activator::activate();
}
register_activation_hook( __FILE__, 'desert_companion_activate' );