<aside class="sidenav bg-gradient-dark navbar navbar-vertical navbar-expand-xs border-0 my-0 fixed-start rounded-3" id="sidenav-main">
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
                <a class="nav-link  {{ request()->is('auth/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    {{-- <img src="{{ asset('assets/backend/img/icons/optimized/dashboard-white.png') }}" class="asideicon" alt=""> --}}
                    <i class="fi fi-ss-apps"></i>
                    <span class="sidenav-normal"> {{ __('admin::dashboard.title') }} </span>
                </a>
            </li>

            @if (Gate::check('video-list') || Gate::check('videocategory-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#video" class="nav-link fw-normal {{ request()->is('auth/video/*') ? 'active' : '' }}" aria-controls="video" role="button" aria-expanded="{{ request()->is('auth/video/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-blog-text"></i>
                        <span class="nav-link-text">{{ __('video::video.video.name') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('auth/video/*') ? 'show' : '' }}" id="video">
                        <ul class="nav ">

                            @can('video-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/video/video/*') ? 'active' : '' }}"
                                        href="{{ route('admin.videos.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('video::video.video.name') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('videocategory-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/video/category/*') ? 'active' : '' }}"
                                        href="{{ route('admin.videocategories.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('video::video.category.name') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endif

            @can('live-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/live/*') ? 'active' : '' }}" href="{{ route('admin.lives.index') }}">
                        <i class="fi fi-ss-signal-stream"></i>
                        <span class="sidenav-normal"> {{ __('live::live.live.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('subscription-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/subscription/*') ? 'active' : '' }}" href="{{ route('admin.subscriptions.index') }}">
                        <i class="fi fi-ss-money-check-edit"></i>
                        <span class="sidenav-normal"> {{ __('subscription::subscription.subscription.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('newsletter-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/newsletter/*') ? 'active' : '' }}" href="{{ route('admin.newsletters.index') }}">
                        <i class="fi fi-ss-envelope-download"></i>
                        <span class="sidenav-normal"> {{ __('newsletter::newsletter.newsletter.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @if (Gate::check('post-list') || Gate::check('postcategory-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#blog" class="nav-link fw-normal {{ request()->is('auth/blog/*') ? 'active' : '' }}" aria-controls="blog" role="button" aria-expanded="{{ request()->is('auth/blog/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-blog-text"></i>
                        <span class="nav-link-text">{{ __('blog::blog.blog') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('auth/blog/*') ? 'show' : '' }}" id="blog">
                        <ul class="nav ">

                            @can('post-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/blog/post/*') ? 'active' : '' }}"
                                        href="{{ route('admin.posts.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('blog::blog.post.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('postcategory-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/blog/category/*') ? 'active' : '' }}"
                                        href="{{ route('admin.postcategories.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('blog::blog.category.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endif

            @can('paymentgateway-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/paymentgateway/*') ? 'active' : '' }}" href="{{ route('admin.paymentgateways.index') }}">
                        <i class="fi fi-ss-money-simple-from-bracket"></i>
                        <span class="sidenav-normal"> {{ __('paymentgateway::paymentgateway.paymentgateway.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('transaction-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/transaction/*') ? 'active' : '' }}" href="{{ route('admin.transactions.index') }}">
                        <i class="fi fi-ss-message-dollar"></i>
                        <span class="sidenav-normal"> {{ __('transaction::transaction.transaction.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            {{-- <hr class="horizontal light"> --}}

            @if (Gate::check('user-list') || Gate::check('permissiongroup-list') || Gate::check('role-list') || Gate::check('permission-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#usermanagement" class="nav-link fw-normal {{ request()->is('auth/um/*') ? 'active' : '' }}" aria-controls="usermanagement" role="button" aria-expanded="{{ request()->is('auth/um/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-id-card-clip-alt"></i>
                        <span class="nav-link-text">{{ __('user::user.user') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('auth/um/*') ? 'show' : '' }}" id="usermanagement">
                        <ul class="nav ">

                            @can('user-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/um/users/*') ? 'active' : '' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('user::user.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/um/roles/*') ? 'active' : '' }}"
                                        href="{{ route('admin.roles.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('user::role.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/um/permissions/*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
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

            @if (Gate::check('page-list') || Gate::check('pagecategory-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#cms" class="nav-link fw-normal {{ request()->is('auth/cms/*') ? 'active' : '' }}" aria-controls="cms" role="button" aria-expanded="{{ request()->is('auth/cms/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-browser"></i>
                        <span class="nav-link-text">{{ __('cms::cms.cms') }}</span>
                    </a>
                    <div class="collapse {{ request()->is('auth/cms/*') ? 'show' : '' }}" id="cms">
                        <ul class="nav ">

                            @can('page-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/cms/page/*') ? 'active' : '' }}"
                                        href="{{ route('admin.pages.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('cms::cms.page.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('pagecategory-list')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('auth/cms/category/*') ? 'active' : '' }}"
                                        href="{{ route('admin.pagecategories.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('cms::cms.category.names') }} </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endif

            @if (Gate::check('adminsetting-list'))
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#componentsExamples" class="nav-link fw-normal {{ request()->is('auth/setting/*') ? 'active' : '' }}" aria-controls="componentsExamples" role="button" aria-expanded=" {{ request()->is('auth/setting/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-settings"></i>
                        <span class="nav-link-text">{{ __('setting::setting.adminsetting.index') }}</span>
                    </a>
                    <div class="collapse  {{ request()->is('auth/setting/*') ? 'show' : '' }}" id="componentsExamples">
                        <ul class="nav ">
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('auth/setting/adminsetting/*') ? 'active' : '' }}" href="{{ route('admin.setting.adminsettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::setting.adminsetting.index') }} </span>
                                </a>
                            </li>

                            {{-- <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('auth/setting/sms/index*') ? 'active' : '' }}" href="{{ route('admin.setting.smssettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::sms.index.title') }} </span>
                                </a>
                            </li> --}}

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('auth/setting/smtp/index*') ? 'active' : '' }}" href="{{ route('admin.setting.smtpsettings.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('setting::smtp.index.title') }} </span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('auth/setting/language/*') ? 'active' : '' }}" href="{{ route('admin.setting.languages.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="sidenav-normal"> {{ __('language::language.name') }} </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ request()->is('auth/setting/media/*') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                                    <span class="sidenav-mini-icon"> - </span>
                                    <span class="nav-link-text">{{ __('setting::setting.media_manager.name') }}</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('auth/setting/backup/*') ? 'active' : '' }}" href="{{ route('admin.setting.backup.index') }}">
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
                    <a data-bs-toggle="collapse" href="#frontendmanager" class="nav-link fw-normal {{ request()->is('auth/frontendmanager/*') ? 'active' : '' }}"
                        aria-controls="frontendmanager" role="button" aria-expanded=" {{ request()->is('auth/frontendmanager/*') ? 'true' : 'false' }}">
                        <i class="fi fi-ss-layout-fluid"></i>
                        <span class="nav-link-text">{{ __('frontendmanager::frontendmanager.frontend_manager') }}</span>
                    </a>
                    <div class="collapse  {{ request()->is('auth/frontendmanager/*') ? 'show' : '' }}" id="frontendmanager">
                        <ul class="nav ">

                            @can('frontendsetting-list')
                                <li class="nav-item ">
                                    <a class="nav-link  {{ request()->is('auth/frontendmanager/frontendsetting/*') ? 'active' : '' }}" href="{{ route('admin.frontendmanager.frontendsettings.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('frontendmanager::frontendmanager.index.title') }} </span>
                                    </a>
                                </li>
                            @endcan

                            @can('slider-list')
                                <li class="nav-item ">
                                    <a class="nav-link  {{ request()->is('auth/frontendmanager/slider/*') ? 'active' : '' }}" href="{{ route('admin.sliders.index') }}">
                                        <span class="sidenav-mini-icon"> - </span>
                                        <span class="sidenav-normal"> {{ __('slider::slider.slider.name') }} </span>
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
                    <a class="nav-link  {{ request()->is('auth/feedback/*') ? 'active' : '' }}" href="{{ route('admin.feedbacks.index') }}">
                        <i class="fi fi-ss-hands-heart"></i>
                        <span class="sidenav-normal"> {{ __('feedback::feedback.feedback.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('faq-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/faq/*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
                        <i class="fi fi-ss-interrogation"></i>
                        <span class="sidenav-normal"> {{ __('faq::faq.faq.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

            @can('announcement-list')
                <li class="nav-item ">
                    <a class="nav-link  {{ request()->is('auth/announcement/*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                        <i class="fi fi-sr-bullhorn"></i>
                        <span class="sidenav-normal"> {{ __('announcement::announcement.name') }} </span>
                    </a>
                </li>
                {{-- <hr class="horizontal light"> --}}
            @endcan

    </div>
</aside>
