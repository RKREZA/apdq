// Set Sidebar
if ($(window).width() < 700) {
    $('body').removeClass("g-sidenav-pinned");
    $('body').addClass("g-sidenav-hidden");
}

$(".sidebar_event").on('click', function () {
    var that = this;
    $("body").toggleClass("g-sidenav-pinned g-sidenav-hidden");

    $.ajax({
        type: "GET",
        url: '/admin/set_sidebar',
        success: function (result) {
            // if (result == 'pin') {
            //     $('body').removeClass("g-sidenav-hidden");
            //     $('body').addClass("g-sidenav-pinned");
            // } else if(result == 'unpin') {
            //     $('body').removeClass("g-sidenav-pinned");
            //     $('body').addClass("g-sidenav-hidden");
            // }
        }
    });
});

// Set Mode (Light/Dark)
$("#mode").on('click', function () {
    var that = this;
    var switchValue = $(this).prop("checked");

    if(switchValue == true){
        $("body").addClass("dark-version");
        $("#web").attr("src", "/assets/backend/img/icons/optimized/monitor-white.png");
        $("#translate").attr("src", "/assets/backend/img/icons/optimized/translate-white.png");
        $("#notification").attr("src", "/assets/backend/img/icons/optimized/notification-white.png");
        $("#user").attr("src", "/assets/backend/img/icons/optimized/user-white.png");
        $("#feedback-icon").attr("src", "/assets/backend/img/icons/optimized/feedback-white.png");
        $("#nav").attr("src", "/assets/backend/img/icons/optimized/nav-white.png");
    }else{
        $("body").removeClass("dark-version");
        $("#web").attr("src", "/assets/backend/img/icons/optimized/monitor.png");
        $("#translate").attr("src", "/assets/backend/img/icons/optimized/translate.png");
        $("#notification").attr("src", "/assets/backend/img/icons/optimized/notification.png");
        $("#user").attr("src", "/assets/backend/img/icons/optimized/user.png");
        $("#feedback-icon").attr("src", "/assets/backend/img/icons/optimized/feedback.png");
        $("#nav").attr("src", "/assets/backend/img/icons/optimized/nav.png");
    }

    $.ajax({
        type: "GET",
        url: '/admin/set_mode',
        success: function (result) {
            if (result == 'light') {
                $("body").removeClass("dark-version");
                $("#web").attr("src", "/assets/backend/img/icons/optimized/monitor.png");
                $("#translate").attr("src", "/assets/backend/img/icons/optimized/translate.png");
                $("#notification").attr("src", "/assets/backend/img/icons/optimized/notification.png");
                $("#user").attr("src", "/assets/backend/img/icons/optimized/user.png");
                $("#feedback-icon").attr("src", "/assets/backend/img/icons/optimized/feedback.png");
                $("#nav").attr("src", "/assets/backend/img/icons/optimized/nav.png");
            } else if (result == 'dark') {
                $("body").addClass("dark-version");
                $("#web").attr("src", "/assets/backend/img/icons/optimized/monitor-white.png");
                $("#translate").attr("src", "/assets/backend/img/icons/optimized/translate-white.png");
                $("#notification").attr("src", "/assets/backend/img/icons/optimized/notification-white.png");
                $("#user").attr("src", "/assets/backend/img/icons/optimized/user-white.png");
                $("#feedback-icon").attr("src", "/assets/backend/img/icons/optimized/feedback-white.png");
                $("#nav").attr("src", "/assets/backend/img/icons/optimized/nav-white.png");
            }
        }
    });
});

// Preloader
$(".preloader").fadeOut(100);

// Set Scroll bar
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}

// Perfect Scrollbar
(function () {
    var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

    if (isWindows) {
        // if we are on windows OS we activate the perfectScrollbar function
        if (document.getElementsByClassName('main-content')[0]) {
            var mainpanel = document.querySelector('.main-content');
            var ps = new PerfectScrollbar(mainpanel);
        };

        if (document.getElementsByClassName('sidenav')[0]) {
            var sidebar = document.querySelector('.sidenav');
            var ps1 = new PerfectScrollbar(sidebar);
        };

        if (document.getElementsByClassName('navbar-collapse')[0]) {
            var fixedplugin = document.querySelector('.navbar-collapse');
            var ps2 = new PerfectScrollbar(fixedplugin);
        };

        if (document.getElementsByClassName('fixed-plugin')[0]) {
            var fixedplugin = document.querySelector('.fixed-plugin');
            var ps3 = new PerfectScrollbar(fixedplugin);
        };
    };
})();

// Disable on form submit
$(document).ready(function () {
    $("form").submit(function (event) {
        if ($('button[type="submit"]').is(':disabled')) {
            $('button[type="submit"]').removeAttr('disabled');
        } else {
            $('button[type="submit"]').attr('disabled', 'disabled');
            $('.edit-button').find('img').addClass('loading');
        }
    });
});

// Initialize Tooltip
$(document).ready(function () {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

// Back To Top
$(document).ready(function () {
    //Check to see if the window is top if not then display button
    $('.main-content').scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.backToTop').fadeIn();
        } else {
            $('.backToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.backToTop').click(function () {
        $('.main-content').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

});

// Set ID
function set_status_id(_this, id) {
    $('#id').val(id);
}

// Datepicker
$(".datepicker").flatpickr({
    enableTime: false,
    dateFormat: "Y-m-d",
    defaultDate: [""],
});

// Select2
$(document).ready(function () {
    $('.select2').select2();
});
