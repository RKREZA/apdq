@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.create.title', ['name' => __('video::video.video.name')]) }}
@endsection

@push('css')
    <style>
        .tag {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 5px;
            margin: 5px;
            border-radius: 3px;
        }
    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('admin.videos.index'),
        'include_header'            => __('core::core.create.title', ['name' => __('video::video.video.name')]),
        'include_breadcrumbs'       => [
            route('dashboard')          => __('admin::auth.dashboard'),
            route('admin.videos.index')  => __('video::video.video.name'),
        ],
    ])

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-8">
                    <form id="video_create_form" action="{{ route('admin.videos.store') }}" method="POST" role="form" autocomplete="off" accept-charset="UTF-8">
                        @csrf()

                        <div class="row">
                            <div class="col-md-6 ps-0">
                                <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
                                    <label class="form-label" for="category_id"><span class="required">{{ __('video::video.video.form.category_id') }}</span></label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="" disabled readonly selected>{{ __('video::video.video.form.select_category') }}</option>
                                        @foreach (\Modules\Video\Entities\VideoCategory::where('status','Active')->get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 pe-0">
                                <div class="input-group input-group-outline mt-3 is-filled @error('created_at') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{{ __('video::video.video.form.created_at') }}</span></label>
                                    <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="{{ old('created_at') }}">
                                    @error('created_at')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
                                <label class="form-label"><span class="required">{{ __('video::video.video.form.title') }}</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
                                <label class="form-label"><span class="required">{{ __('video::video.video.form.description') }}</span></label>
                                <textarea rows="6" id="description" name="description" class="form-control tiny">{{ old('description') }}</textarea>
                                @error('description')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group input-group-outline mt-3 is-filled @error('embed_html') is-invalid @enderror">
                                <label class="form-label"><span class="required">{{ __('video::video.video.form.embed_html') }}</span></label>
                                <input type="text" id="embed_html" name="embed_html" class="form-control" value="{{ old('embed_html') }}">
                                @error('embed_html')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3 is-filled @error('tag') is-invalid @enderror">
                                <label class="form-label"><span class="required">{{ __('video::video.video.form.tag') }}</span></label>
                                <input type="text" rows="6" id="tag" name="tag" class="form-control" value="{{ old('tag') }}"></textarea>
                                @error('tag')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div id="tagsContainer" class="mb-3"></div>

                        <hr class="horizontal light my-4">

                        <div class="col-md-12">
                            <div class="input-group input-group-outline mt-3 is-filled @error('seo_title') is-invalid @enderror">
                                <label class="form-label">{{ __('video::video.video.form.seo_title') }}</label>
                                <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ old('seo_title') }}">
                                @error('seo_title')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group input-group-outline mt-3 is-filled @error('seo_description') is-invalid @enderror">
                                <label class="form-label">{{ __('video::video.video.form.seo_description') }}</label>
                                <textarea rows="2" id="seo_description" name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                @error('seo_description')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                                <label class="form-label">{{ __('video::video.video.form.seo_keyword') }}</label>
                                <textarea rows="4" id="seo_keyword" name="seo_keyword" class="form-control">{{ old('seo_keyword') }}</textarea>
                                @error('seo_keyword')
                                    <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                @enderror
                            </div>
                        </div>

                        {{-- <input type="hidden" name="embed_html" id="embed_html" value=""> --}}
                        <input type="hidden" name="thumbnail_url" id="thumbnail_url_val" value="">
                        {{-- <input type="hidden" name="external_id" id="external_id" value=""> --}}

                        <input type="text" name="files" id="files" hidden>
                        <button type="submit" class="create-button btn btn-dark btn-rounded">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.save') }}
                        </button>
                    </form>
                </div>

                <div class="col-md-4" id="manual_thumbnail">


                    <div class="card">
                        <div class="card-header p-3">
                            <b>Thumbnail</b>
                        </div>
                        <div class="card-body">
                            @include('core::layouts.file_upload',[
                                'file_upload_format'        => 'jpeg, jpg, png',
                                'file_upload_size'          => '1 MB',
                                'dropzone_acceptedFiles'    => '.jpeg,.jpg,.png',
                                'dropzone_paramName'        => 'file',
                                'dropzone_maxFilesize'      => '1',
                                'dropzone_maxFiles'         => '1',
                                'file_uploaded_from'        => 'video'
                            ])
                            <div class="m-2">
                                <img id="thumbnail_url" src="" class="thumbnail w-100" onerror="this.onerror=null;this.src='{{ asset('assets/backend/img/no-image.png') }}';">
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-header p-3">
                            <b>Video</b>
                        </div>
                        <div class="card-body" id="embed_html_container">
                            <div id="embed_html_inside">
                                <img id="thumbnail_url" src="" class="thumbnail w-100" onerror="this.onerror=null;this.src='{{ asset('assets/backend/img/no-video.png') }}';">
                            </div>
                        </div>
                    </div>

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
        var validation_id               = "#video_create_form";
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
            embed_html: {
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
            embed_html: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };

    </script>

    <script>
        $(document).ready(function() {
            var tagsArray = [];

            function updateTagsContainer() {
                // Clear existing tags
                $('#tagsContainer').empty();

                // Add tags to the container
                for (var i = 0; i < tagsArray.length; i++) {
                    $('#tagsContainer').append('<span class="tag">' + tagsArray[i] + '</span>');
                }
            }

            $('#tag').on('input', function() {
                var inputVal = $(this).val();

                // Split input value by commas and remove leading/trailing spaces
                var tags = inputVal.split(',').map(function(tag) {
                    return tag.trim();
                });

                // Remove empty tags
                tags = tags.filter(function(tag) {
                    return tag !== '';
                });

                // Update tags array
                tagsArray = tags;

                // Update tags container
                updateTagsContainer();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Assuming the input with name "files" has an ID of "files"
            $('#files').on('change', function() {
                // Get the value from the input
                var filesValue = $(this).val();

                // Make an Ajax request to the Laravel method
                $.ajax({
                    url: '{{ route("admin.files.fetch") }}',
                    method: 'GET',
                    data: { id: filesValue },
                    dataType: 'json',
                    success: function(result) {
                        $("#thumbnail_url").attr('src', result.url || '/assets/backend/img/no-image.png');
                        $("#thumbnail_url_val").val(result.url);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            // Assuming the input with name "files" has an ID of "files"
            $('#embed_html').on('change', function() {
                var embed_code = $('#embed_html').val();

                var customSrc = '/assets/backend/img/no-video.png';

                // Create an image tag with the custom src value
                var imageTag = $('<img>', {
                    src: customSrc,
                    alt: 'No Video',
                    // You can add more attributes or styles if needed
                });


                if (embed_code != '') {
                    $("#embed_html_inside").html(embed_code);
                } else {
                    $('#embed_html_inside').append(imageTag);
                }
            });
        });
    </script>
@endpush
