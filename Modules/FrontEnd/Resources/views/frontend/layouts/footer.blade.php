<section id="footer" class="mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 px-4">
                <img src="{{ asset('assets/frontend/img/logo.webp') }}" class="footer-logo" alt="">
                <div class="social-link">
                    <ul>
                        <li style="font-family: 'Play', sans-serif; font-size: 14px;">Je m'appelle Dominick Jasmin et j'ai créer ce site pour donner mon opinion et mes observations sur la politique canadienne et québécoise, avec un brin d'humour ;)</li>
                        <li><a target="_blank" href="https://facebook.com/APDQavecDominick/"><img src="{{ asset('assets/frontend/img/youtube.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/c/Actualit%C3%A9PolitiqueDuQu%C3%A9bec"><img src="{{ asset('assets/frontend/img/facebook.png') }}" alt=""></a></li>
                        <li><a target="_blank" href="https://twitter.com/PolitiqueQuebec"><img src="{{ asset('assets/frontend/img/twitter.png') }}" alt=""></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 px-4">
                <div class="footer-link">
                    <h5>Catégories de vidéos</h3>
                    <ul>
                        @foreach (\Modules\Video\Entities\VideoCategory::where('status','Active')->get() as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4 px-4">
                <div class="footer-link">
                    <h5>Links</h5>
                    <ul>
                        @foreach (\Modules\Cms\Entities\Page::where('status','Active')->get() as $page)
                            <li><a href="#">{{ $page->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-md-6 px-4 py-3">
                <p class="small">Tous Droits Réservés © APDQ</p>
            </div>
        </div>
    </div>
</section>
