<?php
/*
 * ASDC Core Functions
 * File Version 1.0.0
 * Plugin Version 1.0.0
 * Here we have the functions that we use to build a Theme on front end
 */

/*
 * asdc_e
 * asdc_output_menu
 * set_asdc_social_media
 * asdc_output_social_media
 * asdc_wp_footer
 * asdc_get_body_class
 */


// This is how I show you an error message
// $nr - error number
// $msg - error message
function asdc_e($nr, $msg) {
    echo '<pre class="asdc-pre">ERROR '.$nr.': '.$msg.'</pre>';
}

// Throwing out the menu
// $id - menu id
// $class - css class
function asdc_output_menu($id, $class = '') {
    ?>
    <div class="menu-wrapper <?php echo $class; ?>">
        <?php
        $menus = set_asdc_menus(); // todo ??????????????????????????????????????
        if(has_nav_menu($id)) {
            echo '<nav class="'.$id.' asdc-menu" role="navigation" aria-label="'.$menus[$id]['title'].'">';
            wp_nav_menu(array('theme_location' => $id));
            echo '</nav>';
        } else {
            asdc_e(2, 'Can\'t find such a menu');
        }
        ?>
    </div>
    <?php
}

// Here I'm declaring the social media accounts
function set_asdc_social_media() {
    $socials = array(
        'facebook' => array(
            'fa' => 'fa-facebook',
            'title' => 'Like on Facebook!',
            'label' => 'Facebook'
        ),
        'twitter' => array(
            'fa' => 'fa-twitter',
            'title' => 'Follow on Twitter!',
            'label' => 'Twitter'
        ),
        'instagram' => array(
            'fa' => 'fa-instagram',
            'title' => 'Follow on Instagram!',
            'label' => 'Instagram'
        ),
        'pinterest' => array(
            'fa' => 'fa-pinterest-p',
            'title' => 'Follow on Pinterest!',
            'label' => 'Pinterest'
        ),
        'youtube' => array(
            'fa' => 'fa-youtube',
            'title' => 'Subscribe on YouTube!',
            'label' => 'YouTube'
        ),
        'snapchat' => array(
            'fa' => 'fa-snapchat-ghost',
            'title' => 'Follow on Snapchat!',
            'label' => 'Snapchat'
        )
    );
    return $socials;
}

// Showing the social media accounts
// $data - the info we get from the settings page
// $output - type of the output
// $class - css class
function asdc_output_social_media($data, $output = 'fa', $class = '') {
    $params = set_asdc_social_media(); // Get the social accounts settings
    ?>
    <div class="asdc-social-media-output <?php echo $class; ?>">
        <?php
        switch ($output) {
            case 'fa':
                foreach($data as $key => $value) {
                    if($value != '') {
                        echo '<a target="_blank" href="'.$value.'" title="'.$params[$key]['title'].'"><i class="fa '.$params[$key]['fa'].'"></i></a>';
                    }
                }
                break;
            // todo ???????????????????????????????????????? Make the output for the links type
            case 'link':
                echo 'Links socials not ready!';
                break;
            default:
                asdc_e(3, 'Social media output unknown.');
                break;
        }
        ?>
    </div>
    <?php
}

// Loading the footer
function asdc_wp_footer() {
    ?>
    <div id="tablet-indicator"></div>
    <div id="mobile-indicator"></div>
    <?php wp_footer(); ?>
    <?php
}

// Setting the body class
function asdc_get_body_class() {
    $class = (is_user_logged_in() ? 'admin' : 'not-admin');
    if (is_page()) {$class .= ' is-page';}
    if (is_home()) {$class .= ' is-home';}
    if (is_front_page()) {$class .= ' is-front';}
    return $class;
}