@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('user::role.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.roles.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('user::role.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')                  => __('admin::auth.dashboard'),
            route('admin.roles.index')    => __('user::role.name'),
        ],
    ])


    <div class="card">
        <div class="card-body">
            <div class="row">

                <form id="role_create_form" action="{{ route('admin.roles.store') }}" method="POST" role="form" autocomplete="off">
                    @csrf()

                    @include('user::roles.form')

                    <button type="submit"
                        class="create-button btn btn-dark btn-rounded mt-1 my-0 float-end">
                        <img src="{{ asset('assets/backend/img/icons/optimized/save.png') }}" class="pageicon" alt="">
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
    var validation_id               = "#role_create_form";
    var errorElement                = "em";
    var rules                       = {
        name: {
            required: true,
        },

    };
    var messages                    = {
        name: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
    };

</script>

@endpush
