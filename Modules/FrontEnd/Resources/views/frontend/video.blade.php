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
        #video_page{
            background: #fafafa;
        }
        #video_page .image-container {
            background-size: cover;
            height: 170px;
            background-position: center;
            border-radius: 10px;
        }
        #video_page .image-container::before {
            content: "";
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url(/assets/frontend/img/play.png);
            background-size: cover;
            background-position: center;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
            width: 75px;
            height: 75px;
        }
        #video_page .video-content h6 {
            max-height: 40px;
            overflow: hidden;
        }
        #video_page .video-content .sub-content {
            max-height: 30px;
            overflow: hidden;
        }
        #video_page .sub-content small, #video_page .sub-content small a {
            font-size: 11px;
            color: #9e9e9e;
        }
        .embed_code iframe{
            width: 100%;
            height: auto;
            min-height: 60vh;
        }
        .recent_post ul{
            list-style-type: none;
            padding-left: 0;
        }

        div#social-links {
            margin: 0 auto;
        }
        div#social-links ul {
            padding-left: 0;
        }
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            padding: 10px 13px;
            margin: 3px;
            font-size: 20px;
            color: #0dcaf0;
            background-color: #fff;
        }
        div#social-links ul li a:hover {
            color: #fff;
            background-color: #0dcaf0;
        }
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/video.webp" alt="">
    <div class="content">
        <h1>Vidéos</h1>
        <h6>Politique sans Filtre, Rires Garantis</h6>
    </div>
</section>

<section id="video_page" class="py-5">
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
                                <div class="card-body p-0 bg-white">
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
