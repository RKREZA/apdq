@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.edit.title', ['name' => __('subscription::subscription.subscription.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.subscriptions.index'),
        'include_header'            => __('core::core.edit.title', ['name' => __('subscription::subscription.subscription.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.subscriptions.index')  => __('subscription::subscription.subscription.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form id="subscription_edit_form" action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('subscription::subscription.form')
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <i class="fi fi-ss-disk"></i>
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
            ['insert', ['link', 'picture', 'subscription']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#subscription_edit_form";
        var errorElement                = "em";
        var rules                       = {
            title: {
                required: true,
            },
            description: {
                required: true
            },
            duration: {
                required: true
            },
            duration_type: {
                required: true
            },
            price: {
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
            duration: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            duration_type: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            price: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };
    </script>

@endpush
