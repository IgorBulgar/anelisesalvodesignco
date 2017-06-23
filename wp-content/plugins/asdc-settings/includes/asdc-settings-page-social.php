<?php
/*
 * ASDC Settings - Settings Page Social
 * File Version 3.0.0.0
 * Plugin Version 3.0.0
 */

//// BEG SETTINGS
class asdcSettingsPageSocial {
    static $options;
    static $option_name = 'asdc_settings_social_option';
    static $class_name = 'asdcSettingsPageSocial';
    private $option_group = 'asdc_settings_social_group';
    private $menu_slug = 'asdc-admin-settings-social';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) ); // Add the Settings Menu Item
        add_action( 'admin_init', array( $this, 'register_settings' ) ); // Add the settings
    }

    public function add_settings_page() {
        add_submenu_page(
            'asdc-admin-settings',
            'ASDC Settings - Social Media',
            'Social Media',
            'manage_options',
            $this->menu_slug,
            array( $this, 'asdc_admin_page_output' )
        );
    }

    // BEG Admin Page Output
    public function asdc_admin_page_output() {
        self::$options = get_option( self::$option_name );
        ?>
        <div class="wrap asdc-settings-wrap">
            <script>var asdcTemplateDir = '<?php echo plugin_dir_url( __FILE__ ); ?>';</script>
            <h2 class="settings-title"><?php echo get_admin_page_title(); ?></h2>
            <?php
            if ( isset( $_GET[ 'settings-updated' ] ) && $_GET[ 'settings-updated' ] == 'true' ) {
                ?>
                <div class="updated">
                    <p><strong>Settings saved.</strong></p>
                </div>
            <?php
            }
            ?>
            <form method="post" action="options.php">
                <?php
                settings_fields( $this->option_group );
                do_settings_sections( $this->menu_slug );
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

        // BEG Social Media - 14.03.2017
        $this_section_id = 'social_media_section';
        add_settings_section($this_section_id, 'Social Media', '', $this->menu_slug);
        $this_setting_inputs = array(
            array('title' => 'Facebook', 'name' => 'facebook'),
            array('title' => 'Twitter', 'name' => 'twitter'),
            array('title' => 'Pinterest', 'name' => 'pinterest'),
            array('title' => 'Instagram', 'name' => 'instagram'),
            array('title' => 'Snapchat', 'name' => 'snapchat'),
            array('title' => 'YouTube', 'name' => 'youtube'),
            array('title' => 'LinkedIn', 'name' => 'linkedin'),
        );
        foreach( $this_setting_inputs as $setting_input ) {
            add_settings_field(
                $setting_input['name'],
                $setting_input['title'],
                array($this, 'social_media_callback'),
                $this->menu_slug,
                $this_section_id,
                array(
                    'group' => $this_section_id,
                    'args' => $setting_input
                )
            );
        }
        // END Social Media
    }
    //// END Add the settings

    // BEG Social Media Callback
    public function social_media_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'url',
                'label' => 'URL',
                'css-label' => 'asdc-width-50',
            ),
            array(
                'type' => 'input',
                'input-id' => 'position',
                'label' => 'Position',
                'css-input' => 'small-text',
                'css-label' => 'asdc-width-50',
            ),
        );
        $settings = array(
            'class' => self::$class_name,
        );
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
    }
    // END Social Media Callback

    public function sanitize ( $input ) {
        return $input;
    }
}

if( is_admin() ) {
    $asdc_settings_social_page = new asdcSettingsPageSocial();
}
//// END SETTINGS
?>