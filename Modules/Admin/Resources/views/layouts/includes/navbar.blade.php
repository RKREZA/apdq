<nav class="rounded-3 navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-md" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid px-0">

        <div class="collapse navbar-collapse" id="navbar">
            <div class="sidenav-toggler sidenav-toggler-inner sidebar_event" id="sidebar">
                <a href="javascript:;" class="nav-link border-0" data-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Open/Close">

                    {{-- @if (Session::get('mode') == 'dark')
                        <img src="{{ asset('assets/backend/img/icons/optimized/nav-white.png') }}" class="icon" id="nav" alt="">
                    @else
                        <img src="{{ asset('assets/backend/img/icons/optimized/nav.png') }}" class="icon" id="nav" alt="">
                    @endif --}}

                    <i class="fi fi-ss-bars-staggered"></i>

                </a>
            </div>

            {{-- <ul class="navbar-nav justify-content-start w-60">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('auth/dashboard*') ? 'bg-gradient-dark text-white' : '' }}" data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="{{ __('admin::dashboard.title') }}">
                        @if (request()->is('auth/dashboard*'))
                            <img src="{{ asset('assets/backend/img/icons/optimized/dashboard-color.png') }}" class="icon" alt="">
                        @else
                            <img src="{{ asset('assets/backend/img/icons/optimized/dashboard.png') }}" class="icon" alt="">
                        @endif

                        <span class="nav-link-text language-text">{{ __('admin::dashboard.title') }}</span>
                    </a>
                </li>

            </ul> --}}

            <ul class="navbar-nav justify-content-end w-100">

                {{-- <li class="nav-item d-xl-block" data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Change Mode">
                    <input type='checkbox' id='mode' data-class="bg-transparent"onclick="darkMode(this); sidebarType(this);" @if (Session::get('mode') == 'dark') checked="true" @endif>
                    <label for='mode' class="nav-link"></label>
                </li> --}}

                <li class="nav-item d-md-block">
                    <a href="#" class="nav-link" id='mode' data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Change Mode">
                        <input type='checkbox' style="display: none;" id='mode_value' data-class="bg-transparent"onclick="darkMode(this); sidebarType(this);" @if (Session::get('mode') == 'dark') checked="true" @endif>
                        @if (Session::get('mode') == 'dark')
                            <i class="fi fi-ss-brightness"></i>
                        @else
                            <i class="fi fi-ss-moon-stars"></i>
                        @endif
                    </a>
                </li>

                <li class="nav-item d-md-block">
                    <a href="/" class="nav-link" target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Front End">
                        {{-- @if (Session::get('mode') == 'dark')
                            <img src="{{ asset('assets/backend/img/icons/optimized/monitor-white.png') }}" class="icon" id="web" alt="">
                        @else
                            <img src="{{ asset('assets/backend/img/icons/optimized/monitor.png') }}" class="icon" id="web" alt="">
                        @endif --}}

                        <i class="fi fi-ss-screen"></i>
                    </a>
                </li>

                <li class="nav-item d-md-block">
                    <a href="#" class="nav-link" type="button" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#feedbackForm" data-bs-placement="bottom"
                        title="" data-bs-original-title="{{ __('admin::auth.feedback.index') }}">


                        {{-- @if (Session::get('mode') == 'dark')
                            <img src="{{ asset('assets/backend/img/icons/optimized/feedback-white.png') }}" class="icon" id="feedback-icon">
                        @else
                            <img src="{{ asset('assets/backend/img/icons/optimized/feedback.png') }}" class="icon" id="feedback-icon">
                        @endif --}}

                        <i class="fi fi-ss-hands-heart"></i>
                    </a>
                </li>

                @include('admin::layouts.includes.language-selector')
                @include('admin::layouts.includes.notification')

                <li class="nav-item dropdown">

                    <a href="javascript:;" class="nav-link {{ request()->is('auth/profile*') ? 'bg-gradient-dark text-white' : '' }}" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="{{ __('admin::auth.profile.index') }}">

                        @if (count(auth()->user()->files)>0)
                            <img src="/@if(count(auth()->user()->files)>0){{ auth()->user()->files[0]->path }}@endif" alt="" style="height: 25px;width: 25px;margin-top: -3px;border-radius: 20px;">
                        @else
                            {{-- @if (request()->is('auth/profile*') || Session::get('mode') == 'dark')
                                <img src="{{ asset('assets/backend/img/icons/optimized/user-white.png') }}" class="icon" id="user" alt="">
                            @else
                                <img src="{{ asset('assets/backend/img/icons/optimized/user.png') }}" class="icon" id="user" alt="">
                            @endif --}}
                            <i class="fi fi-ss-user"></i>
                        @endif


                        {{-- <span class="language-text">{{ __('admin::navbar.profile') }}</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        {{-- <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
                                <div class="d-flex align-items-center py-1">
                                    <div class="ms-2">
                                        <h6 class="text-sm font-weight-normal my-auto">
                                            {{ auth()->user()->name }}
                                        </h6>
                                        <small>{{ auth()->user()->getRoleNames() }}</small><br>

                                    </div>
                                </div>
                            </a>
                        </li> --}}


                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.profile') }}">
                                <div class="d-flex align-items-center py-1">
                                        <i class="material-icons fixed-plugin-button-nav cursor-pointer">
                                            account_circle
                                        </i>
                                    <div class="ms-2">

                                        <h6 class="text-sm font-weight-normal my-auto">
                                            {{-- {{ __('admin::auth.profile.index') }} --}}
                                            {{ auth()->user()->name }}
                                        </h6>

                                    </div>
                                </div>
                            </a>
                        </li>

                        {{-- <hr class="horizontal light"> --}}
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.logout') }}">
                                <div class="d-flex align-items-center py-1">
                                    <span class="material-icons">logout</span>
                                    <div class="ms-2">
                                        <h6 class="text-sm font-weight-normal my-auto">
                                            {{ __('admin::auth.log_out') }}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</nav>
