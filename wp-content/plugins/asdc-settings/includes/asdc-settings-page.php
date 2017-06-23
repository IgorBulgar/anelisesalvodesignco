<?php
/*
 * ASDC Settings - Settings Page
 * File Version 14.0.0
 * Plugin Version 14.1.0
 */

//// BEG SETTINGS
class asdcSettingsPage extends asdcSettingsDefaultCallbacks {
    static $options;
    static $option_name = 'asdc_settings_option';
    static $class_name = 'asdcSettingsPage';
    private $option_group = 'asdc_settings_group';
    private $menu_slug = 'asdc-admin-settings';

    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page')); // Add the Settings Menu Item
        add_action('admin_init', array($this, 'register_settings')); // Add the settings
    }

    public function add_settings_page() {
        add_menu_page(
            'ASDC Settings',
            'ASDC Settings',
            'manage_options',
            $this->menu_slug,
            array($this, 'asdc_admin_page_output'),
            'dashicons-palmtree',
            '3.1'
        );
    }

    // BEG Admin Page Output
    public function asdc_admin_page_output() {
        self::$options = get_option( self::$option_name );
        //print_r( self::$options );
        //print_r( get_option( 'miller-test' ) );
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
                $show_save_button = 1;
                if ($show_save_button == 1) {
                    ?>
                    <div id="floating-save">
                        <?php
                        submit_button();
                        ?>
                    </div>
                    <?php
                }
                ?>
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
            array($this, 'sanitize') // Sanitize
        );

        $this_section_id = 'header_section';
        add_settings_section($this_section_id, 'Header', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Logo',
                'name' => 'logo',
                'callback' => 'asc_image_selector_callback',
            ),
            array(
                'title' => 'Sticky Logo',
                'name' => 'sticky-logo',
                'callback' => 'asc_image_selector_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }

        $this_section_id = 'contact_section';
        add_settings_section($this_section_id, 'Contact', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Mail',
                'name' => 'mail',
                'callback' => 'asc_input_callback',
            ),
            array(
                'title' => 'Phone',
                'name' => 'phone',
                'callback' => 'asc_input_callback',
            ),
            array(
                'title' => 'Phone URL Format',
                'name' => 'phone-url',
                'callback' => 'asc_input_callback',
            ),
            array(
                'title' => 'Connect URL',
                'name' => 'connect-url',
                'callback' => 'asc_input_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }

        $this_section_id = 'footer_section';
        add_settings_section($this_section_id, 'Footer', '', $this->menu_slug);
        $t_setting_inputs = array(
            array(
                'title' => 'Copyright',
                'name' => 'copyright',
                'callback' => 'copyright_callback',
            ),
        );
        foreach($t_setting_inputs as $s_input) {
            add_settings_field($s_input['name'], $s_input['title'], array($this, $s_input['callback']), $this->menu_slug, $this_section_id,
                array('group' => $this_section_id, 'args' => $s_input, 'class-name' => self::$class_name)
            );
        }
    }
    //// END Add the settings

    // BEG Copyright Callback - 14.03.2017
    public function copyright_callback($args) {
        $inputs = array(
            array(
                'type' => 'editor',
                'input-id' => 'text',
                'editor-id' => 'copyright-editor',
                'media' => false,
            ),
        );
        $settings = array(
            'class' => self::$class_name,
        );
        ?>
        <?php
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END Copyright Callback

    // BEG Top Link Callback
    public function top_link_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'label',
                'label' => 'Label',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'input',
                'input-id' => 'url',
                'label' => 'URL',
                'css-label' => 'asdc-width-80',
            ),
        );
        $settings = array(
            'class' => self::$class_name,
        );
        ?>
        <?php
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
    }
    // END Top Link Callback

    // BEG Home Subscribe Callback
    public function home_subscribe_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'title',
                'label' => 'Title',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'input',
                'input-id' => 'tag',
                'label' => 'Tagline',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'input',
                'input-id' => 'sc',
                'label' => 'Shortcode',
                'css-label' => 'asdc-width-80',
            ),
        );
        $settings = array(
            'class' => self::$class_name,
        );
        ?>
        <?php
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
    }
    // END Home Subscribe Callback

    // BEG Shop Callback
    public function shop_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'name',
                'label' => 'Name',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'input',
                'input-id' => 'url',
                'label' => 'URL',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'image-selector',
                'input-id' => 'image',
                'label' => 'Image',
                'css-label' => 'asdc-width-80',
            ),
        );
        $settings = array(
            'multiple' => 1,
            'multiple_key' => 'image',
            'multiple_text_add' => 'Add Item',
            'multiple_text_remove' => 'Remove Item',
            'class' => self::$class_name,
        );
        asdc_dash_builder::asdcdb_sortbable_area( 'open' );
        ?>
        <div class="asdc-button small green asdc-fa plus margin-bot-10" onclick="asdc_clone_row( this );"><?php echo $settings['multiple_text_add']; ?></div>
        <?php
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
        asdc_dash_builder::asdcdb_sortbable_area( 'close' );
    }
    // END Shop Callback

    // BEG About Slider Callback
    public function about_slider_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'header',
                'label' => 'Heading',
                'css-label' => 'asdc-width-80',
            ),
            array(
                'type' => 'editor',
                'input-id' => 'text',
                'label' => 'Text',
                'css-label' => 'asdc-width-80',
                'editor-id' => 'about-slider-editor',
            ),
        );
        $settings = array(
            'multiple' => 1,
            'multiple_key' => 'text',
            'multiple_text_add' => 'Add Slide',
            'multiple_text_remove' => 'Remove Slide',
            'class' => self::$class_name,
        );
        asdc_dash_builder::asdcdb_sortbable_area( 'open' );
        ?>
        <div class="asdc-button small green asdc-fa plus margin-bot-10" onclick="asdc_clone_row( this );"><?php echo $settings['multiple_text_add']; ?></div>
        <?php
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
        asdc_dash_builder::asdcdb_sortbable_area( 'close' );
    }
    // END About Slider Callback
    
    































    public function sanitize ( $input ) {
        return $input;
    }
}

if( is_admin() ) {
    $asdc_settings_page = new asdcSettingsPage();
}
//// END SETTINGS
?>