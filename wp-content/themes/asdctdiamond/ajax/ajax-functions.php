<?php
/*
* AJAX Functions
* File Version 2.1.0
* Theme Version 6.6.0
*/

// BEG Load More Posts Processor - CEA
function asdc_load_more_posts_processor() {
    if ( $_POST[ 'loadType' ] == 'category' ) {
        $args = array(
            'category' => $_POST[ 'category' ],
            'posts_per_page' => $_POST[ 'nrOfPosts' ],
            'offset' => $_POST[ 'offset' ],
        );
    }
    else if ( $_POST[ 'loadType' ] == 'tag' ) {
        $args = array(
            'posts_per_page' => $_POST[ 'nrOfPosts' ],
            'offset' => $_POST[ 'offset' ],
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id',
                    'terms'    => $_POST[ 'tag' ],
                ),
            ),
        );
    }
    else if ( $_POST[ 'loadType' ] == 'search' ) {
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            's' => $_POST[ 'searchQuery' ],
            'posts_per_page' => $_POST[ 'nrOfPosts' ],
            'offset' => $_POST[ 'offset' ],
        );
    }
    else if ( $_POST[ 'loadType' ] == 'all' ) {
        $args = array(
            'posts_per_page' => $_POST[ 'nrOfPosts' ],
            'offset' => $_POST[ 'offset' ],
        );
    }
    else {
        $args = 'error-load-type-unknown';
    }
    return $args;
}
// END Load More Posts Processor

// BEG Ajax Load More Posts - CEA
add_action( 'wp_ajax_asdc_load_more_posts', 'asdc_load_more_posts_callback' );
add_action( 'wp_ajax_nopriv_asdc_load_more_posts', 'asdc_load_more_posts_callback' );
function asdc_load_more_posts_callback() {
    $type = $_POST[ 'recentType' ];
    $content = $_POST[ 'contentType' ];
    $args = asdc_load_more_posts_processor();
    if ( $args == 'error-load-type-unknown' ) {
        echo 'Error: Load type unknown.';
        wp_die();
    }
    asdc_show_recent_posts( $args, $type, $content );
    wp_die();
}
// END Ajax Load More Posts - CEA

// BEG Ajax Load More Posts Future - CEA
add_action( 'wp_ajax_asdc_load_more_posts_future', 'asdc_load_more_posts_future_callback' );
add_action( 'wp_ajax_nopriv_asdc_load_more_posts_future', 'asdc_load_more_posts_future_callback' );
function asdc_load_more_posts_future_callback() {
    $args = asdc_load_more_posts_processor();
    if ( $args == 'error-load-type-unknown' ) {
        echo 'Error: Load type unknown.';
        wp_die();
    }
    $recent_posts = get_posts( $args );
    if ( count( $recent_posts ) < 1 ) {
        echo 'false';
    }
    wp_die();
}
// END Ajax Load More Posts Future - CEA
?>