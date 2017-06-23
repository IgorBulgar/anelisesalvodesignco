<?php
/*
* Widgets
* File Version 1.0.1
* Theme Version 6.6.0
*/


class newsletterWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'asdc-newsletter-widget',
            'ASDC Newsletter Widget',
            array( 'description' => 'ASDC Widget that shows the newsletter' )
        );
    }

    function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];
        if ( ! empty( $instance[ 'title' ] ) ) {
            echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ). $args[ 'after_title' ];
        }
        if ( ! empty( $instance[ 'description' ] ) ) {
            echo '<h3 class="description">' . $instance[ 'description' ] . '</h3>';
        }
        ?>
        <div class="asdc-newsletter">
            <?php echo do_shortcode( '[newsletter2]' ); ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    function form( $instance ) {
        $form = array(
            'title' => ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'New title',
            'description' => ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '',
        );
        ?>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $form[ 'title' ] ); ?>">
        </div>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $form[ 'description' ] ); ?></textarea>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance[ 'title' ] = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        $instance[ 'description' ] = ( ! empty( $new_instance[ 'description' ] ) ) ? strip_tags( $new_instance[ 'description' ] ) : '';
        return $instance;
    }
}

class socialMediaWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'asdc-social-media-widget',
            'ASDC Social Media Widget',
            array( 'description' => 'ASDC Widget that shows the social media icons' )
        );
    }

    function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];
        if ( ! empty( $instance[ 'title' ] ) ) {
            echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ). $args[ 'after_title' ];
        }
        ?>
        <div class="sidebar-social-media">
            <?php
            global $asdc_settings_social;
            $sidebar_social_media = $asdc_settings_social['social_media_section'];
            asdc_social_media( $sidebar_social_media, 'fa' );
            ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    function form( $instance ) {
        $form = array(
            'title' => ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'New title',
        );
        ?>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $form[ 'title' ] ); ?>">
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance[ 'title' ] = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        return $instance;
    }
}

class postsBrowseWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'asdc-posts-browse-widget',
            'ASDC Posts Browse Widget',
            array( 'description' => 'ASDC Widget that shows Categories, Archives and a Search bar' )
        );
    }

    function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];
        ?>
        <h2 class="widgettitle">Posts by category</h2>
        <div class="sidebar-categories asdc-clear-after">
            <?php
            $sidebar_categories = array(
                'hide_empty' => false,
                'exclude' => 1,
            );
            asdc_show_categories( $sidebar_categories );
            ?>
        </div>
        <h2 class="widgettitle search">Start searching</h2>
        <div class="search-input">
            <?php
            asdc_show_search_form( 'no-label', 'ENTER YOUR SEARCH + PRESS ENTER' );
            ?>
        </div>
        <h2 class="widgettitle archives">Archived by date</h2>
        <div class="sidebar-archives asdc-clear-after">
            <ul>
                <?php
                $sidebar_archives = array(
                    'type'            => 'monthly',
                );
                wp_get_archives( $sidebar_archives );
                ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    function form( $instance ) {
        ?>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        return $instance;
    }
}

class aboutWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'asdc-about-widget',
            'ASDC About Widget',
            array( 'description' => 'ASDC Widget that shows an image, description and buttons' )
        );
    }

    function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];
        if ( ! empty( $instance[ 'title' ] ) ) {
            echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ). $args[ 'after_title' ];
        }
        ?>
        <div class="image-holder">
            <?php
            echo wp_get_attachment_image( $instance[ 'image' ], 'medium' );
            ?>
        </div>
        <div class="description"><?php echo $instance[ 'description' ]; ?></div>
        <?php
        if ( $instance[ 'read-more' ] != '' ) {
            ?>
            <a class="sidebar-button" href="<?php echo $instance[ 'read-more' ]; ?>">READ MORE ></a>
            <?php
        }
        if ( $instance[ 'contact' ] != '' ) {
            ?>
            <a class="sidebar-button" href="<?php echo $instance[ 'contact' ]; ?>">CONTACT ></a>
            <?php
        }
        ?>
        <?php
        echo $args['after_widget'];
    }

    function form( $instance ) {
        $form = array(
            'title' => ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'New title',
            'image' => ! empty( $instance[ 'image' ] ) ? $instance[ 'image' ] : '',
            'description' => ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '',
            'read-more' => ! empty( $instance[ 'read-more' ] ) ? $instance[ 'read-more' ] : '',
            'contact' => ! empty( $instance[ 'contact' ] ) ? $instance[ 'contact' ] : '',
        );
        ?>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $form[ 'title' ] ); ?>">
        </div>
        <div class="asdc-widget-row">
            <?php
            $about_image = array(
                'sql-name' => $this->get_field_name( 'image' ),
                'value' => esc_attr( $form[ 'image' ] ),
                'label' => 'Image:',
            );
            asdc_simple_dash_builder::asdc_sdb_image_selector( $about_image );
            ?>
        </div>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $form[ 'description' ] ); ?></textarea>
        </div>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'read-more' ); ?>"><?php _e( 'Read more button URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'read-more' ); ?>" name="<?php echo $this->get_field_name( 'read-more' ); ?>" type="text" value="<?php echo esc_attr( $form[ 'read-more' ] ); ?>">
        </div>
        <div class="asdc-widget-row">
            <label for="<?php echo $this->get_field_id( 'contact' ); ?>"><?php _e( 'Contact button URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'contact' ); ?>" name="<?php echo $this->get_field_name( 'contact' ); ?>" type="text" value="<?php echo esc_attr( $form[ 'contact' ] ); ?>">
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance[ 'title' ] = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        $instance[ 'image' ] = ( ! empty( $new_instance[ 'image' ] ) ) ? strip_tags( $new_instance[ 'image' ] ) : '';
        $instance[ 'description' ] = ( ! empty( $new_instance[ 'description' ] ) ) ? strip_tags( $new_instance[ 'description' ] ) : '';
        $instance[ 'read-more' ] = ( ! empty( $new_instance[ 'read-more' ] ) ) ? strip_tags( $new_instance[ 'read-more' ] ) : '';
        $instance[ 'contact' ] = ( ! empty( $new_instance[ 'contact' ] ) ) ? strip_tags( $new_instance[ 'contact' ] ) : '';
        return $instance;
    }
}

function asdc_register_widgets() {
    //register_widget( 'newsletterWidget' );
    //register_widget( 'socialMediaWidget' );
    //register_widget( 'postsBrowseWidget' );
    //register_widget( 'aboutWidget' );
}
add_action( 'widgets_init', 'asdc_register_widgets' );
?>