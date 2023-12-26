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

{{-- <section id="slider" class="mb-4">
    <div class="owl-carousel owl-theme">
        @if(count($sliders)>0)
            @foreach($sliders as $slider)
                <div class="item">
                    <img src="@if(count($slider->files)>0){{$slider->files[0]->path}}@else{{ asset('assets/frontend/img/slider.webp') }}@endif" class="slider_overlay" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="slider-content">
                                    <div class="text">
                                        <div class="line-1 wow fadeInLeft" data-wow-duration="1s">{{$slider->title}}</div>
                                        <p class="wow fadeInLeft">{{ Str::limit(strip_tags($slider->description), 400, '...') }}</p>
                                        @if(!empty($slider->video_id))
                                            <a href="{{ route('frontend.video.single', $slider->video->slug) }}" class="btn btn-lg btn-red mt-3 wow bounceInUp">En savoir plus</a>
                                        @elseif(!empty($slider->live_id))
                                            <a href="{{ route('frontend.live') }}" class="btn btn-lg btn-red mt-3 wow bounceInUp">En savoir plus</a>
                                        @else
                                            <a href="{{ $slider->url }}" class="btn btn-lg btn-red mt-3 wow bounceInUp">En savoir plus</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                    @if(!empty($slider->video_id))
                                        <a href="{{ route('frontend.video.single', $slider->video->slug) }}" class="live_container wow fadeInRight">
                                            <img src="{{ $slider->video->thumbnail_url }}">
                                            <div class="play-button-overlay">
                                                <i class="fi fi-ss-live-alt"></i>
                                            </div>
                                        </a>
                                    @elseif(!empty($slider->live_id))
                                        <a href="{{ route('frontend.live') }}" class="live_container wow fadeInRight">
                                            <img src="{{ $slider->live->thumbnail_url }}">
                                            <div class="play-button-overlay">
                                                <i class="fi fi-ss-live-alt"></i>
                                            </div>
                                        </a>
                                    @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="item">
                <img src="{{ asset('assets/frontend/img/slider.webp') }}" class="slider_overlay" alt="">
            </div>
        @endif
    </div>


</section> --}}

{{-- <section id="social">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul>
                    <li class="wow fadeInDown" data-wow-duration="1s"><span target="_blank" style="font-family: 'Play', sans-serif; font-size: 18px;">Abonnez-vous sur vos plateformes préférées</span></li>
                    <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                    <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                    <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://rumble.com/c/APDQ"><img src="{{ asset('assets/frontend/img/rumble.webp') }}" alt=""></a></li>
                    <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://odysee.com/$/invite/@Actualitepolitiqueduquebec:0"><img src="{{ asset('assets/frontend/img/odysee.png') }}" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div>
</section> --}}

{{-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Mods Center Responsive -->
            <ins class="adsbygoogle"
                style="display:block;"
                data-ad-client="ca-pub-7301992079721298"
                data-ad-slot="12345678901"
                data-ad-format="auto"
            >
            </ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div> --}}

{{-- <section id="about" class="mb-5">
    <div class="container pt-4 pb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 wow fadeInLeft">
                <img class="about_img" src="{{ asset('assets/frontend/img/person.webp') }}" alt="">
            </div>
            <div class="col-md-5 wow fadeInRight">
                <h1 class="fw-bold">À Propos</h1>
                <p style="text-align: justify">En 2020, quand les mesures sanitaires ont été imposées à la pop
                    ulation, tous les médias, ordre professionnel, fonctionnaires, pali
                    er de gouvernement, etc… se sont tous unis pour que toute la po
                    pulation suive les mesures et se fasse vacciner. Cette folie à fait
                    en sorte que je ne pouvais rester sans rien faire. J'ai donc décidé
                    de faire mes propres analyse des conférences de presse de nos
                    gouvernements pour dénoncer tout le mal que nos gouvernemen
                    ts faisaient à 100% de la population.</p>
                <a href="{{ route('frontend.about') }}" class="btn btn-md btn-outline-accent mt-3">En savoir plus</a>
            </div>
        </div>
    </div>
</section> --}}


{{-- <section id="video" class="">
    <div class="container-fluid py-4"> --}}
        {{-- <div class="row mb-4">
            <div class="col-11 text-start">
                <h4 class="fw-bold text-white">Dernières vidéos</h4>
            </div>
            <div class="col-1 text-end">
                <a href="{{ route('frontend.video') }}"><h4 class="fw-bold text-white"><i class="fi fi-br-angle-double-small-right"></i></h4></a>
            </div>

        </div> --}}
        {{-- <div class="row">

            @foreach ($videos as $video)

                <div class="col-md-2 px-2 mb-3 wow bounceInUp">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});"></div>
                            </a>
                            <div class="video-content p-3">
                                <h6><a href="{{ route('frontend.video.single', $video->slug) }}" class="text-white">{{ $video->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-12">
                                        <small><a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($loop->iteration >= 12)
                    @break
                @endif

            @endforeach

        </div> --}}
    {{-- </div>
</section> --}}


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
                            @foreach ($video_category->videos as $video)
                                <div class="item">
                                    <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                        <div class="card border-0">
                                            <div class="card-body p-0">
                                                <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});"></div>
                                                <div class="video-content-wrapper">
                                                    <div class="video-content">
                                                        <h6 class="text-white">
                                                            {{-- <a href="{{ route('frontend.video.single', $video->slug) }}" class="text-white"> --}}
                                                                {{ $video->title }}
                                                            {{-- </a> --}}
                                                        </h6>
                                                        <div class="row sub-content">
                                                            <div class="col-12">
                                                                <small class="text-white">
                                                                    {{-- <a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class=""> --}}
                                                                        <i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}
                                                                    {{-- </a> --}}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @if ($loop->iteration >= 16)
                                        @break
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
@endforeach


{{-- <section id="category" class="py-5">
    <div class="container py-4 pb-5">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="text-dark fw-bold">Catégories <span class="text-muted">principales</span></h1>
                <h5 class="text-dark">Parcourez les catégories principales</h5>
            </div>
        </div>
        <div class="row">
            @foreach ($video_categories as $video_category)
                <a href="{{ route('frontend.video') }}?code={{ $video_category->code }}" class="col-md-3 mt-3 wow bounceInDown">
                    <div class="card">
                        <div class="card-body text-center">
                            {!! $video_category->icon !!}
                            <h4>{{ $video_category->name }}</h4>
                            <p class="small">{{ $video_category->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section> --}}

{{-- <section id="video" class="py-5">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold">Dernières <span class="text-muted">vidéos</span></h1>
                <h5 class="">Videos les plus récents</h5>
            </div>
        </div>
        <div class="row">

            @foreach ($videos as $video)

                <div class="col-md-3 mb-4 wow bounceInUp">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <a href="{{ route('frontend.video.single', $video->slug) }}" class="">
                                <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});">
                                </div>
                            </a>
                            <div class="video-content p-3">
                                <h6><a href="{{ route('frontend.video.single', $video->slug) }}" class="link-dark">{{ $video->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-6">
                                        <small><a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}</a></small>
                                    </div>
                                    <div class="col-6 text-end">
                                        <small><i class="fi fi-rs-clock"></i> {{ date('d/m/Y', strtotime($video->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="row animated-section wow bounceInUp">
            <div class="col-md-12 text-center">
                <a href="{{ route('frontend.video') }}" class="btn btn-md btn-outline-accent mt-5">En savoir plus</a>
            </div>
        </div>
    </div>
</section> --}}

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
        <div class="row mb-3">
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
                    <input type="email" class="form-control newsletter-input" name="email" placeholder="Email" required>
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
