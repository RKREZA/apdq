@extends('frontend::frontend.layouts.master')

@section('title')
Résultat de recherche pour : "{{ request()->keyword }}"
@endsection
@section('seo')
    <meta name="title" content="Résultat de recherche pour : {{ request()->keyword }}">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        #search_page{
            /* background: #fafafa; */
        }
        #search_page .image-container{
            background-size: cover;
            height: 210px;
            background-position: center;
        }

        .post-image-container{
            background-size: cover;
            height: 250px;
            background-position: center;
            border-radius: 10px;
        }

        .post-content h6{
            max-height: 40px;
            overflow: hidden;
        }

        /* #search_page .image-container::before {
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
        } */

        #search_page .card{
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background: transparent;
        }
        #search_page .card:hover{
            transform: scale(1.05);
        }
        #search_page img{
            width: 100%;
        }

        #search_page .video-content h6{
            max-height: 40px;
            overflow: hidden;
        }

        #search_page .video-content .sub-content{
            max-height: 30px;
            overflow: hidden;
        }


        #search_page .sub-content small,#video .sub-content small a{
            font-size: 11px;
            color: #9e9e9e;
        }

        #search_page .sub-content small a:hover{
            color: #0D99DC !important;
        }
        #search_page .sub-content small, #search_page .sub-content small a {
            font-size: 11px;
            color: #9e9e9e;
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
        .description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }
    </style>
@endpush

@section('content')


<section id="search_page" class="pb-5">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-10 mb-4">
                <h5 class="m-0 text-light"><i class="fi fi-sr-discover" style="position: relative; top: 3px"></i> Résultat de recherche pour : "{{ request()->keyword }}"</h5>
            </div>
        </div>

        <div class="description">
            <h5 class="fw-bold">Vidéo</h5>
            <hr>
            @if(count($videos)>0)
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
                                <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                    <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});">
                                        {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.webp') }}';" alt=""> --}}
                                    </div>
                                </a>
                                <div class="video-content p-3">
                                    <h6><a href="{{ route('frontend.video.single', $video->slug) }}" class="text-light">{{ $video->title }}</a></h6>
                                    <div class="row sub-content">
                                        <div class="col-6">
                                            @isset($video->category)
                                            <small><a href="" class="text-muted"><i class="fi fi-ss-clipboard-list-check"></i> {{ optional($video->category)->name }}</a></small>
                                            @endisset
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
            @else
                <h5 class="text-center">Aucune vidéo trouvée!</h5>
            @endif

            <div class="row mt-4">
                <div class="col-md-12">
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="description mt-4">
            <h5 class="fw-bold">Posts</h5>
            <hr>
            @if(count($posts)>0)
            <div class="row">
                @foreach ($posts as $post)

                    <div class="col-md-3 mb-4">
                        <div class="card border-0">
                            <div class="card-body p-0">

                                <a href="{{ route('frontend.blog.single', $post->slug) }}" class="">
                                    @if (!empty($post->files[0]['path']))
                                        <div class="post-image-container" style="background-image:url({{ $post->files[0]['path'] }});">

                                        </div>
                                    @else
                                        <div class="post-image-container" style="background-image:url(assets/frontend/img/no-image.webp);">

                                        </div>
                                    @endif


                                </a>

                                <div class="post-content p-3">
                                    <h6><a href="{{ route('frontend.blog.single', $post->slug) }}" class="text-light">{{ $post->title }}</a></h6>
                                    <div class="row sub-content">
                                        <div class="col-6">
                                            <small><a href="" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $post->category->name }}</a></small>
                                        </div>
                                        <div class="col-6 text-end">
                                            <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            @else
                <h5 class="text-center">Aucun message trouvé!</h5>
            @endif

            <div class="row mt-4">
                <div class="col-md-12">
                    {{ $posts->links('pagination::bootstrap-5') }}
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
