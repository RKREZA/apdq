<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('page_title')
    </title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ (isset($settings->favicon)) ? $settings->favicon:'' }}">
    <link rel="icon" type="image/png" href="{{ (isset($settings->favicon)) ? $settings->favicon:'' }}">

    {{-- <meta name="title" content="{{ $settings->meta_title }}">
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="keywords" content="{{ $settings->meta_keywords }}">

    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $settings->social_title }}">
    <meta property="og:description" content="{{ $settings->social_description }}">
    <meta property="og:image" content="{{ $settings->meta_image }}"> --}}

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

<body class="bg-gray-200">


    @include('admin::layouts.includes.preloader')
    @yield('container')

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/backend/js/core/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/material-dashboard.js?v=3.0.1') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/feedback.js') }}"></script>

    @stack('js')

    @include('admin::layouts.includes.js.js_validation')
    @include('admin::layouts.includes.js.js_toaster')
</body>

</html>
