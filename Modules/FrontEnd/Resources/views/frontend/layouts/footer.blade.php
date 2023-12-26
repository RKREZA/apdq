<section id="footer" class="">
    <div class="container-fluid">

        <hr class="horizontal light mt-0 mb-5">

        <div class="row align-items-center">
            <div class="col-md-4 px-4">
                <img src="{{ asset('assets/frontend/img/logo.webp') }}" class="footer-logo" alt="">
                <div class="social-link">
                    <ul>
                        <li style="font-family: 'Play', sans-serif; font-size: 14px;" class="text-white">Je m'appelle Dominick Jasmin et j'ai créer ce site pour donner mon opinion et mes observations sur la politique canadienne et québécoise, avec un brin d'humour ;)</li>
                        <li><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://twitter.com/PolitiqueQuebec"><img src="{{ asset('assets/frontend/img/twitter.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://rumble.com/c/APDQ"><img src="{{ asset('assets/frontend/img/rumble.webp') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://odysee.com/@Actualitepolitiqueduquebec:0"><img src="{{ asset('assets/frontend/img/odysee.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://www.tiktok.com/@dominickapdq"><img src="{{ asset('assets/frontend/img/tiktok.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/actualite_politique_du_quebec/"><img src="{{ asset('assets/frontend/img/instagram.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://www.threads.net/@actualite_politique_du_quebec"><img src="{{ asset('assets/frontend/img/threads.png') }}" alt=""></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 px-4">
                <div class="footer-link">
                    <h5 class="fw-bold text-white">Catégories de vidéos</h3>
                    <ul>
                        @foreach (\Modules\Video\Entities\VideoCategory::where('status','Active')->get() as $category)
                            <li><a href="{{ route('frontend.video') }}?code={{ $category->code }}" class="text-light">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4 px-4">
                <div class="footer-link">
                    <h5 class="fw-bold text-white">Links</h5>
                    <ul>
                        @foreach (\Modules\Cms\Entities\Page::where('status','Active')->get() as $page)
                            <li><a href="{{ route('frontend.page.single', $page->slug) }}" class="text-light">{{ $page->title }}</a></li>
                        @endforeach
                        <li><a href="{{ route('frontend.about') }}" class="text-light">À propos</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class="text-light">Contact</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <hr class="horizontal dark">

        <div class="row mt-3    ">
            <div class="col-md-6 px-4 py-3">
                <p class="small text-light">Tous Droits Réservés © APDQ</p>
            </div>
        </div>
    </div>
</section>
