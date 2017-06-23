<?php
/*
* Shortcodes
* File Version 14.0.1
* Theme Version 14.1.0
*/

// BEG Anchor Link
function anchor_link_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'anchor' => '',
    ), $atts);
    ob_start();
    ?>
    <div id="<?php echo $a['anchor']; ?>" class="asdc-vc anchor-link"></div>
    <?php

    return ob_get_clean();
}
add_shortcode('vc-anchor-link', 'anchor_link_shortcode');
add_action('vc_before_init', 'anchorLinkVC');
function anchorLinkVC() {
    vc_map(array(
            "name" => "Anchor Link",
            "base" => "vc-anchor-link",
            "class" => "vc-anchor-link",
            "category" => "Content",
            "icon" => "asdc-vc-sc-i i-anchor",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Anchor',
                    'param_name' => 'anchor',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END Anchor Link

// BEG Social Media
function social_media_shortcode($atts, $content) {
    $a = shortcode_atts(array(
    ), $atts);
    ob_start();
    ?>
    <div class="asdc-vc vc-social-media">
        <?php
        global $asdc_settings_social;
        $sidebar_social_media = $asdc_settings_social['social_media_section'];
        asdc_social_media($sidebar_social_media, 'fa');
        ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('social-media', 'social_media_shortcode');
add_action('vc_before_init', 'socialMediaVC');
function socialMediaVC() {
    vc_map(array(
            "name" => "Social media",
            "base" => "vc-social-media",
            "class" => "vc-social-media",
            "category" => "Content",
            "icon" => "asdc-vc-sc-i i-social",
            "params" => array()
        )
    );
}
// END Social Media

// BEG Button
function asdc_button_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'label' => '',
        'url' => '',
        'tab' => '',
    ), $atts );
    $a['tab'] = ($a['tab'] == 'true') ? '_blank' : '_self';
    ob_start();
    ?>
    <div class="asdc-vc-sc asdc-button">
        <a target="<?php echo $a['tab']; ?>" href="<?php echo $a['url']; ?>"><?php echo $a['label']; ?></a>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('vc-asdc-button', 'asdc_button_shortcode');
add_action('vc_before_init', 'asdcButtonVC');
function asdcButtonVC() {
    vc_map(array(
            "name" => "ASDC Button",
            "base" => "vc-asdc-button",
            "class" => "vc-asdc-button",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Label',
                    'param_name' => 'label',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'URL',
                    'param_name' => 'url',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'checkbox',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'New tab',
                    'param_name' => 'tab',
                    'value' => '',
                    'description' => 'Check this if you want the link to open in a new tab'
                ),
            )
        )
    );
}
// END Button
require('asdc-shortcodes-custom.php');
?>