@extends('admin::layouts.main')

@section('page_title')
    {{ __('setting::setting.adminsetting.index') }}
@endsection

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .img-thumbnail {
            height: auto;
            width: 100%;
        }

        /* Logo Light */

        .custom-file-container{
            position: relative;
        }
        .custom-file-container .custom-file {
            border-radius: 5px;
            color: transparent;
            cursor: pointer;
            background: transparent;
            position: absolute;
            left: 0px;
            width: 100%;
            height: 100%;
            padding: 10em 0px;
            margin: 0;
            text-align: center;
            font-size: 13px;
        }

        .custom-file-container .custom-file:hover, #profile_output:hover {
            background: #000;
            color: #fff;
        }

        #logo_light_button_image{
            position: absolute;
            left: 0;
            top: 30px;
            width: 100%;
            height: 200px;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        #logo_light_button_image .change_logo_light{
            display: none;
            background: red;
        }
        #logo_light_button_image:hover .change_logo_light{
            display: block;
            z-index: 99999;
        }



        /* Logo Dark */

        #logo_dark_button_image{
            position: absolute;
            left: 0px;
            top: 30px;
            width: 100%;
            height: 200px;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        #logo_dark_button_image .change_logo_dark{
            display: none;
            background: red;
        }
        #logo_dark_button_image:hover .change_logo_dark{
            display: block;
            z-index: 99999;
        }



        /* Favicon */

        #favicon_button_image{
            position: absolute;
            left: 0;
            top: 30px;
            width: 100%;
            height: 200px;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        #favicon_button_image .change_favicon{
            display: none;
            background: red;
        }
        #favicon_button_image:hover .change_favicon{
            display: block;
            z-index: 99999;
        }





        /* Meta Image */

        #meta_image_button_image{
            position: absolute;
            left: 0;
            top: 30px;
            width: 100%;
            height: 200px;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        #meta_image_button_image .change_meta_image{
            display: none;
            background: red;
        }
        #meta_image_button_image:hover .change_meta_image{
            display: block;
            z-index: 99999;
        }





        /* Meta Image */

        #preloader_image_button_image{
            position: absolute;
            left: 0;
            top: 30px;
            width: 100%;
            height: 200px;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        #preloader_image_button_image .change_preloader_image{
            display: none;
            background: red;
        }
        #preloader_image_button_image:hover .change_preloader_image{
            display: block;
            z-index: 99999;
        }

        @media only screen and (max-width: 600px) {
            .img-thumbnail {
                height: 100px;
                width: 100px;
            }
        }

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('dashboard'),
        'include_header'        => __('setting::setting.adminsetting.index'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ]
    ])

    <div class="row mb-5">
        <div class="col-lg-3 ps-md-0">
            <div class="card position-sticky top-2">
                <ul class="nav flex-column bg-white border-radius-lg p-3">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#site-info">
                            <i class="fi fi-sr-info"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_info') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                            <i class="fi fi-sr-id-badge"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_logo_favicon') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#meta-info">
                            <i class="fi fi-sr-site-alt"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_meta') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#preloader">
                            <i class="fi fi-sr-loading"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_preloader') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#back_to_top">
                            <i class="fi fi-sr-arrow-alt-to-top"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_back_to_top') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#copyright">
                            <i class="fi fi-sr-copyright"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.tab_copyright') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#google_login">
                            <i class="fi fi-brands-google"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.google_login') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#facebook_login">
                            <i class="fi fi-brands-facebook"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.facebook_login') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#other_google_credentials">
                            <i class="fi fi-brands-google"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.other_google_credentials') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#gdpr">
                            <i class="fi fi-sr-shield-check"></i>
                            <span class="text-sm ms-2">{{ __('setting::setting.adminsetting.form.gdpr') }}</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4 pe-md-0">

            <!-- Site Info -->
            <div class="card mb-2" id="site-info">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_info') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_info') }}"
                    id="admin_setting_info_update">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-outline is-filled @if ($setting->title) is-valid @endif">
                                    <label
                                        class="form-label">{{ __('setting::setting.adminsetting.form.title') }}</label>
                                    <input type="text" name="title" class="form-control" @if ($setting->title) value="{{ $setting->title }}" @endif>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-group input-group-outline mt-4 is-filled @if ($setting->description) is-valid @endif">
                                    <label
                                        class="form-label">{{ __('setting::setting.adminsetting.form.description') }}</label>
                                    <input type="text" name="description" class="form-control" @if ($setting->title) value="{{ $setting->description }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_info_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


            <!-- Logo & Favicon -->
            <div class="card mt-2" id="profile">

                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_logo_favicon') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-left align-items-center">

                        {{-- <div class="col-4 position-relative">
                            <div class="form-group">
                                <label for="webtitle" class="required">{{ __('setting::setting.adminsetting.form.logo_dark') }}</label>
                                <div class="custom-file-container">
                                    <img src="{{ $setting->logo_dark }}" alt="..." id="logo_dark_output"
                                            class="img-thumbnail rounded"
                                            onerror="this.src='{{ asset('assets/backend/img/no-image.webp') }}';">
                                    <label class="custom-file">
                                        {{ __('admin::profile.form.change_image') }}<input type="file" style="display: none;" name="logo_dark" id="logo_dark">
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-4 position-relative">
                            <div class="form-group">
                                <label for="webtitle" class="required">{{ __('setting::setting.adminsetting.form.logo_light') }}</label>
                                <div class="custom-file-container">
                                    <img src="{{ $setting->logo_light }}" alt="..." id="logo_light_output"
                                            class="img-thumbnail rounded"
                                            onerror="this.src='{{ asset('assets/backend/img/no-image.webp') }}';">
                                    <label class="custom-file">
                                        {{ __('admin::profile.form.change_image') }}<input type="file" style="display: none;" name="logo_light" id="logo_light">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 position-relative">
                            <div class="form-group">
                                <label for="webtitle"
                                    class="required">{{ __('setting::setting.adminsetting.form.favicon') }}</label>
                                <div class="custom-file-container">
                                    <img src="{{ $setting->favicon }}" alt="..." id="favicon_output"
                                            class="img-thumbnail rounded"
                                            onerror="this.src='{{ asset('assets/backend/img/no-image.webp') }}';">
                                    <label class="custom-file">
                                        {{ __('admin::profile.form.change_image') }}<input type="file" style="display: none;" name="favicon" id="favicon">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="card mt-2" id="meta-info">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_meta') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 position-relative">
                            <div class="form-group">
                                {{-- <label for="meta_image" class="required">{{ __('setting::setting.adminsetting.form.meta_image') }}</label> --}}
                                <div class="custom-file-container">
                                    <img src="{{ $setting->meta_image }}" alt="..." id="meta_image_output"
                                            class="img-thumbnail rounded"
                                            onerror="this.src='{{ asset('assets/backend/img/no-image.webp') }}';">
                                    <label class="custom-file">
                                        {{ __('admin::profile.form.change_image') }}<input type="file" style="display: none;" name="meta_image" id="meta_image">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <form method="post" action="{{ route('admin.setting.adminsettings.update_meta') }}"
                                id="admin_setting_meta_update">
                                @csrf()
                                <div class="col-12">
                                    <div class="input-group input-group-outline is-filled @if ($setting->meta_title) is-valid @endif">
                                        <label class="form-label">{{ __('setting::setting.adminsetting.form.meta_title') }}</label>
                                        <input type="text" name="meta_title" class="form-control" @if ($setting->meta_title) value="{{ $setting->meta_title }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mt-4 is-filled @if ($setting->meta_description) is-valid @endif">
                                        <label class="form-label">{{ __('setting::setting.adminsetting.form.meta_description') }}</label>
                                        <input type="text" name="meta_description" class="form-control"
                                            @if ($setting->meta_description) value="{{ $setting->meta_description }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mt-4 is-filled @if ($setting->meta_keywords) is-valid @endif">
                                        <label class="form-label">{{ __('setting::setting.adminsetting.form.meta_keywords') }}</label>
                                        <input type="text" name="meta_keywords" class="form-control" @if ($setting->meta_keywords) value="{{ $setting->meta_keywords }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mt-4 is-filled @if ($setting->social_title) is-valid @endif">
                                        <label class="form-label">{{ __('setting::setting.adminsetting.form.social_title') }}</label>
                                        <input type="text" name="social_title" class="form-control" @if ($setting->social_title) value="{{ $setting->social_title }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mt-4 is-filled @if ($setting->social_description) is-valid @endif">
                                        <label class="form-label">{{ __('setting::setting.adminsetting.form.social_description') }}</label>
                                        <input type="text" name="social_description" class="form-control" @if ($setting->social_description) value="{{ $setting->social_description }}" @endif>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_meta_button') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preloader -->
            <div class="card mt-2" id="preloader">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_preloader') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_preloader') }}" id="admin_setting_preloader_update">
                    @csrf()
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-check form-switch mt-4">
                                    <label class="form-check-label"  for="preloader_status"> {{ __('setting::setting.adminsetting.form.preloader_status') }}</label>
                                    <input class="form-check-input @error('public') is-invalid @enderror" name="preloader_status" type="checkbox" id="preloader_status" @if ($setting->preloader_status=='Active') checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_preloader_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

            <!-- Back To Top -->
            <div class="card mt-2" id="back_to_top">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_back_to_top') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_back_to_top') }}"
                    id="admin_setting_back_to_top_update">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-check form-switch mt-4">
                                    <label class="form-check-label"  for="back_to_top_status"> {{ __('setting::setting.adminsetting.form.back_to_top_status') }}</label>
                                    <input class="form-check-input @error('public') is-invalid @enderror" name="back_to_top_status" type="checkbox" id="back_to_top_status" value="{{ $setting->back_to_top_status }}" @if ($setting->back_to_top_status=='Active') checked @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_back_to_top_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

            <!-- Copyright -->
            <div class="card mt-2" id="copyright">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.tab_copyright') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_copyright') }}"
                    id="">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-outline is-filled @if ($setting->copyright) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.copyright') }}</label>
                                    <input type="text" name="copyright" class="form-control" @if ($setting->copyright) value="{{ $setting->copyright }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_copyright_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


            <!-- google_login -->
            <div class="card mt-2" id="google_login">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.google_login') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_setting') }}"
                    id="">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_login) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_login') }}</label>
                                    <select name="google_login" id="google_login" class="form-control">
                                        <option @if ($setting->google_login) @if($setting->google_login == 'Active') selected @endif value="{{ $setting->google_login }}" @endif>Active</option>
                                        <option @if ($setting->google_login) @if($setting->google_login == 'Inactive') selected @endif value="{{ $setting->google_login }}" @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_client_id) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_client_id') }}</label>
                                    <input type="text" name="google_client_id" class="form-control" @if ($setting->google_client_id) value="{{ $setting->google_client_id }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_client_secret) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_client_secret') }}</label>
                                    <input type="text" name="google_client_secret" class="form-control" @if ($setting->google_client_secret) value="{{ $setting->google_client_secret }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_redirect) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_redirect') }}</label>
                                    <input type="text" name="google_redirect" class="form-control" @if ($setting->google_redirect) value="{{ $setting->google_redirect }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_google_login_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

            <!-- facebook_login -->
            <div class="card mt-2" id="facebook_login">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.facebook_login') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_setting') }}"
                    id="">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->facebook_login) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.facebook_login') }}</label>
                                    <select name="facebook_login" id="facebook_login" class="form-control">
                                        <option @if ($setting->facebook_login) @if($setting->facebook_login == 'Active') selected @endif value="{{ $setting->facebook_login }}" @endif>Active</option>
                                        <option @if ($setting->facebook_login) @if($setting->facebook_login == 'Inactive') selected @endif value="{{ $setting->facebook_login }}" @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->facebook_app_id) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.facebook_app_id') }}</label>
                                    <input type="text" name="facebook_app_id" class="form-control" @if ($setting->facebook_app_id) value="{{ $setting->facebook_app_id }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->facebook_client_secret) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.facebook_client_secret') }}</label>
                                    <input type="text" name="facebook_client_secret" class="form-control" @if ($setting->facebook_client_secret) value="{{ $setting->facebook_client_secret }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->facebook_redirect) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.facebook_redirect') }}</label>
                                    <input type="text" name="facebook_redirect" class="form-control" @if ($setting->facebook_redirect) value="{{ $setting->facebook_redirect }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_facebook_login_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>



            <!-- Other Google Credentials -->
            <div class="card mt-2" id="other_google_credentials">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.other_google_credentials') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_setting') }}"
                    id="">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_recaptcha_v3_site_key) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_recaptcha_v3_site_key') }}</label>
                                    <input type="text" name="google_recaptcha_v3_site_key" class="form-control" @if ($setting->google_recaptcha_v3_site_key) value="{{ $setting->google_recaptcha_v3_site_key }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_recaptcha_v3_secret_key) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_recaptcha_v3_secret_key') }}</label>
                                    <input type="text" name="google_recaptcha_v3_secret_key" class="form-control" @if ($setting->google_recaptcha_v3_secret_key) value="{{ $setting->google_recaptcha_v3_secret_key }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_adsense_publisher_id) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_adsense_publisher_id') }}</label>
                                    <input type="text" name="google_adsense_publisher_id" class="form-control" @if ($setting->google_adsense_publisher_id) value="{{ $setting->google_adsense_publisher_id }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->google_youtube_api_key) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.google_youtube_api_key') }}</label>
                                    <input type="text" name="google_youtube_api_key" class="form-control" @if ($setting->google_youtube_api_key) value="{{ $setting->google_youtube_api_key }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_other_google_credentials_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


            <!-- GDPR -->
            <div class="card mt-2" id="gdpr">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::setting.adminsetting.form.gdpr') }}</h6>
                </div>
                <form method="post" action="{{ route('admin.setting.adminsettings.update_setting') }}"
                    id="">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->gdpr_cookie_title) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.gdpr_cookie_title') }}</label>
                                    <input type="text" name="gdpr_cookie_title" class="form-control" @if ($setting->gdpr_cookie_title) value="{{ $setting->gdpr_cookie_title }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->gdpr_cookie_text) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.gdpr_cookie_text') }}</label>
                                    <input type="text" name="gdpr_cookie_text" class="form-control" @if ($setting->gdpr_cookie_text) value="{{ $setting->gdpr_cookie_text }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group input-group-outline is-filled @if ($setting->gdpr_cookie_url) is-valid @endif">
                                    <label class="form-label">{{ __('setting::setting.adminsetting.form.gdpr_cookie_url') }}</label>
                                    <input type="text" name="gdpr_cookie_url" class="form-control" @if ($setting->gdpr_cookie_url) value="{{ $setting->gdpr_cookie_url }}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-md float-end mt-4 mb-0"><i class="fi fi-sr-refresh me-2"></i>{{ __('setting::setting.adminsetting.form.update_gdpr_button') }}</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


        </div>
    </div>

@endsection


@push('js')
<script type="text/javascript">

    $('#meta_image').on('change', function(ev) {
        var filedata        = this.files[0];
        var imgtype         = filedata["type"];
        var imgsize         = filedata.size/1024/1024;
        var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/webp"];

        if ($.inArray(imgtype, validImageTypes) < 0) {
            alert('Only jpg, jpeg, png, webp & gif allowed');
        }else if (imgsize > 1) {
            alert('Only less then 1MB image are allowed');
        }else {
            var reader = new FileReader();
            reader.onload = function(ev) {
                $('#meta_image_output').attr('src', ev.target.result);
            }
            reader.readAsDataURL(this.files[0]);

            var postData = new FormData();
            postData.append('file', this.files[0]);
            var url = "{{ route('admin.setting.adminsettings.meta_image') }}";

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                async: true,
                type: "post",
                contentType: false,
                url: url,
                data: postData,
                processData: false,
                success: function(result) {
                    console.log(result);
                    @include('admin::layouts.includes.js.json_response')
                },

            });

        }

    });

    $('#logo_light').on('change', function(ev) {
        var filedata        = this.files[0];
        var imgtype         = filedata["type"];
        var imgsize         = filedata.size/1024/1024;
        var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/webp"];

        if ($.inArray(imgtype, validImageTypes) < 0) {
            alert('Only jpg, jpeg, png, webp & gif allowed');
        }else if (imgsize > 1) {
            alert('Only less then 1MB image are allowed');
        }else {
            var reader = new FileReader();
            reader.onload = function(ev) {
                $('#logo_light_output').attr('src', ev.target.result);
            }
            reader.readAsDataURL(this.files[0]);

            var postData = new FormData();
            postData.append('file', this.files[0]);
            var url = "{{ route('admin.setting.adminsettings.logo_light') }}";

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                async: true,
                type: "post",
                contentType: false,
                url: url,
                data: postData,
                processData: false,
                success: function(result) {
                    console.log(result);
                    @include('admin::layouts.includes.js.json_response')
                },
            });
        }
    });

    $('#favicon').on('change', function(ev) {
        var filedata        = this.files[0];
        var imgtype         = filedata["type"];
        var imgsize         = filedata.size/1024/1024;
        var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/webp"];

        if ($.inArray(imgtype, validImageTypes) < 0) {
            alert('Only jpg, jpeg, png, webp & gif allowed');
        }else if (imgsize > 1) {
            alert('Only less then 1MB image are allowed');
        }else {
            var reader = new FileReader();
            reader.onload = function(ev) {
                $('#favicon_output').attr('src', ev.target.result);
            }
            reader.readAsDataURL(this.files[0]);

            var postData = new FormData();
            postData.append('file', this.files[0]);
            var url = "{{ route('admin.setting.adminsettings.favicon') }}";

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                async: true,
                type: "post",
                contentType: false,
                url: url,
                data: postData,
                processData: false,
                success: function(result) {
                    console.log(result);
                    @include('admin::layouts.includes.js.json_response')
                },
            });
        }
    });

</script>

<script>
    tinymce.init({
	      selector: '#description',

	      browser_spellcheck : true,
	      paste_data_images: false,

	      responsive: true,

	      plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools",
                "autosave codesample directionality wordcount"
            ],

            toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",

            content_style: 'body { font-family:Poppins",sans-serif;}',

            imagetools_toolbar: "imageoptions",

	      file_picker_callback (callback, value, meta) {
	        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
	        let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

	        tinymce.activeEditor.windowManager.openUrl({
	          url : '/file-manager/tinymce5',
	          title : 'File manager',
	          width : x * 0.6,
	          height : y * 0.9,
	          onMessage: (api, message) => {
	            callback(message.content, { text: message.text })
	          }
	        })
	      }
	    });
</script>

{{-- Js Validation for Form --}}
<script>
    $(document).ready(function() {
        $("#admin_setting_info_update").validate({

            rules: {
                title: {
                    required: true,
                },
                description: {
                    required: false,
                },
            },
            messages: {
                title: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.title.required') }}",
                },
                description: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.description.required') }}",
                }
            },

            errorElement: "em",

            errorPlacement: function(error, element) {
                console.log(element.closest('.input-group'));
                error.addClass("invalid-notice");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.next("label"));
                } else {
                    error.insertAfter(element);
                }
            },

            highlight: function(element, errorClass, validClass) {
                $(element).closest('.input-group').addClass("is-invalid").removeClass("is-valid");
                $(element).closest('.input-group').addClass("focused");
                $(element).closest('.input-group').addClass("is-focused");
                $('button[type="submit"]').removeAttr('disabled');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.input-group').addClass("is-valid").removeClass("is-invalid")
            }

        });

    });
</script>

<script>
    $(document).ready(function() {
        $("#admin_setting_meta_update").validate({

            rules: {
                meta_image: {
                    required: false,
                },
                meta_title: {
                    required: false,
                },
                meta_description: {
                    required: false,
                },
                meta_keywords: {
                    required: false,
                },
                social_title: {
                    required: false,
                },
                social_description: {
                    required: false,
                }
            },
            messages: {
                meta_image: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.meta_image.required') }}",
                },
                meta_title: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.meta_title.required') }}",
                },
                meta_description: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.meta_description.required') }}",
                },
                meta_keywords: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.meta_keywords.required') }}",
                },
                social_title: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.social_title.required') }}",
                },
                social_description: {
                    required: "{{ __('setting::setting.adminsetting.form.validation.social_description.required') }}",
                }
            },

            errorElement: "em",

            errorPlacement: function(error, element) {
                console.log(element.closest('.input-group'));
                error.addClass("invalid-notice");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.next("label"));
                } else {
                    error.insertAfter(element);
                }
            },

            highlight: function(element, errorClass, validClass) {
                // $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );

                $(element).closest('.input-group').addClass("is-invalid").removeClass("is-valid");
                $(element).closest('.input-group').addClass("focused");
                $(element).closest('.input-group').addClass("is-focused");
            },
            unhighlight: function(element, errorClass, validClass) {
                // $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );

                $(element).closest('.input-group').addClass("is-valid").removeClass("is-invalid")
            }

        });

    });
</script>

<script type="text/javascript">
    function configcache() {
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.artisan.optimize') }}`,
            type: 'get',
            data: {
                _token: _token,
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
            }
        });
    }
</script>

<script>
    $(".nav a").click(function (e) {
        $(this).tab("show");

        var tabContent = "#tabContent" + this.id;

        $("#tabContent2").hide();
        $("#tabContent3").hide();
        $(tabContent).show();
    });
</script>

@endpush
