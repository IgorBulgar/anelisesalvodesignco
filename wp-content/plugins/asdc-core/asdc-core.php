<?php
/*
 * Plugin Name: ASDC Core
 * Description: The core of ASDC Themes.
 * Author: ASDC
 * Author URI: http://www.anelisesalvodesignco.com/
 * Version: 1.0.2
*/

class asdcCore {
    public static $paths = array();

    public function __construct() {
        self::$paths['APP_DIR'] = plugin_dir_url(__FILE__);

        require_once('core/asdc-functions.php'); // I have to add the basic functions
        require_once('core/asdc-theme-functions.php'); // Here we got theme functions

        if(is_admin()) {
            require_once('core/asdc-dashboard-builder.php'); // Let's build an awesome dashboard!
            require_once('core/asdc-settings.php'); // We're adding the settings pages
            require_once('setup/asdc-settings-add.php'); // Tell me the settings you want!
            require_once('init/asdc-init-settings.php'); // Initialize the settings
        }

        add_action('admin_enqueue_scripts', array($this, 'add_scripts')); // Adding admin scripts
    }

    public function add_scripts() {
        wp_enqueue_style('asdc-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('asdc-core-admin-css', plugins_url('/css/admin-style.css', __FILE__)); // Admin CSS
        wp_enqueue_script('asdc-core-admin-js', plugins_url('/js/admin-functions.js', __FILE__), array('jquery', 'wp-color-picker'), false, true); // Admin JS
        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');
        ?>
        <script>var asdc_core_admin_app_dir = '<?php echo self::$paths['APP_DIR']; ?>';</script>
        <?php
    }
}
$asdc_core = new asdcCore();