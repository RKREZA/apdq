@extends('frontend::frontend.layouts.master')

@section('title')
    {{ $frontend_setting->title }}
@endsection
@section('seo')
    <meta name="title" content="Vidéo">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/video.webp" alt="">
    <div class="content">
        <h1>Vidéos</h1>
    </div>
</section>

<section id="video" class="py-5">
    <div class="container py-4">
        <div class="row">

            @foreach ($videos as $video)

                <div class="col-md-3 mb-4">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});background-size: cover;height: 170px;background-position: center;">
                                {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.png') }}';" alt=""> --}}
                            </div>
                            <div class="video-content p-3">
                                <h6><a href="#" class="link-dark">{{ $video->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-6">
                                        <small><a href="" class="text-muted"><i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}</a></small>
                                    </div>
                                    <div class="col-6 text-end text-muted">
                                        <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($video->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="row">
            <div class="col-md-12">
                {{ $videos->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</section>

@endsection


@push('js')

@endpush
