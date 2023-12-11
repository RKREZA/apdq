@extends('frontend::frontend.layouts.master')

@section('title')
{{ $post->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $post->seo_title }}">
    <meta name="description" content="{{ $post->seo_description }}">
    <meta name="keywords" content="{{ $post->seo_keyword }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $post->seo_description }}" />
    <meta property="og:image" content="/{{ $post->thumbnail_url }}" />
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        .embed_code iframe{
            width: 100%;
            height: auto;
            min-height: 60vh;
        }
        .recent_post{
            border-radius: 10px;
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
            border-radius: 5px;
        }
        div#social-links ul li a:hover {
            color: #fff;
            background-color: #0dcaf0;
        }

        .social_icon{
            border-radius: 10px;
        }

        .social_icon ul{
            list-style: none;
            padding-left: 0;
            display: flex;
            flex-direction: row;
            justify-content: center;

        }
        .social_icon ul li{
            margin-left: 7px;
        }
        .social_icon ul li a img{
            height: 50px;
            width: 50px !important;
        }
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/blog.webp" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="content">
                    <h6 class="text-danger">Blog</h6>
                    <h2>{{ $post->title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="blog" class="py-5">
    <div class="container py-4">
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <span class="text-info"><i class="fi fi-ss-calendar-clock"></i> {{ date("jS M Y", strtotime($post->created_at)) }}</span>
                        &nbsp;&nbsp;
                        <a href="{{ route('frontend.blog') }}?code={{ $post->category->code }}" class="text-info"><i class="fi fi-ss-notebook"></i> {{ $post->category->name }}</a>
                    </div>

                    <div class="col-md-12 mt-4">
                        {!! $post->description !!}
                    </div>

                    <div class="col-md-12 mt-5">
                        <i class="fi fi-ss-label text-info" style="transform: rotate(90deg); display:inline-block;"></i> <span class="badge bg-info badge-sm ms-2">{{ $post->tag }}</span>
                    </div>

                    <div class="col-md-12 mt-5">
                        {!! $share_component !!}
                    </div>

                    @include('frontend::frontend.layouts.comment_system',[
                        'comments'              => $post->comments,
                        'post_id'               => $post->id,
                        'post'                  => $post,
                        'comment_store_route'   => route('frontend.blog.comments.store')
                    ])
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-white p-4 recent_post">
                    <h4 class="text-info mb-3">Nouvelles récentes</h4>
                    <ul>
                        @foreach ($recent_posts as $recent_post)
                            <li class="mb-3 pt-3" style="border-top: 1px solid #ccc;">
                                <a href="{{ route('frontend.blog.single', $recent_post->slug) }}" class="text-dark">
                                    <div class="row">
                                        <div class="col-3">
                                            @if (!empty($recent_post->files[0]['path']))
                                                <img src="/{{ $recent_post->files[0]['path'] }}" style="height: 100px; width: 100px;" alt="">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/no-image.png') }}" style="height: 100px; width: 100px;" alt="">
                                            @endif
                                        </div>
                                        <div class="col-9">
                                            <div>{{ $recent_post->title }}</div>
                                            <small class="mt-2 text-info"><i class="fi fi-ss-calendar-clock"></i> {{date("jS M Y", strtotime($recent_post->created_at))}}</small>
                                        </div>
                                    </div>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="bg-info p-4 mt-3 social_icon">
                    <h4 class="text-white mb-3 text-center">Abonnez-vous sur vos plateformes préférées</h4>
                    <ul>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://rumble.com/c/APDQ"><img src="{{ asset('assets/frontend/img/rumble.webp') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://odysee.com/$/invite/@Actualitepolitiqueduquebec:0"><img src="{{ asset('assets/frontend/img/odysee.png') }}" alt=""></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection


@push('js')

<script src="{{ asset('js/share.js') }}"></script>
@endpush