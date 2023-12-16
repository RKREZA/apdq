@extends('frontend::frontend.layouts.master')

@section('title')
En direct
@endsection
@section('seo')
    <meta name="title" content="En direct">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="En direct" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        iframe {
            width: 100%;
            min-height: 500px;
        }
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/live.webp" alt="">
    <div class="content">
        <h1>En direct</h1>
        <h6>En Direct et Sans Script : Humour Politique en Temps Réel</h6>
    </div>
</section>
<section id="video" class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($live)
                    {!! $live->embed_html !!}
                @else
                    <img src="{{ asset('assets/frontend/img/no-video.png') }}" alt="">
                @endif
            </div>
        </div>

    </div>
</section>

@endsection


@push('js')

@endpush
