<?php
/*
 * ASDC Core Init - Settings
 * File Version 1.0.0
 * Plugin Version 1.0.0
 */

// Adding the settings pages and their sections
function asdc_init_settings_pages() {
    $pages = get_asdc_settings_pages(); // Get core pages

    // Import custom pages;
    $custom_pages = get_asdc_custom_settings_pages(); // todo ?????????????????????????
    if (count($custom_pages) > 0) {
        $pages = array_merge($pages, $custom_pages);
    }

    // Add the pages
    foreach($pages as $page) {
        $add_page = new asdcSettings($page);
    }
}
add_action('init', 'asdc_init_settings_pages');