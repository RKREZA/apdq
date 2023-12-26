@push('css')
<style>

</style>
@endpush


<nav class="navbar navbar-expand-lg bg-body-tertiary bg-transparent py-2 fixed-top" id="navbar_top">
    <div class="container-fluid">
        <button class="drawer_icon me-3" type="button">
            <i class="fi fi-br-grid"></i>
        </button>

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
            <ul class="navbar-nav mb-2 mb-lg-0 ms-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('video*') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.video') }}">Vidéos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('live') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.live') }}">@if(isset($live) && $live)<i class="fi fi-ss-signal-stream animated"></i>@endif En direct</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.blog') }}">Blog</a>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('search*') ? 'active' : '' }}" aria-current="page" href="#search"><i class="fi fi-rs-search"></i> Rechercher</a>
                </li> --}}






                <li class="nav-item">
                    <form action="{{ route('frontend.search') }}" method="get" id="search_form">
                        @csrf
                        <input type="search" name="keyword" @if(isset(request()->keyword)) {{ request()->keyword }} @endif autocomplete="off" placeholder="Search" required />
                        <button type="submit" class="btn btn-success"><i class="fi fi-br-search"></i></button>
                    </form>
                </li>

                @php
                    $languages = \Modules\Language\Entities\Language::where('status','Active')->get();
                @endphp
                <li class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link change-language btn btn-lg btn-outline-icon ms-0 ms-md-3" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="{{ __('core::core.form.change-language') }}">

                        <i class="fi fi-br-language"></i>

                        {{-- <span class="language-text" style="">
                            @foreach ($languages as $language)
                                @if (Session::get('locale') === $language->code)
                                    {{ $language->name }}
                                @elseif (config('app.locale') == $language->code)
                                    {{ $language->name }}
                                @endif
                            @endforeach
                        </span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        @if ($languages)
                            @foreach ($languages as $language)
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="{{ route('setlocale', $language->code) }}">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="ms-2">
                                                <h6 class="text-sm font-weight-normal my-auto">
                                                    @if (Session::get('locale') === $language->code)
                                                        <i class="fi fi-br-check"></i>
                                                    @elseif (config('app.locale') == $language->code)
                                                        <i class="fi fi-br-check"></i>
                                                    @endif
                                                    {{ $language->name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                @if(auth()->check())
                    <li class="nav-item dropdown profile">
                        <a class="nav-link dropdown-toggle p-0 ms-0 ms-md-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (count(auth()->user()->files)>0)
                                <img src="{{ auth()->user()->files[0]->path }}" class="profile_img rounded-circle img-fluid img-thumbnail">
                            @else
                                <img src="/assets/backend/img/no-image.png" class="profile_img rounded-circle img-fluid img-thumbnail">
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
                        <a class="nav-link btn btn-lg btn-outline-icon ms-0 ms-md-3" aria-current="page" href="{{ route('admin.login') }}"><i class="fi fi-ss-circle-user"></i></a>
                    </li>
                @endif


                <li class="nav-item">
                    <a class="nav-link btn btn-lg btn-red ms-0 ms-md-3" aria-current="page" href="{{ route('frontend.subscription') }}"><i class="fi fi-sr-crown"></i> VIP</a>
                </li>
            </ul>
        </div>

    </div>
</nav>

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

    <script>
        // // fixed menu on scroll for desktop
        // if ($(window).width() > 992) {
        //     $(window).scroll(function () {
        //         if ($(this).scrollTop() > 100) {
        //             $('#navbar_top').addClass("fixed-top");
        //             $('#navbar_top').removeClass("bg-transparent");
        //             $('#navbar_top').addClass("navbar-dark");
        //             // add padding top to show content behind navbar
        //             $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
        //         } else {
        //             $('#navbar_top').removeClass("fixed-top");
        //             $('#navbar_top').addClass("bg-transparent");
        //             $('#navbar_top').removeClass("navbar-dark");
        //             // remove padding top from body
        //             $('body').css('padding-top', '0');
        //         }
        //     });

        //     // add transition effect for smoother animation
        //     $('#navbar_top').css('transition', 'all 0.3s ease');
        // } // end if
    </script>
@endpush
