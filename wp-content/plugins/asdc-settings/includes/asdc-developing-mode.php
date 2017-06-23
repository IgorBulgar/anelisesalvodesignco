<?php
/*
 * ASDC Settings - Developing Mode
 * File Version 14.0.0
 * Plugin Version 14.2.0
 */

function asdc_admin_bar_developing_button($wp_admin_bar) {
    $args = array(
        'id' => 'asdc-developing-button',
        'title' => 'ASDC Developing Mode',
        'href' => '#',
        'meta' => array(
            'class' => 'asdc-developing-button',
            'title' => 'Changes are only visible for the admin',
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'asdc_admin_bar_developing_button', 35);

global $body_class;
$body_class = 'asdc-developing-mode';

function asdc_add_admin_body_class($classes) {
    return "$classes asdc-developing-mode";
}
add_filter('admin_body_class', 'asdc_add_admin_body_class');
?>