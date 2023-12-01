@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('language::language.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.setting.languages.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('language::language.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')                  => __('admin::auth.dashboard'),
            route('admin.setting.languages.index')    => __('language::language.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="container-fluid px-2">

                <form id="language_add_form" action="{{ route('admin.setting.languages.store') }}" method="POST" language="form" autocomplete="off">
                    @csrf()

                    @include('language::language.form')

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
    var validation_id               = "#language_add_form";
    var errorElement                = "em";
    var rules                       = {
        name: {
            required: true,
        },
        code: {
            required: true,
        },

    };
    var messages                    = {
        name: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
        code: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
    };
</script>
@endpush
