<?php
/*
* Search Page
* File Version 4.0.0
* Theme Version 13.1.0
*/

get_header();

?>
<div id="asdc-search-page">
    <?php
    $search_page_nr_results = -1;
    $search_query = get_search_query();
    $search_query_args = array(
        'post_type' => array(
            'post',
            'page',
        ),
        'post_status' => 'publish',
        's' => $search_query,
        'posts_per_page' => $search_page_nr_results,
        'offset' => 0,
        'orderby' => 'type title',
        'order' => 'ASC',
    );
    $search_result_get = new WP_Query( $search_query_args );
    ?>
    <div class="taxonomy-page-wrap search limited-width-default">
        <div class="taxonomy-heading-wrap search">
            <?php
            if ( $search_query != '' ) {
                ?>
                <h1 class="taxonomy-title search">SEARCH: <?php echo $search_query; ?></h1>
                <?php
            }
            else {
                ?>
                <h1 class="taxonomy-title search no-q"><span>search</span></h1>
                <?php
            }
            ?>
        </div>
        <?php
        if ( ! $search_result_get->have_posts() ) {
            ?>
            <div class="asdc-error-message search">
                <p>Looks like nothing was found. Want to search again?</p>
                <?php
                asdc_show_search_form( 'no-label', '' );
                ?>
            </div>
            <?php
        }
        if ( $search_query == '' ) {
            ?>
            <div class="asdc-error-message search">
                <p>What would you like to search for?</p>
                <?php
                asdc_show_search_form( 'no-label', '' );
                ?>
            </div>
            <?php
        }
        ?>
        <?php
        // Check if there are any results
        if ( $search_result_get->have_posts() && $search_query != '' ) {
            $pages_arr = array();
            ?>
            <div class="posts-feed taxonomy-feed search search-posts">
                <?php
                global $post;
                foreach ($search_result_get->posts as $post) {
                    setup_postdata($post);
                    if ( $post->post_type == 'post' ) {
                        get_template_part( 'content-blog', get_post_format() );
                    }
                    else {
                        $pages_arr[] = $post;
                    }
                }
                wp_reset_postdata();
                ?>
                <div class="asdc-clear"></div>
            </div>
            <?php
            if ( count( $pages_arr ) > 0 ) {
                ?>
                <div class="posts-feed taxonomy-feed search search-pages">
                <?php
                foreach ( $pages_arr as $post ) {
                    setup_postdata( $post );
                    if ( $post->post_type == 'page' ) {
                        get_template_part( 'content-blog', get_post_format() );
                    }
                }
                wp_reset_postdata();
            }
        }
        ?>
    </div>
</div>
<?php

get_footer();

?>