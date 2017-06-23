<?php
/*
* Archive Page
* File Version 2.0.1
* Theme Version 12.4.1
*/

get_header();

?>
<div id="asdc-archive-page">
    <?php
    $archive_page_nr_results = -1;
    $archive_query_args = array(
        'post_type' => array(
            'post'
        ),
        'post_status' => 'publish',
        'date_query' => array(
            array(
                'year'  => get_the_time( 'Y' ),
                'month' => get_the_time( 'n' ),
            ),
        ),
        'posts_per_page' => $archive_page_nr_results,
        'offset' => 0
    );
    //$archive_result_get = new WP_Query( $archive_query_args );
    ?>
    <div class="taxonomy-page-wrap archive">
        <div class="taxonomy-heading-wrap archive">
            <h1 class="taxonomy-title archive"><span>POSTS FROM <?php the_time( 'F Y' ); ?></span></h1>
        </div>
        <?php
        $manual_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $manual_pagination_args = array(
            'post_type' => array(
                'post'
            ),
            'post_status' => 'publish',
            'date_query' => array(
                array(
                    'year'  => get_the_time( 'Y' ),
                    'month' => get_the_time( 'n' ),
                ),
            ),
            'posts_per_page' => 16,
            'paged' => $manual_page
        );
        query_posts( $manual_pagination_args );
        ?>
        <?php if ( have_posts() ) : ?>
            <div class="short-posts-feed taxonomy-feed archive">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'content-taxonomy', get_post_format() );
                endwhile;
                ?>
                <div class="asdc-clear"></div>
            </div>
        <?php else : ?>
            <div class="asdc-error-message archive">
                <p>Whoops. No posts here.</p>
            </div>
        <?php endif; ?>
        <?php
        $navigation_extra_class = '';
        if (!get_next_posts_link() && !get_previous_posts_link()) {
            $navigation_extra_class = 'no-navigation';
        }
        ?>
        <div class="blog-navigation navigation-holder <?php echo $navigation_extra_class; ?>">
            <div class="col left">
                <div class="newsletter-section">
                    <div class="newsletter-wrapper">
                        <?php
                        $navigation_newsletter_title = $asdc_settings['blog_section']['navigation-subscribe-text']['text'];
                        $navigation_newsletter_sc = $asdc_settings['blog_section']['navigation-subscribe-sc']['text'];
                        echo '<h4 class="newsletter-title">' . $navigation_newsletter_title . '</h4>';
                        echo do_shortcode( $navigation_newsletter_sc );
                        ?>
                    </div>
                </div>

            </div>
            <div class="col right">
                <?php
                $blog_navigation_args = array(
                    'prev' => '',
                    'next' => '',
                    'separator' => true,
                    'separator-text' => 'keep going // view more posts'
                );
                asdc_blog_navigation( $blog_navigation_args );
                ?>
            </div>
            <div class="asdc-clear"></div>
        </div>
    </div>
</div>
<?php

get_footer();

?>