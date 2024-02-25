@extends('frontend::frontend.layouts.master')

@section('title')
{{ $live->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $live->seo_title }}">
    <meta name="description" content="{{ $live->seo_description }}">
    <meta name="keywords" content="{{ $live->seo_keyword }}">

    <meta property="og:title" content="Vidéo" />
    <meta property="og:description" content="{{ $live->seo_description }}" />
    <meta property="og:image" content="/{{ $live->thumbnail_url }}" />
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        #video_page{
            /* background: #fafafa; */
        }
        #video_page .image-container {
            background-size: cover;
            height: 280px;
            background-position: center;
            border-radius: 7px;
        }
        .drawer_content #video_page .image-container {
            height: 310px;
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
            min-height: 80vh;
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
            top: -7px;
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

        @keyframes shake {
            0% { transform: translate(0, 0); }
            25% { transform: translate(-5px, 0); }
            50% { transform: translate(5px, 0); }
            75% { transform: translate(-5px, 0); }
            100% { transform: translate(5px, 0); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
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

            <div class="col-md-12 pe-md-4 pe-0">
                <div class="row">

                    <div class="col-md-8 embed_code p-0">
                        {!! $live->embed_html !!}
                    </div>

                    <div class="col-md-4 live_comments px-3" style="height: 80vh;overflow:auto;">
                            <h2>Chat en direct</h2>
                            @if(!empty($messages))
                                <div id="chat-messages">
                                    @foreach($messages as $message)
                                    {{-- {{ dd($message) }} --}}
                                        <div class="chat-message">
                                            <strong>{{ $message['authorDetails']['displayName'] }}:</strong>
                                            <span>{{ $message['snippet']['textMessageDetails']['messageText'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Aucune discussion trouvée!</p>
                            @endif
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col-md-8 mt-3">
                                <h4>{{ $live->title }}</h4>
                            </div>

                            <div class="col-4 text-end emoji my-2" id="share_button">
                                <button class="reaction-button">
                                    {{-- <i class="fi fi-br-share"></i> --}}

                                    <img src="{{ asset('assets/frontend/img/share.webp') }}" style="height: 35px" alt="">
                                </button>
                                {{-- <div class="badge badge-sm reaction-counter w-100">Share</div> --}}
                            </div>

                            <div class="col-12 my-2 d-none" id="share_component">
                                <span class="text-end">
                                    {!! $share_component !!}
                                </span>
                            </div>

                            <div class="col-md-12 mt-3 video-description">
                                {!! $live->description !!}
                            </div>
                        </div>
                    </div>

                    {{-- @include('frontend::frontend.layouts.comment_system',[
                        'comments'              => $live->comments,
                        'post_id'               => $live->id,
                        'post'                  => $live,
                        'comment_store_route'   => route('frontend.video.comments.store')
                    ]) --}}

                </div>
            </div>

        </div>

    </div>
</section>



@endsection


@push('js')

<script src="{{ asset('js/share.js') }}"></script>

<script>
    $(document).ready(function () {
      $("#share_button").click(function () {
        $("#share_component").toggleClass('d-none');
      });
    });
</script>

<script>
    $(document).ready(function() {
        var element = $(".live_comments");
        element.scrollTop(element.prop("scrollHeight"));
    });
</script>

<script>
    $(document).ready(function() {
        function fetchMessages() {
            $.ajax({
                url: '{{ route("frontend.live.fetch.messages") }}',
                type: 'GET',
                data: {
                    external_id: '{{ $live->external_id }}' // Ensure this value is quoted
                }, // Missing comma here
                success: function(response) {
                    var messages = response.messages;
                    var messageContent = '';
                    $.each(messages, function(index, message) {
                        messageContent += '<div class="chat-message">' +
                                          '<strong>' + message.authorDetails.displayName + ':</strong>' +
                                          '<span>' + message.snippet.textMessageDetails.messageText + '</span>' +
                                          '</div>';
                    });
                    $('#chat-messages').html(messageContent);
                    // Scroll to the bottom of the chat
                    var chatDiv = $('.live_comments');
                    chatDiv.scrollTop(chatDiv.prop("scrollHeight"));
                }
            });
        }

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
    });
</script>

@endpush
