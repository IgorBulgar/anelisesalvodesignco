$ = jQuery;
function homeAbout() {
    var signUpBlock = $('.signUp');
    if (mobileIndicator.is(':visible')) {
        if (!signUpBlock.hasClass('mobile-render')) {
            signUpBlock.addClass('mobile-render');
        }
    } else {
        if (signUpBlock.hasClass('mobile-render')) {
            signUpBlock.removeClass('mobile-render');
        }
    }

    if (signUpBlock.hasClass('mobile-render')) {
        $(".formSignUp").insertBefore(".imageSignup");
    } else {
        $(".formSignUp").insertAfter(".contentSignUp");
    }
}

jQuery(document).ready(function () {
    homeAbout();
});

jQuery(window).on('resize', function () {
    homeAbout();
});

//
// jQuery(window).resize(function(){
//     if (mobileIndicator.is(':visible')) {
//         $(".formSignUp").insertBefore(".imageSignup");
//     } else {
//
//         $(".formSignUp").insertAfter(".contentSignUp");
//     }
// });

