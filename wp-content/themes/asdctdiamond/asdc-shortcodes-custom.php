<?php
/*
* Shortcodes - Custom
* File Version 14.0.0
* Theme Version 14.0.0
*/

// BEG Testimonials
function testimonials_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'title' => '',
        'det' => ''
    ), $atts);
    ob_start();
    ?>
    <?php
    $this_page_ID = get_the_ID();
    $comments_get_args = array(
        'post_id' => $this_page_ID,
        'status' => 'approve',
    );
    $comments_get = get_comments($comments_get_args);
    $slider_elements_count = count($comments_get);
    if ($slider_elements_count > 0) {
        $extra_class_sc = '';
        if ($a['det'] != '') {
            $extra_class_sc .= 'detailed';
        }
        if ($a['title'] != '') {
            $extra_class_sc .= ' titled';
        }
        ?>
        <div class="asdc-vc-sc testimonials <?php echo $extra_class_sc; ?>">
            <?php
            if ($a['title'] != '') {
                ?>
                <h2 class="slider-title"><?php echo $a['title']; ?></h2>
                <div class="asdc-clear"></div>
                <?php
            }
            ?>
            <div currentslide="1" class="asdc-slider testimonials-slider slider-type-1 fill-height lazy-load mapping">
                <div class="asdc-slider-window">
                    <div class="asdc-slider-band">
                        <?php
                        for($i = 0; $i < $slider_elements_count; $i++) {
                            $front_slide_number = $i + 1;
                            ?>
                            <div class="asdc-slider-slide lazy-load" slidenr="<?php echo $front_slide_number; ?>">
                                <div class="testimonial-item">
                                    <div class="t-text"><?php echo nl2br($comments_get[$i]->comment_content); ?></div>
                                    <?php
                                    if ($a['det'] != '') {
                                        ?>
                                        <div class="t-author">- <?php echo $comments_get[$i]->comment_author; ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="asdc-slider-navigation">
                    <div class="asdc-slider-bullets">
                        <?php
                        for ($bullet_i = 0; $bullet_i < $slider_elements_count; $bullet_i++) {
                            $front_bullet_number = $bullet_i + 1;
                            $bullet_class = 'asdc-slider-bullet';
                            if ( $front_bullet_number == 1 ) {
                                $bullet_class .= ' active';
                            }
                            ?>
                            <div onclick="asdcChangeSlideType1(this);" bulletnr="<?php echo $front_bullet_number; ?>" class="<?php echo $bullet_class; ?>"></div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="asdc-slider-arrows">
                        <div onclick="asdcChangeSlideType1(this);" class="asdc-slider-arrow left">
                            <div class="asdc-icons asdc-i-arrow-left">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div onclick="asdcChangeSlideType1(this);" class="asdc-slider-arrow right">
                            <div class="asdc-icons asdc-i-arrow-right">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="asdc-slider-mapping"><span class="current-map">1</span>/<span class="total-map"><?php echo $slider_elements_count; ?></span></div>
            </div>
        </div>
        <?php
    }
    ?>
    <?php

    return ob_get_clean();
}
add_shortcode('vc-testimonials', 'testimonials_shortcode');
add_action('vc_before_init', 'testimonialsVC');
function testimonialsVC() {
    vc_map(array(
            "name" => "Testimonials",
            "base" => "vc-testimonials",
            "class" => "vc-testimonials",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'checkbox',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Detailed',
                    'param_name' => 'det',
                    'value' => '',
                    'description' => 'Show the author\'s name and total number of slides'
                ),
            )
        )
    );
}
// END Testimonials

// BEG Client Item
function client_item_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'img' => '',
    ), $atts);
    ob_start();
    ?>
    <div class="asdc-vc-sc client-item">
        <div class="client-logo">
            <div class="flex-center-v">
                <?php echo wp_get_attachment_image($a['img'], 'sponsors-big'); ?>
            </div>
        </div>
        <div class="client-services">
            <div class="flex-center-h-v">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('vc-client-item', 'client_item_shortcode');
add_action('vc_before_init', 'clientItemVC');
function clientItemVC() {
    $vc_id = 'client-item';
    vc_map(array("name" => "Client Item", "base" => "vc-".$vc_id, "class" => "vc-".$vc_id, "category" => "Content", "icon" => "asdc-vc-sc",
        "params" => array(
            array(
                'type' => 'attach_image',
                'holder' => 'div',
                'class' => '',
                'heading' => 'Logo',
                'param_name' => 'img',
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'class' => '',
                'heading' => 'Services',
                'param_name' => 'content',
                'value' => '',
                'description' => ''
            ),
        )
    ));
}
// END Client Item

// BEG Service Item
function service_item_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'title' => '',
    ), $atts);
    ob_start();
    ?>
    <div class="asdc-vc-sc service-item">
        <div class="flex-center-v">
            <h2><?php echo $a['title']; ?></h2>
        </div>
        <div class="description">
            <div class="flex-center-h-v">
                <div class="flex-container"><?php echo $content; ?></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('vc-service-item', 'service_item_shortcode');
add_action('vc_before_init', 'serviceItemVC');
function serviceItemVC() {
    $vc_id = 'service-item';
    vc_map(array("name" => "Service Item", "base" => "vc-".$vc_id, "class" => "vc-".$vc_id, "category" => "Content", "icon" => "asdc-vc-sc",
        "params" => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => 'Title',
                'param_name' => 'title',
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'class' => '',
                'heading' => 'Text',
                'param_name' => 'content',
                'value' => '',
                'description' => ''
            ),
        )
    ));
}
// END Service Item

// BEG Contact Info
function contact_info_shortcode($atts, $content) {
    $a = shortcode_atts(array(
        'style' => 'basic',
    ), $atts);
    global $asdc_settings, $asdc_settings_social;
    if ($a['style'] == 'advanced') {
        $info_arr = array(
            'mail' => $asdc_settings['contact_section']['mail']['text'],
            'phone' => $asdc_settings['contact_section']['phone']['text'],
        );
    } else {
        $info_arr = array(
            'phone' => $asdc_settings['contact_section']['phone']['text'],
            'mail' => $asdc_settings['contact_section']['mail']['text'],
        );
    }

    $extra_main_class = 'contact-info';
    $extra_main_class .= ' '.$a['style'];
    ob_start();
    ?>
    <div class="asdc-vc-sc <?php echo $extra_main_class; ?>">
        <?php
        foreach ($info_arr as $key => $value) {
            if ($value != '') {
                ?>
                <div class="contact-info-item">
                    <?php
                    if ($key == 'mail') {echo '<a target="_blank" href="mailto:'.$value.'">'.$value.'</a>';}
                    if ($key == 'phone') {
                        $phone_link = $asdc_settings['contact_section']['phone-url']['text'];
                        if ($a['style'] == 'advanced') {$before_label = '';}
                        else {$before_label = 'DIRECT: ';}
                        if ($phone_link != '') {echo '<a target="_blank" href="tel:'.$phone_link.'">'.$before_label.$value.'</a>';}
                        else {echo '<span>'.$before_label.$value.'</span>';}
                    }
                    ?>
                </div>
                <?php
            }
        }
        ?>
        <?php
        if ($a['style'] == 'advanced') {
            echo '<div class="advanced-items">';
            $info_arr = array(
                'linkedin' => $asdc_settings_social['social_media_section']['linkedin']['url'],
                'twitter' => $asdc_settings_social['social_media_section']['twitter']['url'],
            );
            $info_nr = 0;
            foreach ($info_arr as $key => $value) {
                if ($value != '') {
                    $info_nr++;
                    if ($info_nr > 1) {echo '<div class="separator">|</div>';}
                    ?>
                    <div class="info-item"><?php echo '<a target="_blank" href="'.$value.'">'.$key.'</a>'; ?></div>
                    <?php
                }
            }
            echo '</div>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('vc-contact-info', 'contact_info_shortcode');
add_action('vc_before_init', 'contactInfoVC');
function contactInfoVC() {
    $vc_id = 'contact-info';
    $style_arr = array(
        'Basic' => 'basic',
        'Advanced' => 'advanced',
    );
    vc_map(array("name" => "Contact Info", "base" => "vc-".$vc_id, "class" => "vc-".$vc_id, "category" => "Content", "icon" => "asdc-vc-sc",
        "params" => array(
            array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => 'Style',
                'param_name' => 'style',
                'value' => $style_arr,
                'description' => 'Show phone, mail and social accounts'
            ),
        )
    ));
}
// END Contact Info

// BEG Subscribe
function subscribe_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'id' => '',
    ), $atts );
    ob_start();
    ?>
    <div class="asdc-vc-sc subscribe-box">
        <div class="subscribe-wrapper">
            <?php
            if ($a['title'] != '') {
                ?>
                <h3 class="subscribe-title"><?php echo $a['title']; ?></h3>
                <?php
            }
            ?>
            <?php echo do_shortcode('[yikes-mailchimp form="'.$a['id'].'"]'); ?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-subscribe', 'subscribe_shortcode' );
add_action( 'vc_before_init', 'subscribeVC' );
function subscribeVC() {
    vc_map( array(
            "name" => "Subscribe",
            "base" => "vc-subscribe",
            "class" => "vc-subscribe",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Form ID',
                    'param_name' => 'id',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END Subscribe

// BEG Sponsors
function sponsors_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'img' => '',
        'urls' => '',
    ), $atts );
    ob_start();
    ?>
    <div class="asdc-vc-sc sponsors">
        <?php
        $images = explode(',', $a['img']);
        $urls_get = explode('<br />', $a['urls']);
        $urls_set = array();
        for ($i = 0; $i < count($urls_get); $i++) {
            $urls_set[$i] = trim(preg_replace('/\s+/', ' ', $urls_get[$i]));
        }
        for ($i = 0; $i < count($images); $i++) {
            if ($urls_set[$i] != '#') {
                ?>
                <a target="_blank" href="<?php echo $urls_set[$i]; ?>" class="sponsor-item">
                    <?php echo wp_get_attachment_image($images[$i], 'sponsors'); ?>
                </a>
                <?php
            } else {
                ?>
                <span class="sponsor-item">
                    <?php echo wp_get_attachment_image($images[$i], 'sponsors'); ?>
                </span>
                <?php
            }
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-sponsors', 'sponsors_shortcode' );
add_action( 'vc_before_init', 'sponsorsVC' );
function sponsorsVC() {
    vc_map( array(
            "name" => "Sponsors",
            "base" => "vc-sponsors",
            "class" => "vc-sponsors",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'attach_images',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Images',
                    'param_name' => 'img',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'URLs',
                    'param_name' => 'urls',
                    'value' => '',
                    'description' => 'Each link in a new line (press Enter)'
                ),
            )
        )
    );
}
// END Sponsors

// BEG Heading
function heading_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'h' => 'h2',
        'style' => 'didot-italic',
    ), $atts );
    $extra_class_main = ' heading';
    $extra_class_heading = 'style-' . $a['style'];
    ob_start();
    ?>
    <div class="asdc-sc-vc<?php echo $extra_class_main; ?>">
        <<?php echo $a['h']; ?> class="<?php echo $extra_class_heading; ?>"><?php echo $a['title']; ?></<?php echo $a['h']; ?>>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-heading', 'heading_shortcode' );
add_action( 'vc_before_init', 'headingVC' );
function headingVC() {
    $style_ar = array(
        'Didot Italic' => 'didot-italic',
        'Page Title (basic)' => 'page-title-basic',
        'Page Title (absolute)' => 'page-title-absolute',
    );
    vc_map( array(
            "name" => "Heading",
            "base" => "vc-heading",
            "class" => "vc-heading",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Heading',
                    'param_name' => 'h',
                    'value' => 'h2',
                    'description' => 'h1 - h6'
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Style',
                    'param_name' => 'style',
                    'value' => $style_ar,
                    'description' => ''
                ),
            )
        )
    );
}
// END Heading

// BEG Kerber Image
function kerber_image_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'img' => '',
        'style' => 'none',
        'title' => '',
        'h' => 'h2',
    ), $atts );
    $extra_class_main = ' kerber-image';
    if ($a['style'] != 'none') {
        $extra_class_main .= ' ' . $a['style'];
    }
    ob_start();
    ?>
    <div class="asdc-sc-vc<?php echo $extra_class_main; ?>">
        <?php
        if ($a['title'] != '') {
            ?>
            <<?php echo $a['h']; ?> style=""><?php echo $a['title']; ?></<?php echo $a['h']; ?>>
            <?php
        }
        ?>
        <div class="asdc-image-holder">
            <?php echo wp_get_attachment_image($a['img'], 'large'); ?>
        </div>
    </div>
    <div class="asdc-clear"></div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-kerber-image', 'kerber_image_shortcode' );
add_action( 'vc_before_init', 'kerberImageVC' );
function kerberImageVC() {
    $style_ar = array(
        'None' => 'none',
        'Border' => 'border',
        'Shadow' => 'shadow',
    );
    vc_map( array(
            "name" => "Kerber Image",
            "base" => "vc-kerber-image",
            "class" => "vc-kerber-image",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Image',
                    'param_name' => 'img',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Style',
                    'param_name' => 'style',
                    'value' => $style_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Heading',
                    'param_name' => 'h',
                    'value' => 'h2',
                    'description' => 'h1 - h6'
                ),
            )
        )
    );
}
// END Kerber Image

// BEG Vertical Heading
function vertical_heading_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
    ), $atts );
    $extra_class_main = ' vertical-heading';
    ob_start();
    ?>
    <div class="asdc-sc-vc<?php echo $extra_class_main; ?>">
        <div class="title"><?php echo $a['title']; ?></div>
        <div class="border"></div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-vertical-heading', 'vertical_heading_shortcode' );
add_action( 'vc_before_init', 'verticalHeadingVC' );
function verticalHeadingVC() {
    vc_map( array(
            "name" => "Vertical Heading",
            "base" => "vc-vertical-heading",
            "class" => "vc-vertical-heading",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END Vertical Heading

// BEG Trapezoid
function trapezoid_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'bg-color' => '',
        'bg-opacity' => '',
        'bg-image' => '',
        'upper-direction' => 'none',
        'upper-height' => '',
        'upper-color' => '#fff',
        'upper-padding' => '0',
        'lower-direction' => 'none',
        'lower-height' => '200px',
        'lower-color' => '#fff',
        'lower-padding' => '0',
    ), $atts );

    $extra_class_main = ' trapezoid';
    $extra_class_main .= ' upper-padding-'.$a['upper-padding'];
    $extra_class_main .= ' lower-padding-'.$a['lower-padding'];

    $extra_style_middle = '';
    if ($a['bg-color'] != '') {
        $extra_style_middle .= 'background-color: '.$a['bg-color'].';';
    }
    if ($a['bg-opacity'] != '') {
        $extra_style_middle .= 'background-opacity: '.$a['bg-opacity'].';';
    }
    if ($a['bg-image'] != '') {
        $bg_image_src = wp_get_attachment_image_src($a['bg-image'],'trapezoid');
        $extra_style_middle .= 'background-image: url("'.$bg_image_src.'");';
    }

    $extra_style_upper = '';
    $extra_style_upper_padding = 'background-color: '.$a['upper-color'].';';
    if ($a['upper-direction'] != 'none') {
        $extra_class_main .= ' upper upper-'.$a['upper-direction'];
        $extra_class_main .= ' upper-height-'.$a['upper-height'];

        $extra_style_upper .= 'border-color: '.$a['upper-color'].';';
    }

    $extra_style_lower = '';
    $extra_style_lower_padding = 'background-color: '.$a['lower-color'].';';
    if ($a['lower-direction'] != 'none') {
        $extra_class_main .= ' lower lower-'.$a['lower-direction'];
        $extra_class_main .= ' lower-height-'.$a['lower-height'];

        $extra_style_lower .= 'border-color: '.$a['lower-color'].';';
    }
    ob_start();
    ?>
    <div class="asdc-sc-vc<?php echo $extra_class_main; ?>">
        <div style="<?php echo $extra_style_upper_padding; ?>" class="upper-section-padding"></div>
        <div style="<?php echo $extra_style_upper; ?>" class="upper-section"></div>
        <div style="<?php echo $extra_style_middle; ?>" class="middle-section"></div>
        <div style="<?php echo $extra_style_lower; ?>" class="lower-section"></div>
        <div style="<?php echo $extra_style_lower_padding; ?>" class="lower-section-padding"></div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'vc-trapezoid', 'trapezoid_shortcode' );
add_action( 'vc_before_init', 'trapezoidBoxVC' );
function trapezoidBoxVC() {
    $direction_ar = array(
        'None' => 'none',
        'Left' => 'left',
        'Right' => 'right',
    );
    $height_ar = array(
        '80px' => 80,
        '140px' => 140,
        '150px' => 150,
        '200px' => 200,
        '250px' => 250,
        '300px' => 300,
    );
    $padding_ar = array(
        '0' => 0,
        '84px' => 84,
        '100px' => 100,
        '170px' => 170,
        '300px' => 300,
        '670px' => 670,
    );
    vc_map( array(
            "name" => "Trapezoid",
            "base" => "vc-trapezoid",
            "class" => "vc-trapezoid",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'colorpicker',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Background Color',
                    'param_name' => 'bg-color',
                    'value' => '',
                    'description' => ''
                ),
//                array(
//                    'type' => 'attach_image',
//                    'holder' => 'div',
//                    'class' => '',
//                    'heading' => 'Background Image',
//                    'param_name' => 'bg-image',
//                    'value' => '',
//                    'description' => ''
//                ),
//                array(
//                    'type' => 'textfield',
//                    'holder' => 'div',
//                    'class' => '',
//                    'heading' => 'Image Opacity',
//                    'param_name' => 'bg-opacity',
//                    'value' => '1',
//                    'description' => 'eg. 0.55'
//                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Upper Direction',
                    'param_name' => 'upper-direction',
                    'value' => $direction_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Upper Height',
                    'param_name' => 'upper-height',
                    'value' => $height_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'colorpicker',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Upper Color',
                    'param_name' => 'upper-color',
                    'value' => '#ffffff',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Upper Padding',
                    'param_name' => 'upper-padding',
                    'value' => $padding_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Lower Direction',
                    'param_name' => 'lower-direction',
                    'value' => $direction_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Lower Height',
                    'param_name' => 'lower-height',
                    'value' => $height_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'colorpicker',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Lower Color',
                    'param_name' => 'lower-color',
                    'value' => '#ffffff',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Lower Padding',
                    'param_name' => 'lower-padding',
                    'value' => $padding_ar,
                    'description' => ''
                ),
            )
        )
    );
}
// END Trapezoid

// BEG Latest Posts
function latest_posts_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'btn-text' => '',
        'btn-url' => '',
    ), $atts );
    ob_start();
    ?>
    <div class="latest-posts-sc">
        <div class="head-part">
            <h2><?php echo $a['title']; ?></h2>
            <div class="hr"></div>
        </div>
        <div class="posts-feed asdc-clear-after">
            <?php
            $posts_get_args = array(
                'posts_per_page' => 3,
            );
            $posts_get = new wp_query($posts_get_args);
            while($posts_get->have_posts()) {
                $posts_get->the_post();
                get_template_part( 'content-latest', get_post_format() );
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="foot-part">
            <div class="vc-asdc-button">
                <a target="_self" href="<?php echo $a['btn-url']; ?>"><?php echo $a['btn-text']; ?></a>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-latest-posts', 'latest_posts_shortcode' );
//add_action( 'vc_before_init', 'latestPostsVC' );
function latestPostsVC() {
    vc_map( array(
            "name" => "Latest Posts",
            "base" => "vc-latest-posts",
            "class" => "vc-latest-posts",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Button Text',
                    'param_name' => 'btn-text',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Button URL',
                    'param_name' => 'btn-url',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END Latest Posts



// BEG Shop
function shop_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'tag' => '',
    ), $atts );
    ob_start();
    ?>
    <div class="shop-sc limited-width-default">
        <div class="info">
            <h2><?php echo $a['title']; ?></h2>
            <h3><?php echo $a['tag']; ?></h3>
        </div>
        <div currentslide="1" class="asdc-slider shop-slider slider-type-4 center-visible rewind forward">
            <?php
            global $asdc_settings;
            $this_slider_slides_info = $asdc_settings['shop_section']['shop'];
            $slider_elements_count = count($this_slider_slides_info['image']);
            ?>
            <div class="asdc-slider-window">
                <div class="asdc-slider-band">
                    <?php
                    $image_size = 'shop';
                    for( $slide_i = 0; $slide_i < $slider_elements_count; $slide_i++ ) {
                        $front_slide_number = $slide_i + 1;
                        $this_slide_i_image = $this_slider_slides_info['image'][$slide_i];
                        $this_slide_i_url = ( $this_slider_slides_info['url'][$slide_i] != '' ) ? $this_slider_slides_info['url'][$slide_i] : '#';
                        $this_slide_i_name = $this_slider_slides_info['name'][$slide_i];
                        ?>
                        <div class="asdc-slider-slide" slidenr="<?php echo $front_slide_number; ?>">
                            <a target="_blank" href="<?php echo $this_slide_i_url; ?>" class="asdc-link-wrapper">
                                <?php
                                if ( $this_slide_i_image != '' ) {
                                    ?>
                                    <div class="asdc-image-holder">
                                        <?php
                                        echo wp_get_attachment_image( $this_slide_i_image, $image_size );
                                        ?>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="asdc-empty-image size-<?php echo $image_size; ?>"></div>
                                    <?php
                                }
                                if ( $this_slide_i_name != '' ) {
                                    echo "<h4>$this_slide_i_name</h4>";
                                }
                                ?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="asdc-slider-navigation">
                <div class="asdc-slider-bullets">
                    <?php
                    for( $bullet_i = 0; $bullet_i < $slider_elements_count; $bullet_i++ ) {
                        $front_bullet_number = $bullet_i + 1;
                        $bullet_class = 'asdc-slider-bullet';
                        if ( $front_bullet_number == 1 ) {
                            $bullet_class .= ' active';
                        }
                        ?>
                        <div onclick="asdcChangeSlideType4( this );" bulletnr="<?php echo $front_bullet_number; ?>" class="<?php echo $bullet_class; ?>"></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="asdc-slider-arrows">
                    <div onclick="asdcChangeSlideType4( this );" class="asdc-slider-arrow left"></div>
                    <div onclick="asdcChangeSlideType4( this );" class="asdc-slider-arrow right"></div>
                </div>
            </div>
        </div>
        <div class="asdc-clear"></div>
    </div>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-shop', 'shop_shortcode' );
//add_action( 'vc_before_init', 'shopVC' );
function shopVC() {
    vc_map( array(
            "name" => "Shop",
            "base" => "vc-shop",
            "class" => "vc-shop",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Tag line',
                    'param_name' => 'tag',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END Shop

// BEG Page title
// A title that centers vertically
function page_title_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'h' => 'h2',
    ), $atts );
    ob_start();
    ?>
    <div class="page-title-sc">
        <?php echo '<' . $a['h'] . '>' . $a['title'] . '</' . $a['h'] . '>'; ?>
    </div>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-page-title', 'page_title_shortcode' );
//add_action( 'vc_before_init', 'pageTitleVC' );
function pageTitleVC() {
    vc_map( array(
            "name" => "Page Title",
            "base" => "vc-page-title",
            "class" => "vc-page-title",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Heading',
                    'param_name' => 'h',
                    'value' => '',
                    'description' => 'h1, h2, h3'
                ),
            )
        )
    );
}
// END Page title

// BEG About page slider
function about_page_slider_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
    ), $atts );
    ob_start();
    ?>
    <div class="about-page-slider-sc">
        <?php
        if (isset($_GET['slide'])) {
            ?>
            <script>
                setTimeout( function() {
                    jQuery('.about-page-slider').find('.asdc-slider-bullet').eq(<?php echo $_GET['slide']; ?> - 1).click();
                }, 1000);
                setTimeout( function() {
                    jQuery('.about-page-slider').find('.asdc-slider-bullet').eq(<?php echo $_GET['slide']; ?> - 1).click();
                }, 2000);
                setTimeout( function() {
                    jQuery('.about-page-slider').find('.asdc-slider-bullet').eq(<?php echo $_GET['slide']; ?> - 1).click();
                }, 3000);
                setTimeout( function() {
                    jQuery('.about-page-slider').find('.asdc-slider-bullet').eq(<?php echo $_GET['slide']; ?> - 1).click();
                }, 4000);
            </script>
            <?php
        }
        ?>
        <div class="boxed-content">
            <div currentslide="1" class="asdc-slider about-page-slider slider-type-1 fill-height lazy-load mapping">
                <?php
                global $asdc_settings;
                $this_slider_slides_info = $asdc_settings['about_section']['slider'];
                $slider_elements_count = count($this_slider_slides_info['text']);
                ?>
                <div class="asdc-slider-window">
                    <div class="asdc-slider-band">
                        <?php
                        for( $slide_i = 0; $slide_i < $slider_elements_count; $slide_i++ ) {
                            $front_slide_number = $slide_i + 1;
                            $this_slide_i_heading = $this_slider_slides_info['header'][$slide_i];
                            $this_slide_i_text = $this_slider_slides_info['text'][$slide_i];
                            ?>
                            <div class="asdc-slider-slide lazy-load" slidenr="<?php echo $front_slide_number; ?>">
                                <div class="slide-content">
                                    <div class="final-wrapper">
                                        <?php
                                        if ($this_slide_i_heading != '') {
                                            ?>
                                            <h2><?php echo $this_slide_i_heading; ?></h2>
                                            <?php
                                        }
                                        ?>
                                        <div class="text"><?php echo nl2br($this_slide_i_text); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="asdc-slider-navigation">
                        <div class="asdc-slider-bullets">
                            <?php
                            for ($bullet_i = 0; $bullet_i < $slider_elements_count; $bullet_i++) {
                                $front_bullet_number = $bullet_i + 1;
                                $bullet_class = 'asdc-slider-bullet';
                                if ( $front_bullet_number == 1 ) {
                                    $bullet_class .= ' active';
                                }
                                ?>
                                <div onclick="asdcChangeSlideType1( this );" bulletnr="<?php echo $front_bullet_number; ?>" class="<?php echo $bullet_class; ?>"></div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="asdc-slider-arrows">
                            <div onclick="asdcChangeSlideType1( this );" class="asdc-slider-arrow left"></div>
                            <div class="asdc-slider-mapping"><span class="current-map">1</span>/<span class="total-map"><?php echo $slider_elements_count; ?></span></div>
                            <div onclick="asdcChangeSlideType1( this );" class="asdc-slider-arrow right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="asdc-clear"></div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-about-page-slider', 'about_page_slider_shortcode' );
//add_action( 'vc_before_init', 'aboutPageSliderVC' );
function aboutPageSliderVC() {
    vc_map( array(
            "name" => "About Page Slider",
            "base" => "vc-about-page-slider",
            "class" => "vc-about-page-slider",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'holder' => 'div',
                    'param_name' => 'asdc-description',
                    'heading' => 'Edit slides in ASDC Settings',
                ),
            )
        )
    );
}
// END About page slider

// BEG ASDC Heading
function asdc_heading_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'title' => '',
        'style' => 'default',
        'h' => 'h2',
        'bg' => 'transparent',
        'tag' => '',
    ), $atts );
    ob_start();
    if ($a['tag'] != '') {
        $extra_class_sc = ' has-tag';
    } else {
        $extra_class_sc = '';
    }
    ?>
    <div style="background-color: <?php echo $a['bg']; ?>;" class="asdc-heading-sc<?php echo $extra_class_sc; ?>">
        <?php echo '<' . $a['h'] . ' class="' . $a['style'] . '">' . $a['title'] . '</' . $a['h'] . '>'; ?>
        <?php
        if ($a['tag'] != '') {
            echo '<p class="tagline">' . $a['tag'] . '</p>';
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-asdc-heading', 'asdc_heading_shortcode' );
//add_action( 'vc_before_init', 'asdcHeadingVC' );
function asdcHeadingVC() {
    $style_ar = array(
        'Saturday Script Alt' => 'default',
        'TwCenMT Bold Italic' => 'italic',
    );
    vc_map( array(
            "name" => "ASDC Heading",
            "base" => "vc-asdc-heading",
            "class" => "vc-asdc-heading",
            "category" => "Content",
            "icon" => "asdc-vc-sc",
            "params" => array(
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Heading',
                    'param_name' => 'h',
                    'value' => '',
                    'description' => 'h1, h2, h3, h4, h5, h6'
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Style',
                    'param_name' => 'style',
                    'value' => $style_ar,
                    'description' => ''
                ),
                array(
                    'type' => 'colorpicker',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Background',
                    'param_name' => 'bg',
                    'value' => '',
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => 'Tag line',
                    'param_name' => 'tag',
                    'value' => '',
                    'description' => ''
                ),
            )
        )
    );
}
// END ASDC Heading





// BEG Anchor Text
function anchor_text_shortcode( $atts, $content ) {
    $a = shortcode_atts( array(
        'label' => '',
        'url' => '',
    ), $atts );
    ob_start();
    ?>
    <a href="<?php echo $a['url']; ?>" class="anchor-item"><?php echo $a['label']; ?></a>
    <?php

    return ob_get_clean();
}
//add_shortcode( 'vc-anchor-text', 'anchor_text_shortcode' );
//add_action( 'vc_before_init', 'anchorTextVC' );
function anchorTextVC() {
    vc_map( array(
            "name" => "Anchor Text",
            "base" => "vc-anchor-text",
            "class" => "vc-anchor-text",
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
            )
        )
    );
}
// END Anchor Text










?>