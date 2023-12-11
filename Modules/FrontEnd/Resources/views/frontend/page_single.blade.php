@extends('frontend::frontend.layouts.master')

@section('title')
{{ $page->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $page->seo_title }}">
    <meta name="description" content="{{ $page->seo_description }}">
    <meta name="keywords" content="{{ $page->seo_keyword }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $page->seo_description }}" />
    <meta property="og:image" content="/{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        .embed_code iframe{
            width: 100%;
            height: auto;
            min-height: 60vh;
        }
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/video.webp" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="content">
                    <h6 class="text-danger">Page</h6>
                    <h2>{{ $page->title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="video" class="py-5">
    <div class="container py-4">
        <div class="row">

            <div class="col-md-12 embed_code">
                {!! $page->embed_html !!}
            </div>

            <div class="col-md-12 mt-4">
                {!! $page->description !!}
            </div>

        </div>
    </div>
</section>
<hr class="horizontal dark">

@endsection


@push('js')
<script>
    $(document).ready(function() {
        $('input[type=radio][name=category]').on('change', function() {
            var selectedCategoryCode = $('input[type=radio][name=category]:checked').val();
            window.location.href = `{{ route('frontend.video') }}?code=` + selectedCategoryCode;
        });
    });
  </script>
@endpush
