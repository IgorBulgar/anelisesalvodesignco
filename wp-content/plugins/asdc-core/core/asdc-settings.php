<?php
/*
 * ASDC Settings
 * File Version 1.0.1
 * Plugin Version 1.0.1
 * Creating the settings pages
 */

class asdcSettings extends asdcDashboardBuilder {
    private $settings_slug;
    private $page;
    private $page_id;
    private $page_group;
    private $page_option;
    private $options;

    public function __construct($page) {
        $this->settings_slug = 'asdc_settings'; // Main slug
        $this->page = $page; // Page
        $this->page_id = $this->settings_slug.'_'.$page['id']; // Page ID
        $this->page_group = $this->page_id.'_group'; // Group
        $this->page_option = $this->page_id.'_option'; // Option
        $this->options = get_option($this->page_option); // Options

        //print_r($this->options);

        add_action('admin_menu', array($this, 'add_settings_pages')); // Add the settings pages
        add_action('admin_init', array($this, 'register_settings')); // Add the settings
    }

    // Add the settings pages
    public function add_settings_pages() {
        if ($this->page['id'] == 'main') {
            add_menu_page('ASDC Settings', 'ASDC Settings', 'manage_options', $this->settings_slug, array($this, 'asdc_settings_page'), 'dashicons-palmtree', '3.1'); // Main page
        } else {
            add_submenu_page($this->settings_slug, 'ASDC Settings - '.$this->page['title'], $this->page['title'], 'manage_options', $this->page_id, array($this, 'asdc_settings_page'));
        }
    }

    // Page output
    public function asdc_settings_page() {
        $settings_page_class = 'wrap asdc-settings-page-'.$this->page['id']; // Page class
        ?>
        <div id="asdc-settings-page" class="<?php echo $settings_page_class; ?>">
            <h1 class="main-title"><?php echo get_admin_page_title(); ?></h1>
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
                submit_button();
                settings_fields($this->page_group);
                do_settings_sections($this->page_id);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Register all sections
    public function register_settings() {
        register_setting(
            $this->page_group,
            $this->page_option,
            array($this, 'sanitize')
        );

        // Add sections
        if(isset($this->page['custom_sections'])) {
            $all_sections = array_merge($this->page['custom_sections'], $this->page['sections']);
        } else {
            $all_sections = $this->page['sections'];
        }
        foreach($all_sections as $section) {
            add_settings_section($section['slug'], $section['title'], '', $this->page_id);
            
            // Add settings
            foreach($section['settings'] as $setting) {
                $options_value = isset($this->options[$section['slug']][$setting['name']]) ? $this->options[$section['slug']][$setting['name']] : '';
                add_settings_field($setting['name'], $setting['title'], array($this, 'process_setting'), $this->page_id, $section['slug'], array(
                    'options' => $options_value, // Sending the setting values
                    'option' => $this->page_option,
                    'slug' => $section['slug'],
                    'setting' => $setting
                ));
            }
        }
    }

    public function sanitize ($input) {
        return $input;
    }
}