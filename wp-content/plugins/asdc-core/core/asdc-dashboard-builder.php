<?php
/*
 * ASDC Dashboard Builder
 * File Version 1.0.4
 * Plugin Version 1.0.2
 * Here we create the theme dashboard
 */

class asdcDashboardBuilder {

    public function __construct() {

    }

    // I will process the setting
    public static function process_setting($args) {
        /*
         * * options
         * * option
         * * slug
         * * setting
         * name
         * title
         * clone
         * sort
         * css_label
         * css_input
         * inputs
         */

        $cloning = isset($args['setting']['clone']) ? $args['setting']['clone'] : false;
        $sorting = isset($args['setting']['sort']) ? $args['setting']['sort'] : false;

        // Checking if it's a cloning setting
        $times = '';
        if($cloning == true) {
            if(isset($args['options']) && $args['options'] != '') {
                foreach($args['options'] as $arr) {
                    $times = count($arr);
                    break;
                }
            } else {$times = 1;}
            ?>
            <div class="asdc-builder-cloning">
                <div class="asdc-button green asdc-fa plus" onclick="asdc_add_clone(this);">Add more</div>
            <?php
        } else if($sorting == true) {echo '<div class="asdc-builder-sorting">';}

        // Gotta run it at least once
        if($cloning == false) {$times = 1;}

        // Checking for clones
        for($i = 0; $i < $times; $i++) {
            if($cloning == true) {
                ?>
                <div class="asdc-builder-clone">
                    <div class="asdc-button red asdc-fa minus" onclick="asdc_remove_clone(this);">Remove</div>
                <?php
            }

            $processed_inputs = $args['setting']['inputs'];

            // Let's reorder the inputs
            if ($sorting == true && $args['options'] != '') {

                // Setting the key
                $raw = array();
                foreach($processed_inputs as $input) {
                    $raw[$input['id']] = $input;
                }

                // Checking the existing inputs
                $existing = array();
                foreach($args['options'] as $key => $value) {
                    $existing[$key] = $raw[$key];
                    unset($raw[$key]);
                }
                $processed_inputs = array_merge($existing, $raw);
                unset($raw, $existing);
            }

            // A setting might have multiple inputs
            foreach($processed_inputs as $input) {
                /*
                 * type
                 * id
                 * label
                 * description
                 * default
                 * css_label
                 * css_input
                 * class
                 * media
                 * rows
                 * selector_options
                 * on
                 * off
                 */

                // Making sure the input has an id
                $input['id'] = isset($input['id']) ? $input['id'] : $input['type'];

                // Preparing the input options
                $options = array(
                    'type' => $input['type'], // Type of the input
                );

                // Adding options for the editor
                if($input['type'] == 'editor') {
                    if (isset($input['id'])) {
                        $options['id'] = $input['id'];
                    } else {
                        asdc_e(4, 'Editor does not have an ID!');
                        return;
                    }
                    $options['media'] = isset($input['media']) ? $input['media'] : false; // Show media buttons
                    $options['rows'] = isset($input['rows']) ? $input['rows'] : 10; // Number of rows
                }

                //// Setting the SQL name
                // Checking if it's a Settings page input
                if(isset($args['option']) && isset($args['slug'])) {
                    $options['name'] = $args['option'].'['.$args['slug'].']['.$args['setting']['name'].']['.$input['id'].']';
                } else {
                    $options['name'] = $args['setting']['name'].'['.$input['id'].']';
                }

                // Check for cloning
                if($cloning == true) {
                    $options['name'] .= '[]';
                }

                // Getting the value
                if($cloning == true) {
                    $get_value = isset($args['options'][$input['id']][$i]) ? $args['options'][$input['id']][$i] : '';
                } else {
                    $get_value = isset($args['options'][$input['id']]) ? $args['options'][$input['id']] : '';
                }

                // Checking for a default value
                $options['value'] = $get_value != '' ? $get_value : (isset($input['default']) && $input['default'] != '' ? $input['default'] : '');

                // We might have higher options that apply for all inputs
                $high_options = array(
                    'css_label',
                    'css_input'
                );
                foreach($high_options as $high_option) {
                    if(isset($args['setting'][$high_option]) && $args['setting'][$high_option] != '') {$options[$high_option] = $args['setting'][$high_option];}
                }

                // Let's check all the other options
                $more_options = array(
                    'label',
                    'description',
                    'css_label',
                    'css_input',
                    'class',
                    'selector_options',
                    'on',
                    'off'
                );
                foreach($more_options as $more_option) {
                    if(isset($input[$more_option]) && $input[$more_option] != '') {$options[$more_option] = $input[$more_option];}
                }

                if($cloning == false && $sorting == true) {echo '<div class="asdc-builder-sort">';} // Adding the beginning of sort

                self::show_setting($options); // Show time!

                if($cloning == false && $sorting == true) {echo '</div>';} // Adding the ending of sort
            }
            if($cloning == true) {echo '</div>';}
            else if($sorting == true) {echo '</div>';}
        }

        if($cloning == true) {echo '</div>';}
        else if($sorting == true) {echo '</div>';}
    }

    // We have many settings, let's see which one I should show
    public static function show_setting($args) {
        /*
         * type
         */

        switch ($args['type']) {
            case 'input':
                self::input($args);
                break;
            case 'photo':
                self::photo($args);
                break;
            case 'editor':
                self::editor($args);
                break;
            case 'selector':
                self::selector($args);
                break;
            case 'checkbox':
                self::checkbox($args);
                break;
            case 'switch':
                self::cool_switch($args);
                break;
            default:
                asdc_e(1, 'Input type unknown.');
                break;
        }
    }

    // The basic input
    public static function input($args) {
        /*
         * name
         * value
         * label
         * description
         * css_label
         * css_input
         * class
         */

        $setting_class = 'asdc-setting-input';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';
        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <?php
            // Show label
            if(isset($args['label'])) {
                $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
            }

            // Show input
            $css_input = isset($args['css_input']) ? $args['css_input'] : '';
            echo '<input class="regular-text '.$css_input.'" type="text" value="'.$args['value'].'" name="'.$args['name'].'" />';

            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }

    // Photo uploader
    public static function photo($args) {
        /*
         * name
         * value
         * label
         * description
         * css_label
         * class
         */

        $setting_class = 'asdc-setting-photo';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';
        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <input class="hidden-input" value="<?php echo $args['value']; ?>" type="hidden" name="<?php echo $args['name']; ?>">
            <?php
            // Show label
            if(isset($args['label'])) {
                $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
            }

            // Show image uploader
            ?>
            <div class="image-preview">
                <?php
                $image_error = 0;
                if($args['value'] != '') {
                    $image = wp_get_attachment_image($args['value'], 'asdc-thumb');
                    if($image != '') {
                        echo $image;
                    } else {
                        $image_error = 1;
                    }
                } else {
                    $image_error = 1;
                }
                if ($image_error == 1) {
                    ?>
                    <img width="64" height="64" src="<?php echo asdcCore::$paths['APP_DIR'].'images/asdc-no-image.png'; ?>" />
                    <?php
                }
                ?>
            </div>
            <div class="setting-tools">
                <div class="asdc-button small pink" onclick="asdc_add_image(this);">Change</div>
                <div class="asdc-button small pink" onclick="asdc_remove_image(this);">Remove</div>
            </div>
            <?php

            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }

    // The HTML Editor
    public static function editor($args) {
        /*
         * name
         * value
         * label
         * description
         * css_label
         * class
         * media
         * rows
         * id: REQUIRED
         */

        $setting_class = 'asdc-setting-editor';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';

        // todo need to make it auto increment for multiple editors / clones
        $editor_id = $args['id'];

        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <?php
            // Show label
            if(isset($args['label'])) {
                $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
            }

            // Prepare editor settings
            $editor_args = array(
                'wpautop' => false,
                'media_buttons' => $args['media'],
                'textarea_name' => $args['name'],
                'textarea_rows' => $args['rows'],
            );

            // Output the editor
            wp_editor(html_entity_decode($args['value']), $editor_id, $editor_args);

            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }

    // A basic selector
    public static function selector($args) {
        /*
         * name
         * value
         * label
         * description
         * css_label
         * class
         * selector_options
         */

        $setting_class = 'asdc-setting-selector';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';
        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <?php
            // Show label
            if(isset($args['label'])) {
                $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
            }

            // Show selector
            ?>
            <select name="<?php echo $args['name']; ?>">
                <?php
                echo '<option value="0"></option>';
                foreach($args['selector_options'] as $key => $option) {
                    $selected = ($args['value'] == $key ) ? 'selected ' : '';
                    echo '<option '.$selected.'value="'.$key.'">'.$option.'</option>';
                }
                ?>
            </select>
            <?php

            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }

    // A checkbox
    public static function checkbox($args) {
        /*
         * name
         * value
         * label
         * description
         * css_label
         * class
         */

        $setting_class = 'asdc-setting-checkbox';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';

        // Setting a default value
        if ($args['value'] == '') {$args['value'] = 0;}

        // Checking if we should add the checked attribute
        if ($args['value'] == 1) {$checkbox_attr = ' checked';}
        else {$checkbox_attr = '';}
        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <div class="asdc-checkbox-wrapper" onclick="asdc_click_checkbox(this);">
                <input type="hidden" name="<?php echo $args['name']; ?>" value="<?php echo $args['value']; ?>" />
                <input type="checkbox"<?php echo $checkbox_attr; ?> />
                <?php
                // Show label
                if(isset($args['label'])) {
                    $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                    echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
                }
                ?>
            </div>
            <?php
            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }

    // A cool switch
    public static function cool_switch($args) {
        /*
         * name
         * value
         * default
         * label
         * css_label
         * description
         * on
         * off
         * class
         */

        $setting_class = 'asdc-setting-switch';
        $setting_class .= isset($args['class']) ? ' '.$args['class'] : '';

        if (isset($args['default']) && $args['default'] == true) {
            if ($args['value'] == '') {
                $args['value'] = '1';
            }
        }

        if ($args['value'] == '1') {
            $setting_class .= ' active';
        }

        $switch_on = ($args['on'] != '') ? $args['on'] : 'ON';
        $switch_off = ($args['off'] != '') ? $args['off'] : 'OFF';

        ?>
        <div class="asdc-builder-setting <?php echo $setting_class; ?>">
            <?php
            // Show label
            if(isset($args['label'])) {
                $css_label = isset($args['css_label']) ? $args['css_label'] : '';
                echo '<label class="'.$css_label.'">'.$args['label'].'</label>';
            }
            ?>
            <div onclick="asdc_switch_trigger(this);" class="switch-wrap">
                <div class="switch-text on"><?php echo $switch_on; ?></div>
                <div class="switch-button"></div>
                <div class="switch-text off"><?php echo $switch_off; ?></div>
            </div>
            <input type="hidden" name="<?php echo $args['name']; ?>" value="<?php echo $args['value']; ?>" />
            <?php
            // Show description
            if(isset($args['description'])) { echo '<p class="description">'.$args['description'].'</p>'; }
            ?>
        </div>
        <?php
    }
}