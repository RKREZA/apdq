@php
    $settings = \Modules\Setting\Entities\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('page_title')
    </title>

    <link rel="apple-touch-icon" sizes="32x32" href="{{ (isset($settings->favicon)) ? $settings->favicon:'assets/backend/img/favicon.webp' }}">
    <link rel="apple-touch-icon" sizes="48x48" href="{{ (isset($settings->favicon)) ? $settings->favicon:'assets/backend/img/favicon.webp' }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ (isset($settings->favicon)) ? $settings->favicon:'assets/backend/img/favicon.webp' }}">
    <link rel="apple-touch-icon" sizes="128x128" href="{{ (isset($settings->favicon)) ? $settings->favicon:'assets/backend/img/favicon.webp' }}">
    <link rel="icon" type="image/png" href="{{ (isset($settings->favicon)) ? $settings->favicon:'assets/backend/img/favicon.webp' }}">

    <meta name="title" content="{{ $settings->meta_title }}">
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="keywords" content="{{ $settings->meta_keywords }}">

    <meta property="og:locale" content="{{ Session::get('locale') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $settings->social_title }}">
    <meta property="og:description" content="{{ $settings->social_description }}">
    <meta property="og:image" content="{{ $settings->meta_image }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('assets/fonts/font.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/material-dashboard.css?v=3.0.1') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/feedback.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet">

    @stack('css')

</head>

<body class="bg-gray-200 @if (Session::get('sidebar') == 'pin') g-sidenav-pinned @elseif(Session::get('sidebar') == 'unpin') g-sidenav-hidden @else g-sidenav-hidden @endif

    @if (Session::get('mode') == 'light')

    @elseif(Session::get('mode') == 'dark')
        dark-version
    @endif">


    @include('admin::layouts.includes.preloader')
    @include('admin::layouts.includes.aside')

    <main class="main-content g-sidenav-show position-relative max-height-vh-100 h-100 @if (Session::get('sidebar') == 'pin') g-sidenav-pinned @elseif(Session::get('sidebar') == 'unpin') g-sidenav-hidden @else g-sidenav-hidden @endif">
        @include('admin::layouts.includes.navbar')
        <div class="container-fluid py-2 px-3 content">
            @yield('container')
            @include('admin::layouts.includes.footer')
        </div>
    </main>

    @include('admin::layouts.includes.feedback')

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/backend/js/core/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://kit.fontawesome.com/037d9df8c4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/core/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/backend/js/material-dashboard.js?v=3.0.1') }}"></script> --}}
    <script src="{{ asset('assets/backend/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/feedback.js') }}"></script>


    @stack('js')

    @include('admin::layouts.includes.js.js_delete')
    @include('admin::layouts.includes.js.js_massdelete')
    @include('admin::layouts.includes.js.js_masstrash')

    @include('admin::layouts.includes.js.js_restore')
    @include('admin::layouts.includes.js.js_massrestore')

    @include('admin::layouts.includes.js.js_toaster')
    @include('admin::layouts.includes.js.js_validation')
    @include('admin::layouts.includes.js.js_summernote')
    @include('admin::layouts.includes.js.js_dropzone')
    @include('admin::layouts.includes.js.js_change_status')
    @include('admin::layouts.includes.js.js_change_default')

    <script>
        $('#datepicker').flatpickr({
            format: 'dd/mm/yyyy' // Set the date format
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#password_hide_show').on('click', function() {
                var password = $("#password");

                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    $('#password_hide_show_icon').html('visibility');
                } else {
                    password.attr('type', 'password');
                    $('#password_hide_show_icon').html('visibility_off');
                }
            });

            $('#password_hide_show_confirmation').on('click', function() {
                var password_confirmation = $("#password_confirmation");

                if (password_confirmation.attr('type') === 'password') {
                    password_confirmation.attr('type', 'text');
                    $('#password_hide_show_confirmation_icon').html('visibility');
                } else {
                    password_confirmation.attr('type', 'password');
                    $('#password_hide_show_confirmation_icon').html('visibility_off');
                }
            });
        });
    </script>

    <script>
        $("#name").keyup(function(){
            var title = this.value;
            title = title.toLowerCase()
                        .trim()
                        .replace(title, title)
                        .replace(/[^\w\s-]/g, '')
                        .replace(/^-+|-+$/g, '')
                        .replace(/\s/g, '-')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '')
                        .replace(/\-\-+/g, '-');
            $("#slug").val(title);
        });
    </script>

    <script>
        $('.modal').appendTo("body")
    </script>

</body>

</html>
