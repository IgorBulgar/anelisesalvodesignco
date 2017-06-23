<?php
/*
 * ASDC Settings - Add - Manual
 * File Version 1.0.0
 * Plugin Version 1.0.0
 */

// I'm here to help you with templates

// page
array('id' => 'main', 'title' => 'Title_here', 'sections' => array());

// section
array('slug' => 'slug_here', 'title' => 'Title_here', 'settings' => array());

// setting
array(
    'name' => 'first',
    'title' => 'First',
    'clone' => false,
    'sort' => false,
    'css_label' => '', /* small large huge */
    'css_input' => '', /* tiny small large */
    'inputs' => array()
);

// input
array(
    'type' => 'input',
    'id' => 'id_goes_here',
    'label' => 'Label_goes_here',
    'description' => 'Description_goes_here.',
    'default' => 'default_value',
    'css_label' => '', /* small large huge */
    'css_input' => '', /* tiny small large */
    'class' => '' /* */
);

// photo
array(
    'type' => 'photo',
    'id' => 'id_goes_here',
    'label' => 'Label_goes_here',
    'description' => 'Description_goes_here.',
    'css_label' => '', /* small large huge */
    'class' => '' /* */
);

// editor
array(
    'type' => 'editor',
    'id' => 'id_goes_here',
    'label' => 'Label_goes_here',
    'description' => 'Description_goes_here.',
    'css_label' => '', /* small large huge */
    'class' => '', /* */
    'media' => '', /* true, false */
    'rows' => '', /* 10 */
);