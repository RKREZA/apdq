@php
    $frontend_setting   = \Modules\FrontEndManager\Entities\FrontendSetting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    @yield('seo')

    @if (empty($frontend_setting->favicon))
        <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.webp') }}">
    @else
        <link rel="shortcut icon" href="{{ $frontend_setting->favicon }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link href="{{ asset('assets/backend/css/sweetalert.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

    <style>

    </style>

    @stack('css')

</head>

<body>
    <div class="main-wrapper">
        @include('frontend::frontend.layouts.preloader')
        @include('frontend::frontend.layouts.header')
        <div class="content_wrapper mt-5 pt-3">
            @include('frontend::frontend.layouts.aside')
            <div class="content mt-5">
                @yield('content')
                @include('frontend::frontend.layouts.footer')
            </div>
        </div>
    </div>

    <!-- Jquery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('assets/backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/WOW.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>

    <script>
        (function() {
            var Util,
                __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

            Util = (function() {
                function Util() {}

                Util.prototype.extend = function(custom, defaults) {
                var key, value;
                for (key in custom) {
                    value = custom[key];
                    if (value != null) {
                    defaults[key] = value;
                    }
                }
                return defaults;
                };

                Util.prototype.isMobile = function(agent) {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
                };

                return Util;

            })();

            this.WOW = (function() {
                WOW.prototype.defaults = {
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true
                };

                function WOW(options) {
                if (options == null) {
                    options = {};
                }
                this.scrollCallback = __bind(this.scrollCallback, this);
                this.scrollHandler = __bind(this.scrollHandler, this);
                this.start = __bind(this.start, this);
                this.scrolled = true;
                this.config = this.util().extend(options, this.defaults);
                }

                WOW.prototype.init = function() {
                var _ref;
                this.element = window.document.documentElement;
                if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
                    return this.start();
                } else {
                    return document.addEventListener('DOMContentLoaded', this.start);
                }
                };

                WOW.prototype.start = function() {
                var box, _i, _len, _ref;
                this.boxes = this.element.getElementsByClassName(this.config.boxClass);
                if (this.boxes.length) {
                    if (this.disabled()) {
                    return this.resetStyle();
                    } else {
                    _ref = this.boxes;
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        this.applyStyle(box, true);
                    }
                    window.addEventListener('scroll', this.scrollHandler, false);
                    window.addEventListener('resize', this.scrollHandler, false);
                    return this.interval = setInterval(this.scrollCallback, 50);
                    }
                }
                };

                WOW.prototype.stop = function() {
                window.removeEventListener('scroll', this.scrollHandler, false);
                window.removeEventListener('resize', this.scrollHandler, false);
                if (this.interval != null) {
                    return clearInterval(this.interval);
                }
                };

                WOW.prototype.show = function(box) {
                this.applyStyle(box);
                return box.className = "" + box.className + " " + this.config.animateClass;
                };

                WOW.prototype.applyStyle = function(box, hidden) {
                var delay, duration, iteration;
                duration = box.getAttribute('data-wow-duration');
                delay = box.getAttribute('data-wow-delay');
                iteration = box.getAttribute('data-wow-iteration');
                return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
                };

                WOW.prototype.resetStyle = function() {
                var box, _i, _len, _ref, _results;
                _ref = this.boxes;
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    box = _ref[_i];
                    _results.push(box.setAttribute('style', 'visibility: visible;'));
                }
                return _results;
                };

                WOW.prototype.customStyle = function(hidden, duration, delay, iteration) {
                var style;
                style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
                if (duration) {
                    style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
                }
                if (delay) {
                    style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
                }
                if (iteration) {
                    style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
                }
                return style;
                };

                WOW.prototype.scrollHandler = function() {
                return this.scrolled = true;
                };

                WOW.prototype.scrollCallback = function() {
                var box;
                if (this.scrolled) {
                    this.scrolled = false;
                    this.boxes = (function() {
                    var _i, _len, _ref, _results;
                    _ref = this.boxes;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        if (!(box)) {
                        continue;
                        }
                        if (this.isVisible(box)) {
                        this.show(box);
                        continue;
                        }
                        _results.push(box);
                    }
                    return _results;
                    }).call(this);
                    if (!this.boxes.length) {
                    return this.stop();
                    }
                }
                };

                WOW.prototype.offsetTop = function(element) {
                var top;
                top = element.offsetTop;
                while (element = element.offsetParent) {
                    top += element.offsetTop;
                }
                return top;
                };

                WOW.prototype.isVisible = function(box) {
                var bottom, offset, top, viewBottom, viewTop;
                offset = box.getAttribute('data-wow-offset') || this.config.offset;
                viewTop = window.pageYOffset;
                viewBottom = viewTop + this.element.clientHeight - offset;
                top = this.offsetTop(box);
                bottom = top + box.clientHeight;
                return top <= viewBottom && bottom >= viewTop;
                };

                WOW.prototype.util = function() {
                return this._util || (this._util = new Util());
                };

                WOW.prototype.disabled = function() {
                return !this.config.mobile && this.util().isMobile(navigator.userAgent);
                };

                return WOW;

            })();

        }).call(this);


        wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100
        }
        );
        wow.init();

    </script>



@if(session('error'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="25000">
            <div class="toast-body">
                <button type="button" class="btn-close float-end text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                {{ session('error') }}
            </div>
        </div>
    </div>

    <script>
        var toastEl = document.querySelector('.toast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    </script>
@endif


    <script>
        $(document).ready(function() {
            // Add a click event handler to the button
            $(".drawer_icon").click(function() {
                // Toggle the 'active' class on the '.drawer' element
                $(".drawer").toggleClass("drawer_shrink");
                $(".content").toggleClass("drawer_content");
            });
        });
    </script>

    @stack('js')

</body>

</html>
