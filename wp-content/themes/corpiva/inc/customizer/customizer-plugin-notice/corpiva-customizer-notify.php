<?php

class Corpiva_Customizer_Notify {

	private $recommended_actions;

	
	private $recommended_plugins;

	private $config;
	
	private static $instance;

	
	private $recommended_actions_title;

	
	private $recommended_plugins_title;

	
	private $dismiss_button;

	
	private $install_button_label;

	
	private $activate_button_label;

	
	private $corpiva_deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Corpiva_Customizer_Notify ) ) {
			self::$instance = new Corpiva_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $corpiva_customizer_notify_recommended_plugins;
		global $corpiva_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $corpiva_deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$corpiva_customizer_notify_recommended_plugins = array();
		$corpiva_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$corpiva_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$corpiva_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label    = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label   = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$corpiva_deactivate_button_label = isset( $this->config['corpiva_deactivate_button_label'] ) ? $this->config['corpiva_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'corpiva_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'corpiva_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'corpiva_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'corpiva_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function corpiva_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'corpiva-customizer-notify-css', get_template_directory_uri() . '/inc/customizer/customizer-plugin-notice/css/corpiva-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'corpiva-customizer-notify-js', get_template_directory_uri() . '/inc/customizer/customizer-plugin-notice/js/corpiva-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'corpiva-customizer-notify-js', 'corpivaCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'corpiva' ),
				'nonce' => wp_create_nonce('ajax-nonce')
			)
		);

	}

	
	public function corpiva_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/inc/customizer/customizer-plugin-notice/corpiva-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Corpiva_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new corpiva_Customizer_Notify_Section(
				$wp_customize,
				'Corpiva-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function corpiva_customizer_notify_dismiss_recommended_action_callback() {

		global $corpiva_customizer_notify_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */ 

		if ( ! empty( $action_id ) ) {
			
			if ( get_option( 'corpiva_customizer_notify_show' ) ) {

				$corpiva_customizer_notify_show_recommended_actions = get_option( 'corpiva_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$corpiva_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$corpiva_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'corpiva_customizer_notify_show', $corpiva_customizer_notify_show_recommended_actions );

				
			} else {
				$corpiva_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $corpiva_customizer_notify_recommended_actions ) ) {
					foreach ( $corpiva_customizer_notify_recommended_actions as $corpiva_lite_customizer_notify_recommended_action ) {
						if ( $corpiva_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$corpiva_customizer_notify_show_recommended_actions[ $corpiva_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$corpiva_customizer_notify_show_recommended_actions[ $corpiva_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'corpiva_customizer_notify_show', $corpiva_customizer_notify_show_recommended_actions );
				}
			}
		}
		die(); 
	}

	
	public function corpiva_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {

			$corpiva_lite_customizer_notify_show_recommended_plugins = get_option( 'corpiva_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$corpiva_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$corpiva_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'corpiva_customizer_notify_show_recommended_plugins', $corpiva_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}
