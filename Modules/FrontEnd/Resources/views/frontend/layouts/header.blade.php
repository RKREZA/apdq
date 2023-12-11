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
                <span class="navbar-toggler-icon"></span>
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
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.contact') }}">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('donation') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.donation') }}">Donation </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn btn-lg btn-outline-white ms-3" aria-current="page" href="{{ route('admin.login') }}">Login</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Période de questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Projets de loi</a>
                </li> --}}
            </ul>
        </div>

    </div>
  </nav>
