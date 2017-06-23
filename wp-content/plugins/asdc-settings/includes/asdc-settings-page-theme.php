<?php
/*
 * ASDC Settings - Settings Page - Theme
 * File Version 14.0.0
 * Plugin Version 14.1.0
 */

//// BEG SETTINGS
class asdcSettingsPageTheme extends asdcSettingsDefaultCallbacks {
    static $options;
    static $option_name = 'asdc_settings_theme_option';
    static $class_name = 'asdcSettingsPageTheme';
    private $option_group = 'asdc_settings_theme_group';
    private $menu_slug = 'asdc-admin-settings-theme';

    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page')); // Add the Settings Menu Item
        add_action('admin_init', array($this, 'register_settings')); // Add the settings
    }

    public function add_settings_page() {
        add_submenu_page(
            'asdc-admin-settings',
            'ASDC Settings - ASDC Theme',
            'ASDC Theme',
            'manage_options',
            $this->menu_slug,
            array($this, 'asdc_admin_page_output')
        );
    }

    // BEG Admin Page Output
    public function asdc_admin_page_output() {
        self::$options = get_option(self::$option_name);
        ?>
        <div class="wrap asdc-settings-wrap">
            <script>var asdcTemplateDir = '<?php echo plugin_dir_url( __FILE__ ); ?>';</script>
            <h2 class="settings-title"><?php echo get_admin_page_title(); ?></h2>
            <?php
            if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
                ?>
                <div class="updated">
                    <p><strong>Settings saved.</strong></p>
                </div>
                <?php
            }
            ?>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->option_group);
                do_settings_sections($this->menu_slug);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    // END Admin Page Output

    //// BEG Add the settings
    public function register_settings() {
        register_setting(
            $this->option_group, // Option group
            self::$option_name, // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        $this_section_id = 'head_section';
        add_settings_section($this_section_id, 'Head Settings', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Favicon',
                'name' => 'favicon',
                'callback' => 'favicon_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }

        $this_section_id = 'meta_section';
        add_settings_section($this_section_id, 'Meta Settings', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Date Format',
                'name' => 'date',
                'callback' => 'asc_input_callback',
                'description' => 'e.g. m.d.y will show 12.20.2016 more can be found <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">here</a>',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }

        $this_section_id = 'advanced_section';
        add_settings_section($this_section_id, 'Advanced Settings', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Minified CSS',
                'name' => 'mini-css',
                'callback' => 'asc_switch_callback',
            ),
            array(
                'title' => 'Minified JS',
                'name' => 'mini-js',
                'callback' => 'asc_switch_callback',
            ),
            array(
                'title' => 'Popup Cookie Name',
                'name' => 'popup-cookie',
                'callback' => 'asc_input_callback',
            ),
            array(
                'title' => 'Popup Cookie Duration',
                'name' => 'popup-time',
                'callback' => 'asc_input_callback',
                'description' => 'Measured in days. Default is 7.',
            ),
            array(
                'title' => 'Comment Reply',
                'name' => 'comment-reply',
                'callback' => 'asc_switch_callback',
                'description' => 'Enable replies for WP native comment system. Leave OFF if you use Disqus.',
            ),
            array(
                'title' => 'Developing Mode',
                'name' => 'developing mode',
                'callback' => 'asc_switch_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }

        $this_section_id = 'asdc_pass_section';
        add_settings_section($this_section_id, 'ASDC PASS', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Lock',
                'name' => 'lock',
                'callback' => 'asc_switch_callback',
            ),
            array(
                'title' => 'Password',
                'name' => 'pass',
                'callback' => 'asc_input_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }
    }
    //// END Add the settings

    // BEG Favicon Callback
    public function favicon_callback($args) {
        $inputs = array(
            array(
                'type' => 'image-selector',
                'input-id' => 'image',
                'label' => 'Image',
            ),
        );
        $settings = array(
            'class' => self::$class_name,
        );
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END Favicon Callback

    public function sanitize($input) {
        return $input;
    }
}
if(is_admin()) {
    $asdc_settings_theme_page = new asdcSettingsPageTheme();
}
//// END SETTINGS
?>