<?php
/*
 * ASDC Settings - Default Callbacks
 * File Version 14.0.0
 * Plugin Version 14.1.0
 */

class asdcSettingsDefaultCallbacks {

    // BEG ASC Switch Callback - 28.03.17
    public function asc_switch_callback($args) {
        $inputs = array(
            array(
                'type' => 'switch',
                'input-id' => 'switch',
                'default' => $args['args']['default'],
                'label' => $args['args']['label'],
                'description' => $args['args']['description'],
                'on' => $args['args']['on'],
                'off' => $args['args']['off'],
            ),
        );
        $settings = array( 'class' => $args['class-name'] );
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END ASC Switch Callback
    
    // BEG ASC Image Selector Callback - 28.03.17
    public function asc_image_selector_callback($args) {
        $inputs = array(
            array(
                'type' => 'image-selector',
                'input-id' => 'image',
                'label' => $args['args']['label'],
                'css-label' => $args['args']['css-label'],
            ),
        );
        $settings = array( 'class' => $args['class-name'] );
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END ASC Image Selector Callback

    // BEG ASC Input Callback - 28.03.17
    public function asc_input_callback($args) {
        $inputs = array(
            array(
                'type' => 'input',
                'input-id' => 'text',
                'label' => $args['args']['label'],
                'css-input' => $args['args']['css-input'],
                'description' => $args['args']['description'],
            ),
        );
        $settings = array('class' => $args['class-name']);
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END ASC Input Callback





    // BEG ASC Selector Callback
    public function asc_selector_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'selector',
                'input-id' => 'selector',
                'label' => $args['label'],
                'selector-options' => $args['selector-options'],
            ),
        );
        $settings = array( 'class' => $args['class-name'] );
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END ASC Selector Callback



    // BEG ASC Textarea Callback
    public function asc_textarea_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'textarea',
                'input-id' => 'text',
                'label' => $args['label'],
                'css-input' => $args['css-input'],
            ),
        );
        $settings = array( 'class' => $args['class-name'] );
        asdc_dash_builder::asdcdb_process_inputs($inputs, $args, $settings);
    }
    // END ASC Textarea Callback

    // BEG ASC Category Select Callback
    public function asc_category_select_callback( $args ) {
        $inputs = array(
            array(
                'type' => 'category-selector',
                'input-id' => 'category',
                'label' => 'Category',
                'taxonomy' => 'category',
                'hide_empty' => false,
            ),
        );
        $settings = array( 'class' => $args['class-name'] );
        asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
    }
    // END ASC Category Select Callback
}
if( is_admin() ) {
    $asdc_settings_default_callbacks = new asdcSettingsDefaultCallbacks();
}