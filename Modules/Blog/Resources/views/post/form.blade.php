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
        <h6 class="mt-4 text-primary">{{ __('core::core.publish_information') }}</h6>
        <hr class="mb-1">
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline mt-3 is-filled @error('publish_type') is-invalid @enderror is-filled">
            <label class="form-label" for="publish_type"><span class="required">{{ __('core::core.publish_type') }}</span></label>
            <select name="publish_type" id="publish_type" class="form-control @error('publish_type') is-invalid @enderror">
                <option value="publish" @if (isset($post) && $post->publish_type == 'publish') selected @endif>{{ __('core::core.publish') }}</option>
                <option value="schedule" @if (isset($post) && $post->publish_type == 'schedule') selected @endif>{{ __('core::core.schedule') }}</option>
            </select>
            @error('publish_type')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group input-group-outline mt-3 is-filled @error('created_at') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('blog::blog.post.form.created_at') }}</span></label>
            <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="@if(isset($post)){{ $post->created_at }}@else{{ now()->format('Y-m-d\TH:i') }}@endif">
            @error('created_at')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>



    <div class="col-md-12">
        <h6 class="mt-4 text-primary">{{ __('blog::blog.post.form.post_information') }}</h6>
        <hr class="mb-1">
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-outline mt-3 is-filled @error('content_type') is-invalid @enderror is-filled">
            <label class="form-label" for="content_type"><span class="required">{{ __('blog::blog.post.form.content_type') }}</span></label>
            <select name="content_type" id="content_type" class="form-control @error('content_type') is-invalid @enderror">
                <option value="free" @if (isset($post) && $post->content_type == 'free') selected @endif>{{ __('core::core.free') }}</option>
                <option value="paid" @if (isset($post) && $post->content_type == 'paid') selected @endif>{{ __('core::core.paid') }}</option>
            </select>
            @error('content_type')
                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
            <label class="form-label" for="category_id"><span class="required">{{ __('blog::blog.post.form.category_id') }}</span></label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="" disabled readonly selected>{{ __('blog::blog.post.form.select_category') }}</option>
                @foreach (\Modules\Blog\Entities\PostCategory::where('status','Active')->get() as $category)
                    <option value="{{ $category->id }}" @if(isset($post) && $post->category_id == $category->id) selected @else{{ old('category_id') }}@endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="input-group input-group-outline mt-3 is-filled @error('subcategory_id') is-invalid @enderror is-filled">
            <label class="form-label" for="subcategory_id"><span class="required">{{ __('blog::blog.post.form.subcategory_id') }}</span></label>
            <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                <option value="" disabled readonly selected>{{ __('blog::blog.post.form.select_subcategory') }}</option>
                @foreach (\Modules\Blog\Entities\PostSubcategory::where('status','Active')->get() as $subcategory)
                    <option value="{{ $subcategory->id }}" @if(isset($post) && $post->subcategory_id == $subcategory->id) selected @else{{ old('subcategory_id') }}@endif>{{ $subcategory->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('blog::blog.post.form.title') }}</span></label>
            <input type="text" name="title" id="title" class="form-control" value="@if(isset($post)){{ $post->title }}@else{{ old('title') }}@endif">
            @error('title')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
            <label class="form-label"><span class="">{{ __('blog::blog.post.form.description') }}</span></label>
            <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($post)){{ $post->description }}@else{{ old('description') }}@endif</textarea>
            @error('description')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline my-3 is-filled @error('tag') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('blog::blog.post.form.tag') }}</span></label>
            <input type="text" rows="6" id="tag" name="tag" class="form-control" value="@if(isset($post)){{ $post->tag }}@else{{ old('tag') }}@endif"></textarea>
            @error('tag')
                <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>

        <div id="tagsContainer" class="mb-3"></div>

        <div class="col-md-12">
            <h6 class="mt-4 text-primary">{{ __('core::core.seo_information') }}</h6>
            <hr class="mb-1">
        </div>

        <div class="col-md-12">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_title') is-invalid @enderror">
                <label class="form-label">{{ __('blog::blog.post.form.seo_title') }}</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control" value="@if(isset($post)){{ $post->seo_title }}@else{{ old('seo_title') }}@endif">
                @error('seo_title')
                    <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_description') is-invalid @enderror">
                <label class="form-label">{{ __('blog::blog.post.form.seo_description') }}</label>
                <textarea rows="2" id="seo_description" name="seo_description" class="form-control">@if(isset($post)){{ $post->seo_description }}@else{{ old('seo_description') }}@endif</textarea>
                @error('seo_description')
                    <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
                @enderror
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="input-group input-group-outline mt-3 is-filled @error('seo_keyword') is-invalid @enderror">
                <label class="form-label">{{ __('blog::blog.post.form.seo_keyword') }}</label>
                <textarea rows="4" id="seo_keyword" name="seo_keyword" class="form-control">@if(isset($post)){{ $post->seo_keyword }}@else{{ old('seo_keyword') }}@endif</textarea>
                @error('seo_keyword')
                    <em class="error invalid-post" style="display: inline-block;">{{ $message }}</em>
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
