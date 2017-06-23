/*
 * Functions JS
 * File Version 16.0.0
 * Theme Version 16.0.1
 */

var asdcBody = jQuery('body');
var asdcPopWrap = jQuery('#asdc-popups');
var mobileIndicator = jQuery('#mobile-indicator');
var tabletIndicator = jQuery('#tablet-indicator');

// Load
jQuery(window).bind('load', function() {
    asdcMandatory('load');
});

// Resize
jQuery(window).resize(function() {
    asdcMandatory('resize');
});


// Scroll
jQuery(window).scroll(function() {
    //setupStickyNav();
});

// Register
function asdcRegister() {
    asdcMandatory('register');
    //registerTouchDevice();
    //registerNewsletterTrigger();
    //registerHideNewsletterMessages();
    //registerClickAnywhereToClose();
    //registerHiddenSearch();
    //registerAutoSlide();
    //registerMenuLinksToCloseMenu();
    //registerClickItems();
    //registerTouchClicks();
    //registerContactChecks();
    setTimeout(function() {

    }, 1000);
    setTimeout(function() {

    }, 2000);
}
asdcRegister();

// Mandatory
function asdcMandatory(type) {
    //fixHalfPixel();
    //setupPopupBackground();
    //setupSliderType1(type);
    //setupSliderType4(type);

    // CUSTOM
    //setupIllusion(type);
}

// AJAX
function asdcMandatoryAJAX() {

}



















//// BEG Common Functions - CROWN
// BEG Mobile Menu - CROWN
function toggleMobileMenu() {
    asdcBody.toggleClass('asdc-mobile-menu-show');
}
// END Mobile Menu - CROWN

function registerContactChecks() {
    var checks = jQuery( '.wpcf7-checkbox input[type="checkbox"]' );
    if (! checks.length > 0) {return;}
    var labels = jQuery('.wpcf7-checkbox .wpcf7-list-item-label');
    labels.click( function() {
        jQuery(this).parent().find('input').click();
    });
}

// BEG Smooth Anchors - CROWN
jQuery(function() {
    jQuery('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                jQuery('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});
// END Smooth Anchors - CROWN

function registerMenuLinksToCloseMenu() {
    jQuery( '#asdc-mobile-menu .menu-wrapper a[href!="#"]' ).click( function() {
        toggleMobileMenu();
    });
}

// BEG YouTube API - AIR
function registerYouTubeAPI() {
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}
// END YouTube API - AIR

// BEG YouTube embed - AIR
var asdcYTplayers = [];
function onYouTubeIframeAPIReady() {
    var embeds = jQuery('.asdc-yt-embed');
    embeds.each(function() {
        var t = jQuery(this);
        var btn = t.find('.asdc-yt-embed-btn');
        var vW = t.data('width');
        var vH = t.data('height');
        var id = t.data('id');
        var vID = t.data('video-id');
        asdcYTplayers[id] = new YT.Player(id, {
            width: vW,
            height: vH,
            videoId: vID,
            playerVars: {
                'showinfo': 0
            },
            events: {
                // 'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
        function onPlayerStateChange() {
            embeds.removeClass('playing');
            t.addClass('playing');
            btn.hide();
        }
        btn.click(function(e) {
            e.preventDefault();
            btn.hide();
            asdcYTplayers[id].playVideo();
        });
    });
}
// END YouTube embed - AIR

// BEG Touch double click - AIR
function registerTouchClicks() {
    var objs = jQuery('.touch-click');
    objs.on('touchstart', function(e) {
        var obj = jQuery( this );
        if (obj.hasClass('touch-hover')) {
            obj.removeClass('touch-hover');
        } else {
            e.preventDefault();
            obj.addClass('touch-hover');
        }
    });
}
// END Touch double click - AIR

// BEG Touch support for hovers - AIR
function registerClickItems() {
    if (!asdcBody.hasClass('asdc-touch')){return;}
    var items = jQuery(
        '.archives-holder.dropper,' +
        '.menu-wrapper .menu-item-has-children'
    );
    items.on('click',function() {
        var t = jQuery(this);
        if (t.hasClass('asdc-clicked')) {
            t.removeClass('asdc-clicked');
        } else {
            t.addClass('asdc-clicked');
        }
    });
    var itemsP1 = jQuery(
        '.sticky-menu-wrapper > .label'
    );
    itemsP1.on('click',function() {
        var t = jQuery(this).parent();
        if (t.hasClass('asdc-clicked')) {
            t.removeClass('asdc-clicked');
        } else {
            t.addClass('asdc-clicked');
        }
    });
    items.on('mouseleave',function() {
        var t = jQuery(this);
        t.removeClass('asdc-clicked');
    });
    var leavers = jQuery(
        '.sticky-menu-wrapper'
    );
    jQuery(document).click(function (e) {
        if (!leavers.is(e.target) && leavers.has(e.target).length === 0) {
            leavers.removeClass('asdc-clicked');
        }
    });
}
// END Touch support for hovers - AIR

// BEG Popup Background - AIR - i
function setupPopupBackground( type ) {
    if (type == 'reset') {
        asdcPopWrap.css('height', '');
    } else {
        if (asdcPopWrap.hasClass('show')) {
            asdcPopWrap.css('height', jQuery(window).height());
        }
    }
}
// END Popup Background - AIR - i

function registerTouchDevice() {
    var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints || navigator.maxTouchPoints;
    if (supportsTouch == true) {
        asdcBody.addClass('asdc-touch');
    }
}

function asdcClosePopup( obj ) {
    var close = jQuery( obj );
    var pop = close.closest('.asdc-popup');
    pop.removeClass( 'show' );
    asdcPopWrap.removeClass( 'show' );
    setupPopupBackground( 'reset' );
}

function togglePopup( obj ) {
    var pop = asdcPopWrap.find( obj );
    if ( pop.hasClass( 'show' ) ) {
        pop.removeClass( 'show' );
        asdcPopWrap.removeClass( 'show' );
        setupPopupBackground( 'reset' );
    }
    else {
        pop.addClass( 'show' );
        asdcPopWrap.addClass( 'show' );
        setupPopupBackground( '' );
    }
}

// Hidden search
// usually is an icon and when you click it shows the input
function registerHiddenSearch() {
    var forms = jQuery( '.searchform.type-hidden' );
    forms.each(function() {
        var t = jQuery(this);
        var icon = t.find( 'i' );
        icon.click( function() {
            t.toggleClass( 'show' );
            if (t.hasClass('show')) {
                t.find('input').focus();
            }
        });
    });
}

function fixHalfPixel() {
    // todo add it if you can, if not then reduce it
    var objs = jQuery( '.asdc-translated' );
    objs.each( function() {
        var obj = jQuery( this );
        if ( obj.hasClass( 'tr-x' ) ) {
            obj.css( 'width', '' );
            if ( obj.width() % 2 != 0 ) {
                obj.css( 'width', obj.width() + 1 );
            }
        }
        if ( obj.hasClass( 'tr-y' ) ) {
            obj.css( 'height', '' );
            if ( obj.height() % 2 != 0 ) {
                obj.css( 'height', obj.height() + 1 );
            }
        }
    });
}

// BEG Load More Posts AJAX - WHITE
function asdc_posts_ajax_load( obj ) {
    var thisTrigger = jQuery( obj );
    if ( ! thisTrigger.hasClass( 'loading' ) ) {
        thisTrigger.addClass( 'loading' );
        var loaderID = thisTrigger.attr( 'loader' );
        var loadingLabelInitHTML = thisTrigger.html();
        thisTrigger.html( 'LOADING...' );
        var loaderWrap = jQuery( '#asdc-ajax-loader-' + loaderID );
        var getCurrentNr = parseInt( thisTrigger.attr( 'crnt' ) );
        var setCurrentNr = getCurrentNr + 1;
        var triggers = thisTrigger.parent().find( '.asdc-ajax-loader-trigger' );
        if ( thisTrigger.hasClass( 'prev' ) ) {
            setCurrentNr = getCurrentNr - 1;
        }
        var nrOfPosts = parseInt( thisTrigger.attr( 'lstep' ) );
        var offset = setCurrentNr * nrOfPosts;
        var recentType = thisTrigger.attr( 'rtype' );
        var category = '';
        if ( recentType == 'category' ) {category = parseInt( thisTrigger.attr( 'lcat' ) );}
        var tag = '';
        if ( recentType == 'tag' ) {tag = parseInt( thisTrigger.attr( 'ltag' ) );}
        // todo verify search loader
        var searchQuery = '';
        if ( recentType == 'search' ) {searchQuery = thisTrigger.attr( 'lsearch' );}
        var loadType = thisTrigger.attr( 'ltype' );
        var contentType = thisTrigger.attr( 'ctype' );
        var sendData = {
            'action': 'asdc_load_more_posts',
            'nrOfPosts' : nrOfPosts,
            'offset': offset,
            'searchQuery': searchQuery,
            'category': category,
            'tag': tag,
            'loadType' : loadType,
            'contentType' : contentType,
            'recentType' : recentType
        };
        jQuery.post( ajaxurl, sendData, function( r ) {
            thisTrigger.html( loadingLabelInitHTML );
            if ( r != '' ) {
                loaderWrap.append( r );
                triggers.removeClass( 'asdc-hide' );
                if ( setCurrentNr == 0 ) {
                    triggers.addClass( 'asdc-hide' );
                    if ( thisTrigger.hasClass( 'next' ) ) {
                        thisTrigger.removeClass( 'asdc-hide' );
                    }
                    else {
                        triggers.removeClass( 'asdc-hide' );
                        thisTrigger.addClass( 'asdc-hide' );
                    }
                }
            }
            triggers.attr( 'crnt', setCurrentNr );
            thisTrigger.removeClass( 'loading' );
            asdcMandatoryAJAX();
        });
        var offsetFuture = offset + nrOfPosts;
        var sendDataFuture = {
            'action': 'asdc_load_more_posts_future',
            'nrOfPosts' : nrOfPosts,
            'offset': offsetFuture,
            'searchQuery': searchQuery,
            'category': category,
            'tag': tag,
            'loadType' : loadType
        };
        jQuery.post( ajaxurl, sendDataFuture, function( r ) {
            triggers.removeClass( 'asdc-hide-more' );
            if ( r == 'false' && thisTrigger.hasClass( 'next' ) ) {
                thisTrigger.addClass( 'asdc-hide-more' );
            }
        });
    }
}
// END Load More Posts AJAX - WHITE

// BEG Smooth Scroll - FANCY
function asdcSmoothScroll( filter, correction ) {
    jQuery( 'html, body' ).animate({
        scrollTop: jQuery( filter ).offset().top + correction
    }, 800, function(){});
}
// END Smooth Scroll - FANCY

// BEG Click Anywhere to Close - WHITE
function registerClickAnywhereToClose() {
    var popups = jQuery( '.asdc-popup' );
    jQuery( document ).mouseup( function ( e ) {
        if ( ! popups.is( e.target ) && popups.has( e.target ).length === 0) {
            popups.removeClass( 'show' );
            asdcPopWrap.removeClass( 'show' );
            setupPopupBackground( 'reset' );
        }
    });
    jQuery( document ).touchend( function ( e ) {
        if ( ! popups.is( e.target ) && popups.has( e.target ).length === 0) {
            popups.removeClass( 'show' );
            asdcPopWrap.removeClass( 'show' );
            setupPopupBackground( 'reset' );
        }
    });

    var search = jQuery( '.searchform.type-hidden' );
    jQuery( document ).mouseup( function ( e ) {
        if ( ! search.is( e.target ) && search.has( e.target ).length === 0) {
            search.removeClass( 'show' );
        }
    });
    jQuery( document ).touchend( function ( e ) {
        if ( ! search.is( e.target ) && search.has( e.target ).length === 0) {
            search.removeClass( 'show' );
        }
    });
}
// END Click Anywhere to Close - WHITE

// BEG Multi Newsletter - AIR
function registerMultiNewsletter() {
    var newsletters = jQuery( '.multi-newsletter' );
    if ( ! newsletters.length > 0 ) {return;}
    newsletters.each( function() {
        var newsletter = jQuery( this );
        var checkboxes = newsletter.find( '.newsletter-checkbox' );
        checkboxes.click( function() {
            jQuery( this ).toggleClass( 'checked' );
        });
        var form = newsletter.find( '.multi-form' );
        form.on('submit', function(e) {
            e.preventDefault();
            var input = form.find('input');
            var inputVal = input.val();
            var inputs = newsletter.find( 'input.yikes-easy-mc-email' );
            var submits = newsletter.find( '.yikes-easy-mc-submit-button' );
            var checkboxes = newsletter.find( '.newsletter-checkbox' );
            var status = false;
            checkboxes.each( function( index ) {
                var t = jQuery( this );
                if ( t.hasClass( 'checked' ) ) {
                    inputs.eq(index).val( inputVal );
                    submits.eq(index).click();
                    status = true;
                }
            });
            newsletter.find( '.asdc-msg' ).remove();
            if ( status == false ) {
                newsletter.append('<div class="asdc-msg bad-msg">Oh shoot, you have to select a list before subscribing.</div>');
            }
            else {
                newsletter.append('<div class="asdc-msg good-msg">Yes! You\'re Awesome.</div>');
                input.val('');
            }
        });
        newsletter.addClass('registered');
    });
}
// END Multi Newsletter - AIR

// BEG Hide Messages - AIR
function registerHideNewsletterMessages() {
    var forms = jQuery( '.yikes-easy-mc-form' );
    if ( ! forms.length > 0 ) {return;}
    var newsletterTimer = null;
    forms.on( 'submit', function() {
        if ( newsletterTimer ) {
            clearTimeout( newsletterTimer );
            newsletterTimer = null;
        }
        newsletterTimer = setTimeout( function() {
            var messages = jQuery( '.yikes-easy-mc-success-message, .yikes-easy-mc-error-message' );
            messages.remove();
        }, 10000 );
    });
}
// END Hide Messages - AIR

// BEG Auto Sliding - AIR
function registerAutoSlide() {
    var sliders = jQuery( '.testimonials-slider' );
    if ( ! sliders.length > 0 ) {return;}
    var sliderIntervals = [];
    sliders.each( function( index ) {
        var slider = jQuery( this );
        var buttons = slider.find( '.asdc-slider-arrow' );
        var button = slider.find( '.asdc-slider-arrow.right' );
        function changeSlide() {
            if ( ! slider.is( ':hover' ) && ! slider.hasClass( 'pressed' ) && slider.isOnScreen() ) {
                button.click();
            }
        }
        sliderIntervals[index] = setInterval( changeSlide, 5000 );
        buttons.on( 'click', function() {
            clearInterval( sliderIntervals[index] );
            sliderIntervals[index] = setInterval( changeSlide, 5000 );
        } );
    });
}
// END Auto Sliding - AIR

// BEG Check if visible on screen - AIR
jQuery.fn.isOnScreen = function(){
    var win = jQuery(window);
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
};
// END Check if visible on screen - AIR

// BEG Newsletter Popup Trigger - AIR
function registerNewsletterTrigger() {
    var triggers = jQuery( '.asdc-newsletter-popup-trigger, a[href="#subscribe"]' );
    triggers.click( function( e ) {
        e.preventDefault();
        togglePopup( '.newsletter-popup' );
    });

    var triggers2 = jQuery( '.asdc-download-popup-trigger, a[href="#download"]' );
    triggers2.click( function( e ) {
        e.preventDefault();
        togglePopup( '.download-popup' );
    });
}
// END Newsletter Popup Trigger - AIR

// BEG Newsletter Popup Auto Trigger - AIR
function greetAutoNewsletterPopup() {
    if ( ! jQuery( '#asdc-auto-popup' ).hasClass( 'no-pop' ) ) {
        togglePopup( '.newsletter-popup' );
    }
}
// END Newsletter Popup Auto Trigger - AIR
//// END Common Functions - AIR



//// BEG CUSTOM - CROWN
function setupPageFullHeight() {
    var main = jQuery('#asdc-main');
    main.css('padding', '');
    var bodyH = asdcBody.outerHeight();
    var windowH = jQuery(window).height();
    if (bodyH < windowH) {
        var half = (windowH - bodyH) / 2;
        main.css('padding', half+'px'+' '+0);
    }
}

function setupContactPage() {
    // contact-page-row-1, contact-page-row-2, contact-page-row-2-1, contact-page-column-image
    var row1 = jQuery('.contact-page-row-1');
    if (!row1.length > 0) {return;}
    var row2 = jQuery('.contact-page-row-2');
    var row21 = jQuery('.contact-page-row-2-1');
    var col = jQuery('.contact-page-column-image');
    if (tabletIndicator.is(':visible')) {
        if (!row2.hasClass('tablet-render')) {
            row1.append(col);
            row2.addClass('tablet-render');
        }
    } else {
        if (row2.hasClass('tablet-render')) {
            row21.append(col);
            row2.removeClass('tablet-render');
        }
    }
}

function setupAboutPage() {
    // .about-page-row-1, .about-page-row-2, .about-page-image
    var row1 = jQuery('.about-page-row-1');
    var row2 = jQuery('.about-page-row-2');
    var image;
    if (mobileIndicator.is(':visible')) {
        if (!row1.hasClass('mobile-render')) {
            image = jQuery('.about-page-image');
            row2.prepend(image);
            row1.addClass('mobile-render');
        }
    } else {
        if (row1.hasClass('mobile-render')) {
            image = jQuery('.about-page-image');
            row1.append(image);
            row1.removeClass('mobile-render');
        }
    }
}

function setupFooter() {
    var footer = jQuery('footer');
    var col1, col3, wrapper;
    if (tabletIndicator.is(':visible')) {
        if (!footer.hasClass('mobile-render')) {
            col1 = footer.find('.col-left');
            col3 = footer.find('.col-right');
            wrapper = footer.find('.row-1 .row-wrapper');
            wrapper.append(col3);
            wrapper.append(col1);
            footer.addClass('mobile-render');
        }
    } else {
        if (footer.hasClass('mobile-render')) {
            col1 = footer.find('.col-left');
            var col2 = footer.find('.col-mid');
            col3 = footer.find('.col-right');
            wrapper = footer.find('.row-1 .row-wrapper');
            wrapper.append(col1);
            wrapper.append(col2);
            wrapper.append(col3);
            footer.removeClass('mobile-render');
        }
    }
}

function setupStickyNav() {
    var r1 = jQuery('header .row-1');
    var r2 = jQuery('header .row-2');
    var docViewTop = jQuery(window).scrollTop();
    var r2IdexTop = r2.offset().top;
    var r2IdexBot = r2IdexTop + r2.height();
    if (docViewTop > r2IdexBot) {
        asdcBody.addClass('asdc-desktop-sticky-nav');
    } else {
        asdcBody.removeClass('asdc-desktop-sticky-nav');
    }
}

function setupEqualColumns() {
    var equal_ids = ['about-page-image'];
    for (var i = 0; i < equal_ids.length; i++) {
        var id = equal_ids[i];
        var origin = jQuery('.'+id);
        var ref = jQuery('.'+id+'-ref');
        origin.css('height', ref.outerHeight());
    }
}

function setupTrapezoid() {
    var trapezoids = jQuery('.trapezoid');
    trapezoids.each(function() {
        var t = jQuery(this);
        var windowW = jQuery(window).width();
        var row = t.closest('.vc_row');
        if (t.hasClass('upper')) {
            var upper = t.find('.upper-section');
            if (t.hasClass('upper-left')) {
                upper.css('border-right-width', windowW);
            } else if (t.hasClass('upper-right')) {
                upper.css('border-left-width', windowW);
            }
        }
        if (t.hasClass('lower')) {
            var lower = t.find('.lower-section');
            if (t.hasClass('lower-left')) {
                lower.css('border-right-width', windowW);
            } else if (t.hasClass('lower-right')) {
                lower.css('border-left-width', windowW);
            }
        }
    });
}
//// END Custom Functions - CROWN

function setupSliderType1(type) {
    // full width slides
    // no margin slides
    // infinite slides
    // X axis
    // dragging
    // fill height .fill-height
    // lazy load .lazy-load
    // mapping .mapping

    var sliders = jQuery('.asdc-slider.slider-type-1');
    if (!sliders.length > 0) {return;}
    sliders.each(function() {
        var slider = jQuery(this);
        var sliderBand = slider.find('.asdc-slider-band');
        var slides = slider.find('.asdc-slider-slide');
        var sliderW = slider.width();
        var sliderWindow = slider.find('.asdc-slider-window');
        var firstVisibleSlideNumber = parseInt(slider.attr('currentslide'));
        var bullets = slider.find('.asdc-slider-bullet');
        var scFillHeight = (slider.hasClass('fill-height')) ? 1 : 0;

        if (slides.length == 1) {
            slider.addClass('one-slide');
        } else if (slides.length == 2) {
            slider.addClass('two-slide');
        }
        if (slider.hasClass('two-slide')) {
            // Clone the slides
            if (!slider.hasClass('cloned')) {
                sliderBand.append(slides.eq(0).clone().attr('slidenr', 3));
                sliderBand.append(slides.eq(1).clone().attr('slidenr', 4));
            }
            slider.addClass('cloned');
            slides = slider.find('.asdc-slider-slide');
        }

        // Set full width to slides
        slides.css('width', sliderW);

        // Check if he need full height
        var sliderBandW = 0;
        if (scFillHeight == 1) {
            var slideMaxHeight = 0;
            slides.css('height', '');
            // Set the width and height to the band
            slides.each(function() {
                var t = jQuery(this);
                t.removeClass('lazy-load');
                var thisSlideH = t.height();
                sliderBandW += t.width();
                if (slideMaxHeight < thisSlideH) {
                    slideMaxHeight = thisSlideH;
                }
            });
            sliderBand.css('width', sliderBandW);
            slides.css('height', slideMaxHeight);
        } else {
            // Set the width to the band
            slides.each(function() {
                var t = jQuery(this);
                t.removeClass('lazy-load');
                sliderBandW += t.width();
            });
            sliderBand.css('width', sliderBandW);
        }

        // Setup the slider on resize
        if (type == 'resize') {
            setTimeout(function() {
                bullets.filter('[bulletnr="'+firstVisibleSlideNumber+'"]').click();
            }, 250);
        }

        if (!slider.hasClass('registered')) {
            if (!slider.hasClass('one-slide')) {
                // Register Dragging X axis
                var dragging = false;
                var initialAx;
                var currentAx;
                var pageAx;
                var sliderLinks = sliderBand.find( 'a' );
                sliderLinks.click(function(e) {
                    var link = jQuery(this);
                    if (link.hasClass('disable-link')) {
                        e.preventDefault();
                    }
                });
                sliderWindow.on('mousedown touchstart', function(e) {
                    var mouseType = e.which;
                    if (mouseType == 1 || mouseType == 0) {
                        if (mouseType == 1) {pageAx = e.pageX;}
                        else {pageAx = e.originalEvent.changedTouches[0].pageX;}
                        dragging = true;
                        initialAx = pageAx;
                        currentAx = pageAx;
                    }
                });
                sliderWindow.on('mousemove touchmove', function(e) {
                    var mouseType = e.which;
                    if (mouseType == 1 || mouseType == 0) {
                        if (dragging == true) {
                            if (mouseType == 1) {pageAx = e.pageX;}
                            else {pageAx = e.originalEvent.changedTouches[0].pageX;}
                            currentAx = pageAx;
                            var moveAx = currentAx - initialAx;
                            sliderBand.css({
                                'margin-left' : moveAx
                            });
                        }
                    }
                });
                sliderWindow.on('mouseup mouseleave touchend touchcancel', function(e) {
                    dragging = false;
                    var mouseType = e.which;
                    if (mouseType == 1 || mouseType == 0) {
                        if (mouseType == 1) {pageAx = e.pageX;}
                        else {
                            if (e.originalEvent.changedTouches) {
                                pageAx = e.originalEvent.changedTouches[0].pageX;
                            } else {return;}
                        }
                        var differenceAx = initialAx - currentAx;
                        sliderBand.css('margin-left', '');

                        if ((Math.abs(differenceAx) > 30)) {
                            sliderLinks.addClass('disable-link');
                            var dragDirection = '';
                            if (differenceAx > 30) {
                                dragDirection = 'left';
                            } else if (differenceAx < -30) {
                                dragDirection = 'right';
                            }

                            var sliderBandAx = sliderBand.css('transform').split(/[()]/)[1];
                            if (sliderBandAx) {
                                sliderBandAx = parseInt(sliderBandAx.split(',')[4]);
                            }

                            sliderBandAx -= differenceAx;

                            sliderBand.css({
                                'transform' : 'translateX('+sliderBandAx+'px)',
                                '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
                            });

                            setTimeout(function() {
                                if (dragDirection == 'left') {
                                    slider.find('.asdc-slider-arrow.right').click();
                                } else if (dragDirection == 'right') {
                                    slider.find('.asdc-slider-arrow.left').click();
                                }
                            }, 0);
                        }
                    }
                    setTimeout(function() {
                        sliderLinks.removeClass('disable-link');
                    }, 500);

                });
            }
            if (!slider.hasClass('one-slide')) {
                // Put last slide in front
                var slideLast = slides.last();
                var slideLastW = slideLast.width();
                sliderBand.prepend(slideLast);
                var sliderBandAx = 0 - slideLastW;
                sliderBand.css({
                    'transform' : 'translateX('+sliderBandAx+'px)',
                    '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
                });
            }
            slider.addClass('registered');
        }
    });
}

function asdcChangeSlideType1(obj) {
    /*
    .mapping - will update the current slider on front end
     */

    var trigger = jQuery(obj);
    var slider = trigger.closest('.asdc-slider');
    if (slider.hasClass('loading')) {return;}
    var sliderAnimationTime = 250;
    var sliderBand = slider.find('.asdc-slider-band');
    var slides = slider.find('.asdc-slider-slide');
    var bullets = slider.find('.asdc-slider-bullet');
    var sliderW = slider.width();
    var sliderBandAx = 0;
    var triggerType;
    var firstVisibleSlideNumber = parseInt(slider.attr('currentslide'));
    var firstVisibleSlideNumberSet;
    var slidesProcessed = false;

    // Check the trigger type
    if (trigger.hasClass('asdc-slider-bullet')) {
        triggerType = 'bullet';
        firstVisibleSlideNumberSet = parseInt(trigger.attr('bulletnr'));
        slides.each(function() {
            var slide = jQuery(this);
            if (parseInt(slide.attr('slidenr')) == 1) {
                return false;
            } else {
                var slideClone = slide.clone();
                slide.remove();
                sliderBand.append(slideClone);
                slidesProcessed = true;
            }
        });
        slides = slider.find('.asdc-slider-slide');
        slides.each(function() {
            var slide = jQuery(this);
            var slideW = slide.width();
            var slideNumber = parseInt(slide.attr('slidenr'));
            sliderBandAx -= slideW;
            if (slideNumber == firstVisibleSlideNumber) {return false;}
        });
        sliderBandAx += sliderW;
        sliderBand.css({
            'transform' : 'translateX('+sliderBandAx+'px)',
            '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
        });
        sliderBandAx = 0;
    } else {
        triggerType = 'arrow';
        var arrowDirection;
        if (trigger.hasClass('left')) {
            arrowDirection = 'left';
            firstVisibleSlideNumberSet = firstVisibleSlideNumber - 1;
            if (firstVisibleSlideNumberSet == 0) {
                firstVisibleSlideNumberSet = slides.length;
            }
        } else {
            arrowDirection = 'right';
            firstVisibleSlideNumberSet = firstVisibleSlideNumber + 1;
            if (firstVisibleSlideNumberSet > slides.length) {
                firstVisibleSlideNumberSet = 1;
            }
        }
    }

    // Detect the desired slide
    slides.each(function() {
        var slide = jQuery(this);
        var slideW = slide.width();
        var slideNumber = parseInt(slide.attr('slidenr'));
        if (slideNumber == firstVisibleSlideNumberSet) {return false;}
        else {sliderBandAx -= slideW;}
    });

    // Position the band
    if (slidesProcessed == true) {
        setTimeout(function() {
            slider.addClass('loading');
            sliderBand.css({
                'transform' : 'translateX('+sliderBandAx+'px)',
                '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
            });
        }, 0);
    } else {
        slider.addClass('loading');
        sliderBand.css({
            'transform' : 'translateX('+sliderBandAx+'px)',
            '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
        });
    }

    // Set the bullets
    bullets.removeClass('active');
    if (slider.hasClass('two-slide')) {
        if (firstVisibleSlideNumberSet == 1 || firstVisibleSlideNumberSet == 3) {
            bullets.filter('[bulletnr="1"]').addClass('active');
        } else if (firstVisibleSlideNumberSet == 2 || firstVisibleSlideNumberSet == 4) {
            bullets.filter('[bulletnr="2"]').addClass('active');
        }
    } else {
        bullets.filter('[bulletnr="'+firstVisibleSlideNumberSet+'"]').addClass('active');
    }

    // Last process
    setTimeout(function() {
        var slideLast = slides.last();
        var slideLastW = slideLast.width();
        var slideFirst = slides.first();
        var slideFirstW = slideFirst.width();
        if (triggerType=='arrow') {
            if (arrowDirection == 'left') {
                sliderBand.prepend(slideLast);
                sliderBandAx -= slideLastW;
            } else {
                sliderBand.append(slideFirst);
                sliderBandAx += slideFirstW;
            }
        } else if (triggerType == 'bullet') {
            if (firstVisibleSlideNumberSet == 1) {
                sliderBand.prepend(slideLast);
                sliderBandAx -= slideLastW;
            } else if (firstVisibleSlideNumberSet == slides.length) {
                sliderBand.append(slideFirst);
                sliderBandAx += slideFirstW;
            }
        }
        sliderBand.css({
            'transform' : 'translateX('+sliderBandAx+'px)',
            '-webkit-transform' : 'translateX('+sliderBandAx+'px)'
        });
        slider.attr('currentslide',firstVisibleSlideNumberSet);
        if (slider.hasClass('mapping')) {
            slider.find('.current-map').text(firstVisibleSlideNumberSet);
        }
        slider.removeClass('loading');
    }, sliderAnimationTime);
}