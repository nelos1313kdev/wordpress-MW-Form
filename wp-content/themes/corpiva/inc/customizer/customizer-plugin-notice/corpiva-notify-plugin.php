<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/corpiva-customizer-notify.php';
$corpiva_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and sections of the Theme. please install and activate %s plugin', 'corpiva' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'corpiva' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'corpiva' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'corpiva' ),
	'activate_button_label'     => esc_html__( 'Activate', 'corpiva' ),
	'corpiva_deactivate_button_label'   => esc_html__( 'Deactivate', 'corpiva' ),
);
Corpiva_Customizer_Notify::init( apply_filters( 'corpiva_customizer_notify_array', $corpiva_config_customizer ) );