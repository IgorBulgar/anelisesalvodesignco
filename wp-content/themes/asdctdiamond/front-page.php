<?php
/*
 * Front Page
 * File Version 15.0.0
 * Theme Version 15.0.2
 */
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $t_p_id = get_the_ID();
    $t_p_title = get_the_title();
    ?>
    <div id="front-page">
        <div class="page-holder front-page">
            <article class="asdc-page-creator">
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>