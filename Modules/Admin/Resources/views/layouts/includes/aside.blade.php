<aside class="sidenav bg-gradient-dark navbar navbar-vertical navbar-expand-xs border-0 my-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <span aria-hidden="true" id="iconSidenav" class="sidebar_event material-icons-round p-3 cursor-pointer text-white position-absolute end-0 top-0 d-xl-none">highlight_off</span>
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
            <img src="{{ $settings->logo_light }}" class="navbar-brand-img" alt="main_logo" onerror="this.src='{{ asset('assets/backend/img/logo-light.webp') }}';">
        </a>
    </div>

            <hr class="horizontal light">
    <div class="collapse navbar-collapse w-auto h-auto"
        id="sidenav-collapse-main">
        <ul class="navbar-nav pb-5">

            <li class="nav-item mt-2">
                <a class="nav-link  {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/backend/img/icons/optimized/dashboard-white.png') }}" class="asideicon" alt="">
                    <span class="sidenav-normal"> {{ __('admin::dashboard.title') }} </span>
                </a>
            </li>

            {{-- <hr class="horizontal light"> --}}

            @if (Gate::check('user-list') || Gate::check('permissiongroup-list') || Gate::check('role-list') || Gate::check('permission-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#usermanagement" class="nav-link fw-normal {{ request()->is('admin/um/*') ? 'active' : '' }}" aria-controls="usermanagement" role="button" aria-expanded="{{ request()->is('admin/um/*') ? 'true' : 'false' }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/usermanagement-white.png') }}" class="asideicon" alt="">
                        <span class="nav-link-text">{{ __('user::user.user') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('admin/um/*') ? 'show' : '' }}" id="usermanagement">
                        <ul class="nav ">

                            @can('user-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/um/users/*') ? 'active' : '' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('user::user.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/um/roles/*') ? 'active' : '' }}"
                                        href="{{ route('admin.roles.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('user::role.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/um/permissions/*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('user::permission.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endif

            @if (Gate::check('adminsetting-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#componentsExamples" class="nav-link fw-normal {{ request()->is('admin/setting/*') ? 'active' : '' }}" aria-controls="componentsExamples" role="button" aria-expanded=" {{ request()->is('admin/setting/*') ? 'true' : 'false' }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/adminsetting-white.png') }}" class="asideicon" alt="">
                        <span class="nav-link-text">{{ __('setting::setting.adminsetting.index') }}</span>
                    </a>
                    <div class="collapse  {{ request()->is('admin/setting/*') ? 'show' : '' }}" id="componentsExamples">
                        <ul class="nav ">
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('admin/setting/adminsetting/*') ? 'active' : '' }}" href="{{ route('admin.setting.adminsettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::setting.adminsetting.index') }} </span>
                                </a>
                            </li>

                            {{-- <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('admin/setting/sms/index*') ? 'active' : '' }}" href="{{ route('admin.setting.smssettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::sms.index.title') }} </span>
                                </a>
                            </li> --}}

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('admin/setting/smtp/index*') ? 'active' : '' }}" href="{{ route('admin.setting.smtpsettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::smtp.index.title') }} </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('admin/setting/language/*') ? 'active' : '' }}" href="{{ route('admin.setting.languages.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('language::language.name') }} </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ request()->is('admin/setting/media/*') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="nav-link-text">{{ __('setting::setting.media_manager.name') }}</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('admin/setting/backup/*') ? 'active' : '' }}" href="{{ route('admin.setting.backup.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::setting.backup.name') }} </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/user-activity" class="nav-link">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="nav-link-text">{{ __('setting::setting.activity_log.name') }}</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/log-viewer" class="nav-link">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="nav-link-text">{{ __('setting::setting.error_log.name') }}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endif

            @if (Gate::check('frontendsetting-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#frontendmanager" class="nav-link fw-normal {{ request()->is('admin/frontendmanager/*') ? 'active' : '' }}"
                        aria-controls="frontendmanager" role="button" aria-expanded=" {{ request()->is('admin/frontendmanager/*') ? 'true' : 'false' }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/frontend-white.png') }}" class="asideicon" alt="">
                        <span class="nav-link-text">{{ __('frontendmanager::frontendmanager.frontend_manager') }}</span>
                    </a>
                    <div class="collapse  {{ request()->is('admin/frontendmanager/*') ? 'show' : '' }}" id="frontendmanager">
                        <ul class="nav ">

                            @can('frontendsetting-list')
                                <li class="nav-item ">
                                    <a class="nav-link  {{ request()->is('admin/frontendmanager/frontendsetting/*') ? 'active' : '' }}" href="{{ route('admin.frontendmanager.frontendsettings.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('frontendmanager::frontendmanager.index.title') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endif

            @can('feedback-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('admin/feedback/*') ? 'active' : '' }}" href="{{ route('admin.feedbacks.index') }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/feedback-white.png') }}" class="asideicon" alt="">
                        <span class="sidenav-normal"> {{ __('feedback::feedback.feedback.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('faq-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('admin/faq/*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/faq-white.png') }}" class="asideicon" alt="">
                        <span class="sidenav-normal"> {{ __('faq::faq.faq.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('announcement-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('admin/announcement/*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                        <img src="{{ asset('assets/backend/img/icons/optimized/announcement-white.png') }}" class="asideicon" alt="">
                        <span class="sidenav-normal"> {{ __('announcement::announcement.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

    </div>
</aside>
