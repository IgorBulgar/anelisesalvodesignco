<?php
/*
 * Functions
 * File Version 15.0.0
 * Theme Version 15.0.2
 */

/*
 * set_asdc_menus
 * set_asdc_image_size
 * asdc_add_scripts
 */

// Adding only for admin
if (is_admin()) {
    require_once('admin/admin-settings-custom.php'); // Defining all the custom settings for the ASDC Settings
}

// Defining the menus
function set_asdc_menus() {
    $menus = array(
        'main-menu' => array(
            'title' => 'Main Menu'
        ),
        'home-menu' => array(
            'title' => 'Home Menu'
        ),
    );
    return $menus;
}

// Defining the image sizes
function set_asdc_image_size() {
    $sizes = array(
        'largest' => array('w' => 1600, 'h' => 0, 'c' => false, 't' => 'Largest'),
        'asdc-thumb' => array('w' => 64, 'h' => 64, 'c' => true, 't' => 'ASDC Thumb'),
        'main-logo' => array('w' => 400, 'h' => 120, 'c' => false, 't' => 'Main logo'),
        'home-about' => array('w' => 454, 'h' => 376, 'c' => false, 't' => 'Home About'),
    );
    return $sizes;
}

// Adding front end scripts
function asdc_add_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('asdc-js-functions', get_template_directory_uri().'/js/functions.js', array('jquery'), false, true);
    wp_enqueue_script('asdc-js-functions-igor', get_template_directory_uri().'/js/functions-igor.js', array('jquery'), false, true);
    wp_enqueue_style('style-igor', get_template_directory_uri() . '/style-igor.css');




    // todo revise this
//    global $asdc_settings_theme;
//    $setting_minified_css = $asdc_settings_theme['advanced_section']['mini-css']['switch'];
//    if ($setting_minified_css == 1) {
//        wp_enqueue_style('style-min', get_template_directory_uri() . '/style.min.css');
//    }
    //wp_enqueue_script('jquery-effects-core');
    //wp_enqueue_script('jquery-ui-draggable');
    //wp_enqueue_script('asdc-js-touch-punch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array('jquery'), false, true);
    //wp_enqueue_script('asdc-js-mobile', get_template_directory_uri() . '/js/jquery.mobile.events.min.js', array('jquery'), false, true);
    //$setting_minified_js = $asdc_settings_theme['advanced_section']['mini-js']['switch'];
//    if ($setting_minified_js == 1) :
//        wp_enqueue_script('asdc-js-functions-min', get_template_directory_uri() . '/js/functions.min.js', array('jquery'), false, true);
//    else :
//        wp_enqueue_script('asdc-js-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), false, true);
//    endif;
    //wp_enqueue_style('asdc-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //wp_enqueue_style('karla-font', '//fonts.googleapis.com/css?family=Karla:400,400i,700,700i');
}
add_action('wp_enqueue_scripts', 'asdc_add_scripts');

// Clean the URL to show the domain
function asdc_clean_url($url) {
    $url = trim($url, '/');
    if (!preg_match('#^http(s)?://#', $url)) {
        $url = 'http://'.$url;
    }
    $urlParts = parse_url($url);
    $domain = preg_replace('/^www\./', '', $urlParts['host']);
    return $domain;
}


















require_once('functions-custom.php'); // Adding the custom functions




































//require_once('functions-custom.php');

////// BEG Advanced Setup - CROWN
$advanced_st = array(
    'ajax' => false,
    'widgets' => false,
);
////// END Advanced Setup - CROWN


////// BEG General Settings - CROWN
// BEG Run shortcodes - CROWN
// in widgets and in content
add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode');
// END Run shortcodes - CROWN

// BEG Add Featured images - CROWN
add_theme_support('post-thumbnails');
// END Add Featured images - CROWN

// BEG Insert ajax url var - CROWN
// todo add ST - YES/NO
function insert_ajax_url() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}
//add_action('wp_head', 'insert_ajax_url');
// END Insert ajax url var - CROWN

// BEG Add Search Form - CROWN
add_theme_support('html5', array('search-form'));
// END Add Search Form - CROWN
////// END General Settings - CROWN



// BEG Include Files - CROWN
if ($advanced_st['ajax'] === true) {include('ajax/ajax-functions.php');}
include('asdc-shortcodes.php');
if ($advanced_st['widgets'] === true) {include('asdc-widgets.php');}
// END Include Settings - CROWN



// BEG Add Scripts - CROWN
function asdc_add_scripts222() {
    global $asdc_settings_theme;
    $setting_minified_css = $asdc_settings_theme['advanced_section']['mini-css']['switch'];
    if ($setting_minified_css == 1) {
        wp_enqueue_style('style-min', get_template_directory_uri() . '/style.min.css');
    }
    wp_enqueue_script('jquery');
    //wp_enqueue_script('jquery-effects-core');
    wp_enqueue_script('jquery-ui-draggable');
    //wp_enqueue_script('asdc-js-touch-punch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array('jquery'), false, true);
    wp_enqueue_script('asdc-js-mobile', get_template_directory_uri() . '/js/jquery.mobile.events.min.js', array('jquery'), false, true);
    $setting_minified_js = $asdc_settings_theme['advanced_section']['mini-js']['switch'];
    if ($setting_minified_js == 1) :
        wp_enqueue_script('asdc-js-functions-min', get_template_directory_uri() . '/js/functions.min.js', array('jquery'), false, true);
    else :
        wp_enqueue_script('asdc-js-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), false, true);
    endif;
    wp_enqueue_style('asdc-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('karla-font', '//fonts.googleapis.com/css?family=Karla:400,400i,700,700i');
}
//add_action('wp_enqueue_scripts', 'asdc_add_scripts');

function asdc_admin_add_scripts() {
    //wp_enqueue_style('asdc-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //wp_enqueue_style('admin-css', get_template_directory_uri() . '/style-admin.css');
    //wp_enqueue_style('karla-font', '//fonts.googleapis.com/css?family=Karla:400,400i,700,700i');
}
add_action('admin_enqueue_scripts', 'asdc_admin_add_scripts');
// END Add Scripts - CROWN







// BEG Add Image Sizes - CROWN


// BEG Image Quality upload - CROWN
// todo add ST
add_filter('jpeg_quality', create_function( '', 'return 95;' ));
// END Image Quality upload - CROWN





// BEG ICONS - CROWN
function asdc_show_icon($t, $f) {
    if ($t == 'hamburger') {
        ?>
        <div onclick="<?php echo $f; ?>" class="asdc-hamburger">
            <button class="asdc-icons asdc-i-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <?php
    } else if ($t == 'close') {
        ?>
        <div onclick="<?php echo $f; ?>" class="asdc-close">
            <button class="asdc-icons asdc-i-close">
                <span></span>
                <span></span>
            </button>
        </div>
        <?php
    }
}
// END ICONS - CROWN



// BEG Search Form - CROWN
function asdc_show_search_form($type, $placeholder) {
    switch ($type) {
        case 'default':
            $html = '
            <form role="search" method="get" class="searchform type-default" action="'.home_url('/').'" >
                <div>
                    <label>SEARCH:</label>
                    <input placeholder="'.$placeholder.'" type="text" value="'.get_search_query().'" name="s" />
                </div>
            </form>';
            break;
        case 'no-label':
            $html = '
            <form role="search" method="get" class="searchform type-labeless" action="'.home_url('/').'" >
                <div>
                    <i class="fa fa-search"></i>
                    <input placeholder="'.$placeholder.'" type="text" value="'.get_search_query().'" name="s" />
                </div>
            </form>';
            break;
        case 'hidden':
            $html = '
            <form role="search" method="get" class="searchform type-hidden" action="'.home_url('/').'" >
                <div>
                    <i class="fa fa-search"></i>
                    <input placeholder="'.$placeholder.'" type="text" value="'.get_search_query().'" name="s" />
                </div>
            </form>';
            break;
        default:
            $html = 'No search form declared.';
    }
    echo $html;
}
// END Search Form - CROWN



// BEG Show Categories - WHITE - verified
function asdc_show_categories( $args ) {
    /*
     * Arguments:
     * get_terms();
     */
    $categories_result = get_categories( $args );
    echo '<ul>';
    foreach ( $categories_result as $category_item ) {
        $category_name = $category_item->name;
        $category_perma = get_category_link( $category_item->term_id );
        echo '<li><a href="' . $category_perma . '">' . $category_name . '</a></li>';
    }
    echo '</ul>';
}
// END Show Categories - WHITE - verified



// BEG Show Recent Posts - WHITE - verified
function asdc_show_recent_posts( $args, $type, $content ) {
    /*
     * posts_per_page
     * category
     */

    switch ( $type ) {
        case 'default':
            $recent_posts = get_posts( $args );
            global $post;
            foreach( $recent_posts as $post ) {
                setup_postdata( $post );
                get_template_part( $content, get_post_format() );
            }
            wp_reset_postdata();
            break;
        case 'category':
            $recent_posts = get_posts( $args );
            global $post;
            foreach( $recent_posts as $post ) {
                setup_postdata( $post );
                get_template_part( $content, get_post_format() );
            }
            wp_reset_postdata();
            break;
        case 'tag':
            $recent_posts = get_posts( $args );
            global $post;
            foreach( $recent_posts as $post ) {
                setup_postdata( $post );
                get_template_part( $content, get_post_format() );
            }
            wp_reset_postdata();
            break;
        case 'search':
            $recent_posts = get_posts( $args );
            global $post;
            foreach( $recent_posts as $post ) {
                setup_postdata( $post );
                get_template_part( $content, get_post_format() );
            }
            wp_reset_postdata();
            break;
        default:
            echo 'No type selected.';
    }
    global $got_nr_of_posts;
    $got_nr_of_posts = count( $recent_posts );
}
// END Show Recent Posts - WHITE - verified



// BEG Read more link - BRU
function asdc_read_more_link() {
    return '<a class="asdc-more-link" href="' . get_permalink() . '">READ MORE ></a>';
}
add_filter( 'the_content_more_link', 'asdc_read_more_link' );
// END Read more link - BRU



// BEG Social Media Sharing - BEA - verified
function asdc_sharing( $args ) {
    /*
     * Arguments:
     * permalink
     * label
     * share
     * type
     */
    $post_permalink = $args[ 'permalink' ];
    ?>
    <div class="share-wrapper">
        <div class="text"><?php echo $args[ 'label' ]; ?></div>
        <ul>
            <?php
            if ( $args[ 'type' ] == 'fa' ) {
                foreach( $args[ 'share' ] as $share ) {
                    switch ( $share ) {
                        case 'pinterest' :
                            ?>
                            <li><a target="_blank" href="https://pinterest.com/pin/create/button/?url=&media=&description=<?php echo $post_permalink; ?>"><i class="fa fa-pinterest-p"></i></a></li>
                            <?php
                            break;
                        case 'facebook' :
                            ?>
                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_permalink; ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php
                            break;
                        case 'twitter' :
                            ?>
                            <li><a target="_blank" href="https://twitter.com/home?status=<?php echo $post_permalink; ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php
                            break;
                        case 'mail' :
                            ?>
                            <li><a target="_blank" href="mailto:?subject=I wanted you to see this &amp;body=Check this out <?php echo $post_permalink; ?>"><i class="fa fa-envelope"></i></a></li>
                            <?php
                            break;
                        case 'bloglovin' :
                            ?>
                            <li><a target="_blank" href="#"><i class="fa fa-heart"></i></a></li>
                            <?php
                            break;
                    }
                }
            }
            else {
                foreach( $args[ 'share' ] as $share ) {
                    switch ( $share ) {
                        case 'pinterest' :
                            ?>
                            <li><a target="_blank" href="https://pinterest.com/pin/create/button/?url=&media=&description=<?php echo $post_permalink; ?>">pinterest</a></li>
                            <?php
                            break;
                        case 'facebook' :
                            ?>
                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_permalink; ?>">facebook</a></li>
                            <?php
                            break;
                        case 'twitter' :
                            ?>
                            <li><a target="_blank" href="https://twitter.com/home?status=<?php echo $post_permalink; ?>">twitter</a></li>
                            <?php
                            break;
                        case 'mail' :
                            ?>
                            <li><a target="_blank" href="mailto:?subject=I wanted you to see this &amp;body=Check this out <?php echo $post_permalink; ?>">email</a></li>
                            <?php
                            break;
                    }
                }
            }
            ?>
        </ul>
    </div>
    <?php
}
// END Social Media Sharing - BEA - verified



// BEG Excerpt Length - BRU
function asdc_excerpt_length ( $length ) {
    return 200;
}
add_filter( 'excerpt_length', 'asdc_excerpt_length', 999 );
// END Excerpt Length - BRU



// BEG Excerpt More - BRU
function asdc_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'asdc_excerpt_more' );
// END Excerpt More - BRU

// BEG Excerpt in pages - BALA
function asdc_add_excerpt_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'asdc_add_excerpt_to_pages' );
// END Excerpt in pages - BALA

// BEG Custom Excerpt length
function asdc_custom_excerpt( $limit ) {
    $excerpt = explode( ' ', get_the_excerpt(), $limit );
    if ( count( $excerpt ) >= $limit ) {
        array_pop( $excerpt );
        $excerpt = implode( " ", $excerpt ) . '...';
    }
    else {
        $excerpt = implode( " ", $excerpt );
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
// END Custom Excerpt length



////// BEG ASDC - MCE Editor - CROWN
// Enable advanced buttons
function asdc_mce_enable_buttons($buttons) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    $buttons[] = 'backcolor';
    $buttons[] = 'newdocument';
    $buttons[] = 'cut';
    $buttons[] = 'copy';
    $buttons[] = 'charmap';
    $buttons[] = 'hr';
    $buttons[] = 'visualaid';
    return $buttons;
}
add_filter('mce_buttons_3', 'asdc_mce_enable_buttons');

// Always show advanced buttons
function asdc_mce_show_advanced_buttons($in) {
    $in['wordpress_adv_hidden'] = FALSE;
    return $in;
}
add_filter('tiny_mce_before_init', 'asdc_mce_show_advanced_buttons');

// Add style to the editor
function asdc_editor_css() {
    add_editor_style('style-admin.css');
}
add_action('init', 'asdc_editor_css');

function asdc_mce_font_sizes($initArray){
    $initArray['font_formats'] = 'Karla=Karla;Didot=Didot;Didot Italic=Didot Italic;Didot Bold=Didot Bold';
    $initArray['fontsize_formats'] = "0 0.5em 0.6em 0.7em 0.8em 0.9em 1em 1.1em 1.2em 1.3em 1.5em 1.9em 2em 2.3em 3em 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 27px 28px 30px 32px 36px 40px 50px 60px 70px";
    return $initArray;
}
add_filter('tiny_mce_before_init', 'asdc_mce_font_sizes');
////// END ASDC - MCE Editor - CROWN



////// BEG Register Sidebars - BALA
add_action( 'widgets_init', 'asdc_register_sidebars' );
function asdc_register_sidebars() {
    register_sidebar(
        array(
            'name' => 'Instagram',
            'id' => 'instagram-sidebar',
            'description' => 'Place Instagram Widget here.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );
}
////// END Register Sidebars - BALA

// BEG ASDC Get YouTube ID - CAC
function asdc_get_yt_id( $url ) {
    $url_string = parse_url( $url, PHP_URL_QUERY );
    parse_str( $url_string, $args );
    return isset($args['v']) ? $args['v'] : false;
}
// END ASDC Get YouTube ID - CAC

//// BEG Meta Boxes - SAIL
// BEG Add Meta Boxes
function asdc_add_meta_boxes() {
    $screens = array( 'post' );
    foreach ( $screens as $screen ) {
//        add_meta_box(
//            'asdc-video-meta-box',
//            'YouTube Video',
//            'video_meta_box_callback',
//            $screen,
//            'side'
//        );
//        add_meta_box(
//            'asdc-gallery-meta-box',
//            'Gallery',
//            'gallery_meta_box_callback',
//            $screen,
//            'normal'
//        );
        add_meta_box(
            'asdc-hide-featured-image-meta-box',
            'Hide Featured Image',
            'hide_featured_image_meta_box_callback',
            $screen,
            'side'
        );
        add_meta_box(
            'asdc-second-featured-image-meta-box',
            'Second Featured Image',
            'second_featured_image_meta_box_callback',
            $screen,
            'side'
        );
        add_meta_box(
            'asdc-third-featured-image-meta-box',
            'Third Featured Image',
            'third_featured_image_meta_box_callback',
            $screen,
            'side'
        );
    }
}
//add_action( 'add_meta_boxes', 'asdc_add_meta_boxes' );

// BEG Print - Video - Meta Box
function video_meta_box_callback( $post ) {
    $this_meta_name = 'video';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
    );
    echo '<p class="howto">Insert the full YouTube video URL</p>';
    asdc_dash_builder::asdcdb_input( $this_meta_args );
}
// END Print - Video - Meta Box

// BEG Print - Hide Featured Image - Meta Box
function hide_featured_image_meta_box_callback( $post ) {
    $this_meta_name = 'hide_featured_image';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'default' => false,
        'description' => 'Set YES to hide the Featured Image/Video on the Single Post/Page',
        'on' => 'YES',
        'off' => 'NO'
    );
    asdc_dash_builder::asdcdb_switch( $this_meta_args );
}
// END Print - Hide Featured Image - Meta Box

// BEG Print - Gallery - Meta Box
function gallery_meta_box_callback( $post ) {
    $this_meta_name = 'gallery';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $settings = array(
        'multiple' => 1,
        'multiple_key' => 'image',
        'multiple_text_remove' => 'Remove Image',
    );
    asdc_dash_builder::asdcdb_sortbable_area( 'open' );
    ?>
    <script>var asdcTemplateDir = '<?php echo plugin_dir_url( '' )  . 'asdc-settings/includes/'; ?>';</script>
    <div class="asdc-button small green asdc-fa plus margin-bot-10" onclick="asdc_clone_row( this );">Add Image</div>
    <?php
    if ( $settings[ 'multiple' ] == 1 ) {
        $key_id = $settings[ 'multiple_key' ];
        $nr_items = count( $this_meta_value[ $key_id ] );
        if ( $nr_items == 0 ) {$nr_items = 1;}
        for( $i = 0; $i < $nr_items; $i++ ) {
            echo '<div class="asdc-row-to-clone">';
            $this_meta_multiple_id = 'image';
            $this_meta_multiple_sql = $this_meta_sql . '[' . $this_meta_multiple_id . '][]';
            $this_meta_multiple_value = $this_meta_value[$this_meta_multiple_id][$i];
            $this_meta_args = array(
                'sql-name' => $this_meta_multiple_sql,
                'value' => $this_meta_multiple_value,
            );
            asdc_dash_builder::asdcdb_image_selector( $this_meta_args );
            echo '<br>';
            echo '<div class="asdc-button small red asdc-fa minus" onclick="asdc_remove_row( this );">' . $settings[ 'multiple_text_remove' ] . '</div>';
            echo '</div>';
        }
    }
    asdc_dash_builder::asdcdb_sortbable_area( 'close' );
}
// END Print - Gallery - Meta Box

// BEG Print - Second Featured Image - Meta Box
function second_featured_image_meta_box_callback( $post ) {
    $this_meta_name = 'second_featured_image';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
    );
    echo '<p class="howto">Add another Featured Image</p>';
    asdc_dash_builder::asdcdb_image_selector( $this_meta_args );
}
// END Print - Second Featured Image - Meta Box

// BEG Print - Third Featured Image - Meta Box
function third_featured_image_meta_box_callback( $post ) {
    $this_meta_name = 'third_featured_image';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
    );
    echo '<p class="howto">Add another Featured Image</p>';
    asdc_dash_builder::asdcdb_image_selector( $this_meta_args );
}
// END Print - Third Featured Image - Meta Box

// BEG Print - Banner Caption - Meta Box
function banner_caption_meta_box_callback( $post ) {
    $this_meta_name = 'banner_caption';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'editor-id' => 'banner-caption',
        'textarea_rows' => 10,
    );
    asdc_dash_builder::asdcdb_editor( $this_meta_args );
}
// END Print - Banner Caption - Meta Box

// BEG Print - Project URL - Meta Box
function project_url_meta_box_callback( $post ) {
    $this_meta_name = 'project_url';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
    );
    asdc_dash_builder::asdcdb_input( $this_meta_args );
}
// END Print - Project URL - Meta Box

// BEG Print - Project Type - Meta Box
function project_type_meta_box_callback( $post ) {
    $this_meta_name = 'project_type';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_selector_args = array();
    $t_m_tags_get = wp_get_post_terms( $post->ID, 'project-tag', '' );
    foreach ( $t_m_tags_get as $tag ) {
        $this_meta_selector_args[$tag->term_id]=$tag->name;
    }
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'selector-options' => $this_meta_selector_args,
        'description' => 'If the tag is not here UPDATE the project.',
    );
    asdc_dash_builder::asdcdb_selector( $this_meta_args );
}
// END Print - Project Type - Meta Box

// BEG Print - Feed Title - Meta Box
function feed_title_meta_box_callback( $post ) {
    $this_meta_name = 'feed_title';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
        'description' => 'This is used to replace GET THE TOUR >',
    );
    asdc_dash_builder::asdcdb_input( $this_meta_args );
}
// END Print - Feed Title - Meta Box

// BEG Print - Monitor Template - Meta Box
function monitor_meta_box_callback( $post ) {
    $this_meta_name = 'monitor';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'default' => true,
        'description' => 'Leave ON to use the Monitor template',
    );
    asdc_dash_builder::asdcdb_switch( $this_meta_args );
}
// END Print - Monitor Template - Meta Box

// BEG Print - Coming Soon - Meta Box
function coming_soon_meta_box_callback( $post ) {
    $this_meta_name = 'coming_soon';
    wp_nonce_field( $this_meta_name . '_meta_box', $this_meta_name . '_meta_box_nonce' );
    $this_meta_sql = $this_meta_name . '_meta_field';
    $this_meta_value = get_post_meta( $post->ID, '_meta_value_' . $this_meta_name, true );
    $this_meta_value = unserialize( $this_meta_value );
    $this_meta_value = wp_unslash( $this_meta_value );
    $this_meta_args = array(
        'sql-name' => $this_meta_sql,
        'value' => $this_meta_value,
        'css-input' => 'asdc-width-full',
    );
    asdc_dash_builder::asdcdb_input( $this_meta_args );
}
// END Print - Coming Soon - Meta Box



// BEG Save - Meta Box
function general_save_meta_box( $post_id ) {
    $meta_box_names = array(
        'video',
        'hide_featured_image',
        'gallery',
        'second_featured_image',
        'third_featured_image',
        'banner_caption',
        'project_url',
        'project_type',
        'feed_title',
        'monitor',
        'coming_soon',
    );

    foreach( $meta_box_names as $meta_box_name ) {
        if ( ! isset( $_POST[ $meta_box_name . '_meta_box_nonce' ] ) ) { continue; }
        if ( ! wp_verify_nonce( $_POST[ $meta_box_name . '_meta_box_nonce' ], $meta_box_name . '_meta_box' ) ) { continue; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { continue; }
        if ( isset( $_POST[ 'post_type' ] ) && 'page' == $_POST[ 'post_type' ] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { continue; }
        }
        else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { continue; }
        }
        if ( ! isset( $_POST[ $meta_box_name . '_meta_field' ] ) ) {continue;}
        $meta_box_name_meta_arr = $_POST[ $meta_box_name . '_meta_field' ];
        $update_value = serialize( $meta_box_name_meta_arr );
        //$my_data = sanitize_text_field( $update_value );
        //$my_data = $update_value;
        $my_data = wp_slash( $update_value );
        update_post_meta( $post_id, '_meta_value_' . $meta_box_name, $my_data );
    }
}
add_action( 'save_post', 'general_save_meta_box' );
// END Save - Meta Box
//// END Meta Boxes - SAIL

class asdc_simple_dash_builder {

    public function __construct() {

    }

    // BEG Input
    public static function asdc_sdb_input( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * css-input
         * description
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-input simple-builder">
            <?php
            // Show description
            if ( $args[ 'description' ] != '' ) {
                echo '<p class="description"><em>' . $args[ 'description' ] . '</em></p>';
            }

            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            $input_css = isset( $args[ 'css-input' ] ) ? $args[ 'css-input' ] : '';
            ?>
            <input class="regular-text <?php echo $input_css; ?>" type="text" value="<?php echo $this_setting_value; ?>" name="<?php echo $this_setting_sql_name; ?>" />
        </div>
    <?php
    }
    // END Input


    // BEG Image Selector
    public static function asdc_sdb_image_selector( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <script>var asdcTemplateDir = '<?php echo plugin_dir_url()  . 'asdc-settings/includes/'; ?>';</script>
        <div class="admin-row asdc-builder-image-selector simple-builder">
            <?php
            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            ?>
            <input class="hidden-input" value="<?php echo $this_setting_value; ?>" type="hidden" name="<?php echo $this_setting_sql_name; ?>" />
            <div class="image-preview">
                <?php
                $image_error = 0;
                if ( $this_setting_value ) {
                    $image = wp_get_attachment_image( $this_setting_value, 'thumbnail' );
                    if ( $image != '' ) {echo $image;}
                    else {$image_error = 1;}
                }
                else {$image_error = 1;}
                if ( $image_error == 1 ) {
                    ?>
                    <img width="64" height="64" src="<?php echo plugin_dir_url() . 'asdc-settings/includes/images/asdc-no-image.png'; ?>" />
                    <?php
                }
                ?>
            </div>
            <div class="buttons-holder">
                <div class="button button-small select-image-button">Change</div>
                <div class="button button-small" onclick="asdc_remove_selected_image( this );">Remove</div>
            </div>
        </div>
        <?php
    }
    // END Image Selector

    // BEG Editor
    public static function asdc_sdb_editor( $args ) {
        /*
         * sql-name
         * value
         * label
         * css-label
         * editor-id: MANDATORY
         * media: false, true
         * textarea_rows
         * description
         */

        $this_setting_sql_name = $args[ 'sql-name' ];
        $this_setting_value = $args[ 'value' ];
        ?>
        <div class="admin-row asdc-builder-editor simple-builder">
            <?php
            // Show description
            if ( $args[ 'description' ] != '' ) {
                echo '<p class="description"><em>' . $args[ 'description' ] . '</em></p>';
            }

            // Show label
            if ( $args[ 'label' ] != '' ) {
                $label_css = isset( $args[ 'css-label' ] ) ? $args[ 'css-label' ] : '';
                echo '<label class="' . $label_css . '">' . $args[ 'label' ] . '</label>';
            }
            $editor_args = array(
                'wpautop' => false,
                'media_buttons' => $args[ 'media' ],
                'textarea_name' => $this_setting_sql_name,
                'textarea_rows' => $args[ 'textarea_rows' ],
            );
            wp_editor( html_entity_decode( $this_setting_value ), $args[ 'editor-id' ], $editor_args );
            ?>
        </div>
        <?php
    }
    // END Editor

    // BEG Sortbable Area
    public static function asdc_sdb_sortbable_area( $tag ) {
        if ( $tag == 'open' ) {
            echo '<div class="asdc-sortable">';
        }
        else if ( $tag == 'close' ) {
            echo '</div>';
        }
    }
    // END Sortbable Area
}
if( is_admin() ) {
    $asdc_simple_dash_builder = new asdc_simple_dash_builder();
}



function asdc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'asdc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'asdc_remove_wp_ver_css_js', 9999 );



function asdc_blog_navigation( $args ) {
    /*
     * prev
     * next
     * separator
     */

    if( ! get_next_posts_link() && ! get_previous_posts_link() ) {
        return;
    }
    $prev_p_text = ( isset( $args[ 'prev' ] ) ) ? $args[ 'prev' ] : 'previous';
    $next_p_text = ( isset( $args[ 'next' ] ) ) ? $args[ 'next' ] : 'next';
    ?>
    <nav class="navigation">
        <div class="left-part">
            <?php
            next_posts_link( '<div class="nav-more prev"><i></i><span>' . $next_p_text . '</span></div>' );
            ?>
        </div>
        <?php
        if ( $args[ 'separator' ] == true ) {
            echo '<div class="part separator">' . $args[ 'separator-text' ] . '</div>';
        }
        ?>
        <div class="right-part">
            <?php
            previous_posts_link( '<div class="nav-more next"><span>' . $prev_p_text . '</span><i></i></div>' );
            ?>
        </div>
        <div class="asdc-clear"></div>
    </nav>
    <?php
}

function asdc_post_navigation( $args ) {
    /*
     * prev
     * next
     * separator
     * separator-text
     */
    
    if ( ! get_next_post_link() && ! get_previous_post_link() ) {
        return;
    }
    $prev_p_text = ( isset( $args[ 'prev' ] ) ) ? $args[ 'prev' ] : 'previous';
    $next_p_text = ( isset( $args[ 'next' ] ) ) ? $args[ 'next' ] : 'next';
    ?>
    <nav class="navigation">
        <div class="part left">
            <?php
            previous_post_link( '<div class="nav-more prev">%link</div>', '<i></i><span>' . $prev_p_text . '</span>', false );
            ?>
        </div>
        <?php
        if ( $args[ 'separator' ] == true ) {
            if ( get_next_post_link() && get_previous_post_link() ) {
                echo '<div class="part separator">' . $args[ 'separator-text' ] . '</div>';
            }
        }
        ?>
        <div class="part right">
            <?php
            next_post_link( '<div class="nav-more next">%link</div>', '<span>' . $next_p_text . '</span><i></i>', false );
            ?>
        </div>
        <div class="asdc-clear"></div>
    </nav>
    <?php
}

function asdc_set_popup_cookie() {
    global $asdc_settings_theme;
    $asdc_popup_cookie = $asdc_settings_theme['advanced_section']['popup-cookie']['text'];
    if ( $asdc_popup_cookie != '' ) {
        $cookie_value = 1;
        $cookie_duration = ( $asdc_settings_theme['advanced_section']['popup-cookie-time']['text'] != '' ) ? $asdc_settings_theme['advanced_section']['popup-cookie']['text'] : 7;
        $cookie_name = $asdc_popup_cookie;
        setcookie( $cookie_name, $cookie_value, time() + ( 86400 * $cookie_duration ), "/" ); // 86400 = 1 day
    }
}
add_action( 'init', 'asdc_set_popup_cookie');

// BEG Pagination - BEA
// show page numbers and navigation
function asdc_blog_pagination() {
    global $wp_query;
    $big = 999999999;
    $args = array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'show_all'           => false,
        'end_size'           => 1,
        'mid_size'           => 7,
        'prev_next'          => true,
        'prev_text'          => '<< PREVIOUS PAGE',
        'next_text'          => 'NEXT PAGE >>',
        'type'               => 'plain',
        'add_args'           => false,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => ''
    );
    echo paginate_links($args);
}
// END Pagination - BEA

// BEG ASDC PASS - CROWN
function asdc_pass() {
    global $asdc_settings_theme;
    $asdc_pass = $asdc_settings_theme['asdc_pass_section']['lock']['switch'];
    if ($asdc_pass == 1) {
        $asdc_pass_password = $asdc_settings_theme['asdc_pass_section']['pass']['text'];
        if ($_GET['password'] == $asdc_pass_password) {
            $cookie_value = 1;
            $cookie_duration = 7;
            $cookie_name = 'asdcpassword';
            setcookie($cookie_name, $cookie_value, time() + (86400 * $cookie_duration), "/"); // 86400 = 1 day
        } else {
            if(!isset($_COOKIE['asdcpassword'])) {
                include('asdc-maintenance.php');
            }
        }
    }
}
// END ASDC PASS - CROWN

//require( 'functions-custom.php' );
//flush_rewrite_rules();




?>