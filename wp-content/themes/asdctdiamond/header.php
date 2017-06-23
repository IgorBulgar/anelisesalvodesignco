<?php
/*
* Header
* File Version 15.0.0
* Theme Version 15.0.0
*/

?>
<?php //asdc_pass(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php
    
    global $asdc_settings, $asdc_settings_social, $asdc_settings_theme;

    // BEG Head Settings - CROWN
    $st_favicon_id = $asdc_settings_theme['head_section']['favicon']['image'];
    $st_favicon_url_get = wp_get_attachment_image_src($st_favicon_id, 'full');
    $st_favicon_url_set = $st_favicon_url_get[0];
    
    
    $st_minified_css = $asdc_settings_theme['advanced_section']['mini-css']['switch'];
    $st_comment_reply_get = $asdc_settings_theme['advanced_section']['comment-reply']['switch'];
    $st_comment_reply_set = $st_comment_reply_get == 1 ? true : false;
    // END Head Settings - CROWN
    ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ($st_minified_css != 1) : ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<?php endif; ?>
    <link rel="shortcut icon" href="<?php echo $st_favicon_url_set; ?>" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo $st_favicon_url_set; ?>" />
    <?php

    wp_head();

    // BEG Enable Comment Reply - CROWN
    if ($st_comment_reply_set === true && is_singular()) {
        wp_enqueue_script('comment-reply');
    }
    // END Enable Comment Reply - CROWN

    // BEG Body Classes - CROWN
    $body_class = (is_user_logged_in() ? 'admin' : 'not-admin');
    if (is_page()) {$body_class .= ' is-page';}
    if (is_home()) {$body_class .= ' is-home';}
    if (is_front_page()) {$body_class .= ' is-front';}
    // END Body Classes - CROWN

    // Let's store the settings
    $asdc_get_main_settings = get_option('asdc_settings_main_option');
    $asdc_get_social_accounts = get_option('asdc_settings_social_option');
    $asdc_set_social_accounts = $asdc_get_social_accounts['accounts']['url'];
    ?>
</head>
<body class="<?php echo $body_class; ?>">
    <div class="body-wrapper">
        <header>
            <div class="row row-1">
                <div class="row-wrapper limited-width-default">
                    <?php asdc_output_menu('main-menu'); ?>
                    <div class="subscribe-btn">SUBSCRIBE</div>
                    <?php asdc_output_social_media($asdc_set_social_accounts, 'fa', 'header-social-accounts'); ?>
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="row row-2">
                <div class="row-wrapper limited-width-default">
                    <?php
                    $main_logo_id = $asdc_get_main_settings['header']['logos']['main'];
                    ?>
                    <h1 class="main-logo-heading"><a id="main-logo" href="/"><?php echo wp_get_attachment_image($main_logo_id, 'main-logo'); ?></a></h1>
                </div>
            </div>
            <div class="row row-3">
                <div class="row-wrapper">
                    <?php asdc_show_icon('close', 'toggleMobileMenu();'); ?>
                    <div class="final-wrapper">

                        <div class="asdc-clear"></div>
                        <div class="mobile-menu-links">
                            <?php
                            $connect_url = $asdc_settings['contact_section']['connect-url']['text'];
                            ?>
                            <div class="info-item"><a href="<?php echo $connect_url; ?>">CONNECT ></a></div>
                            <?php
                            $info_arr = array(
                                'twitter' => $asdc_settings_social['social_media_section']['twitter']['url'],
                                'linkedin' => $asdc_settings_social['social_media_section']['linkedin']['url'],
                            );
                            $info_nr = 0;
                            foreach ($info_arr as $key => $value) {
                                if ($value != '') {
                                    $info_nr++;
                                    if ($info_nr > 1) {echo '<div class="separator">|</div>';}
                                    ?>
                                    <div class="info-item"><?php echo '<a target="_blank" href="'.$value.'">'.$key.'</a>';?></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    $sticky_logo_id = $asdc_settings['header_section']['sticky-logo']['image'];
                    $main_logo_id = $asdc_settings['header_section']['logo']['image'];
                    $copyright_text = $asdc_settings['footer_section']['copyright']['text'];
                    ?>
                    <div class="mobile-copyright">
                        <div class="copyright-text"><?php echo $copyright_text; ?></div>
                    </div>
                    <a id="sticky-logo" href="/"><?php echo wp_get_attachment_image($sticky_logo_id, 'sticky-logo'); ?></a>
                    <?php asdc_show_icon('hamburger', 'toggleMobileMenu();'); ?>
                    <a id="main-logo" href="/"><?php echo wp_get_attachment_image($main_logo_id, 'logo'); ?></a>
                </div>
            </div>
        </header>
        <?php
        $main_extra_style = '';
        if (is_front_page()) {
            $t_p_id = get_the_ID();
            if (has_post_thumbnail($t_p_id)) {
                $landing_image_src = get_the_post_thumbnail_url($t_p_id,'largest');
                $main_extra_style .= "background-image: url('$landing_image_src');";
            }
        }
        ?>
        <div style="<?php echo $main_extra_style; ?>" id="asdc-main">
            <div class="main-wrapper">