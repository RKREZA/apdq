@extends('frontend::frontend.layouts.master')

@section('title')
À propos
@endsection
@section('seo')
    <meta name="title" content="À propos">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="À propos" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/about.webp" alt="">
    <div class="content">
        <h1>À propos</h1>
    </div>
</section>

@endsection


@push('js')

@endpush
