<?php
/*
 * ASDC Settings - Templates
 * File Version 3.0.0.1
 * Plugin Version 3.0.3
 */

// BEG Default Multiple Callback
function default_multiple_callback( $args ) {
    $inputs = array(
        array(
            'type' => 'input',
            'input-id' => 'url',
            'label' => 'URL',
            'css-label' => 'asdc-width-50',
            'ccs-input' => 'asdc-width-50',
            'description' => 'Description here',
        ),
        array(
            'type' => 'image-selector',
            'input-id' => 'image',
            'label' => 'Image',
            'css-label' => 'asdc-width-50',
        ),
    );
    $settings = array(
        'multiple' => 1,
        'multiple_key' => 'image',
        'multiple_text_add' => 'Add Multiple',
        'multiple_text_remove' => 'Remove Multiple',
//        'class' => self::$class_name,
    );
    asdc_dash_builder::asdcdb_sortbable_area( 'open' );
    ?>
    <div class="asdc-button small green asdc-fa plus margin-bot-10" onclick="asdc_clone_row( this );"><?php echo $settings['multiple_text_add']; ?></div>
    <?php
    asdc_dash_builder::asdcdb_process_inputs( $inputs, $args, $settings );
    asdc_dash_builder::asdcdb_sortbable_area( 'close' );
}
// END Default Sponsors Callback
?>