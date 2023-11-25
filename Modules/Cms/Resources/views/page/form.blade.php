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
    </style>
@endpush

<div class="row">

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
            <label class="form-label" for="category_id"><span class="required">{{ __('cms::cms.page.form.category_id') }}</span></label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="" disabled readonly selected>{{ __('cms::cms.page.form.select_category') }}</option>
                @foreach (\Modules\Cms\Entities\PageCategory::where('status','Active')->get() as $category)
                    <option value="{{ $category->id }}" @if(isset($page) && $page->category_id == $category->id) selected @else{{ old('category_id') }}@endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('cms::cms.page.form.title') }}</span></label>
            <input type="text" name="title" id="title" class="form-control" value="@if(isset($page)){{ $page->title }}@else{{ old('title') }}@endif">
            @error('title')
                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('cms::cms.page.form.description') }}</span></label>
            <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($page)){{ $page->description }}@else{{ old('description') }}@endif</textarea>
            @error('description')
                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline my-3 is-filled @error('tag') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('cms::cms.page.form.tag') }}</span></label>
            <input type="text" rows="6" id="tag" name="tag" class="form-control" value="@if(isset($page)){{ $page->tag }}@else{{ old('tag') }}@endif"></textarea>
            @error('tag')
                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>

        <div id="tagsContainer" class="mb-3"></div>

        <hr class="horizontal light my-4">

        <div class="col-md-12">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_title') is-invalid @enderror">
                <label class="form-label">{{ __('cms::cms.page.form.seo_title') }}</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control" value="@if(isset($page)){{ $page->seo_title }}@else{{ old('seo_title') }}@endif">
                @error('seo_title')
                    <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_description') is-invalid @enderror">
                <label class="form-label">{{ __('cms::cms.page.form.seo_description') }}</label>
                <textarea rows="2" id="seo_description" name="seo_description" class="form-control">@if(isset($page)){{ $page->seo_description }}@else{{ old('seo_description') }}@endif</textarea>
                @error('seo_description')
                    <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                <label class="form-label">{{ __('cms::cms.page.form.seo_keyword') }}</label>
                <textarea rows="4" id="seo_keyword" name="seo_keyword" class="form-control">@if(isset($page)){{ $page->seo_keyword }}@else{{ old('seo_keyword') }}@endif</textarea>
                @error('seo_keyword')
                    <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>




    </div>

</div>

@push('js')

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

@endpush
