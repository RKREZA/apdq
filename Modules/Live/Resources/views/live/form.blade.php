@push('css')
    <style>
        #map {
            height: 400px;
            width: 600px;
        }

        .tag {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 5px;
            margin: 5px;
            border-radius: 3px;
        }

        .removeTag {
            margin-left: 5px;
            cursor: pointer;
            color: #ff0000;
            text-decoration: none;
        }
    </style>
@endpush

<div class="row mb-4">
    <div class="col-md-10">
        <input type="text" name="youtube_link" id="youtube_link" class="form-control px-3" placeholder="Youtube Link" required>
    </div>

    <div class="col-md-2">
        <button type="button" id="fetch_youtube_data" class="btn btn-primary btn-lg w-100">Fetch</button>
    </div>
</div>
<hr class="horizontal dark">



<div class="row">

    <div class="col-md-8">
        <div class="row">

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('live::live.live.form.title') }}</span></label>
                    <input type="text" name="title" id="title" class="form-control" value="@if(isset($live)){{ $live->title }}@else{{ old('title') }}@endif">
                    @error('title')
                        <em class="error invalid-live" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
                    <label class="form-label"><span class="required">{{ __('live::live.live.form.description') }}</span></label>
                    <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($live)){{ $live->description }}@else{{ old('description') }}@endif</textarea>
                    @error('description')
                        <em class="error invalid-live" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <hr class="horizontal light my-4">

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_title') is-invalid @enderror">
                    <label class="form-label">{{ __('live::live.live.form.seo_title') }}</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control" value="@if(isset($live)){{ $live->seo_title }}@else{{ old('seo_title') }}@endif">
                    @error('seo_title')
                        <em class="error invalid-live" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_description') is-invalid @enderror">
                    <label class="form-label">{{ __('live::live.live.form.seo_description') }}</label>
                    <textarea rows="2" id="seo_description" name="seo_description" class="form-control">@if(isset($live)){{ $live->seo_description }}@else{{ old('seo_description') }}@endif</textarea>
                    @error('seo_description')
                        <em class="error invalid-live" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                    <label class="form-label">{{ __('live::live.live.form.seo_keyword') }}</label>
                    <textarea rows="4" id="seo_keyword" name="seo_keyword" class="form-control">@if(isset($live)){{ $live->seo_keyword }}@else{{ old('seo_keyword') }}@endif</textarea>
                    @error('seo_keyword')
                        <em class="error invalid-live" style="display: inline-block;">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="embed_html" id="embed_html" value="@if(isset($live)){{ $live->embed_html }}@else{{ old('embed_html') }}@endif">
            <input type="hidden" name="thumbnail_url" id="thumbnail_url_val" value="@if(isset($live)){{ $live->thumbnail_url }}@else{{ old('thumbnail_url') }}@endif">
            <input type="hidden" name="external_id" id="external_id" value="@if(isset($live)){{ $live->external_id }}@else{{ old('external_id') }}@endif">

        </div>
    </div>
    <div class="col-md-4">
        <img id="thumbnail_url" src="@if(isset($live)){{ $live->thumbnail_url }}@else{{ old('thumbnail_url') }}@endif" class="thumbnail w-100" onerror="this.onerror=null;this.src='{{ asset('assets/backend/img/no-image.png') }}';">
    </div>
</div>


@push('js')
<script type="text/javascript">
    $("body").on("click", "#fetch_youtube_data", function() {
        var youtube_link =  $("#youtube_link").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.lives.fetch_youtube_data_from_link') }}`,
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

                $("#embed_html").val(result.embed_html);
                $("#thumbnail_url_val").val(result.thumbnail_url);
                $("#external_id").val(result.external_id);
            },
            error: function(result) {
                @include('admin::layouts.includes.js.json_response')
            }
        });
    });

</script>

@endpush
