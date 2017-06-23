/*
 * ASDC Core - Admin Functions
 * File Version 1.0.3
 * Plugin Version 1.0.2
 */

// Here's how I clone a setting
function asdc_add_clone(obj) {
    var b = jQuery(obj); // Button
    var wrap = b.closest('.asdc-builder-cloning'); // Cloning wrap
    var matrix = wrap.find('.asdc-builder-clone:first'); // First setting

    var clone = matrix.clone(); // Creating the clone
    clone.find('input').val(''); // Empty the input
    clone.find('img').attr('src', asdc_core_admin_app_dir+'images/asdc-no-image.png');
    clone.find('img').attr('srcset', asdc_core_admin_app_dir+'images/asdc-no-image.png');

    clone.appendTo(wrap); // Adding the clone

    //clone.find( 'textarea' ).html( '' );

    // var colorPickers = clone.find( '.asdc-builder-colorpicker' );
    // colorPickers.each( function() {
    //     var thisCP = jQuery( this );
    //     thisCP.find( '.asdc-db-color-picker' ).appendTo( thisCP );
    //     thisCP.find( '.wp-picker-container').remove();
    // });

    //activateColorPicker();
}

// I can also remove clones
function asdc_remove_clone(obj) {
    var b = jQuery(obj); // Button
    var clone = b.closest('.asdc-builder-clone'); // The clone
    var wrap = b.closest('.asdc-builder-cloning'); // The cloning wrap

    // Check if it's the only clone
    if(wrap.find('.asdc-builder-clone').length > 1) {
        clone.remove();
    } else {
        alert('Cannot remove the last and only item.');
    }
}

// I can upload images
var file_frame;
function asdc_add_image(obj) {
    var b = jQuery(obj); // Button
    var wrap = b.closest('.asdc-builder-setting'); // The setting
    var input = wrap.find('.hidden-input'); // Here we store the image ID
    var mainImage = wrap.find('img'); // The image preview

    // Create the media frame
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).data('uploader_title'),
        button: {text: jQuery(this).data('uploader_button_text')},
        multiple: false
    });

    // When an image is selected, run a callback
    file_frame.on('select', function() {
        var images = file_frame.state().get('selection').toJSON(); // Get selected images
        var image = images[0];
        var imageID = image['id'];
        var imageSRC;
        if(image['sizes']['asdc-thumb']) {
            imageSRC = image['sizes']['asdc-thumb']['url'];
        } else if(image['sizes']['thumbnail']) {
            imageSRC = image['sizes']['thumbnail']['url'];
        } else {
            imageSRC = image['sizes']['full']['url'];
        }
        input.attr('value', imageID); // Store the image ID
        mainImage.attr('src', imageSRC); // Set the SRC
        mainImage.attr('srcset', imageSRC); // Set the other SRC
    });

    file_frame.open(); // Show the frame
}

// How I remove an image
function asdc_remove_image(obj) {
    var b = jQuery(obj); // Button
    var wrap = b.closest('.asdc-builder-setting'); // The setting
    var input = wrap.find('.hidden-input'); // Here we store the image ID
    var mainImage = wrap.find('img'); // The image preview
    input.val(''); // Input reset
    mainImage.attr('src', asdc_core_admin_app_dir+'images/asdc-no-image.png'); // Set the default image
    mainImage.attr('srcset', asdc_core_admin_app_dir+'images/asdc-no-image.png'); // Set the default image
}

jQuery('.asdc-builder-cloning').sortable({
    items: '.asdc-builder-clone',
    cursor: 'move'
});

jQuery('.asdc-builder-sorting').sortable({
    items: '.asdc-builder-sort',
    cursor: 'move'
});

// Let's do some processings before we save
jQuery('#asdc-settings-page #submit').on('click', function(e) {
    var t = jQuery(this); // Button
    if(t.hasClass('prevented')) {return;}
    e.preventDefault();
    t.addClass('prevented');

    var sortings = jQuery('.asdc-builder-sorting'); // All sorting sections
    sortings.each(function() {
        var sorting = jQuery(this);
        var sorts = sorting.find('.asdc-builder-sort'); // All sorting inputs
        sorts.each(function(index) {
            var sort = jQuery(this);
            var input = sort.find('.asdc-sorting-input'); // The hidden input
            input.val(index);
        });
    });
    t.click();
});

// Just clicking a checkbox and setting the proper value
function asdc_click_checkbox(obj) {
    var wrap = jQuery(obj);
    var input = wrap.find('input[type="hidden"]');
    var checkbox = wrap.find('input[type="checkbox"]');
    if(checkbox.is(':checked')) {input.val(1);}
    else {input.val(0);}
}

// Switching the cool switch
function asdc_switch_trigger(obj) {
    var s = jQuery(obj);
    var wrap = s.parent();
    var input = wrap.find('input');
    if(wrap.hasClass('active')) {
        wrap.removeClass('active');
        input.val(0);
    } else {
        wrap.addClass('active');
        input.val(1);
    }
}