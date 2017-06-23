<?php
/*
Plugin Name: ASDC Settings
Description: Adds the ASDC Settings in the Dashboard.
Author: ASDC
Author URI: http://www.anelisesalvodesignco.com/
Version: 14.2.0
*/

class asdcSettings {
	public function __construct() {

		// BEG Includes
        include('includes/asdc-default-callbacks.php');
        include('includes/asdc-settings-page.php');
        include('includes/asdc-settings-page-social.php');
        include('includes/asdc-settings-page-theme.php');
        include('includes/asdc-settings-page-videos.php');
        include('includes/asdc-admin-classes.php');
		// END Includes

		add_action('admin_enqueue_scripts', array($this, 'asdc_admin_add_scripts'));
    }

    public function asdc_admin_add_scripts() {
		wp_enqueue_style('asdc-admin-settings-css', plugins_url('/css/admin-style.css', __FILE__));
        wp_enqueue_style('asdc-admin-settings-css-custom', plugins_url('/css/admin-style-custom.css', __FILE__));
        wp_enqueue_script('asdc-admin-functions-js', plugins_url('/js/admin-functions.js', __FILE__), array( 'jquery', 'wp-color-picker' ), false, true);
        wp_enqueue_script('asdc-admin-functions-js-custom', plugins_url('/js/admin-functions-custom.js', __FILE__), array('jquery', 'wp-color-picker' ), false, true);
        wp_enqueue_media();
	    wp_enqueue_style('asdc-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('wp-color-picker');
    }
}
if(is_admin()) {
    $asdc_settings = new asdcSettings();
}

function asdc_admin_bar_button($wp_admin_bar) {
    $args = array(
        'id' => 'asdc-settings-button',
        'title' => 'ASDC Settings',
        'href' => '/wp-admin/admin.php?page=asdc-admin-settings',
        'meta' => array(
            'class' => 'asdc-settings-button'
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'asdc_admin_bar_button', 35);

include('includes/global-settings.php');
include('includes/asdc-developing-mode.php');
?>