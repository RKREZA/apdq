@extends('frontend::frontend.layouts.master')

@section('title')
    {{ $frontend_setting->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $frontend_setting->meta_title }}">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="{{ $frontend_setting->social_title }}" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('content')

{{-- {{ dd(auth()->user()->subscriptionStatus()) }} --}}
@if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

@else
    <section id="ad_banner" class=" mb-4 mx-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col" style="width: 260px;" id="Adscode">
                    <!-- banner ads -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-7301992079721298"
                        data-ad-slot="4688267585"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
    </section>
@endif

<section id="video" class="mx-3">
    <div class="container-fluid pb-3">
        <div class="row mb-2">
            <div class="col-11 text-start">
                <a href="{{ route('frontend.video') }}">
                    <h5 class="fw-normal text-white custom_heading_5"><i class="fi fi-ss-fire-flame-curved"></i> Dernières vidéos</h5>
                </a>
            </div>
            <div class="col-1 text-end">
                <a href="{{ route('frontend.video') }}">
                    <h5 class="fw-normal text-white"><i class="fi fi-br-angle-double-small-right"></i></h5>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-2 mb-3">
                <div class="owl-carousel owl-theme">

                    @foreach ($videos->take(8) as $video)
                        @if (isset($video['is_ad']) && $video['is_ad'])
                            {{-- Insert the ad section --}}

                            @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

                            @else
                                <div class="item">
                                    <div class="card border-0">
                                        <div class="card-body" style="min-width: 260px;">
                                            <!-- Mods Center Responsive -->
                                            <ins class="adsbygoogle"
                                                style="display:block"
                                                data-ad-format="fluid"
                                                data-ad-layout-key="-79+ew-1a-28+94"
                                                data-ad-client="ca-pub-7301992079721298"
                                                data-ad-slot="5618205875"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @else
                            {{-- Regular video item --}}
                            <div class="item">
                                <a href="{{ route('frontend.video.single', $video['slug']) }}" class="">
                                    <div class="card border-0">
                                        <div class="card-body p-0">
                                            <div class="image-container" style="background-image:url({{ $video['thumbnail_url'] }});"></div>
                                            <div class="video-content-wrapper">
                                                <div class="video-content">
                                                    <h6 class="text-white">{{ $video['title'] }}</h6>
                                                    <div class="row sub-content">
                                                        <div class="col-12">
                                                            @isset($video->category)
                                                            <small class="text-white"><i class="fi fi-ss-clipboard-list-check"></i> {{ optional($video->category)->name }}</small>
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

@foreach($video_categories as $video_category)
    @if(count($video_category->videos)>0)
        <section id="video" class="mx-3">
            <div class="container-fluid pb-3">
                <div class="row mb-2">
                    <div class="col-11 text-start">
                        <a href="{{ route('frontend.video') }}?code={{ $video_category->code }}">
                            <h5 class="fw-normal text-white custom_heading_5">{!! $video_category->icon !!} {{ $video_category->name }}</h5>
                        </a>
                    </div>
                    <div class="col-1 text-end">
                        <a href="{{ route('frontend.video') }}?code={{ $video_category->code }}">
                            <h5 class="fw-normal text-white"><i class="fi fi-br-angle-double-small-right"></i></h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 px-2 mb-3">
                        <div class="owl-carousel owl-theme">


                            @php
                                $videos = $video_category->videos->take(8)->toArray(); // Take the first 8 videos
                                $adIndex = rand(0, 8); // Randomly select an index to insert the ad

                                array_splice($videos, $adIndex, 0, [[
                                    'is_ad' => true, // Marking this as an ad item
                                ]]);
                            @endphp

                            @foreach ($videos as $video)
                                @if (isset($video['is_ad']) && $video['is_ad'])
                                    {{-- Insert the ad section --}}

                                    @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

                                    @else
                                    <div class="item">
                                        <div class="card border-0">
                                            <div class="card-body" style="min-width: 250px;">
                                                <!-- Adsense Ad Code -->
                                                <ins class="adsbygoogle"
                                                     style="display:block"
                                                     data-ad-format="fluid"
                                                     data-ad-layout-key="-79+ew-1a-28+94"
                                                     data-ad-client="ca-pub-7301992079721298"
                                                     data-ad-slot="5618205875"></ins>
                                                <script>
                                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                @else
                                    {{-- Regular video item --}}
                                    <div class="item">
                                        <a href="{{ route('frontend.video.single', $video['slug']) }}" class="">
                                            <div class="card border-0">
                                                <div class="card-body p-0">
                                                    <div class="image-container" style="background-image:url({{ $video['thumbnail_url'] }});"></div>
                                                    <div class="video-content-wrapper">
                                                        <div class="video-content">
                                                            <h6 class="text-white">{{ $video['title'] }}</h6>
                                                            <div class="row sub-content">
                                                                <div class="col-12">
                                                                    <small class="text-white"><i class="fi fi-ss-clipboard-list-check"></i> {{ $video_category->name }}</small>

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
    @endif
@endforeach


@if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

@else
    <section id="ad_banner_2" class=" mb-4 mx-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col" style="min-width: 260px;">
                    <!-- Mods Center Responsive -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-7301992079721298"
                        data-ad-slot="4688267585"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
    </section>
@endif

<section id="blog" class="mx-3">
    {{-- <div class="overlay"></div> --}}
    <div class="container-fluid py-0">
        <div class="row mb-3">
            <div class="col-md-11 text-start">
                <a href="{{ route('frontend.blog') }}">
                    <h5 class="text-white fw-normal custom_heading_5"><i class="fi fi-ss-blog-pencil"></i> Dernière publication</h5>
                </a>
            </div>
            <div class="col-1 text-end">
                <a href="{{ route('frontend.blog') }}">
                    <h5 class="fw-normal text-white"><i class="fi fi-br-angle-double-small-right"></i></h5>
                </a>
            </div>
        </div>
        <div class="row">

            @foreach ($posts as $post)

                <div class="col-md-3 mb-4">
                    <div class="card border-0">
                        <div class="card-body p-0">

                            <a href="{{ route('frontend.blog.single', $post->slug) }}" class="">
                                @if (!empty($post->files[0]['path']))
                                    <div class="image-container" style="background-image:url({{ $post->files[0]['path'] }});"></div>
                                @else
                                    <div class="image-container" style="background-image:url(assets/frontend/img/no-image.png);"></div>
                                @endif
                            </a>

                            <div class="post-content p-3">
                                <h6><a href="{{ route('frontend.blog.single', $post->slug) }}" class="text-white">{{ $post->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-6">
                                        <small><a href="{{ route('frontend.blog') }}?code={{ $post->category->code }}" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $post->category->name }}</a></small>
                                    </div>
                                    <div class="col-6 text-end">
                                        <small><i class="fi fi-rs-clock"></i> {{ \Modules\Core\Helpers\CoreHelper::human_readable_date($post->created_at) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @if ($loop->iteration >= 8)
                    @break
                @endif

            @endforeach

        </div>
    </div>
</section>

<section id="donation" class="mx-3">
    {{-- <div class="overlay"></div> --}}
    <div class="container-fluid py-4 pb-5">
        <div class="row">
            <div class="col-md-12 text-start">
                <h5 class="text-dark fw-normal text-white custom_heading_5"><i class="fi fi-ss-donate"></i> Renforcez le Changement</h5>
                {{-- <h5 class="text-dark">Ensemble, Alimentons la Démocratie</h5> --}}
            </div>
        </div>
        <div class="row">
            <a href="https://www.paypal.com/paypalme/DominickJasmin" target="_blank" class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/paypal.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold text-white">PayPal</h4>
                        <p class="text-white">Pour m'aider à vivre de APDQ - pour un autre son cloche</p>
                    </div>
                </div>
            </a>
            <a href="mailto:virement@actualitepolitiqueduquebec.com" target="_blank" class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/interac.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold text-white">Faire un Don par Interac</h4>
                        <p class="text-white">Réponse ou validation à donner : Dominick</p>
                    </div>
                </div>
            </a>
            <a href="https://bit.ly/DonAPDQ" target="_blank" class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/card.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold text-white">Autres options</h4>
                        <p class="text-white">Pour me faire un DON par carte de crédit sans PayPal</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<section id="newsletter" class="mb-5 mx-3">
    <div class="container-fluid py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 mb-3 text-center">
                <h1 class="fw-bold text-white">S'abonner</h1>
                <h5 class="text-white">Vers notre newsletter</h5>
                <form action="{{ route('frontend.newsletter') }}" method="post" class="mt-4" id="newsletterForm">
                    @csrf
                    <input type="email" class="form-control newsletter-input" name="email" placeholder="E-mail" required>
                    <button type="submit" class="btn btn-lg btn-default newsletter-button mt-3 w-100">S'abonner</button>
                </form>
            </div>
            <div class="col-md-4">
                <img class="newsletter-img" src="{{ asset('assets/frontend/img/person3.webp') }}" alt="">
            </div>
        </div>
    </div>
</section>


@endsection


@push('js')

    <script>
        $('.owl-carousel').owlCarousel({
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
        $(document).ready(function () {
            $('#newsletterForm').submit(function (e) {
                e.preventDefault();

                var form = $(this);

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (data) {
                        swal(data.success);
                    },
                    error: function (xhr, status, error) {
                        swal(xhr.responseJSON.error);
                    }
                });
            });
        });
    </script>

@endpush
