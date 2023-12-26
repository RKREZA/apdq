@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('slider::slider.slider.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.sliders.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('slider::slider.slider.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.sliders.index')  => __('slider::slider.slider.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-8">
                    <form id="slider_create_form" action="{{ route('admin.sliders.store') }}" method="post" role="form" autocomplete="off">
                        @csrf()
                        @include('slider::slider.form')
                        <input type="text" name="files" id="files" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded mt-3">
                            <i class="fi fi-ss-disk"></i>
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
                        'file_uploaded_from'        => 'slider'
                    ])

                    <img id="thumbnail_url" class="img-thumbnail mt-2 p-2">
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
            ['insert', ['link', 'picture', 'slider']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#slider_create_form";
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
        };

    </script>
@endpush
