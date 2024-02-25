@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('live::live.live.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.lives.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('live::live.live.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.lives.index')  => __('live::live.live.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form id="live_create_form" action="{{ route('admin.lives.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('live::live.form')
                        <input type="text" name="files" id="files" hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="create-button btn btn-dark btn-rounded">
                                    <i class="fi fi-ss-disk"></i>
                                    {{ __('core::core.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#live_create_form";
        var errorElement                = "em";
        var rules                       = {
            publish_type: {
                required: true,
            },
            content_type: {
                required: true,
            },
            title: {
                required: true,
            },
            description: {
                required: false
            },
            youtube_link: {
                required: true
            },

        };
        var messages                    = {
            publish_type: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            content_type: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            title: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            description: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            youtube_link: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>
@endpush
