
@extends('admin::layouts.guest')

@section('page_title')
    {{ __('admin::auth.signin_title') }}
@endsection

@push('css')
    <style>
        .logo{
            height: 60px;
            width: auto;
            margin: 15px;
        }
        .logo:first-child{
            /* border-right: 2px solid #004884c7;
            padding-right: 15px; */
        }
        .logo:last-child{
            /* padding-left: 5px; */
        }
    </style>
@endpush

@section('container')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container my-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-5 my-4">
                            <div class="card p-3" style="border-top: 3px solid #000; border-bottom: 3px solid #000;">
                                <div class="row text-center px-4" style="">
                                    <div class="col-12">
                                        <img src="{{ asset('assets/backend/img/logo.webp') }}" style="" class="logo">
                                    </div>
                                </div>

                                <div class="card-header text-center bg-transparent py-0 mt-3 border-0">
                                    <h4 class="font-weight-bolder text-center m-0">{{ __('admin::auth.signin_title') }}</h4>
                                </div>

                                <div class="card-body py-0">

                                    <form action="{{ route('admin.login.go') }}" method="POST" role="form" class="text-start" id="login" autocomplete="on">
                                        @csrf

                                        <div class="input-group input-group-outline my-3 is-filled @error('email') is-invalid @enderror">
                                            <label class="form-label"><span class="required">{{ __('admin::auth.form.email') }}</span></label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="example@mail.com">
                                            @error('email')
                                                <em class="error invalid-feedback"
                                                    style="display: inline-block;">{{ $message }}</em>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-2 is-filled @error('password') is-invalid @enderror">
                                            <label class="form-label"><span class="required">{{ __('admin::auth.form.password') }}</span></label>
                                            <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" placeholder="******">
                                            <span style="height: 36px;" class="input-group-text" id="password_hide_show">
                                                <i class="material-icons" id="password_hide_show_icon">visibility_off</i>
                                            </span>

                                            @error('password')
                                                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                <label class="form-check-label mb-0 ms-3" for="remember">{{ __('admin::auth.form.remember') }}</label>
                                            </div>
                                        </div>


                                        {{-- @include('admin::layouts.includes.captcha') --}}
                                        
                                        {!!  GoogleReCaptchaV3::renderField('login_id','login_action') !!}

                                        <div class="text-center">
                                            <button type="submit" class="create-button btn btn-dark w-100 mb-2" id="submit">
                                                {{ __('admin::auth.signin_button') }}
                                            </button>
                                        </div>

                                        {{-- <div class="flex items-center justify-end mt-4">
                                            <a class="btn" href="{{ url('auth/facebook') }}"
                                                style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                                Login with Facebook
                                            </a>
                                        </div> --}}

                                    </form>
                                </div>

                                <div class="card-footer my-0 p-0">
                                    <p class="mt-2 mb-0 text-sm text-center">
                                        <a href="{{ route('admin.password.request') }}" class="text-start text-dark text-gradient font-weight-bold">{{ __('admin::auth.forgot_password') }}</a> |
                                        <a href="/" class="text-end text-warning text-gradient font-weight-bold">{{ __('admin::auth.back_to_home') }}</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    
@endsection

@push('js')
    <script>

        // Validation
        var validation_id               = "#login";
        var errorElement                = "em";
        var rules                       = {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            captcha: {
                required: true
            }

        };
        var messages                    = {
            email: {
                required: "{{ __('admin::auth.form.validation.email.required') }}",
                email: "{{ __('admin::auth.form.validation.email.email') }}",
            },
            password: {
                required: "{{ __('admin::auth.form.validation.password.required') }}",
            },
            captcha: {
                required: "{{ __('admin::auth.form.validation.captcha.required') }}",
                captcha: "{{ __('admin::auth.form.validation.captcha.captcha') }}",
            },
        };

    </script>

    <script>
        $(document).ready(function() {

            $('#password_hide_show').on('click', function() {
                var passInput = $("#password");
                if (passInput.attr('type') === 'password') {
                    passInput.attr('type', 'text');
                    $('#password_hide_show_icon').html('visibility');
                } else {
                    passInput.attr('type', 'password');
                    $('#password_hide_show_icon').html('visibility_off');
                }
            });
        });
    </script>

    <script>
        // $("#submit").click(function (e) {
        //     // alert('11');
        //     let _token = $('meta[name="csrf-token"]').attr('content');
        //     // e.preventDefault();
        //     $.ajax({
        //         type: 'POST',
        //         url: '/verify/captcha',
        //         data: {
        //             _token: _token,
        //             'g-recaptcha-response': getReCaptchaV3Response('login_ajax_id')
        //         },
        //         success: function (data) {
        //             refreshReCaptchaV3('login_ajax_id', 'login_action');
        //             @include('admin::layouts.includes.js.json_response')
        //         },
        //         error: function (err) {
        //             refreshReCaptchaV3('login_ajax_id', 'login_action');
        //             @include('admin::layouts.includes.js.json_response')
        //         }
        //     });
        // });
    </script>
    {!!  GoogleReCaptchaV3::init() !!}
@endpush


@push('js')

@endpush
