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
            /* background: #fafafa; */
        }
        #video_page .image-container {
            background-size: cover;
            height: 210px;
            background-position: center;
            border-radius: 7px;
        }
        /* .video_page_header{
            height: 30vh;
        } */
        /* #video_page .image-container::before {
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
            color: #9d9d9d;
            background-color: #161616;
        }
        div#social-links ul li a:hover {
            color: #fff;
            background-color: #0d99dc;
        }

        .emoji{
            font-size: 15px;
            line-height: 35px;
        }
        .emoji button {
            border: 0;
            background-color: transparent;
            color: #9d9d9d;
            padding: 4px;
        }
        .emoji button:hover{
            color: #0dcaf0;
        }

        .fi-active{
            color: #0dcaf0;
        }
        .reaction-counter {
            position: relative;
            top: -4px;
            left: -8px;
            font-weight: 100;
        }
        #share_button{
            cursor: pointer;
        }
        .video-description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }
        .embed_code{
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')

{{-- <section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/video.webp" alt="">
    <div class="content">
        <h1>Vidéos</h1>
    </div>
</section> --}}

<section id="video_page" class="pb-5 mx-3">
    <div class="container-fluid py-2">
        <div class="row">

            <div class="col-md-8 pe-md-4 pe-0">
                <div class="row">

                    <div class="col-md-12 embed_code p-0">
                        {!! $video->embed_html !!}
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-12">
                            <div class="row">
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="like">
                                        <i class="fi fi-rs-social-network"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->like }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->like }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="love">
                                        <i class="fi fi-rs-heart"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->love }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->love }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="haha">
                                        <i class="fi fi-rs-surprise"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->haha }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->haha }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="wow">
                                        <i class="fi fi-rs-surprise"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->wow }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->wow }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="sad">
                                        <i class="fi fi-rs-sad"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->sad }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->sad }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="angry">
                                        <i class="fi fi-rs-angry"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->angry }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->angry }}</div>
                                </div>
                                <div class="col text-center emoji my-2">
                                    <button class="reaction-button" data-video-id="{{ $video->id }}" data-reaction-type="dislike">
                                        <i class="fi fi-rs-hand"></i>
                                        <input type="hidden" class="previous_value" value="{{ $video->dislike }}">
                                    </button>
                                    <div class="badge badge-sm reaction-counter">{{ $video->dislike }}</div>
                                </div>
                                <div class="col text-center emoji my-2" id="share_button">
                                    <button class="reaction-button">
                                        <i class="fi fi-br-share"></i>
                                    </button>
                                    <div class="badge badge-sm reaction-counter">Share</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center my-2 d-none" id="share_component">
                            <span class="text-end">
                                {!! $share_component !!}
                            </span>
                        </div>


                    </div>

                    <div class="col-md-12 mt-3">
                        <h4>{{ $video->title }}</h4>
                    </div>

                    <div class="col-md-12 mt-3 video-description">
                        {!! $video->description !!}

                        <div class="mt-3">
                            <i class="fi fi-ss-label text-info" style="transform: rotate(90deg); display:inline-block;"></i> <span class="badge bg-info badge-sm ms-2">{{ $video->tag }}</span>
                        </div>
                    </div>

                    @include('frontend::frontend.layouts.comment_system',[
                        'comments'              => $video->comments,
                        'post_id'               => $video->id,
                        'post'                  => $video,
                        'comment_store_route'   => route('frontend.video.comments.store')
                    ])

                </div>
            </div>

            <div class="col-md-4">

                <div class="row">

                    <h5 class="">Recent Videos</h5>
                    <hr class="horizontal light">

                    @foreach ($recent_videos as $recent_video)

                    <div class="col-md-12 mb-4">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <a href="{{ route('frontend.video.single', $recent_video->slug) }}" class="">
                                    <div class="image-container" style="background-image:url({{ $recent_video->thumbnail_url }});"></div>
                                </a>
                                <div class="video-content p-3">
                                    <h6><a href="{{ route('frontend.video.single', $recent_video->slug) }}" class="text-muted">{{ $recent_video->title }}</a></h6>
                                    <div class="row sub-content">
                                        <div class="col-6">
                                            <small><a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $recent_video->category->name }}</a></small>
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

<script>
    $(document).ready(function () {
      $("#share_button").click(function () {
        $("#share_component").toggleClass('d-none');
      });
    });
  </script>

@endpush
