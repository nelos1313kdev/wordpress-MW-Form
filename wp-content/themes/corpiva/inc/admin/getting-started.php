<?php
/**
* Get started notice
*/

add_action( 'wp_ajax_corpiva_dismissed_notice_handler', 'corpiva_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function corpiva_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function corpiva_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="corpiva-getting-started-notice clearfix">
                    <div class="corpiva-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'corpiva' ); ?>" />
                    </div><!-- /.corpiva-theme-screenshot -->
                    <div class="corpiva-theme-notice-content">
                        <h2 class="corpiva-notice-h2">
                            <?php
                        printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'corpiva' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php echo sprintf(__('To take full advantage of all the features of this theme, please install and activate the <strong>Desert Companion</strong> plugin, then enjoy this theme.', 'corpiva')) ?></p>

                        <a class="corpiva-btn-get-started button button-primary button-hero corpiva-button-padding" href="#" data-name="" data-slug="">
						<?php
                        printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Get started with %1$s', 'corpiva' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
						
						</a><span class="corpiva-push-down">
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                'or %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div><!-- /.corpiva-theme-notice-content -->
                </div>
            </div>
        <?php }
}

add_action( 'admin_notices', 'corpiva_deprecated_hook_admin_notice' );

/**
* Plugin installer
*/

add_action( 'wp_ajax_install_act_plugin', 'corpiva_admin_install_plugin' );

function corpiva_admin_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/desert-companion' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'desert-companion' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'desert-companion/desert-companion.php' );
    }
}