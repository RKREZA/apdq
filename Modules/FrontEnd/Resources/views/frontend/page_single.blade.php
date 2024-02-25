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
        .description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }
    </style>
@endpush

@section('content')

<section id="video" class="pb-5 mx-3">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-10 mb-4">
                <h5 class="m-0 mt-2 text-light">{{ $page->title }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="description">
                    {!! $page->description !!}
                </div>
            </div>

        </div>
    </div>
</section>

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
