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
            margin: 0 5px 5px 0;
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
            <form id="video_create_form" action="{{ route('admin.videos.store') }}" method="POST" role="form" autocomplete="off" accept-charset="UTF-8">
                @csrf()
                {{-- @include('video::video.manual.form') --}}

                <div class="row mb-3">

                    <div class="col-md-8">

                        <div class="row">

                            <div class="col-md-12">
                                <h6 class="mt-4 text-primary">{{ __('core::core.publish_information') }}</h6>
                                <hr class="mb-1">
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline mt-3 is-filled @error('publish_type') is-invalid @enderror is-filled">
                                    <label class="form-label" for="publish_type"><span class="required">{{ __('core::core.publish_type') }}</span></label>
                                    <select name="publish_type" id="publish_type" class="form-control @error('publish_type') is-invalid @enderror">
                                        <option value="publish">{{ __('core::core.publish') }}</option>
                                        <option value="schedule">{{ __('core::core.schedule') }}</option>
                                    </select>
                                    @error('publish_type')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-outline mt-3 is-filled @error('created_at') is-invalid @enderror">
                                    <label class="form-label"><span class="required">{{ __('video::video.video.form.created_at') }}</span></label>
                                    <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="{{ old('created_at', now()->format('Y-m-d\TH:i')) }}">
                                    @error('created_at')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h6 class="mt-4 text-primary">{{ __('video::video.video.form.video_information') }}</h6>
                                <hr class="mb-1">
                            </div>

                            <div class="col-md-3">
                                <div class="input-group input-group-outline mt-3 is-filled @error('content_type') is-invalid @enderror is-filled">
                                    <label class="form-label" for="content_type"><span class="required">{{ __('video::video.video.form.content_type') }}</span></label>
                                    <select name="content_type" id="content_type" class="form-control @error('content_type') is-invalid @enderror">
                                        <option value="free">{{ __('core::core.free') }}</option>
                                        <option value="paid">{{ __('core::core.paid') }}</option>
                                    </select>
                                    @error('content_type')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
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

                            <div class="col-md-3">
                                <div class="input-group input-group-outline mt-3 is-filled @error('subcategory_id') is-invalid @enderror is-filled">
                                    <label class="form-label" for="subcategory_id"><span class="required">{{ __('video::video.video.form.subcategory_id') }}</span></label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                                        <option value="" disabled readonly selected>{{ __('video::video.video.form.select_subcategory') }}</option>
                                        @foreach (\Modules\Video\Entities\VideoSubcategory::where('status','Active')->get() as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group input-group-outline mt-3 is-filled @error('playlist_id') is-invalid @enderror is-filled">
                                    <label class="form-label" for="playlist_id"><span class="required">{{ __('video::video.video.form.playlist_id') }}</span></label>
                                    <select name="playlist_id" id="playlist_id" class="form-control @error('playlist_id') is-invalid @enderror">
                                        <option value="" disabled readonly selected>{{ __('video::video.video.form.select_playlist') }}</option>
                                        @foreach (\Modules\Video\Entities\VideoPlaylist::where('status','Active')->get() as $playlist)
                                            <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('playlist_id')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-10 ps-0">
                                        <input type="text" name="youtube_link" id="youtube_link" class="form-control px-3" placeholder="Youtube Link">
                                    </div>

                                    <div class="col-md-2 pe-0">
                                        <button type="button" id="fetch_youtube_data" class="btn btn-primary btn-lg w-100">Fetch</button>
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
                                    <label class="form-label"><span class="">{{ __('video::video.video.form.description') }}</span></label>
                                    <textarea rows="6" id="description" name="description" class="form-control tiny">{{ old('description') }}</textarea>
                                    @error('description')
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


                            <div class="col-md-12">
                                <h6 class="mt-4 text-primary">{{ __('core::core.seo_information') }}</h6>
                                <hr class="mb-1">
                            </div>

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
                                    <textarea rows="6" id="seo_description" name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                    @error('seo_description')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                                    <label class="form-label">{{ __('video::video.video.form.seo_keyword') }}</label>
                                    <textarea rows="6" id="seo_keyword" name="seo_keyword" class="form-control">{{ old('seo_keyword') }}</textarea>
                                    @error('seo_keyword')
                                        <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <input type="hidden" name="embed_html" id="embed_html" value="">
                        <input type="hidden" name="thumbnail_url" id="thumbnail_url_val" value="">
                        <input type="hidden" name="external_id" id="external_id" value="">

                    </div>

                    <div class="col-md-4">

                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mt-4 text-primary">{{ __('core::core.thumbnail') }}</h6>
                                <hr class="mb-3">
                            </div>
                            <div class="col-md-12">
                                <img id="thumbnail_url" src="" class="thumbnail w-100" onerror="this.onerror=null;this.src='{{ asset('assets/backend/img/no-thumbnail.webp') }}';">
                            </div>

                            <div class="col-md-12">
                                <h6 class="mt-4 text-primary">{{ __('core::core.video') }}</h6>
                                <hr class="mb-3">
                            </div>
                            <div class="col-md-12">
                                <div id="embed_html_inside">
                                    <img id="thumbnail_url" src="" class="thumbnail w-100" onerror="this.onerror=null;this.src='{{ asset('assets/backend/img/no-video.webp') }}';">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <input type="text" name="files" id="files" hidden>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <button type="submit" class="create-button btn btn-dark btn-rounded ms-1">
                            <i class="fi fi-ss-disk"></i>
                            {{ __('core::core.save') }}
                        </button>
                    </div>
                </div>

            </form>
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
            category_id: {
                required: true
            },
            subcategory_id: {
                required: true
            },
            playlist_id: {
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
            category_id: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            subcategory_id: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            playlist_id: {
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

            $('#tag').on('input change', function() {
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

    <script type="text/javascript">
        $("body").on("click", "#fetch_youtube_data", function() {
            var youtube_link =  $("#youtube_link").val();
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('admin.videos.fetch_youtube_data_from_link') }}`,
                type: 'post',
                data: {
                    _token: _token,
                    youtube_link: youtube_link
                },
                success: function(result) {
                    // alert(result.title);
                    $("#title").val(result.title);
                    $("#description").summernote('code',result.description);
                    $("#thumbnail_url").attr('src', result.thumbnail_url);

                    $("#embed_html_inside").html(result.embed_html);
                    $("#embed_html").val(result.embed_html);
                    $("#thumbnail_url_val").val(result.thumbnail_url);
                    $("#external_id").val(result.external_id);
                    $("#created_at").val(result.created_at);
                    $("#tag").val(result.tag);
                    // Update tags container
                    updateTagsContainer();
                },
                error: function(result) {
                    @include('admin::layouts.includes.js.json_response')
                }
            });
        });

    </script>
@endpush
