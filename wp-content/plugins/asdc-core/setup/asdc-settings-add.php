<?php
/*
 * ASDC Settings - Add
 * File Version 1.0.0
 * Plugin Version 1.0.0
 */

// Declaring the core settings pages
function get_asdc_settings_pages() {
    $pages = array(
        array('id' => 'main', 'custom_sections' => get_asdc_custom_sections('main'), 'sections' => array(
            
        )),
        array('id' => 'social', 'title' => 'Social Media', 'sections' => array(
            array('slug' => 'accounts', 'title' => 'Accounts', 'settings' => array(
                array(
                    'name' => 'url',
                    'title' => 'URL',
                    'clone' => false,
                    'sort' => true,
                    'inputs' => array(
                        array(
                            'type' => 'input',
                            'id' => 'facebook',
                            'label' => 'Facebook',
                        ),
                        array(
                            'type' => 'input',
                            'id' => 'twitter',
                            'label' => 'Twitter',
                        ),
                        array(
                            'type' => 'input',
                            'id' => 'instagram',
                            'label' => 'Instagram',
                        ),
                        array(
                            'type' => 'input',
                            'id' => 'pinterest',
                            'label' => 'Pinterest',
                        ),
                        array(
                            'type' => 'input',
                            'id' => 'youtube',
                            'label' => 'YouTube',
                        ),
                        array(
                            'type' => 'input',
                            'id' => 'snapchat',
                            'label' => 'Snapchat',
                        )
                    )
                ),
            )),
        )),
//        array('id' => 'theme', 'title' => 'Theme', 'sections' => array()),
//        array('id' => 'videos', 'title' => 'Videos', 'sections' => array())
    );
    return $pages;
}