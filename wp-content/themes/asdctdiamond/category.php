<?php
/*
* Category
* File Version 3.0.0
* Theme Version 13.1.0
*/

get_header();

$t_cat_id = $cat;
$t_cat_get = get_category( $t_cat_id );
$t_cat_name = $t_cat_get->name;
$t_cat_count = $t_cat_get->category_count;
?>
<div id="asdc-category-page">
    <div class="taxonomy-page-wrap category limited-width-default">
        <div class="taxonomy-heading-wrap category">
            <div class="category-list-heading">
                <?php
                $args = array(
                    'hide_empty' => 1,
                    'parent' => 0,
//                    'exclude' => 1222,
                    'order' => 'DESC'
                );
                $categories_result = get_categories( $args );
                echo '<ul>';
                foreach ( $categories_result as $category_item ) {
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

                    if ($category_item->term_id == $t_cat_id) {
                        echo '<li class="'.$li_class.'"><h1 class="current-category">' . $category_name . '</h1>';
                    } else {
                        echo '<li class="'.$li_class.'"><a href="' . $category_perma . '">' . $category_name . '</a>';
                    }
                    $subcategories_args = array(
                        'hide_empty' => 1,
                        'parent' => $category_item->term_id,
                    );
                    $subcategories = get_categories($subcategories_args);
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
        </div>
        <?php if (have_posts()) : ?>
            <div class="posts-feed taxonomy-feed category">
                <?php
                while ( have_posts() ) :
                    $loop_post_nr++;
                    the_post();
                    if ($loop_post_nr == 1) {
                        get_template_part('content-blog-big', get_post_format());
                    } else {
                        get_template_part('content-blog', get_post_format());
                    }
                endwhile;
                ?>
                <div class="asdc-clear"></div>
            </div>
        <?php else : ?>
            <div class="asdc-error-message category">
                <p>Whoops. No posts in this category.</p>
            </div>
        <?php endif; ?>
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