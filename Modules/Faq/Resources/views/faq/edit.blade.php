@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.edit.title', ['name' => __('faq::faq.faq.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.faqs.index'),
        'include_header'            => __('core::core.edit.title', ['name' => __('faq::faq.faq.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.faqs.index')  => __('faq::faq.faq.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form id="faq_edit_form" action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('faq::faq.form')
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <img src="{{ asset('assets/backend/img/icons/optimized/update.png') }}" class="pageicon" alt="">
                            {{ __('core::core.update') }}
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
        var validation_id               = "#faq_edit_form";
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
