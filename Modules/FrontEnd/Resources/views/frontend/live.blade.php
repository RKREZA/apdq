@extends('frontend::frontend.layouts.master')

@section('title')
En direct
@endsection
@section('seo')
    <meta name="title" content="En direct">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="En direct" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        iframe {
            width: 100%;
            min-height: 670px;
        }
        .description {
            padding: 15px;
            border-radius: 10px;
            background: #161616;
            min-height: 70vh;
            max-height: 80vh;
            overflow: hidden;
        }

        .no-image {
            max-width: 100%; /* Use max-width instead of width */
            height: auto;
            max-height: 64vh; /* Set a specific height */
            object-fit: contain;
        }
    </style>
@endpush

@section('content')

<section id="video_page" class="pb-5">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-10 mb-4">
                <h5 class="m-0 text-light"><i class="fi fi-ss-signal-stream" style="position: relative; top: 3px"></i> En direct</h5>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="description">
                    @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionLiveContent'] == 'Active')
                        @if($live)
                            <div class="row">
                                <div class="col-md-8">
                                    {!! $live->embed_html !!}
                                </div>
                                <div class="col-md-4 live_comments px-3 pb-4" style="height: 80vh;overflow:auto;">
                                    <h2>Chat en direct</h2>
                                    @if(!empty($messages))
                                        <div id="chat-messages">
                                            @foreach($messages as $message)
                                            {{-- {{ dd($message) }} --}}
                                                <div class="chat-message">
                                                    <img src="{{ $message['authorDetails']['profileImageUrl'] }}" class="profile-image" alt="">
                                                    <strong>{{ $message['authorDetails']['displayName'] }} : </strong>
                                                    <span>{{ $message['snippet']['textMessageDetails']['messageText'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>Aucune discussion trouvée!</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <img class="no-image" src="{{ asset('assets/frontend/img/no-video.webp') }}" alt="">
                        @endif
                    @elseif(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription')
                        <div class="text-center">
                            <p class="mt-3 text-center">Veuillez vous abonner pour regarder la diffusion en direct !</p>
                            <a href="{{ route('frontend.subscription') }}" class="btn btn-warning text-center" target="_blank">{{ __('core::core.form.buy_now') }}</a>
                        </div>
                    @else
                        <div class="text-center p-5">
                            <h3 class="mt-3 text-center">Vous n'êtes pas autorisé à regarder en direct. Veuillez modifier votre forfait d'abonnement pour regarder la diffusion en direct !</h3>
                            <a href="{{ route('frontend.subscription') }}" class="btn btn-warning text-center" target="_blank">{{ __('core::core.form.change') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4" id="ad_banner_2">
            <div class="col" style="min-width: 260px;">
                <!-- Mods Center Responsive -->
                {{-- <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7301992079721298"
                    data-ad-slot="4688267585"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins> --}}

                    <img src="{{ asset('assets/frontend/img/ad-placeholder.png') }}" alt="" style="width: 100%; border-radius: 15px;">
            </div>
        </div>
    </div>
</section>

<section id="video" class="">
    <div class="container-fluid pb-3">
        <div class="row mb-2">
            <div class="col-11 text-start">
                <a href="{{ route('frontend.live.archive') }}">
                    <h5 class="fw-normal text-white custom_heading_5"><i class="fi fi-sr-folder-open"></i> Vidéo en direct archivée</h5>
                </a>
            </div>
            <div class="col-1 text-end">
                <a href="{{ route('frontend.live.archive') }}">
                    <h5 class="fw-normal text-white"><i class="fi fi-br-angle-double-small-right"></i></h5>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="owl-carousel owl-theme" id="liveVideo">

                    @php
                        $archives = $archived_lives->take(8)->toArray(); // Take the first 8 videos
                        $adIndex = rand(0, 8); // Randomly select an index to insert the ad

                        array_splice($archives, $adIndex, 0, [[
                            'is_ad' => true, // Marking this as an ad item
                        ]]);
                    @endphp

                    @foreach ($archives as $archive_live)
                        @if (isset($archive_live['is_ad']) && $archive_live['is_ad'])

                            @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

                            @else
                                <div class="item">
                                    <div class="card border-0">
                                        <div class="card-body p-0" style="min-width: 260px;">
                                            <!-- Mods Center Responsive -->
                                            {{-- <ins class="adsbygoogle"
                                                style="display:block"
                                                data-ad-format="fluid"
                                                data-ad-layout-key="-79+ew-1a-28+94"
                                                data-ad-client="ca-pub-7301992079721298"
                                                data-full-width-responsive="true"
                                                data-ad-slot="5618205875"></ins> --}}

                                                <img src="{{ asset('assets/frontend/img/ad-placeholder-square.png') }}" alt="" style="width: 100%; height:210px; border-radius: 7px;">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @else
                            <div class="item">
                                {{-- <a href="{{ route('frontend.live.single', $archive_live['slug']) }}" class=""> --}}
                                @if ($archive_live['content_type'] == 'paid')
                                    @if(auth()->user() && isset(auth()->user()->subscriptionStatus()['optionPremiumContent']) && auth()->user()->subscriptionStatus()['optionPremiumContent'] == 'Active' && auth()->user()->hasRole('User'))
                                        <a href="{{ route('frontend.live.single', $archive_live['slug']) }}" class="">
                                    @else
                                        <a href="{{ route('frontend.subscription') }}" class="">
                                    @endif
                                @else
                                    <a href="{{ route('frontend.live.single', $archive_live['slug']) }}" class="">
                                @endif
                                    <div class="card border-0">
                                        <div class="card-body p-0">

                                            @if ($archive_live['content_type'] == 'paid')
                                                <div class="premium" style="position: absolute; right: 10px; top: 10px;">
                                                    <img class="crown" src="{{ asset('assets/frontend/img/crown.svg') }}" style="    background: #000;
                                                    padding: 10px;
                                                    border-radius: 6px;"></img>
                                                </div>
                                            @endif
                                            <div class="image-container" style="background-image:url({{ $archive_live['thumbnail_url'] }});"></div>
                                            <div class="video-content-wrapper">
                                                <div class="video-content">
                                                    <h6 class="text-white">{{ $archive_live['title'] }}</h6>
                                                    <div class="row sub-content">
                                                        <div class="col-12">
                                                            @isset($archive_live->category)
                                                            <small class="text-white"><i class="fi fi-ss-clipboard-list-check"></i> {{ optional($archive_live->category)->name }}</small>
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('js')
<script>
    $('#liveVideo').owlCarousel({
        margin: 15,
        loop: false,
        items: 4,
        dots: true,
        nav: true,
        navigationText: ["<img src='{{ asset('assets/frontend/img/arrow.svg') }}'>","<img src='{{ asset('assets/frontend/img/arrow.svg') }}'>"],
        smartSpeed: 1500,
        autoplay: false,
        autoplayTimeout: 7000,
        mouseDrag: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut'
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
                    external_id: '@if(!empty($live) && !empty($live->external_id)){{ $live->external_id }}@endif' // Ensure this value is quoted
                }, // Missing comma here
                success: function(response) {
                    var messages = response.messages;
                    var messageContent = '';
                    $.each(messages, function(index, message) {
                        messageContent += '<div class="chat-message">' +
                                          '<img src="'+message.authorDetails.profileImageUrl+'" class="profile-image" alt="">' +
                                          '<strong>' + message.authorDetails.displayName + ' : </strong>' +
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
