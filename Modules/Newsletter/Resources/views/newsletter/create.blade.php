@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('newsletter::newsletter.newsletter.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.newsletters.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('newsletter::newsletter.newsletter.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.newsletters.index')  => __('newsletter::newsletter.newsletter.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form id="newsletter_create_form" action="{{ route('admin.newsletters.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('newsletter::newsletter.form')
                        <input type="text" name="files" id="files" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.save') }}
                        </button>
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
        var validation_id               = "#newsletter_create_form";
        var errorElement                = "em";
        var rules                       = {
            email: {
                required: true,
            },

        };
        var messages                    = {
            email: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>
@endpush
