@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('user::permission.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.permissions.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('user::permission.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')                  => __('admin::auth.dashboard'),
            route('admin.permissions.index')    => __('user::permission.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <form id="permission_create_form" action="{{ route('admin.permissions.store') }}" method="POST" role="form" autocomplete="off">
                    @csrf()

                    @include('user::permissions.form')

                    <button type="submit" class="create-button btn btn-dark btn-rounded mt-1 my-0 float-end">
                        <i class="fi fi-ss-disk"></i>
                        {{ __('core::core.save') }}
                    </button>
                </form>

            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>

        // Validation
        var validation_id               = "#permission_create_form";
        var errorElement                = "em";
        var rules                       = {
            name: {
                required: true,
            },
            permissiongroup_id: {
                required: true,
            },

        };
        var messages                    = {
            name: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            permissiongroup_id: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };
    </script>
@endpush
