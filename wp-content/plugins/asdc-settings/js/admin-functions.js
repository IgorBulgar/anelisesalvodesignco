/*
 * ASDC Settings - Admin Functions JS
 * File Version 1.2.0.0
 * Plugin Version 2.5.0
 */

// BEG Colorpicker Init - v1.4
function activateColorPicker() {
    jQuery('.asdc-db-color-picker').wpColorPicker();
}
jQuery(document).ready( function(){
    activateColorPicker();
});
// END Colorpicker Init - v1.4


// BEG Checkbox Value - v1.3
function asdc_checkbox_value( obj ) {
    var wrap = jQuery( obj );
    var input = wrap.find( 'input[type="hidden"]' );
    var checkbox = wrap.find( 'input[type="checkbox"]' );
    if ( checkbox.is(':checked') ) {input.val( 1 );}
    else {input.val( 0 );}
}
// END Checkbox Value - v1.3



// BEG Remove Row - v1
function asdc_remove_row( obj ) {
    var thisButton = jQuery( obj );
    var tableCell = thisButton.parent();
    tableCell.remove();
}
// END Remove Row - v1



// BEG Clone Row - 1.1.3
function asdc_clone_row( obj ) {
    var thisButton = jQuery( obj );
    var wrapper = thisButton.parent();
    var rowToClone = wrapper.find( '.asdc-row-to-clone' );
    var clone = rowToClone.eq(0).clone();
    clone.find( 'input' ).val( '' );
    clone.find( 'textarea' ).html( '' );
    console.log( clone.find( 'textarea' ) );
    clone.find( 'img' ).attr( 'src', asdcTemplateDir + 'images/asdc-no-image.png' );
    clone.find( 'img' ).attr( 'srcset', asdcTemplateDir + 'images/asdc-no-image.png' );
    var colorPickers = clone.find( '.asdc-builder-colorpicker' );
    colorPickers.each( function() {
        var thisCP = jQuery( this );
        thisCP.find( '.asdc-db-color-picker' ).appendTo( thisCP );
        thisCP.find( '.wp-picker-container').remove();
    });
    clone.appendTo( wrapper );
    activateColorPicker();
}
// END Clone Row - 1.1.3



// BEG Sortable - v1
jQuery( '.asdc-sortable' ).sortable({
    items: '.asdc-row-to-clone',
    cursor: 'move'
});
// END Sortable - v1



// BEG Add Image - CAC
var file_frame;
var addImageButton = jQuery( '.select-image-button' );
addImageButton.live( 'click', function( event ) {
    var thisButton = jQuery( this );
    var imageUploaderWrapper = thisButton.parent().parent();
    var theInput = imageUploaderWrapper.find( '.hidden-input' );
    var theImage = imageUploaderWrapper.find( 'img' );

    event.preventDefault();

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media( {
        title: jQuery( this ).data( 'uploader_title' )
        ,button: { text: jQuery( this ).data( 'uploader_button_text' ),}
        ,multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
        var selectedImages = file_frame.state().get('selection').toJSON(); // Get selected images
        var selectedImageID = selectedImages[0]['id'];
        var selectedImageSRC;
        if ( selectedImages[0]['sizes']['thumbnail'] ) {
            selectedImageSRC = selectedImages[0]['sizes']['thumbnail']['url'];
        }
        else {
            selectedImageSRC = selectedImages[0]['sizes']['full']['url'];
        }
        theInput.attr( 'value', selectedImageID );
        theImage.attr( 'src', selectedImageSRC );
        theImage.attr( 'srcset', selectedImageSRC );
    });

    // Finally, open the modal
    file_frame.open();
});
// END Add Image - CAC



// BEG Remove Selected Image - BRU
function asdc_remove_selected_image( obj ) {
    var thisButton = jQuery( obj );
    var imageSelectorPlanet = thisButton.closest( '.asdc-builder-image-selector' );
    var input = imageSelectorPlanet.find( '.hidden-input' );
    var imagePreview = imageSelectorPlanet.find( '.image-preview img' );
    input.val( '' );
    imagePreview.attr( 'src', asdcTemplateDir + 'images/asdc-no-image.png' );
    imagePreview.attr( 'srcset', asdcTemplateDir + 'images/asdc-no-image.png' );
}
// END Remove Selected Image - BRU

// BEG Switch Click - CEA
function asdc_switch_trigger( obj ) {
    var t = jQuery( obj );
    var god = t.parent();
    var i = god.find( 'input' );
    if ( god.hasClass( 'active' ) ) {
        god.removeClass( 'active' );
        i.val( 0 );
    }
    else {
        god.addClass( 'active' );
        i.val( 1 );
    }
}
// END Switch Click - CEA