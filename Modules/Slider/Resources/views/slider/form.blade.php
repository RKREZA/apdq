@push('css')
    <style>
        /* .video_container{
            display: none;
        }
        .live_container{
            display: none;
        } */
    </style>
@endpush

<div class="row">

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('category_id') is-invalid @enderror is-filled">
            <label class="form-label" for="category_id"><span class="required">{{ __('slider::slider.slider.form.category_id') }}</span></label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                {{-- <option value="" disabled readonly selected>{{ __('slider::slider.slider.form.select_category') }}</option> --}}
                @foreach ($slidercategories as $category)
                    <option value="{{ $category->id }}" @if(isset($slider) && $slider->category_id == $category->id) selected @else{{ old('category_id') }}@endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12 video_container d-none">
        <div class="input-group input-group-outline mt-3 is-filled @error('video_id') is-invalid @enderror is-filled">
            <label class="form-label" for="video_id"><span class="required">{{ __('slider::slider.slider.form.video_id') }}</span></label>
            <select name="video_id" id="video_id" class="form-control select2 @error('video_id') is-invalid @enderror">
                <option value="" disabled readonly selected>{{ __('slider::slider.slider.form.select_video') }}</option>
                @foreach ($videos as $video)
                    <option value="{{ $video->id }}" @if(isset($slider) && $slider->video_id == $video->id) selected @else{{ old('video_id') }}@endif>{{ $video->title }}</option>
                @endforeach
            </select>
            @error('video_id')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12 live_container d-none">
        <div class="input-group input-group-outline mt-3 is-filled @error('live_id') is-invalid @enderror is-filled">
            <label class="form-label" for="live_id"><span class="required">{{ __('slider::slider.slider.form.live_id') }}</span></label>
            <select name="live_id" id="live_id" class="form-control select2 @error('live_id') is-invalid @enderror">
                <option value="" disabled readonly selected>{{ __('slider::slider.slider.form.select_live') }}</option>
                @foreach ($lives as $live)
                    <option value="{{ $live->id }}" @if(isset($slider) && $slider->live_id == $live->id) selected @else{{ old('live_id') }}@endif>{{ $live->title }}</option>
                @endforeach
            </select>
            @error('live_id')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12 url_container">
        <div class="input-group input-group-outline mt-3 is-filled @error('url') is-invalid @enderror">
            <label class="form-label"><span class="">{{ __('slider::slider.slider.form.url') }}</span></label>
            <input type="text" name="url" id="url" class="form-control" value="@if(isset($slider)){{ $slider->url }}@else{{ old('url') }}@endif">
            @error('url')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('title') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('slider::slider.slider.form.title') }}</span></label>
            <input type="text" name="title" id="title" class="form-control" value="@if(isset($slider)){{ $slider->title }}@else{{ old('title') }}@endif">
            @error('title')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group input-group-outline mt-3 is-filled @error('description') is-invalid @enderror">
            <label class="form-label"><span class="required">{{ __('slider::slider.slider.form.description') }}</span></label>
            <textarea rows="6" id="description" name="description" class="form-control tiny">@if(isset($slider)){{ $slider->description }}@else{{ old('description') }}@endif</textarea>
            @error('description')
                <em class="error invalid-slider" style="display: inline-block;">{{ $message }}</em>
            @enderror
        </div>
    </div>

</div>

@push('js')

<script>
    // Function to handle category changes
    function handleCategoryChange() {
        var selectedValue = $('#category_id').val();

        $('.video_container, .live_container, .url_container').addClass('d-none');

        if (selectedValue == 1) {
            $('.url_container').removeClass('d-none');
            $('.video, .live').val('');
        } else if (selectedValue == 2) {
            $('.video_container').removeClass('d-none');
            $('.live').val('');
        } else if (selectedValue == 3) {
            $('.live_container').removeClass('d-none');
            $('.video').val('');
        }
    }

    // Call the function on document ready (initial load)
    $(document).ready(function () {
        handleCategoryChange();
    });

    // Listen for changes in the category dropdown
    $('#category_id').change(function () {
        handleCategoryChange();
    });
</script>


<script>
    $(document).ready(function () {
        $('#video_id').change(function () {
            var selectedVideoId = $(this).val();

            // Make an AJAX request to fetch video information
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.videos.get') }}`, // Replace with your server-side endpoint
                data: { id: selectedVideoId },
                success: function (data) {
                    // Update the HTML with video information
                    $('#title').val(data.title);
                    $('#description').summernote('code', data.description);
                    $('#thumbnail_url').attr('src', data.thumbnail_url);
                },
                error: function (error) {
                    console.error('Error fetching video information:', error);
                }
            });
        });

        
        $('#live_id').change(function () {
            var selectedVideoId = $(this).val();

            // Make an AJAX request to fetch video information
            $.ajax({
                type: 'GET',
                url: `{{ route('admin.lives.get') }}`, // Replace with your server-side endpoint
                data: { id: selectedVideoId },
                success: function (data) {
                    // Update the HTML with video information
                    $('#title').val(data.title);
                    $('#description').summernote('code', data.description);
                    $('#thumbnail_url').attr('src', data.thumbnail_url);
                },
                error: function (error) {
                    console.error('Error fetching video information:', error);
                }
            });
        });
    });
</script>

@endpush
