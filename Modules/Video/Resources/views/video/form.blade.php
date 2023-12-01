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

{{-- <div class="row mb-4">
    <div class="col-md-10">
        <input type="text" name="youtube_link" id="youtube_link" class="form-control px-3" placeholder="Youtube Link">
    </div>

    <div class="col-md-2">
        <button type="button" id="fetch_youtube_data" class="btn btn-primary btn-lg w-100">Fetch</button>
    </div>
</div>
<hr class="horizontal dark"> --}}






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
