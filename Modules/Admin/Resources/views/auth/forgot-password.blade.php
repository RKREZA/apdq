@extends('admin::layouts.guest')

@section('page_title')
    {{ __('admin::auth.forgot_password_title') }}
@endsection

@push('css')
    <style>
        .alert {
            position: fixed;
            bottom: 0;
            right: 15px;
            color: #fff;
        }

    </style>
@endpush

@section('container')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('/assets/img/illustrations/cover');">
            <span class="mask" style="text-align: center;">

            </span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-12 mx-auto">

                        <div class="card z-index-0">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1 text-center">

                                    <span class="text-white font-weight-bolder lead text-center mt-2 mb-0">{{ __('admin::auth.forgot_password_title') }}</span>

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.password.email') }}" method="POST" role="form"
                                    class="text-start" id="forgot_password">
                                    @csrf()

                                    <div class="input-group input-group-outline my-3 is-filled @error('email') is-invalid @enderror">
                                        <label class="form-label"><span class="required">{{ __('admin::auth.form.email') }}</span></label>
                                        <input type="email" name="email" class="form-control is-filled" value="{{ old('email') }}">
                                    </div>

                                    @include('admin::layouts.includes.captcha')

                                    <div class="text-center">
                                        <button type="submit" class="create-button btn btn-dark w-100 my-2">{{ __('admin::auth.send_password_reset_link') }}</button>
                                    </div>

                                </form>

                                <p class="mt-4 text-sm text-center">
                                    <a href="{{ route('admin.login') }}" class="text-primary text-gradient font-weight-bold">{{ __('admin::auth.back_to_login') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
    <script>

        // Validation
        var validation_id               = "#forgot_password";
        var errorElement                = "em";
        var rules                       = {
            email: {
                required: true,
                email: true
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
            captcha: {
                required: "{{ __('admin::auth.form.validation.captcha.required') }}",
                captcha: "{{ __('admin::auth.form.validation.captcha.captcha') }}",
            },
        };

    </script>
@endpush
