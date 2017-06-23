<?php
/*
* Single Post
* File Version 1.1.0
* Theme Version 4.2.2
*/

get_header();

?>
<div id="asdc-single-post">
    <div id="mobile-indicator-single-post"></div>
    <div class="single-post-holder">
        <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
        endwhile;
        ?>
    </div>
</div>
<?php

get_footer();

?>