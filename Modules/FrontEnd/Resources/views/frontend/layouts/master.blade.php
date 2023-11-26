@php
    $frontend_setting   = \Modules\FrontEndManager\Entities\FrontendSetting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $frontend_setting->title }} | @yield('title')</title>

    @yield('seo')

    @if (empty($frontend_setting->favicon))
        <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}">
    @else
        <link rel="shortcut icon" href="{{ $frontend_setting->favicon }}">
    @endif

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{asset('assets/frontend/fonts/fonts.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/fonts/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-jvectormap-2.0.5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        
    </style>

    @stack('css')

</head>

<body>
    <div class="main-wrapper">
        @include('frontend::frontend.layouts.preloader')
        @include('frontend::frontend.layouts.header')
        @yield('content')
        @include('frontend::frontend.layouts.footer')
    </div>




    <!-- Jquery -->
    <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js" ></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <link href="{{ asset('assets/backend/css/iziToast.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/backend/js/iziToast.min.js')}}"></script>

    <script src="{{ asset('assets/frontend/js/jquery.marquee.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhHPOCq-RqOtN1zmTF8d7nI44jLuixlj4&libraries=places"></script>

    <script src="{{ asset('js/share.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    @stack('js')


    <script>
        if(typeof selector !== 'undefined'){
            $(selector).summernote({
                placeholder: '',
                tabsize: 2,
                height: height,
                width: '100%',
                toolbar: toolbar
            });
        }
    </script>


    @if (Session::has('success') && ($message = Session::get('success')))
        <script>
            iziToast.success({
                id: null,
                class: '',
                title: '',
                titleColor: 'green',
                titleSize: '',
                titleLineHeight: '',
                message: '{{ $message }}',
                messageColor: '',
                messageSize: '',
                messageLineHeight: '',
                backgroundColor: '',
                theme: 'light', // dark
                color: 'green', // blue, red, green, yellow
                icon: 'ico-success',
                iconText: '',
                iconColor: '#fff',
                iconUrl: null,
                image: '',
                imageWidth: 50,
                maxWidth: null,
                zindex: null,
                layout: 1,
                balloon: false,
                close: true,
                closeOnEscape: false,
                closeOnClick: false,
                displayMode: 0, // once, replace
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                target: '',
                targetFirst: true,
                timeout: 50000,
                rtl: false,
                animateInside: true,
                drag: true,
                pauseOnHover: true,
                resetOnHover: false,
                progressBar: true,
                progressBarColor: '',
                progressBarEasing: 'linear',
                overlay: false,
                overlayClose: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeInUp',
                transitionOutMobile: 'fadeOutDown',
                buttons: {},
                inputs: {},
                onOpening: function() {},
                onOpened: function() {},
                onClosing: function() {},
                onClosed: function() {}
            });
        </script>
    @elseif(Session::has('error') && ($message = Session::get('error')))
        <script>
            iziToast.error({
                id: null,
                class: '',
                title: '',
                titleColor: 'red',
                titleSize: '',
                titleLineHeight: '',
                message: '{{ $message }}',
                messageColor: '',
                messageSize: '',
                messageLineHeight: '',
                backgroundColor: '',
                theme: 'light', // dark
                color: 'red', // blue, red, green, yellow
                icon: 'ico-error',
                iconText: '',
                iconColor: '#fff',
                iconUrl: null,
                image: '',
                imageWidth: 50,
                maxWidth: null,
                zindex: null,
                layout: 1,
                balloon: false,
                close: true,
                closeOnEscape: false,
                closeOnClick: false,
                displayMode: 0, // once, replace
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                target: '',
                targetFirst: true,
                timeout: 50000,
                rtl: false,
                animateInside: true,
                drag: true,
                pauseOnHover: true,
                resetOnHover: false,
                progressBar: true,
                progressBarColor: '',
                progressBarEasing: 'linear',
                overlay: false,
                overlayClose: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeInUp',
                transitionOutMobile: 'fadeOutDown',
                buttons: {},
                inputs: {},
                onOpening: function() {},
                onOpened: function() {},
                onClosing: function() {},
                onClosed: function() {}
            });
        </script>
    @elseif(Session::has('warning') && ($message = Session::get('warning')))
        <script>
            iziToast.warning({
                id: null,
                class: '',
                title: '',
                titleColor: 'yellow',
                titleSize: '',
                titleLineHeight: '',
                message: '{{ $message }}',
                messageColor: '',
                messageSize: '',
                messageLineHeight: '',
                backgroundColor: '',
                theme: 'light', // dark
                color: 'yellow', // blue, red, green, yellow
                icon: 'ico-warning',
                iconText: '',
                iconColor: '#fff',
                iconUrl: null,
                image: '',
                imageWidth: 50,
                maxWidth: null,
                zindex: null,
                layout: 1,
                balloon: false,
                close: true,
                closeOnEscape: false,
                closeOnClick: false,
                displayMode: 0, // once, replace
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                target: '',
                targetFirst: true,
                timeout: 50000,
                rtl: false,
                animateInside: true,
                drag: true,
                pauseOnHover: true,
                resetOnHover: false,
                progressBar: true,
                progressBarColor: '',
                progressBarEasing: 'linear',
                overlay: false,
                overlayClose: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeInUp',
                transitionOutMobile: 'fadeOutDown',
                buttons: {},
                inputs: {},
                onOpening: function() {},
                onOpened: function() {},
                onClosing: function() {},
                onClosed: function() {}
            });
        </script>
    @elseif(Session::has('info') && ($message = Session::get('info')))
        <script>
            iziToast.info({
                id: null,
                class: '',
                title: '',
                titleColor: '#333',
                titleSize: '',
                titleLineHeight: '',
                message: '{{ $message }}',
                messageColor: '',
                messageSize: '',
                messageLineHeight: '',
                backgroundColor: '',
                theme: 'light', // dark
                color: '#fff', // blue, red, green, yellow
                icon: 'ico-info',
                iconText: '',
                iconColor: '#fff',
                iconUrl: null,
                image: '',
                imageWidth: 50,
                maxWidth: null,
                zindex: null,
                layout: 1,
                balloon: false,
                close: true,
                closeOnEscape: false,
                closeOnClick: false,
                displayMode: 0, // once, replace
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                target: '',
                targetFirst: true,
                timeout: 50000,
                rtl: false,
                animateInside: true,
                drag: true,
                pauseOnHover: true,
                resetOnHover: false,
                progressBar: true,
                progressBarColor: '',
                progressBarEasing: 'linear',
                overlay: false,
                overlayClose: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeInUp',
                transitionOutMobile: 'fadeOutDown',
                buttons: {},
                inputs: {},
                onOpening: function() {},
                onOpened: function() {},
                onClosing: function() {},
                onClosed: function() {}
            });
        </script>
    @elseif(Session::has('status') && ($message = Session::get('status')))
        <script>
            iziToast.show({
                id: null,
                class: '',
                title: '',
                titleColor: '#fff',
                titleSize: '',
                titleLineHeight: '',
                message: '{{ $message }}',
                messageColor: '',
                messageSize: '',
                messageLineHeight: '',
                backgroundColor: '',
                theme: 'light', // dark
                color: '#8cfc03', // blue, red, green, yellow
                icon: 'ico-success',
                iconText: '',
                iconColor: '#8cfc03',
                iconUrl: null,
                image: '',
                imageWidth: 50,
                maxWidth: null,
                zindex: null,
                layout: 1,
                balloon: false,
                close: true,
                closeOnEscape: false,
                closeOnClick: false,
                displayMode: 0, // once, replace
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                target: '',
                targetFirst: true,
                timeout: 50000,
                rtl: false,
                animateInside: true,
                drag: true,
                pauseOnHover: true,
                resetOnHover: false,
                progressBar: true,
                progressBarColor: '',
                progressBarEasing: 'linear',
                overlay: false,
                overlayClose: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeInUp',
                transitionOutMobile: 'fadeOutDown',
                buttons: {},
                inputs: {},
                onOpening: function() {},
                onOpened: function() {},
                onClosing: function() {},
                onClosed: function() {}
            });
        </script>
    @endif


    <script>
        $(document).ready(function(){
            @php
                $frontend_setting->hit = $frontend_setting->hit+1;
                $frontend_setting->save();
            @endphp
        });
    </script>

</body>

</html>
