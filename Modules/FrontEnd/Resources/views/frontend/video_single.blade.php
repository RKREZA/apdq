@extends('frontend::frontend.layouts.master')

@section('title')
{{ $video->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $video->seo_title }}">
    <meta name="description" content="{{ $video->seo_description }}">
    <meta name="keywords" content="{{ $video->seo_keyword }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $video->seo_description }}" />
    <meta property="og:image" content="/{{ $video->thumbnail_url }}" />
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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

        .emoji{
            font-size: 40px;
            line-height: 35px;
        }
        .emoji button{
            border: 0;
            background-color: transparent;
        }
        .emoji button:hover{
            color: #0dcaf0;
        }

        .fi-active{
            color: #0dcaf0;
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
                    <h6 class="text-danger">Vidéos</h6>
                    <h2>{{ $video->title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="video_page" class="py-5">
    <div class="container py-4">
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col my-2">
                                <span class="text-info"><i class="fi fi-ss-calendar-clock"></i> {{ date("jS M Y", strtotime($video->created_at)) }}</span>
                                &nbsp;&nbsp;
                                <a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class="text-info"><i class="fi fi-ss-notebook"></i> {{ $video->category->name }}</a>

                            </div>
                            <div class="col text-end my-2">
                                <span class="text-end">
                                    {!! $share_component !!}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 embed_code">
                        {!! $video->embed_html !!}
                    </div>

                    <div class="col-md-12 mt-4">
                        {!! $video->description !!}
                    </div>

                    <div class="col-md-12 mt-5">
                        <i class="fi fi-ss-label text-info" style="transform: rotate(90deg); display:inline-block;"></i> <span class="badge bg-info badge-sm ms-2">{{ $video->tag }}</span>
                    </div>

                    {{-- @include('frontend::frontend.layouts.comment_system',[
                        'comments'              => $video->comments,
                        'post_id'               => $video->id,
                        'post'                  => $video,
                        'comment_store_route'   => route('frontend.video.comments.store')
                    ]) --}}
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="like">
                                    <i class="fi fi-rs-social-network"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->like }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->like }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="love">
                                    <i class="fi fi-rs-heart"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->love }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->love }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="haha">
                                    <i class="fi fi-rs-surprise"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->haha }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->haha }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="wow">
                                    <i class="fi fi-rs-surprise"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->wow }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->wow }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="sad">
                                    <i class="fi fi-rs-sad"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->sad }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->sad }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="angry">
                                    <i class="fi fi-rs-angry"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->angry }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->angry }}</div>
                            </div>
                            <div class="col text-center emoji my-2">
                                <button class="reaction-button w-100" data-video-id="{{ $video->id }}" data-reaction-type="dislike">
                                    <i class="fi fi-rs-hand"></i>
                                    <input type="hidden" class="previous_value" value="{{ $video->dislike }}">
                                </button>
                                <div class="badge badge-sm bg-info w-100 mt-2">{{ $video->dislike }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">

                <div class="row mt-5">

                    <h4 class="text-info">Recent Videos</h4>
                    <hr>

                    @foreach ($recent_videos as $recent_video)

                    <div class="col-md-3 mb-4">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <a href="{{ route('frontend.video.single', $recent_video->slug) }}" class="">
                                    <div class="image-container" style="background-image:url({{ $recent_video->thumbnail_url }});">
                                        {{-- <img src="{{ $recent_video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.png') }}';" alt=""> --}}
                                    </div>
                                </a>
                                <div class="video-content p-3">
                                    <h6><a href="{{ route('frontend.video.single', $recent_video->slug) }}" class="link-dark">{{ $recent_video->title }}</a></h6>
                                    <div class="row sub-content">
                                        <div class="col-6">
                                            <small><a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class="text-muted"><i class="fi fi-ss-clipboard-list-check"></i> {{ $recent_video->category->name }}</a></small>
                                        </div>
                                        <div class="col-6 text-end text-muted">
                                            <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($recent_video->created_at)) }}</small>
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
    </div>
</section>



@endsection


@push('js')

<script src="{{ asset('js/share.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.reaction-button').click(function() {
            var button = $(this);
            var badge = button.next('.badge');
            // var previousValue = parseInt(button.next('.previous_value').val());
            var videoId = button.data('video-id');
            var reactionType = button.data('reaction-type');

            var previousValue = parseInt(button.closest('.emoji').find('.previous_value').val());


            $.ajax({
                url: `{{ route('frontend.video.react') }}`,
                type: 'POST',
                data: {
                    video_id: videoId,
                    reaction_type: reactionType,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        button.find('.fi').addClass('fi-active');

                        // Increment the numeric value and update the UI
                        var newValue = previousValue+1;
                        badge.html(newValue);
                        button.next('.previous_value').val(previousValue + 1);
                    } else {
                        console.error('Failed to submit reaction');
                    }
                },
                error: function(error) {
                    console.error('AJAX request failed', error);
                }
            });
        });
    });
</script>

@endpush
