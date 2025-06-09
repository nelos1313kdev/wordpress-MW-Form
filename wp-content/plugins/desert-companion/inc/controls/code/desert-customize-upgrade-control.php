<?php
/** 
 * Customize Upgrade control class.
 *
 * @package Desert Companion
 * 
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Desert_Companion_Customize_Upgrade_Control
 */
 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Desert_Companion_Customize_Upgrade_Control extends WP_Customize_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'desert-companion-upgrade';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {
		$desert_activated_theme = wp_get_theme(); // gets the current theme
		if('Celexo' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/celexo-pro/';
		elseif('Chitvi' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/chitvi-pro/';
		elseif('Flexora' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexora-pro/';	
		elseif('Thinity' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/thinity-pro/';	
		elseif('EasyWiz' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/easywiz-pro/';	
		elseif('LazyPress' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/lazypress-pro/';
		elseif('Fastica' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/fastica-pro/';	
		elseif('Atua' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/atua-pro/';	
		elseif('Flexeo' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexeo-pro/';
		elseif('Altra' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/altra-pro/';	
		elseif('Avvy' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/avvy-pro/';	
		elseif('Atus' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/atus-pro/';	
		elseif('SoftMe' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/softme-pro/';
		elseif('Softinn' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/softinn-pro/';	
		elseif('CozySoft' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/cozysoft-pro/';	
		elseif('Flexea' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexea-pro/';	
		elseif('Atrux' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/atrux-pro/';	
		elseif('Arvana' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/arvana-pro/';
		elseif('Auru' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/auru-pro/';	
		elseif('CareSoft' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/caresoft-pro/';	
		elseif('Suntech' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/suntech-pro/';	
		elseif('Fluxa' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/fluxa-pro/';	
		elseif('EasyTech' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/easytech-pro/';	
		elseif('Aahana' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/aahana-pro/';		
		elseif('NewsMash' == $desert_activated_theme->name || 'NewsDaily' == $desert_activated_theme->name || 'DayStory' == $desert_activated_theme->name  || 'NewsAlt' == $desert_activated_theme->name  || 'NewsHours' == $desert_activated_theme->name  || 'AnyNews' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/newsmash-pro/';
		elseif('NewsMunch' == $desert_activated_theme->name || 'NewsTick' == $desert_activated_theme->name  || 'NewsAlert' == $desert_activated_theme->name || 'NewsBlogy' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/newsmunch-pro/';
		elseif('Atuxa' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/atuxa-pro/';
		elseif('TrueSoft' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/truesoft-pro/';	
		elseif('Atuvi' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/atuvi-pro/';
		elseif('Corpiva' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/corpiva-pro/';	
		elseif('SoftMunch' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/softmunch-pro/';
		elseif('Flexina' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexina-pro/';	
		elseif('Crombit' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/crombit-pro/';
		elseif('Corvita' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/corvita-pro/';	
		elseif('Corvia' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/corvia-pro/';
		elseif('SoftAlt' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/softalt-pro/';
		elseif('Arvita' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/arvita-pro/';	
		elseif('Flexiva' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/flexiva-pro/';	
		elseif('Advancea' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/advancea-pro/';	
		elseif('Avanta' == $desert_activated_theme->name):
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/avanta-pro/';
		else:
			$upgrade_to_pro_link = 'https://desertthemes.com/themes/cosmobit-pro/';
		endif;	
		?>

		<div class="desert-companion-upgrade-message" style="display:none";>
			<?php if(!empty($this->label)): ?>
				<h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="'.esc_url($upgrade_to_pro_link).'" target="_blank" > '.esc_html($desert_activated_theme). ' Pro </a> to be add More ', 'desert-companion') . esc_html($this->label); ?></h4>
			<?php endif; ?>
		</div>

		<?php
	}

}