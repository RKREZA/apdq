@extends('admin::layouts.main')

@section('page_title')
    {{ __('admin::profile.title') }}
@endsection

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #profile_image {
            position: absolute;
            left: 15px;
            width: 112px;
            height: 112px;
            background: transparent;
            border: none;
            box-shadow: none;

        }

        #profile_image .change_profile_picture {
            display: none;
            background: red;
        }

        #profile_image:hover .change_profile_picture {
            display: block;
            z-index: 99999;
        }

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
            padding: 4em 0px;
            margin: 0;
            text-align: center;
        }

        .custom-file-container .custom-file:hover, #profile_output:hover {
            background: #000;
            color: #fff;
        }

    </style>
@endpush

@section('container')
    <div class="row mb-5">
        <div class="col-lg-3 ps-md-0">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                            <i class="fi fi-ss-user"></i> <span class="text-sm ms-2">{{ __('admin::profile.tab.profile') }}</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#change_signature">
                            <i class="material-icons text-lg me-2">fingerprint</i>
                            <span class="text-sm">{{ __('admin::profile.tab.signature') }}</span>
                        </a>
                    </li> --}}
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#change_password">
                            <i class="fi fi-ss-lock"></i> <span class="text-sm ms-2">{{ __('admin::profile.tab.change_password') }}</span>
                        </a>
                    </li>
                    @if (auth()->user()->hasRole('User'))
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#current_subscription">
                            <i class="fi fi-ss-money-check-edit"></i>
                            <span class="text-sm ms-2">{{ __('admin::profile.tab.current_subscription') }}</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4 pe-md-0">
            <!-- Card Profile -->

            <div class="card" id="profile">
                <div class="card-header">
                    <h5 class="m-0"><i class="fi fi-ss-user"></i> {{ __('admin::profile.tab.profile') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-left align-items-center">
                        {{-- <div class="col-sm-auto col-md-4">
                            <div class="custom-file-container">
                                <img src="/@if(count(auth()->user()->files)>0){{ auth()->user()->files[0]->path }}@endif" alt="..." id="profile_output" class="img-thumbnail rounded" onerror="this.src='{{ asset('assets/backend/img/no-image.png') }}';">
                            </div>
                        </div> --}}
                        <div class="col-sm-auto col-md-12 my-auto">
                            <div class="h-100">
                                <table class="table">
                                    <tr>
                                        <th>{{ __('admin::profile.form.name') }}</th>
                                        <th>:</th>
                                        <td id="name_container">
                                            <span id="name_td">{{ $user->name }}</span>
                                            <form id="change_name" style="display:none" method="post" action="{{ route('admin.profile.name.update') }}">
                                                @csrf
                                                <div class="input-group input-group-outline is-filled @error('name') is-invalid @enderror">
                                                    {{-- <label class="form-label"><span class="@if(isset($user)) @else required @endif">{{ __('user::user.form.password') }}</span></label> --}}
                                                    <input type="text" name="name" class="form-control password_hide_show" id="name" value="{{ $user->name }}">
                                                    <button type="submit" style="height: 36px;" class="input-group-text password_hide_show">
                                                        <i class="fi fi-ss-disk"></i>
                                                    </button>
                                                    @error('name')
                                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                                    @enderror
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <i class="material-icons text-lg me-2" id="edit_btn_name" style="cursor: pointer">edit</i>
                                            <i class="material-icons text-lg me-2" id="close_btn_name" style="display: none;cursor: pointer">close</i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('admin::profile.form.role') }}</th>
                                        <th>:</th>
                                        <td>
                                            @foreach (auth()->user()->getRoleNames() as $role)
                                                {{ $role }}
                                            @endforeach
                                        </td>
                                        <td><i class="material-icons text-lg me-2">lock</i></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('admin::profile.form.email') }}</th>
                                        <th>:</th>
                                        <td>{{ $user->email }}</td>
                                        <td><i class="material-icons text-lg me-2">lock</i></td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('admin::profile.form.mobile') }}</th>
                                        <th>:</th>
                                        <td id="mobile_container">
                                            <span id="mobile_td">{{ $user->mobile }}</span>
                                            <form id="change_mobile" style="display:none" method="post" action="{{ route('admin.profile.mobile.update') }}">
                                                @csrf
                                                <div class="input-group input-group-outline is-filled @error('mobile') is-invalid @enderror">
                                                    {{-- <label class="form-label"><span class="@if(isset($user)) @else required @endif">{{ __('user::user.form.password') }}</span></label> --}}
                                                    <input type="text" name="mobile" class="form-control password_hide_show" id="mobile" value="{{ $user->mobile }}">
                                                    <button type="submit" style="height: 36px;" class="input-group-text password_hide_show">
                                                        <i class="fi fi-ss-disk"></i>
                                                    </button>
                                                    @error('mobile')
                                                        <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                                                    @enderror
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <i class="material-icons text-lg me-2" id="edit_btn_mobile" style="cursor: pointer">edit</i>
                                            <i class="material-icons text-lg me-2" id="close_btn_mobile" style="display: none;cursor: pointer">close</i>
                                        </td>
                                    </tr>

                                    @if (auth()->user()->division_id != null || !empty(auth()->user()->division_id))
                                    <tr>
                                        <th>{{ __('admin::profile.division') }}</th>
                                        <th>:</th>
                                        <td>{{ auth()->user()->division->bn_name }}</td>
                                        <td><i class="material-icons text-lg me-2">lock</i></td>
                                    </tr>
                                    @endif

                                    @if (auth()->user()->district_id != null || !empty(auth()->user()->district_id))
                                    <tr>
                                        <th>{{ __('admin::profile.district') }}</th>
                                        <th>:</th>
                                        <td>{{ auth()->user()->district->bn_name }}</td>
                                        <td><i class="material-icons text-lg me-2">lock</i></td>
                                    </tr>
                                    @endif

                                    @if (auth()->user()->subdistrict_id != null || !empty(auth()->user()->subdistrict_id))
                                    <tr>
                                        <th>{{ __('admin::profile.subdistrict') }}</th>
                                        <th>:</th>
                                        <td>{{ auth()->user()->subdistrict->bn_name }}</td>
                                        <td><i class="material-icons text-lg me-2">lock</i></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Change Password -->
            <div class="card mt-2" id="change_password">
                <div class="card-header">
                    <h5 class="m-0"><i class="fi fi-ss-lock"></i> {{ __('admin::profile.tab.change_password') }}</h5>
                </div>
                <form action="{{ route('admin.profile.password.update') }}" method="post" id="update_password">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div
                                    class="input-group input-group-outline is-filled @error('old_password') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{!! __('admin::profile.form.current_password') !!}</span></label>
                                    <input type="password" id="old_password" name="old_password" class="form-control">
                                    @error('old_password')
                                        <em class="error" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                                <div
                                    class="input-group input-group-outline is-filled my-3 @error('password') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{!! __('admin::profile.form.new_password') !!}</span></label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <span style="height: 36px;" class="input-group-text password_hide_show" id="password_hide_show">
                                        <i class="material-icons" id="password_hide_show_icon">visibility_off</i>
                                    </span>
                                    @error('password')
                                        <em class="error" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                                <div
                                    class="input-group input-group-outline is-filled @error('password_confirmation') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{!! __('admin::profile.form.confirm_new_password') !!}</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                    <span style="height: 36px;" class="input-group-text password_hide_show" id="password_hide_show_confirmation">
                                        <i class="material-icons" id="password_hide_show_confirmation_icon">visibility_off</i>
                                    </span>
                                    @error('password_confirmation')
                                        <em class="error" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>

                                <button class="create-button btn btn-dark btn-lg float-end mt-3 mb-0 w-100">{!! __('admin::profile.form.update') !!}</button>
                            </div>
                            <div class="col-md-6">
                                <h5 class="">{{ __('admin::profile.guideline') }}</h5>
                                {!! __('admin::profile.password_guideline') !!}
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if (auth()->user()->hasRole('User'))
            <!-- Subscription -->
            <div class="card mt-2" id="current_subscription">
                <div class="card-header">
                    <h5 class="m-0"><i class="fi fi-ss-money-check-edit"></i> {{ __('admin::profile.tab.current_subscription') }}</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 pb-4">

                            @if (auth()->user()->subscriptionStatus() == 'expired')
                                <b>{{ __('admin::profile.form.subscription_expired') }}</b>
                                <a href="{{ route('frontend.subscription') }}" class="btn btn-warning" target="_blank">{{ __('core::core.form.buy_now') }}</a>
                            @elseif (str_starts_with(auth()->user()->subscriptionStatus(), 'expires_in_'))
                                <b>{{ __('admin::profile.form.subscription_expires_in', ['days' => substr(auth()->user()->subscriptionStatus(), 11)]) }}</b>
                            @else
                                <b>{{ __('admin::profile.form.no_subscription') }}</b>
                                <a href="{{ route('frontend.subscription') }}" class="btn btn-warning" target="_blank">{{ __('core::core.form.buy_now') }}</a>
                            @endif

                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>

            </div>
            @endif

        </div>
    </div>
@endsection

@push('js')
    <script>
        // Validation
        var validation_id               = "#update_password";
        var errorElement                = "em";
        var rules                       = {
            old_password: {
                required: true,
                minlength: 6,
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },

        };
        var messages                    = {
            old_password: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            password: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            password_confirmation: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };
    </script>

    <script>
        $(document).ready(function() {
            $("#edit_btn_name").click(function() {
                $("#change_name").show();
                $("#name_td").hide();
                $("#edit_btn_name").hide();
                $("#close_btn_name").show();
            });

            $("#close_btn_name").click(function() {
                $("#name_td").show();
                $("#change_name").hide();
                $("#close_btn_name").hide();
                $("#edit_btn_name").show();
            });
        });


        $(document).ready(function() {
            $("#edit_btn_mobile").click(function() {
                $("#change_mobile").show();
                $("#mobile_td").hide();
                $("#edit_btn_mobile").hide();
                $("#close_btn_mobile").show();
            });

            $("#close_btn_mobile").click(function() {
                $("#mobile_td").show();
                $("#change_mobile").hide();
                $("#close_btn_mobile").hide();
                $("#edit_btn_mobile").show();
            });
        });

    </script>
@endpush
