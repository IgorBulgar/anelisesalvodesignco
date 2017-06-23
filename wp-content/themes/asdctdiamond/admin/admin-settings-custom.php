<?php
/*
* Admin Settings - Custom
* File Version 15.0.0
* Theme Version 15.0.0
*/

// Let's add the main settings
function get_asdc_custom_sections($id) {
    $sections = array('main' => array(
        array('slug' => 'header', 'title' => 'Header', 'settings' => array(
            array(
                'name' => 'logos',
                'title' => 'logos',
                'clone' => false,
                'inputs' => array(
                    array(
                        'type' => 'photo',
                        'id' => 'main',
                        'label' => 'Main',
                    ),
                )
            ),
            array(
                'name' => 'editor',
                'title' => 'Editor',
                'clone' => false,
                'inputs' => array(
                    array(
                        'type' => 'editor',
                        'id' => 'test',
                        'label' => 'Test',
                        'description' => 'Goes here',
                        'media' => true,
                    ),
                )
            ),
        )),
    ));
    return $sections[$id];
}

// Tell me if you want other settings
function get_asdc_custom_settings_pages() {
    // Declare custom settings pages
    $pages = array(
        array('id' => 'custom_page', 'title' => 'Custom Page', 'sections' => array(
            array('slug' => 'test-section', 'title' => 'Test Section', 'settings' => array(
                array('name' => 'test_setting',
                    'title' => 'Test Setting',
                    'clone' => false,
                    'inputs' => array(
                        array(
                            'type' => 'input',
                        )
                    )
                )
            ))
        )),
    );
    return $pages;
}
?>