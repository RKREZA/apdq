@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.edit.title', ['name' => __('blog::blog.post.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.posts.index'),
        'include_header'            => __('core::core.edit.title', ['name' => __('blog::blog.post.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.posts.index')  => __('blog::blog.post.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-8">
                    <form id="post_edit_form" action="{{ route('admin.posts.update', $post->id) }}" method="POST" role="form" autocomplete="off">
                        @csrf()
                        @include('blog::post.form')
                        <input type="text" name="files" id="files" value="{{ $file_ids }}" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.update') }}
                        </button>
                    </form>
                </div>

                <div class="col-md-4">
                    @include('core::layouts.file_upload',[
                        'model'                     => $post,
                        'file_upload_format'        => 'jpeg, jpg, png',
                        'file_upload_size'          => '1 MB',
                        'dropzone_acceptedFiles'    => '.jpeg,.jpg,.png',
                        'dropzone_paramName'        => 'file',
                        'dropzone_maxFilesize'      => '1',
                        'dropzone_maxFiles'         => '1',
                        'file_uploaded_from'        => 'post'
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
            ['insert', ['link', 'picture', 'post']],
            ['view', ['codeview', 'help']]
        ];

        // Validation
        var validation_id               = "#post_edit_form";
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
            created_at: {
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
            created_at: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };
    </script>

@endpush
