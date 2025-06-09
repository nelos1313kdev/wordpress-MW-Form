<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeansar.com/
 * @since      1.0.0
 *
 * @package    Ansar_Import
 * @subpackage Ansar_Import/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ansar_Import
 * @subpackage Ansar_Import/includes
 * @author     Themeansar <info@themeansar.com>
 */
class Desert_Import {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Desert_Import_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if (defined('DESERT_IMPORT_VERSION')) {
            $this->version = DESERT_IMPORT_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'desert-companion';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Desert_Import_Loader. Orchestrates the hooks of the plugin.
     * - Desert_Import_i18n. Defines internationalization functionality.
     * - Desert_Import_Admin. Defines all hooks for the admin area.
     * - Desert_Import_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-desert-import-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-desert-import-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-desert-import-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-desert-import-public.php';

        $this->loader = new Desert_Import_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Desert_Import_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Desert_Import_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    public function install_demo($theme_id) {


        $nav_menus = wp_get_nav_menus();

        // Delete navigation menus.
        if (!empty($nav_menus)) {
            foreach ($nav_menus as $nav_menu) {
                wp_delete_nav_menu($nav_menu->slug);
            }
        }

        //sleep(15);
        //die();
        if (empty($theme_id)) {
            $importer_error = true;
            $importer_error_msg = "No theme id passed!";
        }
        // Load Importer API
        require_once ABSPATH . 'wp-admin/includes/import.php';
        // require plugin_dir_path(dirname(__FILE__)) ."includes/parsers.php";
        //check if wp_importer, the base importer class is available, otherwise include it
        if (!class_exists('WP_Importer')) {
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            if (file_exists($class_wp_importer)) {
                require_once( $class_wp_importer );
            } else {
                $importer_error = true;
            }
        }
        //Setting upload Dir
        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/desert_import_data';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755);
        }
        //Getting demo data
        $theme_data_api = wp_remote_get(esc_url_raw("https://preview.desertthemes.com/wp-json/wp/v2/demos/" . $theme_id));
        $theme_data_api_body = wp_remote_retrieve_body($theme_data_api);
        $theme_data_api = json_decode($theme_data_api_body, TRUE);
        // print_r($theme_data_api);
        //   sleep(15);
        //die();
        //Getting Demo files from url
        file_put_contents($upload['basedir'] . '/desert_import_data/widgets.wie', fopen($theme_data_api['meta']['widget_file_url'], 'r'));
        file_put_contents($upload['basedir'] . '/desert_import_data/customizer.dat', fopen($theme_data_api['meta']['customizer_file_url'], 'r'));
        file_put_contents($upload['basedir'] . '/desert_import_data/data.xml', fopen($theme_data_api['meta']['data_file_url'], 'r'));


        $wiget_file = $upload['basedir'] . '/desert_import_data/widgets.wie';
        $customizer_file = $upload['basedir'] . '/desert_import_data/customizer.dat';
        $data_file = $upload['basedir'] . '/desert_import_data/data.xml';
        // File exists?
        if (!file_exists($wiget_file)) {
            wp_die(esc_html__('Import file could not be found for widget. Please try again.','desert-companion'));
        }
        // File exists?
        if (!file_exists($data_file)) {
            wp_die(esc_html__('Data import file could not be found for data. Please try again.','desert-companion'));
        }
        // File exists?
        if (!file_exists($customizer_file)) {
            wp_die(esc_html__('Customizer file could not be found for data. Please try again.','desert-companion'));
        }

        //remove current home page if exsist
        $home_d = get_page_by_title('Home');
        if (isset($home_d)) {
            wp_delete_post($home_d, true);
            unset($home_d);
        }

        // echo 'Pages import started! <br>';
        $import = new DESERT_WP_Import();
        $import->dispatch();

        //  echo 'importing widget . . . <br>';

        $sidebars_widgets = wp_get_sidebars_widgets();

        // Reset active widgets.
        foreach ($sidebars_widgets as $key => $widgets) {
            $sidebars_widgets[$key] = array();
        }

        wp_set_sidebars_widgets($sidebars_widgets);

        //reset Done
        $desert_importer = new Desert_Import();
        $desert_import_wie_import_results = $desert_importer->desert_import_wie_import_data($wiget_file);
        // echo 'Widget import done<br>';
        //echo 'Customizer import started!<br> ';
        $desert_importer->desert_import_customizer_settings($customizer_file);
        update_option( 'desert_demo_installed', $theme_id );
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Desert_Import_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('wp_ajax_import_action', $plugin_admin, 'import_data_ajax');
        $this->loader->add_action('admin_menu', $plugin_admin, 'register_theme_page');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Desert_Import_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Desert_Import_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    public function desert_import_available_widgets() {

        global $wp_registered_widget_controls;

        $widget_controls = $wp_registered_widget_controls;

        $available_widgets = array();

        foreach ($widget_controls as $widget) {

            // No duplicates.
            if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];
            }
        }

        return apply_filters('desert_import_available_widgets', $available_widgets);
    }

    /**
     * Import widget JSON data
     *
     * @since 0.4
     * @global array $wp_registered_sidebars
     * @param object $data JSON widget data from .wie file.
     * @return array Results array
     */
    public function desert_import_wie_import_data($file) {

        global $wp_registered_sidebars;

        $w_data = implode('', file($file));
        $data = json_decode($w_data);

        // Have valid data?
        // If no data or could not decode.
        if (empty($data) || !is_object($data)) {

            wp_die(
                    esc_html__('Import data could not be read. Please try a different file.', 'desert-companion'), '', array(
                'back_link' => true,
                    )
            );
        }

        // Hook before import.
        do_action('desert_import_wie_before_import');
        $data = apply_filters('desert_import_wie_import_data', $data);

        // Get all available widgets site supports.
        $available_widgets = $this->desert_import_available_widgets();

        // Get all existing widget instances.
        $widget_instances = array();
        foreach ($available_widgets as $widget_data) {
            $widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
        }

        // Begin results.
        $results = array();

        // Loop import data's sidebars.
        foreach ($data as $sidebar_id => $widgets) {

            // Skip inactive widgets (should not be in export file).
            if ('wp_inactive_widgets' === $sidebar_id) {
                continue;
            }

            // Check if sidebar is available on this site.
            // Otherwise add widgets to inactive, and say so.
            if (isset($wp_registered_sidebars[$sidebar_id])) {
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // Add to inactive if sidebar does not exist in theme.
                $sidebar_message_type = 'error';
                $sidebar_message = esc_html__('Widget area does not exist in theme (using Inactive)', 'desert-companion');
            }

            // Result for sidebar
            // Sidebar name if theme supports it; otherwise ID.
            $results[$sidebar_id]['name'] = !empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();

            // Loop widgets.
            foreach ($widgets as $widget_instance_id => $widget) {

                $fail = false;

                // Get id_base (remove -# from end) and instance ID number.
                $id_base = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
                $instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);

                // Does site support this widget?
                if (!$fail && !isset($available_widgets[$id_base])) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = esc_html__('Site does not support widget', 'desert-companion'); // Explain why widget not imported.
                }

                // Filter to modify settings object before conversion to array and import
                // Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
                // Ideally the newer desert_import_desert_import_wie_widget_settings_array below will be used instead of this.
                $widget = apply_filters('desert_import_wie_widget_settings', $widget);

                // Convert multidimensional objects to multidimensional arrays
                // Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
                // Without this, they are imported as objects and cause fatal error on Widgets page
                // If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
                // It is probably much more likely that arrays are used than objects, however.
                $widget = json_decode(wp_json_encode($widget), true);

                // Filter to modify settings array
                // This is preferred over the older desert_import_wie_widget_settings filter above
                // Do before identical check because changes may make it identical to end result (such as URL replacements).
                $widget = apply_filters('desert_import_desert_import_wie_widget_settings_array', $widget);

                // Does widget with identical settings already exist in same sidebar?
                if (!$fail && isset($widget_instances[$id_base])) {

                    // Get existing widgets in this sidebar.
                    $sidebars_widgets = get_option('sidebars_widgets');
                    $sidebar_widgets = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array(); // Check Inactive if that's where will go.
                    // Loop widgets with ID base.
                    $single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
                    foreach ($single_widget_instances as $check_id => $check_widget) {

                        // Is widget in same sidebar and has identical settings?
                        if (in_array("$id_base-$check_id", $sidebar_widgets, true) && (array) $widget === $check_widget) {

                            $fail = true;
                            $widget_message_type = 'warning';

                            // Explain why widget not imported.
                            $widget_message = esc_html__('Widget already exists', 'desert-companion');

                            break;
                        }
                    }
                }

                // No failure.
                if (!$fail) {

                    // Add widget instance
                    $single_widget_instances = get_option('widget_' . $id_base); // All instances for that widget ID base, get fresh every time.
                    $single_widget_instances = !empty($single_widget_instances) ? $single_widget_instances : array(
                        '_multiwidget' => 1, // Start fresh if have to.
                    );
                    $single_widget_instances[] = $widget; // Add it.
                    // Get the key it was given.
                    end($single_widget_instances);
                    $new_instance_id_number = key($single_widget_instances);

                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load,
                    // and the widget doesn't stick (reload wipes it).
                    if ('0' === strval($new_instance_id_number)) {
                        $new_instance_id_number = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset($single_widget_instances[0]);
                    }

                    // Move _multiwidget to end of array for uniformity.
                    if (isset($single_widget_instances['_multiwidget'])) {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset($single_widget_instances['_multiwidget']);
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }

                    // Update option with new widget.
                    update_option('widget_' . $id_base, $single_widget_instances);

                    // Assign widget instance to sidebar.
                    // Which sidebars have which widgets, get fresh every time.
                    $sidebars_widgets = get_option('sidebars_widgets');

                    // Avoid rarely fatal error when the option is an empty string
                    // https://github.com/churchthemes/widget-importer-exporter/pull/11.
                    if (!$sidebars_widgets) {
                        $sidebars_widgets = array();
                    }

                    // Use ID number from new widget instance.
                    $new_instance_id = $id_base . '-' . $new_instance_id_number;

                    // Add new instance to sidebar.
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id;

                    // Save the amended data.
                    update_option('sidebars_widgets', $sidebars_widgets);

                    // After widget import action.
                    $after_widget_import = array(
                        'sidebar' => $use_sidebar_id,
                        'sidebar_old' => $sidebar_id,
                        'widget' => $widget,
                        'widget_type' => $id_base,
                        'widget_id' => $new_instance_id,
                        'widget_id_old' => $widget_instance_id,
                        'widget_id_num' => $new_instance_id_number,
                        'widget_id_num_old' => $instance_id_number,
                    );
                    do_action('desert_import_wie_after_widget_import', $after_widget_import);

                    // Success message.
                    if ($sidebar_available) {
                        $widget_message_type = 'success';
                        $widget_message = esc_html__('Imported', 'desert-companion');
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = esc_html__('Imported to Inactive', 'desert-companion');
                    }
                }

                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base; // Widget name or ID if name not available (not supported by site).
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = !empty($widget['title']) ? $widget['title'] : esc_html__('No Title', 'widget-importer-exporter'); // Show "No Title" if widget instance is untitled.
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
            }
        }

        // Hook after import.
        do_action('desert_import_wie_after_import');

        // Return results.
        return apply_filters('desert_import_wie_import_results', $results);
    }

    function desert_import_customizer_settings($custom_file) {
        // Check to see if the settings have already been imported.
        $template = get_template();
        $imported = get_option($template . '_customizer_import', false);

        // Bail if already imported.
        if ($imported) {
            return;
        }
        remove_theme_mods();
        // Get the path to the customizer export file.
        $path = $custom_file;

        // Return if the file doesn't exist.
        if (!file_exists($path)) {
            return;
        }

        // Get the settings data.
        $data = @unserialize(file_get_contents($path));

        // Return if something is wrong with the data.
        if ('array' != gettype($data) || !isset($data['mods'])) {
            return;
        }

        // Import options.
        if (isset($data['options'])) {
            foreach ($data['options'] as $option_key => $option_value) {
                update_option($option_key, $option_value);
            }
        }

        // Import mods.
        foreach ($data['mods'] as $key => $val) {
            set_theme_mod($key, $val);
        }

        //   echo 'Fixing Menu . .<br>';

        $menu = wp_get_nav_menus();

        $locations = get_theme_mod('nav_menu_locations');

        foreach ($menu as $menu_key => $menu_value) {
            if (array_key_exists($menu_value->name, $locations)) {
                //  echo "Found the Key";
                $locations[$menu_value->name] = $menu_value->term_id;
            }
        }

        set_theme_mod('nav_menu_locations', $locations);

        // echo 'Seting Home and Blog page . .<br>';

        $homepage = get_page_by_title('Home');

        if ($homepage) {
            update_option('page_on_front', $homepage->ID);
            update_option('show_on_front', 'page');
        }

        $blogpage = get_page_by_title('Blog');

        if ($blogpage) {
            update_option('page_for_posts', $blogpage->ID);
        }
    }

}
