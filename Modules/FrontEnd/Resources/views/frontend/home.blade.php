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

<section id="slider">
    <div class="owl-carousel owl-theme">
        <div class="item">
            <img src="{{ asset('assets/frontend/img/slider.webp') }}" class="slider_overlay" alt="">
        </div>
        {{-- <div class="item">
            <img src="{{ asset('assets/frontend/img/slider2.webp') }}" class="overlay" alt="">
        </div> --}}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="slider-content">
                    <div class="text">
                        <div class="line-1 wow fadeInLeft" data-wow-duration="1s">Actualité Politique Du Québec</div>
                        <div class="line-2 wow fadeInRight" data-wow-duration="1s">Pour un <span class="text-style-1">autre son</span> <br>de cloche!</div>
                        <p class="wow fadeInLeft">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis hic illum voluptatum odio distinctio, corrupti ratione neque facilis ad, magni at debitis ipsa ex! Obcaecati illo voluptas ratione incidunt qui.</p>
                        <a href="{{ route('frontend.live') }}" class="btn btn-lg btn-outline-accent mt-3 wow bounceInUp">En direct</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="social">
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
</section>

<section id="about" class="mb-5">
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
</section>

<section id="category" class="py-5">
    <div class="overlay"></div>
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
</section>

<section id="video" class="py-5">
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
                                    {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.png') }}';" alt=""> --}}
                                </div>
                            </a>
                            <div class="video-content p-3">
                                <h6><a href="{{ route('frontend.video.single', $video->slug) }}" class="link-dark">{{ $video->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-6">
                                        <small><a href="{{ route('frontend.video') }}?code={{ $video->category->code }}" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}</a></small>
                                    </div>
                                    <div class="col-6 text-end">
                                        <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($video->created_at)) }}</small>
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
</section>

<section id="blog" class="py-5">
    <div class="overlay"></div>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="text-dark fw-bold">Dernière <span class="text-muted">publication</span></h1>
                <h5 class="text-dark">Message le plus récent</h5>
            </div>
        </div>
        <div class="row">

            @foreach ($posts as $post)

                <div class="col-md-3 mb-4 wow bounceInUp">
                    <div class="card border-0">
                        <div class="card-body p-0">

                            <a href="" class="">
                                @if (!empty($post->files[0]['path']))
                                    <div class="image-container" style="background-image:url({{ $post->files[0]['path'] }});">

                                    </div>
                                @else
                                    <div class="image-container" style="background-image:url(assets/frontend/img/no-image.png);">

                                    </div>
                                @endif


                            </a>

                            <div class="post-content p-3">
                                <h6><a href="#" class="link-dark">{{ $post->title }}</a></h6>
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

        <div class="row wow bounceInUp">
            <div class="col-md-12 text-center">
                <a href="{{ route('frontend.blog') }}" class="btn btn-md btn-outline-accent mt-5">En savoir plus</a>
            </div>
        </div>
    </div>
</section>

<section id="newsletter" class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 mb-3 text-center wow slideInLeft">
                <h1 class="fw-bold">S'abonner</h1>
                <h5>Vers notre newsletter</h5>
                <form action="{{ route('frontend.newsletter') }}" method="post" class="mt-4" id="newsletterForm">
                    @csrf
                    <input type="email" class="form-control newsletter-input" name="email" placeholder="Email" required>
                    <button type="submit" class="btn btn-lg btn-default newsletter-button mt-3 w-100">S'abonner</button>
                </form>
            </div>
            <div class="col-md-4 wow slideInRight">
                <img class="newsletter-img" src="{{ asset('assets/frontend/img/person3.webp') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section id="donation" class="py-5">
    <div class="overlay"></div>
    <div class="container py-4 pb-5">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="text-dark fw-bold">Renforcez <span class="text-muted">le Changement</span></h1>
                <h5 class="text-dark">Ensemble, Alimentons la Démocratie</h5>
            </div>
        </div>
        <div class="row">
            <a href="https://www.paypal.com/paypalme/DominickJasmin" target="_blank" class="col-md-4 mt-3 wow bounceInLeft">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/paypal.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold">PayPal</h4>
                        <p>Pour m'aider à vivre de APDQ - pour un autre son cloche</p>
                    </div>
                </div>
            </a>
            <a href="mailto:virement@actualitepolitiqueduquebec.com" target="_blank" class="col-md-4 mt-3 wow bounceInUp">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/interac.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold">Faire un Don par Interac</h4>
                        <p>Réponse ou validation à donner : Dominick</p>
                    </div>
                </div>
            </a>
            <a href="https://bit.ly/DonAPDQ" target="_blank" class="col-md-4 mt-3 wow bounceInRight">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/frontend/img/card.png') }}" class="donation_img my-3" alt="">
                        <h4 class="mt-3 fw-bold">Autres options</h4>
                        <p>Pour me faire un DON par carte de crédit sans PayPal</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>


@endsection


@push('js')

    <script>
        $('.owl-carousel').owlCarousel({
            margin: 0,
            loop: true,
            items: 1,
            dots: false,
            nav: false,
            smartSpeed: 1500,
            autoplay: true,
            autoplayTimeout: 7000,
            mouseDrag: false,
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
