<?php
/*
 * Meta Boxes
 * File Version 15.0.0
 * Theme Version 15.0.2
 */

// Declaring meta boxes
function asdc_get_custom_meta_boxes() {
    $boxes = array(
        array(
            'id' => 'asdc_locations',
            'name' => 'Locations',
            'callback' => 'locations_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_website',
            'name' => 'Website',
            'callback' => 'website_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_closed',
            'name' => 'Closed',
            'callback' => 'closed_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_price',
            'name' => 'Price',
            'callback' => 'price_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_rating',
            'name' => 'Rating',
            'callback' => 'rating_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_table',
            'name' => 'Find a table',
            'callback' => 'table_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
        array(
            'id' => 'asdc_stats',
            'name' => 'Stats',
            'callback' => 'stats_custom',
            'position' => 'side',
            'screen' => array(
                'restaurant'
            )
        ),
//        array(
//            'id' => 'asdc_banner',
//            'name' => 'Banner',
//            'callback' => 'banner_custom',
//            'position' => 'side',
//            'screen' => array(
//                'page'
//            )
//        ),
//        array(
//            'id' => 'asdc_project_url',
//            'name' => 'Project URL',
//            'callback' => 'project_url_custom',
//            'position' => 'side',
//            'screen' => array(
//                'project'
//            )
//        ),
//        array(
//            'id' => 'asdc_gallery',
//            'name' => 'Gallery',
//            'callback' => 'gallery_custom',
//            'position' => 'normal',
//            'screen' => array(
//                'project'
//            )
//        )
    );
    return $boxes;
}

// Adding meta boxes
function asdc_add_custom_meta_boxes() {
    $meta_boxes = asdc_get_custom_meta_boxes();
    foreach($meta_boxes as $meta_box) {
        foreach($meta_box['screen'] as $screen) {
            add_meta_box(
                $meta_box['id'].'_meta_box',
                $meta_box['name'],
                $meta_box['callback'].'_meta_box_callback',
                $screen,
                $meta_box['position']
            );
        }
    }
}
add_action('add_meta_boxes', 'asdc_add_custom_meta_boxes');

// Saving meta boxes
function asdc_save_custom_meta_boxes($post_id) {
    $meta_boxes = asdc_get_custom_meta_boxes();
    foreach($meta_boxes as $meta_box) {
        $meta_box_name = $meta_box['id'];
        if(!isset($_POST[$meta_box_name.'_meta_box_nonce'])) {continue;}
        if(!wp_verify_nonce($_POST[$meta_box_name.'_meta_box_nonce'], $meta_box_name.'_meta_box')) {continue;}
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {continue;}
        if(isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
            if(!current_user_can('edit_page', $post_id)) {continue;}
        } else {
            if(!current_user_can('edit_post', $post_id)) {continue;}
        }
        if (!isset($_POST[$meta_box_name.'_meta_field'])) {continue;}
        $meta_box_name_meta_arr = $_POST[$meta_box_name.'_meta_field'];
        $update_value = serialize($meta_box_name_meta_arr);
        $my_data = wp_slash($update_value);
        update_post_meta($post_id, '_meta_value_'.$meta_box_name, $my_data);
    }
}
add_action('save_post', 'asdc_save_custom_meta_boxes');

// Banner meta box
function banner_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_banner';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value
    );
    asdcDashboardBuilder::photo($this_meta_args);
}

// Project URL meta box
function project_url_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_project_url';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value
    );
    asdcDashboardBuilder::input($this_meta_args);
}

// Gallery meta box
function gallery_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_gallery';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'options' => $t_meta_value,
        'setting' => array(
            'name' => $t_meta_sql,
            'title' => 'Gallery',
            'clone' => true,
            'sort' => true,
            'inputs' => array(
                array(
                    'type' => 'photo',
                    'id' => 'image'
                ),
                array(
                    'type' => 'input',
                    'id' => 'title',
                    'label' => 'Title'
                )
            )
        ),

    );
    asdcDashboardBuilder::process_setting($this_meta_args);
}

// Locations meta box
function locations_custom_meta_box_callback($post) {
    if(get_current_user_id() != 1) {
        echo 'Under Development';
        return;
    }
    // get all states
    // reload button
    // add new button

    $t_meta_id = 'asdc_locations';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);

    print_r($t_meta_value);





    ?>
    <div class="asdc-builder-cloning">
        <div class="asdc-button green asdc-fa plus" onclick="asdc_add_clone(this);">Add Location</div>
        <?php

        for($i = 0; $i < count($t_meta_value['state']); $i++) {
            ?>
            <div class="asdc-builder-clone">
                <?php
                $this_meta_args = array(
                    'css_label' => 'small',
                    'label' => 'State',
                    'name' => $t_meta_sql.'[state][]',
                    'value' => $t_meta_value['state'][$i],
                    'selector_options' => array(
                        'test-1' => 'Test 1',
                        'test-2' => 'Test 2'
                    )
                );
                asdcDashboardBuilder::selector($this_meta_args);
                ?>
                <div class="asdc-button red asdc-fa minus" onclick="asdc_remove_clone(this);">Remove Location</div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="asdc-button green asdc-fa plus" onclick="asdc_restaurant_locations('state','add');">Register State</div><br>
<!--    <div class="asdc-button green asdc-fa plus" onclick="asdc_restaurant_locations('city','add');">Register City</div><br>-->
<!--    <div class="asdc-button green asdc-fa plus" onclick="asdc_restaurant_locations('neighborhood','add');">Register Neighborhood</div>-->
    <form id="asdc-locations-register">
        <?php
        $this_meta_args = array(
            'css_label' => 'small',
            'label' => 'State',
            'name' => 'register-state',
            'value' => '',
        );
        asdcDashboardBuilder::input($this_meta_args);
        $this_meta_args = array(
            'css_label' => 'small',
            'label' => 'City',
            'name' => 'register-city',
            'value' => '',
        );
        //asdcDashboardBuilder::input($this_meta_args);
        $this_meta_args = array(
            'css_label' => 'small',
            'label' => 'Neighborhood',
            'name' => 'register-neighborhood',
            'value' => '',
        );
        //asdcDashboardBuilder::input($this_meta_args);
        ?>
        <button type="submit" class="asdc-button green asdc-fa plus" onclick="asdc_restaurant_locations('all','save');">Save</button><br><br>
    </form>
    <?php






//    global $wpdb;
//    $table_name = $wpdb->prefix.'TABLE-NAME-HERE';
//    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
//        //table not in database. Create new table
//        $charset_collate = $wpdb->get_charset_collate();
//
//        $sql = "CREATE TABLE $table_name (
//          id mediumint(9) NOT NULL AUTO_INCREMENT,
//          field_x text NOT NULL,
//          field_y text NOT NULL,
//          UNIQUE KEY id (id)
//     ) $charset_collate;";
//        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//        dbDelta( $sql );
//    }
    


    
}

// Website meta box
function website_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_website';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value
    );
    asdcDashboardBuilder::input($this_meta_args);
}

// Closed meta box
function closed_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_closed';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value,
        'label' => 'Yes'
    );
    asdcDashboardBuilder::checkbox($this_meta_args);
}

// Price meta box
function price_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_price';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value,
        'selector_options' => array(
            1 => '$',
            2 => '$$',
            3 => '$$$',
            4 => '$$$$'
        )
    );
    asdcDashboardBuilder::selector($this_meta_args);
}

// Rating meta box
function rating_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_rating';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value,
        'selector_options' => array(
            5 => 5,
            4 => 4,
            3 => 3,
            2 => 2,
            1 => 1
        )
    );
    asdcDashboardBuilder::selector($this_meta_args);
}

// Find a table meta box
function table_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_table';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);
    $this_meta_args = array(
        'name' => $t_meta_sql,
        'value' => $t_meta_value
    );
    asdcDashboardBuilder::input($this_meta_args);
}

// Stats meta box
function stats_custom_meta_box_callback($post) {
    $t_meta_id = 'asdc_stats';
    wp_nonce_field($t_meta_id.'_meta_box', $t_meta_id.'_meta_box_nonce');
    $t_meta_sql = $t_meta_id.'_meta_field';
    $t_meta_value = get_post_meta($post->ID, '_meta_value_'.$t_meta_id, true);
    $t_meta_value = unserialize($t_meta_value);
    $t_meta_value = wp_unslash($t_meta_value);

    $this_meta_args = array(
        'name' => $t_meta_sql.'[menu]',
        'value' => $t_meta_value['menu'],
        'label' => 'Gluten free menu: ',
        'css_label' => 'medium',
        'on' => 'Yes',
        'off' => 'No'
    );
    asdcDashboardBuilder::cool_switch($this_meta_args);

    $this_meta_args = array(
        'name' => $t_meta_sql.'[bread]',
        'value' => $t_meta_value['bread'],
        'label' => 'Gluten free bread: ',
        'css_label' => 'medium',
        'on' => 'Yes',
        'off' => 'No'
    );
    asdcDashboardBuilder::cool_switch($this_meta_args);

    $this_meta_args = array(
        'name' => $t_meta_sql.'[pizza]',
        'value' => $t_meta_value['pizza'],
        'label' => 'Gluten free pizza: ',
        'css_label' => 'medium',
        'on' => 'Yes',
        'off' => 'No'
    );
    asdcDashboardBuilder::cool_switch($this_meta_args);

    $this_meta_args = array(
        'name' => $t_meta_sql.'[pasta]',
        'value' => $t_meta_value['pasta'],
        'label' => 'Gluten free pasta: ',
        'css_label' => 'medium',
        'on' => 'Yes',
        'off' => 'No'
    );
    asdcDashboardBuilder::cool_switch($this_meta_args);
}
