@extends('frontend::frontend.layouts.master')

@section('title')
À propos
@endsection
@section('seo')
    <meta name="title" content="À propos">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="À propos" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        #about_page ul{
            list-style: none;
            padding-left: 0;
        }
        #about_page ul li{
            display: inline-block;
            margin-right: 7px;
        }
        #about_page ul li img{
            width: 45px;
        }
        .description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }
    </style>
@endpush

@section('content')

{{-- <section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/about.webp" alt="">
    <div class="content">
        <h1>À propos</h1>
        <h6>Derrière le Rire, Décryptage Politique</h6>
    </div>
</section> --}}

<div id="about_page" class="mb-5 mx-3">
    <div class="container-fluid py-2">

        <div class="col-md-12">
            {{-- <h6 class="text-danger">Page</h6> --}}
            <h4>À propos</h4>
        </div>

        <div class="col-md-12 mt-4">
            <div class="row justify-content-center align-items-center description">
                <div class="col-md-6 pe-0 pe-md-3 mb-3 wow slideInLeft">
                    <h4 class="mb-3 fw-bold text-white">l'histoire de votre entreprise</h4>
                    <p class="text-white" style="text-align: left">En 2020, face à l'imposition des mesures sanitaires à l'ensemble de la population, une union s'est opérée parmi les médias, les ordres professionnels, les fonctionnaires, et les différents paliers gouvernementaux. Tous se sont mobilisés pour promouvoir l'observance généralisée de ces mesures et encourager la vaccination. Cette convergence d'efforts a suscité en moi une impulsion à agir. Ainsi, j'ai décidé d'entreprendre mes propres analyses des conférences de presse gouvernementales afin de mettre en lumière les conséquences néfastes que nos gouvernements faisaient peser sur l'ensemble de la population, soit 100% d'entre nous.</p>
                    <ul>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://twitter.com/PolitiqueQuebec"><img src="{{ asset('assets/frontend/img/twitter.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://rumble.com/c/APDQ"><img src="{{ asset('assets/frontend/img/rumble.webp') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://odysee.com/$/invite/@Actualitepolitiqueduquebec:0"><img src="{{ asset('assets/frontend/img/odysee.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.tiktok.com/@dominickapdq"><img src="{{ asset('assets/frontend/img/tiktok.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.instagram.com/actualite_politique_du_quebec/"><img src="{{ asset('assets/frontend/img/instagram.png') }}" alt=""></a></li>
                        <li class="wow fadeInUp" data-wow-duration="1s"><a target="_blank" href="https://www.threads.net/@actualite_politique_du_quebec"><img src="{{ asset('assets/frontend/img/threads.png') }}" alt=""></a></li>
                    </ul>
                </div>
                <div class="col-md-6 wow slideInRight">
                    <img style="width: 100%;
                    border-radius: 30px;
                    background: #ccc;
                    padding-top: 30px;
                    margin-top: 15px;" src="{{ asset('assets/frontend/img/person5.webp') }}" alt="">
                </div>




                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <h1 class="text-white fw-bold text-white mb-1">Catégories principales</h1>
                                <h5 class="text-white">Parcourez les catégories principales</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3 wow bounceInUp">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/frontend/img/about-icon-1.png') }}" style="height: 120px; width: 120px " alt="">
                                        <h5 class="text-white fw-bold mt-3">Le Catalyseur de Conscience</h5>
                                        <p class="text-white small">Éveiller l'action face à l'adversité collective.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-3 wow bounceInUp">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/frontend/img/about-icon-2.png') }}" style="height: 120px; width: 120px " alt="">
                                        <h5 class="text-white fw-bold mt-3">Le Pulsar Politique</h5>
                                        <p class="text-white small">Revitaliser l'Engagement Politique avec Humour et Perspicacité</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-3 wow bounceInUp">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/frontend/img/about-icon-3.png') }}" style="height: 120px; width: 120px " alt="">
                                        <h5 class="text-white fw-bold mt-3">Piliers de la Mission</h5>
                                        <p class="text-white small">Défendre la Justice, les Droits, et le Respect pour un Avenir Meilleur.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-3 wow bounceInUp">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/frontend/img/about-icon-4.png') }}" style="height: 120px; width: 120px " alt="">
                                        <h5 class="text-white fw-bold mt-3">Renforcer APDQ</h5>
                                        <p class="text-white small">Unis pour le Changement, Soutenez la Cause – Redéfinissons la Politique.</p>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="row justify-content-center align-items-center mt-5">
                            <div class="col-md-5 wow slideInLeft">
                                <img class="mission_img" src="{{ asset('assets/frontend/img/person2.webp') }}" style="width: 100%;
                                border-radius: 30px;
                                background: #ccc;
                                padding-top: 35px;" alt="">
                            </div>
                            <div class="col-md-6 wow slideInRight">
                                {{-- <h1 class="mb-3">Mission et vision</h1> --}}

                                <div class="row mt-3">
                                    <div class="col-md-3 text-center">
                                        <img class="mission_img" src="{{ asset('assets/frontend/img/mission.png') }}" style="width: 135px;background: #ccc;padding: 30px;border-radius: 20px;" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="mb-2">Mission</h4>
                                        <p>Donner un autre son de cloche sur l'actualité politique, fédérale, provinciale et municipale, avec un brin d'humour. Intéresser la population à la politique en encourageant une compréhension critique et engagée.</p>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3 text-center">
                                        <img class="mission_img" src="{{ asset('assets/frontend/img/vision.png') }}" style="width: 135px;background: #ccc;padding: 30px;border-radius: 20px;" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="mb-2">Vision</h4>
                                        <p>Faire en sorte que chacun s'intéresse à la politique avant que la politique ne s'intéresse à lui, favorisant ainsi une société informée, active et participative.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <section id="donation" class="mb-5">
                            <div class="row mt-5">
                                <div class="col-md-12 text-center">
                                    <h1 class="text-white fw-bold mb-1">Renforcez le Changement</h1>
                                    <h5 class="text-white">Ensemble, Alimentons la Démocratie</h5>
                                </div>
                            </div>
                            <div class="row">
                                <a href="https://www.paypal.com/paypalme/DominickJasmin" target="_blank" class="col-md-4 mt-3 wow bounceInLeft">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/frontend/img/paypal.png') }}" class="donation_img my-3" alt="">
                                            <h4 class="mt-3 fw-bold">PayPal</h4>
                                            <p class="text-white">Pour m'aider à vivre de APDQ - pour un autre son cloche</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="mailto:virement@actualitepolitiqueduquebec.com" target="_blank" class="col-md-4 mt-3 wow bounceInUp">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/frontend/img/interac.png') }}" class="donation_img my-3" alt="">
                                            <h4 class="mt-3 fw-bold">Faire un Don par Interac</h4>
                                            <p class="text-white">Réponse ou validation à donner : Dominick</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://bit.ly/DonAPDQ" target="_blank" class="col-md-4 mt-3 wow bounceInRight">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/frontend/img/card.png') }}" class="donation_img my-3" alt="">
                                            <h4 class="mt-3 fw-bold">Autres options</h4>
                                            <p class="text-white">Pour me faire un DON par carte de crédit sans PayPal</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </section>





            </div>
        </div>
    </div>
</div>

@endsection


@push('js')

@endpush
