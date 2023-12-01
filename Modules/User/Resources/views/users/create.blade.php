@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('user::user.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.users.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('user::user.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.users.index')  => __('user::user.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col">
                    <form id="user_create_form" action="{{ route('admin.users.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('user::users.form')
                        <input type="text" name="files" id="files" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.save') }}
                        </button>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="col-md-12 position-relative">
                        <form action="{{ route('admin.files.store') }}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="myDropzone">
                            @csrf
                            <div class="dz-message" data-dz-message>
                                <i class="material-icons" style="font-size: 60px;">cloud_upload</i>
                                <h6 class="m-0">{{ __('core::core.form.photo') }}</h6>
                                <p class="text-xs mt-2">
                                    {{ __('core::core.form.supported_format', [ 'formats' => 'jpeg, jpg, png']) }} <br>
                                    {{ __('core::core.form.supported_size', [ 'size' => '1 MB']) }}
                                </p>
                            </div>
                            <input type="text" name="uploaded_from" value="users" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        // Dropzone Data
        var dropzone_acceptedFiles      = ".jpeg,.jpg,.png";
        var dropzone_paramName          = "file";
        var dropzone_maxFilesize        = "1";
        var dropzone_maxFiles           = 1;

        // Validation
        var validation_id               = "#user_create_form";
        var errorElement                = "em";
        var rules                       = {
            name: {
                required: true,
            },
            designation: {
                required: true,
            },
            mobile: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
            },
            'roles[]': {
                required: true
            },

        };
        var messages                    = {
            name: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            designation: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            mobile: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            email: {
                required: "{{ __('core::core.form.validation.required') }}",
                email: "{{ __('core::core.form.validation.email') }}",
            },
            password: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            password_confirmation: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            'roles[]': {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>
@endpush
