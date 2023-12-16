@push('css')
<style>

.profile_img {
    width: 40px;
    height: 40px;
    padding: 0;
    margin: 0;
}


</style>
@endpush

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/frontend/img/logo.webp') }}" class="logo" alt="">
            <div class="logo-text">
                Actualité Politique<br>
                <span class="logo-second-line">Du Québec</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fi fi-ss-menu-burger navbar-toggler-custom-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('a-propos') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.about') }}">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('video*') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.video') }}">Vidéos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('live') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.live') }}">En direct</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('package*') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.subscription') }}">Plan d'abonnement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('search*') ? 'active' : '' }}" aria-current="page" href="#search"><i class="fi fi-rs-search"></i> Rechercher</a>
                </li>

                @if(auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle py-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (count(auth()->user()->files)>0)
                                <img src="{{ auth()->user()->files[0]->path }}" class="profile_img rounded-circle img-fluid img-thumbnail" style="width: 40px; height:40px">
                            @else
                                <img src="/assets/backend/img/no-image.png" class="profile_img rounded-circle img-fluid img-thumbnail" style="width: 40px; height:40px">
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item py-2" href="{{ route('admin.profile') }}"><i class="fi fi-ss-user"></i> Profil</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="fi fi-ss-apps"></i> Tableau de bord</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.logout') }}"><i class="fi fi-ss-sign-out-alt"></i> Se déconnecter</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-lg btn-outline-white ms-0 ms-md-3" aria-current="page" href="{{ route('admin.login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
  </nav>


<div id="search" class="d-none">
    <button type="button" class="close">×</button>
    <form action="{{ route('frontend.search') }}" method="get">
        @csrf
        <h3>Se mettre...</h3>
        <input type="search" name="keyword" placeholder="tapez le(s) mot(s)-clé(s) ici" @if(isset(request()->keyword)) {{ request()->keyword }} @endif  />
        <button type="submit" class="btn btn-success">Rechercher</button>
    </form>
</div>


@push('js')
    <script>
        $(function () {
            $('a[href="#search"]').on('click', function(event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search').removeClass('d-none');
                $('#search > form > input[type="search"]').focus();
            });

            $('#search, #search button.close').on('click keyup', function(event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });

            // $('form').submit(function(event) {
            //     event.preventDefault();
            //     return false;
            // })
        });
    </script>
@endpush
