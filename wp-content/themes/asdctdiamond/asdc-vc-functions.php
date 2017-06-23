<?php
/*
 * Visual Composer Functions Custom
 * File Version 15.0.0
 * Theme Version 15.0.2
 */

function asdc_vc_anchor_menu($atts, $content) {
    $a = shortcode_atts(array(
        'menu' => '',
    ), $atts);
    ob_start();
    ?>
    <div class="vc-anchor-menu">
        <?php asdc_output_menu($a['menu'], 'anchor-menu'); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('anchor-menu', 'asdc_vc_anchor_menu');
add_action('vc_before_init', 'asdc_vc_anchor_menuVC');
function asdc_vc_anchor_menuVC() {
    $menu_ar = array(
        '' => '',
        'Home Menu' => 'home-menu',
    );
    vc_map(array(
            'name' => 'Anchor Menu',
            'base' => 'anchor-menu',
            'class' => 'anchor-menu',
            'category' => 'Content',
            'icon' => 'asdc-vc-sc',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Menu',
                    'param_name' => 'menu',
                    'value' => $menu_ar,
                ),
            )
        )
    );
}

function asdc_vc_test($atts, $content) {
    $a = shortcode_atts(array(
    ), $atts);
    ob_start();
    ?>
    <div class="vc-test">
        <?php
        $test_editor = $asdc_get_main_settings['header']['logos']['main'];;
        echo $test_editor;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('vc-test', 'asdc_vc_test');
add_action('vc_before_init', 'asdc_vc_testVC');
function asdc_vc_testVC() {
    vc_map(array(
            'name' => 'VC Test',
            'base' => 'vc-test',
            'class' => 'vc-test',
            'category' => 'Content',
            'icon' => 'asdc-vc-sc',
            'params' => array(

            )
        )
    );
}
?>