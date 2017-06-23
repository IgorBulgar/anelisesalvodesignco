<?php
/*
* Tag
* File Version 0.0.1
* Theme Version 1.1.0
*/

get_header();

?>
    <div id="dm-category-page">
        <div class="page-heading">
            <div class="hr"></div>
            <div class="heading-holder">
                <h2><?php single_tag_title(); ?></h2>
            </div>
        </div>
        <div class="dm-category-feed">
            <?php
            if ( have_posts() ) :
                ?>
                <div class="dm-category-feed-holder">
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'content', get_post_format() );

                    endwhile;
                    ?>
                </div>
                <?php

                //$dm_feed_navigation_args = '';
                //dm_feed_navigation( $dm_feed_navigation_args );

                ?>
                <?php

            endif;

            ?>
        </div>
    </div>
<?php

get_footer();

?>