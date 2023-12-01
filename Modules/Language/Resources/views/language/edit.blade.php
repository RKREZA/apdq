@extends('admin::layouts.main')

@section('page_title')
    {{ __('language::language.name') }}
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
                <form id="language_category_edit_form" action="{{ route('admin.setting.languages.update', $language->id) }}" method="POST" role="form" autocomplete="off">
                    @csrf()
                    <div class="row">

                        @include('language::language.form')

                        <button type="submit" class="edit-button btn btn-dark btn-rounded mt-1 my-0 float-end">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.save') }}
                        </button>
                    </div>
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
