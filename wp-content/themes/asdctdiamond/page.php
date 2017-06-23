<?php
/*
* Page
* File Version 14.0.0
* Theme Version 14.0.0
*/

get_header();

?>
<?php

while (have_posts()) : the_post();
    $t_page = array(
        'id' => get_the_ID(),
        'title' => get_the_title()
    );
?>
    <div id="asdc-page">
        <div class="page-wrapper">
            <article class="asdc-page-creator">
                <div class="content-wrapper">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </div>
<?php

endwhile;

?>
<?php

get_footer();

?>
