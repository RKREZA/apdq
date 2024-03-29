@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.edit.title', ['name' => __('live::live.live.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.lives.index'),
        'include_header'            => __('core::core.edit.title', ['name' => __('live::live.live.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.lives.index')  => __('live::live.live.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form id="live_edit_form" action="{{ route('admin.lives.update', $live->id) }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('live::live.form')
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="create-button btn btn-dark btn-rounded">
                                    <i class="fi fi-ss-disk"></i>
                                    {{ __('core::core.update') }}
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
            ['insert', ['link', 'picture', 'live']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#live_edit_form";
        var errorElement                = "em";
        var rules                       = {
            publish_type: {
                required: true,
            },
            content_type: {
                required: true,
            },
            name: {
                required: true,
            },
            description: {
                required: false
            },
            youtube_link: {
                required: false
            },

        };
        var messages                    = {
            publish_type: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            content_type: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            name: {
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
