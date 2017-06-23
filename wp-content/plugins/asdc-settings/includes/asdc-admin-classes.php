<?php
/*
 * ASDC Settings - Admin Classes
 * File Version 14.0.0
 * Plugin Version 14.1.0
 */

//// BEG Dashboard Builder - BRU
class asdc_dash_builder {
    
    public function __construct() {

    }

    // BEG Process Inputs - v1
    public static function asdcdb_process_inputs( $inputs, $args, $settings ) {
        $this_setting_group = $args[ 'group' ];
        $this_setting_args = $args[ 'args' ];
        $this_setting_name = $this_setting_args[ 'name' ];
        $this_class_options_get = get_class_vars( $settings[ 'class' ] );
        $this_class_options = $this_class_options_get[ 'options' ];
        $this_class_option_name_get = get_class_vars( $settings[ 'class' ] );
        $this_class_option_name = $this_class_option_name_get[ 'option_name' ];

        global $editor_count;
        $editor_count = 0;

        if ( $settings[ 'multiple' ] == 1 ) {
            $key_id = $settings[ 'multiple_key' ];
            $nr_items = count( $this_class_options[ $this_setting_group ][ $this_setting_name ][ $key_id ] );
            if ( $nr_items == 0 ) {$nr_items = 1;}

            for( $i = 0; $i < $nr_items; $i++ ) {
                echo '<div class="asdc-row-to-clone">';
                foreach ( $inputs as $input ) {
                    $editor_count++;
                    $this_input_id = $input[ 'input-id' ];
                    $this_input_get_value = $this_class_options[ $this_setting_group ][ $this_setting_name ][ $this_input_id ][$i];
                    $this_input_set_value = isset( $this_input_get_value ) ? esc_attr( $this_input_get_value ) : '';
                    $this_input_name = $this_class_option_name . '[' . $this_setting_group . ']' . '[' . $this_setting_name . ']' . '[' . $this_input_id . '][]';
                    $this_input_args = array(
                        'sql-name' => $this_input_name,
                        'value' => $this_input_set_value,
                        'css-label' => $this_setting_args['css-label'],
                        'editor-count' => $editor_count,
                    );
                    $this_input_args = array_merge( $this_input_args, $input );
                    self::asdcdb_verify_output( $input[ 'type' ], $this_input_args );
                }
                echo '<br>';
                echo '<div class="asdc-button small red asdc-fa minus" onclick="asdc_remove_row( this );">' . $settings[ 'multiple_text_remove' ] . '</div>';
                echo '</div>';
            }
        }
        else {
            foreach ( $inputs as $input ) {
                $this_input_id = $input[ 'input-id' ];
                $this_input_get_value = $this_class_options[ $this_setting_group ][ $this_setting_name ][ $this_input_id ];
                $this_input_set_value = isset( $this_input_get_value ) ? esc_attr( $this_input_get_value ) : '';
                $this_input_name = $this_class_option_name . '[' . $this_setting_group . ']' . '[' . $this_setting_name . ']' . '[' . $this_input_id . ']';
                $this_input_args = array(
                    'sql-name' => $this_input_name,
                    'value' => $this_input_set_value,
                    'css-label' => $this_setting_args['css-label'],
                );
                $this_input_args = array_merge( $this_input_args, $input );
                self::asdcdb_verify_output( $input[ 'type' ], $this_input_args );
            }
        }
    }
    // END Process Inputs - v1

    // BEG Sortbable Area - v1
    public static function asdcdb_sortbable_area( $tag ) {
        if ( $tag == 'open' ) {
            echo '<div class="asdc-sortable">';
        }
        else if ( $tag == 'close' ) {
            echo '</div>';
        }
    }
    // END Sortbable Area - v1

    // BEG Verify Outputs - BRU
    public static function asdcdb_verify_output( $type, $args ) {
        switch ( $type ) {
            case 'colorpicker':
                self::asdcdb_colorpicker( $args );
                break;
            case 'checkbox':
                self::asdcdb_checkbox( $args );
                break;
            case 'category-selector':
                self::asdcdb_category_selector( $args );
                break;
            case 'tag-selector':
                self::asdcdb_tag_selector( $args );
                break;
            case 'page-selector':
                self::asdcdb_page_selector( $args );
                break;
            case 'input':
                self::asdcdb_input( $args );
                break;
            case 'image-selector':
                self::asdcdb_image_selector( $args );
                break;
            case 'textarea':
                self::asdcdb_text_area( $args );
                break;
            case 'editor':
                self::asdcdb_editor( $args );
                break;
            case 'selector':
                self::asdcdb_selector( $args );
                break;
            case 'switch':
                self::asdcdb_switch( $args );
                break;
            default:
                echo '<b>ERROR: Type not known.</b>';
        }
    }
    // END Verify Outputs - BRU

    // BEG Switch - 28.03.17
    public static function asdcdb_switch($args) {
        /*
         * sql-name
         * value
         * default
         * label
         * description
         * on
         * off
         */

        $t_s_sql_name = $args['sql-name'];
        $t_s_value = $args['value'];
        if ($args['default'] == true) {
            if ($t_s_value == '') {
                $t_s_value = '1';
            }
        }
        $switch_class = ($t_s_value == '1') ? ' active' : '';
        $switch_on = ($args['on'] != '') ? $args['on'] : 'ON';
        $switch_off = ($args['off'] != '') ? $args['off'] : 'OFF';
        ?>
        <div class="admin-row asdc-builder-switch<?php echo $switch_class; ?>">
            <?php
            // Show description
            if ($args['description'] != '') {
                echo '<p class="description"><em>' . $args['description'] . '</em></p>';
            }

            // Show label
            if ($args['label'] != '') {
                $label_css = isset($args['css-label']) ? $args['css-label'] : '';
                echo '<label class="'.$label_css.'">'.$args['label'].'</label>';
            }
            ?>
            <input type="hidden" name="<?php echo $t_s_sql_name; ?>" value="<?php echo $t_s_value; ?>" />
            <div onclick="asdc_switch_trigger(this);" class="switch-wrap">
                <div class="switch-text on"><?php echo $switch_on; ?></div>
                <div class="switch-button"></div>
                <div class="switch-text off"><?php echo $switch_off; ?></div>
            </div>
        </div>
        <?php
    }
    // END Switch



    // BEG Selector - v1.5
    public static function asdcdb_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * selector-options
         * description
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        $this_selector_options = $args[ 'selector-options' ];
        ?>
        <div class="admin-row asdc-builder-category-selector">
            <?php
            // Show description
            if ( $args[ 'description' ] != '' ) {
                echo '<p class="description"><em>' . $args[ 'description' ] . '</em></p>';
            }

            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <select name="<?php echo $this_setting_sql_name; ?>">
                <?php
                if ( $this_setting_value == 0 ) {
                    echo '<option selected="selected" value="0"></option>';
                }
                else {
                    echo '<option value="0"></option>';
                }
                foreach( $this_selector_options as $key => $option ) {
                    $selected = ( $this_setting_value == $key ) ? 'selected ' : '';
                    echo '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
                }
                ?>
            </select>
        </div>
        <?php
    }
    // END Selector - v1.5

    // BEG Colorpicker - v1.4
    public static function asdcdb_colorpicker( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * css-input
         * default-color
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        $input_css = isset( $args[ 'css-input' ] ) ? $args[ 'css-input' ] : '';
        if ( $args[ 'default-color' ] == '' ) {
            $args[ 'default-color' ] = '#ffffff';
        }
        ?>
        <div class="admin-row asdc-builder-colorpicker">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <input class="asdc-db-color-picker <?php echo $input_css; ?>" type="text" name="<?php echo $this_setting_sql_name; ?>" value="<?php echo $this_setting_value; ?>" data-default-color="<?php echo $args[ 'default-color' ]; ?>" />
        </div>
    <?php
    }
    // END Colorpicker - v1.4

    // BEG Checkbox - v1.3
    public static function asdcdb_checkbox( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * css-input
         * description
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        if ( $this_setting_value == '' ) {
            $this_setting_value = 0;
        }
        $input_css = isset( $args[ 'css-input' ] ) ? $args[ 'css-input' ] : '';
        if ( $this_setting_value == 1 ) {$checkbox_attr = ' checked';}
        else {$checkbox_attr = '';}
        ?>
        <div class="admin-row asdc-builder-checkbox">
            <div class="asdc-checkbox-wrapper" onclick="asdc_checkbox_value( this );">
                <input type="hidden" name="<?php echo $this_setting_sql_name; ?>" value="<?php echo $this_setting_value; ?>" />
                <?php
                // Show description
                if ( $args[ 'description' ] != '' ) {
                    echo '<p class="description"><em>' . $args[ 'description' ] . '</em></p>';
                }
                ?>
                <input class="<?php echo $input_css; ?>" type="checkbox"<?php echo $checkbox_attr; ?> />
                <?php
                // Show label
                if ( $args[ 'label' ] != '' ) {
                    $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                    echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
                }
                ?>
            </div>
        </div>
    <?php
    }
    // END Checkbox - v1.3

    // BEG Category Selector - v1.2
    public static function asdcdb_category_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * taxonomy
         * hide_empty
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-category-selector">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <?php
            $get_categories_args = array(
                'taxonomy' => $args[ 'taxonomy' ],
                'hide_empty' => $args[ 'hide_empty' ],
            );
            $categories = get_categories( $get_categories_args );
            ?>
            <select name="<?php echo $this_setting_sql_name; ?>">
                <?php
                if ( $this_setting_value == 0 ) {
                    echo '<option selected="selected" value="0"></option>';
                }
                else {
                    echo '<option value="0"></option>';
                }
                foreach( $categories as $category ) {
                    $selected = ( $this_setting_value == $category->cat_ID ) ? 'selected ' : '';
                    echo '<option ' . $selected . 'value="' . $category->cat_ID . '">' . $category->cat_name . '</option>';
                }
                ?>
            </select>
        </div>
    <?php
    }
    // END Category Selector - v1.2

    // BEG Tag Selector - v1.3
    public static function asdcdb_tag_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * taxonomy
         * hide_empty
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-tag-selector">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <?php
            $get_tags_args = array(
                'taxonomy' => $args[ 'taxonomy' ],
                'hide_empty' => $args[ 'hide_empty' ],
            );
            $tags = get_tags( $get_tags_args );
            ?>
            <select name="<?php echo $this_setting_sql_name; ?>">
                <?php
                if ( $this_setting_value == 0 ) {
                    echo '<option selected="selected" value="0"></option>';
                }
                else {
                    echo '<option value="0"></option>';
                }
                foreach( $tags as $tag ) {
                    print_r( $tag );
                    if ( $this_setting_value == $tag->term_id ) {$selected = 'selected ';}
                    else {$selected = '';}
                    echo '<option ' . $selected . 'value="' . $tag->term_id . '">' . $tag->name . '</option>';
                }
                ?>
            </select>
        </div>
        <?php
    }
    // END Tag Selector - v1.3



    // BEG Page Selector - v2
    public static function asdcdb_page_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-page-selector">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <?php
            $get_pages_args = array(
                'post_type' => 'page',
                'post_status' => 'publish'
            );
            $pages = get_pages( $get_pages_args );
            ?>
            <select name="<?php echo $this_setting_sql_name; ?>">
                <?php
                foreach( $pages as $page ) {
                    if ( $this_setting_value == $page->ID ) {$selected = 'selected ';}
                    else {$selected = '';}
                    echo '<option ' . $selected . 'value="' . $page->ID . '">' . $page->post_title . '</option>';
                }
                ?>
            </select>
        </div>
    <?php
    }
    // END Page Selector - v2



    // BEG Textarea - v2
    public static function asdcdb_text_area( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-textarea">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            $input_css = isset( $args[ 'css-input' ] ) ? $args[ 'css-input' ] : '';
            ?>
            <textarea rows="5" cols="50" name="<?php echo $this_setting_sql_name; ?>"><?php echo $this_setting_value; ?></textarea>
        </div>
    <?php
    }
    // END Textarea - v2



    // BEG Input - BRU
    public static function asdcdb_input( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * css-input
         * description
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-input">
            <?php
            // Show description
            if ( $args[ 'description' ] != '' ) {
                echo '<p class="description"><em>' . $args[ 'description' ] . '</em></p>';
            }

            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            $input_css = isset( $args[ 'css-input' ] ) ? $args[ 'css-input' ] : '';
            ?>
            <input class="regular-text <?php echo $input_css; ?>" type="text" value="<?php echo $this_setting_value; ?>" name="<?php echo $this_setting_sql_name; ?>" />
        </div>
    <?php
    }
    // END Input - BRU



    // BEG Image Selector - v1.2
    public static function asdcdb_image_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-image-selector">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <input class="hidden-input" value="<?php echo $this_setting_value; ?>" type="hidden" name="<?php echo $this_setting_sql_name; ?>" />
            <div class="image-preview">
                <?php
                $image_error = 0;
                if ( $this_setting_value ) {
                    $image = wp_get_attachment_image($this_setting_value, 'thumbnail');
                    if ( $image != '' ) {echo $image;}
                    else {$image_error = 1;}
                }
                else {$image_error = 1;}
                if ( $image_error == 1 ) {
                    ?>
                    <img width="64" height="64" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/asdc-no-image.png'; ?>" />
                    <?php
                }
                ?>
            </div>
            <div class="buttons-holder">
                <div class="button button-small select-image-button">Change</div>
                <div class="button button-small" onclick="asdc_remove_selected_image( this );">Remove</div>
            </div>
        </div>
    <?php
    }
    // END Image Selector - v1



    // BEG Editor - BRU
    public static function asdcdb_editor( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * editor-id: MANDATORY
         * media: false, true
         * textarea_rows
         * editor-count GLOBAL
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-editor">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            $editor_args = array(
                'wpautop' => false,
                'media_buttons' => $args[ 'media' ],
                'textarea_name' => $this_setting_sql_name,
                'textarea_rows' => $args[ 'textarea_rows' ],
            );
            $editor_new_id = $args[ 'editor-id' ] . '-' . $args[ 'editor-count' ];
            wp_editor( html_entity_decode( $this_setting_value ), $editor_new_id, $editor_args );
            ?>
        </div>
    <?php
    }
    // END Editor - BRU
}
//// END Dashboard Builder
if( is_admin() ) {
    $asdc_dash_builder = new asdc_dash_builder();
}
?>