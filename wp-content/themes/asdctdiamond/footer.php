<?php
/*
* Footer
* File Version 14.0.0
* Theme Version 14.1.0
*/

?>
</div> <!-- end .asdc-main-wrap -->
</div> <!-- end #asdc-main -->
<div class="asdc-clear"></div>

<footer>
    <?php
    global $asdc_settings, $asdc_settings_social;
    $copyright_text = $asdc_settings['footer_section']['copyright']['text'];
    ?>
    <div class="row row-1 row-padding-default">
        <div class="row-wrapper asdc-clear-after">
            <?php
            if (is_front_page()) {
                $connect_url = $asdc_settings['contact_section']['connect-url']['text'];
                ?>
                <div class="landing-menu-item desktop"><a href="<?php echo $connect_url; ?>">< CONNECT</a></div>
                <div class="landing-menu-item mobile"><a href="<?php echo $connect_url; ?>">CONNECT ></a></div>
                <div class="col col-4 col-left">
                    <div class="footer-info-wrapper">
                        <?php
                        $info_arr = array(
                            'twitter' => $asdc_settings_social['social_media_section']['twitter']['url'],
                            'linkedin' => $asdc_settings_social['social_media_section']['linkedin']['url'],
                            'mail' => $asdc_settings['contact_section']['mail']['text'],
                        );
                        $info_nr = 0;
                        foreach ($info_arr as $key => $value) {
                            if ($value != '') {
                                $info_nr++;
                                if ($info_nr > 1) {echo '<div class="separator">|</div>';}
                                ?>
                                <div class="info-item">
                                    <?php
                                    if ($key == 'mail') {
                                        $key = $value;
                                        $value = 'mailto:'.$value;
                                        echo '<a target="_blank" href="'.$value.'"><span class="mobile">EMAIL</span><span class="desktop">'.$key.'</span></a>';
                                    } else {
                                        echo '<a target="_blank" href="'.$value.'">'.$key.'</a>';
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col col-4 col-left">
                    <div class="footer-info-wrapper">
                        <?php
                        $info_arr = array(
                            'mail' => $asdc_settings['contact_section']['mail']['text'],
                            'phone' => $asdc_settings['contact_section']['phone']['text'],
                        );
                        $info_nr = 0;
                        foreach ($info_arr as $key => $value) {
                            if ($value != '') {
                                $info_nr++;
                                if ($info_nr > 1) {echo '<div class="separator">|</div>';}
                                ?>
                                <div class="info-item">
                                    <?php
                                    if ($key == 'mail') {
                                        $key = $value;
                                        $value = 'mailto:'.$value;
                                        echo '<a target="_blank" href="'.$value.'"><span class="mobile">EMAIL</span><span class="desktop">'.$key.'</span></a>';
                                    }
                                    if ($key == 'phone') {
                                        $phone_link = $asdc_settings['contact_section']['phone-url']['text'];
                                        if ($phone_link != '') {
                                            echo '<a target="_blank" href="tel:'.$phone_link.'">'.$value.'</a>';
                                        } else {
                                            echo '<span>'.$value.'</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col col-4 col-mid">
                <div class="copyright-row">
                    <div id="copyright" class="copyright-text"><?php echo $copyright_text; ?></div>
                </div>
            </div>
            <?php
            if (!is_front_page()) {
                ?>
                <div class="col col-4 col-right">
                    <div class="footer-info-wrapper">
                        <?php
                        $info_arr = array(
                            'linkedin' => $asdc_settings_social['social_media_section']['linkedin']['url'],
                            'twitter' => $asdc_settings_social['social_media_section']['twitter']['url'],
                        );
                        $info_nr = 0;
                        foreach ($info_arr as $key => $value) {
                            if ($value != '') {
                                $info_nr++;
                                if ($info_nr > 1) {echo '<div class="separator">|</div>';}
                                ?>
                                <div class="info-item">
                                    <?php
                                    if ($key == 'linkedin') {$key = 'connect on linkedin';}
                                    echo '<a target="_blank" href="'.$value.'">'.$key.'</a>';
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div id="tablet-indicator"></div>
    <div id="mobile-indicator"></div>
    <?php

    wp_footer();

    ?>
</footer>
</div> <!-- end .body-wrapper -->
<!-- Hey! You're awesome! copyright 2017 ASDC -->
</body>
</html>