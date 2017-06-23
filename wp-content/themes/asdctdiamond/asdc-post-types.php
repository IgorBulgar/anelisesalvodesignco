<?php
/*
 * Post types
 * File Version 15.0.0
 * Theme Version 15.0.2
 */

// Adding new post types
function asdc_register_post_types() {
    $t_p_name = 'Restaurant';
    register_post_type('restaurant',
        array(
            'labels' => array(
                'name' => 'Restaurants',
                'singular_name' => $t_p_name,
                'add_new_item' => 'Add New '.$t_p_name,
                'edit_item' => 'Edit '.$t_p_name,
                'new_item' => 'New '.$t_p_name,
                'view_item' => 'View '.$t_p_name
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-store',
            'rewrite' => array(
                'with_front' => false,
            ),
            'supports' => array('title', 'thumbnail', 'editor')
        )
    );
}
add_action('init', 'asdc_register_post_types');

// Adding taxonomies
function asdc_register_taxonomies() {
    $t_t_name = 'Category';
    $t_t_name_pl = 'Categories';
    $labels = array(
        'name' => $t_t_name_pl,
        'singular_name' => $t_t_name,
        'search_items' => 'Search '.$t_t_name_pl,
        'popular_items' => 'Popular '.$t_t_name_pl,
        'all_items' => 'All '.$t_t_name_pl,
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => 'Edit '.$t_t_name,
        'update_item' => 'Update '.$t_t_name,
        'add_new_item' => 'Add New '.$t_t_name,
        'new_item_name' => 'New Tag '.$t_t_name,
        'separate_items_with_commas' => 'Separate '.$t_t_name_pl.' with commas',
        'add_or_remove_items' => 'Add or remove '.$t_t_name_pl,
        'choose_from_most_used' => 'Choose from the most used '.$t_t_name_pl,
        'menu_name' => $t_t_name_pl
    );
    register_taxonomy('restaurant-category', 'restaurant', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'restaurant-category', 'with_front' => false),
    ));

    $t_t_name = 'Cuisine';
    $t_t_name_pl = 'Cuisines';
    $labels = array(
        'name' => $t_t_name_pl,
        'singular_name' => $t_t_name,
        'search_items' => 'Search '.$t_t_name_pl,
        'popular_items' => 'Popular '.$t_t_name_pl,
        'all_items' => 'All '.$t_t_name_pl,
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => 'Edit '.$t_t_name,
        'update_item' => 'Update '.$t_t_name,
        'add_new_item' => 'Add New '.$t_t_name,
        'new_item_name' => 'New Tag '.$t_t_name,
        'separate_items_with_commas' => 'Separate '.$t_t_name_pl.' with commas',
        'add_or_remove_items' => 'Add or remove '.$t_t_name_pl,
        'choose_from_most_used' => 'Choose from the most used '.$t_t_name_pl,
        'menu_name' => $t_t_name_pl
    );
    register_taxonomy('restaurant-cuisine', 'restaurant', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'restaurant-cuisine', 'with_front' => false),
    ));

    $t_t_name = 'Diet';
    $t_t_name_pl = 'Diets';
    $labels = array(
        'name' => $t_t_name_pl,
        'singular_name' => $t_t_name,
        'search_items' => 'Search '.$t_t_name_pl,
        'popular_items' => 'Popular '.$t_t_name_pl,
        'all_items' => 'All '.$t_t_name_pl,
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => 'Edit '.$t_t_name,
        'update_item' => 'Update '.$t_t_name,
        'add_new_item' => 'Add New '.$t_t_name,
        'new_item_name' => 'New Tag '.$t_t_name,
        'separate_items_with_commas' => 'Separate '.$t_t_name_pl.' with commas',
        'add_or_remove_items' => 'Add or remove '.$t_t_name_pl,
        'choose_from_most_used' => 'Choose from the most used '.$t_t_name_pl,
        'menu_name' => $t_t_name_pl
    );
    register_taxonomy('restaurant-diet', 'restaurant', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'restaurant-diet', 'with_front' => false),
    ));
}
add_action('init', 'asdc_register_taxonomies', 0);