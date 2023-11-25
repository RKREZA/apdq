@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('cms::cms.page.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.pages.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('cms::cms.page.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.pages.index')  => __('cms::cms.page.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-8">
                    <form id="page_create_form" action="{{ route('admin.pages.store') }}" method="Page" role="form" autocomplete="off">
                        @csrf()
                        @include('cms::page.form')
                        <input type="text" name="files" id="files" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <img src="{{ asset('assets/backend/img/icons/optimized/save.png') }}" class="pageicon" alt="">
                            {{ __('core::core.save') }}
                        </button>
                    </form>
                </div>

                <div class="col-md-4">
                    @include('core::layouts.file_upload',[
                        'file_upload_format'        => 'jpeg, jpg, png',
                        'file_upload_size'          => '1 MB',
                        'dropzone_acceptedFiles'    => '.jpeg,.jpg,.png',
                        'dropzone_paramName'        => 'file',
                        'dropzone_maxFilesize'      => '1',
                        'dropzone_maxFiles'         => '1',
                        'file_uploaded_from'        => 'page'
                    ])
                </div>

            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>

        // Summernote
        var height                      = 300;
        var selector                    = '.tiny';
        var toolbar                     = [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'page']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#page_create_form";
        var errorElement                = "em";
        var rules                       = {
            title: {
                required: true,
            },
            description: {
                required: true
            },
            category_id: {
                required: true
            },
            tag: {
                required: true
            },

        };
        var messages                    = {
            title: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            description: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            category_id: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            tag: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>
@endpush
