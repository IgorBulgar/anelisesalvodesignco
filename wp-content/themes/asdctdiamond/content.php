<?php
/*
* Content
* File Version 4.0.0
* Theme Version 13.0.0
*/

global $asdc_settings_theme;
$t_p_id = get_the_ID();
$t_p_permalink = get_permalink();
$t_p_title = get_the_title();
$t_p_date = get_the_date($asdc_settings_theme['meta_section']['date']['text'], $t_p_id);
//$t_p_excerpt = get_the_excerpt();
//$t_p_tags = get_the_tags();
//$t_p_featured_img_id = get_post_thumbnail_id($t_p_id);
//$t_p_type = get_post_type($t_p_id);

// BEG Post's category package
$t_p_categories_get = get_the_category($t_p_id); // get all categories
$t_p_category_set = $t_p_categories_get[0]; // get the first category
// check if we have multiple categories and ignore the child categories
if (count($t_p_categories_get ) > 1) {
    foreach($t_p_categories_get as $t_p_category_get_one) {
        if ($t_p_category_get_one->parent == 0) {
            $t_p_category_set = $t_p_category_get_one;
        }
    }
}
$t_p_category_name = $t_p_category_set->name;
$t_p_category_id = $t_p_category_set->cat_ID;
$t_p_category_permalink = get_category_link($t_p_category_id);
//$t_p_category_nicename = $t_p_category_set->category_nicename;
// END Post's category package

// BEG Post's meta package
$t_p_metas_ids = array(
    'video' => false,
    'hide_featured_image' => true,
    'gallery' => false,
    'second_featured_image' => true,
    'third_featured_image' => true,
);
$t_p_metas = array();
foreach ($t_p_metas_ids as $key => $value) {
    if ($value === true) {
        $meta_get = get_post_meta($t_p_id, '_meta_value_'.$key);
        $meta_set = stripslashes(maybe_unserialize($meta_get[0]));
        $t_p_metas[$key] = $meta_set;
    }
}
// END Post's meta package

// BEG Info
// to get the number of comments from Disqus add #disqus_thread to the end of post's permalink
// example: <a href="this_post_permalink#disqus_thread" class="comments-count">0</a>
// END Info

// BEG Post Settings
$asdc_single_post_st = array(
    'featured_image_show' => true,
);
// END Post Settings


?>
<article class="asdc-single-post single">
    <div class="s-p-wrapper">
        <div class="s-p-header">
            <h1 class="single-post-title"><?php echo $t_p_title; ?></h1>
            <div class="data-group-1">
                <h2 class="data-category"><a href="<?php echo $t_p_category_permalink; ?>"><?php echo $t_p_category_name; ?></a></h2>
                <div class="data-date"><?php echo $t_p_date; ?></div>
            </div>
            <div class="data-group-2">
                <a href="<?php echo $t_p_permalink; ?>#disqus_thread" class="comments-count">0 comments</a>
            </div>
        </div>
        <div class="s-p-body">
            <?php
            // Check if we show the featured image in the template
            if ($asdc_single_post_st['featured_image_show'] === true) {

                // Check if we don't hide the featured image
                if ($t_p_metas['hide_featured_image'] != '1') {

                    // Display the featured image
                    $image_size = 'single';
                    if (has_post_thumbnail($t_p_id)) {
                        ?>
                        <div class="asdc-image-holder featured-img asdc-frizzly-active">
                            <?php
                            echo get_the_post_thumbnail($t_p_id, $image_size);
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="asdc-empty-image size-<?php echo $image_size; ?>"></div>
                        <?php
                    }

                    // Display the second and third featured images
                    $other_featured_images = array(
                        $t_p_metas['second_featured_image'],
                        $t_p_metas['third_featured_image']
                    );
                    ?>
                    <div class="other-featured-images">
                        <?php
                        $image_size = 'single-half';
                        for ($i = 1; $i <= count($other_featured_images); $i++) {
                            $image_id = $other_featured_images[$i-1];
                            ?>
                            <div class="other-featured-image <?php echo 'i-'.$i; ?>">
                                <div class="asdc-image-holder featured-img asdc-frizzly-active">
                                    <?php
                                    echo wp_get_attachment_image($image_id, $image_size);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="asdc-clear"></div>
                    </div>
                    <?php


                }

                // todo NOT FINISHED
                /*
                if ($t_p_metas['second_featured_image'] != '1') {

                    if ($t_p_metas['video'] != '') {
                        $t_embed_v_id = 'single-post-video-'.$t_p_id;
                        $t_embed_v_w = '800';
                        $t_embed_v_h = '450';
                        $t_embed_v_url_id = asdc_get_yt_id($t_p_metas['video']);
                        ?>
                        <div class="asdc-yt-holder asdc-yt-embed" data-video-id="<?php echo $t_embed_v_url_id; ?>" data-width="<?php echo $t_embed_v_w; ?>" data-height="<?php echo $t_embed_v_h; ?>" data-id="<?php echo $t_embed_v_id; ?>">
                            <div style="height: <?php echo $t_embed_v_h; ?>px;" class="asdc-yt-pre-frame" id="<?php echo $t_embed_v_id; ?>"></div>
                            <div class="asdc-yt-button asdc-yt-embed-btn"></div>
                        </div>
                        <?php
                    }
                }
                */
            }
            ?>
            <div class="content asdc-post-editor asdc-frizzly-active"><?php the_content(); ?></div>
        </div>
        <div class="s-p-footer">
            <div class="col col-6 left">
                <div class="post-share">
                    <?php
                    $sharing_args = array(
                        'permalink' => $t_p_permalink,
                        'label' => 'SHARE THIS POST',
                        'share' => array(
                            'twitter',
                            'facebook',
                            'pinterest',
                            'mail',
                        ),
                        'type' => 'fa'
                    );
                    asdc_sharing($sharing_args);
                    ?>
                </div>
                <div class="single-post-navigation navigation-holder">
                    <div class="wrapper">
                        <?php
                        $post_navigation_args = array(
                            'prev' => '< previous post',
                            'next' => 'next post >',
                            'separator' => false,
                            'separator-text' => '//'
                        );
                        asdc_post_navigation($post_navigation_args);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col col-6 right">
                <div class="related-posts single asdc-clear-after">
                    <?php
                    $related_posts_per_page = 4;
                    $related_posts_args = array(
                        'cat' => $t_p_category_id,
                        'post__not_in' => array($t_p_id),
                        'posts_per_page' => $related_posts_per_page,
                        'orderby' => 'rand'
                    );
                    $get_related_posts = new wp_query($related_posts_args);
                    $related_posts_count = count($get_related_posts->posts);
                    if ($related_posts_count != 0) {
                        ?>
                        <h2 class="related-title">YOU MAY ALSO LOVE</h2>
                        <div class="related-posts-wrapper">
                            <div class="related-holder-window">
                                <div class="related-holder">
                                    <?php
                                    while( $get_related_posts->have_posts() ) {
                                        $get_related_posts->the_post();
                                        get_template_part('content-related', get_post_format());
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <div class="asdc-clear"></div>
            <div id="asdc-comments" class="single-post-comments" >
                <?php
                global $asdc_settings;
                $comments_heading = $asdc_settings['single_section']['comments-title']['text'];
                if ( $comments_heading != '' ) {
                    echo '<h2 class="comments-heading">' . $comments_heading . '</h2>';
                }
                ?>
                <?php
                comments_template();
                ?>
            </div>
        </div>
    </div>
</article>