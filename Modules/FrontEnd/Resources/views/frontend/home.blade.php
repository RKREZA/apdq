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
        .animated-section {
            /* opacity: 0; */
            animation-duration: 1.5s;
        }

    </style>
@endpush

@section('content')

<section id="slider">
    <div class="owl-carousel owl-theme">
        <div class="item">
            <img src="{{ asset('assets/frontend/img/slider.webp') }}" class="overlay" alt="">
        </div>
        <div class="item">
            <img src="{{ asset('assets/frontend/img/slider2.webp') }}" class="overlay" alt="">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="slider-content">
                    <div class="text">
                        <div class="line-1 animated-section animate__fadeInLeft">Actualité Politique Du Québec</div>
                        <div class="line-2 animated-section animate__fadeInRight">Pour un <span class="text-style-1">autre son</span> <br>de cloche!</div>
                        <p class="animated-section animate__fadeIn">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis hic illum voluptatum odio distinctio, corrupti ratione neque facilis ad, magni at debitis ipsa ex! Obcaecati illo voluptas ratione incidunt qui.</p>
                        <a href="#" class="btn btn-lg btn-outline-accent mt-3 animate__bounceIn">En savoir plus</a>
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
                    <li class="" style="font-family: 'Play', sans-serif; font-size: 18px;">Abonnez-vous sur vos plateformes préférées</li>
                    <li class="animated-section animate__rubberBand"><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                    <li class="animated-section animate__rubberBand"><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                    <li class="animated-section animate__rubberBand"><a target="_blank" href="https://rumble.com/c/APDQ"><img src="{{ asset('assets/frontend/img/rumble.webp') }}" alt=""></a></li>
                    <li class="animated-section animate__rubberBand"><a target="_blank" href="https://odysee.com/$/invite/@Actualitepolitiqueduquebec:0"><img src="{{ asset('assets/frontend/img/odysee.png') }}" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="about" class="mb-5">
    <div class="container pt-4 pb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 animated-section animate__fadeInLeft">
                <img class="about_img" src="{{ asset('assets/frontend/img/person.webp') }}" alt="">
            </div>
            <div class="col-md-4 animated-section animate__fadeInRight">
                <h1>À Propos</h1>
                <p>Je m'appelle Dominick Jasmin et j'ai créer ce site pour donner mon opinion et mes observations sur la politique canadienne et québécoise, avec un brin d'humour</p>
                <a href="#" class="btn btn-md btn-outline-accent mt-3">En savoir plus</a>
            </div>
        </div>
    </div>
</section>

<section id="category" class="py-5">
    <div class="container py-4 pb-5">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="text-dark">Catégories <span class="text-muted">principales</span></h1>
                <h5 class="text-dark">Parcourez les catégories principales</h5>
            </div>
        </div>
        <div class="row">
            @foreach ($video_categories as $video_category)
                <div class="col-md-3 animated-section animate__zoomIn">
                    <div class="card">
                        <div class="card-body text-center">
                            {!! $video_category->icon !!}
                            <h4>{{ $video_category->name }}</h4>
                            <p class="small">{{ $video_category->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="video" class="py-5">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="">Dernières <span class="text-muted">vidéos</span></h1>
                <h5 class="">Videos les plus récents</h5>
            </div>
        </div>
        <div class="row">

            @foreach ($videos as $video)

                <div class="col-md-3 mb-4 animated-section animate__fadeInLeft">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <a href="" class="">
                                <div class="image-container" style="background-image:url({{ $video->thumbnail_url }});">
                                    {{-- <img src="{{ $video->thumbnail_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/frontend/img/no-video.png') }}';" alt=""> --}}
                                </div>
                            </a>
                            <div class="video-content p-3">
                                <h6><a href="#" class="link-dark">{{ $video->title }}</a></h6>
                                <div class="row sub-content">
                                    <div class="col-6">
                                        <small><a href="" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $video->category->name }}</a></small>
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

        <div class="row animated-section animate__fadeInUp">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-md btn-outline-accent mt-5">En savoir plus</a>
            </div>
        </div>
    </div>
</section>

<section id="blog" class="py-5">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="text-dark">Dernière <span class="text-muted">publication</span></h1>
                <h5 class="text-dark">Message le plus récent</h5>
            </div>
        </div>
        <div class="row">

            @foreach ($posts as $post)

                <div class="col-md-3 mb-4 animated-section animate__fadeInRight">
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

        <div class="row animated-section animate__fadeInUp">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-md btn-outline-accent mt-5">En savoir plus</a>
            </div>
        </div>
    </div>
</section>

<section id="newsletter" class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 text-center animated-section animate__fadeInLeft">
                <h1>S'abonner</h1>
                <h5>Vers notre newsletter</h5>
                <form action="{{ route('frontend.newsletter') }}" method="post" class="mt-4" id="newsletterForm">
                    @csrf
                    <input type="email" class="form-control newsletter-input" name="email" placeholder="Email" required>
                    <button type="submit" class="btn btn-lg btn-default newsletter-button mt-3 w-100">S'abonner</button>
                </form>
            </div>
            <div class="col-md-4 animated-section animate__fadeInRight">
                <img class="newsletter-img" src="{{ asset('assets/frontend/img/person3.webp') }}" alt="">
            </div>
        </div>
    </div>
</section>

<hr class="horizontal dark">

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

    <script>
        $(document).ready(function () {
            $('.animated-section').waypoint(function() {
                // Trigger the Animate.css animation only for the current section
                $(this.element).addClass('animate__animated').removeClass('opacity-0');
            }, {
                offset: '50%', // Adjust the offset as needed
                handler: function(direction) {
                    // Reset the animation when scrolling up (optional)
                    if (direction === 'up') {
                        $(this.element).removeClass('animate__animated').addClass('opacity-0');
                    }
                }
            });
        });
    </script>

@endpush
