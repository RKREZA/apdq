@extends('frontend::frontend.layouts.master')

@section('title')
Vidéo
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


            <div class="col-md-4" id="filter">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mt-2">Filter</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Category</h6>
                                <ul>
                                    @foreach($video_categories as $category)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="category_input{{ $category->code }}" value="{{ $category->code }}" @if(request()->code == $category->code) checked @endif>
                                            <label class="form-check-label" for="category_input{{ $category->code }}">
                                                {{ $category->name }}
                                            </label>
                                          </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    @foreach ($videos as $video)

                        <div class="col-md-4 mb-4">
                            <div class="card border-0">
                                <div class="card-body p-0">
                                    <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                        <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});">
                                            {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.png') }}';" alt=""> --}}
                                        </div>
                                    </a>
                                    <div class="video-content p-3">
                                        <h6><a href="{{ route('frontend.video.single', $video->slug) }}" class="link-dark">{{ $video->title }}</a></h6>
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
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                {{ $videos->links('pagination::bootstrap-5') }}
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
