@extends('admin::layouts.guest')

@section('page_title')
    {{ __('admin::auth.reset_password_title') }}
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
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('/assets/img/illustrations/cover');">
            <span class="mask" style="text-align: center;">

            </span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">

                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">

                                    <h4 class="text-white font-weight-bolder lead text-center mt-2 mb-0">
                                        {{ __('admin::auth.reset_password_title') }}
                                    </h4>

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.password.update') }}" method="POST" role="form"
                                    class="text-start" id="reset_password">
                                    @csrf()

                                    <input type="hidden" name="token" value="{{ request()->token }}" class="form-control">

                                    <div class="input-group input-group-outline my-3 is-filled">
                                        <label class="form-label"><span class="required">{{ __('admin::auth.form.email') }}</span></label>
                                        <input type="email" class="form-control" value="{{ request()->email }}" disabled>
                                        <input type="hidden" name="email" class="form-control" value="{{ request()->email }}">
                                    </div>

                                    <div class="input-group input-group-outline mb-3 is-filled">
                                        <label class="form-label"><span class="required">{{ __('admin::auth.form.new_password') }}</span></label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            data-rule-password="true">
                                    </div>

                                    <div class="input-group input-group-outline mb-3 is-filled">
                                        <label class="form-label"><span class="required">{{ __('admin::auth.form.confirm_password') }}</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" data-rule-password="true" data-rule-equalTo="#password">
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="show_password">
                                            <label class="form-check-label mb-0 ms-2" for="show_password">{{ __('admin::auth.form.show_password') }}</label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="create-button btn btn-dark w-100 my-2">{{ __('admin::auth.reset_password_button') }}</button>
                                    </div>

                                </form>
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
        var validation_id               = "#reset_password";
        var errorElement                = "em";
        var rules                       = {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirm: {
                required: true,
                minlength: 6,
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
        };

    </script>

    <script>
        $(document).ready(function() {

            $('#show_password').on('click', function() {
                var password = $("#password");
                var password_confirmation = $("#password_confirmation");
                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    password_confirmation.attr('type', 'text');
                } else {
                    password.attr('type', 'password');
                    password_confirmation.attr('type', 'password');
                }
            })
        })
    </script>
@endpush
