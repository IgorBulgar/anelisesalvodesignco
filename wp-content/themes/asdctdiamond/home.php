<?php
/*
* Home - Posts Page
* File Version 4.0.0
* Theme Version 13.0.3
*/

get_header();

?>
    <div id="home-page">
        <div class="page-holder home-page limited-width-default">
            <div class="blog-header">
                <div class="category-list-heading">
                    <?php
                    $args = array(
                        'hide_empty' => 1,
                        'parent' => 0,
//                        'exclude' => 1222,
                        'order' => 'DESC'
                    );
                    $categories_result = get_categories( $args );
                    echo '<ul>';
                    foreach ($categories_result as $category_item) {
                        $category_name = $category_item->name;
                        $category_perma = get_category_link($category_item->term_id);
                        $subcategories_args = array(
                            'hide_empty' => 1,
                            'parent' => $category_item->term_id,
                        );
                        $subcategories = get_categories($subcategories_args);
                        if (count($subcategories) > 0) {
                            $li_class = 'has-children';
                        }
                        else {
                            $li_class = '';
                        }

                        echo '<li class="'.$li_class.'"><a href="' . $category_perma . '">' . $category_name . '</a>';
                        if (count($subcategories) > 0) {
                            echo '<ul class="sub-menu">';
                            foreach ($subcategories as $sub_item) {
                                $sub_name = $sub_item->name;
                                $sub_perma = get_category_link($sub_item->term_id);
                                echo '<li><a href="' . $sub_perma . '">' . $sub_name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
                <div class="blog-search-bar">
                    <?php
                    asdc_show_search_form('default', '');
                    ?>
                </div>
            </div>
            <div class="blog-feed-holder posts-feed">
                <?php
                $blog_posts_feed_type = 'pagination';
                if ( $blog_posts_feed_type == 'ajax' ) {
                    ?>
                    <div id="asdc-ajax-loader-recent" class="asdc-ajax-loader-wrap">
                        <?php
                        // BEG LOAD LATEST POSTS - X - verified
                        global $asdc_settings;
                        $blog_number_of_posts = get_option( 'posts_per_page' );
                        $args = array(
                            'posts_per_page' => $blog_number_of_posts
                        );
                        $type = 'default'; // default, category, search
                        $contentType = 'content-blog'; // Types of content.php
                        $loadType = 'all'; // all, category, search
                        $loadCategoryID = ''; // the ID of the category
                        $current_nr = 0; // Initial offset
                        $loaderID = 'recent';
                        asdc_show_recent_posts( $args, $type, $contentType );
                        $verify_load_more = false;
                        $show_load_more = false;
                        if ( $verify_load_more == true ) {
                            global $got_nr_of_posts;
                            if ( $got_nr_of_posts == $blog_number_of_posts ) {
                                $more_args = array(
                                    'posts_per_page' => 1,
                                    'offset' => $blog_number_of_posts,
                                );
                                $get_load_more = get_posts( $more_args );
                                if ( count( $get_load_more ) > 0 ) {
                                    $show_load_more = true;
                                }
                            }
                        }
                        // END LOAD LATEST POSTS - X - verified
                        ?>
                    </div>
                    <?php
                    if ( $show_load_more == true ) {
                        ?>
                        <div class="asdc-loader-button">
                            <div class="button-style-1 asdc-ajax-loader-trigger next" loader="<?php echo $loaderID; ?>" rtype="<?php echo $type; ?>" ctype="<?php echo $contentType; ?>" ltype="<?php echo $loadType; ?>" lcat="<?php echo $loadCategoryID; ?>" lstep="<?php echo $blog_number_of_posts; ?>" crnt="<?php echo $current_nr; ?>" onclick="asdc_posts_ajax_load( this );">LOAD MORE</div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                else {
                    $loop_post_nr = 0;
                    if (have_posts()) :
                        while ( have_posts() ) :
                            $loop_post_nr++;
                            the_post();
                            if ($loop_post_nr == 1) {
                                get_template_part('content-blog-big', get_post_format());
                            } else {
                                get_template_part('content-blog', get_post_format());
                            }
                        endwhile;
                    endif;
                }
                ?>
                <div class="asdc-clear"></div>
            </div>
            <div class="blog-pagination">
                <?php
                asdc_blog_pagination();
                ?>
            </div>
        </div>
    </div>
<?php

get_footer();

?>