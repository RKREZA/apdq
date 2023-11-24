(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
        $('.hero-slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: false,
            autoplay: true,
            autoplaySpeed: 3000,
            fade: true,
            adaptiveHeight: true,
            prevArrow: $('.hero_prev'),
            nextArrow: $('.hero_next'),

        });

        // $('#dictum').slick({
        //     speed: 15000,
        //     autoplay: true,
        //     autoplaySpeed: 0,
        //     centerMode: false,
        //     cssEase: 'linear',
        //     slidesToShow: 1,
        //     draggable:false,
        //     focusOnSelect:false,
        //     pauseOnFocus:true,
        //     pauseOnHover:true,
        //     slidesToScroll: 1,
        //     variableWidth: true,
        //     infinite: true,
        //     initialSlide: 1,
        //     arrows: false,
        //     buttons: false,
        // });

        $(function () {
            $('.marquee').marquee({
                allowCss3Support: true,
                css3easing: 'linear',
                easing: 'linear',
                delayBeforeStart: 1000,
                direction: 'left',
                duplicated: false,
                duration: 35000,
                gap: 20,
                pauseOnCycle: false,
                startVisible: true,
                pauseOnHover: true

            });
        });

         $(".mainmenu ul li:has(ul)").addClass("has-submenu");
        $(".mainmenu ul li:has(ul.sub-menu)").addClass("small-submenu");
        $(".mainmenu ul li ul").addClass("sub-menu");
        $(".mainmenu ul.dropdown li").hover(function () {
            $(this).addClass("hover")
        }, function () {
            $(this).removeClass("hover")
    });

    var $menu = $("#menu"),
        $menulink = $("#spinner-form"),
        $menuTriggercont = $(".spinner-master"),
        $menuTrigger = $(".has-submenu > a"),
        $header_area = $(".header_area");
    $menulink.click(function (e) {
        $menulink.toggleClass("active");
        $menu.toggleClass("active");
        $menuTriggercont.toggleClass("active");
        $header_area.toggleClass("active");
    });

    $menuTrigger.click(function (e) {
        e.preventDefault();
        var t = $(this);
        t.toggleClass("active").next("ul").toggleClass("active")
    });

    $(".mainmenu ul li:has(ul)");


    })


    $('.zoom').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
        gallery: {
            enabled: true
        },
        titleSrc: 'title',

        zoom: {
            enabled: true,

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            opener: function (openerElement) {

                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }

    });

}(jQuery));



$(window).on('load', function(){
    $(".preloader").delay(2000).fadeOut("slow");
});

if ($(window).width() > 700) {
    $(window).scroll(function(){
        if ($(this).scrollTop() > 235) {
            $('.nav-bar-main').addClass('fixed-element');
        } else {
            $('.nav-bar-main').removeClass('fixed-element');
        }
    });
}
