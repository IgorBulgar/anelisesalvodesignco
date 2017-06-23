<?php
/*
 * ASDC Settings - Settings Page Videos
 * File Version 1.1.0.0
 * Plugin Version 3.1.1
 */

//// BEG SETTINGS
class asdcSettingsPageVideos {
    static $options;
    static $option_name = 'asdc_settings_videos_option';
    private $option_group = 'asdc_settings_videos_group';
    private $menu_slug = 'asdc-admin-settings-videos';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) ); // Add the Settings Menu Item
        add_action( 'admin_init', array( $this, 'register_settings' ) ); // Add the settings
    }

    public function add_settings_page() {
        add_submenu_page(
            'asdc-admin-settings',
            'ASDC Settings - Videos',
            'Videos',
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
                //submit_button();
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

        // BEG Videos
        $this_section_id = 'videos_section';
        add_settings_section(
            $this_section_id,
            'Videos',
            '',
            $this->menu_slug
        );
        $this_setting_inputs = array(
            array(
                'title' => '',
                'name' => 'videos',
            ),
        );

        foreach( $this_setting_inputs as $setting_input ) {
            add_settings_field(
                $setting_input[ 'name' ],
                $setting_input[ 'title' ],
                array( $this, 'videos_callback' ),
                $this->menu_slug,
                $this_section_id,
                array(
                    'group' => $this_section_id,
                    'args' => $setting_input
                )
            );
        }
        // END Videos
    }
    //// END Add the settings

    // BEG Videos Callback
    public function videos_callback( $args ) {
        $inputs = array(

        );
        $settings = array( 'class' => 'asdcSettingsPageVideos' );
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
        ?>
        <h3>Theme Introduction</h3>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/z6h1VRFP6is" frameborder="0" allowfullscreen></iframe>
        <h3>WordPress - Menus</h3>
        <iframe width="420" height="315" src="https://www.youtube.com/embed/I_wyR0i7Ojc" frameborder="0" allowfullscreen></iframe>
        <?php
    }
    // END Videos Callback

    public function sanitize ( $input ) {
        return $input;
    }
}

if( is_admin() ) {
    $asdc_settings_videos_page = new asdcSettingsPageVideos();
}
//// END SETTINGS
?>