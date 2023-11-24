@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.edit.title', ['name' => __('user::permissiongroup.name')]) }}
@endsection

@push('css')
    <style>
        #output {
            height: 300px;
            width: 300px;
        }

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.permissiongroups.index'),
        'include_header'            => __('core::core.edit.title', ['name' => __('user::permissiongroup.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.permissiongroups.index')  => __('user::permissiongroup.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">

            <div class="row">

                <form id="user_permissiongroup_edit_form" action="{{ route('admin.permissiongroups.update', $permissiongroup->id) }}" method="POST" role="form" autocomplete="off">
                    @csrf()
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3 is-filled @error('name') is-invalid @enderror is-filled">
                            <label class="form-label"><span class="required">{{ __('user::permissiongroup.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $permissiongroup->name }}">
                            @error('name')
                                <em class="error invalid-notice" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3 is-filled @error('display_name') is-invalid @enderror is-filled">
                            <label class="form-label">{{ __('user::permissiongroup.form.display_name') }}</label>
                            <input type="text" name="display_name" class="form-control" value="{{ $permissiongroup->display_name }}">
                            @error('display_name')
                                <em class="error invalid-notice" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3 is-filled @error('description') is-invalid @enderror is-filled">
                            <label class="form-label">{{ __('user::permissiongroup.form.description') }}</label>
                            <input type="text" name="description" class="form-control" value="{{ $permissiongroup->description }}">
                            @error('description')
                                <em class="error invalid-notice" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="edit-button btn btn-dark btn-rounded mt-1 my-0 float-end">
                        <img src="{{ asset('assets/backend/img/icons/optimized/update.png') }}" class="pageicon" alt="">
                        {{ __('core::core.update') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('js')

<script>

    // Validation
    var validation_id               = "#user_permissiongroup_add_form";
    var errorElement                = "em";
    var rules                       = {
        name: {
            required: true,
        },
        display_name: {
            required: false,
        },
        description: {
            required: false,
        },

    };
    var messages                    = {
        name: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
        display_name: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
        description: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
    };
</script>
@endpush
