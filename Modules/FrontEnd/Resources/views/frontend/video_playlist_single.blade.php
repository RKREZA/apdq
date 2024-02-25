@extends('frontend::frontend.layouts.master')

@section('title')
{{ $videoplaylist->name }}
@endsection
@section('seo')
    <meta name="title" content="{{ $videoplaylist->name }}">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="{{ $videoplaylist->name }}" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        #video_page .image-container{
            background-size: cover;
            height: 180px;
            background-position: center;
        }
        /* #video .image-container:hover{
            content: '';

        } */

        /* #video_page .image-container::before {
            content: "";
            position: absolute;
            top: 24%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url(/assets/frontend/img/play.png);
            background-size: cover;
            background-position: center;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
            width: 40px;
            height: 40px;
        } */
        /* #video .image-container:hover::before {
            opacity: 1;
        } */


        #video_page .card{
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background: #2c2c2c82;
        }
        #video_page .card:hover{
            transform: scale(1.05);
        }
        #video_page img{
            width: 100%;
        }

        #video_page .video-content h6{
            max-height: 40px;
            overflow: hidden;
        }

        #video_page .video-content .sub-content{
            max-height: 30px;
            overflow: hidden;
        }


        #video_page .sub-content small,#video .sub-content small a{
            font-size: 11px;
            color: #9e9e9e;
        }

        #video_page .sub-content small a:hover{
            color: #0D99DC !important;
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

<section id="video_page" class="pb-5">
    <div class="container-fluid py-2">


        <div class="row">

            <div class="col-md-10 mb-4">
                <h5 class="m-0 text-light"><i class="fi fi-rs-list-music" style="position: relative; top: 3px"></i> Playlist vidéo <i class="fi fi-sr-angle-small-right" style="position: relative; top:3px;"></i> {{ $videoplaylist->name }}</h5>
            </div>

            <div class="col-md-12">
                <div class="row">
                    @foreach ($videos as $video)

                        <div class="col-md-3 mb-4">
                            <div class="card border-0">
                                <div class="card-body p-0">


                                    @if ($video['content_type'] == 'paid')
                                        <div class="premium" style="position: absolute; right: 10px; top: 10px;">
                                            <img class="crown" src="{{ asset('assets/frontend/img/crown.svg') }}" style="    background: #000;
                                            padding: 10px;
                                            border-radius: 6px;"></img>
                                        </div>
                                    @endif
                                    @if ($video['content_type'] == 'paid')
                                        @if(auth()->user() && isset(auth()->user()->subscriptionStatus()['optionPremiumContent']) && auth()->user()->subscriptionStatus()['optionPremiumContent'] == 'Active' && auth()->user()->hasRole('User'))
                                            <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                        @else
                                            <a href="{{ route('frontend.subscription') }}" class="">
                                        @endif
                                    @else
                                        <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                    @endif
                                        <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});">
                                            {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.webp') }}';" alt=""> --}}
                                        </div>
                                    </a>
                                    <div class="video-content p-3">
                                        <h6>
                                            <a href="{{ route('frontend.video.single', $video->slug) }}" class="text-white">
                                            @if ($video['content_type'] == 'paid')
                                                @if(auth()->user() && isset(auth()->user()->subscriptionStatus()['optionPremiumContent']) && auth()->user()->subscriptionStatus()['optionPremiumContent'] == 'Active' && auth()->user()->hasRole('User'))
                                                    <a href="{{ route('frontend.video.single', $video->slug) }}" class="text-white">
                                                @else
                                                    <a href="{{ route('frontend.subscription') }}" class="text-white">
                                                @endif
                                            @else
                                                <a href="{{ route('frontend.video.single', $video->slug) }}" class="text-white">
                                            @endif
                                                {{ $video->title }}
                                            </a>
                                        </h6>
                                        <div class="row sub-content">
                                            <div class="col-12">
                                                @isset($video->category)
                                                <small><a href="{{ route('frontend.video') }}?code={{ optional($video->category)->code }}" class="text-white"><i class="fi fi-ss-clipboard-list-check"></i> {{ optional($video->category)->name }}</a></small>
                                                @endisset
                                            </div>
                                            {{-- <div class="col-6 text-end text-muted">
                                                <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($video->created_at)) }}</small>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>

        <div class="row mt-4">
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
