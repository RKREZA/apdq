@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('stoppage::stoppage.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.stoppages.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('stoppage::stoppage.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.stoppages.index')  => __('stoppage::stoppage.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-8">
                    <form id="stoppage_create_form" action="{{ route('admin.stoppages.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('stoppage::stoppage.form')
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
                        'dropzone_maxFilesize'      => '5',
                        'dropzone_maxFiles'         => '1',
                        'file_uploaded_from'        => 'stoppages'
                    ])
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        // Dropzone Data
        // var dropzone_acceptedFiles      = ".jpeg,.jpg,.png";
        // var dropzone_paramName          = "file";
        // var dropzone_maxFilesize        = "1";
        // var dropzone_maxFiles           = 1;

        // Validation
        var validation_id               = "#stoppage_create_form";
        var errorElement                = "em";
        var rules                       = {
            name: {
                required: true,
            },
            slug: {
                required: true
            },

        };
        var messages                    = {
            name: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            slug: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>
@endpush
